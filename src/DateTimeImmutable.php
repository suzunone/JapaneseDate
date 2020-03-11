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
use Carbon\CarbonImmutable;
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
class DateTimeImmutable extends CarbonImmutable
{
    use DateTimeImport;

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
