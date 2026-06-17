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
use JapaneseDate\Components\JisEra;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\Components\SeasonalFestival;
use JapaneseDate\Components\SeventyTwoKouCalculator;
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
     * @var JisEra
     */
    protected $JisEra;

    /**
     * @var JapaneseDate
     */
    protected $JapaneseDate;

    /**
     * @var LunarCalendar
     */
    protected $LunarCalendar;

    /**
     * @var SexagenaryCycle
     */
    protected $SexagenaryCycle;

    /**
     * @var MiscSeasonalNode
     */
    protected $MiscSeasonalNode;

    /**
     * @var SeasonalFestival
     */
    protected $SeasonalFestival;

    /**
     * @var SeventyTwoKouCalculator
     */
    protected $SeventyTwoKouCalculator;

    /**
     * @var array
     */
    protected $lunar_calendar = [];
}
