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
use Exception;
use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Exceptions\NativeDateTimeException;
use JapaneseDate\Traits\DateTimeImport;

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
 * @property bool $is_holiday
 * @property string $lunar_month_text
 * @property int $lunar_month
 * @property int $lunar_year
 * @property int $lunar_day
 * @property bool $is_leap_month
 * @property  int|bool $solarTerm
 * @property  string $solarTermText
 * @property bool $isSolarTerm
 * @property string $eraNameText
 * @property int $eraName
 * @property int $eraYear
 * @property string $orientalZodiacText
 * @property int $orientalZodiac
 * @property string $sixWeekdayText
 * @property int $sixWeekday
 * @property int $weekdayText
 * @property string $monthText
 * @property string $holidayText
 * @property bool $isHoliday
 * @property string $lunarMonthText
 * @property int $lunarMonth
 * @property int $lunarYear
 * @property int $lunarYay
 * @property bool $isLeapMonth
 */
class DateTime extends Carbon
{
    use DateTimeImport;

    /**
     * 祝日定数:非祝日
     *
     * @var int
     */
    public const NO_HOLIDAY = 0;
    /**
     * 祝日定数:元旦
     *
     * @var int
     */
    public const NEW_YEAR_S_DAY = 1;
    /**
     * 祝日定数:成人の日
     *
     * @var int
     */
    public const COMING_OF_AGE_DAY = 2;
    /**
     * 祝日定数:建国記念の日
     *
     * @var int
     */
    public const NATIONAL_FOUNDATION_DAY = 3;
    /**
     * 祝日定数:昭和天皇の大喪の礼
     *
     * @var int
     */
    public const THE_SHOWA_EMPEROR_DIED = 4;
    /**
     * 祝日定数:春分の日
     *
     * @var int
     */
    public const VERNAL_EQUINOX_DAY = 5;
    /**
     * 祝日定数:昭和の日
     *
     * @var int
     */
    public const DAY_OF_SHOWA = 6;
    /**
     * 祝日定数:みどりの日
     *
     * @var int
     */
    public const GREENERY_DAY = 7;
    /**
     * 祝日定数:天皇誕生日
     *
     * @var int
     */
    public const THE_EMPEROR_S_BIRTHDAY = 8;
    /**
     * 祝日定数:皇太子明仁親王の結婚の儀
     *
     * @var int
     */
    public const CROWN_PRINCE_HIROHITO_WEDDING = 9;
    /**
     * 祝日定数:憲法記念日
     *
     * @var int
     */
    public const CONSTITUTION_DAY = 10;
    /**
     * 祝日定数:国民の休日
     *
     * @var int
     */
    public const NATIONAL_HOLIDAY = 11;
    /**
     * 祝日定数:こどもの日
     *
     * @var int
     */
    public const CHILDREN_S_DAY = 12;
    /**
     * 祝日定数:振替休日
     *
     * @var int
     */
    public const COMPENSATING_HOLIDAY = 13;
    /**
     * 祝日定数:皇太子徳仁親王の結婚の儀
     *
     * @var int
     */
    public const CROWN_PRINCE_NARUHITO_WEDDING = 14;
    /**
     * 祝日定数:海の日
     *
     * @var int
     */
    public const MARINE_DAY = 15;
    /**
     * 祝日定数:秋分の日
     *
     * @var int
     */
    public const AUTUMNAL_EQUINOX_DAY = 16;
    /**
     * 祝日定数:敬老の日
     *
     * @var int
     */
    public const RESPECT_FOR_SENIOR_CITIZENS_DAY = 17;

    /**
     * 祝日定数:体育の日
     *
     * @var int
     */
    public const LEGACY_SPORTS_DAY = 18;

    /**
     * 祝日定数:文化の日
     *
     * @var int
     */
    public const CULTURE_DAY = 19;

    /**
     * 祝日定数:勤労感謝の日
     *
     * @var int
     */
    public const LABOR_THANKSGIVING_DAY = 20;

    /**
     * 祝日定数:即位礼正殿の儀
     *
     * @var int
     */
    public const REGNAL_DAY = 21;

    /**
     * 祝日定数:山の日
     *
     * @var int
     */
    public const MOUNTAIN_DAY = 22;

    /**
     * 天皇の即位の日
     *
     * @var int
     */
    public const EMPERORS_THRONE_DAY = 23;

    /**
     * スポーツの日
     *
     * @var int
     */
    public const SPORTS_DAY = 24;

    /**
     * 祝日法制定年
     *
     * @var int
     */
    public const HOLIDAY_START_YEAR = 1948;

    /**
     * 二回目の東京オリンピックの年
     *
     * 特別祝日
     *
     * @var int
     */
    public const SECOND_TIME_TOKYO_OLYMPIC_YEAR = 2020;

    /**
     * 特定月定数 春分の日
     *
     * @var int
     */
    public const VERNAL_EQUINOX_DAY_MONTH = 3;

    /**
     * 特定月定数 秋分の日
     *
     * @var int
     */
    public const AUTUMNAL_EQUINOX_DAY_MONTH = 9;

    /**
     * 曜日定数(日)
     *
     * @var int
     */
    public const SUNDAY = 0;

    /**
     * 曜日定数(月)
     *
     * @var int
     */
    public const MONDAY = 1;

    /**
     * 曜日定数(火)
     *
     * @var int
     */
    public const TUESDAY = 2;

    /**
     * 曜日定数(水)
     *
     * @var int
     */
    public const WEDNESDAY = 3;

    /**
     * 曜日定数(木)
     *
     * @var int
     */
    public const THURSDAY = 4;

    /**
     * 曜日定数(金)
     *
     * @var int
     */
    public const FRIDAY = 5;

    /**
     * 曜日定数(土)
     *
     * @var int
     */
    public const SATURDAY = 6;

    /**
     * 元号 (明治)
     *
     * @var int
     */
    public const ERA_MEIJI = 1000;

    /**
     * 元号 (対象)
     *
     * @var int
     */
    public const ERA_TAISHO = 1001;

    /**
     * 元号 (昭和)
     *
     * @var int
     */
    public const ERA_SHOWA = 1002;

    /**
     * 元号 (平成)
     *
     * @var int
     */
    public const ERA_HEISEI = 1003;

    /**
     * 元号 (平成の次)
     *
     * @var int
     * @deprecated
     */
    public const ERA_HEISEI_NEXT = 1004;

    /**
     * 元号 (平成の次)
     *
     * @var int
     */
    public const ERA_REIWA = 1004;

    /**
     * DateTime constructor.
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @param string|DateTimeInterface|null $time     日付/時刻 文字列。DateTimeオブジェクト
     * @param DateTimeZone|string|null|int $time_zone DateTimeZone オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定)
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function __construct($time = null, $time_zone = null)
    {
        try {
            parent::__construct($time, $time_zone);
        } catch (Exception $exception) {
            throw new NativeDateTimeException('Throwing native DateTime class construct exception.', $exception->getCode(), $exception);
        }

        $this->JapaneseDate = JapaneseDate::factory();
        $this->LunarCalendar = LunarCalendar::factory();
    }
}
