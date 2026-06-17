<?php

namespace JapaneseDate\Components\Contracts;

/**
 * 月齢計算アルゴリズムの契約インターフェイス。
 *
 * このインターフェイスを実装するクラスは、グレゴリオ暦の日時から
 * 月齢（朔からの経過日数、0以上30未満）を計算して返す責務を持ちます。
 *
 * 太陽・月の黄経計算で使用するアルゴリズム（Legacy / VSOP87 / ELP2000）の
 * 組み合わせによって、収束計算中の補正処理が異なるため、
 * アルゴリズムごとに専用の実装クラスを用意します。
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
interface MoonAgeAlgorithm
{
    /**
     * 月齢を計算して返す。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（世界時）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月齢（0以上30未満の浮動小数点数）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float;
}
