<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/04/28 11:45
 */

namespace Test\JapaneseDate;

use Carbon\Carbon;
use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Covers;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class ModernTest
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
#[CoversClass(\JapaneseDate\Traits\Modern::class)]
class ModernTest extends TestCase
{
    use InvokeTrait;

    #[Covers('viewWeekday')] #[Covers('__get')]
    public function test_viewWeekday()
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('月', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-02');
        $this->assertEquals('火', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-03');
        $this->assertEquals('水', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-04');
        $this->assertEquals('木', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-05');
        $this->assertEquals('金', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-06');
        $this->assertEquals('土', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-07');
        $this->assertEquals('日', $DateTime->weekday_text);
    }

    #[Covers('viewMonth')] #[Covers('__get')]
    public function test_viewMonth()
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('睦月', $DateTime->month_text);
    }

    #[Covers('viewHoliday')] #[Covers('getHoliday')] #[Covers('__get')]
    public function test_getHoliday()
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('元旦', $DateTime->holiday_text);
        $this->assertEquals(DateTime::NEW_YEAR_S_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-01-08');
        $this->assertEquals('成人の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMING_OF_AGE_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-02-11');
        $this->assertEquals('建国記念の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::NATIONAL_FOUNDATION_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-02-12');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-03-20');
        $this->assertEquals('', $DateTime->holiday_text);

        $DateTime = new DateTime('2018-03-21');
        $this->assertEquals('春分の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::VERNAL_EQUINOX_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-03-22');
        $this->assertEquals('', $DateTime->holiday_text);

        $DateTime = new DateTime('2018-04-29');
        $this->assertEquals('昭和の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::DAY_OF_SHOWA, $DateTime->holiday);

        $DateTime = new DateTime('2018-04-30');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-05-03');
        $this->assertEquals('憲法記念日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CONSTITUTION_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-05-04');
        $this->assertEquals('みどりの日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::GREENERY_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-05-05');
        $this->assertEquals('こどもの日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CHILDREN_S_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-07-16');
        $this->assertEquals('海の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::MARINE_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-08-11');
        $this->assertEquals('山の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::MOUNTAIN_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-09-17');
        $this->assertEquals('敬老の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-09-23');
        $this->assertEquals('秋分の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::AUTUMNAL_EQUINOX_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-09-24');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-10-08');
        $this->assertEquals('体育の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::LEGACY_SPORTS_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-11-03');
        $this->assertEquals('文化の日', $DateTime->holiday_text);

        $DateTime = new DateTime('2018-11-23');
        $this->assertEquals('勤労感謝の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::LABOR_THANKSGIVING_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-12-23');
        $this->assertEquals('天皇誕生日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::THE_EMPEROR_S_BIRTHDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-12-24');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);
    }

    #[Covers(\JapaneseDate\DateTime::class)] #[Covers(\JapaneseDate\Traits\Modern::class)] #[Covers('__get')]
    public function test_isHoliday()
    {
        $DateTime = new DateTime('2018-12-23');
        $this->assertTrue($DateTime->is_holiday);
        $this->assertTrue($DateTime->isHoliday);

        $DateTime = new DateTime('2019-12-23');
        $this->assertFalse($DateTime->is_holiday);
        $this->assertFalse($DateTime->isHoliday);
    }

    #[Covers(\JapaneseDate\DateTime::class)]
    #[Covers(\JapaneseDate\Traits\Lunar::class)]
    #[Covers(\JapaneseDate\Traits\Modern::class)]
    #[Covers('__get')]
    #[Covers(\JapaneseDate\Components\LunarCalendar::class)]
    public function test_getSolarTerm()
    {
        $DateTime = new DateTime('2018-04-05');


        $this->assertSame(4, $DateTime->month);
        $this->assertSame(5, $DateTime->day);
        $this->assertSame(1, $DateTime->solar_term);
        $this->assertSame('清明', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);

        $DateTime = new DateTime('2018-03-20');
        $this->assertFalse($DateTime->solar_term);
        $this->assertSame('', $DateTime->solar_term_text);
        $this->assertFalse($DateTime->is_solar_term);

        $DateTime = new DateTime('2018-03-21');
        $this->assertSame(0, $DateTime->solar_term);
        $this->assertSame('春分', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);
    }

    #[Covers(\JapaneseDate\DateTime::class)] #[Covers(\JapaneseDate\Traits\Modern::class)] #[Covers('__get')]
    public function test_eraName()
    {
        $DateTime = new DateTime('1868-01-25');
        $this->assertEquals('明治', $DateTime->era_name_text);
        $this->assertEquals('1000', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('1912-07-29');
        $this->assertEquals('明治', $DateTime->era_name_text);
        $this->assertEquals('1000', $DateTime->era_name);
        $this->assertEquals(45, $DateTime->era_year);

        $DateTime = new DateTime('1912-07-30');
        $this->assertEquals('大正', $DateTime->era_name_text);
        $this->assertEquals('1001', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('1926-12-24');
        $this->assertEquals('大正', $DateTime->era_name_text);
        $this->assertEquals('1001', $DateTime->era_name);
        $this->assertEquals(15, $DateTime->era_year);

        $DateTime = new DateTime('1926-12-25');
        $this->assertEquals('昭和', $DateTime->era_name_text);
        $this->assertEquals('1002', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('1989-01-07');
        $this->assertEquals('昭和', $DateTime->era_name_text);
        $this->assertEquals('1002', $DateTime->era_name);
        $this->assertEquals(64, $DateTime->era_year);

        $DateTime = new DateTime('1989-01-08');
        $this->assertEquals('平成', $DateTime->era_name_text);
        $this->assertEquals('1003', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('2019-04-30');
        $this->assertEquals('平成', $DateTime->era_name_text);
        $this->assertEquals('1003', $DateTime->era_name);
        $this->assertEquals(31, $DateTime->era_year);

        $DateTime = new DateTime('2019-05-01');
        $this->assertEquals('令和', $DateTime->era_name_text);
        $this->assertEquals('1004', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);
    }

    #[Covers(\JapaneseDate\DateTime::class)] #[Covers(\JapaneseDate\Traits\Modern::class)] #[Covers('__get')]
    public function test_getOrientalZodiac()
    {
        $DateTime = DateTime::factory('2016-05-21');
        $this->assertEquals('申', $DateTime->oriental_zodiac_text);

        $DateTime = DateTime::factory('2019-05-21');
        $this->assertEquals(0, $DateTime->oriental_zodiac);
    }
}
