<?php

namespace JapaneseDate;

/**
 * 日本の暦対応のDateTimeオブジェクト拡張
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateTime
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @see         https://carbon.nesbot.com/docs/
 * @since       Class available since Release 1.0.0
 */
use Carbon\Carbon;
use DateTimeInterface;
use DateTimeZone;
use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;


/**
 * 日本の暦対応のDateTimeオブジェクト拡張
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateTime
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @see         https://carbon.nesbot.com/docs/
 * @since       Class available since Release 1.0.0
 * @property  int|bool $solar_term
 * @property  string $solar_term_text
 * @property bool $is_solar_term
 * @property string $era_name_text
 * @property int $era_name
 * @property int $era_year
 * @property string $oriental_zodiac_text
 * @property int $oriental_zodiac
 * @property string $six_weekday_text
 * @property int $six_weekday
 * @property int $weekday_text
 * @property string $month_text
 * @property string $holiday_text
 * @property int $holiday
 * @property string $lunar_month_text
 * @property int $lunar_month
 * @property int $lunar_year
 * @property int $lunar_day
 * @property bool $is_leap_month
 *
 */
class DateTime extends Carbon
{
    /**
     * 祝日定数
     *
     * @var int
     */
    const NO_HOLIDAY = 0;
    /**
     * 祝日定数
     *
     * @var int
     */
    const NEW_YEAR_S_DAY = 1;
    /**
     * 祝日定数
     *
     * @var int
     */
    const COMING_OF_AGE_DAY = 2;
    /**
     * 祝日定数
     *
     * @var int
     */
    const NATIONAL_FOUNDATION_DAY = 3;
    /**
     * 祝日定数
     *
     * @var int
     */
    const THE_SHOWA_EMPEROR_DIED = 4;
    /**
     * 祝日定数
     *
     * @var int
     */
    const VERNAL_EQUINOX_DAY = 5;
    /**
     * 祝日定数
     *
     * @var int
     */
    const DAY_OF_SHOWA = 6;
    /**
     * 祝日定数
     *
     * @var int
     */
    const GREENERY_DAY = 7;
    /**
     * 祝日定数
     *
     * @var int
     */
    const THE_EMPEROR_S_BIRTHDAY = 8;
    /**
     * 祝日定数
     *
     * @var int
     */
    const CROWN_PRINCE_HIROHITO_WEDDING = 9;
    /**
     * 祝日定数
     *
     * @var int
     */
    const CONSTITUTION_DAY = 10;
    /**
     * 祝日定数
     *
     * @var int
     */
    const NATIONAL_HOLIDAY = 11;
    /**
     * 祝日定数
     *
     * @var int
     */
    const CHILDREN_S_DAY = 12;
    /**
     * 祝日定数
     *
     * @var int
     */
    const COMPENSATING_HOLIDAY = 13;
    /**
     * 祝日定数
     *
     * @var int
     */
    const CROWN_PRINCE_NARUHITO_WEDDING = 14;
    /**
     * 祝日定数
     *
     * @var int
     */
    const MARINE_DAY = 15;
    /**
     * 祝日定数
     *
     * @var int
     */
    const AUTUMNAL_EQUINOX_DAY = 16;
    /**
     * 祝日定数
     *
     * @var int
     */
    const RESPECT_FOR_SENIOR_CITIZENS_DAY = 17;
    /**
     * 祝日定数
     *
     * @var int
     */
    const SPORTS_DAY = 18;
    /**
     * 祝日定数
     *
     * @var int
     */
    const CULTURE_DAY = 19;
    /**
     * 祝日定数
     *
     * @var int
     */
    const LABOR_THANKSGIVING_DAY = 20;
    /**
     * 祝日定数
     *
     * @var int
     */
    const REGNAL_DAY = 21;
    /**
     * 祝日定数
     *
     * @var int
     */
    const MOUNTAIN_DAY = 22;

    /**
     * 祝日法制定年
     *
     * @var int
     */
    const HOLIDAY_START_YEAR = 1948;

    /**
     * 特定月定数 春分の日
     *
     * @var int
     */
    const VERNAL_EQUINOX_DAY_MONTH = 3;

    /**
     * 特定月定数 秋分の日
     *
     * @var int
     */
    const AUTUMNAL_EQUINOX_DAY_MONTH = 9;

    /**
     * 曜日定数(日)
     *
     * @var int
     */
    const SUNDAY = 0;

    /**
     * 曜日定数(月)
     *
     * @var int
     */
    const MONDAY = 1;

    /**
     * 曜日定数(火)
     *
     * @var int
     */
    const TUESDAY = 2;

    /**
     * 曜日定数(水)
     *
     * @var int
     */
    const WEDNESDAY = 3;

    /**
     * 曜日定数(木)
     *
     * @var int
     */
    const THURSDAY = 4;

    /**
     * 曜日定数(金)
     *
     * @var int
     */
    const FRIDAY = 5;

    /**
     * 曜日定数(土)
     *
     * @var int
     */
    const SATURDAY = 6;

    /**
     * 元号 (明治)
     *
     * @var int
     */
    const ERA_MEIJI = 1000;

    /**
     * 元号 (対象)
     *
     * @var int
     */
    const ERA_TAISHO = 1001;

    /**
     * 元号 (昭和)
     *
     * @var int
     */
    const ERA_SHOWA = 1002;

    /**
     * 元号 (平成)
     *
     * @var int
     */
    const ERA_HEISEI = 1003;

    /**
     * 元号 (平成の次)
     *
     * @var int
     * @deprecated
     */
    const ERA_HEISEI_NEXT = 1004;

    /**
     * @var \JapaneseDate\Components\JapaneseDate
     */
    private $JapaneseDate;

    /**
     * @var \JapaneseDate\Components\LunarCalendar
     */
    private $LunarCalendar;

    /**
     * @var array
     */
    private $lunar_calendar = [];

    /**
     * DateTime constructor.
     *
     * @param string|null|DateTimeInterface $time
     * @param DateTimeZone|null $time_zone
     */
    public function __construct($time = null, DateTimeZone $time_zone = null)
    {
        if (is_int($time) || ctype_digit($time)) {
            $time = date('Y-m-d H:i:s', $time);
        } elseif ($time instanceof DateTimeInterface) {
            $time = $time->format('Y-m-d H:i:s');
        }

        parent::__construct($time, $time_zone);

        $this->JapaneseDate  = JapaneseDate::factory();
        $this->LunarCalendar = LunarCalendar::factory();
    }

    /**
     * @param mixed $date_time
     * @param DateTimeZone|null $time_zone
     * @return static
     */
    public static function factory($date_time = 'now', DateTimeZone $time_zone = null)
    {
        if (is_int($date_time) || ctype_digit($date_time)) {
            return new static(date('Y-m-d H:i:s', $date_time), $time_zone);
        } elseif ($date_time instanceof DateTimeInterface) {
            return new static($date_time->format('Y-m-d H:i:s'), $time_zone ?? $date_time->getTimezone());
        }

        return new static($date_time, $time_zone);
    }


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
     * @return string
     * @throws \ErrorException
     */
    public function strftime($format)
    {
        $res_str      = '';
        $format_array = explode('%', $format);
        foreach ($format_array as $key => $strings) {
            if ($key === 0) {
                $res_str .= $strings;
                continue;
            }
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
                        $re_format = ' ' . $re_format;
                    }
                    break;
                case 'g':
                    $re_format = $this->format('n');
                    if (strlen($re_format) === 1) {
                        $re_format = ' ' . $re_format;
                    }
                    break;
                case 'J':
                    $re_format = $this->format('j');
                    break;
                case 'G':
                    $re_format = $this->viewMonth();
                    break;
                case 'N':
                    $re_format = $this->month;
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
                    $re_format = '%' . substr($strings, 0, 1);
                    break;
            }
            $res_str .= $re_format . mb_substr($strings, 1);
        }

        return strftime($res_str, $this->timestamp);
    }
    /* ----------------------------------------- */


    /**
     * カレンダーの取得
     *
     * @access      public
     * @param int $calendar
     * @return      array
     */
    public function getCalendar($calendar = CAL_GREGORIAN)
    {
        return cal_from_jd(unixtojd($this->timestamp), $calendar);
    }

    /**
     * @param string $name
     * @return DateTimeZone|int|string
     * @throws \ErrorException
     */
    public function __get($name)
    {
        switch ($name) {
            case 'solar_term_text':
                return $this->getSolarTerm();
            case 'solar_term':
                return $this->getSolarTermKey();
            case 'is_solar_term':
                return $this->isSolarTerm();
            case 'era_name_text':
                return $this->viewEraName();
            case 'era_name':
                return $this->getEraName();
            case 'era_year':
                return $this->getEraYear();
            case 'oriental_zodiac_text':
                return $this->viewOrientalZodiac();
            case 'oriental_zodiac':
                return $this->getOrientalZodiac();
            case 'six_weekday_text':
                return $this->viewSixWeekday();
            case 'six_weekday':
                return $this->getSixWeekday();
            case 'weekday_text':
                return $this->viewWeekday();
            case 'month_text':
                return $this->viewMonth();
            case 'holiday_text':
                return $this->viewHoliday();
            case 'holiday':
                return $this->getHoliday();
            case 'lunar_month_text':
                return $this->viewLunarMonth();
            case 'lunar_month':
                return $this->getLunarMonth();
            case 'lunar_year':
                return $this->getLunarYear();
            case 'lunar_day':
                return $this->getLunarDay();
            case 'is_leap_month':
                return $this->isLeapMonth();


        }

        return parent::__get($name);
    }


    /**
     * 24節気を取得する
     *
     * @return bool|int
     * @throws \ErrorException
     * @throws \ErrorException
     */
    protected function getSolarTermKey()
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->solar_term;
    }


    /**
     * 24節気を取得する
     *
     * @return string
     * @throws \ErrorException
     * @throws \ErrorException
     */
    protected function getSolarTerm()
    {
        $lunar_calendar = $this->getLunarCalendar();

        if ($lunar_calendar->solar_term === false) {
            return '';
        }

        return JapaneseDate::SOLAR_TERM[$lunar_calendar->solar_term];
    }


    /**
     * 旧暦データ取得
     *
     * @return      \JapaneseDate\Elements\LunarDate
     * @throws \ErrorException
     */
    protected function getLunarCalendar()
    {
        $mdy = $this->month . '-' . $this->day . '-' . $this->year;
        if (!isset($this->lunar_calendar[$mdy])) {
            $this->lunar_calendar[$mdy] = $this->LunarCalendar->getLunarDate(
                $this
            );
        }

        return $this->lunar_calendar[$mdy];
    }

    /**
     * ２４節気かどうか
     *
     * @return      boolean
     * @throws \ErrorException
     */
    protected function isSolarTerm()
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->solar_term !== false;
    }


    /**
     * 日本語フォーマットされた年号を返す
     *
     * @return      string
     */
    protected function viewEraName()
    {
        $key = $this->getEraName();

        return $this->JapaneseDate->viewEraName($key);
    }

    /**
     * 年号キーを返す
     *
     * @return int
     */
    protected function getEraName()
    {
        $TaishoStart     = new DateTime('1912-07-30 00:00:00', $this->getTimezone());
        $ShowaStart      = new DateTime('1926-12-25 00:00:00', $this->getTimezone());
        $HeiseiStart     = new DateTime('1989-01-08 00:00:00', $this->getTimezone());
        $HeiseiNextStart = new DateTime('2019-05-01 00:00:00', $this->getTimezone());

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
        if ($HeiseiStart <= $this && $HeiseiNextStart > $this) {
            // 平成
            return self::ERA_HEISEI;
        }

        // 平成の次
        return self::ERA_HEISEI_NEXT;
    }

    /**
     * 日本語フォーマットされた干支を返す
     *
     * @return      string
     */
    protected function viewOrientalZodiac(): string
    {
        $key = $this->getOrientalZodiac();

        return $this->JapaneseDate->viewOrientalZodiac($key);
    }

    /**
     * 干支キーを返す
     *
     * @return int
     */
    protected function getOrientalZodiac(): int
    {
        $res = ($this->year + 9) % 12;

        return $res;
    }

    /**
     * 日本語フォーマットされた六曜名を返す
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function viewSixWeekday(): string
    {
        $key = $this->getSixWeekday();

        return $this->JapaneseDate->viewSixWeekday($key);
    }

    /**
     * 六曜を数値化して返します
     *
     * @return      int
     * @throws \ErrorException
     */
    protected function getSixWeekday(): int
    {
        $lunar_calendar = $this->getLunarCalendar();

        return ($lunar_calendar->month + $lunar_calendar->day) % 6;
    }

    /**
     * 日本語フォーマットされた曜日名を返す
     *
     * @return      string
     */
    protected function viewWeekday(): string
    {
        $key = $this->dayOfWeek;

        return $this->JapaneseDate->viewWeekday($key);
    }

    /**
     * 日本語フォーマットされた日本月名を返す
     *
     * @return string
     */
    protected function viewMonth(): string
    {
        $key = $this->month;

        return $this->JapaneseDate->viewMonth($key);
    }

    /**
     * 日本語フォーマットされた休日名を返す
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function viewHoliday(): string
    {
        $key = $this->getHoliday();

        return $this->JapaneseDate->viewHoliday($key);
    }

    /**
     * 祝日キーを返す
     *
     * @return      int
     * @throws \ErrorException
     */
    protected function getHoliday(): int
    {
        $holiday_list = $this->JapaneseDate->getHolidayList($this);

        return isset($holiday_list[$this->day]) ? $holiday_list[$this->day] : self::NO_HOLIDAY;
    }

    /**
     * 旧暦(月)
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function viewLunarMonth(): string
    {
        $key = $this->getLunarMonth();

        return $this->JapaneseDate->viewMonth($key);
    }

    /**
     * 旧暦（月）
     *
     * @return      string
     * @throws \ErrorException
     * @throws \ErrorException
     */
    protected function getLunarMonth(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->month;
    }

    /**
     * 旧暦（年）
     *
     * @return      string
     * @throws \ErrorException
     * @throws \ErrorException
     */
    protected function getLunarYear(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->year;
    }

    /**
     * 旧暦（日）
     *
     * @return      string
     * @throws \ErrorException
     * @throws \ErrorException
     */
    protected function getLunarDay(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->day;
    }

    /**
     * 閏月かどうか
     *
     * @return      bool
     * @throws \ErrorException
     * @throws \ErrorException
     */
    protected function isLeapMonth(): bool
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->is_leap_month;
    }

    /**
     * 和暦を返す
     *
     * @param null|int $era_key 元号キー
     * @return int
     */
    protected function getEraYear($era_key = null): int
    {
        $era_calc = [self::ERA_MEIJI       => 1868,
                     self::ERA_TAISHO      => 1912,
                     self::ERA_SHOWA       => 1926,
                     self::ERA_HEISEI      => 1989,
                     self::ERA_HEISEI_NEXT => 2019,
        ];

        $era_key = $era_key ?? $this->getEraName();

        return $this->year - $era_calc[$era_key] + 1;
    }
}
