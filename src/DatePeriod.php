<?php

/**
 * DatePeriod.php
 *
 * 日本暦に対応した期間イテレータクラス。
 * CarbonPeriodを継承し、営業日・六曜・二十四節気・旧暦・元号などの
 * 日本固有の暦体系に基づく期間フィルタリング・生成機能を提供します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DatePeriod
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace JapaneseDate;

use Carbon\CarbonPeriod;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\Components\Moon;
use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\DateBusiness;
use JapaneseDate\Components\SolarTerm;
use JapaneseDate\Traits\DateBusinessCommon;
use Throwable;

/**
 * 日本暦に対応した期間イテレータクラス。
 *
 * CarbonPeriod を継承し、以下の日本固有の機能を追加しています。
 * フィルタメソッドはすべてメソッドチェーンで接続でき、
 * `foreach` ループで直接利用可能なイテレータを返します。
 *
 * **国民の祝日・休日フィルタ**
 * - 期間内の祝日・休日のみを抽出 (`onlyHolidays()`)
 * - 期間内の祝日・休日を除外（営業日候補のみ）(`withoutHolidays()`)
 * - 土日のみを除外 (`withoutWeekends()`)
 * - 土日と祝日を除外した平日のみ (`onlyWeekdays()`)
 *
 * **五十日（ごとおび）フィルタ**
 * - 日本の商習慣における決済日（5・10・15・20・25・月末）かつ営業日のみを抽出 (`onlyGotobi()`)
 *
 * **六曜フィルタ**
 * - 指定した六曜（大安・友引など）のみを抽出 (`onlySixWeekday()`)
 * - 指定した六曜を除外 (`withoutSixWeekday()`)
 *
 * **雑節・節気フィルタ**
 * - 土用期間内の日付のみを抽出 (`onlyDoyo()`)
 * - 彼岸期間内の日付のみを抽出 (`onlyHigan()`)
 *
 * **二十四節気区切りのイテレータ生成**
 * - 節気の切り替わりをステップとするイテレータを生成 (`eachSolarTerm()`)
 *
 * **旧暦月ごとのイテレータ生成**
 * - 旧暦の朔日（新月）をステップとするイテレータを生成 (`eachLunarMonth()`)
 *
 * **元号関連**
 * - 元号ごとに期間を分割 (`splitByEra()`)
 * - 和暦年度（4月〜翌3月）ごとのイテレータを生成 (`eachJapaneseFiscalYear()`)
 *
 * 【使用例: 2026年度の祝日のみを取得する】
 * ```php
 * use JapaneseDate\DatePeriod;
 * use JapaneseDate\DateTime;
 *
 * $period = DatePeriod::create('2026-04-01', '1 day', '2027-03-31')
 *     ->onlyHolidays();
 *
 * foreach ($period as $date) {
 *     echo $date->format('Y-m-d') . ' ' . $date->holidayText . PHP_EOL;
 * }
 * ```
 *
 * 【使用例: 2026年度の大安のみを取得する】
 * ```php
 * $period = DatePeriod::create('2026-04-01', '1 day', '2027-03-31')
 *     ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN);
 * ```
 *
 * 【使用例: 2026年の節気区切りでイテレートする】
 * ```php
 * $period = DatePeriod::eachSolarTerm(
 *     DateTime::parse('2026-01-01'),
 *     DateTime::parse('2026-12-31')
 * );
 * foreach ($period as $date) {
 *     echo $date->format('Y-m-d') . ' ' . $date->solarTermText . PHP_EOL;
 * }
 * ```
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DatePeriod
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */
class DatePeriod extends CarbonPeriod
{
    use DateBusinessCommon;

    /**
     * 元号の開始日（西暦）のマッピング。
     *
     * キーは DateTime::ERA_* 定数、値は元号の開始日文字列です。
     *
     * @var array<int, string>
     */
    protected const ERA_START_DATES = [
        DateTime::ERA_MEIJI  => '1868-01-25',
        DateTime::ERA_TAISHO => '1912-07-30',
        DateTime::ERA_SHOWA  => '1926-12-25',
        DateTime::ERA_HEISEI => '1989-01-08',
        DateTime::ERA_REIWA  => '2019-05-01',
    ];

    /**
     * 元号の終了日（次の元号の前日）のマッピング。
     *
     * null の場合は現在も継続中の元号を示します。
     *
     * @var array<int, string|null>
     */
    protected const ERA_END_DATES = [
        DateTime::ERA_MEIJI  => '1912-07-29',
        DateTime::ERA_TAISHO => '1926-12-24',
        DateTime::ERA_SHOWA  => '1989-01-07',
        DateTime::ERA_HEISEI => '2019-04-30',
        DateTime::ERA_REIWA  => null,
    ];

    // =========================================================================
    // 祝日・休日フィルタ
    // =========================================================================

    /**
     * 期間内の日本の祝日・休日（振替休日・国民の休日を含む）のみを
     * 抽出するフィルタを追加します。
     *
     * {@see DateTime::is_holiday} が true の日だけをイテレートできるようになります。
     *
     * 【使用例】
     * ```php
     * $holidays = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlyHolidays();
     *
     * foreach ($holidays as $date) {
     *     echo $date->format('Y-m-d') . ' ' . $date->holidayText . PHP_EOL;
     * }
     * ```
     *
     * @return static 祝日のみを抽出するフィルタを追加した {@see DatePeriod}
     */
    public function onlyHolidays()
    {
        return $this->addFilter(static function ($date): bool {
            return DateTime::factory($date)->is_holiday;
        });
    }

    /**
     * 期間内の日本の祝日・休日（振替休日・国民の休日を含む）を除外する
     * フィルタを追加します。
     *
     * 祝日でない日のみをイテレートできるようになります。
     * 土日を一緒に除外したい場合は {@see withoutWeekends()} または
     * {@see onlyWeekdays()} と組み合わせてください。
     *
     * 【使用例】
     * ```php
     * // 祝日を除外した全日をイテレートする
     * $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
     *     ->withoutHolidays();
     * ```
     *
     * @return static 祝日を除外するフィルタを追加した {@see DatePeriod}
     */
    public function withoutHolidays()
    {
        return $this->addFilter(static function ($date): bool {
            $jd = DateTime::factory($date);

            return !$jd->is_holiday;
        });
    }

    /**
     * 期間内の土曜・日曜を除外するフィルタを追加します。
     *
     * 祝日は除外しません。祝日も除外したい場合は {@see onlyWeekdays()} を使用してください。
     *
     * 【使用例】
     * ```php
     * $weekdayPeriod = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
     *     ->withoutWeekends();
     * ```
     *
     * @return static 土日を除外するフィルタを追加した {@see DatePeriod}
     */
    public function withoutWeekends()
    {
        return $this->addFilter(static function ($date): bool {
            return $date->dayOfWeek !== 0 && $date->dayOfWeek !== 6;
        });
    }

    /**
     * 期間内の土曜・日曜・祝日・休日をすべて除外し、
     * 純粋な平日（月〜金かつ非祝日）のみを抽出するフィルタを追加します。
     *
     * 「営業日候補」として使用する場合に便利です。
     *
     * 【使用例】
     * ```php
     * $businessDays = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
     *     ->onlyWeekdays();
     *
     * echo count(iterator_to_array($businessDays)) . '営業日';
     * ```
     *
     * @return static 土日・祝日を除外するフィルタを追加した {@see DatePeriod}
     */
    public function onlyWeekdays()
    {
        return $this->withoutWeekends()->withoutHolidays();
    }

    // =========================================================================
    // 五十日（ごとおび）フィルタ
    // =========================================================================

    /**
     * 期間内の五十日（ごとおび）かつ銀行営業日の日付のみを抽出するフィルタを追加します。
     *
     * 「五十日」とは日本の商習慣における決済日で、月の 5・10・15・20・25 日と月末日を指します。
     * 土日祝に当たる場合の調整方法を $adjust パラメータで指定できます。
     *
     * - `'none'`  : 調整なし（土日祝の五十日はそのまま除外）
     * - `'prev'`  : 前倒し（土日祝の場合は直前の営業日に移動）
     * - `'next'`  : 後倒し（土日祝の場合は翌営業日に移動）
     *
     * 【使用例】
     * ```php
     * // 2026年の五十日（調整なし）を取得する
     * $gotobiDates = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlyGotobi('none');
     *
     * // 土日祝の場合は前日に前倒しして取得する
     * $gotobiDates = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlyGotobi('prev');
     * ```
     *
     * @param string $adjust 土日祝の調整方法（'none', 'prev', 'next'）
     * @return static 五十日フィルタを追加した {@see DatePeriod}
     */
    public function onlyGotobi($adjust = 'none')
    {
        return $this->addFilter(static function ($date) use ($adjust): bool {
            $jd = DateTime::factory($date);
            $day = $jd->day;
            $isGotobi = in_array($day, [5, 10, 15, 20, 25], true) || $day === $jd->daysInMonth;

            if (!$isGotobi) {
                return false;
            }

            $isBusinessDay = $jd->dayOfWeek !== 0 && $jd->dayOfWeek !== 6 && !$jd->is_holiday;

            if ($adjust === 'none') {
                return $isBusinessDay;
            }

            if ($isBusinessDay) {
                return true;
            }

            // 調整あり: 代替日を求めて、その代替日がこの日と一致するかを確認する
            if ($adjust === 'prev') {
                $candidate = DateTime::factory($jd);
                while ($candidate->dayOfWeek === 0 || $candidate->dayOfWeek === 6 || $candidate->is_holiday) {
                    $candidate = $candidate->subDay();
                }
                // 代替日がこの日と同じ月の場合のみ有効とする
                return $candidate->format('Y-m-d') === $jd->format('Y-m-d');
            }

            if ($adjust === 'next') {
                $candidate = DateTime::factory($jd);
                while ($candidate->dayOfWeek === 0 || $candidate->dayOfWeek === 6 || $candidate->is_holiday) {
                    $candidate = $candidate->addDay();
                }

                return $candidate->format('Y-m-d') === $jd->format('Y-m-d');
            }

            return false;
        });
    }

    // =========================================================================
    // 六曜フィルタ
    // =========================================================================

    /**
     * 期間内の指定した六曜の日のみを抽出するフィルタを追加します。
     *
     * 複数の六曜を指定することで、いずれかに該当する日をすべて抽出できます。
     *
     * 【使用例】
     * ```php
     * // 大安のみを取得する（ブライダル、地鎮祭などのスケジュール調整に）
     * $taian = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN);
     *
     * // 大安・友引のみを取得する
     * $lucky = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN, DateTime::SIX_WEEKDAY_TOMOBIKI);
     * ```
     *
     * @param int ...$sixWeekdays 抽出する六曜定数（{@see DateTime::SIX_WEEKDAY_TAIAN} など）
     * @return static 六曜フィルタを追加した {@see DatePeriod}
     */
    public function onlySixWeekday(...$sixWeekdays)
    {
        return $this->addFilter(static function ($date) use ($sixWeekdays): bool {
            $jd = DateTime::factory($date);

            return in_array($jd->six_weekday, $sixWeekdays, true);
        });
    }

    /**
     * 期間内の指定した六曜の日を除外するフィルタを追加します。
     *
     * 複数の六曜を指定することで、いずれかに該当する日をすべて除外できます。
     *
     * 【使用例】
     * ```php
     * // 仏滅を除外する
     * $period = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU);
     *
     * // 仏滅・赤口を除外する
     * $period = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU, DateTime::SIX_WEEKDAY_SYAKKOU);
     * ```
     *
     * @param int ...$sixWeekdays 除外する六曜定数（{@see DateTime::SIX_WEEKDAY_BUTSUMETSU} など）
     * @return static 六曜除外フィルタを追加した {@see DatePeriod}
     */
    public function withoutSixWeekday(...$sixWeekdays)
    {
        return $this->addFilter(static function ($date) use ($sixWeekdays): bool {
            $jd = DateTime::factory($date);

            return !in_array($jd->six_weekday, $sixWeekdays, true);
        });
    }

    // =========================================================================
    // 雑節フィルタ
    // =========================================================================

    /**
     * 期間内の土用（各季節の前の約18日間）に含まれる日付のみを抽出するフィルタを追加します。
     *
     * 「土用」とは立春・立夏・立秋・立冬のそれぞれ18日前から節気当日の前日までの期間です。
     * 1年間に4回の土用があります。
     *
     * 「土用の丑の日」や「土用干し」などの伝統的な期間の判定に使用します。
     *
     * 【使用例】
     * ```php
     * // 2026年の土用期間の日付を取得する
     * $doyoDays = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlyDoyo();
     *
     * foreach ($doyoDays as $date) {
     *     echo $date->format('Y-m-d') . PHP_EOL;
     * }
     * ```
     *
     * @return static 土用フィルタを追加した {@see DatePeriod}
     */
    public function onlyDoyo()
    {
        return $this->addFilter(static function ($date): bool {
            $jd = DateTime::factory($date);

            return static::isInDoyo($jd);
        });
    }

    /**
     * 期間内の彼岸（春分・秋分を中日とした各7日間）に含まれる日付のみを抽出するフィルタを追加します。
     *
     * 「彼岸」は春分の日（春彼岸）と秋分の日（秋彼岸）をそれぞれ中日として、
     * 前後3日間を含む計7日間の期間です。
     *
     * 【使用例】
     * ```php
     * // 2026年の彼岸期間の日付を取得する
     * $higanDays = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
     *     ->onlyHigan();
     * ```
     *
     * @return static 彼岸フィルタを追加した {@see DatePeriod}
     */
    public function onlyHigan()
    {
        return $this->addFilter(static function ($date): bool {
            $jd = DateTime::factory($date);

            return static::isInHigan($jd);
        });
    }

    // =========================================================================
    // 二十四節気区切りのイテレータ
    // =========================================================================

    /**
     * 開始日から終了日までを二十四節気の切り替わりをステップとする
     * {@see DatePeriod} を生成して返します。
     *
     * 各ステップは固定の日数ではなく、天文学的計算に基づく正確な節気の切り替わり日
     * （14日〜16日の可変幅）となります。
     *
     * 開始日が節気日でない場合は、直後の最初の節気日から順次イテレートします。
     *
     * 【使用例】
     * ```php
     * // 2026年の節気区切りでイテレートする（立春→雨水→啓蟄…）
     * $period = DatePeriod::eachSolarTerm(
     *     DateTime::parse('2026-01-01'),
     *     DateTime::parse('2026-12-31')
     * );
     *
     * foreach ($period as $date) {
     *     echo $date->format('Y-m-d') . ' ' . $date->solarTermText . PHP_EOL;
     * }
     * ```
     *
     * @param \JapaneseDate\DateTime $start  イテレート開始の基準日
     * @param \JapaneseDate\DateTime $end    イテレート終了日（この日を含む）
     * @return static 節気区切りの {@see DatePeriod}
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public static function eachSolarTerm($start, $end)
    {
        $dates = static::collectSolarTermDates($start, $end);
        if (empty($dates)) {
            return static::create($start, '1 day', $start->copy()->subDay());
        }

        return static::createFromDatesArray($dates);
    }

    /**
     * 開始日から指定した月数分の旧暦月（朔日〜晦日）を 1 ステップとする
     * {@see DatePeriod} を生成して返します。
     *
     * 各ステップは旧暦の朔日（新月）の日付です。
     * 旧正月・旧お盆・十五夜などの伝統行事の期間走査に使用します。
     *
     * 【使用例】
     * ```php
     * // 2026年1月から6ヶ月分の旧暦月の朔日を取得する
     * $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), 6);
     *
     * foreach ($period as $date) {
     *     $jd = DateTime::factory($date);
     *     echo $date->format('Y-m-d') . ' 旧暦' . $jd->lunarYear . '年'
     *          . $jd->lunarMonth . '月朔日' . PHP_EOL;
     * }
     * ```
     *
     * @param \JapaneseDate\DateTime $start   イテレート開始日（この日を含む旧暦月の朔日から開始）
     * @param int                    $months  イテレートする旧暦月数
     * @return static 旧暦月朔日区切りの {@see DatePeriod}
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public static function eachLunarMonth($start, $months)
    {
        $dates = static::collectLunarNewMoonDates($start, $months);
        if (empty($dates)) {
            return static::create($start, '1 day', $start->copy()->subDay());
        }

        return static::createFromDatesArray($dates);
    }

    // =========================================================================
    // 元号関連
    // =========================================================================

    /**
     * 期間（DatePeriod）を元号の切り替わりタイミングで複数のサブ期間に分割します。
     *
     * 例えば 1988年〜1990年の期間を渡した場合、
     * 「昭和63年1月1日〜昭和64年1月7日」と「平成元年1月8日〜平成2年12月31日」の
     * 2つの DatePeriod の配列を返します。
     *
     * 各 DatePeriod のキーは元号定数（{@see DateTime::ERA_MEIJI} など）です。
     *
     * 【使用例】
     * ```php
     * $fullPeriod = DatePeriod::create('1988-01-01', '1 day', '1990-12-31');
     * $split = $fullPeriod->splitByEra();
     *
     * foreach ($split as $eraKey => $subPeriod) {
     *     $eraName = DateTime::parse($subPeriod->getStartDate()->format('Y-m-d'))->eraNameText;
     *     echo $eraName . ': ';
     *     echo $subPeriod->getStartDate()->format('Y-m-d') . ' 〜 ';
     *     echo $subPeriod->getEndDate()->format('Y-m-d') . PHP_EOL;
     * }
     * ```
     *
     * @return array<int, static> 元号定数をキーとした {@see DatePeriod} の配列
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function splitByEra(): array
    {
        $startDate = DateTime::factory($this->getStartDate());
        $endDate = DateTime::factory($this->getEndDate());

        $result = [];
        $eraKeys = array_keys(static::ERA_START_DATES);
        sort($eraKeys);

        foreach ($eraKeys as $eraKey) {
            $eraStart = DateTime::parse(static::ERA_START_DATES[$eraKey]);
            $eraEndStr = static::ERA_END_DATES[$eraKey];
            $eraEnd = $eraEndStr !== null ? DateTime::parse($eraEndStr) : DateTime::now();

            // 期間と元号が重なる部分を求める
            $subStart = $startDate->gt($eraStart) ? $startDate : $eraStart;
            $subEnd = $endDate->lt($eraEnd) ? $endDate : $eraEnd;

            if ($subStart->lte($subEnd)) {
                $result[$eraKey] = static::create(
                    $subStart->format('Y-m-d'),
                    $this->getDateInterval(),
                    $subEnd->format('Y-m-d')
                );
            }
        }

        return $result;
    }

    /**
     * 和暦年度（4月1日〜翌3月31日）を 1 ステップとする {@see DatePeriod} を生成します。
     *
     * 日本の官公庁・企業で使用される「令和X年度」「平成Y年度」などの
     * 和暦年度を基準にした年度の開始日（4月1日）を順次返します。
     *
     * 【使用例】
     * ```php
     * // 令和5年度〜令和8年度（2023〜2026年度）の年度開始日を取得する
     * $period = DatePeriod::eachJapaneseFiscalYear(2023, 2026);
     *
     * foreach ($period as $date) {
     *     $jd = DateTime::factory($date);
     *     echo $jd->eraNameText . $jd->eraYear . '年度 ('
     *         . $date->format('Y/m/d') . '〜' . ($date->year + 1) . '/03/31)' . PHP_EOL;
     * }
     * ```
     *
     * @param int $startFiscalYear  開始年度の西暦年（その年の4月1日〜翌3月31日）
     * @param int $endFiscalYear    終了年度の西暦年（この年度を含む）
     * @return static 和暦年度開始日区切りの {@see DatePeriod}
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public static function eachJapaneseFiscalYear($startFiscalYear, $endFiscalYear)
    {
        $dates = [];
        for ($year = $startFiscalYear; $year <= $endFiscalYear; $year++) {
            $dates[] = DateTime::parse(sprintf('%04d-04-01', $year));
        }

        if (empty($dates)) {
            $start = DateTime::parse(sprintf('%04d-04-01', $startFiscalYear));

            return static::create($start, '1 day', $start->copy()->subDay());
        }

        return static::createFromDatesArray($dates);
    }

    // =========================================================================
    // 内部ヘルパー
    // =========================================================================

    /**
     * 指定期間内に含まれる二十四節気の日付をすべて収集して返します。
     *
     * 対象期間を年単位で走査し、各節気の日付が期間内に含まれるかを判定します。
     *
     * @param \JapaneseDate\DateTime $start  検索開始日
     * @param \JapaneseDate\DateTime $end    検索終了日
     * @return \JapaneseDate\DateTime[] 節気日の配列（昇順）
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected static function collectSolarTermDates($start, $end): array
    {
        $dates = [];
        $startTs = $start->startOfDay()->timestamp;
        $endTs = $end->endOfDay()->timestamp;

        for ($year = $start->year; $year <= $end->year + 1; $year++) {
            try {
                $terms = static::resolveSolarTerms($year);
                // @codeCoverageIgnoreStart
            } catch (Throwable $exception) {
                continue;
            }
            // @codeCoverageIgnoreEnd

            foreach ($terms as $termDate) {
                $candidate = DateTime::createFromFormat(
                    'Y-m-d',
                    sprintf('%04d-%02d-%02d', $termDate->year, $termDate->month, $termDate->day)
                );
                // @codeCoverageIgnoreStart
                if ($candidate === false) {
                    continue;
                }
                // @codeCoverageIgnoreEnd
                $ts = $candidate->startOfDay()->timestamp;
                if ($ts >= $startTs && $ts <= $endTs) {
                    $dates[] = DateTime::factory($candidate)->startOfDay();
                }
            }
        }

        usort($dates, static function ($a, $b) {
            return $a->timestamp <=> $b->timestamp;
        });

        return $dates;
    }

    /**
     * 指定した開始日から、指定月数分の旧暦朔日（新月）の日付を収集して返します。
     *
     * Moon コンポーネントを使用して天文学的な新月の瞬間を計算します。
     *
     * @param \JapaneseDate\DateTime $start   検索開始日
     * @param int                    $months  収集する月数
     * @return \JapaneseDate\DateTime[] 新月日の配列
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected static function collectLunarNewMoonDates($start, $months): array
    {
        $moon = new Moon();
        $dates = [];
        $startTs = $start->startOfDay()->timestamp;

        // 開始日以降の最初の新月を求める（is_next=false で次の新月を取得）
        $searchBase = DateTime::factory($start)->subDays(2);
        $newMoon = $moon->moonPhase($searchBase, 0.0);
        $current = DateTime::factory($newMoon)->startOfDay();

        // 開始日より前の新月だった場合はさらに次の新月へ進む
        if ($current->timestamp < $startTs) {
            $searchFrom = DateTime::factory($newMoon)->addDays(28);
            $newMoon = $moon->moonPhase($searchFrom, 0.0);
            $current = DateTime::factory($newMoon)->startOfDay();
        }

        for ($i = 0; $i < $months; $i++) {
            $dates[] = DateTime::factory($current);
            // 次の新月を求める（約28日後から検索、is_next=false で次の新月を取得）
            $searchFrom = DateTime::factory($current)->addDays(28);
            $newMoon = $moon->moonPhase($searchFrom, 0.0);
            $current = DateTime::factory($newMoon)->startOfDay();
        }

        return $dates;
    }

    /**
     * 指定した年の二十四節気データをすべて取得します。
     *
     * まず {@see SimpleSolarTerm} での高速計算を試み、失敗した場合は
     * {@see SolarTerm} での精密計算にフォールバックします。
     *
     * @param int $year 西暦年
     * @return \JapaneseDate\Elements\SolarTermDate[] 節気データの配列（キーは節気定数）
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected static function resolveSolarTerms($year): array
    {
        try {
            return (new SimpleSolarTerm())->getSolarTerms($year);
        } catch (Throwable $exception) {
            return (new SolarTerm())->getSolarTerms($year);
        }
    }

    /**
     * 配列形式の日付リストから {@see DatePeriod} を生成します。
     *
     * 内部的に各日付を固定ステップとして扱い、
     * `foreach` でイテレートできる DatePeriod を返します。
     *
     * @param \JapaneseDate\DateTime[] $dates 日付の配列
     * @return static 配列の日付を順次返す {@see DatePeriod}
     */
    protected static function createFromDatesArray($dates)
    {
        // CarbonPeriod の filters を利用して配列から生成する
        // @codeCoverageIgnoreStart
        if (empty($dates)) {
            return static::create('now', '1 day', 'now')->addFilter(static function () {
                return false;
            });
        }
        // @codeCoverageIgnoreEnd

        $start = reset($dates);
        $end = end($dates);

        return static::create($start, '1 day', $end)->addFilter(static function ($date) use ($dates): bool {
            $ts = $date->startOfDay()->timestamp;
            foreach ($dates as $d) {
                if ($d->startOfDay()->timestamp === $ts) {
                    return true;
                }
            }

            return false;
        });
    }

    /**
     * 指定した日時が土用期間（立春・立夏・立秋・立冬の各18日前から節気前日まで）に
     * 含まれるかどうかを判定します。
     *
     * 内部では {@see \JapaneseDate\Components\MiscSeasonalNode::isDoyo()} に委譲します。
     *
     * @param \JapaneseDate\DateTime $date 判定対象の日付
     * @return bool 土用期間内であれば true
     */
    protected static function isInDoyo($date): bool
    {
        return MiscSeasonalNode::factory()->isDoyo($date);
    }

    /**
     * 指定した日時が彼岸期間（春分・秋分を中日とした各前後3日間、計7日間）に
     * 含まれるかどうかを判定します。
     *
     * 内部では {@see \JapaneseDate\Components\MiscSeasonalNode::isHigan()} に委譲します。
     *
     * @param \JapaneseDate\DateTime $date 判定対象の日付
     * @return bool 彼岸期間内であれば true
     */
    protected static function isInHigan($date): bool
    {
        return MiscSeasonalNode::factory()->isHigan($date);
    }

    /**
     * 期間内の営業日のみを含む新しい DatePeriod を返します。
     *
     * 営業日の判定にはインスタンス個別設定（またはグローバル/デフォルト設定）を使用します。
     * メソッドチェーンで他のフィルタと組み合わせることができます。
     *
     * **使用例:**
     * ```php
     * $period = DatePeriod::create('2026-04-01', '1 day', '2026-04-30')
     *     ->onlyBusinessDays();
     * foreach ($period as $date) {
     *     echo $date->format('Y-m-d') . PHP_EOL;
     * }
     * ```
     *
     * @param  DateBusiness|null $config 判定に使用する設定（省略時はインスタンス/グローバル設定）
     * @return static 営業日のみに絞り込まれた新しい DatePeriod インスタンス
     */
    public function onlyBusinessDays($config = null)
    {
        $effectiveConfig = $config ?? $this->businessConfig;

        return $this->filter(static function ($date) use ($effectiveConfig): bool {
            $dt = $date instanceof DateTime ? $date : DateTime::factory($date->format('Y-m-d'), $date->getTimezone());

            return BusinessCalendar::isBusinessDay($dt, $effectiveConfig);
        });
    }

    /**
     * 期間内から営業日を除いた（休業日のみの）新しい DatePeriod を返します。
     *
     * メソッドチェーンで他のフィルタと組み合わせることができます。
     *
     * @param  DateBusiness|null $config 判定に使用する設定（省略時はインスタンス/グローバル設定）
     * @return static 休業日のみに絞り込まれた新しい DatePeriod インスタンス
     */
    public function withoutBusinessDays($config = null)
    {
        $effectiveConfig = $config ?? $this->businessConfig;

        return $this->filter(static function ($date) use ($effectiveConfig): bool {
            $dt = $date instanceof DateTime ? $date : DateTime::factory($date->format('Y-m-d'), $date->getTimezone());

            return !BusinessCalendar::isBusinessDay($dt, $effectiveConfig);
        });
    }
}
