<?php

/**
 * OneTimeCashTrait.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Components;

use Closure;

/**
 * Class OneTimeCacheTrait
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
trait OneTimeCacheTrait
{
    /**
     * @var array
     */
    protected array $one_time_cache = [];

    /**
     * @param string $key
     * @param \Closure $closure
     * @return mixed
     */
    protected function oneTimeCache(string $key, Closure $closure): mixed
    {
        if (array_key_exists($key, $this->one_time_cache)) {
            return $this->one_time_cache[$key];
        }

        return $this->one_time_cache[$key] = $closure();
    }
}
