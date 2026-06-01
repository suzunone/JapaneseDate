<?php

/**
 * SeventyTwoKouCalculator.php
 *
 * 七十二候（しちじゅうにこう）の計算を担うコンポーネントです。
 * 二十四節気の日付を基準として、各日付が属する七十二候を算出します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Components;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Elements\SolarTermDate;
use Throwable;

/**
 * 七十二候（しちじゅうにこう）の算出を行うコンポーネント。
 *
 * 二十四節気の入節日を基準として、各節気の期間を初候・次候・末候の三等分に分割し、
 * 任意の日付が属する七十二候の番号・名称・読み・区分を算出します。
 *
 * **七十二候とは:**
 * 日本の伝統的な暦の区分のひとつ。二十四節気をさらに約5日ずつの3期に分けた72の候から成り、
 * 各候には季節の自然現象や動植物の変化を表した名称が付いています。
 *
 * **計算方法:**
 * 各節気の開始日から次の節気の開始日までの期間を3等分し、
 * 前 1/3 を初候、次の 1/3 を次候、残りを末候として判定します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-30
 */
class SeventyTwoKouCalculator
{
    /**
     * 七十二候の順序で並べた二十四節気定数の配列。
     * インデックス 0 が立春（候番号 1〜3 に対応）、インデックス 23 が大寒（候番号 70〜72）。
     *
     * @var int[]
     */
    private const KOU_SOLAR_TERM_ORDER = [
        DateTime::SOLAR_TERM_RISSYUN,    // 0:  立春  → 候 1〜3
        DateTime::SOLAR_TERM_USUI,       // 1:  雨水  → 候 4〜6
        DateTime::SOLAR_TERM_KEICHITSU,  // 2:  啓蟄  → 候 7〜9
        DateTime::SOLAR_TERM_SYUNBUN,    // 3:  春分  → 候 10〜12
        DateTime::SOLAR_TERM_SEIMEI,     // 4:  清明  → 候 13〜15
        DateTime::SOLAR_TERM_KOKUU,      // 5:  穀雨  → 候 16〜18
        DateTime::SOLAR_TERM_RIKKA,      // 6:  立夏  → 候 19〜21
        DateTime::SOLAR_TERM_SYOUMAN,    // 7:  小満  → 候 22〜24
        DateTime::SOLAR_TERM_BOUSYU,     // 8:  芒種  → 候 25〜27
        DateTime::SOLAR_TERM_GESHI,      // 9:  夏至  → 候 28〜30
        DateTime::SOLAR_TERM_SYOUSYO,    // 10: 小暑  → 候 31〜33
        DateTime::SOLAR_TERM_TAISYO,     // 11: 大暑  → 候 34〜36
        DateTime::SOLAR_TERM_RISSYUU,    // 12: 立秋  → 候 37〜39
        DateTime::SOLAR_TERM_SYOSYO,     // 13: 処暑  → 候 40〜42
        DateTime::SOLAR_TERM_HAKURO,     // 14: 白露  → 候 43〜45
        DateTime::SOLAR_TERM_SYUUBUN,    // 15: 秋分  → 候 46〜48
        DateTime::SOLAR_TERM_KANRO,      // 16: 寒露  → 候 49〜51
        DateTime::SOLAR_TERM_SOUKOU,     // 17: 霜降  → 候 52〜54
        DateTime::SOLAR_TERM_RITTOU,     // 18: 立冬  → 候 55〜57
        DateTime::SOLAR_TERM_SYOUSETSU,  // 19: 小雪  → 候 58〜60
        DateTime::SOLAR_TERM_TAISETSU,   // 20: 大雪  → 候 61〜63
        DateTime::SOLAR_TERM_TOUJI,      // 21: 冬至  → 候 64〜66
        DateTime::SOLAR_TERM_SYOUKAN,    // 22: 小寒  → 候 67〜69
        DateTime::SOLAR_TERM_DAIKAN,     // 23: 大寒  → 候 70〜72
    ];

    /**
     * 候番号（1〜72）に対応する名称・読みのマッピングデータ。
     * キー: 候番号（int）
     * 値: [0] 現代七十二候名称, [1] 読み
     *
     * @var array<int, array{0: string, 1: string}>
     */
    private const KOU_DATA = [
        1 => ['東風凍を解く',       'はるかぜ こおりをとく'],
        2 => ['うぐいす鳴く',       'うぐいす なく'],
        3 => ['魚氷を上る',         'うお こおりをいずる'],
        4 => ['土脉潤い起こる',     'つちのしょう うるおいおこる'],
        5 => ['霞始めてたなびく',   'かすみはじめてたなびく'],
        6 => ['草木萌え動る',       'そうもく めばえいずる'],
        7 => ['すごもりの虫戸を開く', 'すごもりむし とをひらく'],
        8 => ['桃始めてさく',       'もも はじめてさく'],
        9 => ['菜虫蝶となる',       'なむし ちょうとなる'],
        10 => ['雀始めて巣くう',     'すずめ はじめてすくう'],
        11 => ['桜始めて開く',       'さくら はじめてひらく'],
        12 => ['雷乃ち声を発す',     'かみなりすなわち こえをはっす'],
        13 => ['玄鳥至る',           'つばめ いたる'],
        14 => ['鴻雁かえる',         'こうがん かえる'],
        15 => ['虹始めてあらわる',   'にじ はじめてあらわる'],
        16 => ['葭始めて生ず',       'あし はじめてしょうず'],
        17 => ['霜止で苗出ずる',     'しもやんで なえいずる'],
        18 => ['牡丹はなさく',       'ぼたん はなさく'],
        19 => ['蛙始めて鳴く',       'かわず はじめてなく'],
        20 => ['みみず出ずる',       'みみず いずる'],
        21 => ['竹のこ生ず',         'たけのこ しょうず'],
        22 => ['蚕起きて桑を食む',   'かいこおきて くわをはむ'],
        23 => ['紅花栄う',           'べにばな さかう'],
        24 => ['麦秋至る',           'むぎのとき いたる'],
        25 => ['蟷螂生ず',           'かまきり しょうず'],
        26 => ['腐れたる草蛍となる', 'くされたるくさ ほたるとなる'],
        27 => ['梅のみ黄ばむ',       'うめのみ きばむ'],
        28 => ['乃東枯る',           'なつかれくさ かるる'],
        29 => ['菖蒲はなさく',       'あやめ はなさく'],
        30 => ['半夏生ず',           'はんげ しょうず'],
        31 => ['温風至る',           'あつかぜ いたる'],
        32 => ['蓮始めて開く',       'はす はじめてひらく'],
        33 => ['鷹乃ちわざをならう', 'たかすなわち わざをならう'],
        34 => ['桐始めて花を結ぶ',   'きりはじめて はなをむすぶ'],
        35 => ['土潤いてむし暑し',   'つちうるおいて むしあつし'],
        36 => ['大雨時々に降る',     'たいう ときどきにふる'],
        37 => ['涼風至る',           'すずかぜ いたる'],
        38 => ['寒蝉鳴く',           'ひぐらし なく'],
        39 => ['深き霧まとう',       'ふかききり まとう'],
        40 => ['綿のはなしべ開く',   'わたの はなしべひらく'],
        41 => ['天地始めてさむし',   'てんち はじめてさむし'],
        42 => ['禾乃ちみのる',       'こくもの すなわちみのる'],
        43 => ['草露白し',           'くさつゆ しろし'],
        44 => ['鶺鴒鳴く',           'せきれい なく'],
        45 => ['玄鳥去る',           'つばめ さる'],
        46 => ['雷乃ち声を収む',     'かみなりすなわち こえをおさむ'],
        47 => ['虫かくれて戸をふさぐ', 'むしかくれて とをふさぐ'],
        48 => ['水始めて涸る',       'みず はじめてかるる'],
        49 => ['鴻雁来る',           'こうがん きたる'],
        50 => ['菊花開く',           'きくのはな ひらく'],
        51 => ['蟋蟀戸にあり',       'きりぎりす とにあり'],
        52 => ['霜始めて降る',       'しも はじめてふる'],
        53 => ['小雨ときどきふる',   'こさめ ときどきふる'],
        54 => ['楓蔦黄ばむ',         'もみじつた きばむ'],
        55 => ['山茶始めて開く',     'つばき はじめてひらく'],
        56 => ['地始めて凍る',       'ち はじめてこおる'],
        57 => ['金盞香',             'きんせんか さく'],
        58 => ['虹かくれて見えず',   'にじ かくれてみえず'],
        59 => ['朔風葉を払う',       'きたかぜ このはをはらう'],
        60 => ['橘始めて黄ばむ',     'たちばな はじめてきばむ'],
        61 => ['閉塞冬となる',       'そらさむく ふゆとなる'],
        62 => ['熊穴にこもる',       'くま あなにこもる'],
        63 => ['さけの魚群がる',     'さけのうお むらがる'],
        64 => ['乃東生ず',           'なつかれくさ しょうず'],
        65 => ['さわしかの角おつる', 'さわしかのつの おつる'],
        66 => ['雪下りて麦のびる',   'ゆきくだりて むぎのびる'],
        67 => ['芹乃ち栄う',         'せりすなわち さかう'],
        68 => ['泉水温をふくむ',     'しみず あたたかをふくむ'],
        69 => ['雉始めてなく',       'きじ はじめてなく'],
        70 => ['款冬華く',           'ふきの はなさく'],
        71 => ['水沢氷つめる',       'さわみず こおりつめる'],
        72 => ['鶏始めてとやにつく', 'にわとり はじめてとやにつく'],
    ];

    /**
     * 候種別（初候・次候・末候）の名称配列。インデックス 0〜2 に対応。
     *
     * @var string[]
     */
    private const KOU_TYPE_TEXT = ['初候', '次候', '末候'];

    /**
     * SimpleSolarTerm / SolarTerm で取得した節気日付のキャッシュ。
     * キー: "{year}_{solarTermConst}"、値: Unix タイムスタンプ（0時0分0秒）。
     *
     * @var array<string, int>
     */
    private array $solarTermCache = [];

    /**
     * SeventyTwoKouCalculator のシングルトンインスタンス。
     *
     * @var self|null
     */
    private static ?self $instance = null;

    /**
     * シングルトンファクトリメソッド。
     *
     * @return static
     */
    public static function factory(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 指定日付が属する七十二候の番号（1〜72）を返します。
     *
     * 立春初候が 1、大寒末候が 72 です。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 対象日付
     * @return int 七十二候番号（1〜72）
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getKouNumber(DateTime|DateTimeImmutable $date): int
    {
        [$kouIndex, $kouType] = $this->findKouIndexAndType($date);

        return $kouIndex * 3 + $kouType + 1;
    }

    /**
     * 七十二候番号（1〜72）に対応する現代七十二候名称を返します。
     *
     * 例: 1 → "東風凍を解く"、64 → "乃東生ず"
     *
     * @param int $kouNumber 七十二候番号（1〜72）
     * @return string 七十二候名称
     */
    public function getKouText(int $kouNumber): string
    {
        return self::KOU_DATA[$kouNumber][0] ?? '';
    }

    /**
     * 七十二候番号（1〜72）に対応する読みを返します。
     *
     * 例: 1 → "はるかぜ こおりをとく"
     *
     * @param int $kouNumber 七十二候番号（1〜72）
     * @return string 七十二候の読み
     */
    public function getKouReading(int $kouNumber): string
    {
        return self::KOU_DATA[$kouNumber][1] ?? '';
    }

    /**
     * 七十二候番号（1〜72）に対応する候種別文字列を返します。
     *
     * 返り値は "初候"、"次候"、"末候" のいずれかです。
     *
     * @param int $kouNumber 七十二候番号（1〜72）
     * @return string 候種別（"初候" / "次候" / "末候"）
     */
    public function getKouType(int $kouNumber): string
    {
        $zeroBasedType = ($kouNumber - 1) % 3;

        return self::KOU_TYPE_TEXT[$zeroBasedType];
    }

    /**
     * 指定日付の次の七十二候が始まる日の Unix タイムスタンプ（0時0分0秒）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 対象日付
     * @return int 次候開始日の Unix タイムスタンプ
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getNextKouStartTimestamp(DateTime|DateTimeImmutable $date): int
    {
        [, $kouType, $currentTermTs, $nextTermTs] = $this->findKouIndexAndType($date);

        $boundaries = $this->calcKouBoundaries($currentTermTs, $nextTermTs);

        if ($kouType < 2) {
            // 同じ節気内の次候へ
            return $boundaries[$kouType + 1];
        }

        // 末候 → 次の節気の初候（= 次の節気の開始日）
        return $nextTermTs;
    }

    /**
     * 指定日付の一つ前の七十二候が始まる日の Unix タイムスタンプ（0時0分0秒）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 対象日付
     * @return int 前候開始日の Unix タイムスタンプ
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getPreviousKouStartTimestamp(DateTime|DateTimeImmutable $date): int
    {
        [$kouIndex, $kouType, $currentTermTs, $nextTermTs] = $this->findKouIndexAndType($date);

        $boundaries = $this->calcKouBoundaries($currentTermTs, $nextTermTs);

        if ($kouType > 0) {
            // 同じ節気内の前候の開始日
            return $boundaries[$kouType - 1];
        }

        // 初候 → 一つ前の節気（$kouIndex - 1 の節気）の末候開始日を求める
        [, $prevTermTs, $prevNextTermTs] = $this->findPreviousSolarTermInfo($date, $kouIndex);
        $prevBoundaries = $this->calcKouBoundaries($prevTermTs, $prevNextTermTs);

        return $prevBoundaries[2]; // 末候開始日
    }

    /**
     * 対象日付が属する七十二候インデックス（0〜23）・候タイプ（0〜2）・
     * 当該節気開始タイムスタンプ・次節気開始タイムスタンプを返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 対象日付
     * @return array{0: int, 1: int, 2: int, 3: int} [kouIndex, kouType, currentTermTs, nextTermTs]
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function findKouIndexAndType(DateTime|DateTimeImmutable $date): array
    {
        $dateTs = $this->normalizeDayTs($date->year, $date->month, $date->day);

        // 対象年の前後 1 年分の節気日付を収集してソート
        $terms = $this->collectSortedTerms($date->year);

        // 対象日付以下の最後の節気を探す
        $currentIdx = 0;
        foreach ($terms as $i => $term) {
            if ($term['ts'] <= $dateTs) {
                $currentIdx = $i;
            } else {
                break;
            }
        }

        $currentTermTs = $terms[$currentIdx]['ts'];
        $kouIndex = $terms[$currentIdx]['kou_index'];
        $nextTermTs = $terms[$currentIdx + 1]['ts'] ?? ($currentTermTs + 16 * 86400);

        $boundaries = $this->calcKouBoundaries($currentTermTs, $nextTermTs);

        if ($dateTs < $boundaries[1]) {
            $kouType = 0; // 初候
        } elseif ($dateTs < $boundaries[2]) {
            $kouType = 1; // 次候
        } else {
            $kouType = 2; // 末候
        }

        return [$kouIndex, $kouType, $currentTermTs, $nextTermTs];
    }

    /**
     * 指定節気インデックスの一つ前の節気情報（前インデックス・開始ts・次開始ts）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 基準日付（年の特定に使用）
     * @param int $kouIndex 現在の候インデックス（0〜23）
     * @return array{0: int, 1: int, 2: int} [prevKouIndex, prevTermTs, prevNextTermTs]
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    private function findPreviousSolarTermInfo(DateTime|DateTimeImmutable $date, int $kouIndex): array
    {
        $terms = $this->collectSortedTerms($date->year);

        // 現在の節気の開始 ts を特定
        $dateTs = $this->normalizeDayTs($date->year, $date->month, $date->day);
        $currentTermTs = 0;
        $foundIdx = 0;
        foreach ($terms as $i => $term) {
            if ($term['ts'] <= $dateTs && $term['kou_index'] === $kouIndex) {
                $currentTermTs = $term['ts'];
                $foundIdx = $i;
            }
        }

        $prevIdx = $foundIdx - 1;
        $prevTermTs = $terms[$prevIdx]['ts'];
        $prevKouIndex = $terms[$prevIdx]['kou_index'];
        $prevNextTermTs = $currentTermTs;

        return [$prevKouIndex, $prevTermTs, $prevNextTermTs];
    }

    /**
     * 指定年を中心に前後 1 年分の節気日付をタイムスタンプ昇順で収集します。
     *
     * @param int $year 基準年
     * @return array<int, array{ts: int, kou_index: int}>
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    private function collectSortedTerms(int $year): array
    {
        $terms = [];
        foreach ([$year - 1, $year, $year + 1] as $y) {
            foreach (self::KOU_SOLAR_TERM_ORDER as $kouIdx => $termConst) {
                $ts = $this->getSolarTermTimestamp($termConst, $y);
                $terms[] = ['ts' => $ts, 'kou_index' => $kouIdx];
            }
        }

        usort($terms, static fn (array $a, array $b): int => $a['ts'] <=> $b['ts']);

        return array_values($terms);
    }

    /**
     * 節気の開始日と終了日から初候・次候・末候の境界タイムスタンプ配列を計算します。
     *
     * 境界は必ず 0時0分0秒（日の始まり）に揃えます。
     * 節気期間の日数を3等分して各候の開始日を決定します。
     *
     * @param int $startTs 節気開始日（0時0分0秒）の Unix タイムスタンプ
     * @param int $endTs   次節気開始日（0時0分0秒）の Unix タイムスタンプ
     * @return array{0: int, 1: int, 2: int} [初候start, 次候start, 末候start]
     */
    private function calcKouBoundaries(int $startTs, int $endTs): array
    {
        $totalDays = intdiv($endTs - $startTs, 86400);

        return [
            $startTs,                                              // 初候 start（= 節気初日）
            $startTs + intdiv($totalDays, 3) * 86400,             // 次候 start
            $startTs + intdiv($totalDays * 2, 3) * 86400,         // 末候 start
        ];
    }

    /**
     * 指定節気定数・年の入節日を Unix タイムスタンプ（0時0分0秒）で返します。
     * 結果はインスタンス内にキャッシュされます。
     *
     * @param int $solarTermConst 節気定数（{@see \JapaneseDate\DateTime::SOLAR_TERM_RISSYUN} 等）
     * @param int $year 西暦年
     * @return int Unix タイムスタンプ（0時0分0秒）
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    private function getSolarTermTimestamp(int $solarTermConst, int $year): int
    {
        $cacheKey = $year . '_' . $solarTermConst;
        if (isset($this->solarTermCache[$cacheKey])) {
            return $this->solarTermCache[$cacheKey];
        }

        $stDate = $this->fetchSolarTermDate($solarTermConst, $year);
        $ts = $this->normalizeDayTs($stDate->year, $stDate->month, $stDate->day);

        $this->solarTermCache[$cacheKey] = $ts;

        return $ts;
    }

    /**
     * SimpleSolarTerm → SolarTerm の順でフォールバックして節気日付を取得します。
     *
     * @param int $solarTermConst 節気定数
     * @param int $year 西暦年
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    private function fetchSolarTermDate(int $solarTermConst, int $year): SolarTermDate
    {
        try {
            $calc = new SimpleSolarTerm();

            return $calc->getSolarTerm($year, $solarTermConst);
        } catch (Throwable) {
            $calc = new SolarTerm();

            return $calc->getSolarTerm($year, $solarTermConst);
        }
    }

    /**
     * 年・月・日から日の始まり（0時0分0秒 JST）の Unix タイムスタンプを返します。
     *
     * @param int $year  年
     * @param int $month 月
     * @param int $day   日
     * @return int Unix タイムスタンプ
     */
    private function normalizeDayTs(int $year, int $month, int $day): int
    {
        return mktime(0, 0, 0, $month, $day, $year);
    }
}
