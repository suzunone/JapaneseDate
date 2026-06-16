<?php

namespace JapaneseDate\Components\Traits;

/**
 * NASA/Espenak-Meeus の多項式による ΔT 近似計算を提供するトレイト。
 *
 * ΔT = TT - UT（単位: 秒）を年・月から近似します。
 * ELP2000 および VSOP87 の両コンポーネントで同一の計算式が必要なため、
 * 共通実装として本トレイトに集約しています。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-14
 */
trait DeltaTTrait
{
    /**
     * NASA/Espenak-Meeus の年代別多項式で ΔT（秒）を計算します。
     *
     * NASA の説明どおり小数年 y = year + (month - 0.5) / 12 を使用します。
     * 多項式の対象年代は -1999〜+3000年ですが、対象年代外も外側区分式を
     * 外挿するベストエフォート計算とし、精度は保証しません。
     *
     * @param float $y 小数年
     * @return float ΔT 秒
     */
    protected function deltaTPolynomialForDecimalYear(float $y): float
    {
        if ($y < -500.0) {
            $u = ($y - 1820.0) / 100.0;

            return -20.0 + 32.0 * $u * $u;
        }

        if ($y < 500.0) {
            $u = $y / 100.0;

            return 10583.6
                - 1014.41 * $u
                + 33.78311 * $u ** 2
                - 5.952053 * $u ** 3
                - 0.1798452 * $u ** 4
                + 0.022174192 * $u ** 5
                + 0.0090316521 * $u ** 6;
        }

        if ($y < 1600.0) {
            $u = ($y - 1000.0) / 100.0;

            return 1574.2
                - 556.01 * $u
                + 71.23472 * $u ** 2
                + 0.319781 * $u ** 3
                - 0.8503463 * $u ** 4
                - 0.005050998 * $u ** 5
                + 0.0083572073 * $u ** 6;
        }

        if ($y < 1700.0) {
            $t = $y - 1600.0;

            return 120.0 - 0.9808 * $t - 0.01532 * $t ** 2 + $t ** 3 / 7129.0;
        }

        if ($y < 1800.0) {
            $t = $y - 1700.0;

            return 8.83
                + 0.1603 * $t
                - 0.0059285 * $t ** 2
                + 0.00013336 * $t ** 3
                - $t ** 4 / 1174000.0;
        }

        if ($y < 1860.0) {
            $t = $y - 1800.0;

            return 13.72
                - 0.332447 * $t
                + 0.0068612 * $t ** 2
                + 0.0041116 * $t ** 3
                - 0.00037436 * $t ** 4
                + 0.0000121272 * $t ** 5
                - 0.0000001699 * $t ** 6
                + 0.000000000875 * $t ** 7;
        }

        if ($y < 1900.0) {
            $t = $y - 1860.0;

            return 7.62
                + 0.5737 * $t
                - 0.251754 * $t ** 2
                + 0.01680668 * $t ** 3
                - 0.0004473624 * $t ** 4
                + $t ** 5 / 233174.0;
        }

        if ($y < 1920.0) {
            $t = $y - 1900.0;

            return -2.79
                + 1.494119 * $t
                - 0.0598939 * $t ** 2
                + 0.0061966 * $t ** 3
                - 0.000197 * $t ** 4;
        }

        if ($y < 1941.0) {
            $t = $y - 1920.0;

            return 21.20 + 0.84493 * $t - 0.076100 * $t ** 2 + 0.0020936 * $t ** 3;
        }

        if ($y < 1961.0) {
            $t = $y - 1950.0;

            return 29.07 + 0.407 * $t - $t ** 2 / 233.0 + $t ** 3 / 2547.0;
        }

        if ($y < 1986.0) {
            $t = $y - 1975.0;

            return 45.45 + 1.067 * $t - $t ** 2 / 260.0 - $t ** 3 / 718.0;
        }

        if ($y < 2005.0) {
            $t = $y - 2000.0;

            return 63.86
                + 0.3345 * $t
                - 0.060374 * $t ** 2
                + 0.0017275 * $t ** 3
                + 0.000651814 * $t ** 4
                + 0.00002373599 * $t ** 5;
        }

        if ($y < 2050.0) {
            $t = $y - 2000.0;

            return 62.92 + 0.32217 * $t + 0.005589 * $t ** 2;
        }

        if ($y < 2150.0) {
            return -20.0 + 32.0 * (($y - 1820.0) / 100.0) ** 2 - 0.5628 * (2150.0 - $y);
        }

        $u = ($y - 1820.0) / 100.0;

        return -20.0 + 32.0 * $u * $u;
    }

    /**
     * NASA/Espenak-Meeus の多項式で ΔT = TT - UT を近似します。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @return float ΔT 秒
     */
    protected function approximateDeltaTSeconds(int $year, int $month): float
    {
        $y = $year + ($month - 0.5) / 12.0;

        return $this->deltaTPolynomialForDecimalYear($y);
    }
}
