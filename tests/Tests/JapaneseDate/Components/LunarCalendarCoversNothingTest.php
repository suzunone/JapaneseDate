<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;


/**
 * LunarCalendar の統合テスト（カバレッジ対象外）。
 *
 * makeLunarCalendar() による旧暦朔日判定・閏月算出・全アルゴリズム組み合わせを検証する。
 * カバレッジ計測対象外のため #[CoversNothing] を付与し、実動作の正確性のみを確認する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests\Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Release 1.0.0 から利用可能
 * @coversNothing
 */
class LunarCalendarCoversNothingTest extends TestCase
{
    use InvokeTrait;
    /**
     * 朔日として検出されるべき日付を返す
     *
     * @return array<string, array{string}>
     */
    public static function makeLunarCalendarDataProvider(): array
    {
        return [
            '2009/01/26' => ['2009/01/26'],
            '2009/02/25' => ['2009/02/25'],
            '2009/03/27' => ['2009/03/27'],
            '2009/04/25' => ['2009/04/25'],
            '2009/05/24' => ['2009/05/24'],
            '2009/06/23' => ['2009/06/23'],
            '2009/07/22' => ['2009/07/22'],
            '2009/08/20' => ['2009/08/20'],
            '2009/09/19' => ['2009/09/19'],
            '2009/10/18' => ['2009/10/18'],
            '2009/11/17' => ['2009/11/17'],
            '2009/12/16' => ['2009/12/16'],
            '2010/01/15' => ['2010/01/15'],
            '2010/02/14' => ['2010/02/14'],
            '2010/03/16' => ['2010/03/16'],
            '2010/04/14' => ['2010/04/14'],
            '2010/05/14' => ['2010/05/14'],
            '2010/06/12' => ['2010/06/12'],
            '2010/07/12' => ['2010/07/12'],
            '2010/08/10' => ['2010/08/10'],
            '2010/09/08' => ['2010/09/08'],
            '2010/10/08' => ['2010/10/08'],
            '2010/11/06' => ['2010/11/06'],
            '2010/12/06' => ['2010/12/06'],
            '2011/01/04' => ['2011/01/04'],
            '2011/02/03' => ['2011/02/03'],
            '2011/03/05' => ['2011/03/05'],
            '2011/04/03' => ['2011/04/03'],
            '2011/05/03' => ['2011/05/03'],
            '2011/06/02' => ['2011/06/02'],
            '2011/07/01' => ['2011/07/01'],
            '2011/07/31' => ['2011/07/31'],
            '2011/08/29' => ['2011/08/29'],
            '2011/09/27' => ['2011/09/27'],
            '2011/10/27' => ['2011/10/27'],
            '2011/11/25' => ['2011/11/25'],
            '2011/12/25' => ['2011/12/25'],
            '2012/01/23' => ['2012/01/23'],
            '2012/02/22' => ['2012/02/22'],
            '2012/03/22' => ['2012/03/22'],
            '2012/04/21' => ['2012/04/21'],
            '2012/05/21' => ['2012/05/21'],
            '2012/06/20' => ['2012/06/20'],
            '2012/07/19' => ['2012/07/19'],
            '2012/08/18' => ['2012/08/18'],
            '2012/09/16' => ['2012/09/16'],
            '2012/10/15' => ['2012/10/15'],
            '2012/11/14' => ['2012/11/14'],
            '2012/12/13' => ['2012/12/13'],
            '2013/01/12' => ['2013/01/12'],
            '2013/02/10' => ['2013/02/10'],
            '2013/03/12' => ['2013/03/12'],
            '2013/04/10' => ['2013/04/10'],
            '2013/05/10' => ['2013/05/10'],
            '2013/06/09' => ['2013/06/09'],
            '2013/07/08' => ['2013/07/08'],
            '2013/08/07' => ['2013/08/07'],
            '2013/09/05' => ['2013/09/05'],
            '2013/10/05' => ['2013/10/05'],
            '2013/11/03' => ['2013/11/03'],
            '2013/12/03' => ['2013/12/03'],
            '2014/01/01' => ['2014/01/01'],
            '2014/01/31' => ['2014/01/31'],
            '2014/03/01' => ['2014/03/01'],
            '2014/03/31' => ['2014/03/31'],
            '2014/04/29' => ['2014/04/29'],
            '2014/05/29' => ['2014/05/29'],
            '2014/06/27' => ['2014/06/27'],
            '2014/07/27' => ['2014/07/27'],
            '2014/08/25' => ['2014/08/25'],
            '2014/09/24' => ['2014/09/24'],
            '2014/10/24' => ['2014/10/24'],
            '2014/11/22' => ['2014/11/22'],
            '2014/12/22' => ['2014/12/22'],
            '2015/01/20' => ['2015/01/20'],
            '2015/02/19' => ['2015/02/19'],
            '2015/03/20' => ['2015/03/20'],
            '2015/04/19' => ['2015/04/19'],
            '2015/05/18' => ['2015/05/18'],
            '2015/06/16' => ['2015/06/16'],
            '2015/07/16' => ['2015/07/16'],
            '2015/08/14' => ['2015/08/14'],
            '2015/09/13' => ['2015/09/13'],
            '2015/10/13' => ['2015/10/13'],
            '2015/11/12' => ['2015/11/12'],
            '2015/12/11' => ['2015/12/11'],
            '2016/01/10' => ['2016/01/10'],
            '2016/02/08' => ['2016/02/08'],
            '2016/03/09' => ['2016/03/09'],
            '2016/04/07' => ['2016/04/07'],
            '2016/05/07' => ['2016/05/07'],
            '2016/06/05' => ['2016/06/05'],
            '2016/07/04' => ['2016/07/04'],
            '2016/08/03' => ['2016/08/03'],
            '2016/09/01' => ['2016/09/01'],
            '2016/10/01' => ['2016/10/01'],
            '2016/10/31' => ['2016/10/31'],
            '2016/11/29' => ['2016/11/29'],
            '2016/12/29' => ['2016/12/29'],
            '2017/01/28' => ['2017/01/28'],
            '2017/02/26' => ['2017/02/26'],
            '2017/03/28' => ['2017/03/28'],
            '2017/04/26' => ['2017/04/26'],
            '2017/05/26' => ['2017/05/26'],
            '2017/06/24' => ['2017/06/24'],
            '2017/07/23' => ['2017/07/23'],
            '2017/08/22' => ['2017/08/22'],
            '2017/09/20' => ['2017/09/20'],
            '2017/10/20' => ['2017/10/20'],
            '2017/11/18' => ['2017/11/18'],
            '2017/12/18' => ['2017/12/18'],
            '2018/01/17' => ['2018/01/17'],
            '2018/02/16' => ['2018/02/16'],
            '2018/03/17' => ['2018/03/17'],
            '2018/04/16' => ['2018/04/16'],
            '2018/05/15' => ['2018/05/15'],
            '2018/06/14' => ['2018/06/14'],
            '2018/07/13' => ['2018/07/13'],
            '2018/08/11' => ['2018/08/11'],
            '2018/09/10' => ['2018/09/10'],
            '2018/10/09' => ['2018/10/09'],
            '2018/11/08' => ['2018/11/08'],
            '2018/12/07' => ['2018/12/07'],
            '2019/01/06' => ['2019/01/06'],
            '2019/02/05' => ['2019/02/05'],
            '2019/03/07' => ['2019/03/07'],
            '2019/04/05' => ['2019/04/05'],
            '2019/05/05' => ['2019/05/05'],
            '2019/06/03' => ['2019/06/03'],
            '2019/07/03' => ['2019/07/03'],
            '2019/08/01' => ['2019/08/01'],
            '2019/08/30' => ['2019/08/30'],
            '2019/09/29' => ['2019/09/29'],
            '2019/10/28' => ['2019/10/28'],
            '2019/11/27' => ['2019/11/27'],
            '2019/12/26' => ['2019/12/26'],
            '2020/01/25' => ['2020/01/25'],
            '2020/02/24' => ['2020/02/24'],
            '2020/03/24' => ['2020/03/24'],
            '2020/04/23' => ['2020/04/23'],
            '2020/05/23' => ['2020/05/23'],
            '2020/06/21' => ['2020/06/21'],
            '2020/07/21' => ['2020/07/21'],
            '2020/08/19' => ['2020/08/19'],
            '2020/09/17' => ['2020/09/17'],
            '2020/10/17' => ['2020/10/17'],
            '2020/11/15' => ['2020/11/15'],
            '2020/12/15' => ['2020/12/15'],
            '2021/01/13' => ['2021/01/13'],
            '2021/02/12' => ['2021/02/12'],
            '2021/03/13' => ['2021/03/13'],
            '2021/04/12' => ['2021/04/12'],
            '2021/05/12' => ['2021/05/12'],
            '2021/06/10' => ['2021/06/10'],
            '2021/07/10' => ['2021/07/10'],
            '2021/08/08' => ['2021/08/08'],
            '2021/09/07' => ['2021/09/07'],
            '2021/10/06' => ['2021/10/06'],
            '2021/11/05' => ['2021/11/05'],
            '2021/12/04' => ['2021/12/04'],
            '2022/01/03' => ['2022/01/03'],
            '2022/02/01' => ['2022/02/01'],
            '2022/03/03' => ['2022/03/03'],
            '2022/04/01' => ['2022/04/01'],
            '2022/05/01' => ['2022/05/01'],
            '2022/05/30' => ['2022/05/30'],
            '2022/06/29' => ['2022/06/29'],
            '2022/07/29' => ['2022/07/29'],
            '2022/08/27' => ['2022/08/27'],
            '2022/09/26' => ['2022/09/26'],
            '2022/10/25' => ['2022/10/25'],
            '2022/11/24' => ['2022/11/24'],
            '2022/12/23' => ['2022/12/23'],
            '2023/01/22' => ['2023/01/22'],
            '2023/02/20' => ['2023/02/20'],
            '2023/03/22' => ['2023/03/22'],
            '2023/04/20' => ['2023/04/20'],
            '2023/05/20' => ['2023/05/20'],
            '2023/06/18' => ['2023/06/18'],
            '2023/07/18' => ['2023/07/18'],
            '2023/08/16' => ['2023/08/16'],
            '2023/09/15' => ['2023/09/15'],
            '2023/10/15' => ['2023/10/15'],
            '2023/11/13' => ['2023/11/13'],
            '2023/12/13' => ['2023/12/13'],
            '2024/01/11' => ['2024/01/11'],
            '2024/02/10' => ['2024/02/10'],
            '2024/03/10' => ['2024/03/10'],
            '2024/04/09' => ['2024/04/09'],
            '2024/05/08' => ['2024/05/08'],
            '2024/06/06' => ['2024/06/06'],
            '2024/07/06' => ['2024/07/06'],
            '2024/08/04' => ['2024/08/04'],
            '2024/09/03' => ['2024/09/03'],
            '2024/10/03' => ['2024/10/03'],
            '2024/11/01' => ['2024/11/01'],
            '2024/12/01' => ['2024/12/01'],
            '2024/12/31' => ['2024/12/31'],
            // 月黄経負値バグ修正後: 2034-03-20 が朔日として認識されること
            '2034/03/20' => ['2034/03/20'],
            // 2033年問題の修正確認: 旧暦11月（正規）と閏11月の朔日が正しく検出される
            '2033/11/22' => ['2033/11/22'],
            '2033/12/22' => ['2033/12/22'],
            // >= 1900 キャリブレーション: makeLunarCalendar(2001) のループ内で
            // 2000-12-25 が age1=28.78 > 20, age2=0.026 < 0.17 を満たしキャリブレーションが発動する
            '2001/01/24' => ['2001/01/24'],
            // < 1900 キャリブレーション: makeLunarCalendar(1899) のループ内で
            // 1899-05-09 が age1=28.48 > 20, age2=0.015 < 0.1 を満たしキャリブレーションが発動する
            '1899/05/10' => ['1899/05/10'],
        ];
    }
    /**
     * makeLunarCalendar が各年の朔日を旧暦カレンダーに含めることを確認する
     *
     * @param string $date
     * @return void
     * @throws \JsonException
     * @throws \ReflectionException
     * @dataProvider makeLunarCalendarDataProvider
     */
    public function test_makeLunarCalendar(string $date): void
    {
        DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
        DateTime::useBoundarySolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
        DateTime::useBoundaryMoonAlgorithm(DateTime::MOON_ALGORITHM_MEEUS47);
        $LunarCalendar = LunarCalendar::factory();
        [$year] = explode('/', $date, 2);
        $year = (int) $year;
        $calendar_array = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [$year]);
        $dates = array_map(
            static fn (array $item): string => sprintf('%04d/%02d/%02d', $item['year'], $item['month'], $item['day']),
            $calendar_array
        );
        $this->assertContains($date, $dates, json_encode($calendar_array, JSON_THROW_ON_ERROR));
    }
    /**
     * 2033年の各朔日に対して旧暦月番号と閏月フラグを検証するデータプロバイダ
     *
     * @return array<string, array{string, int, bool}>
     */
    public static function makeLunarCalendar2033LeapMonthProvider(): array
    {
        return [
            '2033年正規11月の朔' => ['2033/11/22', 11, false],
            '2033年閏11月の朔'   => ['2033/12/22', 11, true],
        ];
    }
    /**
     * 2033年の旧暦月番号と閏月フラグが正しく算出されることを確認する。
     *
     * @param string $date       グレゴリオ暦の朔日（YYYY/MM/DD 形式）
     * @param int    $expectedLunarMonth 期待する旧暦月番号
     * @param bool   $expectedIsLeap    期待する閏月フラグ
     * @return void
     * @throws \ReflectionException
     * @dataProvider makeLunarCalendar2033LeapMonthProvider
     */
    public function test_makeLunarCalendar_2033_leapMonth(string $date, int $expectedLunarMonth, bool $expectedIsLeap): void
    {
        DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
        DateTime::useBoundarySolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
        DateTime::useBoundaryMoonAlgorithm(DateTime::MOON_ALGORITHM_MEEUS47);
        $LunarCalendar = LunarCalendar::factory();
        [$year] = explode('/', $date, 2);
        $calendar_array = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [(int) $year]);
        [$y, $m, $d] = array_map('intval', explode('/', $date));
        $entry = current(array_filter(
            $calendar_array,
            fn ($item) => $item['year'] === $y && $item['month'] === $m && $item['day'] === $d
        ));
        $this->assertNotFalse($entry, "{$date} が朔日テーブルに存在しない");
        $this->assertSame($expectedLunarMonth, (int) $entry['lunar_month']);
        $this->assertSame($expectedIsLeap, $entry['lunar_month_leap']);
    }
    /**
     * 2033年の旧暦カレンダーに閏月がちょうど1つ存在し、それが閏11月であることを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_makeLunarCalendar_2033_exactlyOneLeapMonth(): void
    {
        DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
        DateTime::useBoundarySolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
        DateTime::useBoundaryMoonAlgorithm(DateTime::MOON_ALGORITHM_MEEUS47);

        $LunarCalendar = LunarCalendar::factory();
        $calendar_array = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [2033]);

        $leapMonths = array_values(array_filter(
            $calendar_array,
            fn ($item) => $item['lunar_month_leap'] === true
        ));

        $this->assertCount(1, $leapMonths, '2033年の閏月がちょうど1つでない');
        $this->assertSame(11, (int) $leapMonths[0]['lunar_month'], '2033年の閏月が11月でない');
    }
    /**
     * VSOP87 ソーラー + Legacy ムーンで2020年の主要な朔日が正しく検出されることを確認する。
     *
     * これにより中気ループ・朔ループのスキップ処理が VSOP87 ソーラーアルゴリズムでも
     * 正しく機能することを検証する。
     *
     * @return void
     * @throws \ReflectionException
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_makeLunarCalendar_vsop87_solar_legacy_moon_saku_dates(): void
    {
        DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
        DateTime::useBoundarySolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
        DateTime::useBoundaryMoonAlgorithm(DateTime::MOON_ALGORITHM_MEEUS47);
        $LunarCalendar = LunarCalendar::factory();
        $calendar_array = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [2020]);
        $dates = array_map(
            static fn (array $item): string => sprintf('%04d/%02d/%02d', $item['year'], $item['month'], $item['day']),
            $calendar_array
        );
        // 2020年の国立天文台データで確認された朔日 (VSOP87 でも Legacy でも一致する)
        foreach (['2020/01/25', '2020/06/21', '2020/12/15'] as $expectedDate) {
            $this->assertContains($expectedDate, $dates, "VSOP87 solar + Legacy moon で {$expectedDate} が検出されませんでした");
        }
    }
    /**
     * 2022年正月の旧暦日を全太陽・月アルゴリズムで検証するデータを返す。
     *
     * @return array<string, array{string, string, string, int, int, int}>
     */
    public static function lunarDate2022NewYearAlgorithmProvider(): array
    {
        $data = [];
        $solarAlgorithms = [
            Astronomy::SOLAR_LEGACY,
            Astronomy::SOLAR_VSOP87,
        ];
        $moonAlgorithms = [
            Astronomy::MOON_LEGACY,
            Astronomy::MOON_ELP2000,
            Astronomy::MOON_MEEUS47,
            Astronomy::MOON_MEEUS47_NO_C,
        ];
        $expectedDates = [
            '2022-01-01 00:00:00' => [2021, 11, 29],
            '2022-01-02 00:00:00' => [2021, 11, 30],
        ];

        foreach ($solarAlgorithms as $solarAlgorithm) {
            foreach ($moonAlgorithms as $moonAlgorithm) {
                foreach ($expectedDates as $date => [$year, $month, $day]) {
                    $data["{$solarAlgorithm}/{$moonAlgorithm}: {$date}"] = [
                        $solarAlgorithm,
                        $moonAlgorithm,
                        $date,
                        $year,
                        $month,
                        $day,
                    ];
                }
            }
        }

        return $data;
    }
    /**
     * 全太陽・月アルゴリズムで2022年正月の旧暦日が霜月29日・30日になることを確認する。
     *
     * @param string $solarAlgorithm 太陽アルゴリズム
     * @param string $moonAlgorithm 月アルゴリズム
     * @param string $date グレゴリオ暦日時
     * @param int $year 期待する旧暦年
     * @param int $month 期待する旧暦月
     * @param int $day 期待する旧暦日
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \JsonException
     * @dataProvider lunarDate2022NewYearAlgorithmProvider
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_lunarDate_2022_new_year_all_algorithm_combinations(string $solarAlgorithm, string $moonAlgorithm, string $date, int $year, int $month, int $day): void
    {
        try {
            Astronomy::useSolarAlgorithm($solarAlgorithm);
            Astronomy::useMoonAlgorithm($moonAlgorithm);
            $lunarCalendar = new LunarCalendar(Astronomy::factory());
            $actual = $lunarCalendar->getLunarDate(DateTime::factory($date));

            $this->assertSame($year, $actual->year);
            $this->assertSame($month, $actual->month);
            $this->assertSame($day, $actual->day);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
}
