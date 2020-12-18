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
 * @since       Class available since Release 1.0.0
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
 * @since       Class available since Release 1.0.0
 * @mixin \JapaneseDate\DateTime
 */
trait Modifier
{
    /**
     * 次の祝日にする
     *
     * @return \JapaneseDate\DateTime|static|\JapaneseDate\Traits\Modifier|\Carbon\Carbon
     */
    public function nextHoliday()
    {
        /**
         * @var  \JapaneseDate\DateTime|static|\JapaneseDate\Traits\Modifier|\Carbon\Carbon $date
         */
        $date = $this;
        do {
            $date = $date->addDay();
        } while (!$date->is_holiday);

        return $date;
    }

    /**
     * 指定された次の六曜にする
     *
     * @param int $week_day
     * @return \JapaneseDate\DateTime|static|\JapaneseDate\Traits\Modifier|\Carbon\Carbon
     */
    public function nextSixWeek(int $week_day)
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
