<?php

namespace Tests\JapaneseDate;

use Generator;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\TestCase;

/**
 * No methods should be added except dataProvider and testDateTime.
 * Only dataProvider and testDateTime methods are allowed to be added.
 * - Exclude this test by default due to its heavy load.
 * - Use paratest whenever executing this test.
 */
#[CoversNothing]
#[Large]
#[Group('long-running')]
class DateTimeFixtureTest extends TestCase
{
    private const MOON_AGE_CYCLE_DAYS = 29.53058868;

    private const MOON_AGE_DELTA_DAYS = 0.47;

    private const MOON_PHASE_ANGLE_DELTA_DEGREES = 9.0;

    private const INTERMEDIATE_MOON_PHASES = [
        DateTime::MOON_PHASE_MIKAZUKI,
        DateTime::MOON_PHASE_JUUSANYA,
        DateTime::MOON_PHASE_IZAYOI,
        DateTime::MOON_PHASE_ARIAKE,
    ];

    private string $originalTimezone;

    /**
     * @return \Generator
     */
    public static function dataProvider(): Generator
    {
        $files = glob(dirname(__DIR__, 2) . '/fixtures/*.php');

        foreach ($files as $file) {
            $data = include $file;
            foreach ($data as $key => $param) {
                yield $key => $param;
            }
        }
    }

    /**
     * @param string $date_text
     * @param array $expected
     * @return void
     */
    #[DataProvider('dataProvider')]
    public function testDateTime(string $date_text, array $expected): void
    {
        try {
            $algorithms = [
                // [solar, moon, boundary_solar, boundary_moon]
                [DateTime::SOLAR_ALGORITHM_VSOP87, DateTime::MOON_ALGORITHM_MEEUS47,
                 DateTime::SOLAR_ALGORITHM_VSOP87, DateTime::MOON_ALGORITHM_MEEUS47],
                [DateTime::SOLAR_ALGORITHM_LEGACY,  DateTime::MOON_ALGORITHM_LEGACY,
                 DateTime::SOLAR_ALGORITHM_VSOP87, DateTime::MOON_ALGORITHM_MEEUS47],
                [DateTime::SOLAR_ALGORITHM_VSOP87, DateTime::MOON_ALGORITHM_ELP2000,
                    DateTime::SOLAR_ALGORITHM_VSOP87, DateTime::MOON_ALGORITHM_ELP2000],
            ];
            $expectedMoonAge = $expected['moon_age'];
            $expectedPhaseAngle = $expected['moon_phase_angle'];

            foreach ($algorithms as [$solarAlgorithm, $moonAlgorithm, $boundarySolarAlgorithm, $boundaryMoonAlgorithm]) {
                DateTime::useSolarAlgorithm($solarAlgorithm);
                DateTime::useMoonAlgorithm($moonAlgorithm);
                DateTime::useBoundarySolarAlgorithm($boundarySolarAlgorithm);
                DateTime::useBoundaryMoonAlgorithm($boundaryMoonAlgorithm);

                $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_text);
                $actual = $date->toArray();
                $expectedComparable = $expected;

                $moonAgeDelta = fmod(
                    abs($actual['moon_age'] - $expectedMoonAge),
                    self::MOON_AGE_CYCLE_DAYS
                );
                $moonAgeDelta = min($moonAgeDelta, self::MOON_AGE_CYCLE_DAYS - $moonAgeDelta);
                $this->assertLessThanOrEqual(
                    self::MOON_AGE_DELTA_DAYS,
                    $moonAgeDelta,
                    "$solarAlgorithm/$moonAlgorithm(boundary:$boundarySolarAlgorithm/$boundaryMoonAlgorithm) moon age: $date_text"
                );

                $phaseAngleDelta = abs($actual['moon_phase_angle'] - $expectedPhaseAngle);
                $phaseAngleDelta = min($phaseAngleDelta, 360.0 - $phaseAngleDelta);
                $this->assertLessThanOrEqual(
                    self::MOON_PHASE_ANGLE_DELTA_DEGREES,
                    $phaseAngleDelta,
                    "$solarAlgorithm/$moonAlgorithm(boundary:$boundarySolarAlgorithm/$boundaryMoonAlgorithm) moon phase angle: $date_text"
                );

                $expectedPhase = $expectedComparable['moon_phase'];
                $actualPhase = $actual['moon_phase'];
                $ignoreIntermediatePhaseDate = in_array(
                    $expectedPhase,
                    self::INTERMEDIATE_MOON_PHASES,
                    true
                ) || (
                    $expectedPhase === null
                    && in_array($actualPhase, self::INTERMEDIATE_MOON_PHASES, true)
                );

                unset(
                    $expectedComparable['timezone'],
                    $expectedComparable['moon_age'],
                    $expectedComparable['moon_phase_angle'],
                    $actual['timezone'],
                    $actual['moon_age'],
                    $actual['moon_phase_angle'],
                );
                if ($ignoreIntermediatePhaseDate) {
                    unset(
                        $expectedComparable['moon_phase'],
                        $expectedComparable['moon_phase_text'],
                        $actual['moon_phase'],
                        $actual['moon_phase_text'],
                    );
                }
                $this->assertSame($expectedComparable, $actual);
            }
        } finally {
            DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
            DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
            DateTime::useBoundarySolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
            DateTime::useBoundaryMoonAlgorithm(DateTime::MOON_ALGORITHM_MEEUS47);
        }
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->originalTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Tokyo');
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        date_default_timezone_set($this->originalTimezone);
    }
}
