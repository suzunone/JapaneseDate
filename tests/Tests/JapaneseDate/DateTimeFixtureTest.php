<?php

namespace Tests\JapaneseDate;

use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
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
class DateTimeFixtureTest extends TestCase
{
    private string $originalTimezone;

    protected function setUp(): void
    {
        $this->originalTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Tokyo');
    }

    protected function tearDown(): void
    {
        date_default_timezone_set($this->originalTimezone);
    }

    public static function dataProvider()
    {
        $files = glob(dirname(__DIR__, 2) . '/fixtures/*.php');

        foreach ($files as $file) {
            $data = include $file;
            foreach ($data as $key => $param) {
                yield $key => $param;
            }
        }
    }

    #[DataProvider('dataProvider')]
    public function testDateTime($date_text, $expected)
    {
        try {
            DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
            DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);

            $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_text);
            $actual = $date->toArray();
            unset(
                $actual['timezone'],
                $actual['moon_age'],
                $actual['moon_phase_angle'],
                $expected['timezone'],
                $expected['moon_age'],
                $expected['moon_phase_angle'],
            );
            $this->assertSame($expected, $actual, "moon phase angle : {$date->moon_phase_angle}");

            DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_VSOP87);
            DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_ELP2000);

            $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_text);
            $actual = $date->toArray();
            unset(
                $actual['timezone'],
                $actual['moon_age'],
                $actual['moon_phase_angle'],
            );
            $this->assertSame($expected, $actual);
        } finally {
            DateTime::useSolarAlgorithm(DateTime::SOLAR_ALGORITHM_LEGACY);
            DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_LEGACY);
        }
    }
}
