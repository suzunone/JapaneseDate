<?php
/**
 * 日本語/和暦日付クラスメインファイル
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Components;

use DateTimeZone;
use JapaneseDate\DateTime;
use JapaneseDate\Exceptions\ErrorException;

/**
 * 日本語/和暦日付クラス
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class JapaneseDate
{
    /**#@+
     * @access private
     */
    /**
     * @var array
     */
    public const WEEKDAY_NAME = ['日', '月', '火', '水', '木', '金', '土'];
    /**
     * @var array
     */
    public const MONTH_NAME = ['', '睦月', '如月', '弥生', '卯月', '皐月', '水無月', '文月', '葉月', '長月', '神無月', '霜月', '師走'];
    /**
     * @var array
     */
    public const SIX_WEEKDAY = ['大安', '赤口', '先勝', '友引', '先負', '仏滅'];

    /**#@-*/
    /**
     * @var array
     */
    public const ORIENTAL_ZODIAC = ['亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', ];
    /**
     * @var array
     */
    public const SOLAR_TERM = [
        '春分', '清明', '穀雨', '立夏', '小満',
        '芒種', '夏至', '小暑', '大暑', '立秋',
        '処暑', '白露', '秋分', '寒露', '霜降',
        '立冬', '小雪', '大雪', '冬至', '小寒',
        '大寒', '立春', '雨水', '啓蟄',
    ];
    /**
     * @var int
     */
    public const VERNAL_EQUINOX = 0;
    /**
     * @var int
     */
    public const AUTUMNAL_EQUINOX = 12;
    /**
     * 旧暦クラスオブジェクト
     *
     * @var \JapaneseDate\Components\LunarCalendar
     */
    private $LunarCalendar;
    /**
     * @var array
     */
    private $holiday_name;
    /**
     * @var array
     */
    private $era_name;

    /**
     * コンストラクタ
     *
     * @access public
     * @params
     * @return      void
     */
    public function __construct()
    {
        $this->LunarCalendar = LunarCalendar::factory();

        $this->era_name = [
            DateTime::ERA_MEIJI  => '明治',
            DateTime::ERA_TAISHO => '大正',
            DateTime::ERA_SHOWA  => '昭和',
            DateTime::ERA_HEISEI => '平成',
            DateTime::ERA_REIWA  => '令和',
        ];

        $this->holiday_name = [
            DateTime::NO_HOLIDAY                      => '',
            DateTime::NEW_YEAR_S_DAY                  => '元旦',
            DateTime::COMING_OF_AGE_DAY               => '成人の日',
            DateTime::NATIONAL_FOUNDATION_DAY         => '建国記念の日',
            DateTime::THE_SHOWA_EMPEROR_DIED          => '昭和天皇の大喪の礼',
            DateTime::VERNAL_EQUINOX_DAY              => '春分の日',
            DateTime::DAY_OF_SHOWA                    => '昭和の日',
            DateTime::GREENERY_DAY                    => 'みどりの日',
            DateTime::THE_EMPEROR_S_BIRTHDAY          => '天皇誕生日',
            DateTime::CROWN_PRINCE_HIROHITO_WEDDING   => '皇太子明仁親王の結婚の儀',
            DateTime::CONSTITUTION_DAY                => '憲法記念日',
            DateTime::NATIONAL_HOLIDAY                => '国民の休日',
            DateTime::CHILDREN_S_DAY                  => 'こどもの日',
            DateTime::COMPENSATING_HOLIDAY            => '振替休日',
            DateTime::CROWN_PRINCE_NARUHITO_WEDDING   => '皇太子徳仁親王の結婚の儀',
            DateTime::MARINE_DAY                      => '海の日',
            DateTime::AUTUMNAL_EQUINOX_DAY            => '秋分の日',
            DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY => '敬老の日',
            DateTime::LEGACY_SPORTS_DAY               => '体育の日',
            DateTime::SPORTS_DAY                      => 'スポーツの日',
            DateTime::CULTURE_DAY                     => '文化の日',
            DateTime::LABOR_THANKSGIVING_DAY          => '勤労感謝の日',
            DateTime::REGNAL_DAY                      => '即位礼正殿の儀',
            DateTime::MOUNTAIN_DAY                    => '山の日',
            DateTime::EMPERORS_THRONE_DAY             => '天皇の即位の日',
        ];
    }

    /**
     * ファクトリー
     *
     * @access      public
     * @static
     * @return \JapaneseDate\Components\JapaneseDate
     */
    public static function factory(): JapaneseDate
    {
        static $instance;
        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * 指定月の祝日リストを取得する
     *
     * @access      public
     * @param DateTime|\JapaneseDate\Traits\Modern $DateTime DateTime
     * @return      array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getHolidayList(DateTime $DateTime): array
    {
        switch ((int) $DateTime->month) {
            case 1:
                return $this->getJanuaryHoliday($DateTime->year, $DateTime->getTimezone());
            case 2:
                return $this->getFebruaryHoliday($DateTime->year, $DateTime->getTimezone());
            case 3:
                return $this->getMarchHoliday($DateTime->year, $DateTime->getTimezone());
            case 4:
                return $this->getAprilHoliday($DateTime->year, $DateTime->getTimezone());
            case 5:
                return $this->getMayHoliday($DateTime->year, $DateTime->getTimezone());
            case 6:
                return $this->getJuneHoliday($DateTime->year);
            case 7:
                return $this->getJulyHoliday($DateTime->year, $DateTime->getTimezone());
            case 8:
                return $this->getAugustHoliday($DateTime->year, $DateTime->getTimezone());
            case 9:
                return $this->getSeptemberHoliday($DateTime->year, $DateTime->getTimezone());
            case 10:
                return $this->getOctoberHoliday($DateTime->year, $DateTime->getTimezone());
            case 11:
                return $this->getNovemberHoliday($DateTime->year, $DateTime->getTimezone());
            case 12:
                return $this->getDecemberHoliday($DateTime->year, $DateTime->getTimezone());
            default:
                // 起こり得ないが、念のため
                // @codeCoverageIgnoreStart
                throw new ErrorException('undefined month');
            // @codeCoverageIgnoreEnd

        }
    }

    /**
     * 祝日判定ロジック一月
     *
     * @access      protected
     * @param int $year 年
     * @param           $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getJanuaryHoliday(int $year, $timezone): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        $res[1] = DateTime::NEW_YEAR_S_DAY;
        // 振替休日確認
        if ($this->getWeekday(mktime(0, 0, 0, 1, 1, $year), $timezone) === DateTime::SUNDAY) {
            $res[2] = DateTime::COMPENSATING_HOLIDAY;
        }
        if ($year >= 2000) {
            //2000年以降は第二月曜日に変更
            $second_monday = $this->getDayByWeekly($year, 1, DateTime::MONDAY, 2, $timezone);
            $res[$second_monday] = DateTime::COMING_OF_AGE_DAY;
        } else {
            $res[15] = DateTime::COMING_OF_AGE_DAY;
            // 振替休日確認
            if ($this->getWeekday(mktime(0, 0, 0, 1, 15, $year), $timezone) === DateTime::SUNDAY) {
                $res[16] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        return $res;
    }

    /**
     * 曜日を数値化して返します
     *
     * @param string|null|int|\DateTime $time
     * @param DateTimeZone|null $time_zone
     * @return int
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getWeekday($time = null, DateTimeZone $time_zone = null): int
    {
        return DateTime::factory($time, $time_zone)->dayOfWeek;
    }

    /**
     * 第○ ■曜日の日付を取得します。
     *
     * @access      public
     * @param int $year   年
     * @param int $month  月
     * @param int $weekly 曜日
     * @param int $weeks  何週目か
     * @param null|DateTimeZone $timezone
     * @return      int
     * @throws ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getDayByWeekly(int $year, int $month, int $weekly, int $weeks = 1, $timezone = null): int
    {
        switch ($weekly) {
            case DateTime::SUNDAY:
                $map = [7, 1, 2, 3, 4, 5, 6, ];
                break;
            case DateTime::MONDAY:
                $map = [6, 7, 1, 2, 3, 4, 5, ];
                break;
            case DateTime::TUESDAY:
                $map = [5, 6, 7, 1, 2, 3, 4, ];
                break;
            case DateTime::WEDNESDAY:
                $map = [4, 5, 6, 7, 1, 2, 3, ];
                break;
            case DateTime::THURSDAY:
                $map = [3, 4, 5, 6, 7, 1, 2, ];
                break;
            case DateTime::FRIDAY:
                $map = [2, 3, 4, 5, 6, 7, 1, ];
                break;
            case DateTime::SATURDAY:
                $map = [1, 2, 3, 4, 5, 6, 7, ];
                break;
            default:
                throw new ErrorException('undefined weekly ' . $weekly);
                break;
        }

        $weeks = 7 * $weeks + 1;

        return $weeks - $map[$this->getWeekday(mktime(0, 0, 0, $month, 1, $year), $timezone)];
    }

    /**
     * 祝日判定ロジック二月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getFebruaryHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }

        $res = [];
        $res[11] = DateTime::NATIONAL_FOUNDATION_DAY;

        // 振替休日確認
        if ($this->getWeekday(mktime(0, 0, 0, 2, 11, $year), $timezone) === DateTime::SUNDAY) {
            $res[12] = DateTime::COMPENSATING_HOLIDAY;
        }
        if ($year === 1989) {
            $res[24] = DateTime::THE_SHOWA_EMPEROR_DIED;
        }

        if ($year >= 2020) {
            $res[23] = DateTime::THE_EMPEROR_S_BIRTHDAY;

            // 振替休日
            if ($this->getWeekday(mktime(0, 0, 0, 2, 23, $year), $timezone) === DateTime::SUNDAY) {
                $res[24] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        return $res;
    }

    /**
     * 祝日判定ロジック三月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getMarchHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }

        $res = [];
        $VernalEquinoxDay = $this->getVernalEquinoxDay($year);
        $res[$this->getDay($VernalEquinoxDay, $timezone)] = DateTime::VERNAL_EQUINOX_DAY;
        // 振替休日確認
        if ($this->getWeekday($VernalEquinoxDay, $timezone) === DateTime::SUNDAY) {
            $res[$this->getDay($VernalEquinoxDay, $timezone) + 1] = DateTime::COMPENSATING_HOLIDAY;
        }

        return $res;
    }

    /**
     * 春分の日を取得
     *
     * @access      public
     * @param int $year
     * @return      int タイムスタンプ
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getVernalEquinoxDay(int $year): int
    {
        if ($year <= 1979) {
            $day = floor(20.8357 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2099) {
            $day = floor(20.8431 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2150) {
            $day = floor(21.851 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } else {
            $DateTime = new DateTime($year . '-03-15');
            while ($DateTime->month === 3) {
                $DateTime->addDay();
                $Element = $this->LunarCalendar->getLunarDate($DateTime);
                if ($Element->solar_term === self::VERNAL_EQUINOX) {
                    break;
                }
            }

            $day = $DateTime->day;
        }

        return mktime(0, 0, 0, DateTime::VERNAL_EQUINOX_DAY_MONTH, $day, $year);
    }

    /**
     * 日を数値化して返します
     *
     * @access      protected
     * @param string|null|int|\DateTime $time
     * @param DateTimeZone|null $time_zone
     * @return      int
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getDay($time = null, DateTimeZone $time_zone = null): int
    {
        return DateTime::factory($time, $time_zone)->day;
    }

    /**
     * 祝日判定ロジック四月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getAprilHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        if ($year === 1959) {
            $res[10] = DateTime::CROWN_PRINCE_HIROHITO_WEDDING;
        }
        if ($year >= 2007) {
            $res[29] = DateTime::DAY_OF_SHOWA;
        } elseif ($year >= 1989) {
            $res[29] = DateTime::GREENERY_DAY;
        } else {
            $res[29] = DateTime::THE_EMPEROR_S_BIRTHDAY;
        }
        // 振替休日確認
        if ($this->getWeekday(mktime(0, 0, 0, 4, 29, $year), $timezone) === DateTime::SUNDAY) {
            $res[30] = DateTime::COMPENSATING_HOLIDAY;
        } elseif ($year === 2019) {
            // 2019年、特別な祝日
            $res[30] = DateTime::NATIONAL_HOLIDAY;
        }

        return $res;
    }

    /**
     * 祝日判定ロジック五月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getMayHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        if ($year >= 1947) {
            $res[3] = DateTime::CONSTITUTION_DAY;
        }
        if ($year >= 2007) {
            $res[4] = DateTime::GREENERY_DAY;
        } elseif ($year >= 1986) {
            // 5/4が日曜日の場合はそのまま､月曜日の場合は『憲法記念日の振替休日』(2006年迄)
            if ($this->getWeekday(mktime(0, 0, 0, 5, 4, $year), $timezone) > DateTime::MONDAY) {
                $res[4] = DateTime::NATIONAL_HOLIDAY;
            } elseif ($this->getWeekday(mktime(0, 0, 0, 5, 4, $year), $timezone) === DateTime::MONDAY) {
                $res[4] = DateTime::COMPENSATING_HOLIDAY;
            }
        } elseif ($year >= 1947) {
            if ($this->getWeekday(mktime(0, 0, 0, 5, 3, $year), $timezone) === DateTime::SUNDAY) {
                $res[4] = DateTime::COMPENSATING_HOLIDAY;
            }
        }
        $res[5] = DateTime::CHILDREN_S_DAY;
        if ($this->getWeekday(mktime(0, 0, 0, 5, 5, $year), $timezone) === DateTime::SUNDAY) {
            $res[6] = DateTime::COMPENSATING_HOLIDAY;
        }
        if ($year >= 2007) {
            // [5/3, 5/4が日曜]なら、振替休日
            if (($this->getWeekday(mktime(0, 0, 0, 5, 4, $year), $timezone) === DateTime::SUNDAY) || ($this->getWeekday(mktime(0, 0, 0, 5, 3, $year), $timezone) === DateTime::SUNDAY)) {
                $res[6] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        // 2019年、特別な祝日
        if ($year === 2019) {
            $res[1] = DateTime::EMPERORS_THRONE_DAY;
            $res[2] = DateTime::NATIONAL_HOLIDAY;
        }

        return $res;
    }

    /**
     * 祝日判定ロジック六月
     *
     * @access      protected
     * @param int $year 年
     * @return      array
     */
    protected function getJuneHoliday(int $year): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        if ($year === 1993) {
            $res[9] = DateTime::CROWN_PRINCE_NARUHITO_WEDDING;
        } else {
            $res = [];
        }

        return $res;
    }

    /**
     * 祝日判定ロジック七月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getJulyHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year <= DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        if ($year === DateTime::SECOND_TIME_TOKYO_OLYMPIC_YEAR) {
            // 東京オリンピックのため海の日移動
            $res[23] = DateTime::MARINE_DAY;
            // 2020以降はスポーツの日
            $res[24] = DateTime::SPORTS_DAY;
        } elseif ($year === DateTime::SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR) {
            // 東京オリンピックのため海の日移動
            $res[22] = DateTime::MARINE_DAY;
            // 2020以降はスポーツの日
            $res[23] = DateTime::SPORTS_DAY;
        } elseif ($year >= 2003) {
            $third_monday = $this->getDayByWeekly($year, 7, DateTime::MONDAY, 3, $timezone);
            $res[$third_monday] = DateTime::MARINE_DAY;
        } elseif ($year >= 1996) {
            $res[20] = DateTime::MARINE_DAY;
            // 振替休日確認
            if ($this->getWeekday(mktime(0, 0, 0, 7, 20, $year), $timezone) === DateTime::SUNDAY) {
                $res[21] = DateTime::COMPENSATING_HOLIDAY;
            }
        } else {
            $res = [];
        }

        return $res;
    }

    /**
     * 祝日判定ロジック八月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getAugustHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year < DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        if ($year === DateTime::SECOND_TIME_TOKYO_OLYMPIC_YEAR) {
            // 東京オリンピックのため山の日
            $res[10] = DateTime::MOUNTAIN_DAY;
        } elseif ($year === DateTime::SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR) {
            // 東京オリンピックのため山の日
            $res[8] = DateTime::MOUNTAIN_DAY;
        } elseif ($year >= 2016) {
            $res[11] = DateTime::MOUNTAIN_DAY;
            // 振替休日確認
            if ($this->getWeekday(mktime(0, 0, 0, 8, 11, $year), $timezone) === DateTime::SUNDAY) {
                $res[12] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        return $res;
    }

    /**
     * 祝日判定ロジック九月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getSeptemberHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year < DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        $autumnEquinoxDay = $this->getAutumnEquinoxDay($year);
        $res[$this->getDay($autumnEquinoxDay, $timezone)] = DateTime::AUTUMNAL_EQUINOX_DAY;

        // 振替休日確認
        if ($this->getWeekday($autumnEquinoxDay, $timezone) === DateTime::SUNDAY) {
            $res[$this->getDay($autumnEquinoxDay, $timezone) + 1] = DateTime::COMPENSATING_HOLIDAY;
        }

        if ($year >= 2003) {
            $third_monday = $this->getDayByWeekly($year, 9, DateTime::MONDAY, 3, $timezone);
            $res[$third_monday] = DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY;

            // 敬老の日と、秋分の日の間の日は休みになる
            if (($this->getDay($autumnEquinoxDay, $timezone) - 1) === ($third_monday + 1)) {
                $res[$this->getDay($autumnEquinoxDay, $timezone) - 1] = DateTime::NATIONAL_HOLIDAY;
            }
        } elseif ($year >= 1966) {
            $res[15] = DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY;
            // 振替休日確認
            if ($this->getWeekday(mktime(0, 0, 0, 9, 15, $year), $timezone) === DateTime::SUNDAY) {
                $res[16] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        return $res;
    }

    /**
     * 秋分の日を取得
     *
     * @access      public
     * @param int $year
     * @return      int タイムスタンプ
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getAutumnEquinoxDay(int $year): int
    {
        if ($year <= 1979) {
            $day = floor(23.2588 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2099) {
            $day = floor(23.2488 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } elseif ($year <= 2150) {
            $day = floor(24.2488 + (0.242194 * ($year - 1980)) - floor(($year - 1980) / 4));
        } else {
            $DateTime = new DateTime($year . '-09-15');
            while ((int) $DateTime->month === 9) {
                $DateTime->addDay();
                $Element = $this->LunarCalendar->getLunarDate($DateTime);
                if ($Element->solar_term === self::AUTUMNAL_EQUINOX) {
                    break;
                }
            }

            $day = $DateTime->day;
        }

        return mktime(0, 0, 0, DateTime::AUTUMNAL_EQUINOX_DAY_MONTH, $day, $year);
    }

    /**
     * 祝日判定ロジック十月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getOctoberHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year < DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];

        if ($year === 2019) {
            $res[22] = DateTime::REGNAL_DAY;
        }

        if ($year === DateTime::SECOND_TIME_TOKYO_OLYMPIC_YEAR) {
            // 東京オリンピックのため体育の日移動
            return $res;
        } elseif ($year === DateTime::SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR) {
            // 東京オリンピックのため体育の日移動
            return $res;
        }

        // 体育の日・スポーツの日判定
        if ($year >= DateTime::SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR)) {
            // 2020年以降はスポーツの日
            $second_monday = $this->getDayByWeekly($year, 10, DateTime::MONDAY, 2, $timezone);
            $res[$second_monday] = DateTime::SPORTS_DAY;
        } elseif ($year >= 2000) {
            // 2000年以降は第二月曜日に変更
            $second_monday = $this->getDayByWeekly($year, 10, DateTime::MONDAY, 2, $timezone);
            $res[$second_monday] = DateTime::LEGACY_SPORTS_DAY;
        } elseif ($year >= 1966) {
            $res[10] = DateTime::LEGACY_SPORTS_DAY;
            // 振替休日確認
            if ($this->getWeekday(mktime(0, 0, 0, 10, 10, $year), $timezone) === DateTime::SUNDAY) {
                $res[11] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        return $res;
    }

    /**
     * 祝日判定ロジック十一月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getNovemberHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year < DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        $res[3] = DateTime::CULTURE_DAY;
        // 振替休日確認
        if ($this->getWeekday(mktime(0, 0, 0, 11, 3, $year), $timezone) === DateTime::SUNDAY) {
            $res[4] = DateTime::COMPENSATING_HOLIDAY;
        }

        if ($year === 1990) {
            $res[12] = DateTime::REGNAL_DAY;
        }

        $res[23] = DateTime::LABOR_THANKSGIVING_DAY;
        // 振替休日確認
        if ($this->getWeekday(mktime(0, 0, 0, 11, 23, $year), $timezone) === DateTime::SUNDAY) {
            $res[24] = DateTime::COMPENSATING_HOLIDAY;
        }

        return $res;
    }

    /**
     * 祝日判定ロジック十二月
     *
     * @access      protected
     * @param int $year 年
     * @param DateTimeZone $timezone
     * @return      array
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getDecemberHoliday(int $year, DateTimeZone $timezone): array
    {
        if ($year < DateTime::HOLIDAY_START_YEAR) {
            return [];
        }
        $res = [];
        if ($year >= 1989 && $year <= 2018) {
            $res[23] = DateTime::THE_EMPEROR_S_BIRTHDAY;

            if ($this->getWeekday(mktime(0, 0, 0, 12, 23, $year), $timezone) === DateTime::SUNDAY) {
                $res[24] = DateTime::COMPENSATING_HOLIDAY;
            }
        }

        return $res;
    }

    /**
     * 日本語フォーマットされた休日名を返す
     *
     * @access      public
     * @param int $key 休日キー
     * @return      string
     */
    public function viewHoliday($key): string
    {
        return $this->holiday_name[$key] ?? '';
    }

    /**
     * 日本語フォーマットされた曜日名を返す
     *
     * @access      public
     * @param int $key 曜日キー
     * @return      string
     */
    public function viewWeekday($key): string
    {
        if ($key >= count(self::WEEKDAY_NAME)) {
            $key -= count(self::WEEKDAY_NAME);
        }

        return self::WEEKDAY_NAME[$key];
    }

    /**
     * 日本語フォーマットされた旧暦月名を返す
     *
     * @access      public
     * @param int $key 月キー
     * @return      string
     */
    public function viewMonth($key): string
    {
        return self::MONTH_NAME[$key];
    }

    /**
     * 日本語フォーマットされた六曜名を返す
     *
     * @access      public
     * @param int $key 六曜キー
     * @return      string
     */
    public function viewSixWeekday($key): string
    {
        return self::SIX_WEEKDAY[$key] ?? '';
    }

    /**
     * 日本語フォーマットされた干支を返す
     *
     * @access      public
     * @param int $key 干支キー
     * @return      string
     */
    public function viewOrientalZodiac($key): string
    {
        return self::ORIENTAL_ZODIAC[$key] ?? '';
    }

    /**
     * 日本語フォーマットされた年号を返す
     *
     * @access      public
     * @param int $key 年号キー
     * @return      string
     */
    public function viewEraName($key): string
    {
        return $this->era_name[$key] ?? '';
    }
}
