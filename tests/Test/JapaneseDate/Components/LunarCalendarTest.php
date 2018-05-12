<?php
/**
 *
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/04/30 2:25
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\LunarCalendar;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class LunarCalendarTest
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class LunarCalendarTest extends TestCase
{
    use InvokeTrait;

    /**
     * @throws \ReflectionException
     * @test
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_gregorian2JD()
    {
        $LunarCalendar = LunarCalendar::factory();

        $this->assertEquals(
            0,
            $this->invokeExecuteMethod($LunarCalendar, 'gregorian2JD', [-4714, 1, 1, 0, 0, 0])
        );


        $this->assertEquals(
            2458179.0,
            $this->invokeExecuteMethod($LunarCalendar, 'gregorian2JD', [2018, 3, 1, 0, 0, 0])
        );

    }

    /**
     * @throws \ReflectionException
     * @test
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_gregorian2JY()
    {
        $LunarCalendar = LunarCalendar::factory();


        $this->assertEquals(
            0.0,
            $this->invokeExecuteMethod($LunarCalendar, 'gregorian2JY', [2000, 1, 2, 3, 0, 0, 0])
        );


    }


    /**
     * 2000年1月1日力学時正午からの経過日数
     *
     * @param    int $year , $month, $day  グレゴリオ暦による年月日
     * @param $month
     * @param $day
     * @return    float 経過日数（日本標準時）
     */
    private function gregorian2J2000($year, $month, $day)
    {
        $year -= 2000;
        if ($month <= 2) {
            $month += 12;
            $year--;
        }

        $j2000 = 365.0 * $year + 30.0 * $month + $day - 33.5 - 9 / 24.0;
        $j2000 += floor(3.0 * ($month + 1) / 5.0);
        $j2000 += floor($year / 4.0);

        return $j2000;
    }


    /**
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory()
    {
        $LunarCalendar1 = LunarCalendar::factory();
        $LunarCalendar2 = LunarCalendar::factory();

        $this->assertSame($LunarCalendar1, $LunarCalendar2);
    }

    /**
     * @throws \ReflectionException
     * @test
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_getLunarCalendarArray()
    {
        $LunarCalendar = LunarCalendar::factory();

        // 2016年
        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray', [2016, 2, 8]);
        $this->assertSame([
                              2016,
                              false,
                              1.0,
                              1.0], $res);


        // 2018年年の変わり目
        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray', [2018, 2, 14]);

        $this->assertSame([
                              2017,
                              false,
                              12.0,
                              29.0], $res);

        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray', [2018, 2, 15]);

        $this->assertSame([
                              2017,
                              false,
                              12.0,
                              30.0], $res);

        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray', [2018, 2, 16]);

        $this->assertSame([
                              2018,
                              false,
                              1.0,
                              1.0], $res);
    }

    /**
     * @throws \ReflectionException
     * @test
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_makeLunarCalendar()
    {
        $LunarCalendar = LunarCalendar::factory();

        $res = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [2017]);


        $this->assertFalse($res[0]['lunar_month_leap']);
        $this->assertFalse($res[1]['lunar_month_leap']);
        $this->assertFalse($res[2]['lunar_month_leap']);
        $this->assertFalse($res[3]['lunar_month_leap']);
        $this->assertFalse($res[4]['lunar_month_leap']);
        $this->assertFalse($res[5]['lunar_month_leap']);
        $this->assertFalse($res[6]['lunar_month_leap']);
        $this->assertTrue($res[7]['lunar_month_leap']);
        $this->assertFalse($res[8]['lunar_month_leap']);
        $this->assertFalse($res[9]['lunar_month_leap']);
        $this->assertFalse($res[10]['lunar_month_leap']);
        $this->assertFalse($res[11]['lunar_month_leap']);
        $this->assertFalse($res[12]['lunar_month_leap']);
        $this->assertFalse($res[13]['lunar_month_leap']);


        $this->assertCount(15, $res);

    }

}
