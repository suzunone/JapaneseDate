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
     * NASA/Espenak-Meeus の多項式で ΔT = TT - UT を近似します。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @return float ΔT 秒
     */
    protected function approximateDeltaTSeconds($year, $month): float
    {
        $y = $year + ($month - 0.5) / 12.0;

        if ($y < 2050.0) {
            $t = $y - 2000.0;

            return 62.92 + 0.32217 * $t + 0.005589 * $t * $t;
        }

        $u = ($y - 1820.0) / 100.0;

        return -20.0 + 32.0 * $u * $u - 0.5628 * (2150.0 - $y);
    }
}
