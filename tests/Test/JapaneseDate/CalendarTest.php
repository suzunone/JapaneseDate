<?php
/**
 * Class CalendarTest
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/05/09 17:10
 */

namespace Tests\JapaneseDate;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\Calendar;
use JapaneseDate\DateTime;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Class CalendarTest
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class CalendarTest extends TestCase
{
    use InvokeTrait;

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @throws \ReflectionException
     */
    public function test_construct()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = new DateTime($test_date_time->format('Y-m-d H:i:s'));

        $Calendar = new Calendar($test_date_time);

        $this->assertSame(
            $test_date_time->timestamp,
            $this->invokeGetProperty($Calendar, 'start_time_stamp')->timestamp
        );
        $this->assertSame(
            $test_date_time->getTimezone()->getName(),
            $this->invokeGetProperty($Calendar, 'timezone')->getName()
        );
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @throws \Exception
     */
    public function test_getDatesOfMonth()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = DateTime::factory($test_date_time);

        $Calendar = new Calendar($test_date_time);
        $res      = $Calendar->getDatesOfMonth();
        $this->assertCount($test_date_time->daysInMonth, $res);
        $this->assertEquals($test_date_time->month, $res[0]->month);
        $this->assertEquals(1, $res[0]->day);
        $this->assertInstanceOf(DateTime::class, $res[0]);
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @throws \Exception
     */
    public function test_getWorkingDayByLimit()
    {
        $faker = FakerFactory::create();

        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = DateTime::factory($test_date_time);

        // 日付指定のBypass
        $Calendar = new Calendar('2018-05-01');
        // 範囲内のスキップ
        $Calendar->addBypassDay('2018-05-10');
        $Calendar->addBypassDay('2018-05-15');

        // 範囲外のスキップ
        $Calendar->addBypassDay('2018-06-01');

        $res = $Calendar->getWorkingDayByLimit(20);
        $this->assertCount(20, $res);
        $this->assertEquals('2018-05-01', $res[0]->format('Y-m-d'));
        $this->assertEquals('2018-05-11', $res[9]->format('Y-m-d'));
        $this->assertEquals('2018-05-16', $res[13]->format('Y-m-d'));
        $this->assertEquals('2018-05-22', $res[19]->format('Y-m-d'));

        // 範囲外も範囲内にして再計算
        $res = $Calendar->getWorkingDayByLimit(50);
        $this->assertCount(50, $res);
        $this->assertEquals('2018-05-01', $res[0]->format('Y-m-d'));
        $this->assertEquals('2018-05-11', $res[9]->format('Y-m-d'));
        $this->assertEquals('2018-05-16', $res[13]->format('Y-m-d'));
        $this->assertEquals('2018-05-31', $res[28]->format('Y-m-d'));
        $this->assertEquals('2018-06-02', $res[29]->format('Y-m-d'));

        //  全件テスト
        $Calendar = new Calendar($test_date_time);
        $lim      = $faker->numberBetween(10, 1000);
        $res      = $Calendar->getWorkingDayByLimit($lim);

        $this->assertEquals($test_date_time->format('Y-m-d'), $res[0]->format('Y-m-d'));
        $this->assertArrayHasKey(1, $res);
        $this->assertCount($lim, $res);

        return $res;
    }

    /**
     * @test
     * @covers  \JapaneseDate\Calendar::getWorkingDay()
     * @depends test_getWorkingDayByLimit
     * @param array $res
     * @throws \Exception
     */
    public function test_getWorkingDay($res = [])
    {
        $faker = FakerFactory::create();

        $lim = $faker->numberBetween(1, 1000);

        $Calendar = m::mock(Calendar::class . '[getWorkingDayByLimit]');

        $Calendar->shouldReceive('getWorkingDayByLimit')
            ->once()
            ->with($lim)
            ->andReturn($res);

        /**
         * @var Calendar $Calendar
         */
        $this->assertEquals($res, $Calendar->getWorkingDay($lim));
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @throws \Exception
     */
    public function test_getWorkingDayBySpan()
    {
        $Calendar = new Calendar('2018-05-01');
        $res      = $Calendar->getWorkingDayBySpan('2018-05-31');
        $this->assertEquals('2018-05-01', $res[0]->format('Y-m-d'));
        $this->assertEquals('2018-05-31', $res[30]->format('Y-m-d'));
        $this->assertCount(31, $res);
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar::getCompareFormat
     * @throws \ReflectionException
     */
    public function test_getCompareFormat()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = DateTime::factory($test_date_time);

        $Calendar = new Calendar();

        $this->assertEquals(
            (int) $test_date_time->format('Ymd'),
                            $this->invokeExecuteMethod($Calendar, 'getCompareFormat', [$test_date_time])
        );
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar::isWorkingDay
     * @throws \ReflectionException
     */
    public function test_isWorkingDay()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time  = $FakerGenerator->dateTime();
        $test_date_time2 = $FakerGenerator->dateTime();
        while ($test_date_time->format('Ymd') == $test_date_time2->format('Ymd')) {
            $test_date_time2 = $FakerGenerator->dateTime();
        }

        // 特定日
        $Calendar = new Calendar();
        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory($test_date_time)])
        );
        $Calendar->addBypassDay($test_date_time);

        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory($test_date_time)])
        );

        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory($test_date_time2)])
        );

        // 祝日
        $Calendar = new Calendar();

        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-03')])
        );

        $Calendar->setBypassHoliday(true);

        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-03')])
        );

        // 曜日
        $Calendar = new Calendar();

        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-06')])
        );

        $Calendar->addBypassWeekDay(0);

        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-06')])
        );

        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-05')])
        );

        $Calendar->addBypassWeekDay(6);

        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-05')])
        );
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @return Calendar
     * @throws \ReflectionException
     */
    public function test_addBypassWeekDay()
    {
        $Calendar = new Calendar();

        $this->assertEquals(
            [],
                            $this->invokeGetProperty($Calendar, 'bypass_week_day_arr')
        );

        $Calendar->addBypassWeekDay(0);
        $this->assertEquals(
            [0 => true],
                            $this->invokeGetProperty($Calendar, 'bypass_week_day_arr')
        );

        $Calendar->addBypassWeekDay('6');
        $this->assertEquals(
            [0 => true, 6 => true],
            $this->invokeGetProperty($Calendar, 'bypass_week_day_arr')
        );

        return $Calendar;
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @return Calendar
     * @throws \ReflectionException
     */
    public function test_addBypassDay()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time  = $FakerGenerator->dateTime();
        $test_date_time2 = $FakerGenerator->dateTime();
        while ($test_date_time->format('Ymd') == $test_date_time2->format('Ymd')) {
            $test_date_time2 = $FakerGenerator->dateTime();
        }

        $Calendar = new Calendar();

        $this->assertEquals(
            [],
                            $this->invokeGetProperty($Calendar, 'bypass_day_arr')
        );

        $Calendar->addBypassDay($test_date_time);
        $this->assertArrayHasKey(
            (int) $test_date_time->format('Ymd'),
                                 $this->invokeGetProperty($Calendar, 'bypass_day_arr')
        );
        $this->assertCount(1, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        $Calendar->addBypassDay($test_date_time2);
        $this->assertArrayHasKey(
            (int) $test_date_time2->format('Ymd'),
                                 $this->invokeGetProperty($Calendar, 'bypass_day_arr')
        );
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        return $Calendar;
    }

    /**
     * @test
     * @covers \JapaneseDate\Calendar
     * @throws \ReflectionException
     */
    public function test_setBypassHoliday()
    {
        $Calendar = new Calendar();
        $this->assertFalse(
            $this->invokeGetProperty($Calendar, 'is_bypass_holiday')
        );

        $Calendar->setBypassHoliday(true);
        $this->assertTrue(
            $this->invokeGetProperty($Calendar, 'is_bypass_holiday')
        );

        $Calendar->setBypassHoliday(false);
        $this->assertFalse(
            $this->invokeGetProperty($Calendar, 'is_bypass_holiday')
        );
    }

    /**
     * @test
     * @covers  \JapaneseDate\Calendar
     * @depends test_addBypassDay
     * @param \JapaneseDate\Calendar $Calendar
     * @throws \ReflectionException
     */
    public function test_removeBypassDay(Calendar $Calendar)
    {
        $Calendar = clone $Calendar;

        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        $bypass_day_arr = $this->invokeGetProperty($Calendar, 'bypass_day_arr');
        $key            = current(array_keys($bypass_day_arr));
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        // 空削除用の日付
        $test_date_time = $FakerGenerator->dateTime();
        while (isset($bypass_day_arr[(int) $test_date_time->format('Ymd')])) {
            $test_date_time = $FakerGenerator->dateTime();
        }

        // 空削除
        $Calendar->removeBypassDay($test_date_time);
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        // 実削除
        $Calendar->removeBypassDay($bypass_day_arr[$key]);
        $this->assertCount(1, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
    }

    /**
     * @test
     * @covers  \JapaneseDate\Calendar
     * @depends test_addBypassDay
     * @param \JapaneseDate\Calendar $Calendar
     * @throws \ReflectionException
     */
    public function test_resetBypassDay(Calendar $Calendar)
    {
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        $Calendar->resetBypassDay();
        $this->assertCount(0, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
    }

    /**
     * @test
     * @covers  \JapaneseDate\Calendar
     * @depends test_addBypassWeekDay
     * @param \JapaneseDate\Calendar $Calendar
     * @throws \ReflectionException
     */
    public function test_removeBypassWeekDay(Calendar $Calendar)
    {
        $Calendar = clone $Calendar;
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));

        $this->invokeGetProperty($Calendar, 'bypass_week_day_arr');
        $Calendar->removeBypassWeekDay(1);

        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));

        $Calendar->removeBypassWeekDay(0);
        $this->assertCount(1, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
    }

    /**
     * @test
     * @covers  \JapaneseDate\Calendar
     * @depends test_addBypassWeekDay
     * @param \JapaneseDate\Calendar $Calendar
     * @throws \ReflectionException
     */
    public function test_resetBypassWeekDay(Calendar $Calendar)
    {
        $this->invokeGetProperty($Calendar, 'bypass_week_day_arr');
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));

        $Calendar->resetBypassWeekDay();
        $this->assertCount(0, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
    }
}
