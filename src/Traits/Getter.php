<?php
/**
 * Getter.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Traits;

/**
 * Trait Getter
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @mixin \JapaneseDate\DateTime
 */
trait Getter
{
    /**
     * サポートされるカレンダーに変換する
     *
     * サポートされる $calendar の値は、 CAL_GREGORIAN、 CAL_JULIAN、 CAL_JEWISH および CAL_FRENCH です。
     *
     * @access      public
     * @param int $calendar サポートされるカレンダー
     * @return      array カレンダーの情報を含む配列を返します。この配列には、 年、月、日、週、曜日名、月名、"月/日/年" 形式の文字列 などが含まれます。
     */
    public function getCalendar($calendar = CAL_GREGORIAN): array
    {
        return cal_from_jd(unixtojd($this->timestamp), $calendar);
    }

    /**
     * MagicMethod:__get()
     *
     * @link https://carbon.nesbot.com/docs/#api-getters
     * @param string $name
     * @return \DateTimeZone|int|string
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @noinspection PhpMissingParamTypeInspection
     */
    public function __get($name)
    {
        switch ($name) {
            case 'solar_term_text':
            case 'solarTermText':
                return $this->getSolarTerm();
            case 'solar_term':
            case 'solarTerm':
                return $this->getSolarTermKey();
            case 'is_solar_term':
            case 'isSolarTerm':
                return $this->isSolarTerm();
            case 'era_name_text':
            case 'eraNameText':
                return $this->viewEraName();
            case 'era_name':
            case 'eraName':
                return $this->getEraName();
            case 'era_year':
            case 'eraYear':
                return $this->getEraYear();
            case 'oriental_zodiac_text':
            case 'orientalZodiacText':
                return $this->viewOrientalZodiac();
            case 'oriental_zodiac':
            case 'orientalZodiac':
                return $this->getOrientalZodiac();
            case 'six_weekday_text':
            case 'sixWeekdayText':
                return $this->viewSixWeekday();
            case 'six_weekday':
            case 'sixWeekday':
                return $this->getSixWeekday();
            case 'weekday_text':
            case 'weekdayText':
                return $this->viewWeekday();
            case 'month_text':
            case 'monthText':
                return $this->viewMonth();
            case 'holiday_text':
            case 'holidayText':
                return $this->viewHoliday();
            case 'holiday':
                return $this->getHoliday();
            case 'is_holiday':
            case 'isHoliday':
                return $this->getHoliday() !== self::NO_HOLIDAY;
            case 'lunar_month_text':
            case 'lunarMonthText':
                return $this->viewLunarMonth();
            case 'lunar_month':
            case 'lunarMonth':
                return $this->getLunarMonth();
            case 'lunar_year':
            case 'lunarYear':
                return $this->getLunarYear();
            case 'lunar_day':
            case 'lunarDay':
                return $this->getLunarDay();
            case 'is_leap_month':
            case 'isLeapMonth':
                return $this->isLeapMonth();

        }

        /** @noinspection PhpUndefinedMethodInspection */
        /** @noinspection PhpUndefinedClassInspection */
        return parent::__get($name);
    }
}
