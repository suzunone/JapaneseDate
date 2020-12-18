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
     * @var \JapaneseDate\DateTime
     */
    protected $start_time_stamp;

    /**
     * タイムゾーン
     *
     * @var \DateTimeZone
     */
    protected $timezone;

    /**
     * スキップする曜日
     *
     * @var array
     */
    protected $bypass_week_day_arr = [];

    /**
     * スキップする日
     *
     * @var array
     */
    protected $bypass_day_arr = [];

    /**
     * 祝日をスキップするかどうか
     *
     * @var bool
     */
    protected $is_bypass_holiday = false;

    /**
     * JapaneseDateCalendar constructor.
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @param string $time                 日付配列取得の起点となる、日付オブジェクト OR Unix Time Stamp OR 日付/時刻 文字列
     * @param \DateTimeZone|null $timezone オブジェクトか、時差の時間、タイムゾーンテキスト
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function __construct($time = 'now', DateTimeZone $timezone = null)
    {
        $this->start_time_stamp = $this->createDateTime($time, $timezone);
        $this->timezone = $this->start_time_stamp->getTimezone();
    }

    /**
     * JapaneseDateTimeを取得する
     *
     * @access      protected
     * @param string|int|DateTime $JDT
     * @param \DateTimeZone|null $time_zone
     * @return \JapaneseDate\DateTime
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function createDateTime($JDT, DateTimeZone $time_zone = null): DateTime
    {
        return DateTime::factory($JDT, $time_zone);
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
        $JDT = DateTime::factory($this->start_time_stamp);

        $JDT->setDate($JDT->year, $JDT->month, 1);
        $compare_month = $JDT->format('m');
        $res = [];

        while ($JDT->format('m') === $compare_month) {
            $res[] = clone $JDT;
            $JDT->add(new DateInterval('P1D'));
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
     * @param string|\JapaneseDate\DateTime $time 日付/時刻 文字列。DateTimeオブジェクト
     * @return \JapaneseDate\Calendar
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function addBypassDay($time): Calendar
    {
        $val = $this->createDateTime($time, $this->timezone);

        $this->bypass_day_arr[$this->getCompareFormat($val)] = $val;

        return $this;
    }

    /**
     * @param \DateTimeInterface
     * @return int
     */
    protected function getCompareFormat(DateTimeInterface $DateTime): int
    {
        return (int) $DateTime->format('Ymd');
    }

    /**
     * スキップする日を削除する
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @access      public
     * @param string|\JapaneseDate\DateTime $time 日付/時刻 文字列。DateTimeオブジェクト
     * @return \JapaneseDate\Calendar
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function removeBypassDay($time): Calendar
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
     * @param int|string $jdt_end 取得終了日
     * @return      \JapaneseDate\DateTime[]
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getWorkingDayBySpan($jdt_end): array
    {
        $jdt_end_datetime = $this->createDateTime($jdt_end);
        $JDT = clone $this->start_time_stamp;
        $end_compare = $this->getCompareFormat($jdt_end_datetime);

        $res = [];
        while ($this->getCompareFormat($JDT) <= $end_compare) {
            if ($this->isWorkingDay($JDT)) {
                $res[] = clone $JDT;
            }
            $JDT->add(new DateInterval('P1D'));
        }

        return $res;
    }

    /**
     * @param \JapaneseDate\DateTime $JDT
     * @return bool
     */
    protected function isWorkingDay(DateTime $JDT): bool
    {
        if (array_key_exists((int) $JDT->dayOfWeek, $this->bypass_week_day_arr)) {
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
        $JDT = clone $this->start_time_stamp;

        $res = [];
        while (count($res) < $lim_day) {
            if ($this->isWorkingDay($JDT)) {
                $res[] = clone $JDT;
            }
            try {
                $JDT->add(new DateInterval('P1D'));
            } catch (Exception $exception) {
                throw new NativeDateTimeException('Throwing native DateInterval class construct exception.', $exception->getCode(), $exception);
            }
        }

        return $res;
    }
}
