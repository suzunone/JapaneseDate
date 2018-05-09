<?php
/**
 * 日本語/和暦日付クラスメインファイル
 *
 * @package    JapaneseDate
 * @subpackage JapaneseDate
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright  Suzunone/Envi
 * @license    BSD-2
 * @link       https://github.com/suzunone/JapaneseDate
 * @see        https://github.com/suzunone/JapaneseDate
 * @sinse Class available since Release 1.0.0
 */


namespace JapaneseDate\JapaneseDate;
use \JapaneseDate\JapaneseDateTime;



/**
 * 日本語/和暦日付クラス
 *
 * @package    JapaneseDate
 * @subpackage JapaneseDate
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright  Suzunone/Envi
 * @license    BSD-2
 * @link       https://github.com/suzunone/JapaneseDate
 * @see        https://github.com/suzunone/JapaneseDate
 * @sinse Class available since Release 1.0.0
 */
class JapaneseDate
{

    /**
     * +-- 旧暦クラスオブジェクト
     * @var \JapaneseDate\JapaneseDate\LunarCalendara
     */
    private $lc;

    /**#@+
     * @access private
     */
    private $_holiday_name = array();

    private $_weekday_name = array('日', '月', '火', '水', '木', '金', '土');

    private $_month_name = array('', '睦月', '如月', '弥生', '卯月', '皐月', '水無月', '文月', '葉月', '長月', '神無月', '霜月', '師走');

    private $_six_weekday = array('大安', '赤口', '先勝', '友引', '先負', '仏滅');

    private $_oriental_zodiac = array('亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', );

    private $_era_name;

    private $_era_calc = array(1925, 1988);

    private $_24_sekki = array();

    private $_use_luna = false;


    /**#@-*/

    /**
     * +-- コンストラクタ
     *
     * @access public
     * @params
     * @return      void
     */
    public function __construct()
    {
        $this->lc = LunarCalendar::factory();

        $this->_era_name = array(
            JapaneseDateTime::ERA_MEIJI => '明治',
            JapaneseDateTime::ERA_TAISHO => '大正',
            JapaneseDateTime::ERA_SHOWA => '昭和',
            JapaneseDateTime::ERA_HEISEI => '平成'
        );


        $this->_holiday_name = array(
            JapaneseDateTime::NO_HOLIDAY                       => '',
            JapaneseDateTime::NEW_YEAR_S_DAY                   => '元旦',
            JapaneseDateTime::COMING_OF_AGE_DAY                => '成人の日',
            JapaneseDateTime::NATIONAL_FOUNDATION_DAY          => '建国記念の日',
            JapaneseDateTime::THE_SHOWA_EMPEROR_DIED           => '昭和天皇の大喪の礼',
            JapaneseDateTime::VERNAL_EQUINOX_DAY               => '春分の日',
            JapaneseDateTime::DAY_OF_SHOWA                     => '昭和の日',
            JapaneseDateTime::GREENERY_DAY                     => 'みどりの日',
            JapaneseDateTime::THE_EMPEROR_S_BIRTHDAY           => '天皇誕生日',
            JapaneseDateTime::CROWN_PRINCE_HIROHITO_WEDDING    => '皇太子明仁親王の結婚の儀',
            JapaneseDateTime::CONSTITUTION_DAY                  => '憲法記念日',
            JapaneseDateTime::NATIONAL_HOLIDAY                  => '国民の休日',
            JapaneseDateTime::CHILDREN_S_DAY                    => 'こどもの日',
            JapaneseDateTime::COMPENSATING_HOLIDAY              => '振替休日',
            JapaneseDateTime::CROWN_PRINCE_NARUHITO_WEDDING     => '皇太子徳仁親王の結婚の儀',
            JapaneseDateTime::MARINE_DAY                        => '海の日',
            JapaneseDateTime::AUTUMNAL_EQUINOX_DAY              => '秋分の日',
            JapaneseDateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY   => '敬老の日',
            JapaneseDateTime::SPORTS_DAY                        => '体育の日',
            JapaneseDateTime::CULTURE_DAY                       => '文化の日',
            JapaneseDateTime::LABOR_THANKSGIVING_DAY            => '勤労感謝の日',
            JapaneseDateTime::REGNAL_DAY                        => '即位礼正殿の儀',
            JapaneseDateTime::MOUNTAIN_DAY                      => '山の日'
        );

    }
    /* ----------------------------------------- */

    /**
     * +-- ファクトリー
     *
     * @access      public
     * @static
     * @return \JapaneseDate\JapaneseDate\JapaneseDate
     */
    public static function factory()
    {
        static $instance;
        if (!$instance) {
            $instance = new JapaneseDate;
        }
        return $instance;
    }
    /* ----------------------------------------- */



    /**
     * +-- 指定月の祝日リストを取得する
     *
     * @access      public
     * @param       JapaneseDateTime $JapaneseDateTime JapaneseDateTime
     * @return      array
     */
    public function getHolidayList(JapaneseDateTime $JapaneseDateTime)
    {
        // @codeCoverageIgnoreStart
        static $methods = array(
            1 => 'getJanuaryHoliday',
            2 => 'getFebruaryHoliday',
            3 => 'getMarchHoliday',
            4 => 'getAprilHoliday',
            5 => 'getMayHoliday',
            6 => 'getJuneHoliday',
            7 => 'getJulyHoliday',
            8 => 'getAugustHoliday',
            9 => 'getSeptemberHoliday',
            10 => 'getOctoberHoliday',
            11 => 'getNovemberHoliday',
            12 => 'getDecemberHoliday',
        );
        // @codeCoverageIgnoreEnd
        $method = $methods[$JapaneseDateTime->getMonth()];
        return $this->$method($JapaneseDateTime->getYear(), $JapaneseDateTime->getTimezone());

    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた休日名を返す
     *
     * @access      public
     * @param       int $key 休日キー
     * @return      string
     */
    public function viewHoliday($key)
    {
        return $this->_holiday_name[$key];
    }
    /* ----------------------------------------- */

    /**
     * +-- 日本語フォーマットされた曜日名を返す
     *
     * @access      public
     * @param       int $key 曜日キー
     * @return      string
     */
    public function viewWeekday($key)
    {
        return $this->_weekday_name[$key];
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた旧暦月名を返す
     *
     * @access      public
     * @param       int $key 月キー
     * @return      string
     */
    public function viewMonth($key)
    {
        return $this->_month_name[$key];
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた六曜名を返す
     *
     * @access      public
     * @param       int $key 六曜キー
     * @return      string
     */
    public function viewSixWeekday($key)
    {
        return array_key_exists($key, $this->_six_weekday) ? $this->_six_weekday[$key] : '';
    }
    /* ----------------------------------------- */


    /**
     * +-- 日本語フォーマットされた干支を返す
     *
     * @access      public
     * @param       int $key 干支キー
     * @return      string
     */
    public function viewOrientalZodiac($key)
    {
        return $this->_oriental_zodiac[$key];
    }
    /* ----------------------------------------- */

    /**
     * +-- 日本語フォーマットされた年号を返す
     *
     * @access      public
     * @param       int $key 年号キー
     * @return      string
     */
    public function viewEraName($key)
    {
        return $this->_era_name[$key];
    }
    /* ----------------------------------------- */

    /**
     * +-- 春分の日を取得
     *
     * @access      public
     * @param $year
     * @return      int タイムスタンプ
     */
    public function getVernalEquinoxDay($year)
    {
        if ($year <= 1979) {
            $day = floor(20.8357 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2099) {
            $day = floor(20.8431 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2150) {
            $day = floor(21.851 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } else {
            return false;
        }
        return mktime(0, 0, 0, JapaneseDateTime::VERNAL_EQUINOX_DAY_MONTH, $day, $year);
    }
    /* ----------------------------------------- */

    /**
     * +-- 秋分の日を取得
     *
     * @access      public
     * @param $year
     * @return      int タイムスタンプ
     */
    public function getAutumnEquinoxDay($year)
    {
        if ($year <= 1979) {
            $day = floor(23.2588 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2099) {
            $day = floor(23.2488 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2150) {
            $day = floor(24.2488 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } else {
            return false;
        }
        return mktime(0, 0, 0, JapaneseDateTime::AUTUMNAL_EQUINOX_DAY_MONTH, $day, $year);
    }
    /* ----------------------------------------- */

    /**
     * +-- 第○ ■曜日の日付を取得します。
     *
     * @access      public
     * @param       int $year   年
     * @param       int $month  月
     * @param       int $weekly 曜日
     * @param       int $renb   何週目か
     * @param null $timezone
     * @return      int
     */
    public function getDayByWeekly($year, $month, $weekly, $renb = 1, $timezone = NULL)
    {
        // @codeCoverageIgnoreStart
        switch ($weekly) {
        // @codeCoverageIgnoreEnd
            case JapaneseDateTime::SUNDAY:
                $map = array(7, 1, 2, 3, 4, 5, 6, );
            break;
            case JapaneseDateTime::MONDAY:
                $map = array(6, 7, 1, 2, 3, 4, 5, );
            break;
            case JapaneseDateTime::TUESDAY:
                $map = array(5, 6, 7, 1, 2, 3, 4, );
            break;
            case JapaneseDateTime::WEDNESDAY:
                $map = array(4, 5, 6, 7, 1, 2, 3, );
            break;
            case JapaneseDateTime::THURSDAY:
                $map = array(3, 4, 5, 6, 7, 1, 2, );
            break;
            case JapaneseDateTime::FRIDAY:
                $map = array(2, 3, 4, 5, 6, 7, 1, );
            break;
            case JapaneseDateTime::SATURDAY:
                $map = array(1, 2, 3, 4, 5, 6, 7, );
            break;
        }

        $renb = 7 * $renb + 1;
        return $renb - $map[$this->getWeekday(mktime(0, 0, 0, $month, 1, $year), $timezone)];
    }
    /* ----------------------------------------- */


    /**
     * +-- 祝日判定ロジック一月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getJanuaryHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        $res[1] = JapaneseDateTime::NEW_YEAR_S_DAY;
        // 振替休日確認
        if ($this->getWeekDay(mktime(0, 0, 0, 1, 1, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[2] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        if ($year >= 2000) {
            //2000年以降は第二月曜日に変更
            $second_monday = $this->getDayByWeekly($year, 1, JapaneseDateTime::MONDAY, 2, $timezone);
            $res[$second_monday] = JapaneseDateTime::COMING_OF_AGE_DAY;

        } else {
            $res[15] = JapaneseDateTime::COMING_OF_AGE_DAY;
            // 振替休日確認
            if ($this->getWeekDay(mktime(0, 0, 0, 1, 15, $year), $timezone) == JapaneseDateTime::SUNDAY) {
                $res[16] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック二月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getFebruaryHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        $res[11] = JapaneseDateTime::NATIONAL_FOUNDATION_DAY;
        // 振替休日確認
        if ($this->getWeekDay(mktime(0, 0, 0, 2, 11, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[12] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        if ($year == 1989) {
            $res[24] = JapaneseDateTime::THE_SHOWA_EMPEROR_DIED;
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック三月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getMarchHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        $VernalEquinoxDay = $this->getVernalEquinoxDay($year);
        $res[$this->getDay($VernalEquinoxDay)] = JapaneseDateTime::VERNAL_EQUINOX_DAY;
        // 振替休日確認
        if ($this->getWeekDay($VernalEquinoxDay, $timezone) == JapaneseDateTime::SUNDAY) {
            $res[$this->getDay($VernalEquinoxDay, $timezone)+1] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック四月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getAprilHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year == 1959) {
            $res[10] = JapaneseDateTime::CROWN_PRINCE_HIROHITO_WEDDING;
        }
        if ($year >= 2007) {
            $res[29] = JapaneseDateTime::DAY_OF_SHOWA;
        } elseif ($year >= 1989) {
            $res[29] = JapaneseDateTime::GREENERY_DAY;
        } else {
            $res[29] = JapaneseDateTime::THE_EMPEROR_S_BIRTHDAY;
        }
        // 振替休日確認
        if ($this->getWeekDay(mktime(0, 0, 0, 4, 29, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[30] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック五月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getMayHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year >= 1947) {
            $res[3] = JapaneseDateTime::CONSTITUTION_DAY;
        }
        if ($year >= 2007) {
            $res[4] = JapaneseDateTime::GREENERY_DAY;
        } elseif ($year >= 1986) {
            // 5/4が日曜日の場合はそのまま､月曜日の場合は『憲法記念日の振替休日』(2006年迄)
            if ($this->getWeekday(mktime(0, 0, 0, 5, 4, $year), $timezone) > JapaneseDateTime::MONDAY) {
                $res[4] = JapaneseDateTime::NATIONAL_HOLIDAY;
            } elseif ($this->getWeekday(mktime(0, 0, 0, 5, 4, $year), $timezone) == JapaneseDateTime::MONDAY)  {
                $res[4] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        } elseif ($year >= 1947) {
            if ($this->getWeekDay(mktime(0, 0, 0, 5, 3, $year), $timezone) == JapaneseDateTime::SUNDAY) {
                $res[4] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        }
        $res[5] = JapaneseDateTime::CHILDREN_S_DAY;
        if ($this->getWeekDay(mktime(0, 0, 0, 5, 5, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[6] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        if ($year >= 2007) {
            // [5/3, 5/4が日曜]なら、振替休日
            if (($this->getWeekday(mktime(0, 0, 0, 5, 4, $year), $timezone) == JapaneseDateTime::SUNDAY) || ($this->getWeekday(mktime(0, 0, 0, 5, 3, $year), $timezone) == JapaneseDateTime::SUNDAY)) {
                $res[6] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック六月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getJuneHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year == '1993') {
            $res[9] = JapaneseDateTime::CROWN_PRINCE_NARUHITO_WEDDING;
        } else {
            $res = array();
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック七月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getJulyHoliday($year, $timezone)
    {
        if ($year <= JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year >= 2003) {
            $third_monday = $this->getDayByWeekly($year, 7, JapaneseDateTime::MONDAY, 3, $timezone);
            $res[$third_monday] = JapaneseDateTime::MARINE_DAY;
        } elseif ($year >= 1996) {
            $res[20] = JapaneseDateTime::MARINE_DAY;
            // 振替休日確認
            if ($this->getWeekDay(mktime(0, 0, 0, 7, 20, $year), $timezone) == JapaneseDateTime::SUNDAY) {
                $res[21] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        } else {
            $res = array();
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック八月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getAugustHoliday($year, $timezone)
    {
        if ($year < JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year >= 2016) {
            $res[11] = JapaneseDateTime::MOUNTAIN_DAY;
            // 振替休日確認
            if ($this->getWeekDay(mktime(0, 0, 0, 8, 11, $year), $timezone) == JapaneseDateTime::SUNDAY) {
                $res[12] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック九月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getSeptemberHoliday($year, $timezone)
    {
        if ($year < JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        $autumnEquinoxDay = $this->getAutumnEquinoxDay($year);
        $res[$this->getDay($autumnEquinoxDay, $timezone)] = JapaneseDateTime::AUTUMNAL_EQUINOX_DAY;

        // 振替休日確認
        if ($this->getWeekDay($autumnEquinoxDay, $timezone) == 0) {
            $res[$this->getDay($autumnEquinoxDay, $timezone)+1] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }

        if ($year >= 2003) {
            $third_monday = $this->getDayByWeekly($year, 9, JapaneseDateTime::MONDAY, 3, $timezone);
            $res[$third_monday] = JapaneseDateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY;

            // 敬老の日と、秋分の日の間の日は休みになる
            if (($this->getDay($autumnEquinoxDay, $timezone) - 1) == ($third_monday + 1)) {
                $res[($this->getDay($autumnEquinoxDay, $timezone) - 1)] = JapaneseDateTime::NATIONAL_HOLIDAY;
            }

        } elseif ($year >= 1966) {
            $res[15] = JapaneseDateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY;
            // 振替休日確認
            if ($this->getWeekDay(mktime(0, 0, 0, 9, 15, $year), $timezone) == JapaneseDateTime::SUNDAY) {
                $res[16] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック十月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getOctoberHoliday($year, $timezone)
    {
        if ($year < JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year >= 2000) {
            // 2000年以降は第二月曜日に変更
            $second_monday = $this->getDayByWeekly($year, 10, JapaneseDateTime::MONDAY, 2, $timezone);
            $res[$second_monday] = JapaneseDateTime::SPORTS_DAY;
        } elseif ($year >= 1966) {
            $res[10] = JapaneseDateTime::SPORTS_DAY;
            // 振替休日確認
            if ($this->getWeekDay(mktime(0, 0, 0, 10, 10, $year), $timezone) == JapaneseDateTime::SUNDAY) {
                $res[11] = JapaneseDateTime::COMPENSATING_HOLIDAY;
            }
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック十一月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getNovemberHoliday($year, $timezone)
    {
        if ($year < JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        $res[3] = JapaneseDateTime::CULTURE_DAY;
        // 振替休日確認
        if ($this->getWeekDay(mktime(0, 0, 0, 11, 3, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[4] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }

        if ($year == 1990) {
            $res[12] = JapaneseDateTime::REGNAL_DAY;
        }

        $res[23] = JapaneseDateTime::LABOR_THANKSGIVING_DAY;
        // 振替休日確認
        if ($this->getWeekDay(mktime(0, 0, 0, 11, 23, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[24] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日判定ロジック十二月
     *
     * @access      protected
     * @param       int $year 年
     * @param $timezone
     * @return      array
     */
    protected function getDecemberHoliday($year, $timezone)
    {
        if ($year < JapaneseDateTime::HOLIDAY_START_YEAR) {
            return array();
        }
        $res = array();
        if ($year >= 1989) {
            $res[23] = JapaneseDateTime::THE_EMPEROR_S_BIRTHDAY;
        }
        if ($this->getWeekDay(mktime(0, 0, 0, 12, 23, $year), $timezone) == JapaneseDateTime::SUNDAY) {
            $res[24] = JapaneseDateTime::COMPENSATING_HOLIDAY;
        }
        return $res;
    }
    /* ----------------------------------------- */


    /**
     * +-- 七曜を数値化して返します
     *
     *
     * @access      protected
     * @param $time_stamp
     * @return      int
     */
    protected function getWeekday($time_stamp)
    {
        return (int)$this->JapaneseDateTime($time_stamp)->format('w');
    }
    /* ----------------------------------------- */


    /**
     * +-- 日を数値化して返します
     *
     * @access      protected
     * @param $time_stamp
     * @return      int
     */
    protected function getDay($time_stamp)
    {
        return (int)$this->JapaneseDateTime($time_stamp)->format('j');
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      protected
     * @param       mixed $time_stamp
     * @param null $timezone
     * @return      JapaneseDateTime
     */
    protected function JapaneseDateTime($time_stamp, $timezone = NULL)
    {
        // @codeCoverageIgnoreStart
        if ($time_stamp instanceof JapaneseDateTime) {
            return $time_stamp;
        }
        // @codeCoverageIgnoreEnd
        return new JapaneseDateTime($time_stamp, $timezone);
    }
    /* ----------------------------------------- */


}
