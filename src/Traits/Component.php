<?php

/**
 * Component.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */

namespace JapaneseDate\Traits;

use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;

/**
 * Trait Component
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Component
{
    /**
     * @var \JapaneseDate\Components\JapaneseDate
     */
    protected $JapaneseDate;

    /**
     * @var \JapaneseDate\Components\LunarCalendar
     */
    protected $LunarCalendar;

    /**
     * @var array
     */
    protected $lunar_calendar = [];
}
