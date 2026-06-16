<?php

namespace JapaneseDate\Components;

use JapaneseDate\Components\Traits\ELP2000LonReduced;

/**
 * ELP2000-82B 月黄経縮約版（朔探索専用）。
 *
 * {@see ELP2000} を継承し、{@see ELP2000LonReduced} トレイトを use することで
 * LON 系 12 メソッドを縮約版（|c| >= 1e-4 の項のみ）で上書きする。
 * LAT / R 系メソッドおよび {@see computeLongitudeSeries()} / {@see preciseLongitude()} /
 * {@see longitudeMoon()} はすべて親クラスをそのまま継承する。
 *
 * PHP のトレイトは継承メソッドより優先されるため、{@see ELP2000} が
 * {@see \JapaneseDate\Components\Traits\ELP2000Sub} 経由で提供する LON メソッドよりも
 * このクラスで use した {@see ELP2000LonReduced} の同名メソッドが実行される。
 *
 * **用途:** {@see \JapaneseDate\Components\Astronomy::longitudeMoonFast()} が
 * 朔探索ループ内での高速黄経評価にのみ使用する。
 * 公開 API への露出・最終出力（朔時刻・月齢）への使用は禁止。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-15
 */
class ELP2000Reduced extends ELP2000
{
    use ELP2000LonReduced;

    /**
     * このアルゴリズムの月計算識別子を返す。
     *
     * {@see \JapaneseDate\Components\Astronomy::longitudeMoonFast()} の
     * oneTimeCache キーに含まれ、フル精度キャッシュとの衝突を防ぐ。
     *
     * @return string 常に 'elp2000_reduced'
     */
    public function moonAlgorithmName(): string
    {
        return 'elp2000_reduced';
    }
}
