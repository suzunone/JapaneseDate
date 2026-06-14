<?php

namespace JapaneseDate\Components\Traits;

use JapaneseDate\Components\Astronomy;

/**
 * 月齢収束計算の共通ステップを提供するトレイト。
 *
 * 朔の時刻を反復的に求める収束ループのうち、黄経差（ΔΛ）から
 * 時刻補正量（Δt）を算出して tm1/tm2 を更新する処理を共通化します。
 * Elp2000MoonAge・LegacyMoonAge の両実装で同一のアルゴリズムを使用するため
 * 本トレイトに集約しています。
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
trait MoonAgeConvergenceTrait
{
    /**
     * 収束ループの 1 ステップを実行し、更新後の tm1・tm2・delta_t1・delta_t2 と break フラグを返す。
     *
     * 呼び出し元は while 条件式で delta_t1・delta_t2 を参照するため、
     * これらも戻り値に含める必要がある。
     *
     * @param float $delta_rm 太陽・月の黄経差（ΔΛ）
     * @param float $synodicMonth 朔望月（日）
     * @param float $tm1 時刻引数の整数部（ユリウス日）
     * @param float $tm2 時刻引数の小数部
     * @param float $julian_date_0 計算基準のユリウス日
     * @param int   $counter 現在の反復回数
     * @return array{0: float, 1: float, 2: float, 3: float, 4: bool} [tm1, tm2, delta_t1, delta_t2, shouldBreak]
     */
    protected function applyConvergenceStep(
        float $delta_rm,
        float $synodicMonth,
        float $tm1,
        float $tm2,
        float $julian_date_0,
        int $counter
    ): array {
        // 時刻引数の補正値 Δt
        $delta_t2 = $delta_rm * $synodicMonth / 360.0;
        $delta_t1 = floor($delta_t2);
        $delta_t2 -= $delta_t1;

        // 時刻引数の補正
        $tm1 -= $delta_t1;
        $tm2 -= $delta_t2;
        if ($tm2 < 0) {
            $tm2++;
            $tm1--;
        }

        // @codeCoverageIgnoreStart
        if ($counter === 15 && abs($delta_t1 + $delta_t2) > Astronomy::DAYS_PER_SEC) {
            // ループ回数が15回になったら、初期値を-26
            $tm1 = floor($julian_date_0 - 26);
            $tm2 = 0.0;
        } elseif ($counter > 30 && abs($delta_t1 + $delta_t2) > Astronomy::DAYS_PER_SEC) {
            // 初期値を補正したにも関わらず振動を続ける場合は、
            // 初期値を答えとして返して強制的にループを抜け出して異常終了
            $tm1 = $julian_date_0;
            $tm2 = 0.0;

            return [$tm1, $tm2, $delta_t1, $delta_t2, true];
        }
        // @codeCoverageIgnoreEnd

        return [$tm1, $tm2, $delta_t1, $delta_t2, false];
    }
}
