<?php

/**
 * キャッシュ制御モードを定義する定数クラス。
 *
 * 暦の計算結果（特に計算負荷の高い旧暦や二十四節気など）をキャッシュ保持する際の
 * ストレージドライバや挙動を指定するための識別子を提供します。
 *
 * 主に {@see \JapaneseDate\DateTime::setCacheMode()} などの
 * キャッシュ設定メソッドの引数として利用されます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */

namespace JapaneseDate;

/**
 * キャッシュ制御モードを定義する定数クラス。
 *
 * 暦の計算結果（特に計算負荷の高い旧暦や二十四節気など）をキャッシュ保持する際の
 * ストレージドライバや挙動を指定するための識別子を提供します。
 *
 * 主に {@see \JapaneseDate\DateTime::setCacheMode()} などの
 * キャッシュ設定メソッドの引数として利用されます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Cache
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */
class CacheMode
{
    /**
     * Cache なし
     *
     * @var int
     */
    public const MODE_NONE = 0;

    /**
     * 自動的に最適なCacheモードを選択する
     *
     * @var int
     */
    public const MODE_AUTO = 1;

    /**
     * APC にキャッシュする
     *
     * @var int
     */
    public const MODE_APC = 2;

    /**
     * ファイルにキャッシュする
     *
     * @var int
     */
    public const MODE_FILE = 3;

    /**
     * 独自のキャッシュモード
     *
     * @var int
     */
    public const MODE_ORIGINAL = 4;
}
