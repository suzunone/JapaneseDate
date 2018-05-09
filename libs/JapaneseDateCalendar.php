<?php
/**
 * @package    JapaneseDate
 * @subpackage JapaneseDate
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright  Suzunone/Envi
 * @license    BSD-2
 * @link       https://github.com/suzunone/JapaneseDate
 * @see        https://github.com/suzunone/JapaneseDate
 * @sinse Class available since Release 1.0.0
 */


namespace JapaneseDate;

use \JapaneseDate\JapaneseDate\JapaneseDate;
use \JapaneseDate\JapaneseDate\LunarCalendar;

use \DateTimeZone;
use \DateInterval;


/**
 * @package    JapaneseDate
 * @subpackage JapaneseDate
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright  Suzunone/Envi
 * @license    BSD-2
 * @link       https://github.com/suzunone/JapaneseDate
 * @see        https://github.com/suzunone/JapaneseDate
 * @sinse Class available since Release 1.0.0
 */
class JapaneseDateCalendar
{

    protected $start_time_stamp;
    protected $timezone;
    protected $bypass_week_day_arr = array();
    protected $bypass_day_arr = array();
    protected $is_bypass_holiday = false;

    public function __construct($time = 'now', DateTimeZone $timezone = NULL)
    {
        $this->start_time_stamp     = $this->JapaneseDateTime($time, $timezone);
        $this->timezone             = $timezone;
    }

    /**
     * +-- スキップする曜日を追加する
     *
     * @access      public
     * @param       mixed $val
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function addBypassWeekDay($val)
    {
        $this->bypass_week_day_arr[$val] = true;
        return $this;
    }
    /* ----------------------------------------- */

    /**
     * +-- スキップする曜日を削除する
     *
     * @access      public
     * @param       mixed $val
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function removeBypassWeekDay($val)
    {
        if (isset($this->bypass_week_day_arr[$val])) {
            unset($this->bypass_week_day_arr[$val]);
        }
        return $this;
    }
    /* ----------------------------------------- */


    /**
     * +-- スキップする曜日を初期化する
     *
     * @access      public
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function resetBypassWeekDay()
    {
        $this->bypass_week_day_arr = array();
        return $this;
    }
    /* ----------------------------------------- */


    /**
     * +-- スキップする日を追加する
     *
     * @access      public
     * @param       mixed $val
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function addBypassDay($val)
    {
        $val = $this->JapaneseDateTime($val, $this->timezone);
        $this->bypass_day_arr[$val->getCompareFormat()] = $val;
        return $this;
    }
    /* ----------------------------------------- */

    /**
     * +-- スキップする日を削除する
     *
     * @access      public
     * @param       mixed $val
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function removeBypassDay($val)
    {
        $val = $this->JapaneseDateTime($val, $this->timezone);
        if (isset($this->bypass_day_arr[$val->getCompareFormat()])) {
            unset($this->bypass_day_arr[$val->getCompareFormat()]);
        }
        return $this;
    }
    /* ----------------------------------------- */


    /**
     * +-- スキップする曜日を初期化する
     *
     * @access      public
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function resetBypassDay()
    {
        $this->bypass_day_arr = array();
        return $this;
    }
    /* ----------------------------------------- */


    /**
     * +-- 祝日を除くかどうか
     *
     * 除く場合true、そうでない場合false
     *
     * @access      public
     * @param       bool $val
     * @return \JapaneseDate\JapaneseDateCalendar
     */
    public function setBypassHoliday($val)
    {
        $this->is_bypass_holiday = (bool)$val;
        return $this;
    }
    /* ----------------------------------------- */

    /**
     * +-- 期間内の営業日を取得する
     *
     * @access      public
     * @param       int|string $JDT_end 取得終了日
     * @return      array
     */
    public function getWorkingDayBySpan($JDT_end)
    {
        $JDT_end = $this->JapaneseDateTime($JDT_end);
        $JDT     = clone $this->start_time_stamp;
        $end_compare = $JDT_end->getCompareFormat();

        $res = array();
        while ($JDT->getCompareFormat() <= $end_compare) {
            if ((array_key_exists($JDT->getWeekday(), $this->bypass_week_day_arr) === false) &&
                (array_key_exists($JDT->getCompareFormat(), $this->bypass_day_arr) === false) &&
                ($this->is_bypass_holiday ? $JDT->getHoliday() === JapaneseDateTime::NO_HOLIDAY : true)) {
                $res[] = clone $JDT;
            }
            $JDT->add(new DateInterval('P1D'));
        }
        return $res;
    }
    /* ----------------------------------------- */


    /**
     * +-- 営業日を取得します
     *
     * getWorkingDayByLimitへのエイリアスです。
     *
     * @access      public
     * @param       int $lim_day 取得日数
     * @return      array
     */
    public function getWorkingDay($lim_day)
    {
        return $this->getWorkingDayByLimit($lim_day);
    }
    /* ----------------------------------------- */

    /**
     * +-- 営業日を取得します
     *
     * @access      public
     * @param       int $lim_day 取得日数
     * @return      array
     */
    public function getWorkingDayByLimit($lim_day)
    {
        $JDT = clone $this->start_time_stamp;

        $res = array();
        while (count($res) < $lim_day) {
            if ((array_key_exists($JDT->getWeekday(), $this->bypass_week_day_arr) === false) &&
                (array_key_exists($JDT->getCompareFormat(), $this->bypass_day_arr) === false) &&
                ($this->is_bypass_holiday ? $JDT->getHoliday() === JapaneseDateTime::NO_HOLIDAY : true)) {
                $res[] = clone $JDT;
            }
            $JDT->add(new DateInterval('P1D'));
        }
        return $res;
    }
    /* ----------------------------------------- */


    /**
     * +-- JapaneseDateTimeを取得する
     *
     * @access      protected
     * @param       mixed $JDT
     * @return      JapaneseDateTime
     */
    protected function JapaneseDateTime($JDT)
    {
        if ($JDT instanceof JapaneseDateTime) {
            return $JDT;
        }
        return new JapaneseDateTime($JDT, $this->timezone);
    }
    /* ----------------------------------------- */



}
