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
use \DateTime;
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
class JapaneseDateTime extends DateTime
{
    /**
     * +-- 祝日定数
     */
    const NO_HOLIDAY                         =  0;
    const NEW_YEAR_S_DAY                     =  1;
    const COMING_OF_AGE_DAY                  =  2;
    const NATIONAL_FOUNDATION_DAY            =  3;
    const THE_SHOWA_EMPEROR_DIED             =  4;
    const VERNAL_EQUINOX_DAY                 =  5;
    const DAY_OF_SHOWA                       =  6;
    const GREENERY_DAY                       =  7;
    const THE_EMPEROR_S_BIRTHDAY             =  8;
    const CROWN_PRINCE_HIROHITO_WEDDING      =  9;
    const CONSTITUTION_DAY                   =  10;
    const NATIONAL_HOLIDAY                   =  11;
    const CHILDREN_S_DAY                     =  12;
    const COMPENSATING_HOLIDAY               =  13;
    const CROWN_PRINCE_NARUHITO_WEDDING      =  14;
    const MARINE_DAY                         =  15;
    const AUTUMNAL_EQUINOX_DAY               =  16;
    const RESPECT_FOR_SENIOR_CITIZENS_DAY    =  17;
    const SPORTS_DAY                         =  18;
    const CULTURE_DAY                        =  19;
    const LABOR_THANKSGIVING_DAY             =  20;
    const REGNAL_DAY                         =  21;
    const MOUNTAIN_DAY                       =  22;

    const HOLIDAY_START_YEAR                 = 1948;

    /**
     * +-- 特定月定数
     */
    const VERNAL_EQUINOX_DAY_MONTH   =  3;
    const AUTUMNAL_EQUINOX_DAY_MONTH =  9;

    /**
     * +-- 曜日定数
     */
    const SUNDAY =     0;
    const MONDAY =     1;
    const TUESDAY =    2;
    const WEDNESDAY =  3;
    const THURSDAY =   4;
    const FRIDAY =     5;
    const SATURDAY =   6;

    const ERA_MEIJI  = 1000;
    const ERA_TAISHO = 1001;
    const ERA_SHOWA  = 1002;
    const ERA_HEISEI = 1003;

    /**
     * @var \JapaneseDate\JapaneseDate\JapaneseDate
     */
    private $JD;

    /**
     * @var \JapaneseDate\JapaneseDate\LunarCalendar
     */
    private $LC;
    private $lunar_calendar = array();


    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @param       mixed $time OPTIONAL:'now'
     * @param       DateTimeZone $timezone OPTIONAL:NULL
     * @return      void
     */
    public function __construct($time = 'now', DateTimeZone $timezone = NULL)
    {
        if (is_int($time) || ctype_digit($time)) {
            $time = date('Y-m-d H:i:s', $time);
        }
        parent::__construct ($time, $timezone);
        $this->JD = JapaneseDate::factory();
        $this->LC = LunarCalendar::factory();
    }
    /* ----------------------------------------- */

    /**
     * +--オブジェクトの生成
     *
     * @access      public
     * @static
     * @param       mixed $time            OPTIONAL:'now'
     * @param       DateTimeZone $timezone OPTIONAL:NULL
     * @return \JapaneseDate\JapaneseDateTime
     */
    public static function factory($time = 'now', DateTimeZone $timezone = NULL)
    {
        return new JapaneseDateTime($time, $timezone);
    }
    /* ----------------------------------------- */

    /**
     * +-- 指定月の日付配列を取得します
     *
     * @access      public
     * @return      array
     */
    public function getDatesOfMonth()
    {
        $JDT = clone $this;
        $JDT->setDate($this->getYear(), $this->getMonth(), 1);
        $compare_month = $JDT->format('m');
        $res = array();
        while ($JDT->format('m') === $compare_month) {
            $res[] = clone $JDT;
            $JDT->add(new DateInterval('P1D'));
        }
        return $res;
    }
    /* ----------------------------------------- */



    /**
     * +-- 年号キーを返す
     *
     * @access      public
     * @return int
     */
    public function getEraName()
    {
        $TaishoStart    = new DateTime('1912-07-30 00:00:00', $this->getTimezone());
        $ShowaStart     = new DateTime('1926-12-25 00:00:00', $this->getTimezone());
        $HeiseiStart    = new DateTime('1989-01-08 00:00:00', $this->getTimezone());

        if ($TaishoStart > $this) {
            // 明治
            return self::ERA_MEIJI;
        }

        if ($TaishoStart <= $this && $ShowaStart > $this) {
            // 大正
            return self::ERA_TAISHO;
        }

        if ($ShowaStart <= $this && $HeiseiStart > $this) {
            // 昭和
            return self::ERA_SHOWA;
        }

        // 平成
        return self::ERA_HEISEI;
    }
    /* ----------------------------------------- */


    /**
     * +-- 和暦を返す
     *
     * @access      public
     * @return int
     */
    public function getEraYear()
    {
        $era_calc = array(self::ERA_MEIJI  => 1868,
            self::ERA_TAISHO => 1912,
            self::ERA_SHOWA  => 1926,
            self::ERA_HEISEI => 1989,
        );
        $key = $this->getEraName();
        return $this->getYear()-$era_calc[$key]+1;
    }
    /* ----------------------------------------- */



    /**
     * +-- 干支キーを返す
     *
     * @access      public
     * @return int
     */
    public function getOrientalZodiac()
    {
        $time_stamp = $this->getTimestamp();
        $res = ($this->getYear($time_stamp)+9)%12;
        return $res;
    }
    /* ----------------------------------------- */


    /**
     * +-- 七曜を数値化して返します
     *
     *
     * @access      public
     * @return      int
     */
    public function getWeekday()
    {
        return (int)$this->format('w');
    }
    /* ----------------------------------------- */

    /**
     * +-- 年を数値化して返します
     *
     *
     * @access      public
     * @return      int
     */
    public function getYear()
    {
        return (int)$this->format('Y');
    }
    /* ----------------------------------------- */

    /**
     * +-- 月を数値化して返します
     *
     *
     * @access      public
     * @return      int
     */
    public function getMonth()
    {
        return (int)$this->format('n');
    }
    /* ----------------------------------------- */

    /**
     * +-- 日を数値化して返します
     *
     * @access      public
     * @return      int
     *
     */
    public function getDay()
    {
        return (int)$this->format('j');
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日キーを返す
     *
     * @access      public
     * @return      int
     */
    public function getHoliday()
    {
        $hl = $this->JD->getHolidayList($this);
        return isset($hl[$this->getDay()]) ? $hl[$this->getDay()] : self::NO_HOLIDAY;
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた休日名を返す
     *
     * @access      public
     * @return      string
     */
    public function viewHoliday()
    {
        $key = $this->getHoliday();
        return $this->JD->viewHoliday($key);
    }
    /* ----------------------------------------- */

    /**
     * +-- 日本語フォーマットされた曜日名を返す
     *
     * @access      public
     * @return      string
     */
    public function viewWeekday()
    {
        $key = $this->getWeekday();
        return $this->JD->viewWeekday($key);
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた旧暦月名を返す
     *
     * @access      public
     * @return string
     */
    public function viewMonth()
    {
        $key = $this->getMonth();
        return $this->JD->viewMonth($key);
    }
    /* ----------------------------------------- */


    /**
     * +-- 旧暦(月)
     *
     * @access      public
     * @return      string
     */
    public function viewLunarMonth()
    {
        $key = $this->getLunarMonth();
        return $this->JD->viewMonth($key);
    }
    /* ----------------------------------------- */

    /**
     * +-- 日本語フォーマットされた六曜名を返す
     *
     * @access      public
     * @return      string
     */
    public function viewSixWeekday()
    {
        $key = $this->getSixWeekday();
        return $this->JD->viewSixWeekday($key);
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた干支を返す
     *
     * @access      public
     * @return      string
     */
    public function viewOrientalZodiac()
    {
        $key = $this->getOrientalZodiac();
        return $this->JD->viewOrientalZodiac($key);
    }
    /* ----------------------------------------- */

    /**
     * +-- 日本語フォーマットされた年号を返す
     *
     * @access      public
     * @return      string
     */
    public function viewEraName()
    {
        $key = $this->getEraName();
        return $this->JD->viewEraName($key);
    }
    /* ----------------------------------------- */

    /**
     * +-- 旧暦データ取得
     *
     * @access      public
     * @return      array
     */
    public function getLunarCalendar()
    {
        $time_stamp = $this->getTimestamp();
        if (!isset($this->lunar_calendar[$time_stamp])) {
            $this->lunar_calendar[$time_stamp] = $this->LC->getLunarCalendarByMDY(
                $this->getMonth(), $this->getDay(), $this->getYear()
            );
        }
        return $this->lunar_calendar[$time_stamp];
    }
    /* ----------------------------------------- */


    /**
     * +-- 中気かどうか
     *
     * @access      public
     * @return      boolean
     */
    public function isChuki()
    {
        $lunar_calendar = $this->getLunarCalendar();
        return $lunar_calendar['is_chuki'];
    }
    /* ----------------------------------------- */

    /**
     * +-- 閏月かどうか
     *
     * @access      public
     * @return      boolean
     */
    public function isUruu()
    {
        $lunar_calendar = $this->getLunarCalendar();
        return $lunar_calendar['uruu'];
    }
    /* ----------------------------------------- */


    /**
     * +-- 中気の取得
     *
     * @access      public
     * @return      JapaneseDateTime
     */
    public function getChuki()
    {
        $lunar_calendar = $this->getLunarCalendar();
        $time = $this->LC->JD2Timestamp($lunar_calendar['chuki']);
        return self::factory($time);
    }
    /* ----------------------------------------- */



    /**
     * +-- 朔の取得
     *
     * @access      public
     * @return      JapaneseDateTime
     */
    public function getTsuitachi()
    {
        $lunar_calendar = $this->getLunarCalendar();
        $time = $this->LC->JD2Timestamp($lunar_calendar['tsuitachi_jd']);
        return self::factory($time);
    }
    /* ----------------------------------------- */


    /**
     * +-- カレンダーの取得
     *
     * @access      public
     * @param int $calendar
     * @return      array
     */
    public function getCalendar($calendar = CAL_GREGORIAN)
    {
        return cal_from_jd(unixtojd($this->getTimestamp()), $calendar);
    }
    /* ----------------------------------------- */


    /**
     * +-- 中気の取得
     *
     * @access      public
     * @param int $calendar
     * @return      array
     */
    public function getChukiCalendar($calendar = CAL_GREGORIAN)
    {
        $lunar_calendar = $this->getLunarCalendar();
        return cal_from_jd($this->LC->toIntJD($lunar_calendar['chuki']), $calendar);
    }
    /* ----------------------------------------- */


    /**
     * +-- 朔の取得
     *
     * @access      public
     * @param int $calendar
     * @return      string
     */
    public function getTsuitachiCalendar($calendar = CAL_GREGORIAN)
    {
        $lunar_calendar = $this->getLunarCalendar();
        return cal_from_jd($this->LC->toIntJD($lunar_calendar['tsuitachi_jd']), $calendar);
    }
    /* ----------------------------------------- */


    /**
     * +-- 旧暦（年）
     *
     * @access      public
     * @return      string
     */
    public function getLunarYear()
    {
        $lunar_calendar = $this->getLunarCalendar();
        return $lunar_calendar['year'];
    }
    /* ----------------------------------------- */

    /**
     * +-- 旧暦(月)
     *
     * @access      public
     * @return      string
     */
    public function getLunarMonth()
    {
        $lunar_calendar = $this->getLunarCalendar();
        return $lunar_calendar['month'];
    }
    /* ----------------------------------------- */


    /**
     * +-- 旧暦(日)・月齢
     *
     * @access      public
     * @return      string
     */
    public function getLunarDay()
    {
        $lunar_calendar = $this->getLunarCalendar();
        return $lunar_calendar['day'];
    }
    /* ----------------------------------------- */



    /**
     * +-- 六曜を数値化して返します
     *
     * @access      public
     * @return      int
     */
    public function getSixWeekday()
    {
        $lunar_calendar = $this->getLunarCalendar();
        return ($lunar_calendar['month']+$lunar_calendar['day']) % 6;
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語カレンダー対応したstrftime()
     *
     * <pre>{@link http://php.five-foxes.com/module/php_man/index.php?web=public function.strftime strftimeの仕様}
     * に加え、
     * %J 1～31の日
     * %e 1～9なら先頭にスペースを付ける、1～31の日
     * %g 1～9なら先頭にスペースを付ける、1～12の月
     * %K 和名曜日
     * %k 六曜番号
     * %6 六曜
     * %K 曜日
     * %l 祝日番号
     * %L 祝日
     * %o 干支番号
     * %O 干支
     * %N 1～12の月
     * %E 旧暦年
     * %G 旧暦の月
     * %F 年号
     * %f 年号ID
     *
     * が使用できます。</pre>
     *
     * @since 1.1
     * @param string $format フォーマット
     * @param integer $time_stamp 変換したいタイムスタンプ(デフォルトは現在のロケール時間)
     * @return string
     */
    public function strftime($format, $time_stamp = NULL)
    {
        $res_str = '';
        $format_array = explode('%', $format);
        foreach ($format_array as $k => $strings) {
            if ($k === 0) {
                $res_str .= $strings;
                continue;
            }
            $re_format = '';
            switch (substr($strings, 0, 1)) {
            case 'o':
                $re_format = $this->getOrientalZodiac();
                break;
            case 'O':
                $re_format = $this->viewOrientalZodiac();
                break;
            case 'l':
                $re_format = $this->getHoliday();
                break;
            case 'L':
                $re_format = $this->viewHoliday();
                break;
            case 'K':
                $re_format = $this->viewWeekday();
                break;
            case 'k':
                $re_format = $this->viewSixWeekday();
                break;
            case '6':
                $re_format = $this->getSixWeekday();
                break;
            case 'e':
                $re_format = $this->format('j');
                if (strlen($re_format) === 1) {
                    $re_format = ' '.$re_format;
                }
                break;
            case 'g':
                $re_format = $this->format('n');
                if (strlen($re_format) === 1) {
                    $re_format = ' '.$re_format;
                }
                break;
            case 'J':
                $re_format = $this->format('j');
                break;
            case 'G':
                $re_format = $this->viewMonth();
                break;
            case 'N':
                $re_format = $this->getMonth();
                break;
            case 'F':
                $re_format = $this->viewEraName();
                break;
            case 'f':
                $re_format = $this->getEraName();
                break;
            case 'E':
                $re_format = $this->getEraYear();
                break;
            default:
                $re_format = '%'.substr($strings, 0, 1);
                break;
            }
            $res_str .= $re_format.mb_substr($strings, 1);
        }

        return strftime($res_str, $this->getTimestamp());
    }
    /* ----------------------------------------- */

    /**
     * +-- 比較用のYMD
     *
     * @access      public
     * @return      int
     */
    public function getCompareFormat()
    {
        return (int)$this->format('Ymd');
    }
    /* ----------------------------------------- */

    /**
     * +-- 比較用のYMD
     *
     * @access      public
     * @param $JD
     * @return      int
     */
    public function toIntJD($JD)
    {
        return (int)$this->LC->toIntJD($JD);
    }
    /* ----------------------------------------- */

}
