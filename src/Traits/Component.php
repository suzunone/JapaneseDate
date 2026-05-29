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
 * @since        2020-03-11
 */

namespace JapaneseDate\Traits;

use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\Components\SeasonalFestival;
use JapaneseDate\Components\SexagenaryCycle;

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
 * @since        2020-03-11
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Component
{
    /**
     * @var \JapaneseDate\Components\JapaneseDate
     */
    protected JapaneseDate $JapaneseDate;

    /**
     * @var \JapaneseDate\Components\LunarCalendar
     */
    protected LunarCalendar $LunarCalendar;

    /**
     * @var \JapaneseDate\Components\SexagenaryCycle
     */
    protected SexagenaryCycle $SexagenaryCycle;

    /**
     * @var \JapaneseDate\Components\MiscSeasonalNode
     */
    protected MiscSeasonalNode $MiscSeasonalNode;

    /**
     * @var \JapaneseDate\Components\SeasonalFestival
     */
    protected SeasonalFestival $SeasonalFestival;

    /**
     * @var array
     */
    protected array $lunar_calendar = [];
}
