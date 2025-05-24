<?php

/**
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Elements
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/04/28 2:55
 */

namespace JapaneseDate\Elements;

use JapaneseDate\Exceptions\ErrorException;

/**
 * Class LunarDate
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Elements
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @property-read int year
 * @property-read int month
 * @property-read int day
 * @property-read bool $is_leap_month
 * @property-read int|bool solar_term
 */
class LunarDate
{
    public const YEAR_KEY = 0;

    public const IS_LEAP_MONTH_FLAG_KEY = 1;

    public const MONTH_KEY = 2;

    public const DAY_KEY = 3;

    public const SOLAR_TERM_KEY = 4;

    /**
     * @var array
     */
    protected array $lunar;

    /**
     * LunarDate constructor.
     *
     * @param array $lunar
     * @param int|bool $solar_term
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JsonException
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    public function __construct(array $lunar, int|bool $solar_term)
    {
        if (!isset($lunar[self::DAY_KEY])) {
            throw new ErrorException('undefined day key' . json_encode($lunar, JSON_THROW_ON_ERROR) . json_encode($solar_term, JSON_THROW_ON_ERROR));
        }

        $lunar[self::SOLAR_TERM_KEY] = $solar_term;
        $this->lunar = $lunar;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return match ($name) {
            'year', 'month', 'day', 'is_leap_month', 'solar_term' => true,
            default => false,
        };
    }

    /**
     * @param string $name
     * @return bool|string|int
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @noinspection PhpMissingParamTypeInspection
     */
    public function __get($name): bool|string|int
    {
        return match ($name) {
            'year'          => (int) $this->lunar[self::YEAR_KEY],
            'month'         => (int) $this->lunar[self::MONTH_KEY],
            'day'           => (int) $this->lunar[self::DAY_KEY],
            'is_leap_month' => (bool) $this->lunar[self::IS_LEAP_MONTH_FLAG_KEY],
            'solar_term'    => $this->lunar[self::SOLAR_TERM_KEY],
            default         => throw new ErrorException('undefined property:' . $name),
        };
    }

    /**
     * @param $name
     * @param $value
     * @throws \JapaneseDate\Exceptions\ErrorException
     */
    public function __set($name, $value)
    {
        throw new ErrorException('cannot set property:' . $name);
    }
}
