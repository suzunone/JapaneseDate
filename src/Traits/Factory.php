<?php
/**
 * Factory.php
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

use DateTimeInterface;
use DateTimeZone;

/**
 * Trait Factory
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
trait Factory
{
    /**
     * DateTimeオブジェクトの生成
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @param string|int|DateTimeInterface|null $date_time 日付オブジェクト OR Unix Time Stamp OR 日付/時刻 文字列
     * @param DateTimeZone|null|string $time_zone          オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定)
     * @return static|DateTimeInterface
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public static function factory($date_time = null, $time_zone = null): DateTimeInterface
    {
        if (is_int($date_time)) {
            return new static(date('Y-m-d H:i:s', $date_time), $time_zone);
        }
        if (ctype_digit($date_time)) {
            $check_time = strtotime($date_time);
            if (is_int($check_time)) {
                $date_time = $check_time;
            }

            return new static(date('Y-m-d H:i:s', $date_time), $time_zone);
        }

        if ($date_time instanceof DateTimeInterface) {
            return new static($date_time->format('Y-m-d H:i:s'), $time_zone ?? $date_time->getTimezone());
        }

        return new static($date_time, $time_zone);
    }
}
