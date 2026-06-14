<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Components;

use InvalidArgumentException;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Contracts\MoonAlgorithm;
use JapaneseDate\Components\Contracts\SunAlgorithm;
use JapaneseDate\Components\MeeusMoon;
use JapaneseDate\Components\MeeusMoonAge;
use JapaneseDate\Components\Vsop87Astronomy;
use JapaneseDate\Exceptions\MoonAgeConvergenceException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * MeeusMoonAge クラスのテスト。
 *
 * Meeus AA2 Chapter 47 に基づく月齢計算の収束処理、例外スロー、
 * 既存 fixture との整合性を検証する。
 * @covers \JapaneseDate\Components\MeeusMoonAge
 */
class MeeusMoonAgeTest extends TestCase
{
    use InvokeTrait;
    // ==================== 収束失敗 → 例外テスト ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_convergence_failure_throws_exception(): void
    {
        $stubMoon = new class () implements MoonAlgorithm {
            /**
             * @var int
             */
            public $callCount = 0;

            /**
             * @return string
             */
            public function moonAlgorithmName(): string
            {
                return 'stub-moon';
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
            public function longitudeMoon(
                $year,
                $month,
                $day,
                $hour,
                $min,
                $sec
            ): float {
                $this->callCount++;

                return 180.0; // 太陽 0° に対し常に 180° → 非収束
            }
        };

        $stubSun = new class () implements SunAlgorithm {
            /**
             * @return string
             */
            public function sunAlgorithmName(): string
            {
                return 'stub-sun';
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
            public function longitudeSun(
                $year,
                $month,
                $day,
                $hour,
                $min,
                $sec
            ): float {
                return 0.0;
            }
        };

        $ast = new Astronomy($stubSun, $stubMoon);
        $moonAge = new MeeusMoonAge($ast);

        $thrown = null;

        try {
            $moonAge->moonAge(2000, 1, 6, 12, 0, 0);
        } catch (MoonAgeConvergenceException $e) {
            $thrown = $e;
        }

        $this->assertNotNull($thrown, 'MoonAgeConvergenceException が投げられること');
        $this->assertLessThanOrEqual(
            60,
            $stubMoon->callCount,
            '反復回数が 60 以下であること（初回探索 30 + 直前朔再探索 30 を上限）'
        );
        $this->assertGreaterThanOrEqual(
            30,
            $stubMoon->callCount,
            '少なくとも初回探索の 30 反復は実行されている'
        );
    }
    // ==================== 不正入力テスト ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_rejects_nan_hour(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $ast = new Astronomy(null, new MeeusMoon());
        (new MeeusMoonAge($ast))->moonAge(2000, 1, 6, NAN, 0, 0);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_rejects_inf_min(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $ast = new Astronomy(null, new MeeusMoon());
        (new MeeusMoonAge($ast))->moonAge(2000, 1, 6, 0, INF, 0);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_rejects_negative_infinity_sec(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $ast = new Astronomy(null, new MeeusMoon());
        (new MeeusMoonAge($ast))->moonAge(2000, 1, 6, 0, 0, -INF);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_rejects_ut_jd_resolution_loss(): void
    {
        // 極端に大きな hour 値で UT JD が 1 秒分解能を失う
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Input UT JD non-finite or beyond resolution');
        $ast = new Astronomy(null, new MeeusMoon());
        (new MeeusMoonAge($ast))->moonAge(2000, 1, 6, 1.0e15, 0, 0);
    }
    // ==================== 通常収束パス ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_converges_near_new_moon(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        // 2024-01-11 新月（UTC 約11:57）の翌日 02:00 JST = 約14時間後
        // 新月直後で月齢は小さいが確実に正値になる
        $age = $moonAge->moonAge(2024, 1, 12, 2, 0, 0);
        $this->assertGreaterThan(0.0, $age, '2024-01-12 朔の翌日 02:00 JST → 月齢が正値であること');
        $this->assertLessThan(1.0, $age, '2024-01-12 朔の翌日 02:00 JST → 月齢が1日未満であること');
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_converges_near_full_moon(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        // 2024-01-25 JST 22:54 ≈ 満月
        $age = $moonAge->moonAge(2024, 1, 25, 22, 54, 0);
        $this->assertGreaterThan(13.0, $age);
        $this->assertLessThan(17.0, $age);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_before_new_moon_returns_large_value(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        // 朔の 24 時間前 → 月齢 ≈ 28.5
        $age = $moonAge->moonAge(2024, 1, 10, 20, 57, 0);
        $this->assertGreaterThan(27.0, $age);
        $this->assertLessThan(29.6, $age);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_after_new_moon_returns_small_value(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        // 朔の 24 時間後 → 月齢 ≈ 1.0
        $age = $moonAge->moonAge(2024, 1, 12, 20, 57, 0);
        $this->assertEqualsWithDelta(1.0, $age, 0.1, '朔の 24h 後の月齢');
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_2025_04_05_matches_naoj_new_moon_time(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        $age = $moonAge->moonAge(2025, 4, 5, 11, 15, 0);

        $this->assertEqualsWithDelta(
            6.636805555555555,
            $age,
            1.0 / 1440.0,
            '2025-04-05 11:15:00 の月齢が国立天文台の朔時刻基準から1分以上ずれています'
        );
    }
    // ==================== 春分付近（黄経 0° 折り返し）テスト ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_near_vernal_equinox(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        // 春分付近の朔（2023-03-22 UTC 約17:23 = JST 翌日 02:23）の12時間後
        // → 月齢は小さいが確実に正値になる
        $age = $moonAge->moonAge(2023, 3, 22, 14, 0, 0);
        $this->assertGreaterThan(0.0, $age, '春分付近の朔12時間後 → 月齢が正値であること');
        $this->assertLessThan(1.0, $age, '春分付近の朔12時間後 → 月齢が1日未満であること');
    }
    // ==================== 直前朔再探索テスト（未来朔 → 再探索） ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_negative_corrects_to_previous_month(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon());
        $moonAge = new MeeusMoonAge($ast);

        // 直前朔直前を入力し月齢 ≈ 29 日台が返ることを確認
        $age = $moonAge->moonAge(2020, 12, 14, 0, 0, 0);
        $this->assertGreaterThan(27.0, $age);
        $this->assertLessThan(30.0, $age);
    }
    // ==================== no_c モードでの基本動作 ====================
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_moonAge_no_c_mode_converges(): void
    {
        $ast = new Astronomy(new Vsop87Astronomy(), new MeeusMoon(false));
        $moonAge = new MeeusMoonAge($ast);

        // no_c モード: 新月翌日 02:00 JST → 月齢は小さく正値
        $age = $moonAge->moonAge(2024, 1, 12, 2, 0, 0);
        $this->assertGreaterThan(0.0, $age, 'no_c モード: 朔翌日 02:00 JST → 月齢が正値であること');
        $this->assertLessThan(1.0, $age, 'no_c モード: 朔翌日 02:00 JST → 月齢が1日未満であること');
    }
    // ==================== 全朔走査（long-running グループ） ====================
    /**
     * @param bool $applyC
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @group long-running
     * @dataProvider cCorrectionModeProvider
     */
    public function test_convergence_across_all_new_moons($applyC): void
    {
        $ast = new RecordingAstronomy(
            new Vsop87Astronomy(),
            new MeeusMoon($applyC)
        );
        $moonAge = new MeeusMoonAge($ast);
        $referenceNewMoonJd = 2451550.259722;
        $synodic = 29.530589;
        $rangeStartJd = MeeusMoon::gregorianToJd(1900, 1, 1);
        $rangeEndJd = MeeusMoon::gregorianToJd(2150, 12, 31);
        $startN = (int) ceil(($rangeStartJd - $referenceNewMoonJd) / $synodic);
        $endN = (int) floor(($rangeEndJd - $referenceNewMoonJd) / $synodic);
        $expectedSamples = $endN - $startN + 1;
        $maxCallCount = 0;
        $convergedJds = [];
        $residualsDeg = [];
        for ($n = $startN; $n <= $endN; $n++) {
            $approxJd = $referenceNewMoonJd + $n * $synodic;
            if ($approxJd < $rangeStartJd || $approxJd > $rangeEndJd) {
                continue;
            }

            $inputUtJd = $approxJd + 2.0;

            $jstJd = $inputUtJd + 9.0 / 24.0;
            [$y, $m, $d] = MeeusMoon::jdToGregorianYmd($jstJd);
            $dayFrac = $jstJd + 0.5 - floor($jstJd + 0.5);
            $hour = $dayFrac * 24.0;
            $minPart = ($hour - (int) $hour) * 60.0;
            $secPart = ($minPart - (int) $minPart) * 60.0;

            $ast->longitudeMoonCalls = [];
            $age = $moonAge->moonAge($y, $m, $d, (int) $hour, (int) $minPart, $secPart);

            $callCount = count($ast->longitudeMoonCalls);
            $maxCallCount = max($maxCallCount, $callCount);

            $this->assertLessThanOrEqual(60, $callCount, "lunation $n: moonAge 全体で 60 反復以内");

            $convergedJd = $inputUtJd - $age;
            $convergedJds[] = $convergedJd;

            [$cy, $cm, $cd] = MeeusMoon::jdToGregorianYmd($convergedJd + 9.0 / 24.0);
            $cDayFrac = ($convergedJd + 9.0 / 24.0) + 0.5 - floor(($convergedJd + 9.0 / 24.0) + 0.5);
            $cHour = $cDayFrac * 24.0;
            $cMinPart = ($cHour - (int) $cHour) * 60.0;
            $cSecPart = ($cMinPart - (int) $cMinPart) * 60.0;

            $cleanAst = new Astronomy(new Vsop87Astronomy(), new MeeusMoon($applyC));
            $lonMoon = $cleanAst->longitudeMoon($cy, $cm, $cd, (int) $cHour, (int) $cMinPart, $cSecPart);
            $lonSun = $cleanAst->longitudeSun($cy, $cm, $cd, (int) $cHour, (int) $cMinPart, $cSecPart);
            $delta = fmod($lonMoon - $lonSun + 540.0, 360.0) - 180.0;
            $residualsDeg[] = abs($delta);
        }
        $this->assertCount($expectedSamples, $convergedJds);
        sort($convergedJds);
        $convergedJdCount = count($convergedJds);
        for ($i = 1; $i < $convergedJdCount; $i++) {
            $interval = $convergedJds[$i] - $convergedJds[$i - 1];
            $this->assertGreaterThan(29.18, $interval);
            $this->assertLessThan(29.93, $interval);
        }
        $this->assertLessThan(0.001, max($residualsDeg));
        $this->assertLessThan(60, $maxCallCount);
    }
    /**
     * @return array
     */
    public static function cCorrectionModeProvider(): array
    {
        return [
            'MOON_MEEUS47 (c correction on)' => [true],
            'MOON_MEEUS47_NO_C (c correction off)' => [false],
        ];
    }
}

// ==================== テスト用ヘルパークラス ====================

/**
 * longitudeMoon / longitudeSun 呼び出し履歴を記録する Astronomy サブクラス。
 */
class RecordingAstronomy extends Astronomy
{
    /** @var list<array{year:int,month:int,day:int,hour:float,min:float,sec:float}> */
    public $longitudeMoonCalls = [];

    /** @var list<array{year:int,month:int,day:float,hour:float,min:float,sec:float}> */
    public $longitudeSunCalls = [];

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @return float
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function longitudeMoon(
        $year,
        $month,
        $day,
        $hour,
        $min,
        $sec
    ): float {
        $this->longitudeMoonCalls[] = compact('year', 'month', 'day', 'hour', 'min', 'sec');

        return parent::longitudeMoon($year, $month, $day, $hour, $min, $sec);
    }

    /**
     * @param int $year
     * @param int $month
     * @param float $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @return float
     * @throws \Exception
     */
    public function longitudeSun(
        $year,
        $month,
        $day,
        $hour,
        $min,
        $sec
    ): float {
        $this->longitudeSunCalls[] = compact('year', 'month', 'day', 'hour', 'min', 'sec');

        return parent::longitudeSun($year, $month, $day, $hour, $min, $sec);
    }
}
