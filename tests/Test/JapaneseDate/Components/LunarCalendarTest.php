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

    public static function makeLunarCalendar_refactorDataProvider()
    {
        $res = [];
        foreach (range(1948, 2040) as $year) {
            $res[$year] = [$year];
            break;
        }

        return $res;
    }

    /**
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @dataProvider        makeLunarCalendar_refactorDataProvider
     */
    public function test_makeLunarCalendar_refactor($year)
    {
        $LunarCalendar = LunarCalendar::factory();

        $res = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [$year]);
        $this->assertSame($this->Legacy_makeLunarCalendar($year), $res);
    }

    /**
     * グレゴオリオ暦＝旧暦テーブル 作成
     *
     * @param int $year 西暦年
     * @return array 朔のテーブル
     */
    private function Legacy_makeLunarCalendar(int $year): array
    {
        $LunarCalendar = LunarCalendar::factory();

        // 朔の日を求める
        $lunar_calendar = [];
        $find_year = $year - 1;
        $counter = 0;
        $find_day = 10;
        $find_month = 11;
        while ($find_year <= $year || $find_month <= 2) {
            $days_in_month = $this->invokeExecuteMethod($LunarCalendar, 'getDaysInMonth', [$find_year, $find_month]);
            while ($find_day <= $days_in_month) {
                $age1 = $LunarCalendar->moonAge($find_year, $find_month, $find_day, 0, 0, 0);
                $age2 = $LunarCalendar->moonAge($find_year, $find_month, $find_day, 23, 59, 59);
                if ($age2 <= $age1) {
                    $lunar_calendar[$counter]['year'] = $find_year;
                    $lunar_calendar[$counter]['month'] = $find_month;
                    $lunar_calendar[$counter]['day'] = $find_day;
                    $lunar_calendar[$counter]['age'] = $age1;
                    $lunar_calendar[$counter]['jd'] = $this->invokeExecuteMethod($LunarCalendar, 'gregorian2JD', [$find_year, $find_month, $find_day, 0, 0, 0]);
                    // $lunar_calendar[$counter]['gregorian'] = $this->jD2Gregorian($lunar_calendar[$counter]['jd']);
                    $counter++;
                    // 実行時間短縮のため20日ほどすすめる
                    $find_day += 20;
                }
                $find_day++;
            }
            $find_month++;
            $find_day -= $days_in_month;
            $find_day = max($find_day, 1);

            if ($find_month > 12) {
                $find_year++;
                $find_month = 1;
            }
        }

        // 中気を求める
        $sun_calendar = [];
        $find_year = $year - 1;
        $counter = 0;
        $find_day = 1;
        $find_month = 11;
        while ($find_year <= $year || $find_month <= 2) {
            $days_in_month = $this->invokeExecuteMethod($LunarCalendar, 'getDaysInMonth', [$find_year, $find_month]);
            while ($find_day <= $days_in_month) {
                $longitude_sun_1 = $this->invokeExecuteMethod($LunarCalendar, 'longitudeSun', [$find_year, $find_month, $find_day, 0, 0, 0]);
                $longitude_sun_2 = $this->invokeExecuteMethod($LunarCalendar, 'longitudeSun', [$find_year, $find_month, $find_day, 24, 0, 0]);
                $tmp_ls_1 = floor($longitude_sun_1 / 15.0);
                $tml_ls_2 = floor($longitude_sun_2 / 15.0);
                if (($tml_ls_2 !== $tmp_ls_1) && ($tml_ls_2 % 2 === 0)) {
                    $sun_calendar[$counter]['jd'] = $this->invokeExecuteMethod($LunarCalendar, 'gregorian2JD', [$find_year, $find_month, $find_day, 0, 0, 0]);
                    $lunar_month = floor($tml_ls_2 / 2) + 2;
                    if ($lunar_month > 12) {
                        $lunar_month -= 12;
                    }
                    $sun_calendar[$counter]['lunar_month'] = $lunar_month;
                    $sun_calendar[$counter]['year'] = $find_year;
                    $counter++;

                    // 実行時間短縮のため、20日ほどすすめる
                    $find_day += 20;
                }
                $find_day++;
            }

            $find_month++;
            $find_day -= $days_in_month;
            $find_day = max($find_day, 1);
            if ($find_month > 12) {
                $find_year++;
                $find_month = 1;
            }
        }

        // 旧暦月と、閏月のフラグを追加
        $lunar_calendar_count = count($lunar_calendar);
        $sun_calendar_count = count($sun_calendar);
        for ($iterator_1 = 0; $iterator_1 < $lunar_calendar_count - 1; $iterator_1++) {
            for ($iterator_2 = 0; $iterator_2 < $sun_calendar_count; $iterator_2++) {
                if (($lunar_calendar[$iterator_1]['jd'] <= $sun_calendar[$iterator_2]['jd'])
                    && ($lunar_calendar[$iterator_1 + 1]['jd'] > $sun_calendar[$iterator_2]['jd'])) {
                    $lunar_calendar[$iterator_1]['lunar_month'] = $sun_calendar[$iterator_2]['lunar_month'];
                    $lunar_calendar[$iterator_1]['lunar_month_leap'] = false;

                    $lunar_calendar[$iterator_1 + 1]['lunar_month'] = $sun_calendar[$iterator_2]['lunar_month'];
                    $lunar_calendar[$iterator_1 + 1]['lunar_month_leap'] = true;

                    $lunar_calendar[$iterator_1]['lunar_year'] = $year;
                    $lunar_calendar[$iterator_1 + 1]['lunar_year'] = $year;

                    if ($iterator_1 < $lunar_calendar[$iterator_1]['lunar_month']) {
                        $lunar_calendar[$iterator_1]['lunar_year']--;
                        $lunar_calendar[$iterator_1 + 1]['lunar_year']--;
                    }

                    break;
                }
            }
        }

        array_pop($lunar_calendar);

        return $lunar_calendar;
    }

    /**
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
     * @param int $year , $month, $day  グレゴリオ暦による年月日
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
            'getLunarCalendarArray',
            [2016, 2, 8]
        );
        $this->assertSame([
            2016,
            false,
            1.0,
            1.0, ], $res);

        // 2018年年の変わり目
        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray',
            [2018, 2, 14]
        );

        $this->assertSame([
            2017,
            false,
            12.0,
            29.0, ], $res);

        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray',
            [2018, 2, 15]
        );

        $this->assertSame([
            2017,
            false,
            12.0,
            30.0, ], $res);

        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray',
            [2018, 2, 16]
        );

        $this->assertSame([
            2018,
            false,
            1.0,
            1.0, ], $res);
    }

    /**
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
