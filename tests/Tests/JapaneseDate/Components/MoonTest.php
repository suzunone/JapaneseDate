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

use Carbon\Carbon;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\ELP2000;
use JapaneseDate\Components\MeeusMoon;
use JapaneseDate\Components\Moon;
use JapaneseDate\Exceptions\ErrorException;
use JapaneseDate\Exceptions\Exception as JapaneseDateException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * truePhase() の戻り値の仕様:
 *   戻り値 = julian2Uts(真の位相のユリウス日)
 *          ≈ 実際の天文イベントの UTC タイムスタンプ
 *
 * 精度: 新月・四分月は ±3 分以内 (USNO / 国立天文台データと照合済み)
 * 天文データ出典: 国立天文台 / USNO
 */
#[CoversClass(Moon::class)]
class MoonTest extends TestCase
{
    use InvokeTrait;

    // ==================== uts2Julian / julian2Uts 変換精度テスト ====================

    /**
     * @return array[]
     */
    public static function elp2000NewMoonProvider(): array
    {
        return [
            // 国立天文台 平成27年(2015)暦要項 朔弦望（中央標準時）
            // https://eco.mtk.nao.ac.jp/koyomi/yoko/pdf/yoko2015.pdf
            '2015 April new moon' => ['2015-04-16 00:00:00', '2015-04-19 03:57:00', 300],
            '2015 August new moon near midnight' => ['2015-08-01 00:00:00', '2015-08-14 23:53:00', 300],
            '2015 November new moon' => ['2015-11-09 00:00:00', '2015-11-12 02:47:00', 300],
            // 国立天文台 暦要項 2023年 朔弦望（中央標準時）
            '2023 January new moon' => ['2023-01-20 00:00:00', '2023-01-22 05:53:00', 300],
        ];
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_uts2Julian_unix_epoch(): void
    {
        $moon = new Moon();
        // Unix エポック (1970-01-01 00:00:00 UTC) のユリウス日は 2440587.5 と定義されている
        $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [0]);
        $this->assertSame(2440587.5, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_uts2Julian_j2000(): void
    {
        $moon = new Moon();
        // J2000.0 基準点: 2000-01-01 12:00:00 UTC = Unix 946728000 → ユリウス日 2451545.0
        $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [946728000]);
        $this->assertSame(2451545.0, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_uts2Julian_known_date(): void
    {
        $moon = new Moon();
        // 2023-01-21 00:00:00 UTC = Unix 1674259200 → ユリウス日 2459965.5
        $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [1674259200]);
        $this->assertSame(2459965.5, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_julian2Uts_unix_epoch(): void
    {
        $moon = new Moon();
        // ユリウス日 2440587.5 (Unix エポック) → 0.0
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [2440587.5]);
        $this->assertSame(0.0, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_julian2Uts_j2000(): void
    {
        $moon = new Moon();
        // ユリウス日 2451545.0 (J2000.0) → 946728000.0
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [2451545.0]);
        $this->assertSame(946728000.0, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_julian2Uts_known_date(): void
    {
        $moon = new Moon();
        // ユリウス日 2459965.5 → 1674259200.0 (2023-01-21 00:00:00 UTC)
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [2459965.5]);
        $this->assertSame(1674259200.0, $result);
    }

    // ==================== meanPhase ====================

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_julian2Uts_roundtrip(): void
    {
        $moon = new Moon();
        // Unix タイムスタンプをユリウス日に変換し、再び戻しても元の値と一致することを確認する
        $timestamp = 1674259200;
        $julian = $this->invokeExecuteMethod($moon, 'uts2Julian', [$timestamp]);
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [$julian]);
        $this->assertEqualsWithDelta((float) $timestamp, $result, 0.001);
    }

    // ==================== truePhase 分岐テスト ====================

    // phase < 0.01 → 新月補正

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_meanPhase_returnsFloat(): void
    {
        $moon = new Moon();
        // 平均朔望時刻がユリウス日として妥当な浮動小数点数で返ることを確認する
        $result = $this->invokeExecuteMethod($moon, 'meanPhase', [2451545.0, 1236.85]);
        $this->assertIsFloat($result);
        $this->assertGreaterThan(2415020.0, $result);
    }

    // abs(phase - 0.5) < 0.01 → 満月補正

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_newMoon_returnsFloat(): void
    {
        $moon = new Moon();
        // 新月に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.0]);
        $this->assertIsFloat($result);
    }

    // abs(phase - 0.25) < 0.01, phase < 0.5 → 上弦補正

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_fullMoon_returnsFloat(): void
    {
        $moon = new Moon();
        // 満月に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.5]);
        $this->assertIsFloat($result);
    }

    // abs(phase - 0.75) < 0.01, phase >= 0.5 → 下弦補正

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_firstQuarter_returnsFloat(): void
    {
        $moon = new Moon();
        // 上弦に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.25]);
        $this->assertIsFloat($result);
    }

    // いずれにも該当しない場合 → null

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_lastQuarter_returnsFloat(): void
    {
        $moon = new Moon();
        // 下弦に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.75]);
        $this->assertIsFloat($result);
    }

    // ==================== truePhase 実データ精度テスト ====================
    //
    // truePhase(k, phase) の戻り値 ≈ 実際の天文イベントの UTC タイムスタンプ
    // 許容誤差: ±300 秒 (5 分) — アルゴリズムの近似誤差を考慮
    //
    // k=1522 = 2023年1月の朔望月インデックス (2023-01-21 新月)
    // k=1521 = 2022年12月の朔望月インデックス (2022-12-23 新月)

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_invalidPhase_returnsNull(): void
    {
        $moon = new Moon();
        // 対応していない位相では補正値を返さないことを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.3]);
        $this->assertNull($result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_newMoon_jan2023(): void
    {
        $moon = new Moon();
        // 新月: 2023-01-21 20:53 UTC (USNO データ)
        // UTC タイムスタンプ: 1674334380
        $expected = 1674334380;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.0]);
        $this->assertEqualsWithDelta(
            $expected,
            $result,
            300,
            '2023-01-21 新月の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_newMoon_dec2022(): void
    {
        $moon = new Moon();
        // 新月: 2022-12-23 10:17 UTC (USNO データ)
        // UTC タイムスタンプ: 1671790620
        $expected = 1671790620;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1521.0, 0.0]);
        $this->assertEqualsWithDelta(
            $expected,
            $result,
            300,
            '2022-12-23 新月の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_firstQuarter_jan2023(): void
    {
        $moon = new Moon();
        // 上弦: 2023-01-28 15:19 UTC (USNO データ)
        // UTC タイムスタンプ: 1674919140
        $expected = 1674919140;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.25]);
        $this->assertEqualsWithDelta(
            $expected,
            $result,
            300,
            '2023-01-28 上弦の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_fullMoon_feb2023(): void
    {
        $moon = new Moon();
        // 満月: 2023-02-05 18:29 UTC (USNO データ)
        // UTC タイムスタンプ: 1675621740
        $expected = 1675621740;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.5]);
        $this->assertEqualsWithDelta(
            $expected,
            $result,
            300,
            '2023-02-05 満月の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    // ==================== moonPhase 分岐テスト ====================

    // is_next=false → k2 (次の朔望月の新月基準)

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_throwsErrorExceptionWhenPhaseIsInvalid(): void
    {
        $moon = new Moon();

        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage(
            '位相には 0.0、0.125、0.25、0.375、0.5、0.625、0.75、0.875 のいずれかを指定してください。'
        );

        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.1);
    }

    /**
     * @return array[]
     */
    public static function eightPhasesProvider(): array
    {
        return [
            'new moon (0.0)' => [0.0],
            'crescent (0.125)' => [0.125],
            'first quarter (0.25)' => [0.25],
            'thirteen night (0.375)' => [0.375],
            'full moon (0.5)' => [0.5],
            'sixteen night (0.625)' => [0.625],
            'last quarter (0.75)' => [0.75],
            'dawn moon (0.875)' => [0.875],
        ];
    }

    /**
     * @param float $phase
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('eightPhasesProvider')]
    public function test_moonPhase_acceptsAllEightPhases(float $phase): void
    {
        $moon = new Moon();
        // 8 相のいずれを指定しても ErrorException が発生せず Carbon が返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), $phase);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    /**
     * @return array[]
     */
    public static function invalidPhaseProvider(): array
    {
        return [
            '0.1 (between new moon and crescent)' => [0.1],
            '0.2 (between crescent and first quarter)' => [0.2],
            '0.33 (arbitrary)' => [0.33],
            '1.0 (out of supported range)' => [1.0],
            '-0.125 (negative)' => [-0.125],
        ];
    }

    /**
     * @param float $phase
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('invalidPhaseProvider')]
    public function test_moonPhase_throwsForUnsupportedPhase(float $phase): void
    {
        $moon = new Moon();

        $this->expectException(ErrorException::class);

        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), $phase);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_truePhase_lastQuarter_feb2023(): void
    {
        $moon = new Moon();
        // 下弦: 2023-02-13 16:01 UTC (USNO データ)
        // UTC タイムスタンプ: 1676304060
        $expected = 1676304060;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.75]);
        $this->assertEqualsWithDelta(
            $expected,
            $result,
            300,
            '2023-02-13 下弦の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    // is_next=false, phase=0.5 → 満月

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_newMoon_isNextFalse(): void
    {
        $moon = new Moon();
        // 指定日以後の新月が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    // is_next=false, phase=0.25 → 上弦 (phase < 0.5 の分岐)

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_fullMoon(): void
    {
        $moon = new Moon();
        // 指定日以後の満月が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.5);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    // is_next=false, phase=0.75 → 下弦 (phase >= 0.5 の分岐)

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_firstQuarter(): void
    {
        $moon = new Moon();
        // 指定日以後の上弦が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.25);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    // is_next=true → k1 (前の朔望月の新月基準)

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_lastQuarter(): void
    {
        $moon = new Moon();
        // 指定日以後の下弦が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.75);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    // abs($nt2 - $julian) < 0.75 の分岐 (新月当日に近い日時でトリガー)

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_isNextTrue(): void
    {
        $moon = new Moon();
        // is_next=true の場合は指定日前の新月が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0, true);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_nearNewMoon_triggersClosenessCheck(): void
    {
        $moon = new Moon();
        // 2023-01-21 20:53 UTC は実際の新月時刻 → 平均新月との差が 0.75 ユリウス日未満になる
        $date = new DateTime('2023-01-21 20:53:00', new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, 0.0);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhaseDoesNotUseLegacyTruePhaseWhenMoonElp2000Selected(): void
    {
        $elp2000Astronomy = new Astronomy(null, new ELP2000());

        $moon = new class ($elp2000Astronomy) extends Moon {
            public bool $legacyTruePhaseCalled = false;

            /**
             * @noinspection PhpUnused — Moon::moonPhase() 内部から委譲呼び出しされる
             * @param float $k
             * @param float $phase
             * @return float|null
             */
            protected function truePhase(float $k, float $phase): ?float
            {
                $this->legacyTruePhaseCalled = true;

                return parent::truePhase($k, $phase);
            }
        };

        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $this->assertFalse($moon->legacyTruePhaseCalled);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByLegacyReturnsCarbon(): void
    {
        $moon = new Moon();

        $result = $this->invokeExecuteMethod(
            $moon,
            'moonPhaseByLegacy',
            [new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0, false]
        );

        $this->assertInstanceOf(Carbon::class, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByAstronomyReturnsPreviousTimestampWhenDeltaIsZero(): void
    {
        $moon = new class () extends Moon {
            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             */
            protected function phaseDeltaAt(int $timestamp, float $targetAngle): float
            {
                return 0.0;
            }
        };

        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByAstronomy', [$date, 0.0, false]);

        $this->assertInstanceOf(Carbon::class, $result);
        $this->assertSame($date->getTimestamp(), $result->getTimestamp());
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByAstronomyFallsBackWhenNoCrossingIsFound(): void
    {
        $moon = new class () extends Moon {
            public bool $fallbackCalled = false;

            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             */
            protected function phaseDeltaAt(int $timestamp, float $targetAngle): float
            {
                return 1.0;
            }

            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() のフォールバックとして委譲呼び出しされる
             * @param \DateTimeInterface $date
             * @param float $phase
             * @param bool $is_next
             * @return \Carbon\Carbon
             */
            protected function moonPhaseByLegacy(DateTimeInterface $date, float $phase, bool $is_next): Carbon
            {
                $this->fallbackCalled = true;

                return Carbon::createFromTimestampUTC($date->getTimestamp());
            }
        };

        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByAstronomy', [$date, 0.0, false]);

        $this->assertInstanceOf(Carbon::class, $result);
        $this->assertTrue($moon->fallbackCalled);
        $this->assertSame($date->getTimestamp(), $result->getTimestamp());
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByAstronomyThrowsWhenCustomPhaseIsNotFound(): void
    {
        $moon = new class () extends Moon {
            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             */
            protected function phaseDeltaAt(int $timestamp, float $targetAngle): float
            {
                return 1.0;
            }
        };

        $this->expectException(JapaneseDateException::class);
        $this->expectExceptionMessage(
            '指定された位相 (0.1000) の探索に失敗しました。'
        );

        $this->invokeExecuteMethod(
            $moon,
            'moonPhaseByAstronomy',
            [new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.1, false]
        );
    }

    /**
     * @param string $searchDate
     * @param string $expectedNewMoon
     * @param int $deltaSeconds
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    #[DataProvider('elp2000NewMoonProvider')]
    public function test_moonPhaseByElp2000MatchesNaojNewMoonTime(
        string $searchDate,
        string $expectedNewMoon,
        int $deltaSeconds
    ): void {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);

            $result = (new Moon())->moonPhase(new DateTime($searchDate, new DateTimeZone('UTC')), 0.0);

            $this->assertEqualsWithDelta(
                (new DateTime($expectedNewMoon, new DateTimeZone('Asia/Tokyo')))->getTimestamp(),
                $result->getTimestamp(),
                $deltaSeconds
            );
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }

    // ==================== moonPhase 実データ精度テスト ====================
    //
    // moonPhase() は truePhase() を呼ぶため、同じ精度が適用される
    // 期待値 = 実際の天文イベントの UTC タイムスタンプ (±300 秒)
    //
    // 2023-01-15 UTC をクエリ日として使用:
    //   ループ終了時 k1=1521 (2022-12-23 新月), k2=1522 (2023-01-21 新月)
    //   is_next=false → truePhase(k2=1522, phase)
    //   is_next=true  → truePhase(k1=1521, phase)

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_newMoon_jan2023_accuracy(): void
    {
        $moon = new Moon();
        // 新月 2023-01-21 20:53 UTC (k2=1522)
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);
        $this->assertEqualsWithDelta(
            1674334380,
            $result->getTimestamp(),
            300,
            '2023-01-21 新月の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_firstQuarter_jan2023_accuracy(): void
    {
        $moon = new Moon();
        // 上弦 2023-01-28 15:19 UTC (k2=1522, phase=0.25)
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.25);
        $this->assertEqualsWithDelta(
            1674919140,
            $result->getTimestamp(),
            300,
            '2023-01-28 上弦の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_fullMoon_feb2023_accuracy(): void
    {
        $moon = new Moon();
        // 満月 2023-02-05 18:29 UTC (k2=1522, phase=0.5)
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.5);
        $this->assertEqualsWithDelta(
            1675621740,
            $result->getTimestamp(),
            300,
            '2023-02-05 満月の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_lastQuarter_feb2023_accuracy(): void
    {
        $moon = new Moon();
        // 下弦 2023-02-13 16:01 UTC (k2=1522, phase=0.75)
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.75);
        $this->assertEqualsWithDelta(
            1676304060,
            $result->getTimestamp(),
            300,
            '2023-02-13 下弦の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_previousNewMoon_dec2022_accuracy(): void
    {
        $moon = new Moon();
        // 新月 2022-12-23 10:17 UTC (k1=1521, is_next=true)
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0, true);
        $this->assertEqualsWithDelta(
            1671790620,
            $result->getTimestamp(),
            300,
            '2022-12-23 新月 (is_next=true) の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_nearNewMoon_jan2023_accuracy(): void
    {
        $moon = new Moon();
        // 新月当日 (近接判定分岐) も同じ結果を返す
        // 新月 2023-01-21 20:53 UTC, タイムスタンプ = 1674334380
        $date = new DateTime('2023-01-21 20:53:00', new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, 0.0);
        $this->assertEqualsWithDelta(
            1674334380,
            $result->getTimestamp(),
            300,
            '2023-01-21 新月当日の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }

    // ==================== 国立天文台(NAOJ) 実測値による検証 (2011年7月) ====================
    //
    // 出典: 国立天文台 暦要項 平成23年(2011) 朔弦望（日本標準時 JST = UTC+9）
    //   朔  : 2011-07-01 17:54 JST
    //   上弦: 2011-07-08 15:29 JST
    //   望  : 2011-07-15 15:40 JST
    //   下弦: 2011-07-23 14:02 JST
    //   朔  : 2011-07-31 03:40 JST
    //
    // truePhase() のオフセットバグ (+32400-60) が混入していた場合、ここでの照合結果は
    // 実測値から約9時間ズレるため検出できる。

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_newMoon_jul2011_matchesNaoj(): void
    {
        $moon = new Moon();
        $expected = new DateTime('2011-07-01 17:54:00', new DateTimeZone('Asia/Tokyo'));
        $result = $moon->moonPhase(new DateTime('2011-07-09 09:00:00', new DateTimeZone('Asia/Tokyo')), 0.0, true);

        $this->assertEqualsWithDelta(
            $expected->getTimestamp(),
            $result->getTimestamp(),
            300,
            '2011-07-01 朔の moonPhase 誤差が ±5 分を超えています (国立天文台 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_firstQuarter_jul2011_matchesNaoj(): void
    {
        $moon = new Moon();
        $expected = new DateTime('2011-07-08 15:29:00', new DateTimeZone('Asia/Tokyo'));
        $result = $moon->moonPhase(new DateTime('2011-07-09 09:00:00', new DateTimeZone('Asia/Tokyo')), 0.25, true);

        $this->assertEqualsWithDelta(
            $expected->getTimestamp(),
            $result->getTimestamp(),
            300,
            '2011-07-08 上弦の moonPhase 誤差が ±5 分を超えています (国立天文台 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_fullMoon_jul2011_matchesNaoj(): void
    {
        $moon = new Moon();
        $expected = new DateTime('2011-07-15 15:40:00', new DateTimeZone('Asia/Tokyo'));
        $result = $moon->moonPhase(new DateTime('2011-07-09 09:00:00', new DateTimeZone('Asia/Tokyo')), 0.5, true);

        $this->assertEqualsWithDelta(
            $expected->getTimestamp(),
            $result->getTimestamp(),
            300,
            '2011-07-15 望の moonPhase 誤差が ±5 分を超えています (国立天文台 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_lastQuarter_jul2011_matchesNaoj(): void
    {
        $moon = new Moon();
        $expected = new DateTime('2011-07-23 14:02:00', new DateTimeZone('Asia/Tokyo'));
        $result = $moon->moonPhase(new DateTime('2011-07-09 09:00:00', new DateTimeZone('Asia/Tokyo')), 0.75, true);

        $this->assertEqualsWithDelta(
            $expected->getTimestamp(),
            $result->getTimestamp(),
            300,
            '2011-07-23 下弦の moonPhase 誤差が ±5 分を超えています (国立天文台 基準)'
        );
    }

    // ==================== 中間 4 位相 (三日月・十三夜・十六夜・有明) のテスト ====================
    //
    // 中間 4 位相は Legacy 補正式が存在しないため、隣接する 2 つの標準位相時刻の
    // 中点として近似される (moonPhaseByLegacyMidpoint)。
    // 以下のテストでは「moonPhase が返した時刻」が「隣接 2 位相の Legacy 計算時刻の中点」と
    // 一致することを確認する。

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_crescent_jan2023_isMidpointOfNewMoonAndFirstQuarter(): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        $newMoon = $moon->moonPhase($base, 0.0);
        $firstQuarter = $moon->moonPhase($newMoon, 0.25);
        $expectedMidpoint = (int) round(($newMoon->getTimestamp() + $firstQuarter->getTimestamp()) / 2);

        $result = $moon->moonPhase($base, 0.125);

        $this->assertEqualsWithDelta(
            $expectedMidpoint,
            $result->getTimestamp(),
            1,
            '2023-01 三日月の moonPhase が「新月と上弦の中点」と一致しません'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_thirteenNight_jan2023_isMidpointOfFirstQuarterAndFullMoon(): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        $firstQuarter = $moon->moonPhase($base, 0.25);
        $fullMoon = $moon->moonPhase($firstQuarter, 0.5);
        $expectedMidpoint = (int) round(($firstQuarter->getTimestamp() + $fullMoon->getTimestamp()) / 2);

        $result = $moon->moonPhase($base, 0.375);

        $this->assertEqualsWithDelta(
            $expectedMidpoint,
            $result->getTimestamp(),
            1,
            '2023-01 十三夜の moonPhase が「上弦と満月の中点」と一致しません'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_sixteenNight_jan2023_isMidpointOfFullMoonAndLastQuarter(): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        $fullMoon = $moon->moonPhase($base, 0.5);
        $lastQuarter = $moon->moonPhase($fullMoon, 0.75);
        $expectedMidpoint = (int) round(($fullMoon->getTimestamp() + $lastQuarter->getTimestamp()) / 2);

        $result = $moon->moonPhase($base, 0.625);

        $this->assertEqualsWithDelta(
            $expectedMidpoint,
            $result->getTimestamp(),
            1,
            '2023-01 十六夜の moonPhase が「満月と下弦の中点」と一致しません'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_dawnMoon_jan2023_isMidpointOfLastQuarterAndNextNewMoon(): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        // 有明: 下弦 → 次の新月（upperPhase が 1.0 を超えて 0.0 に回り込むケース）
        $lastQuarter = $moon->moonPhase($base, 0.75);
        $nextNewMoon = $moon->moonPhase($lastQuarter, 0.0);
        $expectedMidpoint = (int) round(($lastQuarter->getTimestamp() + $nextNewMoon->getTimestamp()) / 2);

        $result = $moon->moonPhase($base, 0.875);

        $this->assertEqualsWithDelta(
            $expectedMidpoint,
            $result->getTimestamp(),
            1,
            '2023-01 有明の moonPhase が「下弦と次の新月の中点」と一致しません'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_intermediatePhases_isNextTrue_useSamePeriod(): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        // is_next=true: 基準日時より前の三日月を探す（前の朔望月の新月-上弦の中点）
        $previousNewMoon = $moon->moonPhase($base, 0.0, true);
        $followingFirstQuarter = $moon->moonPhase($previousNewMoon, 0.25);
        $expectedMidpoint = (int) round(
            ($previousNewMoon->getTimestamp() + $followingFirstQuarter->getTimestamp()) / 2
        );

        $result = $moon->moonPhase($base, 0.125, true);

        $this->assertEqualsWithDelta(
            $expectedMidpoint,
            $result->getTimestamp(),
            1,
            'is_next=true 時の三日月が「前の新月と直後の上弦の中点」と一致しません'
        );
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByLegacyMidpoint_directCall_crescent(): void
    {
        $moon = new Moon();
        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        // upperPhase < 1.0 のパス（lowerPhase=0.0, upperPhase=0.25）
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByLegacyMidpoint', [$date, 0.125, false]);

        $this->assertInstanceOf(Carbon::class, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByLegacyMidpoint_directCall_dawnMoon_wrapsAround(): void
    {
        $moon = new Moon();
        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        // upperPhase >= 1.0 のパス（lowerPhase=0.75, upperPhase=0.0 に回り込む）
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByLegacyMidpoint', [$date, 0.875, false]);

        $this->assertInstanceOf(Carbon::class, $result);
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_eightPhasesByElp2000_intermediateBetweenStandard(): void
    {
        $solarBackup = Astronomy::solarAlgorithm();
        $moonBackup = Astronomy::moonAlgorithm();

        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);

            $moon = new Moon();
            // 2023-01-21 新月の直後を基準にすることで、後続の全位相が同一の朔望月内で取得できる
            $base = new DateTime('2023-01-22 00:00:00', new DateTimeZone('UTC'));

            // 参照時刻 (USNO データ):
            //   新月 2023-01-21 20:53 UTC = 1674334380
            //   上弦 2023-01-28 15:19 UTC = 1674919140
            //   満月 2023-02-05 18:29 UTC = 1675621740
            //   下弦 2023-02-13 16:01 UTC = 1676304060
            //   新月 2023-02-20 07:06 UTC = 1676876760
            $firstQuarter = $moon->moonPhase($base, 0.25)->getTimestamp();
            $fullMoon = $moon->moonPhase($base, 0.5)->getTimestamp();
            $lastQuarter = $moon->moonPhase($base, 0.75)->getTimestamp();
            $nextNewMoon = $moon->moonPhase($base, 0.0)->getTimestamp();
            $previousNewMoon = $moon->moonPhase($base, 0.0, true)->getTimestamp();

            $crescent = $moon->moonPhase($base, 0.125)->getTimestamp();
            $thirteenNight = $moon->moonPhase($base, 0.375)->getTimestamp();
            $sixteenNight = $moon->moonPhase($base, 0.625)->getTimestamp();
            // 有明は下弦の直後を基準にすることで、同一朔望月の下弦〜新月の間に収まる
            $dawnMoon = $moon->moonPhase(
                new DateTime('2023-02-14 00:00:00', new DateTimeZone('UTC')),
                0.875
            )->getTimestamp();

            // 中間 4 位相が隣接する標準 2 位相の間に入っていることを確認する
            $this->assertGreaterThan($previousNewMoon, $crescent, '三日月が新月より前になっています');
            $this->assertLessThan($firstQuarter, $crescent, '三日月が上弦より後になっています');

            $this->assertGreaterThan($firstQuarter, $thirteenNight, '十三夜が上弦より前になっています');
            $this->assertLessThan($fullMoon, $thirteenNight, '十三夜が満月より後になっています');

            $this->assertGreaterThan($fullMoon, $sixteenNight, '十六夜が満月より前になっています');
            $this->assertLessThan($lastQuarter, $sixteenNight, '十六夜が下弦より後になっています');

            $this->assertGreaterThan($lastQuarter, $dawnMoon, '有明が下弦より前になっています');
            $this->assertLessThan($nextNewMoon, $dawnMoon, '有明が次の新月より後になっています');

            // 標準 4 位相は USNO データと整合 (±5 分)
            $this->assertEqualsWithDelta(1674919140, $firstQuarter, 300, '2023-01-28 上弦 (ELP2000) の誤差超過');
            $this->assertEqualsWithDelta(1675621740, $fullMoon, 300, '2023-02-05 満月 (ELP2000) の誤差超過');
            $this->assertEqualsWithDelta(1676304060, $lastQuarter, 300, '2023-02-13 下弦 (ELP2000) の誤差超過');
            $this->assertEqualsWithDelta(1676876760, $nextNewMoon, 300, '2023-02-20 新月 (ELP2000) の誤差超過');
        } finally {
            Astronomy::useSolarAlgorithm($solarBackup);
            Astronomy::useMoonAlgorithm($moonBackup);
        }
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_crescent_jul2011_aroundNaojMidpoint(): void
    {
        $moon = new Moon();
        // NAOJ 実測値: 2011-07-01 17:54 JST 新月, 2011-07-08 15:29 JST 上弦
        $naojNewMoon = new DateTime('2011-07-01 17:54:00', new DateTimeZone('Asia/Tokyo'));
        $naojFirstQuarter = new DateTime('2011-07-08 15:29:00', new DateTimeZone('Asia/Tokyo'));
        $naojMidpoint = (int) round(
            ($naojNewMoon->getTimestamp() + $naojFirstQuarter->getTimestamp()) / 2
        );

        $result = $moon->moonPhase(
            new DateTime('2011-07-09 09:00:00', new DateTimeZone('Asia/Tokyo')),
            0.125,
            true
        );

        $this->assertEqualsWithDelta(
            $naojMidpoint,
            $result->getTimestamp(),
            600,
            '2011-07 三日月の moonPhase 誤差が ±10 分を超えています (NAOJ 4 位相中点 基準)'
        );
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhase_dawnMoon_jul2011_aroundNaojMidpoint(): void
    {
        $moon = new Moon();
        // NAOJ 実測値: 2011-07-23 14:02 JST 下弦, 2011-07-31 03:40 JST 新月
        $naojLastQuarter = new DateTime('2011-07-23 14:02:00', new DateTimeZone('Asia/Tokyo'));
        $naojNextNewMoon = new DateTime('2011-07-31 03:40:00', new DateTimeZone('Asia/Tokyo'));
        $naojMidpoint = (int) round(
            ($naojLastQuarter->getTimestamp() + $naojNextNewMoon->getTimestamp()) / 2
        );

        // 基準日は 2011-07-09 09:00 JST (既存 NAOJ テストと同じ)。
        // is_next=true で 0.875 を探すと、moonPhaseByLegacyMidpoint が
        // 「前の朔望月 (2011-07-01 新月) の下弦 (2011-07-23) → 直後の新月 (2011-07-31) → 中点」を計算する。
        $result = $moon->moonPhase(
            new DateTime('2011-07-09 09:00:00', new DateTimeZone('Asia/Tokyo')),
            0.875,
            true
        );

        $this->assertEqualsWithDelta(
            $naojMidpoint,
            $result->getTimestamp(),
            600,
            '2011-07 有明の moonPhase 誤差が ±10 分を超えています (NAOJ 4 位相中点 基準)'
        );
    }

    // ==================== meeus47 ルート確認 ====================

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_meeus47_routes_to_moonPhaseByAstronomy(): void
    {
        $spy = new MoonRouteSpy(new Astronomy(null, new MeeusMoon(applyNasaCCorrection: true)));
        foreach ([0.0, 0.25, 0.5, 0.75] as $phase) {
            $spy->reset();
            $spy->moonPhase(new DateTimeImmutable('2024-01-01'), $phase);
            $this->assertGreaterThan(0, $spy->byAstronomyCount, "meeus47 phase=$phase → byAstronomy");
            $this->assertSame(0, $spy->byLegacyCount, "meeus47 phase=$phase → not byLegacy");
        }
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_meeus47_no_c_routes_to_moonPhaseByAstronomy(): void
    {
        $spy = new MoonRouteSpy(new Astronomy(null, new MeeusMoon(applyNasaCCorrection: false)));
        foreach ([0.0, 0.25, 0.5, 0.75] as $phase) {
            $spy->reset();
            $spy->moonPhase(new DateTimeImmutable('2024-01-01'), $phase);
            $this->assertGreaterThan(0, $spy->byAstronomyCount, "meeus47_no_c phase=$phase → byAstronomy");
            $this->assertSame(0, $spy->byLegacyCount, "meeus47_no_c phase=$phase → not byLegacy");
        }
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \ReflectionException
     */
    public function test_legacy_routes_to_moonPhaseByLegacy(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $spy = new MoonRouteSpy(Astronomy::factory());
            foreach ([0.0, 0.25, 0.5, 0.75] as $phase) {
                $spy->reset();
                $spy->moonPhase(new DateTimeImmutable('2024-01-01'), $phase);
                $this->assertSame(0, $spy->byAstronomyCount, "legacy phase=$phase → not byAstronomy");
                $this->assertGreaterThan(0, $spy->byLegacyCount, "legacy phase=$phase → byLegacy");
            }
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
}

/**
 * moonPhaseByAstronomy / moonPhaseByLegacy の呼び出しを記録するスパイ。
 */
class MoonRouteSpy extends Moon
{
    public int $byAstronomyCount = 0;

    public int $byLegacyCount = 0;

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->byAstronomyCount = 0;
        $this->byLegacyCount = 0;
    }

    /**
     * @noinspection PhpUnused — Moon::moonPhase() 内部から委譲呼び出しされる
     * @param \DateTimeInterface $date
     * @param float $phase
     * @param bool $is_next
     * @return \Carbon\Carbon
     */
    protected function moonPhaseByAstronomy(DateTimeInterface $date, float $phase, bool $is_next): Carbon
    {
        $this->byAstronomyCount++;

        return Carbon::createFromTimestampUTC(0);
    }

    /**
     * @noinspection PhpUnused — Moon::moonPhase() 内部から委譲呼び出しされる
     * @param \DateTimeInterface $date
     * @param float $phase
     * @param bool $is_next
     * @return \Carbon\Carbon
     */
    protected function moonPhaseByLegacy(DateTimeInterface $date, float $phase, bool $is_next): Carbon
    {
        $this->byLegacyCount++;

        return Carbon::createFromTimestampUTC(0);
    }
}
