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
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Components\MeeusMoon;
use JapaneseDate\Components\Moon;
use JapaneseDate\Components\Vsop87Astronomy;
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
 * @covers \JapaneseDate\Components\Moon
 */
class MoonTest extends TestCase
{
    use InvokeTrait;
    // ==================== uts2Julian / julian2Uts 変換精度テスト ====================
    /**
     * ELP2000 経路の新月計算を国立天文台データと照合するケースを返す。
     *
     * @return array<string, array{string, string, int}>
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
     * Unix タイムスタンプとユリウス日の相互変換を確認するケースを返す。
     *
     * @return array<string, array{string, int|float, float}>
     */
    public static function julianConversionDataProvider(): array
    {
        return [
            'Unix エポックをユリウス日へ変換' => ['uts2Julian', 0, 2440587.5],
            'J2000.0 をユリウス日へ変換' => ['uts2Julian', 946728000, 2451545.0],
            '既知日付をユリウス日へ変換' => ['uts2Julian', 1674259200, 2459965.5],
            'Unix エポックのユリウス日を UTC 秒へ変換' => ['julian2Uts', 2440587.5, 0.0],
            'J2000.0 のユリウス日を UTC 秒へ変換' => ['julian2Uts', 2451545.0, 946728000.0],
            '既知ユリウス日を UTC 秒へ変換' => ['julian2Uts', 2459965.5, 1674259200.0],
        ];
    }
    /**
     * truePhase が主要 4 位相で補正値を返すことを確認するケースを返す。
     *
     * @return array<string, array{float}>
     */
    public static function truePhaseReturnDataProvider(): array
    {
        return [
            '新月補正' => [0.0],
            '満月補正' => [0.5],
            '上弦補正' => [0.25],
            '下弦補正' => [0.75],
        ];
    }
    /**
     * truePhase の実データ精度を USNO データと照合するケースを返す。
     *
     * @return array<string, array{float, float, int, string}>
     */
    public static function truePhaseAccuracyDataProvider(): array
    {
        return [
            '2023-01-21 新月' => [1522.0, 0.0, 1674334380, '2023-01-21 新月'],
            '2022-12-23 新月' => [1521.0, 0.0, 1671790620, '2022-12-23 新月'],
            '2023-01-28 上弦' => [1522.0, 0.25, 1674919140, '2023-01-28 上弦'],
            '2023-02-05 満月' => [1522.0, 0.5, 1675621740, '2023-02-05 満月'],
            '2023-02-13 下弦' => [1522.0, 0.75, 1676304060, '2023-02-13 下弦'],
        ];
    }
    /**
     * moonPhase が主要位相・探索方向・近接判定で Carbon を返すことを確認するケースを返す。
     *
     * @return array<string, array{string, float, bool}>
     */
    public static function moonPhaseReturnDataProvider(): array
    {
        return [
            '指定日以後の新月' => ['2023-01-15 00:00:00', 0.0, false],
            '指定日以後の満月' => ['2023-01-15 00:00:00', 0.5, false],
            '指定日以後の上弦' => ['2023-01-15 00:00:00', 0.25, false],
            '指定日以後の下弦' => ['2023-01-15 00:00:00', 0.75, false],
            '指定日前の新月' => ['2023-01-15 00:00:00', 0.0, true],
            '新月時刻付近の近接判定' => ['2023-01-21 20:53:00', 0.0, false],
        ];
    }
    /**
     * moonPhase の実データ精度を USNO データと照合するケースを返す。
     *
     * @return array<string, array{string, float, bool, int, string}>
     */
    public static function moonPhaseAccuracyDataProvider(): array
    {
        return [
            '2023-01-21 新月' => ['2023-01-15 00:00:00', 0.0, false, 1674334380, '2023-01-21 新月'],
            '2023-01-28 上弦' => ['2023-01-15 00:00:00', 0.25, false, 1674919140, '2023-01-28 上弦'],
            '2023-02-05 満月' => ['2023-01-15 00:00:00', 0.5, false, 1675621740, '2023-02-05 満月'],
            '2023-02-13 下弦' => ['2023-01-16 00:00:00', 0.75, false, 1676304060, '2023-02-13 下弦'],
            '2022-12-23 直前新月' => ['2023-01-15 00:00:00', 0.0, true, 1671790620, '2022-12-23 新月 (is_next=true)'],
            '2023-01-21 新月当日' => ['2023-01-21 20:53:00', 0.0, false, 1674334380, '2023-01-21 新月当日'],
        ];
    }
    /**
     * 2011 年 7 月の moonPhase を国立天文台データと照合するケースを返す。
     *
     * @return array<string, array{string, float, bool, string, string}>
     */
    public static function naoj2011MoonPhaseDataProvider(): array
    {
        return [
            '2011-07-01 朔' => ['2011-07-09 09:00:00', 0.0, true, '2011-07-01 17:54:00', '2011-07-01 朔'],
            '2011-07-08 上弦' => ['2011-07-09 09:00:00', 0.25, true, '2011-07-08 15:29:00', '2011-07-08 上弦'],
            '2011-07-15 望' => ['2011-07-16 00:00:00', 0.5, true, '2011-07-15 15:40:00', '2011-07-15 望'],
            '2011-07-23 下弦' => ['2011-07-25 00:00:00', 0.75, true, '2011-07-23 14:02:00', '2011-07-23 下弦'],
        ];
    }
    /**
     * 中間 4 位相が隣接する標準位相の中点として返ることを確認するケースを返す。
     *
     * @return array<string, array{float, float, float, string, bool}>
     */
    public static function legacyMidpointDataProvider(): array
    {
        return [
            '三日月は新月と上弦の中点' => [0.125, 0.0, 0.25, '新月と上弦の中点', false],
            '十三夜は上弦と満月の中点' => [0.375, 0.25, 0.5, '上弦と満月の中点', false],
            '十六夜は満月と下弦の中点' => [0.625, 0.5, 0.75, '満月と下弦の中点', false],
            '有明は下弦と次の新月の中点' => [0.875, 0.75, 0.0, '下弦と次の新月の中点', false],
            'is_next=true の三日月は前の新月と直後の上弦の中点' => [0.125, 0.0, 0.25, '前の新月と直後の上弦の中点', true],
        ];
    }
    /**
     * moonPhaseByLegacyMidpoint の直接呼び出しで通常経路と位相回り込み経路を確認するケースを返す。
     *
     * @return array<string, array{float}>
     */
    public static function legacyMidpointDirectCallDataProvider(): array
    {
        return [
            'upperPhase が 1.0 未満の三日月' => [0.125],
            'upperPhase が 1.0 を超えて回り込む有明' => [0.875],
        ];
    }
    /**
     * Unix タイムスタンプとユリウス日の相互変換が定義済み基準値と一致することを確認する。
     *
     * @param string $conversion
     * @param int|float $input
     * @param float $expected
     * @throws \ReflectionException
     * @dataProvider julianConversionDataProvider
     */
    public function test_julianConversions($conversion, $input, $expected): void
    {
        $moon = new Moon();
        switch ($conversion) {
            case 'uts2Julian':
                $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [$input]);
                break;
            case 'julian2Uts':
                $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [$input]);
                break;
        }
        $this->assertSame($expected, $result);
    }
    // ==================== meanPhase ====================
    /**
     * Unix タイムスタンプをユリウス日へ変換して戻すと元の値へ戻ることを確認する。
     *
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
     * meanPhase がユリウス日として妥当な浮動小数点数を返すことを確認する。
     *
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
     * truePhase が主要 4 位相の補正結果を浮動小数点数として返すことを確認する。
     *
     * @param float $phase
     * @throws \ReflectionException
     * @dataProvider truePhaseReturnDataProvider
     */
    public function test_truePhase_returnsFloat($phase): void
    {
        $moon = new Moon();
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, $phase]);
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
     * 対応していない位相では truePhase が補正値を返さないことを確認する。
     *
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
     * truePhase の主要 4 位相が実データに対して ±5 分以内で一致することを確認する。
     *
     * @param float $k
     * @param float $phase
     * @param int $expected
     * @param string $label
     * @throws \ReflectionException
     * @dataProvider truePhaseAccuracyDataProvider
     */
    public function test_truePhase_accuracy($k, $phase, $expected, $label): void
    {
        $moon = new Moon();
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [$k, $phase]);
        $this->assertEqualsWithDelta(
            $expected,
            $result,
            300,
            $label . 'の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    // ==================== moonPhase 分岐テスト ====================
    // is_next=false → k2 (次の朔望月の新月基準)
    /**
     * 無効な位相を指定した場合に ErrorException が発生することを確認する。
     *
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
     * moonPhase が受け付ける 8 位相のケースを返す。
     *
     * @return array<string, array{float}>
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
     * moonPhase が 8 位相すべてを受け付け、Carbon を返すことを確認する。
     *
     * @param float $phase 位相
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider eightPhasesProvider
     */
    public function test_moonPhase_acceptsAllEightPhases($phase): void
    {
        $moon = new Moon();
        // 8 相のいずれを指定しても ErrorException が発生せず Carbon が返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), $phase);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }
    /**
     * moonPhase が拒否する未対応位相のケースを返す。
     *
     * @return array<string, array{float}>
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
     * 未対応位相では moonPhase が ErrorException を投げることを確認する。
     *
     * @param float $phase 位相
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider invalidPhaseProvider
     */
    public function test_moonPhase_throwsForUnsupportedPhase($phase): void
    {
        $moon = new Moon();
        $this->expectException(ErrorException::class);
        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), $phase);
    }
    /**
     * moonPhase が主要位相・探索方向・新月近接判定で Carbon を返すことを確認する。
     *
     * @param string $date 探索基準日時（UTC）
     * @param float $phase 位相
     * @param bool $isNext is_next フラグ
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider moonPhaseReturnDataProvider
     */
    public function test_moonPhase_returnsCarbon($date, $phase, $isNext): void
    {
        $moon = new Moon();
        $result = $moon->moonPhase(new DateTime($date, new DateTimeZone('UTC')), $phase, $isNext);
        /** @noinspection UnnecessaryAssertionInspection PhpConditionAlreadyCheckedInspection — moonPhase() の実行時戻り値型を確認する */
        $this->assertInstanceOf(Carbon::class, $result);
    }
    /**
     * ELP2000 選択時に moonPhase が旧 truePhase 経路へフォールバックしないことを確認する。
     *
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_moonPhaseDoesNotUseLegacyTruePhaseWhenMoonElp2000Selected(): void
    {
        $elp2000Astronomy = new Astronomy(null, new ELP2000());

        $moon = new class ($elp2000Astronomy) extends Moon {
            /**
             * @var bool
             */
            public $legacyTruePhaseCalled = false;

            /**
             * @noinspection PhpUnused — Moon::moonPhase() 内部から委譲呼び出しされる
             * @param float $k
             * @param float $phase
             * @return float|null
             */
            protected function truePhase($k, $phase): ?float
            {
                $this->legacyTruePhaseCalled = true;

                return parent::truePhase($k, $phase);
            }
        };

        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $this->assertFalse($moon->legacyTruePhaseCalled);
    }
    /**
     * Legacy 経路の moonPhaseByLegacy が Carbon インスタンスを返すことを確認する。
     *
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
     * 天文学計算経路で探索開始時刻が目標位相と一致する場合に、その時刻の Carbon が返ることを確認する。
     *
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
            protected function phaseDeltaAt($timestamp, $targetAngle): float
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
     * 天文学計算経路で位相交差が見つからない場合に Legacy 経路へフォールバックすることを確認する。
     *
     * @throws \ReflectionException
     */
    public function test_moonPhaseByAstronomyFallsBackWhenNoCrossingIsFound(): void
    {
        $moon = new class () extends Moon {
            /**
             * @var bool
             */
            public $fallbackCalled = false;

            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             */
            protected function phaseDeltaAt($timestamp, $targetAngle): float
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
            protected function moonPhaseByLegacy($date, $phase, $is_next): Carbon
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
     * 標準位相以外の探索で位相交差が見つからない場合に例外を投げることを確認する。
     *
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
            protected function phaseDeltaAt($timestamp, $targetAngle): float
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
     * ELP2000 経路の新月計算が国立天文台データと一致することを確認する。
     *
     * @param string $searchDate 探索基準日時（UTC）
     * @param string $expectedNewMoon 期待する新月時刻（Asia/Tokyo）
     * @param int $deltaSeconds 許容秒数
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider elp2000NewMoonProvider
     */
    public function test_moonPhaseByElp2000MatchesNaojNewMoonTime($searchDate, $expectedNewMoon, $deltaSeconds): void
    {
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
     * moonPhase が USNO 実データに対して ±5 分以内で一致することを確認する。
     *
     * @param string $searchDate 探索基準日時（UTC）
     * @param float $phase 位相
     * @param bool $isNext is_next フラグ
     * @param int $expected 期待タイムスタンプ
     * @param string $label エラーメッセージ用イベント名
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider moonPhaseAccuracyDataProvider
     */
    public function test_moonPhase_accuracy($searchDate, $phase, $isNext, $expected, $label): void
    {
        $moon = new Moon();
        $result = $moon->moonPhase(new DateTime($searchDate, new DateTimeZone('UTC')), $phase, $isNext);
        $this->assertEqualsWithDelta(
            $expected,
            $result->getTimestamp(),
            300,
            $label . 'の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
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
     * 2011 年 7 月の主要 4 位相が国立天文台データと ±5 分以内で一致することを確認する。
     *
     * @param string $searchDate 探索基準日時（Asia/Tokyo）
     * @param float $phase 位相
     * @param bool $isNext is_next フラグ
     * @param string $expectedDate 期待日時（Asia/Tokyo）
     * @param string $label エラーメッセージ用イベント名
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider naoj2011MoonPhaseDataProvider
     */
    public function test_moonPhase_jul2011_matchesNaoj($searchDate, $phase, $isNext, $expectedDate, $label): void
    {
        $moon = new Moon();
        $expected = new DateTime($expectedDate, new DateTimeZone('Asia/Tokyo'));
        $result = $moon->moonPhase(new DateTime($searchDate, new DateTimeZone('Asia/Tokyo')), $phase, $isNext);
        $this->assertEqualsWithDelta(
            $expected->getTimestamp(),
            $result->getTimestamp(),
            300,
            $label . 'の moonPhase 誤差が ±5 分を超えています (国立天文台 基準)'
        );
    }
    // ==================== 中間 4 位相 (三日月・十三夜・十六夜・有明) のテスト ====================
    //
    // 中間 4 位相は Legacy 補正式が存在しないため、隣接する 2 つの標準位相時刻の
    // 中点として近似される (moonPhaseByLegacyMidpoint)。
    // 以下のテストでは「moonPhase が返した時刻」が「隣接 2 位相の Legacy 計算時刻の中点」と
    // 一致することを確認する。
    /**
     * 中間位相が隣接する標準 2 位相の中点として返ることを確認する。
     *
     * @param float $targetPhase 検証対象の中間位相
     * @param float $lowerPhase 中点計算に使う前側の標準位相
     * @param float $upperPhase 中点計算に使う後側の標準位相
     * @param string $label エラーメッセージ用の中点説明
     * @param bool $isNext is_next フラグ
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider legacyMidpointDataProvider
     */
    public function test_moonPhase_intermediatePhase_isMidpoint($targetPhase, $lowerPhase, $upperPhase, $label, $isNext): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));
        $lower = $moon->moonPhase($base, $lowerPhase, $isNext);
        $upper = $moon->moonPhase($lower, $upperPhase);
        $expectedMidpoint = (int) round(($lower->getTimestamp() + $upper->getTimestamp()) / 2);
        $result = $moon->moonPhase($base, $targetPhase, $isNext);
        $this->assertEqualsWithDelta(
            $expectedMidpoint,
            $result->getTimestamp(),
            1,
            '2023-01 の moonPhase が「' . $label . '」と一致しません'
        );
    }
    /**
     * moonPhaseByLegacyMidpoint を直接呼び出し、通常経路と位相回り込み経路で Carbon が返ることを確認する。
     *
     * @param float $phase 中間位相
     * @throws \ReflectionException
     * @dataProvider legacyMidpointDirectCallDataProvider
     */
    public function test_moonPhaseByLegacyMidpoint_directCall($phase): void
    {
        $moon = new Moon();
        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByLegacyMidpoint', [$date, $phase, false]);
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

        // 基準日を 2011-07-24 とする（Jul 23 下弦の翌日）。
        // is_next=true で 0.875 を探すと、moonPhaseByLegacyMidpoint が
        // 「前の朔望月 (Jul 23 下弦) → 直後の新月 (Jul 31) → 中点」を計算する。
        // Jul 23 ≤ Jul 24 が成立するため k1 サイクルが下弦として選ばれる。
        $result = $moon->moonPhase(
            new DateTime('2011-07-24 00:00:00', new DateTimeZone('Asia/Tokyo')),
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
        $spy = new MoonRouteSpy(new Astronomy(null, new MeeusMoon(true)));
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
        $spy = new MoonRouteSpy(new Astronomy(null, new MeeusMoon(false)));
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
    // ==================== ELP2000 高速化: 経路検証テスト ====================
    /**
     * ELP2000 選択時に粗探索で phaseDeltaAtFast() が呼ばれることを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_elp2000_phaseDeltaAtFast_calledDuringRoughSearch(): void
    {
        $spy = new class(new Astronomy(null, new ELP2000())) extends Moon {
            /**
             * @var int
             */
            public $fastDeltaCalls = 0;

            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             * @throws \DateInvalidTimeZoneException
             * @throws \JapaneseDate\Exceptions\Exception
             */
            protected function phaseDeltaAtFast($timestamp, $targetAngle): float
            {
                $this->fastDeltaCalls++;

                return parent::phaseDeltaAtFast($timestamp, $targetAngle);
            }
        };

        $spy->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $this->assertGreaterThan(0, $spy->fastDeltaCalls, 'ELP2000 選択時は粗探索で phaseDeltaAtFast が呼ばれる必要があります');
    }
    /**
     * ELP2000 選択時に最終補正で phaseDeltaAt()（フル精度）が呼ばれることを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_elp2000_snapToFullPrecision_callsFullPrecisionDelta(): void
    {
        $spy = new class(new Astronomy(null, new ELP2000())) extends Moon {
            /**
             * @var int
             */
            public $fullDeltaCalls = 0;

            /**
             * @noinspection PhpUnused — snapToFullPrecision() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             * @throws \DateInvalidTimeZoneException
             * @throws \JapaneseDate\Exceptions\Exception
             */
            protected function phaseDeltaAt($timestamp, $targetAngle): float
            {
                $this->fullDeltaCalls++;

                return parent::phaseDeltaAt($timestamp, $targetAngle);
            }
        };

        $spy->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $this->assertGreaterThan(0, $spy->fullDeltaCalls, 'ELP2000 選択時は最終補正で phaseDeltaAt（フル精度）が呼ばれる必要があります');
    }
    /**
     * ELP2000 高速探索で開始時刻が目標位相と一致する場合に、フル精度補正した時刻が返ることを検証する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_elp2000_moonPhaseByAstronomySnapsPreviousTimestampWhenFastDeltaIsZero(): void
    {
        $moon = new class(new Astronomy(null, new ELP2000())) extends Moon {
            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             */
            protected function phaseDeltaAtFast($timestamp, $targetAngle): float
            {
                return 0.0;
            }

            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $approxTimestamp
             * @param float $targetAngle
             * @return int
             */
            protected function snapToFullPrecision($approxTimestamp, $targetAngle): int
            {
                return $approxTimestamp + 123;
            }
        };

        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByAstronomy', [$date, 0.0, false]);

        $this->assertInstanceOf(Carbon::class, $result);
        $this->assertSame($date->getTimestamp() + 123, $result->getTimestamp());
    }
    /**
     * フル精度補正が十分小さい誤差で即収束する場合に、補正ループを終了することを検証する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_snapToFullPrecisionBreaksWhenDeltaAlreadyConverged(): void
    {
        $moon = new class extends Moon {
            /**
             * @noinspection PhpUnused — snapToFullPrecision() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             */
            protected function phaseDeltaAt($timestamp, $targetAngle): float
            {
                return 0.0;
            }
        };

        $timestamp = 1674334380;
        $result = $this->invokeExecuteMethod($moon, 'snapToFullPrecision', [$timestamp, 0.0]);

        $this->assertSame($timestamp, $result);
    }
    /**
     * Legacy アルゴリズムでは phaseDeltaAtFast() が呼ばれないことを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \ReflectionException
     */
    public function test_legacy_doesNotUseFastDeltaPath(): void
    {
        try {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $spy = new class(Astronomy::factory()) extends Moon {
                /**
                 * @var int
                 */
                public $fastDeltaCalls = 0;

                /**
                 * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
                 * @param int $timestamp
                 * @param float $targetAngle
                 * @return float
                 * @throws \DateInvalidTimeZoneException
                 * @throws \JapaneseDate\Exceptions\Exception
                 */
                protected function phaseDeltaAtFast($timestamp, $targetAngle): float
                {
                    $this->fastDeltaCalls++;

                    return parent::phaseDeltaAtFast($timestamp, $targetAngle);
                }
            };

            $spy->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

            $this->assertSame(0, $spy->fastDeltaCalls, 'Legacy アルゴリズムでは phaseDeltaAtFast が呼ばれないはずです');
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
    /**
     * Meeus47 では phaseDeltaAtFast() が呼ばれないことを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_meeus47_doesNotUseFastDeltaPath(): void
    {
        $spy = new class(new Astronomy(null, new MeeusMoon(true))) extends Moon {
            /**
             * @var int
             */
            public $fastDeltaCalls = 0;

            /**
             * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
             * @param int $timestamp
             * @param float $targetAngle
             * @return float
             * @throws \DateInvalidTimeZoneException
             * @throws \JapaneseDate\Exceptions\Exception
             */
            protected function phaseDeltaAtFast($timestamp, $targetAngle): float
            {
                $this->fastDeltaCalls++;

                return parent::phaseDeltaAtFast($timestamp, $targetAngle);
            }
        };

        $spy->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $this->assertSame(0, $spy->fastDeltaCalls, 'Meeus47 では phaseDeltaAtFast が呼ばれないはずです');
    }
    /**
     * ELP2000 サブクラスでは reducedMoonImpl が生成されないことを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \ReflectionException
     */
    public function test_elp2000Subclass_doesNotCreateReducedMoonImpl(): void
    {
        $elp2000Subclass = new class extends ELP2000 {};
        $astronomy = new Astronomy(null, $elp2000Subclass);
        $moon = new Moon($astronomy);

        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $reducedImpl = $this->invokeGetProperty($astronomy, 'reducedMoonImpl');
        $this->assertNull($reducedImpl, 'ELP2000 サブクラスでは縮約版が生成されないはずです');
    }
    /**
     * 標準 ELP2000 では位相探索後に reducedMoonImpl が生成されることを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \ReflectionException
     */
    public function test_standardElp2000_createsReducedMoonImpl(): void
    {
        $astronomy = new Astronomy(null, new ELP2000());
        $moon = new Moon($astronomy);

        $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);

        $reducedImpl = $this->invokeGetProperty($astronomy, 'reducedMoonImpl');
        $this->assertNotNull($reducedImpl, '標準 ELP2000 では位相探索後に縮約版が生成されるはずです');
    }
    // ==================== ELP2000 高速化: フル精度との比較テスト ====================
    /**
     * ELP2000 高速探索結果をフル精度結果と比較するケースを返す。
     *
     * @return array<string, array{string, float, bool}>
     */
    public static function elp2000FastVsFullProvider(): array
    {
        return [
            '2023 January new moon forward' => ['2023-01-15 00:00:00', 0.0, false],
            '2023 January new moon backward' => ['2023-01-30 00:00:00', 0.0, true],
            '2023 January first quarter' => ['2023-01-15 00:00:00', 0.25, false],
            '2023 January full moon' => ['2023-01-15 00:00:00', 0.5, false],
            '2023 January last quarter' => ['2023-01-15 00:00:00', 0.75, false],
            '2020 year boundary new moon forward' => ['2020-12-30 00:00:00', 0.0, false],
            '2020 year boundary new moon backward' => ['2021-01-01 00:00:00', 0.0, true],
            '2015 April new moon' => ['2015-04-16 00:00:00', 0.0, false],
            '2015 August new moon near midnight' => ['2015-08-01 00:00:00', 0.0, false],
        ];
    }
    /**
     * ELP2000 高速探索結果がフル精度結果と 1 秒以内で一致することを検証する。
     *
     * @param string $searchDate 探索基準日時（UTC）
     * @param float $phase 位相
     * @param bool $isNext is_next フラグ
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider elp2000FastVsFullProvider
     */
    public function test_elp2000_fastResult_matchesFullPrecisionWithinOneSecond($searchDate, $phase, $isNext): void
    {
        $astronomy = new Astronomy(null, new ELP2000());
        $date = new DateTime($searchDate, new DateTimeZone('UTC'));
        $fastMoon = new Moon($astronomy);
        $fullPrecisionMoon = new FullPrecisionElp2000Moon($astronomy);
        $fastResult = $fastMoon->moonPhase($date, $phase, $isNext);
        $fullResult = $fullPrecisionMoon->moonPhase($date, $phase, $isNext);
        $this->assertEqualsWithDelta(
            $fullResult->getTimestamp(),
            $fastResult->getTimestamp(),
            1,
            sprintf(
                'ELP2000 高速探索結果がフル精度結果と 1 秒以上ずれています: fast=%d, full=%d, diff=%d',
                $fastResult->getTimestamp(),
                $fullResult->getTimestamp(),
                abs($fastResult->getTimestamp() - $fullResult->getTimestamp())
            )
        );
    }
    // ==================== ELP2000 高速化: 8 位相テスト ====================
    /**
     * ELP2000 経路で確認する 8 位相のケースを返す。
     *
     * @return array<string, array{float}>
     */
    public static function elp2000EightPhasesProvider(): array
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
     * ELP2000 選択時に 8 位相すべてで Carbon インスタンスが返ることを検証する。
     *
     * @param float $phase 位相
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider elp2000EightPhasesProvider
     */
    public function test_elp2000_allEightPhases_returnCarbon($phase): void
    {
        $moon = new Moon(new Astronomy(null, new ELP2000()));
        $date = new DateTime('2023-01-22 00:00:00', new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, $phase);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    /**
     * ELP2000 選択時に前方向・後方向の両方で Carbon インスタンスが返ることを検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_elp2000_forwardAndBackwardSearch_bothReturnCarbon(): void
    {
        $moon = new Moon(new Astronomy(null, new ELP2000()));
        $date = new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC'));

        $forward = $moon->moonPhase($date, 0.0, false);
        $backward = $moon->moonPhase($date, 0.0, true);

        $this->assertInstanceOf(Carbon::class, $forward);
        $this->assertInstanceOf(Carbon::class, $backward);
        $this->assertGreaterThan(
            $backward->getTimestamp(),
            $forward->getTimestamp(),
            '前方向探索の朔は後方向探索の朔より後の時刻でなければなりません'
        );
    }
    // ==================== ELP2000 高速化: 境界テスト ====================
    /**
     * 0°/360° 境界を跨ぐ新月（春分付近）が正しく検出されることを検証する。
     *
     * 春分前後では月黄経が 0°/360° を跨ぐため、位相角も境界を跨ぐ。
     * この境界を含む探索で偽検出が発生しないことを確認する。
     * 精度要件から VSOP87 太陽 + ELP2000 月の組み合わせで検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_elp2000_newMoonNearSpringEquinox_0_360_boundary(): void
    {
        $moon = new Moon(new Astronomy(new Vsop87Astronomy(), new ELP2000()));
        $date = new DateTime('2023-03-17 00:00:00', new DateTimeZone('UTC'));

        $result = $moon->moonPhase($date, 0.0);

        $this->assertInstanceOf(Carbon::class, $result);

        // NAOJ: 2023-03-22 02:23 JST = 2023-03-21 17:23 UTC
        $expected = (new DateTime('2023-03-22 02:23:00', new DateTimeZone('Asia/Tokyo')))->getTimestamp();
        $this->assertEqualsWithDelta(
            $expected,
            $result->getTimestamp(),
            300,
            '春分前後の新月 (0°/360° 境界) の ELP2000 探索精度が ±5 分を超えています'
        );
    }
    /**
     * 新月探索時に満月付近（180°）の偽交差を拾わないことを検証する。
     *
     * 探索開始日を満月直後に設定し、次の新月（位相角 0°）を前方探索する。
     * 偽検出の場合は満月付近の時刻を返すため、適切に除外されることを確認する。
     * NAOJ 精度比較のため VSOP87 太陽 + ELP2000 月の組み合わせで検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_elp2000_fullMoonProximity_doesNotProduceFalseCrossingForNewMoon(): void
    {
        $moon = new Moon(new Astronomy(new Vsop87Astronomy(), new ELP2000()));
        // 2023-02-05 18:29 UTC = 満月の翌日から新月探索
        $base = new DateTime('2023-02-06 00:00:00', new DateTimeZone('UTC'));

        $result = $moon->moonPhase($base, 0.0);

        // 正しい次の新月: 2023-02-20 07:06 UTC = 1676876760
        $expected = (new DateTime('2023-02-20 07:06:00', new DateTimeZone('UTC')))->getTimestamp();
        $this->assertEqualsWithDelta(
            $expected,
            $result->getTimestamp(),
            300,
            '満月付近起点での新月探索が 180° 偽交差を拾っています'
        );

        // 満月時刻（1675621740）と返り値が大きく離れていることも確認
        $this->assertGreaterThan(
            1675621740 + 86400 * 5,
            $result->getTimestamp(),
            '返り値が満月付近（偽検出）になっています'
        );
    }
    // ==================== ELP2000 高速化: 複数年・年境界テスト ====================
    /**
     * 複数年の ELP2000 新月計算を国立天文台データと照合するケースを返す。
     *
     * @return array<string, array{string, string, string, int}>
     */
    public static function elp2000MultipleYearsProvider(): array
    {
        return [
            // 国立天文台データに基づく（±5 分許容）
            '2011 July new moon (NAOJ)' => [
                '2011-06-25 00:00:00',
                '2011-07-01 17:54:00',
                'Asia/Tokyo',
                300,
            ],
            '2015 April new moon (NAOJ)' => [
                '2015-04-16 00:00:00',
                '2015-04-19 03:57:00',
                'Asia/Tokyo',
                300,
            ],
            '2023 January new moon (NAOJ)' => [
                '2023-01-20 00:00:00',
                '2023-01-22 05:53:00',
                'Asia/Tokyo',
                300,
            ],
        ];
    }
    /**
     * 複数年で ELP2000 高速探索が国立天文台データと一致することを検証する。
     *
     * NAOJ 精度比較のため VSOP87 太陽 + ELP2000 月の組み合わせで検証する。
     *
     * @param string $searchDate 探索基準日時（UTC）
     * @param string $expectedNewMoon 期待する新月時刻
     * @param string $timezone 期待時刻のタイムゾーン
     * @param int $deltaSeconds 許容秒数
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @dataProvider elp2000MultipleYearsProvider
     */
    public function test_elp2000_multipleYears_newMoonMatchesNaoj($searchDate, $expectedNewMoon, $timezone, $deltaSeconds): void
    {
        $moon = new Moon(new Astronomy(new Vsop87Astronomy(), new ELP2000()));
        $date = new DateTime($searchDate, new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, 0.0);
        $this->assertEqualsWithDelta(
            (new DateTime($expectedNewMoon, new DateTimeZone($timezone)))->getTimestamp(),
            $result->getTimestamp(),
            $deltaSeconds,
            sprintf('ELP2000 高速探索: %s 起点での新月精度が ±%d 秒を超えています', $searchDate, $deltaSeconds)
        );
    }
    /**
     * 年境界（12月〜1月）付近で ELP2000 高速探索が正しく動作することを検証する。
     *
     * NAOJ 精度比較のため VSOP87 太陽 + ELP2000 月の組み合わせで検証する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_elp2000_yearBoundary_newMoonIsCorrect(): void
    {
        $moon = new Moon(new Astronomy(new Vsop87Astronomy(), new ELP2000()));

        // 2020-12-14 16:17 UTC 新月（皆既日食の日）を探索する
        $date = new DateTime('2020-12-10 00:00:00', new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, 0.0);

        // USNO: 2020-12-14 16:17 UTC
        $expected = (new DateTime('2020-12-14 16:17:00', new DateTimeZone('UTC')))->getTimestamp();
        $this->assertEqualsWithDelta(
            $expected,
            $result->getTimestamp(),
            300,
            '年境界付近の ELP2000 高速探索が期待値と ±5 分以上ずれています'
        );
    }
    // ==================== LunarCalendar 統合テスト ====================
    /**
     * ELP2000 高速化後の makeLunarCalendar() が正しい構造を返すことを検証する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_makeLunarCalendar_elp2000_returnsValidStructure(): void
    {
        $solarBackup = Astronomy::solarAlgorithm();
        $moonBackup = Astronomy::moonAlgorithm();

        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);

            $lunarCalendar = new LunarCalendar();
            $result = $this->invokeExecuteMethod($lunarCalendar, 'makeLunarCalendar', [2024]);

            $this->assertIsArray($result);
            $this->assertGreaterThan(12, count($result), '旧暦テーブルは 12 エントリ以上必要です');
            $this->assertLessThan(20, count($result), '旧暦テーブルのエントリ数が異常に多すぎます');

            foreach ($result as $entry) {
                $this->assertArrayHasKey('year', $entry);
                $this->assertArrayHasKey('month', $entry);
                $this->assertArrayHasKey('day', $entry);
                $this->assertArrayHasKey('jd', $entry);
            }
        } finally {
            Astronomy::useSolarAlgorithm($solarBackup);
            Astronomy::useMoonAlgorithm($moonBackup);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
    /**
     * ELP2000 高速化後の makeLunarCalendar() 朔日が NAOJ データと一致することを検証する。
     *
     * 国立天文台 2024 年 朔弦望（日本標準時）より 2024-01-11 JST を検証する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_makeLunarCalendar_elp2000_newMoonDatesMatchNaoj(): void
    {
        $solarBackup = Astronomy::solarAlgorithm();
        $moonBackup = Astronomy::moonAlgorithm();

        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);

            $lunarCalendar = new LunarCalendar();
            $result = $this->invokeExecuteMethod($lunarCalendar, 'makeLunarCalendar', [2024]);

            // エントリが JST 日付として妥当な年範囲に収まること
            $years = array_column($result, 'year');
            $this->assertGreaterThanOrEqual(2023, min($years), '旧暦テーブルの先頭年が早すぎます');
            $this->assertLessThanOrEqual(2025, max($years), '旧暦テーブルの末尾年が遅すぎます');

            // NAOJ: 2024-01-11 JST 新月がテーブルに存在すること
            $jan11Found = false;
            foreach ($result as $entry) {
                if ($entry['year'] === 2024 && $entry['month'] === 1 && $entry['day'] === 11) {
                    $jan11Found = true;
                    break;
                }
            }
            $this->assertTrue($jan11Found, '2024-01-11 JST 朔日がテーブルに存在しません (NAOJ 基準)');
        } finally {
            Astronomy::useSolarAlgorithm($solarBackup);
            Astronomy::useMoonAlgorithm($moonBackup);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }
    // ==================== moonPhaseByLegacy is_next 方向修正テスト ====================
    /**
     * is_next=true かつ基準日が下弦より前の場合、前サイクルの下弦を返すことを確認する。
     *
     * 修正前: truePhase(k1, 0.75) が未来の下弦を返してしまい、is_next=true なのに
     *         基準日時以後の値が返っていた。
     * 修正後: truePhase(k1, 0.75) > $timestamp の場合は truePhase(k1-1, 0.75) を返す。
     *
     * 2023-01-21 が新月、下弦は約 2023-02-13。
     * 基準日 2023-01-25（新月4日後・下弦前）で is_next=true を呼ぶと
     * 前サイクルの下弦（2022-12-30 付近）が返ることを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_moonPhaseByLegacy_lastQuarter_isNextTrue_beforeLastQuarter_returnsPreviousCycle(): void
    {
        $moon = new Moon();
        $base = new DateTime('2023-01-25 12:00:00', new DateTimeZone('UTC'));
        /** @var \Carbon\Carbon $result */
        $result = $this->invokeExecuteMethod($moon, 'moonPhaseByLegacy', [$base, 0.75, true]);
        $this->assertLessThan(
            $base->getTimestamp(),
            $result->getTimestamp(),
            'is_next=true の下弦は基準日時より前でなければならない'
        );
    }
}

/**
 * フル精度 ELP2000 を強制する Moon サブクラス（高速化前の動作を再現）。
 *
 * phaseDeltaAtFast / bisectPhaseTimestampFast を親クラスのフル精度版に差し替え、
 * snapToFullPrecision はそのまま返す（フル精度二分探索後は補正不要）。
 * ELP2000 高速探索との 1 秒以内一致テストで「変更前の結果」として使用する。
 */
class FullPrecisionElp2000Moon extends Moon
{
    /**
     * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
     * @param int $timestamp
     * @param float $targetAngle
     * @return float
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function phaseDeltaAtFast($timestamp, $targetAngle): float
    {
        return $this->phaseDeltaAt($timestamp, $targetAngle);
    }

    /**
     * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
     * @param int $timestamp1
     * @param int $timestamp2
     * @param float $targetAngle
     * @return int
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function bisectPhaseTimestampFast($timestamp1, $timestamp2, $targetAngle): int
    {
        return $this->bisectPhaseTimestamp($timestamp1, $timestamp2, $targetAngle);
    }

    /**
     * @noinspection PhpUnused — moonPhaseByAstronomy() 内部から委譲呼び出しされる
     * @param int $approxTimestamp
     * @param float $targetAngle
     * @return int
     */
    protected function snapToFullPrecision($approxTimestamp, $targetAngle): int
    {
        return $approxTimestamp;
    }
}

/**
 * moonPhaseByAstronomy / moonPhaseByLegacy の呼び出しを記録するスパイ。
 */
class MoonRouteSpy extends Moon
{
    /**
     * @var int
     */
    public $byAstronomyCount = 0;

    /**
     * @var int
     */
    public $byLegacyCount = 0;

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
    protected function moonPhaseByAstronomy($date, $phase, $is_next): Carbon
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
    protected function moonPhaseByLegacy($date, $phase, $is_next): Carbon
    {
        $this->byLegacyCount++;

        return Carbon::createFromTimestampUTC(0);
    }
}
