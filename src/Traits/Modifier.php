<?php

/**
 * Modifier.php
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

/**
 * Trait Modifier
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
trait Modifier
{
    /**
     * 次の祝日にする
     *
     * @return static
     */
    public function nextHoliday(): static
    {
        /**
         * @var  \JapaneseDate\DateTime|static|Modifier|\Carbon\Carbon $Date
         */
        $Date = $this;
        do {
            $Date = $Date->addDay();
        } while (!$Date->is_holiday);

        return $Date;
    }

    /**
     * 指定された次の六曜にする
     *
     * @param int $week_day
     * @return static
     */
    public function nextSixWeek(int $week_day): static
    {
        if ($this->six_weekday === $week_day) {
            return $this;
        }

        if ($this->six_weekday < $week_day) {
            return $this->addDays($week_day - $this->six_weekday);
        }

        return $this->addDays(6 + $week_day - $this->six_weekday);
    }
}
