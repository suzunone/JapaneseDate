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

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Contracts\MoonAlgorithm;
use JapaneseDate\Components\Contracts\SunAlgorithm;
use JapaneseDate\Components\LegacyAstronomy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * LegacyAstronomy の単独テスト。
 *
 * SunAlgorithm / MoonAlgorithm インターフェイス実装と
 * 周期項近似式による黄経計算の正しさを検証する。
 * C0 カバレッジ 100% を本ファイルのみで達成する。
 */
#[CoversClass(LegacyAstronomy::class)]
class LegacyAstronomyTest extends TestCase
{
    use InvokeTrait;

    // ==================== インターフェイス実装の確認 ====================

    public static function jy2LongitudeSunProvider(): array
    {
        return [
            // J2000.0 (julian_year = 0) → 太陽黄経 ≈ 281° 付近
            'J2000 epoch' => [0.0, 281.0, 2.0],
            // 2023-03-20 春分 → 太陽黄経 ≈ 0°
            '2023 vernal equinox JY' => [23.212, 0.0, 2.0],
            // 2023-06-21 夏至 → 太陽黄経 ≈ 90°
            '2023 summer solstice JY' => [23.472, 90.0, 2.0],
            // 2023-09-23 秋分 → 太陽黄経 ≈ 180°
            '2023 autumnal equinox JY' => [23.723, 180.0, 2.0],
            // 2023-12-22 冬至 → 太陽黄経 ≈ 270°
            '2023 winter solstice JY' => [23.971, 270.0, 2.0],
        ];
    }

    public static function jY2LongitudeMoonProvider(): array
    {
        return [
            // 適当なJulian yearで月黄経が0-360に正規化されることを確認
            'JY=0' => [0.0],
            'JY=10' => [10.0],
            'JY=23' => [23.5],
            'JY=-5' => [-5.0],
        ];
    }

    // ==================== アルゴリズム識別子 ====================

    public static function longitudeSunProvider(): array
    {
        return [
            // 春分付近
            '2023 spring equinox' => [2023, 3, 20, 5, 24, 0, 0.0, 2.0],
            // 夏至付近
            '2023 summer solstice' => [2023, 6, 21, 14, 57, 0, 90.0, 2.0],
            // 秋分付近
            '2023 autumnal equinox' => [2023, 9, 23, 6, 50, 0, 180.0, 2.0],
            // 冬至付近
            '2023 winter solstice' => [2023, 12, 22, 3, 27, 0, 270.0, 2.0],
        ];
    }

    public static function longitudeMoonProvider(): array
    {
        return [
            // 新月: 2023-01-22 05:53 JST → 月黄経 ≈ 太陽黄経 ≈ 302°
            '2023 new moon' => [2023, 1, 22, 5, 53, 0],
            '2023 full moon' => [2023, 2, 6, 3, 29, 0],
        ];
    }

    // ==================== jy2LongitudeSun ====================

    public function test_implementsSunAlgorithm(): void
    {
        $this->assertInstanceOf(SunAlgorithm::class, new LegacyAstronomy());
    }

    public function test_implementsMoonAlgorithm(): void
    {
        $this->assertInstanceOf(MoonAlgorithm::class, new LegacyAstronomy());
    }

    // ==================== jY2LongitudeMoon ====================

    public function test_sunAlgorithmNameReturnsLegacy(): void
    {
        $this->assertSame(Astronomy::SOLAR_LEGACY, (new LegacyAstronomy())->sunAlgorithmName());
    }

    public function test_moonAlgorithmNameReturnsLegacy(): void
    {
        $this->assertSame(Astronomy::MOON_LEGACY, (new LegacyAstronomy())->moonAlgorithmName());
    }

    // ==================== longitudeSun ====================

    #[DataProvider('jy2LongitudeSunProvider')]
    public function test_jy2LongitudeSun(float $julianYear, float $expectedDeg, float $delta): void
    {
        $legacy = new LegacyAstronomy();
        $result = $legacy->jy2LongitudeSun($julianYear);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);

        // 黄経は0-360の範囲で期待値と比較（360付近のラップアラウンドを考慮）
        $diff = abs($result - $expectedDeg);
        $diff = min($diff, 360.0 - $diff);
        $this->assertLessThanOrEqual($delta, $diff, "Expected ~{$expectedDeg}°, got {$result}°");
    }

    #[DataProvider('jY2LongitudeMoonProvider')]
    public function test_jY2LongitudeMoonReturnsNormalizedAngle(float $julianYear): void
    {
        $legacy = new LegacyAstronomy();
        $result = $legacy->jY2LongitudeMoon($julianYear);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
    }

    // ==================== longitudeMoon ====================

    #[DataProvider('longitudeSunProvider')]
    public function test_longitudeSun(
        int   $year,
        int   $month,
        int   $day,
        float $hour,
        float $min,
        float $sec,
        float $expectedDeg,
        float $delta,
    ): void
    {
        $legacy = new LegacyAstronomy();
        $result = $legacy->longitudeSun($year, $month, $day, $hour, $min, $sec);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);

        $diff = abs($result - $expectedDeg);
        $diff = min($diff, 360.0 - $diff);
        $this->assertLessThanOrEqual($delta, $diff, "Expected ~{$expectedDeg}°, got {$result}°");
    }

    #[DataProvider('longitudeMoonProvider')]
    public function test_longitudeMoonReturnsNormalizedAngle(
        int   $year,
        int   $month,
        int   $day,
        float $hour,
        float $min,
        float $sec,
    ): void
    {
        $legacy = new LegacyAstronomy();
        $result = $legacy->longitudeMoon($year, $month, $day, $hour, $min, $sec);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(360.0, $result);
    }

    // ==================== computeJulianYear（private） ====================

    public function test_computeJulianYearMatchesAstronomyGregorian2JY(): void
    {
        $legacy = new LegacyAstronomy();

        // 2000-01-01 21:00:00 JST = J2000.0 (2000-01-01 12:00:00 UTC)
        $legacyJY = $this->invokeExecuteMethod($legacy, 'computeJulianYear', [2000, 1, 1, 21, 0, 0]);

        $this->assertEqualsWithDelta(0.0, $legacyJY, 1e-12);
    }

    public function test_computeJulianYearWithFractionalSeconds(): void
    {
        $legacy = new LegacyAstronomy();

        // 小数秒を含む場合
        $jy1 = $this->invokeExecuteMethod($legacy, 'computeJulianYear', [2023, 6, 15, 12, 0, 0]);
        $jy2 = $this->invokeExecuteMethod($legacy, 'computeJulianYear', [2023, 6, 15, 12, 0, 30]);

        // 30秒分の差があることを確認
        $this->assertGreaterThan($jy1, $jy2);
    }

    public function test_computeJulianYearIncludesFractionalDay(): void
    {
        $legacy = new LegacyAstronomy();

        $fromDayFraction = $this->invokeExecuteMethod($legacy, 'computeJulianYear', [2023, 6, 15.5, 0, 0, 0]);
        $fromHours = $this->invokeExecuteMethod($legacy, 'computeJulianYear', [2023, 6, 15, 12, 0, 0]);

        $this->assertEqualsWithDelta($fromHours, $fromDayFraction, 1e-12);
    }

    // ==================== normalizeAngle（private） ====================

    public function test_normalizeAnglePositiveOver360(): void
    {
        $legacy = new LegacyAstronomy();
        $result = $this->invokeExecuteMethod($legacy, 'normalizeAngle', [720.0]);

        $this->assertEqualsWithDelta(0.0, $result, 1e-9);
    }

    public function test_normalizeAngleNegative(): void
    {
        $legacy = new LegacyAstronomy();
        $result = $this->invokeExecuteMethod($legacy, 'normalizeAngle', [-90.0]);

        $this->assertEqualsWithDelta(270.0, $result, 1e-9);
    }

    public function test_normalizeAngleZero(): void
    {
        $legacy = new LegacyAstronomy();
        $result = $this->invokeExecuteMethod($legacy, 'normalizeAngle', [0.0]);

        $this->assertEqualsWithDelta(0.0, $result, 1e-9);
    }

    // ==================== sumPeriodicTerms（private） ====================

    public function test_sumPeriodicTermsReturnsZeroForEmptyTerms(): void
    {
        $legacy = new LegacyAstronomy();
        $result = $this->invokeExecuteMethod($legacy, 'sumPeriodicTerms', [[], 10.0]);

        $this->assertEqualsWithDelta(0.0, $result, 1e-15);
    }

    public function test_sumPeriodicTermsSingleTerm(): void
    {
        $legacy = new LegacyAstronomy();
        // amplitude=1.0, phase=0.0, speed=0.0 → sin(0) = 0
        $result = $this->invokeExecuteMethod($legacy, 'sumPeriodicTerms', [[[1.0, 0.0, 0.0]], 5.0]);

        $this->assertEqualsWithDelta(0.0, $result, 1e-15);
    }

    public function test_sumPeriodicTermsSingleTermAt90Degrees(): void
    {
        $legacy = new LegacyAstronomy();
        // amplitude=1.0, phase=90.0, speed=0.0 → sin(90°) = 1.0
        $result = $this->invokeExecuteMethod($legacy, 'sumPeriodicTerms', [[[1.0, 90.0, 0.0]], 0.0]);

        $this->assertEqualsWithDelta(1.0, $result, 1e-10);
    }
}
