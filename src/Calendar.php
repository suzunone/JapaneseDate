<?php

/**
 * 日付オブジェクト配列作成
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Calendar
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate;

use Carbon\CarbonTimeZone;
use DateInterval;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use JapaneseDate\Exceptions\NativeDateTimeException;

/**
 * 日付オブジェクト配列作成
 *
 * 様々な条件の元、一定期間内の日付の配列を取得します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Calendar
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class Calendar
{
    /**
     * 取得開始日時
     *
     * @var \JapaneseDate\DateTime|DateTimeInterface
     */
    protected DateTime|DateTimeInterface $start_time_stamp;

    /**
     * タイムゾーン
     *
     * @var \DateTimeZone|false|\Carbon\CarbonTimeZone
     */
    protected DateTimeZone|false|CarbonTimeZone $timezone;

    /**
     * スキップする曜日
     *
     * @var array
     */
    protected array $bypass_week_day_arr = [];

    /**
     * スキップする日
     *
     * @var array
     */
    protected array $bypass_day_arr = [];

    /**
     * 祝日をスキップするかどうか
     *
     * @var bool
     */
    protected bool $is_bypass_holiday = false;

    /**
     * JapaneseDateCalendar constructor.
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @param int|float|string|DateTimeInterface $time 日付配列取得の起点となる、日付オブジェクト OR Unix Time Stamp OR 日付/時刻 文字列
     * @param ?\DateTimeZone $timezone オブジェクトか、時差の時間、タイムゾーンテキスト
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function __construct(int|float|string|DateTimeInterface $time = 'now', DateTimeZone|null $timezone = null)
    {
        $this->start_time_stamp = $this->createDateTime($time, $timezone);
        $this->timezone = $this->start_time_stamp->getTimezone();
    }

    /**
     * JapaneseDateTimeを取得する
     *
     * @access      protected
     * @param int|float|string|DateTimeInterface $date_time
     * @param ?\DateTimeZone $time_zone
     * @return \JapaneseDate\DateTime
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function createDateTime(int|float|string|DateTimeInterface $date_time, DateTimeZone|null $time_zone = null): DateTimeInterface
    {
        return DateTime::factory($date_time, $time_zone);
    }

    /**
     * スキップする曜日を追加する
     *
     * @access      public
     * @param int $val スキップする曜日(0:日曜-6:土曜)
     * @return \JapaneseDate\Calendar
     */
    public function addBypassWeekDay(int $val): Calendar
    {
        $this->bypass_week_day_arr[$val] = true;

        return $this;
    }

    /**
     * 指定月の日付配列を取得します
     *
     * @access      public
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
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
     * スキップする曜日を削除する
     *
     * @access      public
     * @param int $val スキップする曜日(0:日曜-6:土曜)
     * @return \JapaneseDate\Calendar
     */
    public function removeBypassWeekDay(int $val): Calendar
    {
        if (isset($this->bypass_week_day_arr[$val])) {
            unset($this->bypass_week_day_arr[$val]);
        }

        return $this;
    }

    /**
     * スキップする曜日を初期化する
     *
     * @access      public
     * @return \JapaneseDate\Calendar
     */
    public function resetBypassWeekDay(): Calendar
    {
        $this->bypass_week_day_arr = [];

        return $this;
    }

    /**
     * スキップする日を追加する
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @access      public
     * @param int|float|string|DateTimeInterface $time 日付/時刻 文字列。DateTimeオブジェクト
     * @return \JapaneseDate\Calendar
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function addBypassDay(int|float|string|DateTimeInterface $time): Calendar
    {
        $val = $this->createDateTime($time, $this->timezone);

        $this->bypass_day_arr[$this->getCompareFormat($val)] = $val;

        return $this;
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @return int
     */
    protected function getCompareFormat(DateTimeInterface $dateTime): int
    {
        return (int) $dateTime->format('Ymd');
    }

    /**
     * スキップする日を削除する
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @access      public
     * @param int|float|string|DateTimeInterface $time 日付/時刻 文字列。DateTimeオブジェクト
     * @return \JapaneseDate\Calendar
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function removeBypassDay(int|float|string|DateTimeInterface $time): Calendar
    {
        $val = $this->createDateTime($time, $this->timezone);
        if (isset($this->bypass_day_arr[$this->getCompareFormat($val)])) {
            unset($this->bypass_day_arr[$this->getCompareFormat($val)]);
        }

        return $this;
    }

    /**
     * スキップする曜日を初期化する
     *
     * @access      public
     * @return \JapaneseDate\Calendar
     */
    public function resetBypassDay(): Calendar
    {
        $this->bypass_day_arr = [];

        return $this;
    }

    /**
     * 祝日を除くかどうか
     *
     * 除く場合true、そうでない場合false
     *
     * @access      public
     * @param bool $val 除く場合true、そうでない場合false
     * @return \JapaneseDate\Calendar
     */
    public function setBypassHoliday(bool $val): Calendar
    {
        $this->is_bypass_holiday = $val;

        return $this;
    }

    /**
     * 期間内の営業日を取得する
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @access      public
     * @param int|float|string|DateTimeInterface $jdt_end 取得終了日
     * @return      \JapaneseDate\DateTime[]
     * @throws \JapaneseDate\Exceptions\Exception
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
     * @param \JapaneseDate\DateTime $dateTime
     * @return bool
     */
    protected function isWorkingDay(DateTime $dateTime): bool
    {
        switch (true) {
            case array_key_exists($dateTime->dayOfWeek, $this->bypass_week_day_arr):
            case isset($this->bypass_day_arr[$this->getCompareFormat($dateTime)]):
            case $this->is_bypass_holiday && $dateTime->holiday !== DateTime::NO_HOLIDAY:
                return false;
            default:
                return true;
        }
    }

    /**
     * 営業日を取得します
     *
     * getWorkingDayByLimitへのエイリアスです。
     *
     * @access      public
     * @param int $lim_day 取得日数
     * @return      \JapaneseDate\DateTime[]
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getWorkingDay(int $lim_day): array
    {
        return $this->getWorkingDayByLimit($lim_day);
    }

    /**
     * 営業日を取得します
     *
     * @access      public
     * @param int $lim_day 取得日数
     * @return      \JapaneseDate\DateTime[]
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
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
}
