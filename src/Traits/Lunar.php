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
 * @since        2020-03-11
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
 * @since        2020-03-11
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Lunar
{
    /**
     * 月齢を求める
     *
     * @return float
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getMoonAge(): float
    {
        return $this->LunarCalendar->moonAge(
            $this->year,
            $this->month,
            $this->day,
            (float) $this->hour,
            (float) $this->minute,
            (float) $this->second
        );
    }

    /**
     * 月の位相角を求める（0°=新月、90°=上弦、180°=満月、270°=下弦）
     *
     * @return float
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getMoonPhaseAngle(): float
    {
        return $this->LunarCalendar->moonPhaseAngle(
            $this->year,
            $this->month,
            $this->day,
            (float) $this->hour,
            (float) $this->minute,
            (float) $this->second
        );
    }

    /**
     * 月相を求める（0=新月〜7=有明）
     *
     * @return int
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getMoonPhase(): int
    {
        return $this->LunarCalendar->moonPhase(
            $this->year,
            $this->month,
            $this->day,
            (float) $this->hour,
            (float) $this->minute,
            (float) $this->second
        );
    }

    /**
     * 月相の日本語名を返す
     *
     * @return string
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function viewMoonPhase(): string
    {
        return $this->JapaneseDate->viewMoonPhase($this->getMoonPhase());
    }

    /**
     * 旧暦データ取得
     *
     * @return \JapaneseDate\Elements\LunarDate
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getLunarCalendar(): LunarDate
    {
        $mdy = $this->month . '-' . $this->day . '-' . $this->year;

        return $this->lunar_calendar[$mdy] ?? $this->lunar_calendar[$mdy] = $this->LunarCalendar->getLunarDate($this);
    }

    /**
     * 日本語フォーマットされた六曜名を返す
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getSixWeekday(): int
    {
        $lunar_calendar = $this->getLunarCalendar();

        return ($lunar_calendar->month + $lunar_calendar->day) % 6;
    }

    /**
     * 旧暦（日）
     *
     * @return      int
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getLunarDay(): int
    {
        return (int) $this->getLunarCalendar()->day;
    }

    /**
     * 旧暦（月）
     *
     * @return      int
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getLunarMonth(): int
    {
        return (int) $this->getLunarCalendar()->month;
    }

    /**
     * 旧暦(月)
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getSolarTermKey(): bool|int
    {
        return $this->getLunarCalendar()->solar_term;
    }

    /**
     * ２４節気かどうか
     *
     * @return      boolean
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function isSolarTerm(): bool
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->solar_term !== false;
    }

    /**
     * 旧暦（年）
     *
     * @return      int
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    protected function getLunarYear(): int
    {
        return (int) $this->getLunarCalendar()->year;
    }
}
