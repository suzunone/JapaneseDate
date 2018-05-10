<?php
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

use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\DateTime;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;


/**
 * Class DateTimeTest
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
class DateTimeTest extends TestCase
{
    use InvokeTrait;

    /**
     *
     * @test
     * @covers \JapaneseDate\DateTime::__construct()
     */
    public function test_construct()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime       = new DateTime($test_date_time);
        $this->assertEquals($test_date_time->format('Y-m-d H:i:s'), $DateTime->format('Y-m-d H:i:s'));

        // タイムスタンプ
        $test_unix_time = $FakerGenerator->unixTime('+3 year');
        $DateTime       = new DateTime($test_unix_time);
        $this->assertEquals($test_unix_time, $DateTime->timestamp);

        // 日付文字列
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('Y-m-d H:i:s');
        $DateTime       = new DateTime($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('Y-m-d H:i:s'));
    }


    /**
     *
     * @test
     * @covers \JapaneseDate\DateTime::factory()
     */
    public function test_factory()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime       = DateTime::factory($test_date_time);
        $this->assertEquals($test_date_time->format('Y-m-d H:i:s'), $DateTime->format('Y-m-d H:i:s'));
        $this->assertEquals($test_date_time->getTimestamp(), $DateTime->getTimestamp());

        // タイムスタンプ
        $test_unix_time = $FakerGenerator->unixTime('+3 year');
        $DateTime       = DateTime::factory($test_unix_time);
        $this->assertEquals($test_unix_time, $DateTime->timestamp);

        // 日付文字列
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('Y-m-d H:i:s');
        $DateTime       = DateTime::factory($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('Y-m-d H:i:s'));
    }

    /**
     *
     * @test
     * @covers \JapaneseDate\DateTime::getCalendar()
     */
    public function test_getCalendar()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime       = DateTime::factory($test_date_time);
        $this->assertSame(
            cal_from_jd(unixtojd(
                            $test_date_time->getTimestamp()), CAL_GREGORIAN
            ),
            $DateTime->getCalendar()
        );
    }


    /**
     * @test
     * @covers \JapaneseDate\DateTime::viewWeekday()
     * @covers \JapaneseDate\DateTime::__get()
     */
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

    /**
     *
     * @test
     * @covers \JapaneseDate\DateTime::isLeapMonth()
     * @covers \JapaneseDate\DateTime::__get()
     */
    public function test_isLeapMonth()
    {
        $DateTime = new DateTime('2017-06-24');
        $this->assertTrue($DateTime->is_leap_month);

        $DateTime = new DateTime('2018-01-01');
        $this->assertFalse($DateTime->is_leap_month);

        $DateTime = new DateTime('2017-06-23');
        $this->assertFalse($DateTime->is_leap_month);

    }


    /**
     * @test
     * @covers \JapaneseDate\DateTime::viewMonth()
     * @covers \JapaneseDate\DateTime::__get()
     */
    public function test_viewMonth()
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('睦月', $DateTime->month_text);
    }

    /**
     * @test
     * @covers \JapaneseDate\DateTime::viewHoliday()
     * @covers \JapaneseDate\DateTime::getHoliday()
     * @covers \JapaneseDate\DateTime::__get()
     */
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
        $this->assertEquals(DateTime::SPORTS_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-11-03');
        $this->assertEquals('文化の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CULTURE_DAY, $DateTime->holiday);

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

    /**
     * @covers \JapaneseDate\DateTime
     * @covers \JapaneseDate\Components\LunarCalendar
     * @test
     */
    public function test_getSolarTerm()
    {
        $DateTime = new DateTime('2018-04-05');
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


    /**
     * @covers \JapaneseDate\DateTime
     * @test
     */
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
        $this->assertEquals('平成の次', $DateTime->era_name_text);
        $this->assertEquals('1004', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);
    }

    /**
     * @covers \JapaneseDate\DateTime
     * @test
     */
    public function test_getOrientalZodiac()
    {
        $DateTime = DateTime::factory('2016-05-21');
        $this->assertEquals('申', $DateTime->oriental_zodiac_text);

        $DateTime = DateTime::factory('2019-05-21');
        $this->assertEquals(0, $DateTime->oriental_zodiac);
    }

    /**
     * @covers \JapaneseDate\DateTime
     * @test
     */
    public function test_getSixWeekday()
    {
        $DateTime = DateTime::factory('2018-03-01');

        $this->assertEquals('友引', $DateTime->six_weekday_text);
        $this->assertEquals(3, $DateTime->six_weekday);

    }

    /**
     * @covers \JapaneseDate\DateTime
     * @test
     */
    public function test_getLunarYMD()
    {
        $DateTime = DateTime::factory('2018-02-01');

        $this->assertEquals('2017', $DateTime->lunar_year);
        $this->assertEquals('12', $DateTime->lunar_month);
        $this->assertEquals('師走', $DateTime->lunar_month_text);
        $this->assertEquals('16', $DateTime->lunar_day);


        $DateTime = DateTime::factory('2018-03-17');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('2', $DateTime->lunar_month);
        $this->assertEquals('如月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);


        $DateTime = DateTime::factory('2018-03-01');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('1', $DateTime->lunar_month);
        $this->assertEquals('睦月', $DateTime->lunar_month_text);
        $this->assertEquals('14', $DateTime->lunar_day);


        $DateTime = DateTime::factory('2016-08-03');

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime->addDay(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('2', $DateTime->lunar_day);


        $DateTime->addDay(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('3', $DateTime->lunar_day);


        $DateTime->addDay(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('4', $DateTime->lunar_day);


        $DateTime = DateTime::factory('2016-08-07');
        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('5', $DateTime->lunar_day);
    }


    /**
     * @throws \ErrorException
     * @covers \JapaneseDate\DateTime::strftime()
     */
    public function test_strftime()
    {
        $DateTime = DateTime::factory('2018-05-03');
        $this->assertSame(
            (string)$DateTime->oriental_zodiac,
            $DateTime->strftime('%o')
        );

        $this->assertSame(
            (string)$DateTime->oriental_zodiac_text,
            $DateTime->strftime('%O')
        );

        $this->assertSame(
            (string)$DateTime->holiday,
            $DateTime->strftime('%l')
        );

        $this->assertSame(
            (string)$DateTime->holiday_text,
            $DateTime->strftime('%L')
        );

        $this->assertSame(
            (string)$DateTime->era_name,
            $DateTime->strftime('%f')
        );

        $this->assertSame(
            (string)$DateTime->era_name_text,
            $DateTime->strftime('%F')
        );

        $this->assertSame(
            (string)$DateTime->era_year,
            $DateTime->strftime('%E')
        );


        $this->assertSame(
            (string)$DateTime->six_weekday_text,
            $DateTime->strftime('%k')
        );
        $this->assertSame(
            (string)$DateTime->six_weekday,
            $DateTime->strftime('%6')
        );

        $this->assertSame(
            (string)$DateTime->weekday_text,
            $DateTime->strftime('%K')
        );

        $this->assertSame(
            ' ' . $DateTime->format('j'),
            $DateTime->strftime('%e')
        );
        $this->assertSame(
            ' ' . $DateTime->format('n'),
            $DateTime->strftime('%g')
        );

        $this->assertSame(
            $DateTime->format('j'),
            $DateTime->strftime('%J')
        );
        $this->assertSame(
            $DateTime->month_text,
            $DateTime->strftime('%G')
        );
        $this->assertSame(
            (string)$DateTime->month,
            $DateTime->strftime('%N')
        );

        $this->assertSame(
            '2018-05-03',
            $DateTime->strftime('%Y-%m-%d')
        );


        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            $DateTime->format('j'),
            $DateTime->strftime('%e')
        );

        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            $DateTime->format('n'),
            $DateTime->strftime('%g')
        );
    }


}
