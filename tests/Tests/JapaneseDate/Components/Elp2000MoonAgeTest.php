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
use JapaneseDate\Components\ELP2000;
use JapaneseDate\Components\Elp2000MoonAge;
use JapaneseDate\Components\Vsop87Astronomy;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Elp2000MoonAge クラスのテスト
 *
 * ELP2000 黄経計算結果を用いた月齢計算の収束処理と、
 * ELP2000 アルゴリズム特有の補正分岐（収束計算結果が負値の場合の
 * 朔望月加算補正）を検証する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone<suzunone.eleven@gmail.com>
 */
#[CoversClass(Elp2000MoonAge::class)]
#[CoversMethod(Elp2000MoonAge::class, 'moonAge')]
class Elp2000MoonAgeTest extends TestCase
{
    use InvokeTrait;

    /**
     * 月齢の期待値（丸め値）を返すデータセット
     *
     * @return array
     */
    public static function moonAgeProvider(): array
    {
        return [
            // 朔 (新月) 付近: 月齢 ≈ 0
            '2023朔 05:53 JST' => [2023, 1, 22, 5, 53, 0, 0],
            // 望 (満月) 付近: 月齢 ≈ 15
            '2023望 03:29 JST' => [2023, 2, 6, 3, 29, 0, 15],
            // 朔前日付近: NASA SVS の月齢 ≈ 28.4 / $res > 30 補正を通る
            '2020朔前日' => [2020, 12, 14, 0, 0, 0, 28],
            // 朔当日付近: 月齢 ≈ 0
            '2020朔' => [2020, 12, 15, 1, 17, 0, 0],
            // 朔翌日付近: 月齢 ≈ 1
            '2020朔翌日' => [2020, 12, 16, 1, 17, 0, 1],
            // 春分付近（朔前3日）: approxNewMoon が朔当日 → $res<0 で直前朔へ再収束。Spring Fix を通る
            '2017 春分付近の月齢26' => [2017, 3, 25, 0, 0, 0, 26],
            // 春分から12日後・朔から5日後（月齢≈4.5）。旧コードは while バグで早期終了し誤値4を返していた
            '2017 4月初旬の月齢5' => [2017, 4, 2, 0, 0, 0, 5],
            // 収束計算結果が負値となり、朔望月加算補正(ELP2000固有)を通るケース
            '2015朔望月加算補正ケース' => [2015, 1, 19, 0, 0, 0, 28],
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
     */
    #[DataProvider('moonAgeProvider')]
    public function test_moonAge(
        int $year,
        int $month,
        int $day,
        float $hour,
        float $min,
        float $sec,
        int $expectedRounded
    ): void {
        $moonAge = new Elp2000MoonAge($this->makeElp2000Astronomy());
        $result = $moonAge->moonAge($year, $month, $day, $hour, $min, $sec);

        $this->assertEquals(
            $expectedRounded,
            (int) round($result) % 30,
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
     * ELP2000 を月黄経アルゴリズムとして注入した Astronomy を生成する
     *
     * @return \JapaneseDate\Components\Astronomy
     */
    private function makeElp2000Astronomy(): Astronomy
    {
        return new Astronomy(new Vsop87Astronomy(), new ELP2000());
    }

    /**
     * 月齢は常に [0, 30) の範囲の値を返す
     *
     * 朔望月加算補正（ELP2000 固有）を経由するケースを含む。
     */
    public function test_moonAge_alwaysInRange(): void
    {
        $moonAge = new Elp2000MoonAge($this->makeElp2000Astronomy());
        $dates = [
            [2023, 1, 1, 0, 0, 0],
            [2023, 6, 15, 12, 0, 0],
            [2025, 12, 31, 23, 59, 59],
            [2015, 1, 19, 0, 0, 0],
        ];
        foreach ($dates as [$y, $m, $d, $h, $i, $s]) {
            $result = $moonAge->moonAge($y, $m, $d, $h, $i, $s);
            $this->assertGreaterThanOrEqual(0.0, $result, "$y-$m-$d で月齢が負になった");
            $this->assertLessThan(30.0, $result, "$y-$m-$d で月齢が30以上になった");
        }
    }

    /**
     * 黄経差の収束ループにおいて「春分付近の朔」補正分岐
     * （太陽黄経 0〜20°かつ月黄経 300°以上で ΔΛ ＝ 360 － ΔΛ と補正する分岐）
     * を確実に通過するケースを検証する。
     */
    public function test_moonAge_passesSpringEquinoxCorrectionBranch(): void
    {
        $astronomy = $this->makeSequencedAstronomy([
            [10.0, 305.0],
            [180.0, 180.0 + 1.0e-5],
        ]);
        $moonAge = new Elp2000MoonAge($astronomy);

        $result = $moonAge->moonAge(2024, 1, 11, 8, 0, 0);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(30.0, $result);
    }

    /**
     * 黄経差の収束ループにおいて「ΔΛ が引き込み範囲（±40°）を逸脱した場合」の
     * 補正分岐、および収束後の月齢が30以上になった場合の補正分岐
     * （$res -= 30）を確実に通過するケースを検証する。
     */
    public function test_moonAge_passesOutOfCaptureRangeAndOverThirtyCorrectionBranches(): void
    {
        $astronomy = $this->makeSequencedAstronomy([
            [200.0, 300.0],
            [200.0, 300.0],
            [200.0, 300.0],
            [200.0, 300.0],
            [180.0, 180.0 + 1.0e-5],
        ]);
        $moonAge = new Elp2000MoonAge($astronomy);

        $result = $moonAge->moonAge(2024, 1, 11, 8, 0, 0);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(30.0, $result);
    }

    /**
     * 直前の朔への再収束後も未来時刻となった場合、朔望月を加算して負値を補正する。
     */
    public function test_moonAge_addsSynodicMonthWhenSecondConvergenceReturnsFutureDate(): void
    {
        $astronomy = $this->makeSequencedAstronomy([
            [180.0, 180.0 + 1.0e-5],
            [200.0, 300.0],
            [180.0, 180.0 + 1.0e-5],
        ], -360.0);
        $moonAge = new Elp2000MoonAge($astronomy);

        $result = $moonAge->moonAge(2024, 1, 11, 8, 0, 0);

        $this->assertGreaterThanOrEqual(0.0, $result);
        $this->assertLessThan(30.0, $result);
    }

    /**
     * 太陽・月の黄経をあらかじめ用意した数列で順に返す Astronomy を生成する。
     *
     * 数列を使い切った場合は最後の要素を返し続け、収束ループを終了させる。
     *
     * @param array<int, array{0: float, 1: float}> $sequence [太陽黄経, 月黄経] の組の数列
     * @param null|float $normalizedAngle normalizeAngle() が返す固定値
     * @return \JapaneseDate\Components\Astronomy
     */
    private function makeSequencedAstronomy(array $sequence, ?float $normalizedAngle = null): Astronomy
    {
        return new class ($sequence, $normalizedAngle) extends Astronomy {
            private int $sunIndex = 0;

            private int $moonIndex = 0;

            /**
             * @param array<int, array{0: float, 1: float}> $sequence
             * @param null|float $normalizedAngle
             */
            public function __construct(
                private readonly array $sequence,
                private readonly ?float $normalizedAngle
            ) {
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
            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
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
            public function longitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float
            {
                $value = $this->sequence[min($this->moonIndex, count($this->sequence) - 1)][1];
                $this->moonIndex++;

                return $value;
            }

            public function normalizeAngle(float $angle): float
            {
                return $this->normalizedAngle ?? parent::normalizeAngle($angle);
            }
        };
    }

    /**
     * NASA SVS の 2014-01-01 00:00 UTC（09:00 JST）の月齢と比較する。
     *
     * @see https://svs.gsfc.nasa.gov/4118/
     */
    public function test_moonAge_usesJstInputOnlyOnce(): void
    {
        $moonAge = new Elp2000MoonAge($this->makeElp2000Astronomy());

        $this->assertEqualsWithDelta(
            28.984,
            $moonAge->moonAge(2014, 1, 1, 9, 0, 0),
            0.25
        );
    }
}
