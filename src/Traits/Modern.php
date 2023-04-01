<?php
/**
 * Modern.php
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
 * Trait Modern
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
trait Modern
{
    /**
     * 干支キーを返す
     *
     * @return int
     */
    protected function getOrientalZodiac(): int
    {
        return ($this->year + 9) % 12;
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
     * 祝日キーを返す
     *
     * @return      int
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getHoliday(): int
    {
        $holiday_list = $this->JapaneseDate->getHolidayList($this);

        return $holiday_list[$this->day] ?? self::NO_HOLIDAY;
    }

    /**
     * 日本語フォーマットされた休日名を返す
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function viewHoliday(): string
    {
        $key = $this->getHoliday();

        return $this->JapaneseDate->viewHoliday($key);
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
     * 日本語フォーマットされた年号を返す
     *
     * @return      string
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function viewEraName(): string
    {
        $key = $this->getEraName();

        return $this->JapaneseDate->viewEraName($key);
    }

    /**
     * 年号キーを返す
     *
     * @return int
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getEraName(): int
    {
        $TaishoStart = $this->innerDateTime('1912-07-30 00:00:00');
        $ShowaStart = $this->innerDateTime('1926-12-25 00:00:00');
        $HeiseiStart = $this->innerDateTime('1989-01-08 00:00:00');
        $ReiwaStart = $this->innerDateTime('2019-05-01 00:00:00');

        if ($TaishoStart > $this) {
            // 明治
            return self::ERA_MEIJI;
        }

        if ($ShowaStart > $this) {
            // 大正
            return self::ERA_TAISHO;
        }

        if ($HeiseiStart > $this) {
            // 昭和
            return self::ERA_SHOWA;
        }
        if ($ReiwaStart > $this) {
            // 平成
            return self::ERA_HEISEI;
        }

        // 令和
        return self::ERA_REIWA;
    }

    /**
     * 和暦を返す
     *
     * @param null $era_key 元号キー
     * @return int
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getEraYear($era_key = null): int
    {
        $era_calc = [self::ERA_MEIJI => 1868,
            self::ERA_TAISHO         => 1912,
            self::ERA_SHOWA          => 1926,
            self::ERA_HEISEI         => 1989,
            self::ERA_REIWA          => 2019,
        ];

        $era_key = $era_key ?? $this->getEraName();

        return $this->year - $era_calc[$era_key] + 1;
    }
}
