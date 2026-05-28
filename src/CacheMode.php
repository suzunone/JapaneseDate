<?php

/**
 * Class CacheMode
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
 * キャッシュモードの定数クラス
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
     * Cacheなし
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
     * APCにキャッシュする
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
