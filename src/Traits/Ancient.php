<?php

/**
 * Ancient.php
 *
 * 大化以降の歴史的元号を取得するメソッドを提供する汎用トレイトです。
 * このファイルは {@see \JapaneseDate\DateTime} および
 * {@see \JapaneseDate\DateTimeImmutable} に mix-in されます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Traits;

use JapaneseDate\Components\HistoricalEra;

/**
 * 歴史的元号取得メソッドを提供する汎用トレイト。
 *
 * JIS 規格の元号（明治以降）とは独立して、大化から現代に至るすべての元号を
 * {@see \JapaneseDate\Values\Era} バリューオブジェクトの配列として返します。
 * 南北朝時代は北朝・南朝双方の元号を含む配列が返ります。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Ancient
{
    /**
     * 自身の日付に対応する歴史的元号を返す。
     *
     * {@see \JapaneseDate\Components\HistoricalEra} を呼び出し、
     * 大化以降に制定されたすべての元号（南北朝の並存元号を含む）を
     * {@see \JapaneseDate\Values\Era} バリューオブジェクトの配列として返します。
     * 大化以前など元号が存在しない日付の場合は空配列を返します。
     *
     * @return \JapaneseDate\Values\Era[] 該当する元号バリューオブジェクトの配列
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function historicalEras(): array
    {
        return (new HistoricalEra())->findByDate($this);
    }
}
