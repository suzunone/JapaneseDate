#!/usr/bin/env php
<?php

/**
 * NASA SVS の月データからフィクスチャを生成します。
 *
 * 使い方:
 *   php tests/scripts/generate_fixture.php <year>
 *
 * NASA JSON の各日 00:00 UT（09:00 JST）について DateTime::toArray() の
 * 全項目を出力し、moon_age だけをNASA由来の値で置き換えます。
 *
 * - moon_age: NASA JSON の age（NASAが直接報告する実測値のため信頼できる）
 *
 * 国立天文台の朔弦望時刻として追加するイベントの moon_age は、同データ内の
 * 直前の朔時刻からの経過日数を優先します。同一年内に直前の朔がない年初の
 * イベントだけ、NASA JSON の前後1時間値から月齢を補間します。
 *
 * moon_phase_angle・moon_phase（主要月相点の判定）は、NASAの照明率(%)から
 * 逆算しようとすると新月(0°)・満月(180°)付近で照明率の変化が極めて緩やかになり
 * 角度の復元誤差が拡大してしまうため採用せず、ライブラリ本体（VSOP87/ELP2000）
 * による精密計算の結果（DateTime::toArray() の値）をそのまま採用します。
 */

require __DIR__ . '/../../vendor/autoload.php';

use JapaneseDate\DateTime;

date_default_timezone_set('Asia/Tokyo');

if ($argc < 2) {
    fwrite(STDERR, "Usage: php generate_fixture.php <year>\n");
    exit(1);
}

$year = (int)$argv[1];
$urlMap = require __DIR__ . '/fixtures.php';

if (!isset($urlMap[(string)$year])) {
    fwrite(STDERR, "No URL defined for year {$year} in fixtures.php\n");
    exit(1);
}

[$svsPageUrl, $svsJsonUrl] = $urlMap[(string)$year];
$fixtureDirectory = realpath(__DIR__ . '/../fixtures');
if ($fixtureDirectory === false) {
    fwrite(STDERR, "Fixture directory not found\n");
    exit(1);
}

$jsonFile = "{$fixtureDirectory}/mooninfo_{$year}.json";

/**
 * NASA SVS から JSON を取得します。
 *
 * @return array{0: string|null, 1: string|null} [response body, error message]
 */
function fetchNasaJson(string $url): array
{
    $curl = curl_init($url);
    if ($curl === false) {
        return [null, 'Failed to initialize cURL'];
    }

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'JapaneseDate fixture generator',
    ]);

    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpStatus = (int)curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

    if ($response === false) {
        return [null, "cURL error: {$curlError}"];
    }
    if ($httpStatus !== 200) {
        return [null, "NASA returned HTTP {$httpStatus}"];
    }

    return [$response, null];
}

echo "Fetching {$svsJsonUrl} ...\n";
[$jsonContent, $fetchError] = fetchNasaJson($svsJsonUrl);
if ($jsonContent === null) {
    if (!file_exists($jsonFile)) {
        fwrite(STDERR, "Failed to fetch: {$fetchError}\n");
        fwrite(STDERR, "No cache available: {$jsonFile}\n");
        exit(1);
    }

    fwrite(STDERR, "Failed to fetch: {$fetchError}\n");
    echo "Using cached NASA data: {$jsonFile}\n";
    $jsonContent = file_get_contents($jsonFile);
} else {
    file_put_contents($jsonFile, $jsonContent);
    echo "Saved: {$jsonFile}\n";
}

$entries = json_decode($jsonContent, true);
if (!is_array($entries)) {
    fwrite(STDERR, "Failed to parse JSON\n");
    exit(1);
}

/**
 * 国立天文台データの「○月○日」表記を Y-m-d 形式へ変換します。
 */
function naojDateToYmd(int $year, string $monthDay): ?string
{
    if (!preg_match('/(\d+)月(\d+)日/u', $monthDay, $matches)) {
        return null;
    }

    return sprintf('%04d-%02d-%02d', $year, (int)$matches[1], (int)$matches[2]);
}

/**
 * 国立天文台データの「○時○分」表記を [時, 分] へ変換します。
 */
function naojTimeToHourMinute(string $hourMinute): array
{
    if (!preg_match('/(\d+)時(\d+)分/u', $hourMinute, $matches)) {
        return [0, 0];
    }

    return [(int)$matches[1], (int)$matches[2]];
}

/**
 * 国立天文台 JSON フィクスチャを読み込みます。存在しない場合は空配列を返します。
 */
function loadNaojJson(string $path): array
{
    if (!file_exists($path)) {
        return [];
    }

    $decoded = json_decode((string)file_get_contents($path), true);

    return is_array($decoded) ? $decoded : [];
}

/**
 * 「国民の祝日」一覧から、振替休日・国民の休日も含めた当年の祝日コード一覧を独自に算出します。
 *
 * - 国民の休日: 祝日に挟まれた日曜日でない平日
 * - 振替休日: 祝日が日曜日の場合、それ以降で祝日でない最初の日
 *
 * @return array<string, int> [Y-m-d => holiday定数]
 */
function buildHolidayMap(int $year, array $holidayEntries): array
{
    $holidayNameToCode = [
        '元日' => DateTime::NEW_YEAR_S_DAY,
        '元旦' => DateTime::NEW_YEAR_S_DAY,
        '成人の日' => DateTime::COMING_OF_AGE_DAY,
        '建国記念の日' => DateTime::NATIONAL_FOUNDATION_DAY,
        '春分の日' => DateTime::VERNAL_EQUINOX_DAY,
        '昭和の日' => DateTime::DAY_OF_SHOWA,
        'みどりの日' => DateTime::GREENERY_DAY,
        '天皇誕生日' => DateTime::THE_EMPEROR_S_BIRTHDAY,
        '憲法記念日' => DateTime::CONSTITUTION_DAY,
        'こどもの日' => DateTime::CHILDREN_S_DAY,
        '海の日' => DateTime::MARINE_DAY,
        '秋分の日' => DateTime::AUTUMNAL_EQUINOX_DAY,
        '敬老の日' => DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY,
        '体育の日' => DateTime::LEGACY_SPORTS_DAY,
        'スポーツの日' => DateTime::SPORTS_DAY,
        '文化の日' => DateTime::CULTURE_DAY,
        '勤労感謝の日' => DateTime::LABOR_THANKSGIVING_DAY,
        '即位礼正殿の儀' => DateTime::REGNAL_DAY,
        '山の日' => DateTime::MOUNTAIN_DAY,
        '天皇の即位の日' => DateTime::EMPERORS_THRONE_DAY,
    ];

    $base = [];
    foreach ($holidayEntries as $entry) {
        $ymd = naojDateToYmd($year, (string)($entry['date'] ?? ''));
        $name = (string)($entry['name'] ?? '');
        if ($ymd === null || !isset($holidayNameToCode[$name])) {
            continue;
        }

        $base[$ymd] = $holidayNameToCode[$name];
    }

    // 2019年限りの特別法（天皇の即位の日及び即位礼正殿の儀の行われる日を休日とする法律）による
    // 一時的祝日。「国民の祝日に関する法律」に基づく恒例の祝日のみを掲載する国立天文台の暦要項
    // データには含まれないため、ここで補完する（実装側 src/Components/JapaneseDate.php の
    // EMPERORS_THRONE_DAY・REGNAL_DAY のハードコードと対応させる）。
    if ($year === 2019) {
        $base['2019-05-01'] = DateTime::EMPERORS_THRONE_DAY;
        $base['2019-10-22'] = DateTime::REGNAL_DAY;
    }

    if ($base === []) {
        return [];
    }

    $weekdayOf = static fn (string $ymd): int => (int)(new DateTimeImmutable($ymd))->format('w');
    $addDays = static fn (string $ymd, int $days): string => (new DateTimeImmutable($ymd))->modify("{$days} day")->format('Y-m-d');

    // 国民の休日: 前日・翌日がともに祝日で、自身は祝日でも日曜日でもない平日
    $holidays = $base;
    foreach ($base as $ymd => $code) {
        $candidate = $addDays($ymd, 1);
        $followingHolidayDate = $addDays($ymd, 2);
        if (
            isset($base[$followingHolidayDate])
            && !isset($holidays[$candidate])
            && $weekdayOf($candidate) !== 0
        ) {
            $holidays[$candidate] = DateTime::NATIONAL_HOLIDAY;
        }
    }

    // 振替休日: 祝日（国民の休日を含む）が日曜日の場合、それ以降で祝日でない最初の日
    ksort($holidays);
    foreach ($holidays as $ymd => $code) {
        if ($weekdayOf($ymd) !== 0) {
            continue;
        }

        $substituteDate = $addDays($ymd, 1);
        while (isset($holidays[$substituteDate])) {
            $substituteDate = $addDays($substituteDate, 1);
        }

        $holidays[$substituteDate] = DateTime::COMPENSATING_HOLIDAY;
    }

    ksort($holidays);

    return $holidays;
}

/**
 * 国立天文台「二十四節気および雑節」データから、節気・雑節それぞれの日付マップを構築します。
 *
 * @return array{0: array<string, array{0: int, 1: string}>, 1: array<string, array{0: int, 1: string}>}
 *         [二十四節気マップ, 雑節マップ]（いずれも Y-m-d => [コード, 名称]）
 */
function buildSolarTermAndMiscSeasonalNodeMaps(int $year, array $seasonEntries): array
{
    $solarTermNameToCode = [
        '春分' => DateTime::SOLAR_TERM_SYUNBUN,
        '清明' => DateTime::SOLAR_TERM_SEIMEI,
        '穀雨' => DateTime::SOLAR_TERM_KOKUU,
        '立夏' => DateTime::SOLAR_TERM_RIKKA,
        '小満' => DateTime::SOLAR_TERM_SYOUMAN,
        '芒種' => DateTime::SOLAR_TERM_BOUSYU,
        '夏至' => DateTime::SOLAR_TERM_GESHI,
        '小暑' => DateTime::SOLAR_TERM_SYOUSYO,
        '大暑' => DateTime::SOLAR_TERM_TAISYO,
        '立秋' => DateTime::SOLAR_TERM_RISSYUU,
        '処暑' => DateTime::SOLAR_TERM_SYOSYO,
        '白露' => DateTime::SOLAR_TERM_HAKURO,
        '秋分' => DateTime::SOLAR_TERM_SYUUBUN,
        '寒露' => DateTime::SOLAR_TERM_KANRO,
        '霜降' => DateTime::SOLAR_TERM_SOUKOU,
        '立冬' => DateTime::SOLAR_TERM_RITTOU,
        '小雪' => DateTime::SOLAR_TERM_SYOUSETSU,
        '大雪' => DateTime::SOLAR_TERM_TAISETSU,
        '冬至' => DateTime::SOLAR_TERM_TOUJI,
        '小寒' => DateTime::SOLAR_TERM_SYOUKAN,
        '大寒' => DateTime::SOLAR_TERM_DAIKAN,
        '立春' => DateTime::SOLAR_TERM_RISSYUN,
        '雨水' => DateTime::SOLAR_TERM_USUI,
        '啓蟄' => DateTime::SOLAR_TERM_KEICHITSU,
    ];

    $miscSeasonalNodeNameToCode = [
        '節分' => DateTime::MISC_SEASONAL_NODE_SETSUBUN,
        '彼岸' => DateTime::MISC_SEASONAL_NODE_HIGAN,
        '社日' => DateTime::MISC_SEASONAL_NODE_SHANICHI,
        '八十八夜' => DateTime::MISC_SEASONAL_NODE_HACHIJUHACHIYA,
        '入梅' => DateTime::MISC_SEASONAL_NODE_NYUBAI,
        '半夏生' => DateTime::MISC_SEASONAL_NODE_HANGESHO,
        '土用' => DateTime::MISC_SEASONAL_NODE_DOYO,
        '二百十日' => DateTime::MISC_SEASONAL_NODE_NIHYAKUTOKA,
        '二百二十日' => DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI,
    ];

    $solarTermMap = [];
    $miscSeasonalNodeMap = [];

    foreach ($seasonEntries as $entry) {
        $ymd = naojDateToYmd($year, (string)($entry['date'] ?? ''));
        $name = (string)($entry['name'] ?? '');
        if ($ymd === null) {
            continue;
        }

        if (isset($solarTermNameToCode[$name]) && (string)($entry['type'] ?? '') !== 'zasetu') {
            $solarTermMap[$ymd] = [$solarTermNameToCode[$name], $name];
            continue;
        }

        if (isset($miscSeasonalNodeNameToCode[$name])) {
            $miscSeasonalNodeMap[$ymd] = [$miscSeasonalNodeNameToCode[$name], $name];
        }
    }

    return [$solarTermMap, $miscSeasonalNodeMap];
}

/**
 * 国立天文台「朔弦望」データから、月相イベント（朔・上弦・望・下弦）の一覧を構築します。
 *
 * @return list<array{datetime: string, phase: int, text: string}>
 */
function buildMoonPhaseEvents(int $year, array $moonEntries): array
{
    $phaseNameToCodeAndText = [
        '朔' => [DateTime::MOON_PHASE_SHINGETSU, '新月'],
        '上弦' => [DateTime::MOON_PHASE_JOUGEN, '上弦'],
        '望' => [DateTime::MOON_PHASE_MANGETSU, '満月'],
        '下弦' => [DateTime::MOON_PHASE_KAGEN, '下弦'],
    ];

    $events = [];
    foreach ($moonEntries as $entry) {
        $name = (string)($entry['phase'] ?? '');
        $ymd = naojDateToYmd($year, (string)($entry['date'] ?? ''));
        if ($ymd === null || !isset($phaseNameToCodeAndText[$name])) {
            continue;
        }

        [$hour, $minute] = naojTimeToHourMinute((string)($entry['time'] ?? ''));
        [$phase, $text] = $phaseNameToCodeAndText[$name];

        $events[] = [
            'datetime' => sprintf('%s %02d:%02d:00', $ymd, $hour, $minute),
            'phase' => $phase,
            'text' => $text,
        ];
    }

    return $events;
}

/**
 * NASA SVS の1時間刻みデータから、指定時刻の月齢を線形補間します。
 *
 * @param list<array<string, mixed>> $entries
 */
function interpolateNasaMoonAge(
    DateTimeImmutable $target,
    array $entries,
    DateTimeZone $utcTimezone
): ?float {
    $previousTimestamp = null;
    $previousAge = null;

    foreach ($entries as $entry) {
        $current = DateTimeImmutable::createFromFormat(
            'd M Y H:i \U\T',
            (string)($entry['time'] ?? ''),
            $utcTimezone
        );
        if (!$current instanceof DateTimeImmutable || !isset($entry['age'])) {
            continue;
        }

        $currentTimestamp = $current->getTimestamp();
        $currentAge = (float)$entry['age'];
        $targetTimestamp = $target->getTimestamp();

        if ($currentTimestamp === $targetTimestamp) {
            return $currentAge;
        }

        if ($currentTimestamp > $targetTimestamp) {
            if ($previousTimestamp === null || $previousAge === null) {
                return null;
            }

            $ageDelta = $currentAge - $previousAge;
            if ($ageDelta < 0.0) {
                $ageDelta += 29.530589;
            }

            $ratio = ($targetTimestamp - $previousTimestamp)
                / ($currentTimestamp - $previousTimestamp);
            $interpolatedAge = $previousAge + $ageDelta * $ratio;

            return fmod($interpolatedAge, 29.530589);
        }

        $previousTimestamp = $currentTimestamp;
        $previousAge = $currentAge;
    }

    return null;
}

/**
 * 月相イベント時刻の月齢を、国立天文台の直前朔を優先して算出します。
 *
 * 同一年内に直前の朔がない年初のイベントでは、NASA SVS の月齢を補間します。
 *
 * @param array{datetime: string, phase: int, text: string} $event
 * @param list<array{datetime: string, phase: int, text: string}> $moonPhaseEvents
 * @param list<array<string, mixed>> $nasaEntries
 */
function moonAgeForPhaseEvent(
    array $event,
    array $moonPhaseEvents,
    array $nasaEntries,
    DateTimeZone $jstTimezone,
    DateTimeZone $utcTimezone
): ?float {
    $eventDate = new DateTimeImmutable($event['datetime'], $jstTimezone);
    $previousNewMoon = null;

    foreach ($moonPhaseEvents as $candidate) {
        if ($candidate['phase'] !== DateTime::MOON_PHASE_SHINGETSU) {
            continue;
        }

        $candidateDate = new DateTimeImmutable($candidate['datetime'], $jstTimezone);
        if ($candidateDate > $eventDate) {
            break;
        }

        $previousNewMoon = $candidateDate;
    }

    if ($previousNewMoon instanceof DateTimeImmutable) {
        return ($eventDate->getTimestamp() - $previousNewMoon->getTimestamp()) / 86400.0;
    }

    return interpolateNasaMoonAge(
        $eventDate->setTimezone($utcTimezone),
        $nasaEntries,
        $utcTimezone
    );
}

/**
 * PHP 8.5 で null の月相キーに対して発生する既知の非推奨警告だけを抑止します。
 */
function dateTimeToArray(DateTime $date): array
{
    set_error_handler(
        static function (int $severity, string $message, string $file): bool {
            return $severity === E_DEPRECATED
                && str_contains($message, 'Using null as an array offset is deprecated')
                && str_ends_with($file, '/src/Components/JapaneseDate.php');
        }
    );

    try {
        return $date->toArray();
    } finally {
        restore_error_handler();
    }
}

$holidayTextByCode = [
    DateTime::NEW_YEAR_S_DAY => '元旦',
    DateTime::COMING_OF_AGE_DAY => '成人の日',
    DateTime::NATIONAL_FOUNDATION_DAY => '建国記念の日',
    DateTime::VERNAL_EQUINOX_DAY => '春分の日',
    DateTime::DAY_OF_SHOWA => '昭和の日',
    DateTime::GREENERY_DAY => 'みどりの日',
    DateTime::THE_EMPEROR_S_BIRTHDAY => '天皇誕生日',
    DateTime::CONSTITUTION_DAY => '憲法記念日',
    DateTime::NATIONAL_HOLIDAY => '国民の休日',
    DateTime::CHILDREN_S_DAY => 'こどもの日',
    DateTime::COMPENSATING_HOLIDAY => '振替休日',
    DateTime::MARINE_DAY => '海の日',
    DateTime::AUTUMNAL_EQUINOX_DAY => '秋分の日',
    DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY => '敬老の日',
    DateTime::LEGACY_SPORTS_DAY => '体育の日',
    DateTime::SPORTS_DAY => 'スポーツの日',
    DateTime::CULTURE_DAY => '文化の日',
    DateTime::LABOR_THANKSGIVING_DAY => '勤労感謝の日',
    DateTime::REGNAL_DAY => '即位礼正殿の儀',
    DateTime::MOUNTAIN_DAY => '山の日',
    DateTime::EMPERORS_THRONE_DAY => '天皇の即位の日',
];

$holidayMap = buildHolidayMap($year, loadNaojJson("{$fixtureDirectory}/holiday_{$year}.json"));
[$solarTermMap, $miscSeasonalNodeMap] = buildSolarTermAndMiscSeasonalNodeMaps(
    $year,
    loadNaojJson("{$fixtureDirectory}/season_{$year}.json")
);
$moonPhaseEntries = loadNaojJson("{$fixtureDirectory}/moon_{$year}.json");
$moonPhaseEvents = buildMoonPhaseEvents($year, $moonPhaseEntries);

$utcTimezone = new DateTimeZone('UTC');
$jstTimezone = new DateTimeZone('Asia/Tokyo');
$data = [];

DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);

foreach ($entries as $index => $entry) {
    $utc = DateTimeImmutable::createFromFormat(
        'd M Y H:i \U\T',
        (string)($entry['time'] ?? ''),
        $utcTimezone
    );
    if (
        !$utc instanceof DateTimeImmutable
        || (int)$utc->format('Y') !== $year
        || $utc->format('H:i') !== '00:00'
    ) {
        continue;
    }

    $dateText = $utc->setTimezone($jstTimezone)->format('Y-m-d H:i:s');
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateText);
    $ymd = $date->format('Y-m-d');
    $expected = dateTimeToArray($date);
    $expected['moon_age'] = (float)$entry['age'];

    if (isset($holidayMap[$ymd])) {
        $expected['holiday'] = $holidayMap[$ymd];
        $expected['holiday_text'] = $holidayTextByCode[$holidayMap[$ymd]] ?? '';
        $expected['is_holiday'] = true;
    } else {
        $expected['holiday'] = DateTime::NO_HOLIDAY;
        $expected['holiday_text'] = '';
        $expected['is_holiday'] = false;
    }

    if (isset($solarTermMap[$ymd])) {
        [$expected['solar_term'], $expected['solar_term_text']] = $solarTermMap[$ymd];
        $expected['is_solar_term'] = true;
    }

    if (isset($miscSeasonalNodeMap[$ymd])) {
        [$expected['misc_seasonal_node'], $expected['misc_seasonal_node_text']] = $miscSeasonalNodeMap[$ymd];
    }

    // 立春・立夏・立秋・立冬は土用の終わりを示すが、その日自体は土用に含まれない。
    // また、節分は立春の前日であり、立春と同日になることはない。
    // ライブラリがこれらを誤って返している場合は補正する。
    $startOfSeasonCodes = [
        DateTime::SOLAR_TERM_RISSYUN,
        DateTime::SOLAR_TERM_RIKKA,
        DateTime::SOLAR_TERM_RISSYUU,
        DateTime::SOLAR_TERM_RITTOU,
    ];
    if (
        isset($expected['solar_term'])
        && in_array($expected['solar_term'], $startOfSeasonCodes, true)
        && ($expected['misc_seasonal_node'] ?? 0) === DateTime::MISC_SEASONAL_NODE_DOYO
    ) {
        $expected['misc_seasonal_node'] = DateTime::MISC_SEASONAL_NODE_NONE;
        $expected['misc_seasonal_node_text'] = '';
    }

    $data[$dateText] = [
        $dateText,
        $expected,
    ];
}

foreach ($moonPhaseEvents as $event) {
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $event['datetime']);
    $expected = dateTimeToArray($date);
    $expected['moon_phase'] = $event['phase'];
    $expected['moon_phase_text'] = $event['text'];
    $externalMoonAge = moonAgeForPhaseEvent(
        $event,
        $moonPhaseEvents,
        $entries,
        $jstTimezone,
        $utcTimezone
    );
    if ($externalMoonAge !== null) {
        $expected['moon_age'] = $externalMoonAge;
    }

    // 立春・立夏・立秋・立冬の日は土用に含まれない。また節分は立春の前日のみ。
    // ライブラリが誤って返している場合は補正する。
    $startOfSeasonCodes = [
        DateTime::SOLAR_TERM_RISSYUN,
        DateTime::SOLAR_TERM_RIKKA,
        DateTime::SOLAR_TERM_RISSYUU,
        DateTime::SOLAR_TERM_RITTOU,
    ];
    if (
        isset($expected['solar_term'])
        && in_array($expected['solar_term'], $startOfSeasonCodes, true)
        && ($expected['misc_seasonal_node'] ?? 0) === DateTime::MISC_SEASONAL_NODE_DOYO
    ) {
        $expected['misc_seasonal_node'] = DateTime::MISC_SEASONAL_NODE_NONE;
        $expected['misc_seasonal_node_text'] = '';
    }

    $data[$event['datetime']] = [
        $event['datetime'],
        $expected,
    ];
}

ksort($data);
$count = count($data);
$export = str_replace(" => \n", " =>\n", var_export($data, true));
$outFile = "{$fixtureDirectory}/{$year}.php";

$content = <<<PHP
<?php

// Source data:
// {$svsPageUrl}
// {$svsJsonUrl}
// {$urlMap[(string)$year][2]}
// {$urlMap[(string)$year][3]}
// {$urlMap[(string)$year][4]}

return {$export};
PHP;

file_put_contents($outFile, $content . "\n");
echo "Generating {$count} fixture entries for {$year}...\n";
echo "Done: tests/fixtures/{$year}.php\n";
