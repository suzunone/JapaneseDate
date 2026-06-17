<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\Components\SolarTerm;
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\TestCase;

/**
 * SimpleSolarTerm と VSOP87 の全件精度比較テスト。
 *
 * SimpleSolarTerm の対応範囲に含まれる全二十四節気を走査し、
 * VSOP87 による天文計算結果との日付差分を検出する。
 * @coversNothing
 * @group long-running
 * @large
 */
class SimpleSolarTermCoversNothingTest extends TestCase
{
    private const START_YEAR = 1600;
    private const END_YEAR = 2399;
    private const SOLAR_TERM_COUNT = 24;
    /**
     * 対応範囲内の全二十四節気を個別のテストケースとして返す。
     *
     * 1600年から2399年までの800年間について、全24節気、計19,200件を走査する。
     *
     * @return iterable<string, array{0: int, 1: int}>
     */
    public static function allSolarTermsDataProvider(): iterable
    {
        for ($year = self::START_YEAR; $year <= self::END_YEAR; $year++) {
            for ($solarTerm = 0; $solarTerm < self::SOLAR_TERM_COUNT; $solarTerm++) {
                yield $year . ' term=' . $solarTerm => [$year, $solarTerm];
            }
        }
    }
    /**
     * SimpleSolarTerm の日付が VSOP87 による天文計算結果と一致することを確認する。
     *
     * @param int $year 年
     * @param int $solarTerm 二十四節気コード
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @dataProvider allSolarTermsDataProvider
     */
    public function test_solarTermMatchesVsop87(int $year, int $solarTerm): void
    {
        $simpleDate = (new SimpleSolarTerm())->getSolarTerm($year, $solarTerm);
        $vsop87Date = (new SolarTerm(new Astronomy(new Vsop87Astronomy())))
            ->getSolarTerm($year, $solarTerm);
        $this->assertSame(
            [$vsop87Date->month, $vsop87Date->day],
            [$simpleDate->month, $simpleDate->day],
            sprintf(
                '%d term=%d Simple=%02d-%02d VSOP87=%02d-%02d',
                $year,
                $solarTerm,
                $simpleDate->month,
                $simpleDate->day,
                $vsop87Date->month,
                $vsop87Date->day,
            ),
        );
    }
}
