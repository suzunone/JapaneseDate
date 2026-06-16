<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\ELP2000;
use JapaneseDate\Components\Elp2000MoonAge;
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * Elp2000MoonAge の収束残差を同じ太陽・月モデルで診断する。
 */
#[CoversClass(Elp2000MoonAge::class)]
#[CoversMethod(Elp2000MoonAge::class, 'moonAge')]
class Elp2000MoonAgeConvergenceTest extends TestCase
{
    private const SYNODIC_MONTH = 29.530589;

    private const RESIDUAL_LIMIT_DEGREES = 60.0 / 86400.0 * (360.0 / self::SYNODIC_MONTH);

    private const SWEEP_SAMPLE_COUNT = 384;

    /**
     * 既知の朔を含む区間で残差オラクルがゼロ交差を検出できることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[Group('convergence-bug')]
    public function test_residualOracleIsCalibratedNearKnownNewMoon(): void
    {
        $astronomy = $this->makeAstronomy();
        $knownNewMoon = new DateTimeImmutable('2020-12-15 01:17:00', new DateTimeZone('Asia/Tokyo'));
        $modelNewMoonTimestamp = $this->bisectNewMoonTimestamp(
            $astronomy,
            $knownNewMoon->getTimestamp() - 12 * 3600,
            $knownNewMoon->getTimestamp() + 12 * 3600
        );

        $this->assertEqualsWithDelta(
            $knownNewMoon->getTimestamp(),
            $modelNewMoonTimestamp,
            10 * 60,
            'ELP2000/VSOP87 モデルの朔が既知朔の近傍にありません'
        );
        $this->assertLessThanOrEqual(
            self::RESIDUAL_LIMIT_DEGREES,
            abs($this->residualAtTimestamp($astronomy, $modelNewMoonTimestamp)),
            '二分したモデル朔で残差が60秒相当以内になりません'
        );
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function prematureConvergenceProvider(): array
    {
        return [
            '2020 February' => ['2020-02-11 15:00:00'],
            '2020 September' => ['2020-09-06 18:00:00'],
            '2020 October' => ['2020-10-04 12:00:00'],
        ];
    }

    /**
     * 収束判定修正後、朔残差が60秒相当以内に収まることを確認する。
     *
     * @param string $jstDateTime 入力日時（JST）
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[DataProvider('prematureConvergenceProvider')]
    #[Group('convergence-bug')]
    public function test_moonAgeConvergesWithinSixtySeconds(string $jstDateTime): void
    {
        $astronomy = $this->makeAstronomy();
        $date = new DateTimeImmutable($jstDateTime, new DateTimeZone('Asia/Tokyo'));
        $residual = abs($this->moonAgeResidual($astronomy, $date));

        $this->assertLessThanOrEqual(
            self::RESIDUAL_LIMIT_DEGREES,
            $residual,
            sprintf('%s JST の朔残差 %.9F° が60秒相当を超えています', $jstDateTime, $residual)
        );
    }

    /**
     * 2000〜2030年の固定疑似乱数標本で収束不良率を計測する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[Group('long-running')]
    public function test_reportsPrematureConvergenceRateAcrossThirtyOneYears(): void
    {
        $astronomy = $this->makeAstronomy();
        $failureCount = 0;

        foreach ($this->sweepDates() as $date) {
            if (abs($this->moonAgeResidual($astronomy, $date)) > self::RESIDUAL_LIMIT_DEGREES) {
                $failureCount++;
            }
        }

        $rate = $failureCount / self::SWEEP_SAMPLE_COUNT;
        fwrite(STDERR, sprintf(
            "ELP2000 convergence failures: %d/%d (%.2F%%), threshold %.9F degrees\n",
            $failureCount,
            self::SWEEP_SAMPLE_COUNT,
            $rate * 100.0,
            self::RESIDUAL_LIMIT_DEGREES
        ));

        $this->assertLessThan(0.01, $rate, '収束判定修正後の失敗率が1%を超えています');
    }

    /**
     * @return Astronomy
     */
    private function makeAstronomy(): Astronomy
    {
        return new Astronomy(new Vsop87Astronomy(), new ELP2000());
    }

    /**
     * moonAge が返した朔時刻における符号付き黄経差を返す。
     *
     * @param Astronomy $astronomy 診断対象と同じ太陽・月モデル
     * @param DateTimeImmutable $date 入力日時（JST）
     * @return float 符号付き黄経差（度）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    private function moonAgeResidual(Astronomy $astronomy, DateTimeImmutable $date): float
    {
        $moonAge = new Elp2000MoonAge($astronomy);
        $age = $moonAge->moonAge(
            (int) $date->format('Y'),
            (int) $date->format('n'),
            (int) $date->format('j'),
            (float) $date->format('G'),
            (float) $date->format('i'),
            (float) $date->format('s')
        );
        $newMoonTimestamp = (float) $date->format('U') - $age * Astronomy::DAY_TO_SECOND_FLOAT;

        return $this->residualAtTimestamp($astronomy, $newMoonTimestamp);
    }

    /**
     * Unix 時刻における符号付き黄経差を返す。
     *
     * @param Astronomy $astronomy 太陽・月モデル
     * @param float $timestamp Unix 時刻
     * @return float 符号付き黄経差（度）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    private function residualAtTimestamp(Astronomy $astronomy, float $timestamp): float
    {
        $wholeSeconds = (int) floor($timestamp);
        $fractionalSecond = $timestamp - $wholeSeconds;
        $date = (new DateTimeImmutable('@' . $wholeSeconds))->setTimezone(new DateTimeZone('Asia/Tokyo'));
        $longitudeMoon = $astronomy->longitudeMoon(
            (int) $date->format('Y'),
            (int) $date->format('n'),
            (int) $date->format('j'),
            (float) $date->format('G'),
            (float) $date->format('i'),
            (float) $date->format('s') + $fractionalSecond
        );
        $longitudeSun = $astronomy->longitudeSun(
            (int) $date->format('Y'),
            (int) $date->format('n'),
            (float) $date->format('j'),
            (float) $date->format('G'),
            (float) $date->format('i'),
            (float) $date->format('s') + $fractionalSecond
        );

        return fmod($longitudeMoon - $longitudeSun + 540.0, 360.0) - 180.0;
    }

    /**
     * 符号反転区間を1秒幅まで二分してモデル上の朔を返す。
     *
     * @param Astronomy $astronomy 太陽・月モデル
     * @param int $leftTimestamp 区間左端
     * @param int $rightTimestamp 区間右端
     * @return int モデル上の朔の Unix 時刻
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    private function bisectNewMoonTimestamp(Astronomy $astronomy, int $leftTimestamp, int $rightTimestamp): int
    {
        $leftResidual = $this->residualAtTimestamp($astronomy, $leftTimestamp);
        $rightResidual = $this->residualAtTimestamp($astronomy, $rightTimestamp);
        $this->assertLessThan(0.0, $leftResidual, '既知朔の前で黄経差が負になっていません');
        $this->assertGreaterThan(0.0, $rightResidual, '既知朔の後で黄経差が正になっていません');

        while ($rightTimestamp - $leftTimestamp > 1) {
            $middleTimestamp = intdiv($leftTimestamp + $rightTimestamp, 2);
            $middleResidual = $this->residualAtTimestamp($astronomy, $middleTimestamp);
            if ($middleResidual >= 0.0) {
                $rightTimestamp = $middleTimestamp;
            } else {
                $leftTimestamp = $middleTimestamp;
                $leftResidual = $middleResidual;
            }
        }

        return abs($leftResidual) <= abs($this->residualAtTimestamp($astronomy, $rightTimestamp))
            ? $leftTimestamp
            : $rightTimestamp;
    }

    /**
     * 固定 seed の線形合同法で2000〜2030年から日時を抽出する。
     *
     * @return iterable<int, DateTimeImmutable>
     * @throws \Exception
     */
    private function sweepDates(): iterable
    {
        $timezone = new DateTimeZone('Asia/Tokyo');
        $start = new DateTimeImmutable('2000-01-01 00:00:00', $timezone);
        $end = new DateTimeImmutable('2031-01-01 00:00:00', $timezone);
        $rangeSeconds = $end->getTimestamp() - $start->getTimestamp();
        $state = 20260614;

        for ($i = 0; $i < self::SWEEP_SAMPLE_COUNT; $i++) {
            $state = (1103515245 * $state + 12345) & 0x7fffffff;
            $timestamp = $start->getTimestamp() + $state % $rangeSeconds;

            yield (new DateTimeImmutable('@' . $timestamp))->setTimezone($timezone);
        }
    }
}
