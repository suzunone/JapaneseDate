<?php

namespace Tests\JapaneseDate\Components;

use InvalidArgumentException;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\MeeusMoon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * MeeusMoon コンポーネントのテスト。
 *
 * Meeus AA2 Chapter 47 の係数テーブル検証、ΔT 計算、JST→JDE 変換、
 * 月位置計算の正確性を検証する。
 * @covers \JapaneseDate\Components\MeeusMoon
 */
class MeeusMoonTest extends TestCase
{
    use InvokeTrait;
    // ==================== 係数テーブル検証 ====================
    /**
     * @return void
     */
    public function test_TABLE_47A_count_and_boundary_rows(): void
    {
        $ta = MeeusMoon::TABLE_47A;
        $this->assertCount(60, $ta);
        $this->assertSame([0, 0, 1, 0, 6288774, -20905355], $ta[0]);
        $this->assertSame([2, 0, -1, -2, 0, 8752], $ta[59]);
    }
    /**
     * @return void
     */
    public function test_TABLE_47B_count_and_boundary_rows(): void
    {
        $tb = MeeusMoon::TABLE_47B;
        $this->assertCount(60, $tb);
        $this->assertSame([0, 0, 0, 1, 5128122], $tb[0]);
        $this->assertSame([2, -2, 0, 1, 107], $tb[59]);
    }
    /**
     * @return void
     * @throws \JsonException
     */
    public function test_TABLE_47A_sha256_matches_canonical(): void
    {
        $this->assertSame(
            'e4c3fc1cf8aff72baa848a7c6770ad435a0b766ef9de6d2e907e8007244a2e2a',
            hash('sha256', json_encode(MeeusMoon::TABLE_47A, 0))
        );
    }
    /**
     * @return void
     * @throws \JsonException
     */
    public function test_TABLE_47B_sha256_matches_canonical(): void
    {
        $this->assertSame(
            'dcd1e6d06a263b87c23ac2deb86dab5436f34e952ed37c0bfa867493825f3661',
            hash('sha256', json_encode(MeeusMoon::TABLE_47B, 0))
        );
    }
    // ==================== moonAlgorithmName ====================
    /**
     * @return void
     */
    public function test_moonAlgorithmName_with_c_correction(): void
    {
        $this->assertSame('meeus47', (new MeeusMoon(true))->moonAlgorithmName());
    }
    /**
     * @return void
     */
    public function test_moonAlgorithmName_without_c_correction(): void
    {
        $this->assertSame('meeus47_no_c', (new MeeusMoon(false))->moonAlgorithmName());
    }
    // ==================== eccentricityFactor ====================
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_eccentricityFactor_mCoeff_zero(): void
    {
        $meeus = new MeeusMoon();
        $result = $this->invokeExecuteMethod($meeus, 'eccentricityFactor', [0.9, 0]);
        $this->assertSame(1.0, $result);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_eccentricityFactor_mCoeff_positive_one(): void
    {
        $meeus = new MeeusMoon();
        $result = $this->invokeExecuteMethod($meeus, 'eccentricityFactor', [0.9, 1]);
        $this->assertEqualsWithDelta(0.9, $result, 1e-15);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_eccentricityFactor_mCoeff_negative_one(): void
    {
        $meeus = new MeeusMoon();
        $result = $this->invokeExecuteMethod($meeus, 'eccentricityFactor', [0.9, -1]);
        $this->assertEqualsWithDelta(0.9, $result, 1e-15);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_eccentricityFactor_mCoeff_positive_two(): void
    {
        $meeus = new MeeusMoon();
        $result = $this->invokeExecuteMethod($meeus, 'eccentricityFactor', [0.9, 2]);
        $this->assertEqualsWithDelta(0.81, $result, 1e-15);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_eccentricityFactor_mCoeff_negative_two(): void
    {
        $meeus = new MeeusMoon();
        $result = $this->invokeExecuteMethod($meeus, 'eccentricityFactor', [0.9, -2]);
        $this->assertEqualsWithDelta(0.81, $result, 1e-15);
    }
    // ==================== normalizeAngle360 ====================
    /**
     * @return array[]
     */
    public static function normalizeAngle360Provider(): array
    {
        return [
            'zero' => [0.0, 0.0],
            '360->0' => [360.0, 0.0],
            '720->0' => [720.0, 0.0],
            '-90->270' => [-90.0, 270.0],
            '450->90' => [450.0, 90.0],
        ];
    }
    /**
     * @param float $input
     * @param float $expected
     * @return void
     * @throws \ReflectionException
     * @dataProvider normalizeAngle360Provider
     */
    public function test_normalizeAngle360($input, $expected): void
    {
        $meeus = new MeeusMoon();
        $result = $this->invokeExecuteMethod($meeus, 'normalizeAngle360', [$input]);
        $this->assertEqualsWithDelta($expected, $result, 1e-9);
    }
    // ==================== ΔT Layer 1: deltaTPolynomialForDecimalYear ====================
    /**
     * @return array[]
     */
    public static function deltaTPolynomialProvider(): array
    {
        return [
            'y=-1999.0' => [-1999.0, 46651.2352],
            'y=-500.0' => [-500.0, 17203.656339063],
            'y=500.0' => [500.0, 5710.0446703125],
            'y=1600.0' => [1600.0, 120.0],
            'y=1620.0' => [1620.0, 95.378177023425],
            'y=1700.0' => [1700.0, 8.83],
            'y=1800.0' => [1800.0, 13.72],
            'y=1860.0' => [1860.0, 7.62],
            'y=1900.0' => [1900.0, -2.79],
            'y=1920.0' => [1920.0, 21.20],
            'y=1955.0' => [1955.0, 31.046781208558],
            'y=1961.0' => [1961.0, 33.579880865652],
            'y=2000.0' => [2000.0, 63.86],
            'y=2005.0' => [2005.0, 64.670575],
            'y=2050.0' => [2050.0, 93.0],
            'y=2150.0' => [2150.0, 328.48],
            'y=3000.0' => [3000.0, 4435.68],
        ];
    }
    /**
     * @param float $y
     * @param float $expected
     * @return void
     * @throws \ReflectionException
     * @dataProvider deltaTPolynomialProvider
     */
    public function test_deltaTPolynomialForDecimalYear($y, $expected): void
    {
        $meeus = new MeeusMoon(false);
        $result = $this->invokeExecuteMethod($meeus, 'deltaTPolynomialForDecimalYear', [$y]);
        $this->assertEqualsWithDelta($expected, $result, 0.001);
    }
    // ==================== ΔT Layer 2: c 補正境界テスト ====================
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_c_correction_boundary_1955_is_zero(): void
    {
        $mC = new MeeusMoon(true);
        $mNC = new MeeusMoon(false);
        $c1 = $this->invokeExecuteMethod($mC, 'deltaTForDecimalYear', [1955.0]);
        $n1 = $this->invokeExecuteMethod($mNC, 'deltaTForDecimalYear', [1955.0]);
        // 1955.0 は c補正不要区間の下端 → c=0
        $this->assertEqualsWithDelta($n1, $c1, 1e-12);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_c_correction_boundary_2005_is_zero(): void
    {
        $mC = new MeeusMoon(true);
        $mNC = new MeeusMoon(false);
        $c2 = $this->invokeExecuteMethod($mC, 'deltaTForDecimalYear', [2005.0]);
        $n2 = $this->invokeExecuteMethod($mNC, 'deltaTForDecimalYear', [2005.0]);
        // 2005.0 は c補正不要区間の上端 → c=0
        $this->assertEqualsWithDelta($n2, $c2, 1e-12);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_c_correction_outside_range_is_nonzero(): void
    {
        $mC = new MeeusMoon(true);
        $mNC = new MeeusMoon(false);
        // 2005 超では c ≠ 0（c < 0 なのでモードにより ΔT が小さくなる）
        $c3 = $this->invokeExecuteMethod($mC, 'deltaTForDecimalYear', [2005.0 + 1.0 / 12.0]);
        $n3 = $this->invokeExecuteMethod($mNC, 'deltaTForDecimalYear', [2005.0 + 1.0 / 12.0]);
        $this->assertNotEqualsWithDelta($n3, $c3, 1e-6);
        $this->assertLessThan($n3, $c3); // c < 0 なので補正ありの方が小さい
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_c_correction_before_1955_is_nonzero(): void
    {
        $mC = new MeeusMoon(true);
        $mNC = new MeeusMoon(false);
        $c4 = $this->invokeExecuteMethod($mC, 'deltaTForDecimalYear', [1700.0]);
        $n4 = $this->invokeExecuteMethod($mNC, 'deltaTForDecimalYear', [1700.0]);
        $this->assertNotEqualsWithDelta($n4, $c4, 1e-6);
    }
    // ==================== ΔT Layer 3: deltaTForDecimalYear (polynomial + c) ====================
    /**
     * @return array[]
     */
    public static function deltaTWithCProvider(): array
    {
        return [
            'y=-1999.0 c適用' => [-1999.0, 46449.054811888],
            'y=-500.0 c適用' => [-500.0, 17125.714851763],
            'y=0.0 c適用' => [0.0, 10534.1735727],
            'y=500.0 c適用' => [500.0, 5682.6673030125],
            'y=1600.0 c適用' => [1600.0, 118.3702447],
            'y=1955.0 c未適用' => [1955.0, 31.046781208558],
            'y=2000.0 c未適用' => [2000.0, 63.86],
            'y=2005.0 c未適用' => [2005.0, 64.670575],
            'y=2050.0 c適用' => [2050.0, 92.8832887],
            'y=2150.0 c適用' => [2150.0, 327.9882607],
            'y=3000.0 c適用' => [3000.0, 4421.5579327],
        ];
    }
    /**
     * @param float $y
     * @param float $expected
     * @return void
     * @throws \ReflectionException
     * @dataProvider deltaTWithCProvider
     */
    public function test_deltaTForDecimalYear_with_c($y, $expected): void
    {
        $meeus = new MeeusMoon(true);
        $result = $this->invokeExecuteMethod($meeus, 'deltaTForDecimalYear', [$y]);
        $this->assertEqualsWithDelta($expected, $result, 0.001);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_approximateDeltaTSeconds_matches_deltaTForDecimalYear(): void
    {
        $meeus = new MeeusMoon(false);
        $y = 2000 + (1 - 0.5) / 12.0;
        $viaInt = $this->invokeExecuteMethod($meeus, 'approximateDeltaTSeconds', [2000, 1]);
        $viaFloat = $this->invokeExecuteMethod($meeus, 'deltaTForDecimalYear', [$y]);
        $this->assertSame($viaInt, $viaFloat);
    }
    // ==================== gregorianToJd / jdToGregorianYmd ====================
    /**
     * @return void
     */
    public function test_gregorianToJd_known_values(): void
    {
        // 西暦 1 年 1 月 1 日 = JD 1721425.5
        $this->assertEqualsWithDelta(1721425.5, MeeusMoon::gregorianToJd(1, 1, 1), 1e-9);
        // 紀元前 1 年 1 月 1 日（年0）= JD 1721059.5
        $this->assertEqualsWithDelta(1721059.5, MeeusMoon::gregorianToJd(0, 1, 1), 1e-9);
        // 2000-01-01 = JD 2451544.5
        $this->assertEqualsWithDelta(2451544.5, MeeusMoon::gregorianToJd(2000, 1, 1), 1e-9);
    }
    /**
     * @return \int[][]
     */
    public static function roundTripProvider(): array
    {
        return [
            'BC2000 6/15' => [-1999, 6, 15],
            'BC2 12/31' => [-1, 12, 31],
            'BC1 2/29' => [0, 2, 29],    // 年0はうるう年（4の倍数）
            'CE1 1/1' => [1, 1, 1],
            '1600 2/29' => [1600, 2, 29],
            '2000 1/1' => [2000, 1, 1],
            '2000 2/29' => [2000, 2, 29],
            '2100 2/28' => [2100, 2, 28],
            '3000 12/31' => [3000, 12, 31],
        ];
    }
    /**
     * @param int $y
     * @param int $m
     * @param int $d
     * @return void
     * @dataProvider roundTripProvider
     */
    public function test_gregorianJd_round_trip($y, $m, $d): void
    {
        $jd = MeeusMoon::gregorianToJd($y, $m, $d);
        [$y2, $m2, $d2] = MeeusMoon::jdToGregorianYmd($jd);
        $this->assertSame([$y, $m, $d], [$y2, $m2, $d2]);
    }
    // ==================== 不正入力テスト ====================
    /**
     * @param float $bad
     * @return void
     * @dataProvider invalidJdeProvider
     */
    public function test_calculateFromJde_rejects_invalid_jde($bad): void
    {
        $thrown = false;
        try {
            (new MeeusMoon())->calculateFromJde($bad);
        } catch (InvalidArgumentException $exception) {
            $thrown = true;
        }
        $this->assertTrue($thrown);
    }
    /**
     * @return array[]
     */
    public static function invalidJdeProvider(): array
    {
        return [
            'NAN' => [NAN],
            'INF' => [INF],
            '-INF' => [-INF],
        ];
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_rejects_nan_hour(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new MeeusMoon())->longitudeMoon(2000, 1, 1, NAN, 0, 0);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_rejects_inf_min(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new MeeusMoon())->longitudeMoon(2000, 1, 1, 0, INF, 0);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_rejects_negative_infinity_sec(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new MeeusMoon())->longitudeMoon(2000, 1, 1, 0, 0, -INF);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_invalid_month_zero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(2000, 0, 1);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_invalid_month_thirteen(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(2000, 13, 1);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_invalid_day_zero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(2000, 1, 0);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_day_32_in_january(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(2000, 1, 32);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_feb30_non_leap(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(2001, 2, 30);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_accepts_feb29_leap_year(): void
    {
        // 例外が発生しないことを確認
        $jd = MeeusMoon::gregorianToJd(2000, 2, 29);
        $this->assertTrue(is_finite($jd));
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_year_overflow(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(PHP_INT_MAX, 1, 1);
    }
    /**
     * @return void
     */
    public function test_gregorianToJd_rejects_jd_without_one_second_resolution(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::gregorianToJd(1000000000, 1, 1);
    }
    /**
     * @return void
     */
    public function test_jdToGregorianYmd_rejects_nan(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::jdToGregorianYmd(NAN);
    }
    /**
     * @return void
     */
    public function test_jdToGregorianYmd_rejects_inf(): void
    {
        $this->expectException(InvalidArgumentException::class);
        MeeusMoon::jdToGregorianYmd(INF);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_rejects_invalid_date(): void
    {
        $thrown = false;

        try {
            (new MeeusMoon())->longitudeMoon(2000, 2, 30, 0, 0, 0);
        } catch (InvalidArgumentException $exception) {
            $thrown = true;
        }
        $this->assertTrue($thrown);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_rejects_ut_jd_without_one_second_resolution(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new MeeusMoon())->longitudeMoon(2000, 1, 1, 1.0e20, 0, 0);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_rejects_non_finite_tt_jd(): void
    {
        $meeus = new class () extends MeeusMoon {
            /**
             * @param int $year
             * @param int $month
             * @return float
             */
            public function approximateDeltaTSeconds($year, $month): float
            {
                return INF;
            }
        };

        $this->expectException(InvalidArgumentException::class);
        $meeus->longitudeMoon(2000, 1, 1, 9, 0, 0);
    }
    /**
     * @return void
     */
    public function test_calculateFromJde_rejects_non_finite_result(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new MeeusMoon())->calculateFromJde(PHP_FLOAT_MAX);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_safeFloorToInt_rejects_non_finite_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->invokeExecuteMethod(new MeeusMoon(), 'safeFloorToInt', [NAN]);
    }
    // ==================== 紀元前年・年0 テスト ====================
    /**
     * @return void
     */
    public function test_longitudeMoon_year_zero(): void
    {
        $result = (new MeeusMoon())->longitudeMoon(0, 1, 1, 12, 0, 0);
        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_year_minus_one(): void
    {
        $result = (new MeeusMoon())->longitudeMoon(-1, 1, 1, 12, 0, 0);
        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
    }
    /**
     * @return void
     */
    public function test_longitudeMoon_nasa_delta_t_lower_limit_year(): void
    {
        $result = (new MeeusMoon())->longitudeMoon(-1999, 6, 15, 12, 0, 0);
        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
    }
    // ==================== JST/JDE 境界テスト ====================
    /**
     * @return void
     */
    public function test_jst_0900_equals_ut_0000(): void
    {
        // JST 2000-01-01 09:00:00 = UTC 2000-01-01 00:00:00 = JD(UT) 2451544.5
        $utJd = MeeusMoon::gregorianToJd(2000, 1, 1);
        $this->assertEqualsWithDelta(2451544.5, $utJd, 1e-9);
    }
    /**
     * @return void
     */
    public function test_jst_0000_equals_ut_minus9h(): void
    {
        // JST 2000-01-01 00:00:00 = UTC 1999-12-31 15:00:00
        $utJd = MeeusMoon::gregorianToJd(2000, 1, 1) + (0 - 9.0 * 3600) / 86400.0;
        $this->assertEqualsWithDelta(2451544.125, $utJd, 1e-9);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_longitudeMoon_matches_calculateFromJde(): void
    {
        $meeus = new MeeusMoon();
        $deltaTSec = $this->invokeExecuteMethod($meeus, 'approximateDeltaTSeconds', [2000, 1]);
        $expectedJde = 2451544.5 + $deltaTSec / 86400.0;
        $viaJst = $meeus->longitudeMoon(2000, 1, 1, 9, 0, 0);
        $viaJde = $meeus->calculateFromJde($expectedJde)['apparentLongitude'];
        $this->assertEqualsWithDelta($viaJde, $viaJst, 0.0001);
    }
    // ==================== 小数 hour/min/sec テスト ====================
    /**
     * @return void
     */
    public function test_fractional_hour_matches_min(): void
    {
        $m = new MeeusMoon();
        $this->assertEqualsWithDelta(
            $m->longitudeMoon(2000, 1, 1, 9.5, 0, 0),
            $m->longitudeMoon(2000, 1, 1, 9, 30, 0),
            1e-9
        );
    }
    /**
     * @return void
     */
    public function test_fractional_min_matches_sec(): void
    {
        $m = new MeeusMoon();
        $this->assertEqualsWithDelta(
            $m->longitudeMoon(2000, 1, 1, 9, 30.5, 0),
            $m->longitudeMoon(2000, 1, 1, 9, 30, 30),
            1e-9
        );
    }
    /**
     * @return void
     */
    public function test_all_fractional_elements_convert_to_total_seconds(): void
    {
        $m = new MeeusMoon();
        $result1 = $m->longitudeMoon(2000, 1, 1, 9.125, 15.5, 30.25);
        $totalSec = 9.125 * 3600 + 15.5 * 60 + 30.25;
        $result2 = $m->longitudeMoon(2000, 1, 1, 0, 0, $totalSec);
        $this->assertEqualsWithDelta($result1, $result2, 1e-9);
    }
    /**
     * @return void
     */
    public function test_hour_24_equals_next_day_hour_0(): void
    {
        $m = new MeeusMoon();
        $this->assertEqualsWithDelta(
            $m->longitudeMoon(2000, 1, 1, 24, 0, 0),
            $m->longitudeMoon(2000, 1, 2, 0, 0, 0),
            1e-9
        );
    }
    // ==================== calculateFromJde / 物理範囲テスト ====================
    /**
     * @return void
     */
    public function test_calculateFromJde_meeus_example_47a(): void
    {
        $result = (new MeeusMoon())->calculateFromJde(2448724.5);
        $this->assertEqualsWithDelta(133.167, $result['apparentLongitude'], 0.001);
        $this->assertEqualsWithDelta(-3.229, $result['latitude'], 0.001);
        $this->assertEqualsWithDelta(368409.7, $result['distanceKm'], 0.1);
    }
    /**
     * @return array[]
     */
    public static function physicalRangeJdeProvider(): array
    {
        return [
            'J2000' => [2451545.0],
            '2012-01-01' => [2455927.5],
            '2025-01-01' => [2460676.5],
        ];
    }
    /**
     * @param float $jde
     * @return void
     * @dataProvider physicalRangeJdeProvider
     */
    public function test_calculateFromJde_physical_range($jde): void
    {
        $result = (new MeeusMoon())->calculateFromJde($jde);
        $this->assertGreaterThanOrEqual(0.0, $result['apparentLongitude']);
        $this->assertLessThan(360.0, $result['apparentLongitude']);
        $this->assertGreaterThan(-6.5, $result['latitude']);
        $this->assertLessThan(6.5, $result['latitude']);
        $this->assertGreaterThan(356000, $result['distanceKm']);
        $this->assertLessThan(407000, $result['distanceKm']);
    }
    /**
     * @return array[]
     */
    public static function extremeJdeProvider(): array
    {
        return [
            'ancient JD' => [1700000.0],
            'far future' => [2900000.0],
        ];
    }
    /**
     * @param float $jde
     * @return void
     * @dataProvider extremeJdeProvider
     */
    public function test_calculateFromJde_extreme_jde_returns_finite($jde): void
    {
        $r = (new MeeusMoon())->calculateFromJde($jde);
        $this->assertTrue(is_finite($r['apparentLongitude']));
        $this->assertTrue(is_finite($r['latitude']));
        $this->assertTrue(is_finite($r['distanceKm']));
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_computeGeometricPosition_example_47a(): void
    {
        $meeus = new MeeusMoon();
        $t = (2448724.5 - 2451545.0) / 36525.0;
        $geom = $this->invokeExecuteMethod($meeus, 'computeGeometricPosition', [$t]);
        $this->assertEqualsWithDelta(133.162655, $geom['lon'], 0.0001);
        $this->assertEqualsWithDelta(-3.229126, $geom['lat'], 0.0001);
        $this->assertEqualsWithDelta(368409.7, $geom['dist'], 0.1);
    }
    // ==================== アルゴリズム切替・キャッシュキー分離 ====================
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_factory_uses_meeus47_when_selected(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47);
            $ast = Astronomy::factory();
            $impl = $this->invokeGetProperty($ast, 'moonAlgorithmImpl');
            $this->assertInstanceOf(MeeusMoon::class, $impl);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_factory_uses_meeus47_no_c_when_selected(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47_NO_C);
            $ast = Astronomy::factory();
            $impl = $this->invokeGetProperty($ast, 'moonAlgorithmImpl');
            $this->assertInstanceOf(MeeusMoon::class, $impl);
            $this->assertSame('meeus47_no_c', $impl->moonAlgorithmName());
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_meeus47_and_no_c_produce_different_instances(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47);
            $ast1 = Astronomy::factory();

            $this->invokeSetProperty(Astronomy::class, 'instances', []);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_MEEUS47_NO_C);
            $ast2 = Astronomy::factory();

            $this->assertNotSame($ast1, $ast2, 'c補正あり/なしで別インスタンス');
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
    // ==================== 受入条件: factory()->longitudeMoon と直接 MeeusMoon の一致 ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \ReflectionException
     */
    public function test_factory_longitudeMoon_matches_direct_MeeusMoon(): void
    {
        foreach ([
            [Astronomy::MOON_MEEUS47, true],
            [Astronomy::MOON_MEEUS47_NO_C, false],
        ] as [$constant, $applyC]) {
            try {
                Astronomy::useMoonAlgorithm($constant);
                $this->invokeSetProperty(Astronomy::class, 'instances', []);
                $viaFactory = Astronomy::factory()->longitudeMoon(2024, 6, 1, 12, 0, 0);
                $direct = (new Astronomy(null, new MeeusMoon($applyC)))
                    ->longitudeMoon(2024, 6, 1, 12, 0, 0);
                $this->assertEqualsWithDelta(
                    $direct,
                    $viaFactory,
                    1e-9,
                    "factory()->longitudeMoon と直接 MeeusMoon($applyC) が一致"
                );
            } finally {
                Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
                $this->invokeSetProperty(Astronomy::class, 'instances', []);
            }
        }
    }
}
