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
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate;

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
 * @since       Class available since Release 1.0.0
 */
class CacheMode
{
    /**
     * Cacheなし
     */
    public const MODE_NONE = 0;

    /**
     * 自動的に最適なCacheモードを選択する
     */
    public const MODE_AUTO = 1;

    /**
     * APCにキャッシュする
     */
    public const MODE_APC = 2;

    /**
     * ファイルにキャッシュする
     */
    public const MODE_FILE = 3;

    /**
     * 独自のキャッシュモード
     */
    public const MODE_ORIGINAL = 4;
}
