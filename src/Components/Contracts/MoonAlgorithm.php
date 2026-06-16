<?php

namespace JapaneseDate\Components\Contracts;

/**
 * 月黄経計算アルゴリズムの契約インターフェイス。
 *
 * このインターフェイスを実装するクラスは、グレゴリオ暦の日時から
 * 月の視黄経（0°〜360°）を計算して返す責務を持ちます。
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
interface MoonAlgorithm
{
    /**
     * 月の視黄経を計算して返す。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月の視黄経（度、0〜360）
     */
    public function longitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float;

    /**
     * このアルゴリズムの識別子を返す。
     *
     * @return string アルゴリズム識別子（例: 'legacy', 'elp2000'）
     */
    public function moonAlgorithmName(): string;
}
