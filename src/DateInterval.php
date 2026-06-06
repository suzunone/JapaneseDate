<?php

/**
 * DateInterval.php
 *
 * 日本暦に対応した期間（インターバル）クラス。
 * CarbonIntervalを継承し、営業日計算・和暦・六曜・二十四節気・旧暦などの
 * 日本固有の暦体系に基づく期間操作機能を提供します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateInterval
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace JapaneseDate;

use Carbon\CarbonInterval;
use InvalidArgumentException;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\Components\Moon;
use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\Components\SolarTerm;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Traits\DateBusinessCommon;
use Throwable;

/**
 * 日本暦に対応した期間（インターバル）クラス。
 *
 * CarbonInterval を継承し、以下の日本固有の機能を追加しています。
 *
 * **営業日計算**
 * - 国民の祝日・休日を正確にスキップした N 営業日後／前の日時算出
 * - 次の祝日までの残り期間の取得
 *
 * **六曜**
 * - 指定した六曜（大安・仏滅など）までの残り期間の取得
 *
 * **元号（和暦）**
 * - 指定した元号が継続した期間（何年何ヶ月何日）の算出
 *
 * **二十四節気**
 * - 次の節気（または指定節気）までの残り期間の取得
 * - 節気単位での日時加算・減算
 * - 保持する日数幅を節気数に換算
 *
 * **旧暦・月相**
 * - 朔望月（新月から次の新月）を基準とした旧暦月数への換算
 *
 * 【使用例】
 * ```php
 * use JapaneseDate\DateInterval;
 * use JapaneseDate\DateTime;
 *
 * // 2026-05-01 から 5 営業日後を取得する
 * $from = DateTime::parse('2026-05-01');
 * $result = DateInterval::addBusinessDaysToDate($from, 5);
 * echo $result->format('Y-m-d');
 *
 * // 次の祝日まで何日あるかを取得する
 * $interval = DateInterval::untilNextHoliday(DateTime::now());
 * echo $interval->days;
 *
 * // 次の大安までの残り期間を取得する
 * $interval = DateInterval::untilNextSixWeek(DateTime::now(), DateTime::SIX_WEEKDAY_TAIAN);
 *
 * // 令和の継続期間を取得する
 * $interval = DateInterval::eraSpan(DateTime::ERA_REIWA);
 * echo $interval->y . '年';
 *
 * // 次の春分までの残り期間を取得する
 * $interval = DateInterval::untilNextSolarTerm(DateTime::now());
 * ```
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateInterval
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */
class DateInterval extends CarbonInterval
{
    use DateBusinessCommon;

    /**
     * 朔望月の平均日数（新月から次の新月までの平均日数）。
     *
     * @var float
     */
    public const SYNODIC_MONTH_DAYS = 29.530588853;

    /**
     * 二十四節気1周期の平均日数（太陽黄経15度分）。
     *
     * @var float
     */
    public const SOLAR_TERM_AVG_DAYS = 15.2184375;

    /**
     * 元号の開始日（西暦）。
     *
     * キーは DateTime::ERA_* 定数、値は元号の開始年。
     * 元号年の計算は「西暦年 - 開始年 + 1」で求められます。
     *
     * @var array<int, string>
     */
    protected const ERA_START_DATES = [
        DateTime::ERA_MEIJI => '1868-01-25',
        DateTime::ERA_TAISHO => '1912-07-30',
        DateTime::ERA_SHOWA => '1926-12-25',
        DateTime::ERA_HEISEI => '1989-01-08',
        DateTime::ERA_REIWA => '2019-05-01',
    ];

    /**
     * 元号の終了日（次の元号の前日）。
     *
     * キーは DateTime::ERA_* 定数、値は元号の終了日（null の場合は現在日まで）。
     *
     * @var array<int, string|null>
     */
    protected const ERA_END_DATES = [
        DateTime::ERA_MEIJI => '1912-07-29',
        DateTime::ERA_TAISHO => '1926-12-24',
        DateTime::ERA_SHOWA => '1989-01-07',
        DateTime::ERA_HEISEI => '2019-04-30',
        DateTime::ERA_REIWA => null,
    ];

    /**
     * 二十四節気のメソッド名と定数のマッピング。
     *
     * SimpleSolarTerm / SolarTerm クラスの各メソッド名が配列キー、
     * DateTime::SOLAR_TERM_* 定数が配列値となっています。
     *
     * @var array<string, int>
     */
    protected const SOLAR_TERM_METHODS = [
        'syunbun' => DateTime::SOLAR_TERM_SYUNBUN,
        'seimei' => DateTime::SOLAR_TERM_SEIMEI,
        'kokuu' => DateTime::SOLAR_TERM_KOKUU,
        'rikka' => DateTime::SOLAR_TERM_RIKKA,
        'syouman' => DateTime::SOLAR_TERM_SYOUMAN,
        'bousyu' => DateTime::SOLAR_TERM_BOUSYU,
        'geshi' => DateTime::SOLAR_TERM_GESHI,
        'syousyo' => DateTime::SOLAR_TERM_SYOUSYO,
        'taisyo' => DateTime::SOLAR_TERM_TAISYO,
        'rissyuu' => DateTime::SOLAR_TERM_RISSYUU,
        'syosyo' => DateTime::SOLAR_TERM_SYOSYO,
        'hakuro' => DateTime::SOLAR_TERM_HAKURO,
        'syuubun' => DateTime::SOLAR_TERM_SYUUBUN,
        'kanro' => DateTime::SOLAR_TERM_KANRO,
        'soukou' => DateTime::SOLAR_TERM_SOUKOU,
        'rittou' => DateTime::SOLAR_TERM_RITTOU,
        'syousetsu' => DateTime::SOLAR_TERM_SYOUSETSU,
        'taisetsu' => DateTime::SOLAR_TERM_TAISETSU,
        'touji' => DateTime::SOLAR_TERM_TOUJI,
        'syoukan' => DateTime::SOLAR_TERM_SYOUKAN,
        'daikan' => DateTime::SOLAR_TERM_DAIKAN,
        'rissyun' => DateTime::SOLAR_TERM_RISSYUN,
        'usui' => DateTime::SOLAR_TERM_USUI,
        'keichitsu' => DateTime::SOLAR_TERM_KEICHITSU,
    ];

    // =========================================================================
    // 営業日計算
    // =========================================================================

    /**
     * 基準日から N 営業日後の {@see DateTime} オブジェクトを返します。
     *
     * 「営業日」とは、土曜・日曜・日本の国民の祝日・休日（振替休日・国民の休日を含む）を
     * 除いたすべての日を指します。
     * 計算はループにより 1 日ずつ進め、非営業日をスキップします。
     *
     * 【使用例】
     * ```php
     * // 2026-05-01 から 3 営業日後を取得する
     * $from = DateTime::parse('2026-05-01');
     * $result = DateInterval::addBusinessDaysToDate($from, 3);
     * echo $result->format('Y-m-d');
     * ```
     *
     * @param \JapaneseDate\DateTime $from 起算日
     * @param int $n 加算する営業日数（1 以上の整数）
     * @return \JapaneseDate\DateTime N 営業日後の日付
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function addBusinessDaysToDate($from, $n): DateTime
    {
        $date = DateTime::factory($from);
        $count = 0;
        while ($count < $n) {
            $date = $date->addDay();
            if (static::isBusinessDay($date)) {
                $count++;
            }
        }

        return $date;
    }

    /**
     * 基準日から N 営業日前の {@see DateTime} オブジェクトを返します。
     *
     * 「営業日」とは、土曜・日曜・日本の国民の祝日・休日（振替休日・国民の休日を含む）を
     * 除いたすべての日を指します。
     * 計算はループにより 1 日ずつ遡り、非営業日をスキップします。
     *
     * 【使用例】
     * ```php
     * // 2026-05-08 から 3 営業日前を取得する
     * $from = DateTime::parse('2026-05-08');
     * $result = DateInterval::subBusinessDaysToDate($from, 3);
     * echo $result->format('Y-m-d');
     * ```
     *
     * @param \JapaneseDate\DateTime $from 起算日
     * @param int $n 減算する営業日数（1 以上の整数）
     * @return \JapaneseDate\DateTime N 営業日前の日付
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function subBusinessDaysToDate($from, $n): DateTime
    {
        $date = DateTime::factory($from);
        $count = 0;
        while ($count < $n) {
            $date = $date->subDay();
            if (static::isBusinessDay($date)) {
                $count++;
            }
        }

        return $date;
    }

    /**
     * 指定した日時が営業日かどうかを判定します。
     *
     * 土曜（dayOfWeek === 6）、日曜（dayOfWeek === 0）、および国民の祝日・休日は
     * 非営業日とみなします。
     *
     * @param \JapaneseDate\DateTime $date 判定対象の日付
     * @return bool 営業日であれば true、非営業日であれば false
     */
    public static function isBusinessDay($date): bool
    {
        if ($date->dayOfWeek === 0 || $date->dayOfWeek === 6) {
            return false;
        }

        return !$date->is_holiday;
    }

    // =========================================================================
    // 次の祝日までの残り期間
    // =========================================================================

    /**
     * 基準日時から次の日本の祝日・休日（振替休日・国民の休日を含む）までの
     * 残り期間を {@see DateInterval} として返します。
     *
     * 「次の祝日」とは {@see DateTime::nextHoliday()} が返す日の翌日 00:00:00 を
     * 基準とした差分です。
     *
     * 【使用例】
     * ```php
     * $interval = DateInterval::untilNextHoliday(DateTime::now());
     * echo $interval->days . '日後';
     * echo $interval->h . '時間後';
     * ```
     *
     * @param \JapaneseDate\DateTime $from カウントダウン基準日時
     * @return static 次の祝日（当日 00:00:00）までの {@see DateInterval}
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function untilNextHoliday($from)
    {
        $base = DateTime::factory($from);
        $nextHoliday = $base->copy()->nextHoliday()->startOfDay();
        $diff = $base->diff($nextHoliday);

        return static::instance(CarbonInterval::days($diff->days));
    }

    // =========================================================================
    // 六曜ベースの残り期間
    // =========================================================================

    /**
     * 基準日時から指定した六曜が次に到来するまでの残り期間を
     * {@see DateInterval} として返します。
     *
     * 基準日が既に指定した六曜である場合、次の同じ六曜（6日後）までの期間を返します。
     *
     * 【使用例】
     * ```php
     * // 次の大安までの残り期間を取得する
     * $interval = DateInterval::untilNextSixWeek(DateTime::now(), DateTime::SIX_WEEKDAY_TAIAN);
     * echo $interval->days . '日後が大安です';
     *
     * // 次の仏滅までの残り期間を取得する
     * $interval = DateInterval::untilNextSixWeek(DateTime::now(), DateTime::SIX_WEEKDAY_BUTSUMETSU);
     * ```
     *
     * @param \JapaneseDate\DateTime $from カウントダウン基準日時
     * @param int $sixWeekday 目的の六曜（{@see DateTime::SIX_WEEKDAY_TAIAN} など）
     * @return static 指定六曜の翌到来日（当日 00:00:00）までの {@see DateInterval}
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function untilNextSixWeek($from, $sixWeekday)
    {
        $base = DateTime::factory($from);
        $current = $base->sixWeekday;
        if ($current < $sixWeekday) {
            $daysToAdd = $sixWeekday - $current;
        } else {
            // 同じ六曜は「次の」六曜として 6 日後を返す
            $daysToAdd = (6 - $current + $sixWeekday) % 6;
            if ($daysToAdd === 0) {
                $daysToAdd = 6;
            }
        }

        $target = $base->copy()->addDays($daysToAdd)->startOfDay();
        $diff = $base->diff($target);

        return static::instance(CarbonInterval::days($diff->days));
    }

    // =========================================================================
    // 元号（和暦）ベースの期間
    // =========================================================================

    /**
     * 指定した元号が継続した期間（開始日から終了日まで）を {@see DateInterval} として返します。
     *
     * 終了日が指定されていない元号（令和など現在も継続中の元号）については、
     * 第二引数 $until で基準日時を指定できます。省略した場合は現在日時が使用されます。
     *
     * 【使用例】
     * ```php
     * // 昭和の継続期間を取得する
     * $interval = DateInterval::eraSpan(DateTime::ERA_SHOWA);
     * echo $interval->y . '年' . $interval->m . 'ヶ月' . $interval->d . '日';
     *
     * // 令和が現在まで継続した期間を取得する
     * $interval = DateInterval::eraSpan(DateTime::ERA_REIWA);
     *
     * // 令和が特定日まで継続した期間を取得する
     * $interval = DateInterval::eraSpan(DateTime::ERA_REIWA, DateTime::parse('2026-01-01'));
     * ```
     *
     * @param int $eraKey 元号定数（{@see DateTime::ERA_MEIJI} など）
     * @param \JapaneseDate\DateTime|null $until 終了日（null の場合は現在日時）
     * @return static 元号の継続期間を表す {@see DateInterval}
     */
    public static function eraSpan($eraKey, $until = null)
    {
        if (!isset(static::ERA_START_DATES[$eraKey])) {
            throw new InvalidArgumentException('不明な元号キーです: ' . $eraKey);
        }

        $start = DateTime::parse(static::ERA_START_DATES[$eraKey]);
        $endStr = static::ERA_END_DATES[$eraKey];
        if ($endStr === null) {
            $end = $until ?? DateTime::now();
        } else {
            $end = DateTime::parse($endStr);
        }

        return static::instance($start->diff($end));
    }

    // =========================================================================
    // 二十四節気ベースの期間
    // =========================================================================

    /**
     * 基準日時から次に到来する二十四節気（または指定した節気）までの
     * 残り期間を {@see DateInterval} として返します。
     *
     * 節気名を指定しない場合は、24 節気すべてのうち最も近い次の節気を検索します。
     * 節気名を指定する場合は、SimpleSolarTerm / SolarTerm クラスのメソッド名
     * （'syunbun', 'geshi' など）を渡してください。
     *
     * 【使用例】
     * ```php
     * // 次に到来する節気までの残り期間を取得する
     * $interval = DateInterval::untilNextSolarTerm(DateTime::now());
     * echo $interval->days . '日後が次の節気です';
     *
     * // 次の夏至までの残り期間を取得する
     * $interval = DateInterval::untilNextSolarTerm(DateTime::now(), 'geshi');
     * ```
     *
     * @param \JapaneseDate\DateTime $from カウントダウン基準日時
     * @param string|null $termMethod 節気メソッド名（省略時は最も近い節気を自動検索）
     * @return static 次の節気日（当日 00:00:00）までの {@see DateInterval}
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function untilNextSolarTerm($from, $termMethod = null)
    {
        $target = static::findNextSolarTermDate($from, $termMethod);
        $diff = $from->diff($target->startOfDay());

        return static::instance(CarbonInterval::days($diff->days));
    }

    /**
     * 基準日から N 節気後の {@see DateTime} を返します。
     *
     * 単純な「15日 × N」ではなく、天文学的計算に基づく正確な節気の
     * 切り替わり日を N 個分進めた日付を返します。
     *
     * 【使用例】
     * ```php
     * // 現在から 3 節気後の日付を取得する
     * $from = DateTime::now();
     * $result = DateInterval::addSolarTermsToDate($from, 3);
     * echo $result->format('Y-m-d');
     * ```
     *
     * @param \JapaneseDate\DateTime $from 起算日
     * @param int $n 進める節気の数（1 以上の整数）
     * @return \JapaneseDate\DateTime N 節気後の日付
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function addSolarTermsToDate($from, $n): DateTime
    {
        $date = DateTime::factory($from);
        for ($i = 0; $i < $n; $i++) {
            $date = static::findNextSolarTermDate($date);
        }

        return $date;
    }

    /**
     * 基準日から N 節気前の {@see DateTime} を返します。
     *
     * 単純な「15日 × N」ではなく、天文学的計算に基づく正確な節気の
     * 切り替わり日を N 個分遡った日付を返します。
     *
     * 【使用例】
     * ```php
     * // 現在から 2 節気前の日付を取得する
     * $from = DateTime::now();
     * $result = DateInterval::subSolarTermsToDate($from, 2);
     * echo $result->format('Y-m-d');
     * ```
     *
     * @param \JapaneseDate\DateTime $from 起算日
     * @param int $n 遡る節気の数（1 以上の整数）
     * @return \JapaneseDate\DateTime N 節気前の日付
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function subSolarTermsToDate($from, $n): DateTime
    {
        $date = DateTime::factory($from);
        for ($i = 0; $i < $n; $i++) {
            $date = static::findPrevSolarTermDate($date);
        }

        return $date;
    }

    /**
     * このインターバルの総日数を二十四節気の周期数（約15日を1単位）に換算して返します。
     *
     * 「2節気分」のように日本の伝統的な季節の区切り単位でインターバルを
     * 表現したい場合に使用します。結果は小数点以下を含む浮動小数点数です。
     *
     * 【使用例】
     * ```php
     * $interval = CarbonInterval::days(30);
     * $solarTermInterval = DateInterval::instance($interval);
     * echo round($solarTermInterval->toSolarTermCount(), 1) . '節気分';
     * // => 約 1.97 節気分
     * ```
     *
     * @return float 節気数（{@see self::SOLAR_TERM_AVG_DAYS} を1単位とした換算値）
     */
    public function toSolarTermCount(): float
    {
        $totalDays = $this->totalDays;

        return $totalDays / self::SOLAR_TERM_AVG_DAYS;
    }

    // =========================================================================
    // 旧暦・月相ベースの期間
    // =========================================================================

    /**
     * このインターバルの総日数を朔望月（新月から次の新月まで、約29.5日）の
     * 数に換算して返します。
     *
     * 旧暦の「1ヶ月」を正確に定義するため、平均的な29.530588853日を1単位として
     * 換算します。結果は小数点以下を含む浮動小数点数です。
     *
     * 【使用例】
     * ```php
     * $interval = CarbonInterval::days(59);
     * $lunarInterval = DateInterval::instance($interval);
     * echo round($lunarInterval->toLunarMonthCount(), 1) . '旧暦月分';
     * // => 約 2.0 旧暦月分
     * ```
     *
     * @return float 朔望月数（{@see self::SYNODIC_MONTH_DAYS} を1単位とした換算値）
     */
    public function toLunarMonthCount(): float
    {
        $totalDays = $this->totalDays;

        return $totalDays / self::SYNODIC_MONTH_DAYS;
    }

    /**
     * 基準日時から次の新月（月相: MOON_PHASE_SHINGETSU）までの
     * 残り期間を {@see DateInterval} として返します。
     *
     * 天文学的な新月（月の位相角 0°付近）の瞬間を基準に、
     * 次の新月日（当日 00:00:00）までの差分を返します。
     *
     * 【使用例】
     * ```php
     * $interval = DateInterval::untilNextNewMoon(DateTime::now());
     * echo $interval->days . '日後が次の新月です';
     * ```
     *
     * @param \JapaneseDate\DateTime $from カウントダウン基準日時
     * @return static 次の新月日（当日 00:00:00）までの {@see DateInterval}
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public static function untilNextNewMoon($from)
    {
        $moon = new Moon();
        $nextNewMoon = $moon->moonPhase(DateTime::factory($from), 0.0)->setTimezone('Asia/Tokyo');
        $target = DateTime::factory($nextNewMoon)->startOfDay();
        $diff = $from->diff($target);

        return static::instance($diff);
    }

    // =========================================================================
    // 内部ヘルパー
    // =========================================================================

    /**
     * 基準日の「次」に到来する節気日を返します。
     *
     * 今年・来年の全節気を走査し、基準日の翌日以降で最も近い節気日を返します。
     * 特定の節気メソッド名を指定した場合はその節気のみを対象とします。
     *
     * @param \JapaneseDate\DateTime $from 起算日
     * @param string|null $termMethod 節気メソッド名（省略時は全節気から検索）
     * @return \JapaneseDate\DateTime 次の節気日
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    protected static function findNextSolarTermDate($from, $termMethod = null): DateTime
    {
        $methods = $termMethod !== null ? [$termMethod] : array_keys(static::SOLAR_TERM_METHODS);
        $fromTimestamp = $from->timestamp;
        $best = null;

        foreach ([$from->year, $from->year + 1] as $year) {
            foreach ($methods as $method) {
                try {
                    $st = static::resolveSolarTerm($method, $year);
                    $candidate = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $st->year, $st->month, $st->day));
                    // @codeCoverageIgnoreStart
                    if ($candidate === false) {
                        continue;
                    }
                    // @codeCoverageIgnoreEnd
                    $candidate = $candidate->startOfDay();
                    if ($candidate->timestamp > $fromTimestamp
                        && ($best === null || $candidate->timestamp < $best->timestamp)) {
                        $best = $candidate;
                    }
                    // @codeCoverageIgnoreStart
                } catch (Throwable $exception) {
                    continue;
                }
                // @codeCoverageIgnoreEnd
            }
        }

        // @codeCoverageIgnoreStart
        return $best ?? DateTime::factory($from)->addDays(15);
    }

    /**
     * 基準日の「直前」の節気日を返します。
     *
     * 今年・前年の全節気を走査し、基準日の前日以前で最も近い節気日を返します。
     * 特定の節気メソッド名を指定した場合はその節気のみを対象とします。
     *
     * @param \JapaneseDate\DateTime $from 起算日
     * @param string|null $termMethod 節気メソッド名（省略時は全節気から検索）
     * @return \JapaneseDate\DateTime 直前の節気日
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    protected static function findPrevSolarTermDate($from, $termMethod = null): DateTime
    {
        $methods = $termMethod !== null ? [$termMethod] : array_keys(static::SOLAR_TERM_METHODS);
        $fromTimestamp = $from->timestamp;
        $best = null;

        foreach ([$from->year, $from->year - 1] as $year) {
            foreach ($methods as $method) {
                try {
                    $st = static::resolveSolarTerm($method, $year);
                    $candidate = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $st->year, $st->month, $st->day));
                    // @codeCoverageIgnoreStart
                    if ($candidate === false) {
                        continue;
                    }
                    // @codeCoverageIgnoreEnd
                    $candidate = $candidate->startOfDay();
                    if ($candidate->timestamp < $fromTimestamp
                        && ($best === null || $candidate->timestamp > $best->timestamp)) {
                        $best = $candidate;
                    }
                    // @codeCoverageIgnoreStart
                } catch (Throwable $exception) {
                    continue;
                }
                // @codeCoverageIgnoreEnd
            }
        }

        // @codeCoverageIgnoreStart
        return $best ?? DateTime::factory($from)->subDays(15);
    }

    /**
     * 指定した節気メソッド名と年から {@see \JapaneseDate\Elements\SolarTermDate} を返します。
     *
     * まず {@see SimpleSolarTerm} での高速計算を試みて、失敗した場合は
     * {@see SolarTerm} での精密計算にフォールバックします。
     *
     * @param string $method 節気メソッド名（'syunbun', 'geshi' など）
     * @param int    $year   西暦年
     * @return \JapaneseDate\Elements\SolarTermDate 節気日データ
     * @throws \JapaneseDate\Exceptions\SolarTermException 計算不可能な年の場合
     */
    protected static function resolveSolarTerm($method, $year): SolarTermDate
    {
        if (Astronomy::solarAlgorithm() === Astronomy::SOLAR_VSOP87) {
            return (new SolarTerm())->{$method}($year);
        }

        try {
            return (new SimpleSolarTerm())->{$method}($year);
        } catch (Throwable $exception) {
            return (new SolarTerm())->{$method}($year);
        }
    }

    /**
     * 基準日から指定した営業日数後の日付を算出します。
     *
     * 営業日の判定にはインスタンス個別設定（またはグローバル/デフォルト設定）を使用します。
     *
     * @param  \JapaneseDate\DateTime $baseDate    計算の基準となる日付
     * @param  int                    $businessDays 加算する営業日数
     * @param  DateBusiness|null      $config       判定に使用する設定（省略時はインスタンス設定）
     * @return \JapaneseDate\DateTime N営業日後の日付
     */
    public function addBusinessDaysTo($baseDate, $businessDays, $config = null): DateTime
    {
        $effectiveConfig = $config ?? $this->businessConfig;
        $dt = clone $baseDate;
        $count = 0;
        while ($count < $businessDays) {
            $dt->addDay();
            if (BusinessCalendar::isBusinessDay($dt, $effectiveConfig)) {
                $count++;
            }
        }

        return $dt;
    }

    /**
     * 基準日から指定した営業日数前の日付を算出します。
     *
     * @param  \JapaneseDate\DateTime $baseDate    計算の基準となる日付
     * @param  int                    $businessDays 減算する営業日数
     * @param  DateBusiness|null      $config       判定に使用する設定（省略時はインスタンス設定）
     * @return \JapaneseDate\DateTime N営業日前の日付
     */
    public function subBusinessDaysFrom($baseDate, $businessDays, $config = null): DateTime
    {
        $effectiveConfig = $config ?? $this->businessConfig;
        $dt = clone $baseDate;
        $count = 0;
        while ($count < $businessDays) {
            $dt->subDay();
            if (BusinessCalendar::isBusinessDay($dt, $effectiveConfig)) {
                $count++;
            }
        }

        return $dt;
    }

    /**
     * 2つの日付間の営業日数を計算します。
     *
     * @param \DateTimeInterface $start 開始日
     * @param \DateTimeInterface $end 終了日
     * @param DateBusiness|null $config 判定に使用する設定（省略時はインスタンス設定）
     * @return int 営業日数（start以上end以下の営業日の数）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function countBusinessDaysBetween($start, $end, $config = null): int
    {
        $effectiveConfig = $config ?? $this->businessConfig;
        $dt = DateTime::factory($start->format('Y-m-d'), $start->getTimezone());
        $endKey = $end->format('Ymd');
        $count = 0;
        while ($dt->format('Ymd') <= $endKey) {
            if (BusinessCalendar::isBusinessDay($dt, $effectiveConfig)) {
                $count++;
            }
            $dt->addDay();
        }

        return $count;
    }
}
