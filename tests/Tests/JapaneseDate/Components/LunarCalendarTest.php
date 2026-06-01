<?php

/**
 * 旧暦カレンダーコンポーネントのテスト
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
 * @since       2018/04/30 2:25 リリースから利用可能
 */

namespace Tests\JapaneseDate\Components;

use Carbon\Carbon;
use JapaneseDate\Components\Config;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\LunarDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * LunarCalendar クラスのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 */
#[CoversClass(LunarCalendar::class)]
class LunarCalendarTest extends TestCase
{
    use InvokeTrait;

    /**
     * 朔日として検出されるべき日付を返す
     *
     * @return array
     */
    public static function makeLunarCalendarDataProvider(): array
    {
        return [
            '2009/01/26' => ['2009/01/26', []],
            '2009/02/25' => ['2009/02/25', []],
            '2009/03/27' => ['2009/03/27', []],
            '2009/04/25' => ['2009/04/25', []],
            '2009/05/24' => ['2009/05/24', []],
            '2009/06/23' => ['2009/06/23', []],
            '2009/07/22' => ['2009/07/22', []],
            '2009/08/20' => ['2009/08/20', []],
            '2009/09/19' => ['2009/09/19', []],
            '2009/10/18' => ['2009/10/18', []],
            '2009/11/17' => ['2009/11/17', []],
            '2009/12/16' => ['2009/12/16', []],
            '2010/01/15' => ['2010/01/15', []],
            '2010/02/14' => ['2010/02/14', []],
            '2010/03/16' => ['2010/03/16', []],
            '2010/04/14' => ['2010/04/14', []],
            '2010/05/14' => ['2010/05/14', []],
            '2010/06/12' => ['2010/06/12', []],
            '2010/07/12' => ['2010/07/12', []],
            '2010/08/10' => ['2010/08/10', []],
            '2010/09/08' => ['2010/09/08', []],
            '2010/10/08' => ['2010/10/08', []],
            '2010/11/06' => ['2010/11/06', []],
            '2010/12/06' => ['2010/12/06', []],
            '2011/01/04' => ['2011/01/04', []],
            '2011/02/03' => ['2011/02/03', []],
            '2011/03/05' => ['2011/03/05', []],
            '2011/04/03' => ['2011/04/03', []],
            '2011/05/03' => ['2011/05/03', []],
            '2011/06/02' => ['2011/06/02', []],
            '2011/07/01' => ['2011/07/01', []],
            '2011/07/31' => ['2011/07/31', []],
            '2011/08/29' => ['2011/08/29', []],
            '2011/09/27' => ['2011/09/27', []],
            '2011/10/27' => ['2011/10/27', []],
            '2011/11/25' => ['2011/11/25', []],
            '2011/12/25' => ['2011/12/25', []],
            '2012/01/23' => ['2012/01/23', []],
            '2012/02/22' => ['2012/02/22', []],
            '2012/03/22' => ['2012/03/22', []],
            '2012/04/21' => ['2012/04/21', []],
            '2012/05/21' => ['2012/05/21', []],
            '2012/06/20' => ['2012/06/20', []],
            '2012/07/19' => ['2012/07/19', []],
            '2012/08/18' => ['2012/08/18', []],
            '2012/09/16' => ['2012/09/16', []],
            '2012/10/15' => ['2012/10/15', []],
            '2012/11/14' => ['2012/11/14', []],
            '2012/12/13' => ['2012/12/13', []],
            '2013/01/12' => ['2013/01/12', []],
            '2013/02/10' => ['2013/02/10', []],
            '2013/03/12' => ['2013/03/12', []],
            '2013/04/10' => ['2013/04/10', []],
            '2013/05/10' => ['2013/05/10', []],
            '2013/06/09' => ['2013/06/09', []],
            '2013/07/08' => ['2013/07/08', []],
            '2013/08/07' => ['2013/08/07', []],
            '2013/09/05' => ['2013/09/05', []],
            '2013/10/05' => ['2013/10/05', []],
            '2013/11/03' => ['2013/11/03', []],
            '2013/12/03' => ['2013/12/03', []],
            '2014/01/01' => ['2014/01/01', []],
            '2014/01/31' => ['2014/01/31', []],
            '2014/03/01' => ['2014/03/01', []],
            '2014/03/31' => ['2014/03/31', []],
            '2014/04/29' => ['2014/04/29', []],
            '2014/05/29' => ['2014/05/29', []],
            '2014/06/27' => ['2014/06/27', []],
            '2014/07/27' => ['2014/07/27', []],
            '2014/08/25' => ['2014/08/25', []],
            '2014/09/24' => ['2014/09/24', []],
            '2014/10/24' => ['2014/10/24', []],
            '2014/11/22' => ['2014/11/22', []],
            '2014/12/22' => ['2014/12/22', []],
            '2015/01/20' => ['2015/01/20', []],
            '2015/02/19' => ['2015/02/19', []],
            '2015/03/20' => ['2015/03/20', []],
            '2015/04/19' => ['2015/04/19', []],
            '2015/05/18' => ['2015/05/18', []],
            '2015/06/16' => ['2015/06/16', []],
            '2015/07/16' => ['2015/07/16', []],
            '2015/08/14' => ['2015/08/14', []],
            '2015/09/13' => ['2015/09/13', []],
            '2015/10/13' => ['2015/10/13', []],
            '2015/11/12' => ['2015/11/12', []],
            '2015/12/11' => ['2015/12/11', []],
            '2016/01/10' => ['2016/01/10', []],
            '2016/02/08' => ['2016/02/08', []],
            '2016/03/09' => ['2016/03/09', []],
            '2016/04/07' => ['2016/04/07', []],
            '2016/05/07' => ['2016/05/07', []],
            '2016/06/05' => ['2016/06/05', []],
            '2016/07/04' => ['2016/07/04', []],
            '2016/08/03' => ['2016/08/03', []],
            '2016/09/01' => ['2016/09/01', []],
            '2016/10/01' => ['2016/10/01', []],
            '2016/10/31' => ['2016/10/31', []],
            '2016/11/29' => ['2016/11/29', []],
            '2016/12/29' => ['2016/12/29', []],
            '2017/01/28' => ['2017/01/28', []],
            '2017/02/26' => ['2017/02/26', []],
            '2017/03/28' => ['2017/03/28', []],
            '2017/04/26' => ['2017/04/26', []],
            '2017/05/26' => ['2017/05/26', []],
            '2017/06/24' => ['2017/06/24', []],
            '2017/07/23' => ['2017/07/23', []],
            '2017/08/22' => ['2017/08/22', []],
            '2017/09/20' => ['2017/09/20', []],
            '2017/10/20' => ['2017/10/20', []],
            '2017/11/18' => ['2017/11/18', []],
            '2017/12/18' => ['2017/12/18', []],
            '2018/01/17' => ['2018/01/17', []],
            '2018/02/16' => ['2018/02/16', []],
            '2018/03/17' => ['2018/03/17', []],
            '2018/04/16' => ['2018/04/16', []],
            '2018/05/15' => ['2018/05/15', []],
            '2018/06/14' => ['2018/06/14', []],
            '2018/07/13' => ['2018/07/13', []],
            '2018/08/11' => ['2018/08/11', []],
            '2018/09/10' => ['2018/09/10', []],
            '2018/10/09' => ['2018/10/09', []],
            '2018/11/08' => ['2018/11/08', []],
            '2018/12/07' => ['2018/12/07', []],
            '2019/01/06' => ['2019/01/06', []],
            '2019/02/05' => ['2019/02/05', []],
            '2019/03/07' => ['2019/03/07', []],
            '2019/04/05' => ['2019/04/05', []],
            '2019/05/05' => ['2019/05/05', []],
            '2019/06/03' => ['2019/06/03', []],
            '2019/07/03' => ['2019/07/03', []],
            '2019/08/01' => ['2019/08/01', []],
            '2019/08/30' => ['2019/08/30', []],
            '2019/09/29' => ['2019/09/29', []],
            '2019/10/28' => ['2019/10/28', []],
            '2019/11/27' => ['2019/11/27', []],
            '2019/12/26' => ['2019/12/26', []],
            '2020/01/25' => ['2020/01/25', []],
            '2020/02/24' => ['2020/02/24', []],
            '2020/03/24' => ['2020/03/24', []],
            '2020/04/23' => ['2020/04/23', []],
            '2020/05/23' => ['2020/05/23', []],
            '2020/06/21' => ['2020/06/21', []],
            '2020/07/21' => ['2020/07/21', []],
            '2020/08/19' => ['2020/08/19', []],
            '2020/09/17' => ['2020/09/17', []],
            '2020/10/17' => ['2020/10/17', []],
            '2020/11/15' => ['2020/11/15', []],
            '2020/12/15' => ['2020/12/15', []],
            '2021/01/13' => ['2021/01/13', []],
            '2021/02/12' => ['2021/02/12', []],
            '2021/03/13' => ['2021/03/13', []],
            '2021/04/12' => ['2021/04/12', []],
            '2021/05/12' => ['2021/05/12', []],
            '2021/06/10' => ['2021/06/10', []],
            '2021/07/10' => ['2021/07/10', []],
            '2021/08/08' => ['2021/08/08', []],
            '2021/09/07' => ['2021/09/07', []],
            '2021/10/06' => ['2021/10/06', []],
            '2021/11/05' => ['2021/11/05', []],
            '2021/12/04' => ['2021/12/04', []],
            '2022/01/03' => ['2022/01/03', []],
            '2022/02/01' => ['2022/02/01', []],
            '2022/03/03' => ['2022/03/03', []],
            '2022/04/01' => ['2022/04/01', []],
            '2022/05/01' => ['2022/05/01', []],
            '2022/05/30' => ['2022/05/30', []],
            '2022/06/29' => ['2022/06/29', []],
            '2022/07/29' => ['2022/07/29', []],
            '2022/08/27' => ['2022/08/27', []],
            '2022/09/26' => ['2022/09/26', []],
            '2022/10/25' => ['2022/10/25', []],
            '2022/11/24' => ['2022/11/24', []],
            '2022/12/23' => ['2022/12/23', []],
            '2023/01/22' => ['2023/01/22', []],
            '2023/02/20' => ['2023/02/20', []],
            '2023/03/22' => ['2023/03/22', []],
            '2023/04/20' => ['2023/04/20', []],
            '2023/05/20' => ['2023/05/20', []],
            '2023/06/18' => ['2023/06/18', []],
            '2023/07/18' => ['2023/07/18', []],
            '2023/08/16' => ['2023/08/16', []],
            '2023/09/15' => ['2023/09/15', []],
            '2023/10/15' => ['2023/10/15', []],
            '2023/11/13' => ['2023/11/13', []],
            '2023/12/13' => ['2023/12/13', []],
            '2024/01/11' => ['2024/01/11', []],
            '2024/02/10' => ['2024/02/10', []],
            '2024/03/10' => ['2024/03/10', []],
            '2024/04/09' => ['2024/04/09', []],
            '2024/05/08' => ['2024/05/08', []],
            '2024/06/06' => ['2024/06/06', []],
            '2024/07/06' => ['2024/07/06', []],
            '2024/08/04' => ['2024/08/04', []],
            '2024/09/03' => ['2024/09/03', []],
            '2024/10/03' => ['2024/10/03', []],
            '2024/11/01' => ['2024/11/01', []],
            '2024/12/01' => ['2024/12/01', []],
            '2024/12/31' => ['2024/12/31', []],
            // 月黄経負値バグ修正後: 2034-03-20 が朔日として認識されること
            '2034/03/20' => ['2034/03/20', []],
            // >= 1900 キャリブレーション: makeLunarCalendar(2001) のループ内で
            // 2000-12-25 が age1=28.78 > 20, age2=0.026 < 0.17 を満たしキャリブレーションが発動する
            '2001/01/24' => ['2001/01/24', []],
            // < 1900 キャリブレーション: makeLunarCalendar(1899) のループ内で
            // 1899-05-09 が age1=28.48 > 20, age2=0.015 < 0.1 を満たしキャリブレーションが発動する
            '1899/05/10' => ['1899/05/10', []],
        ];
    }

    /**
     * 月齢計算の検証用データを返す
     *
     * @return array
     */
    public static function moonAgeDataProvider(): array
    {
        return [
            '2023朔' => [2023, 1, 22, 5, 53, 0, 0],
            '2023望' => [2023, 2, 6, 3, 29, 0, 15],
            '2020朔_直前' => [2020, 12, 14, 0, 0, 0, 29],
            '2020朔' => [2020, 12, 15, 1, 17, 0, 0],
            '2020朔_直後' => [2020, 12, 16, 1, 17, 0, 1],
            '2019朔_直前' => [2019, 11, 26, 0, 0, 0, 29],
            '2019朔' => [2019, 11, 27, 0, 6, 0, 0],
            // 月黄経負値バグ修正後: 朔は0付近になること
            '2026朔' => [2026, 3, 19, 10, 23, 0, 0],
            // 朔前(0:00 JST)は前周期の29.x のままであること
            '2026朔_直前' => [2026, 3, 19, 0, 0, 0, 29],
            // 2034-03-20 19:15 JST が国立天文台の朔
            '2034朔' => [2034, 3, 20, 19, 15, 0, 0],
        ];
    }

    /**
     * factory が同一インスタンスを返すことを確認する
     *
     * @return void
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_factory(): void
    {
        $LunarCalendar1 = LunarCalendar::factory();
        $LunarCalendar2 = LunarCalendar::factory();

        $this->assertSame($LunarCalendar1, $LunarCalendar2);
    }

    /**
     * 指定日の旧暦配列が年境界を含めて正しく取得できることを確認する
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_getLunarCalendarArray(): void
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
     * makeLunarCalendar が各年の朔日を旧暦カレンダーに含めることを確認する
     *
     * @param string $date
     * @param array $calendar
     * @return void
     * @throws \ReflectionException
     */
    #[DataProvider('makeLunarCalendarDataProvider')]
    public function test_makeLunarCalendar($date, $calendar): void
    {
        $LunarCalendar = LunarCalendar::factory();

        [$year, $month, $day] = explode('/', $date, 3);
        $year = (int) $year;
        $month = (int) $month;
        $day = (int) $day;

        $calendar_array = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [$year]);

        $check_calendar_array = [];
        foreach ($calendar_array as $item) {
            $keyDay = Carbon::create($item['year'], $item['month'], $item['day']);
            $check_calendar_array[$keyDay->format('Y/m/d')] = $item;
        }

        $this->assertArrayHasKey($date, $check_calendar_array, json_encode($calendar_array));
    }

    /**
     * 指定日時の月齢を丸めた値で確認する
     *
     * @param $year
     * @param $month
     * @param $day
     * @param $hour
     * @param $minute
     * @param $second
     * @param $moon_age
     * @return void
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('moonAgeDataProvider')]
    public function test_moonAge($year, $month, $day, $hour, $minute, $second, $moon_age): void
    {
        $LunarCalendar = LunarCalendar::factory();

        $this->assertEquals($moon_age, round($LunarCalendar->moonAge($year, $month, $day, $hour, $minute, $second)));
    }

    /**
     * Config::getLC がデータを返した場合に makeLunarCalendar が早期リターンすることを確認する
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_makeLunarCalendar_returnsConfigData(): void
    {
        $tmpDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'jdate_lc_test_' . uniqid('', true);
        mkdir($tmpDir, 0777, true);

        $year = 2099;
        file_put_contents(
            $tmpDir . DIRECTORY_SEPARATOR . $year . '.php',
            <<<'PHP'
<?php
return [
    'lunarCalendar' => [
        [
            'year'             => 2099,
            'month'            => 1,
            'day'              => 22,
            'lunar_year'       => 2098,
            'lunar_month'      => 12,
            'lunar_month_leap' => false,
        ],
    ],
];
PHP
        );

        Config::addLCPath($tmpDir);

        $lunarCalendar = new LunarCalendar();
        $result = $this->invokeExecuteMethod($lunarCalendar, 'makeLunarCalendar', [$year]);

        $this->assertNotEmpty($result);
        $this->assertSame(2099, $result[0]['year']);
        $this->assertSame(1, $result[0]['month']);
        $this->assertSame(22, $result[0]['day']);
        $this->assertArrayHasKey('jd', $result[0]);

        @unlink($tmpDir . DIRECTORY_SEPARATOR . $year . '.php');
        @rmdir($tmpDir);
        Config::setLCPath([]);
    }

    /**
     * getLunarDate が LunarDate インスタンスを返すことを確認する
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_getLunarDate(): void
    {
        $LunarCalendar = LunarCalendar::factory();
        // 2023-01-22 は旧暦 2022年12月1日（朔日）
        $DateTime = DateTime::factory('2023-01-22');
        $result = $LunarCalendar->getLunarDate($DateTime);

        $this->assertInstanceOf(LunarDate::class, $result);
        $this->assertEquals(2023, (int) $result->year);
        $this->assertEquals(1, (int) $result->month);
        $this->assertEquals(1, (int) $result->day);
    }

    /**
     * 2034年の朔日補正が旧暦日に反映されることを確認する
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_lunarDate_2034(): void
    {
        // 2034-03-20 19:15 JST が朔 → 旧暦 2/1 であること
        $DateTime = DateTime::factory('2034-03-20');
        $this->assertEquals(2034, (int) $DateTime->lunar_year);
        $this->assertEquals(2, (int) $DateTime->lunar_month);
        $this->assertEquals(1, (int) $DateTime->lunar_day);

        $DateTime2 = DateTime::factory('2034-03-21');
        $this->assertEquals(2, (int) $DateTime2->lunar_day);
    }

    // ==================== moonPhaseAngle ====================

    /**
     * moonPhaseAngle は [0, 360) の浮動小数点数を返す
     *
     * 検証出典: 国立天文台 朔望データ
     *   2023-01-22 05:53 JST (= 2023-01-21 20:53 UTC) が新月 → 位相角 ≒ 0°
     *   2023-02-05 18:29 UTC が満月 → 位相角 ≒ 180°
     */
    public function test_moonPhaseAngle_newMoon(): void
    {
        $lc = LunarCalendar::factory();

        // 新月時刻 (2023-01-21 20:53 UTC) → 位相角は新月区間 (337.5° 〜 22.5°) に入る
        $result = $lc->moonPhaseAngle(2023, 1, 21, 20.0, 53.0, 0.0);
        $this->assertIsFloat($result);
        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
        $this->assertTrue(
            $result < 22.5 || $result >= 337.5,
            "新月付近の位相角({$result}°)が新月区間外です"
        );
    }

    public function test_moonPhaseAngle_fullMoon(): void
    {
        $lc = LunarCalendar::factory();

        // 満月時刻 (2023-02-05 18:29 UTC) → 位相角は満月区間 (157.5° 〜 202.5°) に入る
        $result = $lc->moonPhaseAngle(2023, 2, 5, 18.0, 29.0, 0.0);
        $this->assertGreaterThan(135.0, $result);
        $this->assertLessThan(225.0, $result);
    }

    // ==================== moonPhase ====================

    /**
     * moonPhase は 0〜7 の整数を返す
     *
     * 検証出典: 国立天文台 朔望データ
     */
    public function test_moonPhase_newMoon(): void
    {
        $lc = LunarCalendar::factory();

        // 新月時刻 → 月相 0 (新月)
        $result = $lc->moonPhase(2023, 1, 21, 20.0, 53.0, 0.0);
        $this->assertIsInt($result);
        $this->assertSame(0, $result, '新月時刻の月相が 0 (新月) でありません');
    }

    public function test_moonPhase_fullMoon(): void
    {
        $lc = LunarCalendar::factory();

        // 満月時刻 → 月相 4 (満月)
        $result = $lc->moonPhase(2023, 2, 5, 18.0, 29.0, 0.0);
        $this->assertIsInt($result);
        $this->assertSame(4, $result, '満月時刻の月相が 4 (満月) でありません');
    }
}
