<?php

/**
 * Calendar.php
 *
 * 様々な除外条件（設定）に基づいて、特定の期間や月の営業日・日付オブジェクトの配列を生成するクラス。
 * 旧来の bypass 系 API に加え、{@link \JapaneseDate\DateBusiness} を用いた
 * 柔軟な営業日カレンダー設定にも対応しています。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Calendar
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0
 */

namespace JapaneseDate;

use Carbon\CarbonTimeZone;
use DateInterval;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\Exceptions\NativeDateTimeException;
use JapaneseDate\Traits\DateBusinessCommon;

/**
 * 様々な除外条件（設定）に基づいて、特定の期間や月の営業日・日付オブジェクトの配列を生成するクラス。
 *
 * 旧来の bypass 系 API と、{@link DateBusiness} を使った新しい
 * 営業日カレンダー設定の両方をサポートしています。
 *
 * **bypass 系 API（旧来方式）**
 * - 特定の曜日・日付・祝日をスキップする条件を個別に積み上げる方式。
 * - {@link addBypassWeekDay()} / {@link addBypassDay()} / {@link setBypassHoliday()} で設定し、
 *   {@link getWorkingDay()} / {@link getWorkingDayBySpan()} で取得します。
 *
 * **DateBusiness カレンダー API（新方式）**
 * - {@link DateBusiness} オブジェクトで曜日・祝日・第XX曜日・特定日・
 *   フィルタ・マクロを優先順位付きで柔軟に組み合わせられます。
 * - {@link setBusinessConfig()} でインスタンス個別設定を、
 *   {@link BusinessCalendar::setGlobalConfig} でグローバル設定を指定します。
 * - {@link getBusinessDaysBySpan()} / {@link getBusinessDaysByLimit()} / {@link isBusinessDayByConfig()} で取得・判定します。
 *
 * 【bypass 系 使用例: 土日祝と特定日を除外した5営業日を取得する】
 * ```php
 * use JapaneseDate\Calendar;
 *
 * $calendar = new Calendar();
 * $days = $calendar
 *     ->addBypassWeekDay(Calendar::SATURDAY)
 *     ->addBypassWeekDay(Calendar::SUNDAY)
 *     ->setBypassHoliday(true)
 *     ->addBypassDay('2026-05-01')
 *     ->getWorkingDay(5);
 * ```
 *
 * 【DateBusiness カレンダー 使用例: 夏期休暇・第3水曜定休を加えた営業日取得】
 * ```php
 * use JapaneseDate\Calendar;
 * use JapaneseDate\DateBusiness;
 *
 * $config = (new DateBusiness())
 *     ->setClosingWeekdays([0, 6])
 *     ->setBypassHoliday(true)
 *     ->addClosingDate('2026-08-15', '夏期休暇')
 *     ->addClosingNthWeekday(3, 3, '第3水曜定休');
 *
 * $calendar = new Calendar('2026-08-10');
 * $calendar->setBusinessConfig($config);
 * $days = $calendar->getBusinessDaysByLimit(5);
 * ```
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Calendar
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0
 */
class Calendar
{
    use DateBusinessCommon;

    /**
     * 日曜日を表す曜日定数。
     *
     * {@link addBypassWeekDay()} に渡す曜日番号として使用します。
     *
     * @var int
     */
    public const SUNDAY = 0;

    /**
     * 月曜日を表す曜日定数。
     *
     * @var int
     */
    public const MONDAY = 1;

    /**
     * 火曜日を表す曜日定数。
     *
     * @var int
     */
    public const TUESDAY = 2;

    /**
     * 水曜日を表す曜日定数。
     *
     * @var int
     */
    public const WEDNESDAY = 3;

    /**
     * 木曜日を表す曜日定数。
     *
     * @var int
     */
    public const THURSDAY = 4;

    /**
     * 金曜日を表す曜日定数。
     *
     * @var int
     */
    public const FRIDAY = 5;

    /**
     * 土曜日を表す曜日定数。
     *
     * @var int
     */
    public const SATURDAY = 6;

    /**
     * 取得開始日時。
     *
     * コンストラクタで指定した基準日が格納されます。
     *
     * @var DateTime|DateTimeInterface
     */
    protected DateTime|DateTimeInterface $start_time_stamp;

    /**
     * タイムゾーン。
     *
     * 開始日時から自動的に取得されます。
     *
     * @var DateTimeZone|CarbonTimeZone|false
     */
    protected DateTimeZone|false|CarbonTimeZone $timezone;

    /**
     * スキップする曜日の連想配列（bypass 系 API 用）。
     *
     * キーは曜日番号（0=日曜〜6=土曜）、値は `true`。
     *
     * @var array<int, bool>
     */
    protected array $bypass_week_day_arr = [];

    /**
     * スキップする日付の連想配列（bypass 系 API 用）。
     *
     * キーは `Ymd` 形式の整数、値は {@link DateTime} オブジェクト。
     *
     * @var array<int, DateTime>
     */
    protected array $bypass_day_arr = [];

    /**
     * 祝日をスキップするかどうか（bypass 系 API 用）。
     *
     * `true` の場合、国民の祝日・休日を営業日から除外します。
     *
     * @var bool
     */
    protected bool $is_bypass_holiday = false;

    /**
     * Calendar コンストラクタ。
     *
     * 日付/時刻 文字列の書式については
     * {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式}
     * を参考にしてください。
     *
     * @param int|float|string|DateTimeInterface $time 基準となる日付オブジェクト、Unix タイムスタンプ、または日付文字列（省略時は現在日時）
     * @param DateTimeZone|null $timezone タイムゾーン（省略時は PHP のデフォルトタイムゾーン）
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    public function __construct(int|float|string|DateTimeInterface $time = 'now', DateTimeZone|null $timezone = null)
    {
        $this->start_time_stamp = $this->createDateTime($time, $timezone);
        $this->timezone = $this->start_time_stamp->getTimezone();
    }

    /**
     * 指定した日付/時刻から {@link DateTime} インスタンスを生成します（内部ヘルパー）。
     *
     * @param int|float|string|DateTimeInterface $date_time 日付/時刻
     * @param DateTimeZone|null $time_zone タイムゾーン
     * @return DateTime
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    protected function createDateTime(int|float|string|DateTimeInterface $date_time, DateTimeZone|null $time_zone = null): DateTimeInterface
    {
        return DateTime::factory($date_time, $time_zone);
    }

    /**
     * スキップする曜日を追加します（bypass 系 API）。
     *
     * 曜日番号は 0（日曜）〜 6（土曜）、またはクラス定数（`Calendar::SATURDAY` など）で指定します。
     *
     * **使用例:**
     * ```php
     * $calendar->addBypassWeekDay(Calendar::SATURDAY)->addBypassWeekDay(Calendar::SUNDAY);
     * ```
     *
     * @param int $val スキップする曜日（0=日曜〜6=土曜）
     * @return $this メソッドチェーン用に自身を返します
     */
    public function addBypassWeekDay(int $val): self
    {
        $this->bypass_week_day_arr[$val] = true;

        return $this;
    }

    /**
     * 指定月の全日付配列を取得します。
     *
     * コンストラクタで指定した日付が属する月の、1日から月末までの
     * {@link DateTime} 配列を返します。
     *
     * **使用例:**
     * ```php
     * $calendar = new Calendar('2026-05-15');
     * $days = $calendar->getDatesOfMonth(); // 2026年5月1日〜31日
     * ```
     *
     * @return DateTime[] 月内の全日付の配列
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    public function getDatesOfMonth(): array
    {
        $dateTime = DateTime::factory($this->start_time_stamp);

        $dateTime->setDate($dateTime->year, $dateTime->month, 1);
        $compare_month = $dateTime->format('m');
        $res = [];

        while ($dateTime->format('m') === $compare_month) {
            $res[] = clone $dateTime;
            $dateTime->add(new DateInterval('P1D'));
        }

        return $res;
    }

    /**
     * スキップする曜日を削除します（bypass 系 API）。
     *
     * 登録されていない曜日を指定した場合は何もしません。
     *
     * @param int $val 削除する曜日（0=日曜〜6=土曜）
     * @return $this メソッドチェーン用に自身を返します
     */
    public function removeBypassWeekDay(int $val): self
    {
        if (isset($this->bypass_week_day_arr[$val])) {
            unset($this->bypass_week_day_arr[$val]);
        }

        return $this;
    }

    /**
     * スキップする曜日をすべてリセットします（bypass 系 API）。
     *
     * @return $this メソッドチェーン用に自身を返します
     */
    public function resetBypassWeekDay(): self
    {
        $this->bypass_week_day_arr = [];

        return $this;
    }

    /**
     * スキップする日付を追加します（bypass 系 API）。
     *
     * 日付/時刻 文字列の書式については
     * {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式}
     * を参考にしてください。
     *
     * **使用例:**
     * ```php
     * $calendar->addBypassDay('2026-05-01')->addBypassDay('2026-08-15');
     * ```
     *
     * @param int|float|string|DateTimeInterface $time スキップする日付
     * @return $this メソッドチェーン用に自身を返します
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    public function addBypassDay(int|float|string|DateTimeInterface $time): self
    {
        $val = $this->createDateTime($time, $this->timezone);

        $this->bypass_day_arr[$this->getCompareFormat($val)] = $val;

        return $this;
    }

    /**
     * 日付を比較用の整数値（`Ymd` 形式）に変換します（内部ヘルパー）。
     *
     * @param DateTimeInterface $dateTime
     * @return int `Ymd` 形式の整数値（例: `20260525`）
     */
    protected function getCompareFormat(DateTimeInterface $dateTime): int
    {
        return (int) $dateTime->format('Ymd');
    }

    /**
     * スキップする日付を削除します（bypass 系 API）。
     *
     * 登録されていない日付を指定した場合は何もしません。
     *
     * @param int|float|string|DateTimeInterface $time 削除する日付
     * @return $this メソッドチェーン用に自身を返します
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    public function removeBypassDay(int|float|string|DateTimeInterface $time): self
    {
        $val = $this->createDateTime($time, $this->timezone);
        if (isset($this->bypass_day_arr[$this->getCompareFormat($val)])) {
            unset($this->bypass_day_arr[$this->getCompareFormat($val)]);
        }

        return $this;
    }

    /**
     * スキップする日付をすべてリセットします（bypass 系 API）。
     *
     * @return $this メソッドチェーン用に自身を返します
     */
    public function resetBypassDay(): self
    {
        $this->bypass_day_arr = [];

        return $this;
    }

    /**
     * 祝日をスキップするかどうかを設定します（bypass 系 API）。
     *
     * `true` を設定すると、国民の祝日・休日が {@link getWorkingDay()} などの
     * 結果から除外されます。
     *
     * @param bool $bypass `true` で祝日を除外、`false` で祝日を営業日として扱う
     * @return $this メソッドチェーン用に自身を返します
     */
    public function setBypassHoliday(bool $bypass): self
    {
        $this->is_bypass_holiday = $bypass;

        return $this;
    }

    /**
     * 期間内の営業日を取得します（bypass 系 API）。
     *
     * 開始日（コンストラクタで指定）から `$jdt_end` までの範囲で、
     * bypass 系の設定（曜日・特定日・祝日）を除外した営業日の配列を返します。
     *
     * 日付/時刻 文字列の書式については
     * {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式}
     * を参考にしてください。
     *
     * @param int|float|string|DateTimeInterface $jdt_end 取得終了日
     * @return DateTime[]
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    public function getWorkingDayBySpan(int|float|string|DateTimeInterface $jdt_end): array
    {
        $jdt_end_datetime = $this->createDateTime($jdt_end);
        $japaneseDateTime = clone $this->start_time_stamp;
        $end_compare = $this->getCompareFormat($jdt_end_datetime);

        $res = [];
        while ($this->getCompareFormat($japaneseDateTime) <= $end_compare) {
            if ($this->isWorkingDay($japaneseDateTime)) {
                $res[] = clone $japaneseDateTime;
            }
            $japaneseDateTime->add(new DateInterval('P1D'));
        }

        return $res;
    }

    /**
     * 指定した日付が bypass 系の設定に基づいて営業日かどうかを判定します（bypass 系 API 内部用）。
     *
     * @param DateTime|DateTimeImmutable $dateTime 判定対象の日付
     * @return bool 営業日であれば true
     */
    protected function isWorkingDay(DateTime|DateTimeImmutable $dateTime): bool
    {
        return match (true) {
            array_key_exists($dateTime->dayOfWeek, $this->bypass_week_day_arr),
            isset($this->bypass_day_arr[$this->getCompareFormat($dateTime)]),
            $this->is_bypass_holiday && $dateTime->holiday !== DateTime::NO_HOLIDAY => false,
            default => true,
        };
    }

    /**
     * 営業日を取得します（bypass 系 API）。
     *
     * {@link getWorkingDayByLimit()} のエイリアスです。
     *
     * @param int $lim_day 取得件数
     * @return DateTime[]
     * @throws Exceptions\Exception
     */
    public function getWorkingDay(int $lim_day): array
    {
        return $this->getWorkingDayByLimit($lim_day);
    }

    /**
     * 指定件数の営業日を取得します（bypass 系 API）。
     *
     * 開始日から順に走査し、bypass 系の設定（曜日・特定日・祝日）を除外しながら
     * `$lim_day` 件分の営業日を返します。
     *
     * @param int $lim_day 取得件数
     * @return DateTime[]
     * @throws NativeDateTimeException DateInterval の生成に失敗した場合
     */
    public function getWorkingDayByLimit(int $lim_day): array
    {
        $japaneseDateTime = clone $this->start_time_stamp;

        $res = [];
        while (count($res) < $lim_day) {
            if ($this->isWorkingDay($japaneseDateTime)) {
                $res[] = clone $japaneseDateTime;
            }

            try {
                $japaneseDateTime->add(new DateInterval('P1D'));
            } catch (Exception $exception) {
                throw new NativeDateTimeException('Throwing native DateInterval class construct exception.', $exception->getCode(), $exception);
            }
        }

        return $res;
    }

    /**
     * 開始日（または指定日付）が営業日かどうかを {@link DateBusiness} 設定で判定します。
     *
     * インスタンス個別設定 → グローバル設定 → デフォルト設定（土日・祝日休み）の順で
     * 有効な設定を解決して判定します。
     *
     * **使用例:**
     * ```php
     * $calendar = new Calendar('2026-05-30'); // 土曜
     * $calendar->setOpenDay('2026-05-30');    // 特別営業日に設定
     * $calendar->isBusinessDayByConfig();     // true
     * ```
     *
     * @param DateTimeInterface|null $date 判定する日付（省略時はコンストラクタで指定した開始日）
     * @return bool 営業日であれば true
     */
    public function isBusinessDayByConfig(?DateTimeInterface $date = null): bool
    {
        $target = $date ?? $this->start_time_stamp;

        return BusinessCalendar::isBusinessDay($target, $this->businessConfig);
    }

    /**
     * {@link DateBusiness} 設定を使用して期間内の営業日を取得します。
     *
     * 旧来の {@link getWorkingDayBySpan()} と異なり、インスタンス個別の
     * {@link DateBusiness} 設定（グローバル/デフォルト含む）を使用して
     * 優先順位付きで営業日を判定します。
     *
     * **使用例:**
     * ```php
     * $config = (new DateBusiness())->setClosingWeekdays([0, 6])->addClosingDate('2026-08-15', '夏期休暇');
     * $calendar = new Calendar('2026-08-10');
     * $calendar->setBusinessConfig($config);
     * $days = $calendar->getBusinessDaysBySpan('2026-08-31');
     * ```
     *
     * @param int|float|string|DateTimeInterface $jdt_end 取得終了日
     * @return DateTime[]
     * @throws \DateInvalidTimeZoneException
     * @throws NativeDateTimeException
     */
    public function getBusinessDaysBySpan(int|float|string|DateTimeInterface $jdt_end): array
    {
        $jdt_end_datetime = $this->createDateTime($jdt_end);
        $japaneseDateTime = clone $this->start_time_stamp;
        $end_compare = $this->getCompareFormat($jdt_end_datetime);

        $res = [];
        while ($this->getCompareFormat($japaneseDateTime) <= $end_compare) {
            if (BusinessCalendar::isBusinessDay($japaneseDateTime, $this->businessConfig)) {
                $res[] = clone $japaneseDateTime;
            }
            $japaneseDateTime->add(new DateInterval('P1D'));
        }

        return $res;
    }

    /**
     * {@link DateBusiness} 設定を使用して指定件数の営業日を取得します。
     *
     * 旧来の {@link getWorkingDayByLimit()} と異なり、インスタンス個別の
     * {@link DateBusiness} 設定（グローバル/デフォルト含む）を使用して
     * 優先順位付きで営業日を判定します。
     *
     * **使用例:**
     * ```php
     * $config = (new DateBusiness())
     *     ->setClosingWeekdays([0, 6])
     *     ->setBypassHoliday(true)
     *     ->addClosingNthWeekday(3, 3, '第3水曜定休');
     *
     * $calendar = new Calendar('2026-06-01');
     * $calendar->setBusinessConfig($config);
     * $days = $calendar->getBusinessDaysByLimit(10);
     * ```
     *
     * @param int $lim_day 取得件数
     * @return DateTime[]
     * @throws NativeDateTimeException DateInterval の生成に失敗した場合
     */
    public function getBusinessDaysByLimit(int $lim_day): array
    {
        $japaneseDateTime = clone $this->start_time_stamp;

        $res = [];
        while (count($res) < $lim_day) {
            if (BusinessCalendar::isBusinessDay($japaneseDateTime, $this->businessConfig)) {
                $res[] = clone $japaneseDateTime;
            }

            try {
                $japaneseDateTime->add(new DateInterval('P1D'));
            } catch (Exception $exception) {
                throw new NativeDateTimeException('Throwing native DateInterval class construct exception.', $exception->getCode(), $exception);
            }
        }

        return $res;
    }
}
