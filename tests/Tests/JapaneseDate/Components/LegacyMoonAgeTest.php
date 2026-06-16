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
use JapaneseDate\Components\LegacyMoonAge;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * LegacyMoonAge クラスのテスト
 *
 * Legacy 黄経計算結果を用いた月齢計算の収束処理と、
 * Legacy アルゴリズム特有の補正分岐（収束計算1回目で ΔΛ が負値の場合の
 * 引き込み範囲補正）を検証する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @covers \JapaneseDate\Components\LegacyMoonAge
 * @covers \JapaneseDate\Components\LegacyMoonAge::moonAge
 */
class LegacyMoonAgeTest extends TestCase
{
    use InvokeTrait;
    /**
     * 月齢の期待値（丸め値）を返すデータセット
     *
     * 出典は国立天文台 暦計算室 / 暦要項の朔弦望情報。
     * それぞれ収束計算中の補正分岐を網羅するように選定している。
     *
     * @return array
     */
    public static function moonAgeProvider(): array
    {
        return [
            // 朔 (新月): 月齢 ≈ 0 / 収束計算1回目に ΔΛ < 0 となり引き込み範囲補正を通る
            '2023朔 05:53 JST' => [2023, 1, 22, 5, 53, 0, 0],
            // 望 (満月): 月齢 ≈ 15
            '2023望 03:29 JST' => [2023, 2, 6, 3, 29, 0, 15],
            // 朔前日: 月齢 ≈ 29 / $res > 30 補正を通る
            '2020朔前日' => [2020, 12, 14, 0, 0, 0, 29],
            // 朔当日: 月齢 ≈ 0
            '2020朔' => [2020, 12, 15, 1, 17, 0, 0],
            // 朔翌日: 月齢 ≈ 1
            '2020朔翌日' => [2020, 12, 16, 1, 17, 0, 1],
            // 2026-03-19 朔
            '2026朔' => [2026, 3, 19, 10, 23, 0, 0],
            // 2026-03-19 朔前(0:00 JST)
            '2026朔直前 00:00 JST' => [2026, 3, 19, 0, 0, 0, 29],
            '2022 3月朔' => [2022, 3, 3, 0, 0, 0, 0],
            '2022 7月朔' => [2022, 7, 29, 0, 0, 0, 0],
            '2015 11月朔' => [2015, 11, 12, 0, 0, 0, 0],
            // 春分付近（朔前3日）: 入力日の Legacy 座標で sun≈4.7°・moon≈326° → Spring Fix を通る
            '2017 春分付近の月齢26' => [2017, 3, 25, 0, 0, 0, 26],
            // 春分から12日後・朔から5日後（月齢≈4.6）。旧コードは while バグで早期終了し誤値4を返していた
            '2017 4月初旬の月齢5' => [2017, 4, 2, 0, 0, 0, 5],
        ];
    }
    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @param int $expectedRounded
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @dataProvider moonAgeProvider
     */
    public function test_moonAge($year, $month, $day, $hour, $min, $sec, $expectedRounded): void
    {
        $moonAge = new LegacyMoonAge(new Astronomy());
        $result = $moonAge->moonAge($year, $month, $day, $hour, $min, $sec);
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
     * 月齢は常に [0, 30) の範囲の値を返す
     */
    public function test_moonAge_alwaysInRange(): void
    {
        $moonAge = new LegacyMoonAge(new Astronomy());
        $dates = [
            [2023, 1, 1, 0, 0, 0],
            [2023, 6, 15, 12, 0, 0],
            [2025, 12, 31, 23, 59, 59],
            // 春分付近の朔直前で負の月齢が返されていたケース（修正確認）
            [2023, 3, 21, 12, 0, 0],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $moonAge->moonAge($y, $m, $d, $h, $i, $s);
            $this->assertGreaterThanOrEqual(0.0, $result, "$y-$m-$d で月齢が負になった");
            $this->assertLessThan(30.0, $result, "$y-$m-$d で月齢が30以上になった");
        }
    }
    /**
     * 春分直前（2023-03-21 12:00 JST）の月齢が負にならず [0, 30) に収まることを確認する。
     *
     * 修正前は res < 0 ガードがなく -0.475 を返していた。
     * 修正後は SYNODIC_MONTH 加算により ≈ 29.055 に補正される。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_springEquinox2023_isNearSynodicMonthEnd(): void
    {
        $moonAge = new LegacyMoonAge(new Astronomy());
        $result  = $moonAge->moonAge(2023, 3, 21, 12, 0, 0);
        $this->assertGreaterThanOrEqual(0.0, $result, '2023-03-21 12:00 JST の月齢が負になった');
        $this->assertLessThan(30.0, $result, '2023-03-21 12:00 JST の月齢が 30 以上になった');
    }
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_jstToJulianDateUsesStandardJulianDate(): void
    {
        $moonAge = new LegacyMoonAge(new Astronomy());

        // 2000-01-01 21:00:00 JST = 2000-01-01 12:00:00 UTC = JD 2451545.0
        $result = $this->invokeExecuteMethod($moonAge, 'jstToJulianDate', [2000, 1, 1, 21, 0, 0]);

        $this->assertEqualsWithDelta(2451545.0, $result, 1e-12);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_staysWithinFixtureToleranceInApril2017(): void
    {
        $moonAge = new LegacyMoonAge(new Astronomy());

        $this->assertEqualsWithDelta(
            14.132638888889,
            $moonAge->moonAge(2017, 4, 11, 15, 8, 0),
            0.47
        );
    }
    /**
     * 30日超過後の再収束ループで、春分付近補正と引き込み範囲補正を通過する。
     */
    public function test_moonAge_appliesCorrectionsDuringSecondConvergence(): void
    {
        $astronomy = $this->makeSequencedAstronomy([
            [200.0, 300.0],
            [200.0, 300.0],
            [200.0, 300.0],
            [200.0, 300.0],
            [180.0, 180.0 + 1.0e-5],
            [10.0, 305.0],
            [200.0, 300.0],
            [180.0, 180.0 + 1.0e-5],
        ]);
        $moonAge = new LegacyMoonAge($astronomy);

        $result = $moonAge->moonAge(2024, 1, 11, 8, 0, 0);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(30.0, $result);
    }
    /**
     * 第2収束ループで tm が julian_date_0 を超えた場合（res < 0）に
     * SYNODIC_MONTH を加算して月齢を正規化することを確認する。
     *
     * 設計:
     *   - 第1ループ: delta_rm=100 × 4回 → tm ≈ jd0−32.8 日 → res ≈ 32.8 > 30
     *   - 第2ループ: delta_rm=−25.5 × 2回 → tm が jd0 を約 0.9 日超過
     *   - 超過後の収束で res < 0 → SYNODIC_MONTH 加算 → [0, 30) に収まる
     */
    public function test_moonAge_secondLoop_negativeRes_addsSynodicMonth(): void
    {
        $astronomy = $this->makeSequencedAstronomy([
            [200.0, 300.0],         // 第1ループ iter 1: delta_rm=100 → tm -8.2日
            [200.0, 300.0],         // 第1ループ iter 2
            [200.0, 300.0],         // 第1ループ iter 3
            [200.0, 300.0],         // 第1ループ iter 4 → tm ≈ jd0-32.8
            [180.0, 180.0 + 1.0e-5], // 第1ループ収束 → res ≈ 32.8 > 30
            [200.0, 174.5],         // 第2ループ iter 1: delta_rm=-25.5 → tm +2.1日
            [200.0, 174.5],         // 第2ループ iter 2: tm が jd0 を超過
            [180.0, 180.0 + 1.0e-5], // 第2ループ収束 → res < 0 → SYNODIC_MONTH 加算
        ]);
        $moonAge = new LegacyMoonAge($astronomy);

        $result = $moonAge->moonAge(2024, 1, 11, 8, 0, 0);

        $this->assertGreaterThanOrEqual(0.0, $result, '月齢が負になった');
        $this->assertLessThan(30.0, $result, '月齢が30以上になった');
    }
    /**
     * 太陽・月の黄経をあらかじめ用意した数列で順に返す Astronomy を生成する。
     *
     * @param array<int, array{0: float, 1: float}> $sequence [太陽黄経, 月黄経] の組の数列
     * @return Astronomy
     */
    private function makeSequencedAstronomy(array $sequence): Astronomy
    {
        return new class ($sequence) extends Astronomy {
            /**
             * @var array<int, array{0: float, 1: float}>
             */
            private $sequence;
            /**
             * @var int
             */
            private $sunIndex = 0;

            /**
             * @var int
             */
            private $moonIndex = 0;

            /**
             * @param array<int, array{0: float, 1: float}> $sequence
             */
            public function __construct(array $sequence)
            {
                /**
                 * @readonly
                 */
                $this->sequence = $sequence;
                parent::__construct();
            }

            /**
             * @param int $year
             * @param int $month
             * @param float $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function longitudeSun($year, $month, $day, $hour, $min, $sec): float
            {
                $value = $this->sequence[min($this->sunIndex, count($this->sequence) - 1)][0];
                $this->sunIndex++;

                return $value;
            }

            /**
             * @param int $year
             * @param int $month
             * @param int $day
             * @param float $hour
             * @param float $min
             * @param float $sec
             * @return float
             */
            public function longitudeMoon($year, $month, $day, $hour, $min, $sec): float
            {
                $value = $this->sequence[min($this->moonIndex, count($this->sequence) - 1)][1];
                $this->moonIndex++;

                return $value;
            }
        };
    }
}
