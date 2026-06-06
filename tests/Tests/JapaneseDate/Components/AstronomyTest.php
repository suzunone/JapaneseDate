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
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversClass;
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
 *   moonAge                      : ±1 (round 後の整数値)
 * @covers \JapaneseDate\Components\Astronomy
 */
class AstronomyTest extends TestCase
{
    use InvokeTrait;
    // ==================== factory ====================
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
    public static function moonAgeProvider(): array
    {
        return [
            // 朔 (新月): 月齢 ≈ 0
            // 出典: 国立天文台 暦計算室 2023年1月朔 05:53 JST
            '2023朔 05:53 JST' => [2023, 1, 22, 5, 53, 0, 0],
            // 望 (満月): 月齢 ≈ 15
            // 出典: 国立天文台 暦計算室 2023年2月望 03:29 JST
            '2023望 03:29 JST' => [2023, 2, 6, 3, 29, 0, 15],
            // 朔前日: 月齢 ≈ 29
            // 出典: 国立天文台 暦計算室 2020年12月朔 10:17 JST (朔前日)
            '2020朔前日' => [2020, 12, 14, 0, 0, 0, 29],
            // 朔当日: 月齢 ≈ 0
            // 出典: 国立天文台 暦計算室 2020年12月朔 10:17 JST
            '2020朔' => [2020, 12, 15, 1, 17, 0, 0],
            // 朔翌日: 月齢 ≈ 1
            '2020朔翌日' => [2020, 12, 16, 1, 17, 0, 1],
            // 2026-03-19 朔: 月黄経負値バグ修正後に正常動作することを確認
            // 出典: 国立天文台 暦計算室 2026年3月朔 19:23 JST
            '2026朔' => [2026, 3, 19, 10, 23, 0, 0],
            // 2026-03-19 朔前(0:00 JST): 前周期の29.x のまま
            '2026朔直前 00:00 JST' => [2026, 3, 19, 0, 0, 0, 29],
            // 出典: 国立天文台 暦要項 2022年「朔弦望」 2022年3月朔 02:35 JST
            '2022 3月朔' => [2022, 3, 3, 0, 0, 0, 0],
            // 出典: 国立天文台 暦要項 2022年「朔弦望」 2022年7月朔 02:55 JST
            '2022 7月朔' => [2022, 7, 29, 0, 0, 0, 0],
            // 出典: 国立天文台 暦要項 2015年「朔弦望」 2015年11月朔 02:47 JST
            '2015 11月朔' => [2015, 11, 12, 0, 0, 0, 0],
            // 春分直後の月齢。2017年暦要項の朔 3/28 11:57、上弦 4/4 03:39、朔 4/26 21:16 JST から丸め月齢4。
            // この日は計算途中で春分付近補正、ΔΛ > 40°補正、$res > 30 補正を通る。
            '2017 春分付近の月齢4' => [2017, 4, 2, 0, 0, 0, 4],
        ];
    }
    // ==================== normalizeAngle ====================
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory_returnsSameInstance(): void
    {
        $instance1 = Astronomy::factory();
        $instance2 = Astronomy::factory();
        $this->assertSame($instance1, $instance2, 'factory() はシングルトンを返す必要があります');
    }
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory_returnsAstronomyInstance(): void
    {
        $this->assertInstanceOf(Astronomy::class, Astronomy::factory());
    }
    public function test_factory_switchesSolarAndMoonAlgorithms(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->assertSame(Astronomy::SOLAR_LEGACY, Astronomy::solarAlgorithm());
            $this->assertSame(Astronomy::MOON_LEGACY, Astronomy::moonAlgorithm());
            $this->assertSame(Astronomy::SOLAR_LEGACY . ':' . Astronomy::MOON_LEGACY, Astronomy::factory()->algorithmName());

            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            $this->assertSame(Astronomy::SOLAR_VSOP87, Astronomy::solarAlgorithm());
            $this->assertInstanceOf(Vsop87Astronomy::class, Astronomy::factory());
            $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_LEGACY, Astronomy::factory()->algorithmName());

            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $this->assertSame(Astronomy::MOON_ELP2000, Astronomy::moonAlgorithm());
            $this->assertInstanceOf(Vsop87Astronomy::class, Astronomy::factory());
            $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_ELP2000, Astronomy::factory()->algorithmName());
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
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
    public function test_longitudeMoonSeparatesCacheByMoonAlgorithm(): void
    {
        $astronomy = new Astronomy();

        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $legacy = $astronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);

            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $elp2000 = $astronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);

            $this->assertNotEqualsWithDelta($legacy, $elp2000, 0.001);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    public function test_longitudeMoonUsesElp2000WhenMoonAlgorithmSelected(): void
    {
        $astronomy = new class extends Astronomy {
            public bool $elp2000Called = false;

            protected function elp2000LongitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $this->elp2000Called = true;

                return 123.456;
            }
        };

        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $legacy = $astronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);
            $this->assertFalse($astronomy->elp2000Called);
            $this->assertNotSame(123.456, $legacy);

            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $elp2000 = $astronomy->longitudeMoon(2024, 4, 8, 18, 21, 0);
            $this->assertTrue($astronomy->elp2000Called);
            $this->assertSame(123.456, $elp2000);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    public function test_approximateDeltaTSecondsUsesFutureFormulaFrom2050(): void
    {
        $astronomy = new Astronomy();

        $year = 2100;
        $month = 6;
        $y = $year + ($month - 0.5) / 12.0;
        $u = ($y - 1820.0) / 100.0;
        $expected = -20.0 + 32.0 * $u * $u - 0.5628 * (2150.0 - $y);

        $result = $this->invokeExecuteMethod($astronomy, 'approximateDeltaTSeconds', [$year, $month]);

        $this->assertEqualsWithDelta($expected, $result, 1e-12);
    }
    // ==================== gregorian2JD ====================
    /**
     * @dataProvider normalizeAngleProvider
     */
    public function test_normalizeAngle(float $input, float $expected): void
    {
        $ast = new Astronomy();
        $result = $this->invokeExecuteMethod($ast, 'normalizeAngle', [$input]);
        $this->assertEqualsWithDelta($expected, $result, 1e-9);
    }
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
    // ==================== jD2Gregorian ====================
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
    // ==================== gregorian2JY ====================
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
    // ==================== jy2LongitudeSun ====================
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
     * 結果は常に [0, 360) に正規化されている
     */
    public function test_jy2LongitudeSun_rangeAtBaseEpoch(): void
    {
        $ast = new Astronomy();
        $result = $this->invokeExecuteMethod($ast, 'jy2LongitudeSun', [0.0]);
        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
    }
    /**
     * JY=0.0 (2000年1月初旬) の太陽黄経は冬至(270°)直後の約280°付近
     * 出典: 国立天文台「暦計算室」
     */
    public function test_jy2LongitudeSun_earlyJanuary2000(): void
    {
        $ast = new Astronomy();
        $result = $this->invokeExecuteMethod($ast, 'jy2LongitudeSun', [0.0]);
        // 冬至 270° を過ぎた直後、275°〜285° 付近
        $this->assertGreaterThan(270.0, $result);
        $this->assertLessThan(290.0, $result);
    }
    /**
     * JY=0.5 (2000年夏至前後) の太陽黄経は夏至(90°)前後
     * 地球軌道の離心率により 85°〜110° の範囲
     */
    public function test_jy2LongitudeSun_midsummer2000(): void
    {
        $ast = new Astronomy();
        $result = $this->invokeExecuteMethod($ast, 'jy2LongitudeSun', [0.5]);
        $this->assertGreaterThanOrEqual(85.0, $result);
        $this->assertLessThan(115.0, $result);
    }
    // ==================== longitudeSun ====================
    /**
     * 複数の JY 値でも常に [0, 360) に収まる
     */
    public function test_jy2LongitudeSun_alwaysNormalized(): void
    {
        $ast = new Astronomy();
        foreach ([0.0, 0.25, 0.5, 0.75, 1.0, 10.0, 25.0, -1.0] as $jy) {
            $result = $this->invokeExecuteMethod($ast, 'jy2LongitudeSun', [$jy]);
            $this->assertGreaterThanOrEqual(0.0, $result, "JY={$jy} で黄経が負になった");
            $this->assertLessThan(360.0, $result, "JY={$jy} で黄経が360以上になった");
        }
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
    // ==================== jY2LongitudeMoon ====================
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
            $this->assertGreaterThanOrEqual(0.0, $result, "{$y}-{$m}-{$d} で黄経が負になった");
            $this->assertLessThan(360.0, $result, "{$y}-{$m}-{$d} で黄経が360以上になった");
        }
    }
    /**
     * 結果は常に [0, 360) に正規化されている
     */
    public function test_jY2LongitudeMoon_alwaysNormalized(): void
    {
        $ast = new Astronomy();
        foreach ([0.0, 0.25, 0.5, 1.0, 10.0, 23.0, 25.0] as $jy) {
            $result = $this->invokeExecuteMethod($ast, 'jY2LongitudeMoon', [$jy]);
            $this->assertGreaterThanOrEqual(0.0, $result, "JY={$jy} で月黄経が負になった");
            $this->assertLessThan(360.0, $result, "JY={$jy} で月黄経が360以上になった");
        }
    }
    // ==================== longitudeMoon ====================
    /**
     * 月黄経は太陽黄経より速く変化する (1日で約13°)
     * 2日間の差が 10°〜16° の範囲に収まることを確認
     */
    public function test_jY2LongitudeMoon_changesAround13DegPerDay(): void
    {
        $ast = new Astronomy();
        $jy1 = $ast->gregorian2JY(2023, 6, 1, 0, 0, 0);
        $jy2 = $ast->gregorian2JY(2023, 6, 2, 0, 0, 0);

        $lon1 = $this->invokeExecuteMethod($ast, 'jY2LongitudeMoon', [$jy1]);
        $lon2 = $this->invokeExecuteMethod($ast, 'jY2LongitudeMoon', [$jy2]);

        $diff = fmod(($lon2 - $lon1 + 360.0), 360.0);
        $this->assertGreaterThan(10.0, $diff, '月黄経の日変化が小さすぎる');
        $this->assertLessThan(16.0, $diff, '月黄経の日変化が大きすぎる');
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
    // ==================== moonAge ====================
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
            $this->assertGreaterThanOrEqual(0.0, $result, "{$y}-{$m}-{$d} で月黄経が負になった");
            $this->assertLessThan(360.0, $result, "{$y}-{$m}-{$d} で月黄経が360以上になった");
        }
    }
    /**
     * @dataProvider moonAgeProvider
     */
    public function test_moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec, int $expectedRounded): void
    {
        $ast = new Astronomy();
        $result = $ast->moonAge($year, $month, $day, $hour, $min, $sec);
        $this->assertEquals(
            $expectedRounded,
            round($result),
            sprintf(
                '%d-%02d-%02d %02d:%02d の月齢(%.4f)の丸め値が %d と一致しない',
                $year,
                $month,
                $day,
                $hour,
                $min,
                $result,
                $expectedRounded
            )
        );
    }
    /**
     * moonAge は常に [0, 30) の範囲の値を返す
     */
    public function test_moonAge_alwaysInRange(): void
    {
        $ast = new Astronomy();
        $dates = [
            [2023, 1, 1, 0, 0, 0],
            [2023, 6, 15, 12, 0, 0],
            [2025, 12, 31, 23, 59, 59],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $ast->moonAge($y, $m, $d, $h, $i, $s);
            $this->assertGreaterThanOrEqual(0.0, $result, "{$y}-{$m}-{$d} で月齢が負になった");
            $this->assertLessThan(30.0, $result, "{$y}-{$m}-{$d} で月齢が30以上になった");
        }
    }
    // ==================== moonPhaseAngle ====================
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
            $this->assertGreaterThanOrEqual(0.0, $result, "{$y}-{$m}-{$d} で位相角が負になった");
            $this->assertLessThan(360.0, $result, "{$y}-{$m}-{$d} で位相角が360以上になった");
        }
    }
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
    // ==================== moonPhase ====================
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
            $this->assertGreaterThanOrEqual(0, $result, "{$y}-{$m}-{$d} で月相が負になった");
            $this->assertLessThanOrEqual(7, $result, "{$y}-{$m}-{$d} で月相が7を超えた");
        }
    }
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
}
