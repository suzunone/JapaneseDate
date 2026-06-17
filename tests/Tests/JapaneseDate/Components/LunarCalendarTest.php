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

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Config;
use JapaneseDate\Components\Contracts\MoonAgeAlgorithm;
use JapaneseDate\Components\ELP2000;
use JapaneseDate\Components\LegacyMoonAge;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Components\MeeusMoon;
use JapaneseDate\Components\MeeusMoonAge;
use JapaneseDate\Components\Vsop87Astronomy;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\LunarDate;
use JapaneseDate\Exceptions\ErrorException;
use Mockery;
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
     * Mockery のモック定義をテストごとに閉じ、次のテストへ期待値を持ち越さないようにする。
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * 中気境界まで安全にスキップできる日数を返す。
     *
     * @return array<string, array{float, int}>
     */
    public static function chukiSkipDaysDataProvider(): array
    {
        // MAX_SUN_DAILY_MOTION=1.10, floor 方式: floor(remaining/1.10)-1
        return [
            '境界直後'       => [0.0, 26],   // floor(30.0/1.10)-1 = 27-1 = 26
            '境界まで13度'   => [227.0, 10], // floor(13.0/1.10)-1 = 11-1 = 10
            '境界まで2度'    => [238.0, 0],  // floor(2.0/1.10)-1  = 1-1  = 0
            '境界まで1度'    => [239.0, 0],  // floor(1.0/1.10)-1  = max(0,-1) = 0
            '360度境界直前'  => [359.0, 0],  // floor(1.0/1.10)-1  = 0
        ];
    }

    /**
     * 中気境界を飛び越えず、境界直前までの最大日数を返すことを確認する。
     *
     * @param float $longitudeSun
     * @param int $expected
     * @return void
     * @throws \ReflectionException
     */
    #[DataProvider('chukiSkipDaysDataProvider')]
    public function test_calcChukiSkipDays(float $longitudeSun, int $expected): void
    {
        $lunarCalendar = new LunarCalendar();

        $this->assertSame(
            $expected,
            $this->invokeExecuteMethod($lunarCalendar, 'calcChukiSkipDays', [$longitudeSun])
        );
    }

    /**
     * getLunarCalendarArray が年境界を含む旧暦年月日を返すことを確認するケースを返す。
     *
     * @return array<string, array{int, int, int, array{int, bool, float, float}}>
     */
    public static function lunarCalendarArrayDataProvider(): array
    {
        return [
            '2016年旧正月' => [2016, 2, 8, [2016, false, 1.0, 1.0]],
            '2018年旧暦年末29日' => [2018, 2, 14, [2017, false, 12.0, 29.0]],
            '2018年旧暦年末30日' => [2018, 2, 15, [2017, false, 12.0, 30.0]],
            '2018年旧正月' => [2018, 2, 16, [2018, false, 1.0, 1.0]],
        ];
    }

    /**
     * 月齢計算の検証用データを返す。
     *
     * @return array<string, array{int, int, int, int, int, int, int}>
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
     * moonPhaseAngle が新月・満月それぞれの位相角範囲を返すことを確認するケースを返す。
     *
     * @return array<string, array{int, int, int, float, float, float, string}>
     */
    public static function moonPhaseAngleDataProvider(): array
    {
        return [
            '新月' => [2023, 1, 21, 20.0, 53.0, 0.0, 'new'],
            '満月' => [2023, 2, 5, 18.0, 29.0, 0.0, 'full'],
        ];
    }

    /**
     * moonPhase が主要な月相点で期待する月相番号を返すことを確認するケースを返す。
     *
     * @return array<string, array{int, int, int, float, float, float, int, string}>
     */
    public static function principalMoonPhaseDataProvider(): array
    {
        return [
            '新月' => [2023, 1, 22, 5.0, 53.0, 0.0, 0, '新月時刻の月相が 0 (新月) でありません'],
            '満月' => [2023, 2, 6, 3.0, 29.0, 0.0, 4, '満月時刻の月相が 4 (満月) でありません'],
        ];
    }

    /**
     * Meeus47 実装で NASA C 補正の有無にかかわらず MeeusMoonAge が選択されることを確認するケースを返す。
     *
     * @return array<string, array{bool}>
     */
    public static function meeusMoonAgeFactoryDataProvider(): array
    {
        return [
            'NASA C 補正あり' => [true],
            'NASA C 補正なし' => [false],
        ];
    }

    /**
     * Meeus47 実装で主要な月相点が期待する月相番号になることを確認するケースを返す。
     *
     * @return array<string, array{int, int, int, float, float, float, int, string}>
     */
    public static function meeusMoonPhaseDataProvider(): array
    {
        return [
            '新月' => [2023, 1, 22, 14.0, 53.0, 0.0, 0, 'meeus47 新月時刻の月相が 0 でありません'],
            '満月' => [2023, 2, 6, 12.0, 29.0, 0.0, 4, 'meeus47 満月時刻の月相が 4 でありません'],
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
     * 月計算アルゴリズムに ELP2000 が選択されている場合、factory が Elp2000MoonAge を使用することを確認する
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_factory_usesElp2000MoonAgeWhenElp2000AlgorithmSelected(): void
    {
        Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);

        $LunarCalendar = LunarCalendar::factory();
        $astronomy = $this->invokeExecuteMethod($LunarCalendar, 'astronomy', []);

        $this->assertSame(Astronomy::MOON_ELP2000, $astronomy->moonAlgorithmName());
    }

    /**
     * 指定日の旧暦配列が年境界を含めて正しく取得できることを確認する
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    #[DataProvider('lunarCalendarArrayDataProvider')]
    public function test_getLunarCalendarArray(int $year, int $month, int $day, array $expected): void
    {
        $LunarCalendar = LunarCalendar::factory();

        $res = $this->invokeExecuteMethod(
            $LunarCalendar,
            'getLunarCalendarArray',
            [$year, $month, $day]
        );

        $this->assertSame($expected, $res);
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
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[DataProvider('moonAgeDataProvider')]
    public function test_moonAge($year, $month, $day, $hour, $minute, $second, $moon_age): void
    {
        $LunarCalendar = LunarCalendar::factory();

        $this->assertEquals($moon_age, round($LunarCalendar->moonAge($year, $month, $day, $hour, $minute, $second)));
    }

    /**
     * moonAge() が注入された MoonAgeAlgorithm（Strategy）に委譲することを確認する
     *
     * LunarCalendar 自身はアルゴリズム名を見て実装を選択せず、
     * コンストラクタで注入された Strategy にそのまま委譲することを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_delegatesToInjectedMoonAgeAlgorithm(): void
    {
        $stub = new class () implements MoonAgeAlgorithm {
            public ?array $receivedArgs = null;

            /**
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->receivedArgs = [$year, $month, $day, $hour, $min, $sec];

                return 12.5;
            }
        };

        $LunarCalendar = new LunarCalendar(null, $stub);

        $result = $LunarCalendar->moonAge(2024, 1, 2, 3.0, 4.0, 5.0);

        $this->assertSame(12.5, $result);
        $this->assertSame([2024, 1, 2, 3.0, 4.0, 5.0], $stub->receivedArgs);
    }

    /**
     * moonAge() は同一引数に対してアルゴリズムを1回のみ呼び出し、結果をメモ化することを確認する
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_memoization_sameArgsCallAlgorithmOnce(): void
    {
        $spy = new class () implements MoonAgeAlgorithm {
            public int $callCount = 0;

            /**
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->callCount++;

                return 7.25;
            }
        };

        $lc = new LunarCalendar(null, $spy);

        $result1 = $lc->moonAge(2024, 1, 2, 0.0, 0.0, 0.0);
        $result2 = $lc->moonAge(2024, 1, 2, 0.0, 0.0, 0.0);

        $this->assertSame(7.25, $result1);
        $this->assertSame(7.25, $result2);
        $this->assertSame(1, $spy->callCount);
    }

    /**
     * moonAge() は引数が異なる場合はそれぞれ別々にキャッシュすることを確認する
     *
     * 0:00:00 と 23:59:59 は別エントリとして扱われ、それぞれ1回ずつ算出される。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_memoization_differentArgsCachedSeparately(): void
    {
        $spy = new class () implements MoonAgeAlgorithm {
            public int $callCount = 0;

            /**
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->callCount++;

                return $hour < 1.0 ? 28.5 : 0.4;
            }
        };

        $lc = new LunarCalendar(null, $spy);

        $age1      = $lc->moonAge(2024, 1, 2, 0.0, 0.0, 0.0);
        $age2      = $lc->moonAge(2024, 1, 2, 23.0, 59.0, 59.0);
        $age1Again = $lc->moonAge(2024, 1, 2, 0.0, 0.0, 0.0);

        $this->assertSame(28.5, $age1);
        $this->assertSame(0.4, $age2);
        $this->assertSame(28.5, $age1Again);
        $this->assertSame(2, $spy->callCount);
    }

    /**
     * moonAge() のキャッシュを InvokeTrait 経由でリセットするとアルゴリズムが再計算されることを確認する
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \ReflectionException
     */
    public function test_moonAge_memoization_cacheCanBeReset(): void
    {
        $spy = new class () implements MoonAgeAlgorithm {
            public int $callCount = 0;

            /**
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->callCount++;

                return 14.0;
            }
        };

        $lc = new LunarCalendar(null, $spy);

        $lc->moonAge(2024, 1, 2, 0.0, 0.0, 0.0);
        $this->assertSame(1, $spy->callCount);

        $this->invokeSetProperty($lc, 'one_time_cache', []);

        $lc->moonAge(2024, 1, 2, 0.0, 0.0, 0.0);
        $this->assertSame(2, $spy->callCount);
    }

    /**
     * 隣接年の makeLunarCalendar 連続生成でメモ化によるアルゴリズム呼び出し削減を実測する
     *
     * year N (2019-11-10〜2021-03) と year N+1 (2020-11-10〜2022-03) の計算範囲は
     * 約4.5か月（〜5新月）重複する。
     * メモ化により year N+1 の重複期間分が year N 計算時のキャッシュヒットになり、
     * year N+1 での実計算回数が year N での実計算回数より少なくなることを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonAge_memoization_reducesCallsForAdjacentYears(): void
    {
        $astronomy  = new Astronomy();
        $legacyAlgo = new LegacyMoonAge($astronomy);

        $spy = new class ($legacyAlgo) implements MoonAgeAlgorithm {
            public int $callCount = 0;

            private MoonAgeAlgorithm $real;

            /**
             * @param \JapaneseDate\Components\Contracts\MoonAgeAlgorithm $real
             */
            public function __construct(MoonAgeAlgorithm $real)
            {
                $this->real = $real;
            }

            /**
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->callCount++;

                return $this->real->moonAge($year, $month, $day, $hour, $min, $sec);
            }
        };

        $lc = new LunarCalendar($astronomy, $spy);

        // year 2020: 2019-11-10〜2021-03 を処理
        $this->invokeExecuteMethod($lc, 'makeLunarCalendar', [2020]);
        $countYear2020 = $spy->callCount;

        // year 2021: 2020-11-10〜2022-03 を処理
        // 2020-11-10〜2021-03 の重複期間は year2020 時のキャッシュヒット
        $spy->callCount = 0;
        $this->invokeExecuteMethod($lc, 'makeLunarCalendar', [2021]);
        $countYear2021 = $spy->callCount;

        $this->assertGreaterThan(0, $countYear2020, 'year2020 の実計算回数がゼロ');
        $this->assertLessThan(
            $countYear2020,
            $countYear2021,
            "隣接年メモ化: year2021({$countYear2021}回) は year2020({$countYear2020}回) より少ないはず"
        );
    }


    /**
     * 1900年未満の朔日補正分岐で翌日再計算されることを確認する。
     *
     * @return void
     * @throws \JsonException
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_makeLunarCalendar_Pre1900SakuByNextDay(): void
    {
        DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
        DateTime::useBoundarySolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
        DateTime::useBoundaryMoonAlgorithm(DateTime::MOON_ALGORITHM_MEEUS47);

        $LunarCalendar = LunarCalendar::factory();
        $calendar_array = $this->invokeExecuteMethod($LunarCalendar, 'makeLunarCalendar', [1899]);
        $dates = array_map(
            static fn (array $item): string => sprintf('%04d/%02d/%02d', $item['year'], $item['month'], $item['day']),
            $calendar_array
        );

        $this->assertContains('1899/05/10', $dates, json_encode($calendar_array, JSON_THROW_ON_ERROR));
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
     * 月計算アルゴリズムが ELP2000 の場合、makeLunarCalendar が ELP2000::longitudeMoon() を呼ぶことを確認する
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_makeLunarCalendar_usesElp2000MoonPhaseWhenElp2000AlgorithmSelected(): void
    {
        $elp2000Spy = Mockery::mock(ELP2000::class, [30])->makePartial();
        $meeusMoon = new MeeusMoon();
        // ELP2000 自体の精度は専用テストに任せ、ここでは委譲経路だけを検証する。
        $elp2000Spy
            ->shouldReceive('longitudeMoon')
            ->atLeast()
            ->once()
            ->andReturnUsing(
                static fn (int $year, int $month, int $day, float $hour, float $min, float $sec): float =>
                    $meeusMoon->longitudeMoon($year, $month, $day, $hour, $min, $sec)
            );
        $astronomy = new Astronomy(moonAlgorithm: $elp2000Spy);
        $lunarCalendar = new LunarCalendar($astronomy);

        $this->assertSame(Astronomy::MOON_ELP2000, $astronomy->moonAlgorithmName());

        $calendar_array = $this->invokeExecuteMethod($lunarCalendar, 'makeLunarCalendar', [2023]);

        $this->assertCount(15, $calendar_array);
        $this->assertSame(2022, $calendar_array[0]['year']);
        $this->assertSame(11, $calendar_array[0]['month']);
        $this->assertSame(24, $calendar_array[0]['day']);
        $this->assertSame(2023, $calendar_array[2]['year']);
        $this->assertSame(1, $calendar_array[2]['month']);
        $this->assertSame(22, $calendar_array[2]['day']);
    }

    /**
     * getLunarDate が LunarDate インスタンスを返すことを確認する
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
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
        $this->assertEquals(2023, $result->year);
        $this->assertEquals(1, $result->month);
        $this->assertEquals(1, $result->day);
    }

    /**
     * 朔区間が見つからない場合に空配列を LunarDate へ渡さず例外を投げることを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_getLunarCalendarArray_throwsWhenNoLunarRangeMatches(): void
    {
        $lunarCalendar = new LunarCalendar();
        $this->invokeSetProperty($lunarCalendar, 'lunar_calendar', [2024 => []]);

        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('旧暦日を算出できる朔区間が見つかりませんでした: 2024-01-01');

        $this->invokeExecuteMethod($lunarCalendar, 'getLunarCalendarArray', [2024, 1, 1]);
    }

    /**
     * VSOP87 が注入されている場合、その計算結果を直接返すことを確認する
     *
     * @return void
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTerm_usesInjectedVsop87Astronomy(): void
    {
        $lunarCalendar = new LunarCalendar(new Astronomy(new Vsop87Astronomy()));

        $this->assertSame(0, $lunarCalendar->findSolarTerm(2023, 3, 21));
    }

    /**
     * legacy の6時境界補正により、冬至当日を検出できることを確認する。
     *
     * 1819-12-23 は0時境界では VSOP87 との比較により棄却対象だったが、
     * legacy 用の6時境界では当日内の節気として扱う。
     *
     * @return void
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTerm_detectsLegacySolarTermWithSixHourBoundary(): void
    {
        $lunarCalendar = new LunarCalendar(new Astronomy());

        $this->assertSame(DateTime::SOLAR_TERM_TOUJI, $lunarCalendar->findSolarTerm(1819, 12, 23));
    }

    /**
     * legacy アルゴリズムが境界アルゴリズム（VSOP87）より1日遅れて節気を検出する場合、
     * 前日の境界チェックにより当日の結果を false で棄却することを確認する。
     *
     * 2023-06-22 夏至: VSOP87 は 06-21 に検出済み → 06-22 は境界 false
     * → legacy は 06-22 を検出 → 前日 06-21 の境界も同じ節気 → 1日遅れと判定して false を返す
     *
     * @return void
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTerm_legacyLagsOneDayBehindBoundary_returnsFalse(): void
    {
        $lunarCalendar = new LunarCalendar(new Astronomy());

        $this->assertFalse($lunarCalendar->findSolarTerm(2023, 6, 22));
    }

    /**
     * 2034年の朔日補正が旧暦日に反映されることを確認する
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_lunarDate_2034(): void
    {
        // 2034-03-20 19:15 JST が朔 → 旧暦 2/1 であること
        $DateTime = DateTime::factory('2034-03-20');
        $this->assertEquals(2034, $DateTime->lunar_year);
        $this->assertEquals(2, $DateTime->lunar_month);
        $this->assertEquals(1, $DateTime->lunar_day);

        $DateTime2 = DateTime::factory('2034-03-21');
        $this->assertEquals(2, $DateTime2->lunar_day);
    }

    /**
     * 2033年問題で冬至月を11月に固定し、閏11月だけが発生することを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_makeLunarCalendar_2033_leapMonthAnchoredByWinterSolstice(): void
    {
        $lunarCalendar = LunarCalendar::factory();
        $calendar = $this->invokeExecuteMethod($lunarCalendar, 'makeLunarCalendar', [2033]);

        $months = [];
        foreach ($calendar as $month) {
            $months[sprintf('%04d-%02d-%02d', $month['year'], $month['month'], $month['day'])] = $month;
        }

        $this->assertEquals(8, $months['2033-08-25']['lunar_month']);
        $this->assertFalse($months['2033-08-25']['lunar_month_leap']);

        $this->assertEquals(11, $months['2033-11-22']['lunar_month']);
        $this->assertFalse($months['2033-11-22']['lunar_month_leap']);

        $this->assertEquals(11, $months['2033-12-22']['lunar_month']);
        $this->assertTrue($months['2033-12-22']['lunar_month_leap']);
    }

    // ==================== moonPhaseAngle ====================

    /**
     * moonPhaseAngle は [0, 360) の浮動小数点数を返す
     *
     * 検証出典: 国立天文台 朔望データ
     *   2023-01-22 05:53 JST (= 2023-01-21 20:53 UTC) が新月 → 位相角 ≒ 0°
     *   2023-02-05 18:29 UTC が満月 → 位相角 ≒ 180°
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('moonPhaseAngleDataProvider')]
    public function test_moonPhaseAngle(
        int $year,
        int $month,
        int $day,
        float $hour,
        float $minute,
        float $second,
        string $phase
    ): void
    {
        $lc = LunarCalendar::factory();

        $result = $lc->moonPhaseAngle($year, $month, $day, $hour, $minute, $second);
        $this->assertIsFloat($result);
        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);

        match ($phase) {
            'new' => $this->assertTrue(
                $result < 22.5 || $result >= 337.5,
                "新月付近の位相角({$result}°)が新月区間外です"
            ),
            'full' => $this->assertTrue(
                $result > 135.0 && $result < 225.0,
                "満月付近の位相角({$result}°)が満月区間外です"
            ),
        };
    }

    // ==================== moonPhase ====================

    /**
     * moonPhase は主要な月相点で 0〜7 の整数を返す
     *
     * 検証出典: 国立天文台 朔望データ
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('principalMoonPhaseDataProvider')]
    public function test_moonPhase_principalPhase(
        int $year,
        int $month,
        int $day,
        float $hour,
        float $minute,
        float $second,
        int $expected,
        string $message
    ): void
    {
        $lc = LunarCalendar::factory();

        $result = $lc->moonPhase($year, $month, $day, $hour, $minute, $second);
        $this->assertIsInt($result);
        $this->assertSame($expected, $result, $message);
    }

    /**
     * 直近の月相点が「次の」月相点である場合に、その月相が採用されることを確認する
     *
     * 検証出典: 国立天文台 朔望データ（2023-01-22 05:53 UTC が新月）
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_nearestPhaseIsNext(): void
    {
        $lc = LunarCalendar::factory();

        // 新月時刻(05:53 UTC)よりわずかに前の時刻 → 次の朔の方が前の朔より近い
        $result = $lc->moonPhase(2023, 1, 22, 0.0, 0.0, 0.0);
        $this->assertIsInt($result);
        $this->assertSame(0, $result, '直近の月相点が次の朔である場合に 0 (新月) でありません');
    }

    /**
     * 主要な月相点から十分離れた日時では moonPhase が null を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_returnsNullOutsidePrincipalPhase(): void
    {
        $lc = LunarCalendar::factory();

        $this->assertNull($lc->moonPhase(2015, 1, 26, 0.0, 0.0, 0.0));
    }

    // ==================== meeus47 統合テスト ====================

    /**
     * Meeus47 の NASA C 補正有無にかかわらず、月齢計算 Strategy として MeeusMoonAge が生成されることを確認する。
     *
     * @param bool $applyNasaCCorrection
     * @return void
     * @throws \ReflectionException
     */
    #[DataProvider('meeusMoonAgeFactoryDataProvider')]
    public function test_factory_meeus47_creates_MeeusMoonAge_as_default(bool $applyNasaCCorrection): void
    {
        $ast = new Astronomy(null, new MeeusMoon(applyNasaCCorrection: $applyNasaCCorrection));
        $lc = new LunarCalendar($ast);

        $moonAge = $this->invokeGetProperty($lc, 'moonAgeAlgorithm');
        $this->assertInstanceOf(MeeusMoonAge::class, $moonAge);
    }

    /**
     * Meeus47 実装を注入した makeLunarCalendar が旧暦テーブルを生成し、月黄経計算へ委譲することを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_makeLunarCalendar_with_meeus47_returns_array(): void
    {
        $meeusMoonSpy = Mockery::mock(MeeusMoon::class, [true])->makePartial();
        $astronomy = new Astronomy(moonAlgorithm: $meeusMoonSpy);
        $lunarCalendar = new LunarCalendar($astronomy);

        $this->assertSame(Astronomy::MOON_MEEUS47, $astronomy->moonAlgorithmName());

        $calendar_array = $this->invokeExecuteMethod($lunarCalendar, 'makeLunarCalendar', [2023]);

        $this->assertCount(15, $calendar_array);
        $this->assertSame(2022, $calendar_array[0]['year']);
        $this->assertSame(11, $calendar_array[0]['month']);
        $this->assertSame(24, $calendar_array[0]['day']);
        $this->assertSame(2023, $calendar_array[2]['year']);
        $this->assertSame(1, $calendar_array[2]['month']);
        $this->assertSame(22, $calendar_array[2]['day']);
        $meeusMoonSpy->shouldHaveReceived('longitudeMoon')->atLeast()->once();
    }

    /**
     * 太陽黄経キャリブレーションが月アルゴリズムのグローバル設定を書き換えないことを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_solar_term_calibration_does_not_mutate_moon_algorithm(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47);
            $lc = LunarCalendar::factory();
            $this->invokeExecuteMethod($lc, 'makeLunarCalendar', [2024]);

            // 太陽黄経キャリブレーションが月アルゴリズムを書き換えていないことを確認
            $this->assertSame(Astronomy::MOON_MEEUS47, Astronomy::moonAlgorithm());
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }

    /**
     * Meeus47 実装で主要な月相点が期待する月相番号として判定されることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('meeusMoonPhaseDataProvider')]
    public function test_moonPhase_with_meeus47_returns_principal_phase(
        int $year,
        int $month,
        int $day,
        float $hour,
        float $minute,
        float $second,
        int $expected,
        string $message
    ): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon(applyNasaCCorrection: true));
        $lc = new LunarCalendar($ast);

        $result = $lc->moonPhase($year, $month, $day, $hour, $minute, $second);
        $this->assertSame($expected, $result, $message);
    }

    // ==================== 出力等価性スモークテスト ====================

    /**
     * 全アルゴリズム組み合わせ × 代表年で makeLunarCalendar が正常な朔テーブルを返すことを確認する。
     *
     * 高速化リファクタ（スキップ処理導入）後も、各アルゴリズムで旧暦テーブルの
     * 構造（エントリ数・必須キー・旧暦月フラグ）が壊れていないことを検証する。
     *
     * @return void
     * @throws \ReflectionException
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_makeLunarCalendar_all_algorithm_combinations_smoke(): void
    {
        $combinations = [
            'vsop87_legacy'     => new LunarCalendar(new Astronomy(new Vsop87Astronomy())),
            'vsop87_meeus47_nc' => new LunarCalendar(new Astronomy(new Vsop87Astronomy(), new MeeusMoon(applyNasaCCorrection: false))),
        ];

        // 代表年: 境界年・現代年・遠未来年
        $years = [1900, 1950, 2000, 2023, 2050, 2100];

        foreach ($combinations as $desc => $lc) {
            foreach ($years as $year) {
                $calendar = $this->invokeExecuteMethod($lc, 'makeLunarCalendar', [$year]);

                $label = "{$desc}, year={$year}";
                $this->assertIsArray($calendar, $label);
                $this->assertGreaterThanOrEqual(13, count($calendar), $label);
                $this->assertArrayHasKey('year', $calendar[0], $label);
                $this->assertArrayHasKey('month', $calendar[0], $label);
                $this->assertArrayHasKey('day', $calendar[0], $label);
                $this->assertArrayHasKey('jd', $calendar[0], $label);
                $this->assertArrayHasKey('lunar_month', $calendar[0], $label);
                $this->assertArrayHasKey('lunar_year', $calendar[0], $label);
                $this->assertArrayHasKey('lunar_month_leap', $calendar[0], $label);
                $this->assertIsBool($calendar[0]['lunar_month_leap'], $label);
            }
        }
    }

}
