<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Contracts\SunAlgorithm;
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 *
 */
/**
 *
 * @covers \JapaneseDate\Components\Vsop87Astronomy
 */
class Vsop87AstronomyTest extends TestCase
{
    use InvokeTrait;
    /**
     * NASA/JPL Horizons observer table, Sun (10) from Earth geocenter (500@399).
     *
     * Query settings:
     *   EPHEM_TYPE=OBSERVER, QUANTITIES=31, CSV_FORMAT=YES
     *   Quantity 31: apparent observer-centered ecliptic-of-date longitude.
     *
     * Horizons times are UTC. The library's VSOP87 solar longitude API accepts
     * the existing JapaneseDate local-time convention, so 09:00 JST is used for
     * 00:00 UTC comparisons.
     */
    public static function jplHorizonsApparentSolarLongitudeProvider(): array
    {
        return [
            'J2000 nearby' => [2000, 1, 1, 9.0, 279.8592049],
            '2021 beginning of spring boundary' => [2021, 2, 3, 23.0 + 59.0 / 60.0, 315.0001306],
            '2024 vernal equinox season' => [2024, 3, 20, 9.0, 359.8713785],
            '2024 summer solstice season' => [2024, 6, 21, 9.0, 90.1251964],
            '2024 autumn equinox season' => [2024, 9, 22, 9.0, 179.4812912],
            '2024 winter solstice season' => [2024, 12, 21, 9.0, 269.6036200],
        ];
    }
    /**
     * @return void
     */
    public function test_algorithmNameReturnsVsop87(): void
    {
        $vsop87 = new Vsop87Astronomy();
        $this->assertSame(Astronomy::SOLAR_VSOP87, $vsop87->sunAlgorithmName());
        /** @noinspection PhpConditionAlreadyCheckedInspection — SunAlgorithmインターフェース実装の明示的な実行時確認 */
        $this->assertInstanceOf(SunAlgorithm::class, $vsop87);
        $this->assertNotInstanceOf(Astronomy::class, $vsop87);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_approximateDeltaTSecondsUsesFutureFormulaFrom2050(): void
    {
        $deltaT = $this->invokeExecuteMethod(
            new Vsop87Astronomy(),
            'approximateDeltaTSeconds',
            [2050, 1]
        );

        $this->assertEqualsWithDelta(93.08, $deltaT, 0.01);
    }
    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param float $hour
     * @param float $expectedLongitude
     * @return void
     * @dataProvider jplHorizonsApparentSolarLongitudeProvider
     */
    public function test_longitudeSunMatchesJplHorizonsApparentSolarLongitude($year, $month, $day, $hour, $expectedLongitude): void
    {
        $actualLongitude = (new Vsop87Astronomy())->longitudeSun($year, $month, $day, $hour, 0.0, 0.0);
        $this->assertEqualsWithDelta($expectedLongitude, $actualLongitude, 0.0005);
    }
    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param float $hour
     * @param float $expectedLongitude
     * @return void
     * @dataProvider jplHorizonsApparentSolarLongitudeProvider
     */
    public function test_longitudeSunAlwaysReturnsNormalizedAngle($year, $month, $day, $hour, $expectedLongitude): void
    {
        $longitude = (new Vsop87Astronomy())->longitudeSun($year, $month, $day, $hour, 0.0, 0.0);
        $this->assertGreaterThanOrEqual(0.0, $longitude);
        $this->assertLessThan(360.0, $longitude);
    }
}
