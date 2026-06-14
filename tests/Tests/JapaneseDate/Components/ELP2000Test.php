<?php

namespace Tests\JapaneseDate\Components;

use BadMethodCallException;
use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\ELP2000;
/** @noinspection PhpUndefinedClassInspection */
use JapaneseDate\Components\Traits\ELP2000Sub;
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * ELP2000-82B 移植用テスト。
 *
 * 天文データ出典:
 * - USNO Astronomical Applications Department "Dates of Primary Phases of the Moon"
 *   https://aa.usno.navy.mil/data/MoonPhases
 * - elp2000-82b.js の getPosition() コメントに記載されたサンプル値
 *
 * ELP2000.php がスケルトンの間は未実装例外を Incomplete として扱い、
 * 実装後に同じテストが実データ検証として動くようにしている。
 */
/** @noinspection PhpUndefinedClassInspection
 * @covers \JapaneseDate\Components\ELP2000
 * @covers \JapaneseDate\Components\Traits\ELP2000Sub */
class ELP2000Test extends TestCase
{
    use InvokeTrait;
    /**
     * 移植元 JS コメント:
     *   ELP82b.getPosition(2451555.5)
     *   [382979.7604730463, -68204.20174530084, -25987.71602589964]
     */
    public static function positionProvider(): array
    {
        return [
            'original js reference' => [
                '2451555.5',
                382979.7604730463,
                -68204.20174530084,
                -25987.71602589964,
                0.001,
            ],
        ];
    }
    /**
     * @return array[]
     */
    public static function scaleProvider(): array
    {
        return [
            'default-ish precision' => [30, 40],
            'high precision' => [50, 80],
            'integer-only edge' => [0, 10],
        ];
    }
    /**
     * @return \int[][]
     */
    public static function invalidScaleProvider(): array
    {
        return [
            'minus one' => [-1],
            'large negative' => [-100],
        ];
    }
    /**
     * @return array[]
     */
    public static function invalidJulianDateProvider(): array
    {
        return [
            'plain text' => ['not-a-julian-date'],
            'empty string' => [''],
            'whitespace' => ['   '],
        ];
    }
    /**
     * USNO Astronomical Applications Department:
     * "Dates of Primary Phases of the Moon" の New Moon (Universal Time)。
     *
     * 参照例:
     * - https://aa.usno.navy.mil/calculated/moon/phases?date=2023-03-07&format=p&nump=50&submit=Get+Data
     * - https://aa.usno.navy.mil/calculated/moon/phases?date=2025-03-21&format=p&nump=50&submit=Get+Data
     * - https://aa.usno.navy.mil/calculated/moon/phases?date=2026-01-01&format=t&nump=50&submit=Get+Data
     *
     * 2023-2026 から、通常月・UTC日付境界付近・JST日付境界付近を混ぜている。
     */
    public static function newMoonProvider(): array
    {
        return [
            '2023 Mar new moon' => ['2023-03-21 17:23:00', '2023-03-22 02:23', 3.0],
            '2023 Apr new moon solar eclipse month' => ['2023-04-20 04:12:00', '2023-04-20 13:12', 3.0],
            '2023 May new moon near JST midnight' => ['2023-05-19 15:53:00', '2023-05-20 00:53', 3.0],
            '2023 Dec new moon near UTC midnight' => ['2023-12-12 23:32:00', '2023-12-13 08:32', 3.0],
            '2024 Jan new moon' => ['2024-01-11 11:57:00', '2024-01-11 20:57', 3.0],
            '2024 Apr new moon solar eclipse month' => ['2024-04-08 18:21:00', '2024-04-09 03:21', 3.0],
            '2024 Dec new moon near UTC midnight' => ['2024-12-30 22:27:00', '2024-12-31 07:27', 3.0],
            '2025 Mar new moon' => ['2025-03-29 10:58:00', '2025-03-29 19:58', 3.0],
            '2025 Jul new moon near JST early morning' => ['2025-07-24 19:11:00', '2025-07-25 04:11', 3.0],
            '2025 Dec new moon near UTC midnight' => ['2025-12-20 01:43:00', '2025-12-20 10:43', 3.0],
            '2026 Mar new moon near UTC midnight' => ['2026-03-19 01:23:00', '2026-03-19 10:23', 3.0],
            '2026 Oct new moon near JST midnight' => ['2026-10-10 15:50:00', '2026-10-11 00:50', 3.0],
            '2026 Dec new moon near UTC midnight' => ['2026-12-09 00:52:00', '2026-12-09 09:52', 3.0],
        ];
    }
    /**
     * 日付変更付近の境界テスト用。特に JST 00時台と UTC 00時台/23時台を選ぶ。
     */
    public static function newMoonBoundaryProvider(): array
    {
        return [
            '2023 May JST midnight boundary' => ['2023-05-19 15:53:00', '2023-05-20 00:53', 30],
            '2023 Dec UTC midnight boundary' => ['2023-12-12 23:32:00', '2023-12-13 08:32', 30],
            '2024 Dec UTC midnight boundary' => ['2024-12-30 22:27:00', '2024-12-31 07:27', 30],
            '2026 Oct JST midnight boundary' => ['2026-10-10 15:50:00', '2026-10-11 00:50', 30],
            '2026 Dec UTC midnight boundary' => ['2026-12-09 00:52:00', '2026-12-09 09:52', 30],
        ];
    }
    /**
     * @param string $julianDate
     * @param float $expectedX
     * @param float $expectedY
     * @param float $expectedZ
     * @param float $delta
     * @return void
     * @dataProvider positionProvider
     */
    public function test_getPosition_matchesOriginalJavaScriptReferenceExample(string $julianDate, float $expectedX, float $expectedY, float $expectedZ, float $delta): void
    {
        $elp = new ELP2000(30);
        $position = $this->callOrMarkIncomplete(
            static fn () => $elp->getPosition($julianDate)
        );
        $this->assertCount(3, $position);
        $this->assertEqualsWithDelta($expectedX, $position[0], $delta);
        $this->assertEqualsWithDelta($expectedY, $position[1], $delta);
        $this->assertEqualsWithDelta($expectedZ, $position[2], $delta);
    }
    /**
     * @param callable $callback
     * @return mixed
     */
    private function callOrMarkIncomplete(callable $callback): mixed
    {
        try {
            return $callback();
        } catch (BadMethodCallException $exception) {
            $this->markTestIncomplete($exception->getMessage());
        }
    }
    /**
     * @param string $julianDate
     * @param float $expectedX
     * @param float $expectedY
     * @param float $expectedZ
     * @param float $delta
     * @return void
     * @dataProvider positionProvider
     */
    public function test_getPrecisePosition_matchesOriginalJavaScriptReferenceExample(string $julianDate, float $expectedX, float $expectedY, float $expectedZ, float $delta): void
    {
        $elp = new ELP2000(30);
        $position = $this->callOrMarkIncomplete(
            static fn () => $elp->getPrecisePosition($julianDate)
        );
        $this->assertCount(3, $position);
        foreach ($position as $component) {
            $this->assertIsString($component);
            $this->assertIsNumeric($component);
        }
        $this->assertEqualsWithDelta($expectedX, (float) $position[0], $delta);
        $this->assertEqualsWithDelta($expectedY, (float) $position[1], $delta);
        $this->assertEqualsWithDelta($expectedZ, (float) $position[2], $delta);
    }
    /**
     * @param int $initialScale
     * @param int $nextScale
     * @return void
     * @dataProvider scaleProvider
     */
    public function test_scale_canBeConfiguredForBcmathCalculations(int $initialScale, int $nextScale): void
    {
        $elp = new ELP2000($initialScale);
        $this->assertSame($initialScale, $elp->scale());
        $this->assertSame($elp, $elp->setScale($nextScale));
        $this->assertSame($nextScale, $elp->scale());
    }
    /**
     * @param int $scale
     * @return void
     * @dataProvider invalidScaleProvider
     */
    public function test_scaleRejectsNegativeValue(int $scale): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('BCMath scale must be greater than or equal to 0.');
        new ELP2000($scale);
    }
    /**
     * @return void
     */
    public function test_setScaleRejectsNegativeValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('BCMath scale must be greater than or equal to 0.');

        (new ELP2000())->setScale(-1);
    }
    /**
     * @return void
     */
    public function test_moonAlgorithmNameReturnsElp2000(): void
    {
        $this->assertSame(Astronomy::MOON_ELP2000, (new ELP2000())->moonAlgorithmName());
    }
    /**
     * @return void
     * @throws \ReflectionException
     * @throws \Exception
     * @throws \Exception
     */
    public function test_longitudeMoonConvertsJstToTdbJulianDateWithFractionalSeconds(): void
    {
        $elp = new class () extends ELP2000 {
            public int|float|string|null $julianDate = null;

            /**
             * @param int|float|string $julianDate
             * @return string
             */
            public function preciseLongitude(int|float|string $julianDate): string
            {
                $this->julianDate = $julianDate;

                return '123.456';
            }
        };

        $year = 2024;
        $month = 4;
        $day = 8;
        $hour = 18.0;
        $minute = 21.0;
        $second = 30.5;

        $longitude = $elp->longitudeMoon($year, $month, $day, $hour, $minute, $second);

        $timestamp = (new DateTimeImmutable(
            '2024-04-08 18:21:30',
            new DateTimeZone('UTC')
        ))->getTimestamp();
        $deltaT = $this->invokeExecuteMethod($elp, 'approximateDeltaTSeconds', [$year, $month]);
        $expectedJulianDate = $timestamp / 86400.0
            + 2440587.5
            + 0.5 / 86400.0
            - 0.375
            + $deltaT / 86400.0;

        $this->assertSame(123.456, $longitude);
        $this->assertIsString($elp->julianDate);
        $this->assertEqualsWithDelta($expectedJulianDate, (float) $elp->julianDate, 1e-10);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_approximateDeltaTSecondsUsesFutureFormulaFrom2050(): void
    {
        $elp = new ELP2000();
        $year = 2100;
        $month = 6;
        $y = $year + ($month - 0.5) / 12.0;
        $u = ($y - 1820.0) / 100.0;
        $expected = -20.0 + 32.0 * $u * $u - 0.5628 * (2150.0 - $y);

        $result = $this->invokeExecuteMethod($elp, 'approximateDeltaTSeconds', [$year, $month]);

        $this->assertEqualsWithDelta($expected, $result, 1e-12);
    }
    /**
     * @return void
     */
    public function test_publicLongitudeLatitudeAndDistanceApisReturnFloatsAndNumericStrings(): void
    {
        $elp = new ELP2000(30);
        $julianDate = 2451555.5;

        $longitude = $elp->longitude($julianDate);
        $latitude = $elp->latitude($julianDate);
        $preciseLatitude = $elp->preciseLatitude($julianDate);
        $distance = $elp->distance($julianDate);
        $preciseDistance = $elp->preciseDistance($julianDate);

        $this->assertIsFloat($longitude);
        $this->assertGreaterThanOrEqual(0.0, $longitude);
        $this->assertLessThan(360.0, $longitude);
        $this->assertIsFloat($latitude);
        $this->assertIsString($preciseLatitude);
        $this->assertIsNumeric($preciseLatitude);
        $this->assertIsFloat($distance);
        $this->assertIsString($preciseDistance);
        $this->assertIsNumeric($preciseDistance);
    }
    /**
     * @return void
     */
    public function test_preciseLongitudeNormalizesNegativeLongitude(): void
    {
        $elp = new class () extends ELP2000 {
            /**
             * @noinspection PhpUnused — preciseLongitude() 内部から委譲呼び出しされる
             * @param string $t
             * @return float
             */
            protected function computeLongitudeSeries(string $t): float
            {
                return -1000000000.0;
            }
        };

        $longitude = (float) $elp->preciseLongitude('2451545.0');

        $this->assertGreaterThanOrEqual(0.0, $longitude);
        $this->assertLessThan(360.0, $longitude);
    }
    /**
     * @return void
     */
    public function test_scientificNotationJulianDateInputIsAccepted(): void
    {
        $elp = new ELP2000(30);

        $normal = $elp->getPosition('2451555.5');
        $scientific = $elp->getPosition('2.4515555e6');

        $this->assertEqualsWithDelta($normal[0], $scientific[0], 0.001);
        $this->assertEqualsWithDelta($normal[1], $scientific[1], 0.001);
        $this->assertEqualsWithDelta($normal[2], $scientific[2], 0.001);
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_decimalConvertsIntegerToNumericString(): void
    {
        $result = $this->invokeExecuteMethod(new ELP2000(), 'decimal', [2451545]);

        $this->assertSame('2451545', $result);
    }
    /**
     * @param string $julianDate
     * @return void
     * @dataProvider invalidJulianDateProvider
     */
    public function test_invalidJulianDateInputIsRejected(string $julianDate): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ELP2000 numeric value must be numeric');
        (new ELP2000())->preciseLongitude($julianDate);
    }
    /**
     * @return void
     */
    public function test_infiniteFloatJulianDateInputIsRejected(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ELP2000 numeric value must be finite.');

        (new ELP2000())->preciseLongitude(INF);
    }
    /**
     * USNO の朔時刻で、月黄経と太陽黄経の差が 0° 付近になることを確認する。
     *
     * 比較用の太陽黄経は legacy 式の系統誤差を避けるため VSOP87 を使う。
     * ただし VSOP87 実装は見かけ黄経で、ELP2000 の平均黄道面黄経とは完全には一致しないため、
     * ここでは接続テストとして許容誤差を広めに取る。
     * @throws \Exception
     * @dataProvider newMoonProvider
     */
    public function test_preciseLongitude_isNearSolarLongitudeAtUsnoNewMoon(string $utcDateTime, string $jstDateTime, float $allowedDegrees): void
    {
        $elp = new ELP2000(40);
        $moonLongitude = $this->callOrMarkIncomplete(
            static fn () => $elp->preciseLongitude(self::utcToJulianDate($utcDateTime))
        );
        $this->assertIsString($moonLongitude);
        $this->assertIsNumeric($moonLongitude);
        $utc = new DateTimeImmutable($utcDateTime, new DateTimeZone('UTC'));
        $phaseAngle = self::angularDistance((float) $moonLongitude, $this->solarLongitudeAt($utc));
        $this->assertLessThanOrEqual(
            $allowedDegrees,
            $phaseAngle,
            sprintf(
                'USNO 朔 %s UTC (%s JST) で月太陽黄経差が %.6f° でした',
                $utc->format('Y-m-d H:i'),
                $jstDateTime,
                $phaseAngle
            )
        );
    }
    /**
     * @param string $utcDateTime
     * @return string
     * @throws \Exception
     */
    private static function utcToJulianDate(string $utcDateTime): string
    {
        return self::dateTimeToJulianDate(new DateTimeImmutable($utcDateTime, new DateTimeZone('UTC')));
    }
    /**
     * @param \DateTimeImmutable $utc
     * @return string
     */
    private static function dateTimeToJulianDate(DateTimeImmutable $utc): string
    {
        $timestamp = (int) $utc->format('U');

        return sprintf('%.10F', $timestamp / 86400 + 2440587.5);
    }
    /**
     * @param float $left
     * @param float $right
     * @return float
     */
    private static function angularDistance(float $left, float $right): float
    {
        $angle = abs(self::normalizeDegrees($left - $right));

        return min($angle, 360.0 - $angle);
    }
    /**
     * @param float $angle
     * @return float
     */
    private static function normalizeDegrees(float $angle): float
    {
        $normalized = fmod($angle, 360.0);

        return $normalized < 0 ? $normalized + 360.0 : $normalized;
    }
    /**
     * @param \DateTimeImmutable $utc
     * @return float
     */
    private function solarLongitudeAt(DateTimeImmutable $utc): float
    {
        $astronomy = new Vsop87Astronomy();
        $jst = $utc->modify('+9 hours');

        return $astronomy->longitudeSun(
            (int) $jst->format('Y'),
            (int) $jst->format('n'),
            (int) $jst->format('j'),
            (float) $jst->format('G'),
            (float) $jst->format('i'),
            (float) $jst->format('s')
        );
    }
    /**
     * 朔の直前・直後で、月太陽黄経差が 360° 側から 0° 側へ跨ぐことを確認する。
     *
     * 日付変更付近の朔では、JST の暦日判定や旧暦月初判定で境界バグが出やすい。
     * @throws \Exception
     * @dataProvider newMoonBoundaryProvider
     */
    public function test_preciseLongitude_crossesNewMoonBoundaryAroundUsnoNewMoon(string $utcDateTime, string $jstDateTime, int $minutes): void
    {
        $elp = new ELP2000(40);
        $event = new DateTimeImmutable($utcDateTime, new DateTimeZone('UTC'));
        $before = $event->modify('-' . $minutes . ' minutes');
        $after = $event->modify('+' . $minutes . ' minutes');
        $beforePhase = $this->phaseAngleAt($elp, $before);
        $afterPhase = $this->phaseAngleAt($elp, $after);
        $this->assertGreaterThan(
            300.0,
            $beforePhase,
            sprintf('USNO 朔 %s UTC (%s JST) の%d分前が朔前の角度になっていません', $utcDateTime, $jstDateTime, $minutes)
        );
        $this->assertLessThan(
            60.0,
            $afterPhase,
            sprintf('USNO 朔 %s UTC (%s JST) の%d分後が朔後の角度になっていません', $utcDateTime, $jstDateTime, $minutes)
        );
    }
    /**
     * @param \JapaneseDate\Components\ELP2000 $elp
     * @param \DateTimeImmutable $utc
     * @return float
     */
    private function phaseAngleAt(ELP2000 $elp, DateTimeImmutable $utc): float
    {
        $moonLongitude = $this->callOrMarkIncomplete(
            static fn () => $elp->preciseLongitude(self::dateTimeToJulianDate($utc))
        );

        return self::normalizeDegrees((float) $moonLongitude - $this->solarLongitudeAt($utc));
    }
}
