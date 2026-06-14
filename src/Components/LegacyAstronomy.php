<?php

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\Components\Contracts\MoonAlgorithm;
use JapaneseDate\Components\Contracts\SunAlgorithm;

/**
 * 従来の近似式による太陽・月黄経計算実装。
 *
 * 周期項を用いた簡易近似式で太陽の視黄経と月の視黄経を計算します。
 * 精度は二十四節気・旧暦計算に必要な実用レベルを目的としており、
 * 天文観測用の高精度計算ではありません。
 *
 * **責務:**
 * - 周期項の加算による太陽黄経の近似計算
 * - 周期項の加算による月黄経の近似計算
 * - `SunAlgorithm` および `MoonAlgorithm` インターフェイスの実装
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-07
 */
class LegacyAstronomy implements SunAlgorithm, MoonAlgorithm
{
    /**
     * J2000.0 の Unix エポック時刻（2000-01-01 12:00:00 UTC）。
     */
    private const J2000_UNIX_TIMESTAMP = 946728000;

    /**
     * 1ユリウス年の秒数（365.25日）。
     */
    private const JULIAN_YEAR_SECONDS = 31557600.0;

    /**
     * 従来の近似式が前提としているJ2000基準との差（6時間、ユリウス年）。
     */
    private const LEGACY_MODEL_OFFSET_YEARS = 21600.0 / self::JULIAN_YEAR_SECONDS;

    /**
     * このアルゴリズムの太陽計算識別子を返す。
     *
     * @return string 常に 'legacy'
     */
    public function sunAlgorithmName(): string
    {
        return 'legacy';
    }

    /**
     * このアルゴリズムの月計算識別子を返す。
     *
     * @return string 常に 'legacy'
     */
    public function moonAlgorithmName(): string
    {
        return 'legacy';
    }

    /**
     * 従来の近似式で太陽の視黄経を計算して返す。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param float $day グレゴリオ暦の日（小数部可）
     * @param float $hour 時（日本標準時、小数部可）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 太陽の視黄経（度、0〜360）
     * @throws \Exception
     */
    public function longitudeSun($year, $month, $day, $hour, $min, $sec): float
    {
        $julian_year = $this->computeJulianYear($year, $month, $day, $hour, $min, $sec)
            - self::LEGACY_MODEL_OFFSET_YEARS;

        return $this->jy2LongitudeSun($julian_year);
    }

    /**
     * グレゴリオ暦日時を 2000.0 からの経過年数（ユリウス年）に変換する。
     *
     * 入力日時は日本標準時として扱い、J2000.0
     * （2000-01-01 12:00:00 UTC）からの経過秒を 365.25 日で除算します。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param float $day グレゴリオ暦の日（小数部可）
     * @param float $hour 時（日本標準時、小数部可）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 2000.0 からの経過年数
     * @throws \Exception
     */
    private function computeJulianYear(int $year, int $month, float $day, float $hour, float $min, float $sec): float
    {
        $dayInteger = (int) floor($day);
        $jstMidnight = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d 00:00:00', $year, $month, $dayInteger),
            new DateTimeZone('Asia/Tokyo')
        );
        $elapsedSeconds = ($day - $dayInteger) * 86400.0
            + $hour * 3600.0
            + $min * 60.0
            + $sec;
        $timestamp = (float) $jstMidnight->format('U') + $elapsedSeconds;

        return ($timestamp - self::J2000_UNIX_TIMESTAMP) / self::JULIAN_YEAR_SECONDS;
    }

    /**
     * 周期項の近似式で太陽の黄経を計算する。
     *
     * 複数の周期項の和と主項から 0°〜360° に正規化した太陽黄経を返します。
     *
     * @param float $julian_year 2000.0 からの経過年数
     * @return float 太陽の黄経（視黄経、度）
     */
    public function jy2LongitudeSun($julian_year): float
    {
        $terms = [
            [0.0003, 329.7, 44.43],
            [0.0003, 352.5, 1079.97],
            [0.0004, 21.1, 720.02],
            [0.0004, 157.3, 299.30],
            [0.0004, 234.9, 315.56],
            [0.0005, 291.2, 22.81],
            [0.0005, 207.4, 1.50],
            [0.0006, 29.8, 337.18],
            [0.0007, 206.8, 30.35],
            [0.0007, 153.3, 90.38],
            [0.0008, 132.5, 659.29],
            [0.0013, 81.4, 225.18],
            [0.0015, 343.2, 450.37],
            [0.0018, 251.3, 0.20],
            [0.0018, 297.8, 4452.67],
            [0.0020, 247.1, 329.64],
            [0.0048, 234.95, 19.341],
            [0.0200, 355.05, 719.981],
        ];

        $res = $this->sumPeriodicTerms($terms, $julian_year);
        $res += (1.9146 - 0.00005 * $julian_year) * sin(deg2rad($this->normalizeAngle(357.538 + 359.991 * $julian_year)));
        $res += $this->normalizeAngle(280.4603 + 360.00769 * $julian_year);

        return $this->normalizeAngle($res);
    }

    /**
     * 周期項の和を計算する。
     *
     * 各項は `[振幅, 初期位相, 角速度]` の形式で指定します。
     * 計算式: Σ 振幅 × sin(初期位相 + 角速度 × ユリウス年)
     *
     * @param array<int, array{0: float, 1: float, 2: float}> $terms 周期項の配列
     * @param float $julian_year 2000.0 からの経過年数
     * @return float 周期項の和
     */
    private function sumPeriodicTerms(array $terms, float $julian_year): float
    {
        $result = 0.0;
        foreach ($terms as [$amplitude, $phase, $speed]) {
            $result += $amplitude * sin(deg2rad($this->normalizeAngle($phase + $speed * $julian_year)));
        }

        return $result;
    }

    /**
     * 角度を 0°〜360° 未満に正規化する。
     *
     * @param float $angle 正規化前の角度（度）
     * @return float 正規化後の角度（0 ≤ angle < 360）
     */
    private function normalizeAngle(float $angle): float
    {
        return $angle - 360.0 * floor($angle / 360.0);
    }

    /**
     * 従来の近似式で月の視黄経を計算して返す。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（日本標準時、小数部可）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月の視黄経（度、0〜360）
     * @throws \Exception
     */
    public function longitudeMoon($year, $month, $day, $hour, $min, $sec): float
    {
        $julian_year = $this->computeJulianYear($year, $month, $day, $hour, $min, $sec)
            - self::LEGACY_MODEL_OFFSET_YEARS;

        return $this->jY2LongitudeMoon($julian_year);
    }

    /**
     * 周期項の近似式で月の黄経を計算する。
     *
     * 複数の周期項の和と主項から 0°〜360° に正規化した月黄経を返します。
     *
     * @param float $julian_year 2000.0 からの経過年数
     * @return float 月の黄経（視黄経、度）
     */
    public function jY2LongitudeMoon($julian_year): float
    {
        $tmp = $this->sumPeriodicTerms([
            [0.0006, 54.0, 19.3],
            [0.0006, 71.0, 0.2],
            [0.0020, 55.0, 19.34],
            [0.0040, 119.5, 1.33],
        ], $julian_year);

        $rm_moon = $this->sumPeriodicTerms([
            [0.0003, 280.0, 23221.3],
            [0.0003, 161.0, 40.7],
            [0.0003, 311.0, 5492.0],
            [0.0003, 147.0, 18089.3],
            [0.0003, 66.0, 3494.7],
            [0.0003, 83.0, 3814.0],
            [0.0004, 20.0, 720.0],
            [0.0004, 71.0, 9584.7],
            [0.0004, 278.0, 120.1],
            [0.0004, 313.0, 398.7],
            [0.0005, 332.0, 5091.3],
            [0.0005, 114.0, 17450.7],
            [0.0005, 181.0, 19088.0],
            [0.0005, 247.0, 22582.7],
            [0.0006, 128.0, 1118.7],
            [0.0007, 216.0, 278.6],
            [0.0007, 275.0, 4853.3],
            [0.0007, 140.0, 4052.0],
            [0.0008, 204.0, 7906.7],
            [0.0008, 188.0, 14037.3],
            [0.0009, 218.0, 8586.0],
            [0.0011, 276.5, 19208.02],
            [0.0012, 339.0, 12678.71],
            [0.0016, 242.2, 18569.38],
            [0.0018, 4.1, 4013.29],
            [0.0020, 55.0, 19.34],
            [0.0021, 105.6, 3413.37],
            [0.0021, 175.1, 719.98],
            [0.0021, 87.5, 9903.97],
            [0.0022, 240.6, 8185.36],
            [0.0024, 252.8, 9224.66],
            [0.0024, 211.9, 988.63],
            [0.0026, 107.2, 13797.39],
            [0.0027, 272.5, 9183.99],
            [0.0037, 349.1, 5410.62],
            [0.0039, 111.3, 17810.68],
            [0.0040, 119.5, 1.33],
            [0.0040, 145.6, 18449.32],
            [0.0040, 13.2, 13317.34],
            [0.0048, 235.0, 19.34],
            [0.0050, 295.4, 4812.66],
            [0.0052, 197.2, 319.32],
            [0.0068, 53.2, 9265.33],
            [0.0079, 278.2, 4493.34],
            [0.0085, 201.5, 8266.71],
            [0.0100, 44.89, 14315.966],
            [0.0107, 336.44, 13038.696],
            [0.0110, 231.59, 4892.052],
            [0.0125, 141.51, 14436.029],
            [0.0153, 130.84, 758.698],
            [0.0305, 312.49, 5131.979],
            [0.0348, 117.84, 4452.671],
            [0.0410, 137.43, 4411.998],
            [0.0459, 238.18, 8545.352],
            [0.0533, 10.66, 13677.331],
            [0.0572, 103.21, 3773.363],
            [0.0588, 214.22, 638.635],
            [0.1143, 6.546, 9664.0404],
            [0.1856, 177.525, 359.9905],
            [0.2136, 269.926, 9543.9773],
            [0.6583, 235.700, 8905.3422],
            [1.2740, 100.738, 4133.3536],
        ], $julian_year);
        $rm_moon += 6.2887 * sin(deg2rad($this->normalizeAngle(134.961 + 4771.9886 * $julian_year + $tmp)));

        return $this->normalizeAngle(
            $rm_moon + $this->normalizeAngle(218.3161 + 4812.67881 * $julian_year)
        );
    }
}
