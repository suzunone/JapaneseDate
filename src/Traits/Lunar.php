<?php
/**
 * Lunar.php
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

use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Elements\LunarDate;

/**
 * Trait Lunar
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
trait Lunar
{
    /**
     * 月齢を求める
     *
     * @return float
     */
    public function getMoonAge()
    {
        return $this->getLunarCalendar()->day;
    }

    /**
     * 旧暦データ取得
     *
     * @return      \JapaneseDate\Elements\LunarDate
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getLunarCalendar(): LunarDate
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
     * 日本語フォーマットされた六曜名を返す
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
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
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getSixWeekday(): int
    {
        $lunar_calendar = $this->getLunarCalendar();

        return ($lunar_calendar->month + $lunar_calendar->day) % 6;
    }

    /**
     * 旧暦（日）
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getLunarDay(): string
    {
        return $this->getLunarCalendar()->day;
    }

    /**
     * 旧暦（月）
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getLunarMonth(): string
    {
        return $this->getLunarCalendar()->month;
    }

    /**
     * 旧暦(月)
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function viewLunarMonth(): string
    {
        $key = $this->getLunarMonth();

        return $this->JapaneseDate->viewMonth($key);
    }

    /**
     * 閏月かどうか
     *
     * @return      bool
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function isLeapMonth(): bool
    {
        return $this->getLunarCalendar()->is_leap_month;
    }

    /**
     * 24節気を取得する
     *
     * @return string
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getSolarTerm(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        if ($lunar_calendar->solar_term === false) {
            return '';
        }

        return JapaneseDate::SOLAR_TERM[$lunar_calendar->solar_term];
    }

    /**
     * 24節気を取得する
     *
     * @return bool|int
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getSolarTermKey()
    {
        return $this->getLunarCalendar()->solar_term;
    }

    /**
     * ２４節気かどうか
     *
     * @return      boolean
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function isSolarTerm(): bool
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->solar_term !== false;
    }

    /**
     * 旧暦（年）
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    protected function getLunarYear(): string
    {
        return $this->getLunarCalendar()->year;
    }
}
