<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vsop87Astronomy::class)]
class Vsop87AstronomyTest extends TestCase
{
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
            '2024 vernal equinox season' => [2024, 3, 20, 9.0, 359.8713785],
            '2024 summer solstice season' => [2024, 6, 21, 9.0, 90.1251964],
            '2024 autumn equinox season' => [2024, 9, 22, 9.0, 179.4812912],
            '2024 winter solstice season' => [2024, 12, 21, 9.0, 269.6036200],
        ];
    }

    public function test_algorithmNameReturnsVsop87(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);

            $this->assertSame(Astronomy::SOLAR_VSOP87 . ':' . Astronomy::MOON_LEGACY, (new Vsop87Astronomy())->algorithmName());
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }

    #[DataProvider('jplHorizonsApparentSolarLongitudeProvider')]
    public function test_longitudeSunMatchesJplHorizonsApparentSolarLongitude(
        int $year,
        int $month,
        int $day,
        float $hour,
        float $expectedLongitude
    ): void {
        $actualLongitude = (new Vsop87Astronomy())->longitudeSun($year, $month, $day, $hour, 0.0, 0.0);

        $this->assertEqualsWithDelta($expectedLongitude, $actualLongitude, 0.002);
    }

    #[DataProvider('jplHorizonsApparentSolarLongitudeProvider')]
    public function test_longitudeSunAlwaysReturnsNormalizedAngle(
        int $year,
        int $month,
        int $day,
        float $hour,
        float $expectedLongitude
    ): void {
        $longitude = (new Vsop87Astronomy())->longitudeSun($year, $month, $day, $hour, 0.0, 0.0);

        $this->assertGreaterThanOrEqual(0.0, $longitude);
        $this->assertLessThan(360.0, $longitude);
    }
}
