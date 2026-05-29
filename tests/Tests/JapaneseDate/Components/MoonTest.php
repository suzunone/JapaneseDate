<?php

/** @noinspection PhpDocMissingThrowsInspection */
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
use DateTimeZone;
use JapaneseDate\Components\Moon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * truePhase() の戻り値の仕様:
 *   戻り値 = julian2Uts(真の位相のユリウス日) + 32400 - 60
 *          ≈ 実際の天文イベントの UTC タイムスタンプ + 32340
 *
 * 精度: 新月・四分月は ±3 分以内 (USNO データと照合済み)
 * 天文データ出典: 国立天文台 / USNO
 * @covers \JapaneseDate\Components\Moon
 */
class MoonTest extends TestCase
{
    use InvokeTrait;
    // ==================== uts2Julian / julian2Uts 変換精度テスト ====================
    public function test_uts2Julian_unix_epoch(): void
    {
        $moon = new Moon();
        // Unix エポック (1970-01-01 00:00:00 UTC) のユリウス日は 2440587.5 と定義されている
        $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [0]);
        $this->assertSame(2440587.5, $result);
    }
    public function test_uts2Julian_j2000(): void
    {
        $moon = new Moon();
        // J2000.0 基準点: 2000-01-01 12:00:00 UTC = Unix 946728000 → ユリウス日 2451545.0
        $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [946728000]);
        $this->assertSame(2451545.0, $result);
    }
    public function test_uts2Julian_known_date(): void
    {
        $moon = new Moon();
        // 2023-01-21 00:00:00 UTC = Unix 1674259200 → ユリウス日 2459965.5
        $result = $this->invokeExecuteMethod($moon, 'uts2Julian', [1674259200]);
        $this->assertSame(2459965.5, $result);
    }
    public function test_julian2Uts_unix_epoch(): void
    {
        $moon = new Moon();
        // ユリウス日 2440587.5 (Unix エポック) → 0.0
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [2440587.5]);
        $this->assertSame(0.0, $result);
    }
    public function test_julian2Uts_j2000(): void
    {
        $moon = new Moon();
        // ユリウス日 2451545.0 (J2000.0) → 946728000.0
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [2451545.0]);
        $this->assertSame(946728000.0, $result);
    }
    public function test_julian2Uts_known_date(): void
    {
        $moon = new Moon();
        // ユリウス日 2459965.5 → 1674259200.0 (2023-01-21 00:00:00 UTC)
        $result = $this->invokeExecuteMethod($moon, 'julian2Uts', [2459965.5]);
        $this->assertSame(1674259200.0, $result);
    }
    public function test_julian2Uts_roundtrip(): void
    {
        $moon = new Moon();
        // Unix タイムスタンプをユリウス日に変換し、再び戻しても元の値と一致することを確認する
        $timestamp = 1674259200;
        $julian = $this->invokeExecuteMethod($moon, 'uts2Julian', [$timestamp]);
        $result  = $this->invokeExecuteMethod($moon, 'julian2Uts', [$julian]);
        $this->assertEqualsWithDelta((float) $timestamp, $result, 0.001);
    }
    // ==================== meanPhase ====================
    public function test_meanPhase_returnsFloat(): void
    {
        $moon = new Moon();
        // 平均朔望時刻がユリウス日として妥当な浮動小数点数で返ることを確認する
        $result = $this->invokeExecuteMethod($moon, 'meanPhase', [2451545.0, 1236.85]);
        $this->assertIsFloat($result);
        $this->assertGreaterThan(2415020.0, $result);
    }
    // ==================== truePhase 分岐テスト ====================
    // phase < 0.01 → 新月補正
    public function test_truePhase_newMoon_returnsFloat(): void
    {
        $moon = new Moon();
        // 新月に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.0]);
        $this->assertIsFloat($result);
    }
    // abs(phase - 0.5) < 0.01 → 満月補正
    public function test_truePhase_fullMoon_returnsFloat(): void
    {
        $moon = new Moon();
        // 満月に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.5]);
        $this->assertIsFloat($result);
    }
    // abs(phase - 0.25) < 0.01, phase < 0.5 → 上弦補正
    public function test_truePhase_firstQuarter_returnsFloat(): void
    {
        $moon = new Moon();
        // 上弦に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.25]);
        $this->assertIsFloat($result);
    }
    // abs(phase - 0.75) < 0.01, phase >= 0.5 → 下弦補正
    public function test_truePhase_lastQuarter_returnsFloat(): void
    {
        $moon = new Moon();
        // 下弦に対応する真の位相補正が実行されることを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.75]);
        $this->assertIsFloat($result);
    }
    // いずれにも該当しない場合 → null
    public function test_truePhase_invalidPhase_returnsNull(): void
    {
        $moon = new Moon();
        // 対応していない位相では補正値を返さないことを確認する
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1236.85, 0.3]);
        $this->assertNull($result);
    }
    // ==================== truePhase 実データ精度テスト ====================
    //
    // truePhase(k, phase) の戻り値 ≈ 実際の天文イベントの UTC タイムスタンプ + 32340 秒
    // 許容誤差: ±300 秒 (5 分) — アルゴリズムの近似誤差を考慮
    //
    // k=1522 = 2023年1月の朔望月インデックス (2023-01-21 新月)
    // k=1521 = 2022年12月の朔望月インデックス (2022-12-23 新月)
    public function test_truePhase_newMoon_jan2023(): void
    {
        $moon = new Moon();
        // 新月: 2023-01-21 20:53 UTC (USNO データ)
        // UTC タイムスタンプ: 1674334380
        // 期待値 = 1674334380 + 32340 = 1674366720
        $expected = 1674366720;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.0]);
        $this->assertEqualsWithDelta($expected, $result, 300,
            '2023-01-21 新月の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_truePhase_newMoon_dec2022(): void
    {
        $moon = new Moon();
        // 新月: 2022-12-23 10:17 UTC (USNO データ)
        // UTC タイムスタンプ: 1671790620
        // 期待値 = 1671790620 + 32340 = 1671822960
        $expected = 1671822960;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1521.0, 0.0]);
        $this->assertEqualsWithDelta($expected, $result, 300,
            '2022-12-23 新月の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_truePhase_firstQuarter_jan2023(): void
    {
        $moon = new Moon();
        // 上弦: 2023-01-28 15:19 UTC (USNO データ)
        // UTC タイムスタンプ: 1674919140
        // 期待値 = 1674919140 + 32340 = 1674951480
        $expected = 1674951480;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.25]);
        $this->assertEqualsWithDelta($expected, $result, 300,
            '2023-01-28 上弦の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_truePhase_fullMoon_feb2023(): void
    {
        $moon = new Moon();
        // 満月: 2023-02-05 18:29 UTC (USNO データ)
        // UTC タイムスタンプ: 1675621740
        // 期待値 = 1675621740 + 32340 = 1675654080
        $expected = 1675654080;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.5]);
        $this->assertEqualsWithDelta($expected, $result, 300,
            '2023-02-05 満月の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_truePhase_lastQuarter_feb2023(): void
    {
        $moon = new Moon();
        // 下弦: 2023-02-13 16:01 UTC (USNO データ)
        // UTC タイムスタンプ: 1676304060
        // 期待値 = 1676304060 + 32340 = 1676336400
        $expected = 1676336400;
        $result = $this->invokeExecuteMethod($moon, 'truePhase', [1522.0, 0.75]);
        $this->assertEqualsWithDelta($expected, $result, 300,
            '2023-02-13 下弦の計算誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    // ==================== moonPhase 分岐テスト ====================
    // is_next=false → k2 (次の朔望月の新月基準)
    public function test_moonPhase_newMoon_isNextFalse(): void
    {
        $moon = new Moon();
        // 指定日以後の新月が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    // is_next=false, phase=0.5 → 満月
    public function test_moonPhase_fullMoon(): void
    {
        $moon = new Moon();
        // 指定日以後の満月が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.5);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    // is_next=false, phase=0.25 → 上弦 (phase < 0.5 の分岐)
    public function test_moonPhase_firstQuarter(): void
    {
        $moon = new Moon();
        // 指定日以後の上弦が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.25);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    // is_next=false, phase=0.75 → 下弦 (phase >= 0.5 の分岐)
    public function test_moonPhase_lastQuarter(): void
    {
        $moon = new Moon();
        // 指定日以後の下弦が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.75);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    // is_next=true → k1 (前の朔望月の新月基準)
    public function test_moonPhase_isNextTrue(): void
    {
        $moon = new Moon();
        // is_next=true の場合は指定日前の新月が Carbon インスタンスで返ることを確認する
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0, true);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    // abs($nt2 - $julian) < 0.75 の分岐 (新月当日に近い日時でトリガー)
    public function test_moonPhase_nearNewMoon_triggersClosenessCheck(): void
    {
        $moon = new Moon();
        // 2023-01-21 20:53 UTC は実際の新月時刻 → 平均新月との差が 0.75 ユリウス日未満になる
        $date = new DateTime('2023-01-21 20:53:00', new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, 0.0);
        $this->assertInstanceOf(Carbon::class, $result);
    }
    // ==================== moonPhase 実データ精度テスト ====================
    //
    // moonPhase() は truePhase() を呼ぶため、同じオフセット仕様が適用される
    // 期待値 = 実際の天文イベントの UTC タイムスタンプ + 32340 秒 (±300 秒)
    //
    // 2023-01-15 UTC をクエリ日として使用:
    //   ループ終了時 k1=1521 (2022-12-23 新月), k2=1522 (2023-01-21 新月)
    //   is_next=false → truePhase(k2=1522, phase)
    //   is_next=true  → truePhase(k1=1521, phase)
    public function test_moonPhase_newMoon_jan2023_accuracy(): void
    {
        $moon = new Moon();
        // 新月 2023-01-21 20:53 UTC (k2=1522)
        // 期待値 = 1674334380 + 32340 = 1674366720
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0, false);
        $this->assertEqualsWithDelta(1674366720, $result->getTimestamp(), 300,
            '2023-01-21 新月の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_moonPhase_firstQuarter_jan2023_accuracy(): void
    {
        $moon = new Moon();
        // 上弦 2023-01-28 15:19 UTC (k2=1522, phase=0.25)
        // 期待値 = 1674919140 + 32340 = 1674951480
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.25, false);
        $this->assertEqualsWithDelta(1674951480, $result->getTimestamp(), 300,
            '2023-01-28 上弦の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_moonPhase_fullMoon_feb2023_accuracy(): void
    {
        $moon = new Moon();
        // 満月 2023-02-05 18:29 UTC (k2=1522, phase=0.5)
        // 期待値 = 1675621740 + 32340 = 1675654080
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.5, false);
        $this->assertEqualsWithDelta(1675654080, $result->getTimestamp(), 300,
            '2023-02-05 満月の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_moonPhase_lastQuarter_feb2023_accuracy(): void
    {
        $moon = new Moon();
        // 下弦 2023-02-13 16:01 UTC (k2=1522, phase=0.75)
        // 期待値 = 1676304060 + 32340 = 1676336400
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.75, false);
        $this->assertEqualsWithDelta(1676336400, $result->getTimestamp(), 300,
            '2023-02-13 下弦の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_moonPhase_previousNewMoon_dec2022_accuracy(): void
    {
        $moon = new Moon();
        // 新月 2022-12-23 10:17 UTC (k1=1521, is_next=true)
        // 期待値 = 1671790620 + 32340 = 1671822960
        $result = $moon->moonPhase(new DateTime('2023-01-15 00:00:00', new DateTimeZone('UTC')), 0.0, true);
        $this->assertEqualsWithDelta(1671822960, $result->getTimestamp(), 300,
            '2022-12-23 新月 (is_next=true) の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }
    public function test_moonPhase_nearNewMoon_jan2023_accuracy(): void
    {
        $moon = new Moon();
        // 新月当日 (近接判定分岐) も同じ結果を返す
        // 新月 2023-01-21 20:53 UTC, 期待値 = 1674366720
        $date = new DateTime('2023-01-21 20:53:00', new DateTimeZone('UTC'));
        $result = $moon->moonPhase($date, 0.0);
        $this->assertEqualsWithDelta(1674366720, $result->getTimestamp(), 300,
            '2023-01-21 新月当日の moonPhase 誤差が ±5 分を超えています (USNO 基準)'
        );
    }
}
