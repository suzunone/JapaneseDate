<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\ELP2000;
use JapaneseDate\Components\ELP2000Reduced;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * ELP2000Reduced クラスのテスト。
 *
 * 縮約版が正しい識別子を返すこと、および縮約結果がフル精度の値と
 * 一定の誤差内で一致することを検証する。
 *
 * 天文データ出典:
 *   USNO Astronomical Applications Department "Dates of Primary Phases of the Moon"
 *   https://aa.usno.navy.mil/data/MoonPhases
 *   （2023〜2026 年の新月 UTC 時刻から変換）
 * @covers \JapaneseDate\Components\ELP2000Reduced
 * @covers \JapaneseDate\Components\ELP2000Reduced::moonAlgorithmName
 */
class ELP2000ReducedTest extends TestCase
{
    /**
     * USNO 既知新月時刻に対応する TDB ユリウス日（UTC ユリウス日で代用）。
     * ELP2000 の公開 API preciseLongitude() は TDB JD を受け取る。
     *
     * @return array<string, array{0: string}>
     */
    public static function newMoonJdProvider(): array
    {
        return [
            '2023 Mar new moon (JD 2460025.224306)' => ['2460025.224306'],
            '2024 Jan new moon (JD 2460320.997917)' => ['2460320.997917'],
            '2025 Mar new moon (JD 2460763.956944)' => ['2460763.956944'],
            '2025 Jul new moon (JD 2460881.299306)' => ['2460881.299306'],
            '2026 Mar new moon (JD 2461118.557639)' => ['2461118.557639'],
        ];
    }
    /**
     * moonAlgorithmName() が 'elp2000_reduced' を返すこと。
     */
    public function test_moonAlgorithmName_returnsElp2000Reduced(): void
    {
        $reduced = new ELP2000Reduced();
        $this->assertSame('elp2000_reduced', $reduced->moonAlgorithmName());
    }
    /**
     * 縮約版の preciseLongitude() がフル精度版と最短角距離 0.005° 以内で一致すること。
     *
     * 縮約誤差（|c| < 1e-4 の落とした項の総和）は最大でも数秒角相当であり、
     * 0.005°（18秒角）の許容値を十分下回ることを確認する。
     *
     * @param string $jd TDB ユリウス日
     * @dataProvider newMoonJdProvider
     */
    public function test_longitudePrecise_isWithinToleranceOfFull(string $jd): void
    {
        $full    = new ELP2000();
        $reduced = new ELP2000Reduced();
        $fullLon    = (float) $full->preciseLongitude($jd);
        $reducedLon = (float) $reduced->preciseLongitude($jd);
        // 最短角距離で比較（359.9° と 0.1° が 359.8° 差と誤判定されないよう）
        $diff = fmod(abs($fullLon - $reducedLon), 360.0);
        if ($diff > 180.0) {
            $diff = 360.0 - $diff;
        }
        $this->assertLessThan(0.005, $diff, sprintf(
            'JD %s: フル=%.6f°、縮約=%.6f°、差=%.6f°',
            $jd,
            $fullLon,
            $reducedLon,
            $diff
        ));
    }
    /**
     * preciseLongitude() の出力が 0〜360° の範囲内であること。
     *
     * @param string $jd TDB ユリウス日
     * @dataProvider newMoonJdProvider
     */
    public function test_longitudePrecise_returnsNonNegativeAndLessThan360(string $jd): void
    {
        $reduced = new ELP2000Reduced();
        $lon = (float) $reduced->preciseLongitude($jd);
        $this->assertGreaterThanOrEqual(0.0, $lon, "JD {$jd}: 黄経が負値");
        $this->assertLessThan(360.0, $lon, "JD {$jd}: 黄経が 360° 以上");
    }
}
