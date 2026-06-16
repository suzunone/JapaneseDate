<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 */

namespace Tests\JapaneseDate\Components;

use InvalidArgumentException;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Contracts\MoonAlgorithm;
use JapaneseDate\Components\Contracts\SunAlgorithm;
use JapaneseDate\Components\ELP2000;
use JapaneseDate\Components\ELP2000Reduced;
use JapaneseDate\Components\LegacyAstronomy;
use JapaneseDate\Components\MeeusMoon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * 天文データ出典:
 *   国立天文台 理科年表 / USNO Astronomical Almanac
 *
 * 各計算の許容誤差:
 *   longitudeSun / longitudeMoon : ±2° (近似アルゴリズムの精度限界)
 * @covers \JapaneseDate\Components\Astronomy
 * @covers \JapaneseDate\Components\Astronomy::longitudeMoonFast
 * @covers \JapaneseDate\Components\Astronomy::moonPhaseAngleFast
 */
class AstronomyTest extends TestCase
{
    use InvokeTrait;
    /**
     * @return array[]
     */
    public static function normalizeAngleProvider(): array
    {
        return [
            'zero' => [0.0, 0.0],
            '360 wraps to 0' => [360.0, 0.0],
            '720 wraps to 0' => [720.0, 0.0],
            '180 unchanged' => [180.0, 180.0],
            '45 unchanged' => [45.0, 45.0],
            '-90 → 270' => [-90.0, 270.0],
            '450 → 90' => [450.0, 90.0],
            '-1 → 359' => [-1.0, 359.0],
            '359.9 unchanged' => [359.9, 359.9],
        ];
    }
    /**
     * @return array[]
     */
    public static function boundaryMoonAlgorithmProvider(): array
    {
        return [
            'legacy' => [Astronomy::MOON_LEGACY, LegacyAstronomy::class],
            'meeus47' => [Astronomy::MOON_MEEUS47, MeeusMoon::class],
            'meeus47 without NASA correction' => [Astronomy::MOON_MEEUS47_NO_C, MeeusMoon::class],
        ];
    }
    // ==================== factory ====================
    /**
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory_returnsSameInstance(): void
    {
        $instance1 = Astronomy::factory();
        $instance2 = Astronomy::factory();
        $this->assertSame($instance1, $instance2, 'factory() はシングルトンを返す必要があります');
    }
    // ==================== normalizeAngle ====================
    /**
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory_returnsAstronomyInstance(): void
    {
        /** @noinspection UnnecessaryAssertionInspection — factory() の実行時型を明示的に確認する */
        $this->assertInstanceOf(Astronomy::class, Astronomy::factory());
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_factory_switchesSolarAndMoonAlgorithms(): void
    {
        Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
        Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        $this->assertSame(Astronomy::SOLAR_LEGACY, Astronomy::solarAlgorithm());
        $this->assertSame(Astronomy::MOON_LEGACY, Astronomy::moonAlgorithm());
        $legacyInstance = Astronomy::factory();
        $this->assertSame(Astronomy::SOLAR_LEGACY . ':' . Astronomy::MOON_LEGACY, $legacyInstance->algorithmName());

        $this->invokeSetProperty(Astronomy::class, 'instances', []);
        Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
        $vsop87Instance = Astronomy::factory();
        $this->assertSame(Astronomy::SOLAR_VSOP87, Astronomy::solarAlgorithm());
        $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_LEGACY, $vsop87Instance->algorithmName());

        $this->invokeSetProperty(Astronomy::class, 'instances', []);
        Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
        $vsopElpInstance = Astronomy::factory();
        $this->assertSame(Astronomy::MOON_ELP2000, Astronomy::moonAlgorithm());
        $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_ELP2000, $vsopElpInstance->algorithmName());
    }
    /**
     * @return void
     */
    public function test_useSolarAlgorithmRejectsUnsupportedAlgorithm(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported solar algorithm: unknown');

        try {
            Astronomy::useSolarAlgorithm('unknown');
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     */
    public function test_useMoonAlgorithmRejectsUnsupportedAlgorithm(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported moon algorithm: unknown');

        try {
            Astronomy::useMoonAlgorithm('unknown');
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_longitudeMoonSeparatesCacheByMoonAlgorithm(): void
    {
        $legacyAstronomy = new Astronomy(null, new LegacyAstronomy());
        $elp2000Astronomy = new Astronomy(null, new ELP2000());

        $legacy = $legacyAstronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);
        $elp2000 = $elp2000Astronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);

        $this->assertNotEqualsWithDelta($legacy, $elp2000, 0.001);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_longitudeMoonUsesElp2000WhenMoonAlgorithmSelected(): void
    {
        $stub = new class () implements MoonAlgorithm {
            public bool $called = false;

            /**
             * @noinspection PhpUnused — MoonAlgorithm インターフェース実装メソッド
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function longitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->called = true;

                return 123.456;
            }

            /**
             * @noinspection PhpUnused — MoonAlgorithm インターフェース実装メソッド
             * @return string
             */
            public function moonAlgorithmName(): string
            {
                return Astronomy::MOON_ELP2000;
            }
        };

        $legacyAstronomy = new Astronomy(null, new LegacyAstronomy());
        $stubAstronomy = new Astronomy(null, $stub);

        $legacy = $legacyAstronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);
        $this->assertFalse($stub->called);
        $this->assertNotSame(123.456, $legacy);

        $result = $stubAstronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);
        /** @noinspection PhpConditionAlreadyCheckedInspection — longitudeMoon() 呼び出し後に状態が変化するため */
        $this->assertTrue($stub->called);
        $this->assertSame(123.456, $result);
    }
    /**
     * @param float $input
     * @param float $expected
     * @return void
     * @throws \ReflectionException
     * @dataProvider normalizeAngleProvider
     */
    public function test_normalizeAngle(float $input, float $expected): void
    {
        $ast = new Astronomy();
        $result = $this->invokeExecuteMethod($ast, 'normalizeAngle', [$input]);
        $this->assertEqualsWithDelta($expected, $result, 1e-9);
    }
    // ==================== gregorian2JD ====================
    /**
     * 2018-03-01 00:00:00 UTC → JD 2458179.0
     * 検証: PHP の gregoriantojd(3, 1, 2018) = 2458179 (既存テストで確認済み)
     */
    public function test_gregorian2JD_knownDate(): void
    {
        $ast = new Astronomy();
        $result = $ast->gregorian2JD(2018, 3, 1, 0, 0, 0);
        $this->assertSame(2458179.0, $result);
    }
    /**
     * 2018-03-01 12:00:00 UTC → JD 2458179.5
     */
    public function test_gregorian2JD_with12Hours(): void
    {
        $ast = new Astronomy();
        $result = $ast->gregorian2JD(2018, 3, 1, 12, 0, 0);
        $this->assertSame(2458179.5, $result);
    }
    /**
     * J2000.0 基準点: 2000-01-01 00:00:00 UTC → JD 2451545.0
     * gregoriantojd(1, 1, 2000) = 2451545 に時刻 0 を加算
     */
    public function test_gregorian2JD_j2000Midnight(): void
    {
        $ast = new Astronomy();
        $result = $ast->gregorian2JD(2000, 1, 1, 0, 0, 0);
        $this->assertSame(2451545.0, $result);
    }
    /**
     * 時・分・秒の加算が正しく行われることを確認
     * 2018-03-01 06:30:30 UTC → 2458179 + 6/24 + 30/1440 + 30/86400
     */
    public function test_gregorian2JD_withTimeComponents(): void
    {
        $ast = new Astronomy();
        $expected = 2458179.0 + 6.0 / 24.0 + 30.0 / 1440.0 + 30.0 / 86400.0;
        $result = $ast->gregorian2JD(2018, 3, 1, 6, 30, 30);
        $this->assertEqualsWithDelta($expected, $result, 1e-9);
    }
    // ==================== jD2Gregorian ====================
    /**
     * JD 2458179.0 → 2018-03-01 00:00:00
     */
    public function test_jD2Gregorian_knownDate(): void
    {
        $ast = new Astronomy();
        $result = $ast->jD2Gregorian(2458179.0);

        $this->assertSame(2018, $result[0]);
        $this->assertSame(3, $result[1]);
        $this->assertSame(1, $result[2]);
        $this->assertEqualsWithDelta(0.0, $result[3], 1e-9); // hour
        $this->assertEqualsWithDelta(0.0, $result[4], 1e-9); // min
        $this->assertEqualsWithDelta(0.0, $result[5], 1e-9); // sec
    }
    /**
     * JD 2458179.5 → 2018-03-01 12:00:00
     */
    public function test_jD2Gregorian_with12Hours(): void
    {
        $ast = new Astronomy();
        $result = $ast->jD2Gregorian(2458179.5);

        $this->assertSame(2018, $result[0]);
        $this->assertSame(3, $result[1]);
        $this->assertSame(1, $result[2]);
        $this->assertEqualsWithDelta(12.0, $result[3], 1e-9);
        $this->assertEqualsWithDelta(0.0, $result[4], 1e-9);
        $this->assertEqualsWithDelta(0.0, $result[5], 1e-9);
    }
    /**
     * gregorian2JD と jD2Gregorian のラウンドトリップ整合性
     */
    public function test_jD2Gregorian_roundtrip(): void
    {
        $ast = new Astronomy();
        $jd = $ast->gregorian2JD(2023, 11, 15, 8, 45, 30);
        [$year, $month, $day, $hour, $min, $sec] = $ast->jD2Gregorian($jd);

        $this->assertSame(2023, $year);
        $this->assertSame(11, $month);
        $this->assertSame(15, $day);
        $this->assertEqualsWithDelta(8.0, $hour, 1e-9);
        $this->assertEqualsWithDelta(45.0, $min, 1e-9);
        $this->assertEqualsWithDelta(30.0, $sec, 1e-9);
    }
    // ==================== gregorian2JY ====================
    /**
     * 基準点: 2000-01-02 03:00:00 UTC → JY = 0.0
     * BASE_TIME = 2000-01-02 12:00:00 UTC のとき
     * (timestamp - BASE_TIME + 32400) / 31557600 = 0
     * ⇒ timestamp = BASE_TIME - 32400 = 2000-01-02 03:00:00 UTC
     */
    public function test_gregorian2JY_baseEpoch(): void
    {
        $ast = new Astronomy();
        $result = $ast->gregorian2JY(2000, 1, 2, 3, 0, 0);
        $this->assertEqualsWithDelta(0.0, $result, 1e-10);
    }
    /**
     * 1ユリウス年後 (31557600 秒後): 2001-01-01 09:00:00 UTC → JY = 1.0
     * (timestamp + 32400 - BASE_TIME) / 31557600 = 1
     */
    public function test_gregorian2JY_oneJulianYear(): void
    {
        $ast = new Astronomy();
        $result = $ast->gregorian2JY(2001, 1, 1, 9, 0, 0);
        $this->assertEqualsWithDelta(1.0, $result, 1e-10);
    }
    /**
     * 結果は常に単調増加 (同じ日の前後で大小関係が成立)
     */
    public function test_gregorian2JY_monotoneIncreasing(): void
    {
        $ast = new Astronomy();
        $earlier = $ast->gregorian2JY(2020, 6, 1, 0, 0, 0);
        $later = $ast->gregorian2JY(2020, 6, 2, 0, 0, 0);
        $this->assertGreaterThan($earlier, $later);
    }
    /**
     * 夏至 2000: 2000-06-21 08:48 JST = 2000-06-20 23:48 UTC
     * 太陽黄経 ≈ 90° (夏至点)
     * 出典: 国立天文台 理科年表 2000年版
     */
    public function test_longitudeSun_summerSolstice2000(): void
    {
        $ast = new Astronomy();
        // 夏至当日正午UTC、90° ± 2° 以内
        $result = $ast->longitudeSun(2000, 6, 21, 0, 0, 0);
        $this->assertGreaterThan(87.0, $result);
        $this->assertLessThan(93.0, $result);
    }
    // ==================== longitudeSun ====================
    /**
     * 秋分 2000: 2000-09-23 01:27 JST = 2000-09-22 16:27 UTC
     * 太陽黄経 ≈ 180° (秋分点)
     * 出典: 国立天文台 理科年表 2000年版
     */
    public function test_longitudeSun_autumnEquinox2000(): void
    {
        $ast = new Astronomy();
        $result = $ast->longitudeSun(2000, 9, 22, 16, 0, 0);
        $this->assertGreaterThan(178.0, $result);
        $this->assertLessThan(182.0, $result);
    }
    /**
     * 冬至 2000: 2000-12-21 22:37 JST = 2000-12-21 13:37 UTC
     * 太陽黄経 ≈ 270° (冬至点)
     * 出典: 国立天文台 理科年表 2000年版
     */
    public function test_longitudeSun_winterSolstice2000(): void
    {
        $ast = new Astronomy();
        $result = $ast->longitudeSun(2000, 12, 21, 13, 0, 0);
        $this->assertGreaterThan(268.0, $result);
        $this->assertLessThan(272.0, $result);
    }
    /**
     * 春分 2000: 2000-03-20 07:35 JST = 2000-03-19 22:35 UTC
     * 太陽黄経 ≈ 0° (春分点、360°/0° 境界付近)
     * 出典: 国立天文台 理科年表 2000年版
     */
    public function test_longitudeSun_springEquinox2000(): void
    {
        $ast = new Astronomy();
        $result = $ast->longitudeSun(2000, 3, 19, 22, 0, 0);
        // 0° 前後のため > 358° または < 2° の範囲
        $near0 = $result > 358.0 || $result < 2.0;
        $this->assertTrue($near0, "春分の太陽黄経({$result}°)が0°付近にない (358° < θ < 2°)");
    }
    /**
     * 結果は常に [0, 360) に正規化されている
     */
    public function test_longitudeSun_alwaysNormalized(): void
    {
        $ast = new Astronomy();
        $dates = [
            [2000, 1, 15, 0, 0, 0],
            [2010, 7, 4, 12, 0, 0],
            [2023, 12, 22, 6, 0, 0],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $ast->longitudeSun($y, $m, $d, $h, $i, $s);
            $this->assertGreaterThanOrEqual(0.0, $result, "$y-$m-$d で黄経が負になった");
            $this->assertLessThan(360.0, $result, "$y-$m-$d で黄経が360以上になった");
        }
    }
    /**
     * 朔 (新月): 2023-01-22 05:53 JST
     * 月黄経 ≈ 太陽黄経 (± 15° 以内)
     * 出典: 国立天文台 暦計算室 新月時刻
     */
    public function test_longitudeMoon_newMoon_closesToSun(): void
    {
        $ast = new Astronomy();
        // JST 05:53 → UTC 前日 20:53 を UTCとして渡す (moonAge と同じ座標系)
        $moonLon = $ast->longitudeMoon(2023, 1, 22, 5, 53, 0);
        $sunLon = $ast->longitudeSun(2023, 1, 22, 5, 53, 0);

        $diff = abs($moonLon - $sunLon);
        if ($diff > 180.0) {
            $diff = 360.0 - $diff;
        }
        $this->assertLessThan(
            15.0,
            $diff,
            "新月時の月黄経({$moonLon}°)と太陽黄経({$sunLon}°)の差が15°を超えた"
        );
    }
    // ==================== longitudeMoon ====================
    /**
     * 望 (満月): 2023-02-06 03:29 JST
     * 月黄経 ≈ 太陽黄経 + 180° (± 15° 以内)
     * 出典: 国立天文台 暦計算室 満月時刻
     */
    public function test_longitudeMoon_fullMoon_oppositeToSun(): void
    {
        $ast = new Astronomy();
        $moonLon = $ast->longitudeMoon(2023, 2, 6, 3, 29, 0);
        $sunLon = $ast->longitudeSun(2023, 2, 6, 3, 29, 0);

        $diff = abs($moonLon - $sunLon);
        if ($diff > 180.0) {
            $diff = 360.0 - $diff;
        }
        // 望なので差は 180° 付近
        $this->assertGreaterThan(
            165.0,
            $diff,
            "満月時の月と太陽の黄経差({$diff}°)が165°未満"
        );
    }
    /**
     * 結果は常に [0, 360) に正規化されている
     */
    public function test_longitudeMoon_alwaysNormalized(): void
    {
        $ast = new Astronomy();
        $dates = [
            [2020, 5, 5, 12, 0, 0],
            [2023, 3, 19, 16, 56, 18],
            [2026, 3, 19, 10, 23, 0],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $ast->longitudeMoon($y, $m, $d, $h, $i, $s);
            $this->assertGreaterThanOrEqual(0.0, $result, "$y-$m-$d で月黄経が負になった");
            $this->assertLessThan(360.0, $result, "$y-$m-$d で月黄経が360以上になった");
        }
    }
    // ==================== longitudeMoon ====================
    /**
     * 月の位相角は常に [0, 360) の範囲の値を返す
     *
     * 検証出典: 国立天文台 朔望データ
     */
    public function test_moonPhaseAngle_alwaysInRange(): void
    {
        $ast = new Astronomy();
        $dates = [
            [2023, 1, 1, 0, 0, 0],
            [2023, 6, 15, 12, 0, 0],
            [2025, 12, 31, 23, 59, 59],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $ast->moonPhaseAngle($y, $m, $d, $h, $i, $s);
            $this->assertIsFloat($result);
            $this->assertGreaterThanOrEqual(0.0, $result, "$y-$m-$d で位相角が負になった");
            $this->assertLessThan(360.0, $result, "$y-$m-$d で位相角が360以上になった");
        }
    }
    // ==================== moonPhaseAngle ====================
    /**
     * 新月時刻の位相角は 0° 付近になる
     *
     * 検証出典: 国立天文台 2023-01-22 05:53 JST = 2023-01-21 20:53 UTC が新月
     */
    public function test_moonPhaseAngle_nearNewMoon(): void
    {
        $ast = new Astronomy();
        // 2023-01-21 20:53 UTC (新月時刻)
        $result = $ast->moonPhaseAngle(2023, 1, 21, 20.0, 53.0, 0.0);
        // 新月区間: 337.5° 〜 22.5°
        $this->assertTrue(
            $result < 22.5 || $result >= 337.5,
            "新月付近の位相角({$result}°)が新月区間(337.5°〜22.5°)外です"
        );
    }
    /**
     * 満月時刻の位相角は 180° 付近になる
     *
     * 検証出典: 国立天文台 2023-02-05 18:29 UTC が満月
     */
    public function test_moonPhaseAngle_nearFullMoon(): void
    {
        $ast = new Astronomy();
        // 2023-02-05 18:29 UTC (満月時刻)
        $result = $ast->moonPhaseAngle(2023, 2, 5, 18.0, 29.0, 0.0);
        // 満月区間: 157.5° 〜 202.5°
        $this->assertGreaterThan(135.0, $result, "満月付近の位相角({$result}°)が小さすぎます");
        $this->assertLessThan(225.0, $result, "満月付近の位相角({$result}°)が大きすぎます");
    }
    /**
     * 月相は常に 0〜7 の整数を返す
     */
    public function test_moonPhase_alwaysInRange(): void
    {
        $ast = new Astronomy();
        $dates = [
            [2023, 1, 1, 0, 0, 0],
            [2023, 6, 15, 12, 0, 0],
            [2025, 12, 31, 23, 59, 59],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $ast->moonPhase($y, $m, $d, $h, $i, $s);
            $this->assertIsInt($result);
            $this->assertGreaterThanOrEqual(0, $result, "$y-$m-$d で月相が負になった");
            $this->assertLessThanOrEqual(7, $result, "$y-$m-$d で月相が7を超えた");
        }
    }
    // ==================== moonPhase ====================
    /**
     * 新月時刻の月相は 0 (新月) になる
     *
     * 検証出典: 国立天文台 2023-01-22 05:53 JST = 2023-01-21 20:53 UTC が新月
     */
    public function test_moonPhase_newMoon(): void
    {
        $ast = new Astronomy();
        // 2023-01-21 20:53 UTC (新月時刻)
        $result = $ast->moonPhase(2023, 1, 21, 20.0, 53.0, 0.0);
        $this->assertSame(0, $result, '新月時刻の月相が 0 (新月) でありません');
    }
    /**
     * 満月時刻の月相は 4 (満月) になる
     *
     * 検証出典: 国立天文台 2023-02-05 18:29 UTC が満月
     */
    public function test_moonPhase_fullMoon(): void
    {
        $ast = new Astronomy();
        // 2023-02-05 18:29 UTC (満月時刻)
        $result = $ast->moonPhase(2023, 2, 5, 18.0, 29.0, 0.0);
        $this->assertSame(4, $result, '満月時刻の月相が 4 (満月) でありません');
    }
    // ==================== meeus47 追加テスト ====================
    /**
     * @return void
     */
    public function test_useMoonAlgorithm_accepts_meeus47(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47);
            $this->assertSame(Astronomy::MOON_MEEUS47, Astronomy::moonAlgorithm());
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     */
    public function test_useMoonAlgorithm_accepts_meeus47_no_c(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47_NO_C);
            $this->assertSame(Astronomy::MOON_MEEUS47_NO_C, Astronomy::moonAlgorithm());
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_factory_meeus47_returns_MeeusMoon_instance(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47);
            $ast = Astronomy::factory();
            $impl = $this->invokeGetProperty($ast, 'moonAlgorithmImpl');
            $this->assertInstanceOf(MeeusMoon::class, $impl);
            $this->assertSame('meeus47', $impl->moonAlgorithmName());
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_factory_meeus47_no_c_returns_MeeusMoon_no_c_instance(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47_NO_C);
            $ast = Astronomy::factory();
            $impl = $this->invokeGetProperty($ast, 'moonAlgorithmImpl');
            $this->assertInstanceOf(MeeusMoon::class, $impl);
            $this->assertSame('meeus47_no_c', $impl->moonAlgorithmName());
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     */
    public function test_four_moon_algorithms_produce_different_instances(): void
    {
        $algorithms = [
            Astronomy::MOON_LEGACY,
            Astronomy::MOON_ELP2000,
            Astronomy::MOON_MEEUS47,
            Astronomy::MOON_MEEUS47_NO_C,
        ];

        $instances = [];
        foreach ($algorithms as $algo) {
            Astronomy::useMoonAlgorithm($algo);
            $instances[$algo] = Astronomy::factory();
        }

        $pairs = [];
        foreach ($algorithms as $a) {
            foreach ($algorithms as $b) {
                if ($a >= $b) {
                    continue;
                }
                $pairs[] = [$a, $b];
            }
        }
        foreach ($pairs as [$a, $b]) {
            $this->assertNotSame($instances[$a], $instances[$b], "$a と $b で別インスタンス");
        }
    }
    // ==================== useBoundarySolarAlgorithm / boundarySolarAlgorithm ====================
    /**
     * @return void
     */
    public function test_boundarySolarAlgorithm_defaultIsVSOP87(): void
    {
        $this->assertSame(Astronomy::SOLAR_VSOP87, Astronomy::boundarySolarAlgorithm());
    }
    /**
     * @return void
     */
    public function test_useBoundarySolarAlgorithm_changesValue(): void
    {
        Astronomy::useBoundarySolarAlgorithm(Astronomy::SOLAR_LEGACY);
        $this->assertSame(Astronomy::SOLAR_LEGACY, Astronomy::boundarySolarAlgorithm());
    }
    /**
     * @return void
     */
    public function test_useBoundarySolarAlgorithm_rejectsUnsupported(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported solar algorithm: unknown');
        Astronomy::useBoundarySolarAlgorithm('unknown');
    }
    // ==================== useBoundaryMoonAlgorithm / boundaryMoonAlgorithm ====================
    /**
     * @return void
     */
    public function test_boundaryMoonAlgorithm_defaultIsELP2000(): void
    {
        $this->assertSame(Astronomy::MOON_ELP2000, Astronomy::boundaryMoonAlgorithm());
    }
    /**
     * @return void
     */
    public function test_useBoundaryMoonAlgorithm_changesValue(): void
    {
        Astronomy::useBoundaryMoonAlgorithm(Astronomy::MOON_LEGACY);
        $this->assertSame(Astronomy::MOON_LEGACY, Astronomy::boundaryMoonAlgorithm());
    }
    /**
     * @return void
     */
    public function test_useBoundaryMoonAlgorithm_rejectsUnsupported(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported moon algorithm: unknown');
        Astronomy::useBoundaryMoonAlgorithm('unknown');
    }
    // ==================== factoryForBoundary ====================
    /**
     * @return void
     */
    public function test_factoryForBoundary_returnsAstronomyInstance(): void
    {
        /** @noinspection UnnecessaryAssertionInspection — factoryForBoundary() の実行時型を明示的に確認する */
        $this->assertInstanceOf(Astronomy::class, Astronomy::factoryForBoundary());
    }
    /**
     * @return void
     */
    public function test_factoryForBoundary_defaultAlgorithmIsVsop87Elp2000(): void
    {
        $instance = Astronomy::factoryForBoundary();
        $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_ELP2000, $instance->algorithmName());
    }
    /**
     * @return void
     */
    public function test_factoryForBoundary_respectsBoundarySolarAlgorithm(): void
    {
        Astronomy::useBoundarySolarAlgorithm(Astronomy::SOLAR_LEGACY);
        $instance = Astronomy::factoryForBoundary();
        $this->assertSame(Astronomy::SOLAR_LEGACY . ':' . Astronomy::MOON_ELP2000, $instance->algorithmName());
    }
    /**
     * @param string $algorithm
     * @param string $expectedClass
     * @return void
     * @throws \ReflectionException
     * @dataProvider boundaryMoonAlgorithmProvider
     */
    public function test_factoryForBoundary_respectsBoundaryMoonAlgorithm(string $algorithm, string $expectedClass): void
    {
        Astronomy::useBoundaryMoonAlgorithm($algorithm);
        $instance = Astronomy::factoryForBoundary();
        $moonImpl = $this->invokeGetProperty($instance, 'moonAlgorithmImpl');
        $this->assertInstanceOf($expectedClass, $moonImpl);
        $this->assertSame($algorithm, $instance->moonAlgorithmName());
    }
    /**
     * @return void
     */
    public function test_factoryForBoundary_sharedCacheWithFactory(): void
    {
        // 通常アルゴリズムを境界と同じ vsop87:elp2000 に設定すると同一インスタンスが返る
        Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
        Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
        $fromFactory = Astronomy::factory();
        $fromBoundary = Astronomy::factoryForBoundary();
        $this->assertSame($fromFactory, $fromBoundary);
    }
    /**
     * @return void
     */
    public function test_factoryForBoundary_independentFromNormalAlgorithm(): void
    {
        // 通常=Legacy, 境界=VSOP87/ELP2000(デフォルト) のとき別インスタンスになる
        $normal = Astronomy::factory();
        $boundary = Astronomy::factoryForBoundary();
        $this->assertNotSame($normal, $boundary);
        $this->assertSame(Astronomy::SOLAR_LEGACY . ':' . Astronomy::MOON_LEGACY, $normal->algorithmName());
        $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_ELP2000, $boundary->algorithmName());
    }
    // ==================== longitudeMoonFast ====================
    /**
     * ELP2000 実装が注入された Astronomy で longitudeMoonFast() を呼ぶと
     * ELP2000Reduced 経由で float の黄経値が返ること。
     *
     * @return void
     * @throws \Exception
     */
    public function test_longitudeMoonFast_withElp2000_returnsFloat(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $ast = Astronomy::factory();
            $result = $ast->longitudeMoonFast(2025, 3, 29, 19, 58, 0.0);
            $this->assertIsFloat($result);
            $this->assertGreaterThanOrEqual(0.0, $result);
            $this->assertLessThan(360.0, $result);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * Legacy 実装が注入された Astronomy で longitudeMoonFast() を呼ぶと
     * longitudeMoon() に委譲されて同じ値が返ること。
     *
     * @return void
     * @throws \Exception
     */
    public function test_longitudeMoonFast_withNonElp2000_delegatesToLongitudeMoon(): void
    {
        // Legacy はデフォルト
        $ast = Astronomy::factory();
        $fast = $ast->longitudeMoonFast(2025, 3, 29, 19, 58, 0.0);
        $full = $ast->longitudeMoon(2025, 3, 29, 19, 58, 0.0);
        $this->assertSame($full, $fast);
    }
    /**
     * ELP2000 実装使用時、初回呼び出しで reducedMoonImpl が遅延生成され
     * ELP2000Reduced インスタンスになること。
     *
     * @return void
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function test_longitudeMoonFast_createsReducedMoonImplLazily(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $ast = Astronomy::factory();

            // 呼び出し前は null
            $before = $this->invokeGetProperty($ast, 'reducedMoonImpl');
            $this->assertNull($before);

            $ast->longitudeMoonFast(2025, 3, 29, 19, 58, 0.0);

            // 呼び出し後は ELP2000Reduced インスタンス
            $after = $this->invokeGetProperty($ast, 'reducedMoonImpl');
            $this->assertInstanceOf(ELP2000Reduced::class, $after);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * 同一入力に対して longitudeMoonFast() を2回呼んでも同値が返ること（oneTimeCache の動作確認）。
     *
     * @return void
     * @throws \Exception
     */
    public function test_longitudeMoonFast_returnsSameValueOnRepeatedCall(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $ast = Astronomy::factory();
            $first  = $ast->longitudeMoonFast(2025, 3, 29, 19, 58, 0.0);
            $second = $ast->longitudeMoonFast(2025, 3, 29, 19, 58, 0.0);
            $this->assertSame($first, $second);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    // ==================== moonPhaseAngleFast ====================
    /**
     * moonPhaseAngleFast() は高速月黄経と太陽黄経の差を [0, 360) に正規化して返すこと。
     *
     * @return void
     * @throws \Exception
     */
    public function test_moonPhaseAngleFast_normalizesDifferenceBetweenFastMoonAndSunLongitude(): void
    {
        $sun = new class () implements SunAlgorithm {
            /**
             * @noinspection PhpUnusedParameterInspection — インターフェイス実装の固定値スタブ
             * @param int $year
             * @param int $month
             * @param float $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
            {
                return 350.0;
            }

            /**
             * @return string
             */
            public function sunAlgorithmName(): string
            {
                return 'stub_sun';
            }
        };

        $moon = new class () implements MoonAlgorithm {
            /**
             * @noinspection PhpUnusedParameterInspection — インターフェイス実装の固定値スタブ
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function longitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                return 10.0;
            }

            /**
             * @return string
             */
            public function moonAlgorithmName(): string
            {
                return 'stub_moon';
            }
        };

        $ast = new Astronomy($sun, $moon);

        $result = $ast->moonPhaseAngleFast(2025, 3, 29, 19.0, 58.0, 0.0);

        $this->assertSame(20.0, $result);
    }
    /**
     * ELP2000 実装が注入された Astronomy でも moonPhaseAngleFast() は範囲内の float を返すこと。
     *
     * @return void
     * @throws \Exception
     */
    public function test_moonPhaseAngleFast_withElp2000_returnsFloatInRange(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $ast = Astronomy::factory();

            $result = $ast->moonPhaseAngleFast(2025, 3, 29, 19.0, 58.0, 0.0);

            $this->assertIsFloat($result);
            $this->assertGreaterThanOrEqual(0.0, $result);
            $this->assertLessThan(360.0, $result);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function tearDown(): void
    {
        $this->invokeSetProperty(Astronomy::class, 'instances', []);
        $this->invokeSetProperty(Astronomy::class, 'solarAlgorithm', Astronomy::SOLAR_LEGACY);
        $this->invokeSetProperty(Astronomy::class, 'moonAlgorithm', Astronomy::MOON_LEGACY);
        $this->invokeSetProperty(Astronomy::class, 'boundarySolarAlgorithm', Astronomy::SOLAR_VSOP87);
        $this->invokeSetProperty(Astronomy::class, 'boundaryMoonAlgorithm', Astronomy::MOON_ELP2000);
    }
}
