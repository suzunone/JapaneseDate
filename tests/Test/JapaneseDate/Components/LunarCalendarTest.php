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

    public static function makeLunarCalendarDataProvider()
    {
        return [
            '2017' => [
                2017,
                [

                    [
                        'year'  => 2016,
                        'month' => 11,
                        'day'   => 29,

                        'jd'               => 2457722.0,
                        'lunar_month'      => 11.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2016,
                    ],

                    [
                        'year'  => 2016,
                        'month' => 12,
                        'day'   => 29,

                        'jd'               => 2457752.0,
                        'lunar_month'      => 12.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2016,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 1,
                        'day'   => 28,

                        'jd'               => 2457782.0,
                        'lunar_month'      => 1.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 2,
                        'day'   => 26,

                        'jd'               => 2457811.0,
                        'lunar_month'      => 2.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 3,
                        'day'   => 28,

                        'jd'               => 2457841.0,
                        'lunar_month'      => 3.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 4,
                        'day'   => 26,

                        'jd'               => 2457870.0,
                        'lunar_month'      => 4.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 5,
                        'day'   => 26,

                        'jd'               => 2457900.0,
                        'lunar_month'      => 5.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 6,
                        'day'   => 24,

                        'jd'               => 2457929.0,
                        'lunar_month'      => 5.0,
                        'lunar_month_leap' => true,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 7,
                        'day'   => 23,

                        'jd'               => 2457958.0,
                        'lunar_month'      => 6.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 8,
                        'day'   => 22,

                        'jd'               => 2457988.0,
                        'lunar_month'      => 7.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 9,
                        'day'   => 20,

                        'jd'               => 2458017.0,
                        'lunar_month'      => 8.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 10,
                        'day'   => 20,

                        'jd'               => 2458047.0,
                        'lunar_month'      => 9.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 11,
                        'day'   => 18,

                        'jd'               => 2458076.0,
                        'lunar_month'      => 10.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2017,
                        'month' => 12,
                        'day'   => 18,

                        'jd'               => 2458106.0,
                        'lunar_month'      => 11.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],

                    [
                        'year'  => 2018,
                        'month' => 1,
                        'day'   => 17,

                        'jd'               => 2458136.0,
                        'lunar_month'      => 12.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2017,
                    ],
                ],
            ],

            '2020' => [
                2020,
                [
                    
                    [
                        'year'  => 2019,
                        'month' => 11,
                        'day'   => 27,

                        'jd'               => 2458814.0,
                        'lunar_month'      => 11.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2019,
                    ],

                    [
                        'year'  => 2019,
                        'month' => 12,
                        'day'   => 26,

                        'jd'               => 2458844.0,
                        'lunar_month'      => 12.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2019,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 1,
                        'day'   => 25,

                        'jd'               => 2458874.0,
                        'lunar_month'      => 1.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 2,
                        'day'   => 24,

                        'jd'               => 2458903.0,
                        'lunar_month'      => 2.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 3,
                        'day'   => 24,

                        'jd'               => 2458933.0,
                        'lunar_month'      => 3.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 4,
                        'day'   => 23,

                        'jd'               => 2458963.0,
                        'lunar_month'      => 4.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 5,
                        'day'   => 23,

                        'jd'               => 2458993.0,
                        'lunar_month'      => 4.0,
                        'lunar_month_leap' => true,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 6,
                        'day'   => 21,

                        'jd'               => 2459022.0,
                        'lunar_month'      => 5.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 7,
                        'day'   => 21,

                        'jd'               => 2459052.0,
                        'lunar_month'      => 6.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 8,
                        'day'   => 19,

                        'jd'               => 2459081.0,
                        'lunar_month'      => 7.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 9,
                        'day'   => 17,

                        'jd'               => 2459110.0,
                        'lunar_month'      => 8.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 10,
                        'day'   => 17,

                        'jd'               => 2459140.0,
                        'lunar_month'      => 9.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 11,
                        'day'   => 15,

                        'jd'               => 2459169.0,
                        'lunar_month'      => 10.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2020,
                        'month' => 12,
                        'day'   => 15,

                        'jd'               => 2459198.0,
                        'lunar_month'      => 11.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],

                    [
                        'year'  => 2021,
                        'month' => 1,
                        'day'   => 13,

                        'jd'               => 2459228.0,
                        'lunar_month'      => 12.0,
                        'lunar_month_leap' => false,
                        'lunar_year'       => 2020,
                    ],
                ],
            ],
        ];
    }

    /**
     * @covers              \JapaneseDate\Components\LunarCalendar
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @dataProvider        makeLunarCalendarDataProvider
     */
    public function test_makeLunarCalendar($year, $calendar)
    {
        $LunarCalendar = LunarCalendar::factory();

        $res = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [$year]);
        foreach ($calendar as $key => $item) {
            $this->assertEquals($item['year'], $res[$key]['year'], "#$key => year\n".json_encode($item)."\n".json_encode($res[$key]));
            $this->assertEquals($item['month'], $res[$key]['month'], "#$key => month\n".json_encode($item)."\n".json_encode($res[$key]));
            $this->assertEquals($item['day'], $res[$key]['day'], "#$key => day\n".json_encode($item)."\n".json_encode($res[$key]));
            $this->assertEquals($item['lunar_month'], $res[$key]['lunar_month'], "#$key => lunar_month\n".json_encode($item)."\n".json_encode($res[$key]));
            $this->assertEquals($item['lunar_month_leap'], $res[$key]['lunar_month_leap'], "#$key => lunar_month_leap\n".json_encode($item)."\n".json_encode($res[$key]));
            $this->assertEquals($item['lunar_year'], $res[$key]['lunar_year'], "#$key => lunar_year\n".json_encode($item)."\n".json_encode($res[$key]));
        }

        $this->assertCount(count($calendar), $res);
    }

    public static function moonAgeDataProvider()
    {
        return [
            '2023朔'               => [2023, 1, 22, 5, 53, 0, 0],
            '2023望'               => [2023, 2, 6, 3, 29, 0, 15],
            '2020朔_before'        => [2020, 12, 14, 0, 0, 0, 29],
            '2020朔'               => [2020, 12, 15, 1, 17, 0, 0],
            '2020朔_after'         => [2020, 12, 16, 1, 17, 0, 1],
            '2019朔_before'        => [2019, 11, 26, 0, 0, 0, 29],
            '2019朔'               => [2019, 11, 27, 0, 6, 0, 0],
        ];
    }

    /**
     * @dataProvider moonAgeDataProvider
     * @return void
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonAge($year, $month, $day, $hour, $minute, $second, $moon_age)
    {
        $LunarCalendar = LunarCalendar::factory();

        $this->assertEquals($moon_age, round($LunarCalendar->moonAge($year, $month, $day, $hour, $minute, $second)));
    }
}
