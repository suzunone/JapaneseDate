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
class Calendar
{
    /**
     * @var \JapaneseDate\DateTime
     */
    protected $start_time_stamp;

    /**
     * @var \DateTimeZone
     */
    protected $timezone;

    /**
     * @var array
     */
    protected $bypass_week_day_arr = [];
    /**
     * @var array
     */
    protected $bypass_day_arr = [];
    /**
     * @var bool
     */
    protected $is_bypass_holiday = false;

    /**
     * JapaneseDateCalendar constructor.
     *
     * @param string|\JapaneseDate\DateTime $time
     * @param \DateTimeZone|null $timezone
     */
    public function __construct($time = 'now', \DateTimeZone $timezone = null)
    {
        $this->start_time_stamp = $this->createDateTime($time, $timezone);
        $this->timezone         = $this->start_time_stamp->getTimezone();
    }

    /**
     * スキップする曜日を追加する
     *
     * @access      public
     * @param       int $val
     * @return \JapaneseDate\Calendar
     */
    public function addBypassWeekDay($val)
    {
        $this->bypass_week_day_arr[$val] = true;

        return $this;
    }


    /**
     * 指定月の日付配列を取得します
     *
     * @access      public
     * @return      array
     * @throws \Exception
     */
    public function getDatesOfMonth()
    {
        $JDT = DateTime::factory($this->start_time_stamp);

        $JDT->setDate($JDT->year, $JDT->month, 1);
        $compare_month = $JDT->format('m');
        $res           = [];

        while ($JDT->format('m') === $compare_month) {
            $res[] = clone $JDT;
            $JDT->add(new \DateInterval('P1D'));
        }

        return $res;
    }


    /**
     * スキップする曜日を削除する
     *
     * @access      public
     * @param       int $val
     * @return \JapaneseDate\Calendar
     */
    public function removeBypassWeekDay($val)
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
    public function resetBypassWeekDay()
    {
        $this->bypass_week_day_arr = [];

        return $this;
    }


    /**
     * スキップする日を追加する
     *
     * @access      public
     * @param string|\JapaneseDate\DateTime $time
     * @return \JapaneseDate\Calendar
     */
    public function addBypassDay($time)
    {
        $val = $this->createDateTime($time, $this->timezone);

        $this->bypass_day_arr[$this->getCompareFormat($val)] = $val;

        return $this;
    }


    /**
     * スキップする日を削除する
     *
     * @access      public
     * @param string|\JapaneseDate\DateTime $time
     * @return \JapaneseDate\Calendar
     */
    public function removeBypassDay($time)
    {
        $val = $this->createDateTime($time, $this->timezone);
        if (isset($this->bypass_day_arr[$this->getCompareFormat($val)])) {
            unset($this->bypass_day_arr[$this->getCompareFormat($val)]);
        }

        return $this;
    }


    /**
     * @param \DateTimeInterface
     * @return int
     */
    protected function getCompareFormat(\DateTimeInterface $DateTime): int
    {
        return (int)$DateTime->format('Ymd');
    }

    /**
     * スキップする曜日を初期化する
     *
     * @access      public
     * @return \JapaneseDate\Calendar
     */
    public function resetBypassDay()
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
     * @param       bool $val
     * @return \JapaneseDate\Calendar
     */
    public function setBypassHoliday($val)
    {
        $this->is_bypass_holiday = (bool)$val;

        return $this;
    }


    /**
     * 期間内の営業日を取得する
     *
     * @access      public
     * @param       int|string $jdt_end 取得終了日
     * @return      \JapaneseDate\DateTime[]
     * @throws \Exception
     */
    public function getWorkingDayBySpan($jdt_end)
    {
        $jdt_end     = $this->createDateTime($jdt_end);
        $JDT         = clone $this->start_time_stamp;
        $end_compare = $this->getCompareFormat($jdt_end);

        $res = [];
        while ($this->getCompareFormat($JDT) <= $end_compare) {
            if ($this->isWorkingDay($JDT)) {
                $res[] = clone $JDT;
            }
            $JDT->add(new \DateInterval('P1D'));
        }

        return $res;
    }

    /**
     * @param \JapaneseDate\DateTime $JDT
     * @return bool
     */
    protected function isWorkingDay(DateTime $JDT): bool
    {
        if (array_key_exists((int)$JDT->dayOfWeek, $this->bypass_week_day_arr)) {
            return false;
        }

        if (isset($this->bypass_day_arr[$this->getCompareFormat($JDT)])) {
            return false;
        }

        if ($this->is_bypass_holiday && $JDT->holiday !== DateTime::NO_HOLIDAY) {
            return false;
        }

        return true;
    }


    /**
     * 営業日を取得します
     *
     * getWorkingDayByLimitへのエイリアスです。
     *
     * @access      public
     * @param       int $lim_day 取得日数
     * @return      \JapaneseDate\DateTime[]
     * @throws \Exception
     */
    public function getWorkingDay($lim_day)
    {
        return $this->getWorkingDayByLimit($lim_day);
    }


    /**
     * 営業日を取得します
     *
     * @access      public
     * @param       int $lim_day 取得日数
     * @return      \JapaneseDate\DateTime[]
     * @throws \Exception
     */
    public function getWorkingDayByLimit($lim_day): array
    {
        $JDT = clone $this->start_time_stamp;

        $res = [];
        while (count($res) < $lim_day) {
            if ($this->isWorkingDay($JDT)) {
                $res[] = clone $JDT;
            }
            $JDT->add(new \DateInterval('P1D'));
        }

        return $res;
    }


    /**
     * JapaneseDateTimeを取得する
     *
     * @access      protected
     * @param       string|int|DateTime $JDT
     * @param \DateTimeZone|null $time_zone
     * @return      \JapaneseDate\DateTime
     */
    protected function createDateTime($JDT, \DateTimeZone $time_zone = null)
    {
        return DateTime::factory($JDT, $time_zone);
    }


}
