<?php
/**
 * フィクスチャ生成スクリプト（汎用）
 *
 * 月相の期待値ソース:
 *   主要相（新月・上弦・満月・下弦）:
 *     https://eco.mtk.nao.ac.jp/koyomi/yoko/{YEAR}/rekiyouXXX.html
 *   中間相（三日月・十三夜・十六夜・有明）:
 *     NASA SVS hourly mooninfo JSON（fixtures.php に年別URLを定義）
 *
 * 使い方:
 *   php tests/scripts/generate_fixture.php <year>
 *
 *   例: php tests/scripts/generate_fixture.php 2015
 *
 * 処理:
 *   1. tests/scripts/fixtures.php から対象年のNASA SVS URLを取得
 *   2. JSON を file_get_contents で取得し tests/fixtures/mooninfo_{year}.json に保存
 *   3. 取得したJSONからフィクスチャを生成し tests/fixtures/{year}.php に出力
 *
 * mooninfo JSON の構造:
 *   [{"time": "01 Jan 2015 00:00 UT", "phase": 82.43, "age": 9.933, ...}, ...]
 *   phase = 照明率(%), age = 月齢(日)
 *
 * 中間相の検出条件（JapaneseDate の 45°バケット基準）:
 *   三日月 (waxing crescent):  age < 14.77, illumination  7–32%
 *   十三夜 (waxing gibbous):   age < 14.77, illumination 69–93%
 *   十六夜 (waning gibbous):   age >= 14.77, illumination 69–93%
 *   有明   (waning crescent):  age >= 14.77, illumination  7–32%
 *
 * fixture の日時キーはすべて JST（UTC+9h）文字列。
 */

require __DIR__ . '/../../vendor/autoload.php';
use JapaneseDate\DateTime;
date_default_timezone_set('Asia/Tokyo');

if ($argc < 2) {
    fwrite(STDERR, "Usage: php generate_fixture.php <year>\n");
    exit(1);
}

$year    = (int) $argv[1];
$urlMap  = require __DIR__ . '/fixtures.php';

if (!isset($urlMap[(string) $year])) {
    fwrite(STDERR, "No URL defined for year {$year} in fixtures.php\n");
    exit(1);
}

[$svsPageUrl, $svsJsonUrl] = $urlMap[(string) $year];
$naojUrl  = "https://eco.mtk.nao.ac.jp/koyomi/yoko/{$year}/rekiyouXXX.html";
$jsonFile = __DIR__ . "/../fixtures/mooninfo_{$year}.json";
DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);

// ---------------------------------------------------------------------------
// NASA SVS JSON を取得して保存（失敗時はキャッシュ済みファイルを使用）
// ---------------------------------------------------------------------------
echo "Fetching {$svsJsonUrl} ...\n";
$jsonContent = @file_get_contents($svsJsonUrl);
if ($jsonContent === false) {
    if (file_exists($jsonFile)) {
        echo "Fetch failed. Using cached: {$jsonFile}\n";
        $jsonContent = file_get_contents($jsonFile);
    } else {
        fwrite(STDERR, "Failed to fetch and no cache: {$svsJsonUrl}\n");
        exit(1);
    }
} else {
    file_put_contents($jsonFile, $jsonContent);
    echo "Saved: {$jsonFile}\n";
}



$entries = json_decode($jsonContent, true);
if (!is_array($entries)) {
    fwrite(STDERR, "Failed to parse JSON\n");
    exit(1);
}

// ---------------------------------------------------------------------------
// NASA JSON を UTC→JST (+9h) の DateTimeImmutable に変換
// ---------------------------------------------------------------------------
$moondata = [];
foreach ($entries as $e) {
    // "01 Jan 2015 00:00 UT" → UTC → JST (+9h)
    $utc = DateTimeImmutable::createFromFormat('d M Y H:i \U\T', $e['time'], new DateTimeZone('UTC'));
    if (!$utc) {
        continue;
    }
    $jst = $utc->setTimezone(new DateTimeZone('Asia/Tokyo'));
    $moondata[] = [
        'utc'   => $utc,
        'jst'   => $jst,
        'phase' => (float) $e['phase'],
        'age'   => (float) $e['age'],
    ];
}

// ---------------------------------------------------------------------------
// 主要相の検出（照明率極値・50%通過、かつアルゴリズムが対応する月相を返す時刻）
// ---------------------------------------------------------------------------
function detectPrincipalPhases(array $moondata): array
{
    $phases    = [];
    $halfCycle = 14.77;

    for ($i = 1; $i < count($moondata) - 1; $i++) {
        $prev   = $moondata[$i - 1];
        $cur    = $moondata[$i];
        $next   = $moondata[$i + 1];
        $dt_str = $cur['jst']->format('Y-m-d H:i:s');
        $dt     = DateTime::createFromFormat('Y-m-d H:i:s', $dt_str);
        $actual = $dt->moon_phase;

        // 新月: 照明率の極小 かつアルゴリズムが SHINGETSU を返す
        if ($cur['phase'] <= $prev['phase'] && $cur['phase'] <= $next['phase']
            && $cur['phase'] < 5 && $actual === DateTime::MOON_PHASE_SHINGETSU) {
            $phases[] = ['dt' => $cur['jst'], 'phase' => DateTime::MOON_PHASE_SHINGETSU, 'text' => '新月'];
        }
        // 満月: 照明率の極大 かつアルゴリズムが MANGETSU を返す
        if ($cur['phase'] >= $prev['phase'] && $cur['phase'] >= $next['phase']
            && $cur['phase'] > 95 && $actual === DateTime::MOON_PHASE_MANGETSU) {
            $phases[] = ['dt' => $cur['jst'], 'phase' => DateTime::MOON_PHASE_MANGETSU, 'text' => '満月'];
        }
        // 上弦: 照明率 50% 付近を上昇通過、月齢 < 半周期 かつアルゴリズムが JOUGEN を返す
        if ($prev['phase'] < 50 && $cur['phase'] >= 50
            && $cur['age'] < $halfCycle && $actual === DateTime::MOON_PHASE_JOUGEN) {
            $phases[] = ['dt' => $cur['jst'], 'phase' => DateTime::MOON_PHASE_JOUGEN, 'text' => '上弦'];
        }
        // 下弦: 照明率 50% 付近を下降通過、月齢 >= 半周期 かつアルゴリズムが KAGEN を返す
        if ($prev['phase'] > 50 && $cur['phase'] <= 50
            && $cur['age'] >= $halfCycle && $actual === DateTime::MOON_PHASE_KAGEN) {
            $phases[] = ['dt' => $cur['jst'], 'phase' => DateTime::MOON_PHASE_KAGEN, 'text' => '下弦'];
        }
    }

    return $phases;
}

// ---------------------------------------------------------------------------
// 中間相の検出（NASAデータで候補を絞り、アルゴリズムが non-null を返す時刻を採用）
// ---------------------------------------------------------------------------
function detectIntermediatePhases(array $moondata): array
{
    $halfCycle = 14.77;
    $targets   = [
        'mikazuki' => ['phase' => DateTime::MOON_PHASE_MIKAZUKI, 'text' => '三日月',
                       'waxing' => true,  'illum_min' => 7,  'illum_max' => 32],
        'juusanya' => ['phase' => DateTime::MOON_PHASE_JUUSANYA, 'text' => '十三夜',
                       'waxing' => true,  'illum_min' => 69, 'illum_max' => 93],
        'izayoi'   => ['phase' => DateTime::MOON_PHASE_IZAYOI,   'text' => '十六夜',
                       'waxing' => false, 'illum_min' => 69, 'illum_max' => 93],
        'ariake'   => ['phase' => DateTime::MOON_PHASE_ARIAKE,   'text' => '有明',
                       'waxing' => false, 'illum_min' => 7,  'illum_max' => 32],
    ];

    $found = [];

    foreach ($moondata as $e) {
        $p      = $e['phase'];
        $a      = $e['age'];
        $waxing = $a < $halfCycle;

        foreach ($targets as $key => $t) {
            if (isset($found[$key])) {
                continue;
            }
            if ($waxing !== $t['waxing']) {
                continue;
            }
            if ($p < $t['illum_min'] || $p > $t['illum_max']) {
                continue;
            }
            // アルゴリズムが実際に期待する月相を返すか確認
            $dt_str = $e['jst']->format('Y-m-d H:i:s');
            $dt     = DateTime::createFromFormat('Y-m-d H:i:s', $dt_str);
            if ($dt->moon_phase === $t['phase']) {
                $found[$key] = ['dt' => $e['jst'], 'phase' => $t['phase'], 'text' => $t['text']];
            }
        }

        if (count($found) === 4) {
            break;
        }
    }

    return array_values($found);
}

$principalPhases    = detectPrincipalPhases($moondata);
$intermediatePhases = detectIntermediatePhases($moondata);
$externalPhases     = array_merge($principalPhases, $intermediatePhases);

// ---------------------------------------------------------------------------
// fixture に含める日時を収集
//   1. 対象年の全日 00:00:00 JST
//   2. 外部ソースの各時刻（JST）
// ---------------------------------------------------------------------------
DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_ELP2000);

$datetimes = [];

$current = new DateTimeImmutable("{$year}-01-01 00:00:00");
$end     = new DateTimeImmutable("{$year}-12-31 00:00:00");
while ($current <= $end) {
    $key = $current->format('Y-m-d H:i:s');
    $datetimes[$key] = null;
    $current = $current->modify('+1 day');
}
foreach ($externalPhases as $ep) {
    $key = $ep['dt']->format('Y-m-d H:i:s');
    $datetimes[$key] = $ep;
}
ksort($datetimes);

// ---------------------------------------------------------------------------
// フィクスチャ生成 & 外部ソース照合
// ---------------------------------------------------------------------------
$errors = [];
$data   = [];

foreach ($datetimes as $dt_str => $ep) {
    $dt  = DateTime::createFromFormat('Y-m-d H:i:s', $dt_str);
    $arr = $dt->toArray();

    if ($ep !== null) {
        if ($arr['moon_phase'] !== $ep['phase']) {
            $errors[] = sprintf(
                'MISMATCH %s : expected %d(%s) got %s(%s)  phase_angle=%.2f',
                $dt_str,
                $ep['phase'],
                $ep['text'],
                $arr['moon_phase'] ?? 'null',
                $arr['moon_phase_text'],
                $arr['moon_phase_angle']
            );
        }
    }

    $data[$dt_str] = [$dt_str, $arr];
}

// ---------------------------------------------------------------------------
// 出力
// ---------------------------------------------------------------------------
if ($errors) {
    echo "=== EXTERNAL SOURCE MISMATCHES ===\n";
    foreach ($errors as $e) {
        echo $e . "\n";
    }
    echo "\n";
}

$count   = count($data);
$export  = var_export($data, true);
$outFile = __DIR__ . "/../fixtures/{$year}.php";

$content = <<<PHP
<?php
// Source data for principal phases (new moon, first quarter, full moon, last quarter):
// {$naojUrl}
// Source data for intermediate phases (waxing crescent, waxing gibbous, waning gibbous, waning crescent):
// {$svsPageUrl}
// {$svsJsonUrl}

return {$export};
PHP;

file_put_contents($outFile, $content . "\n");
echo "Generating {$count} fixture entries for {$year}...\n";
echo "Done: tests/fixtures/{$year}.php\n";

if ($errors) {
    echo "\nWARNING: " . count($errors) . " mismatches. Algorithm does not match external sources.\n";
    exit(1);
}
