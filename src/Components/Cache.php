<?php
/**
 * Class Cache
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/04/29 23:36
 */

namespace JapaneseDate\Components;

use Closure;
use JapaneseDate\CacheMode;

/**
 * Class Cache
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
class Cache extends CacheMode
{
    /**
     * キャッシュモード
     *
     * @var int
     */
    protected static $mode = 1;

    /**
     * @var Closure
     */
    protected static $cache_closure;

    /**
     * @var string
     */
    protected static $cache_file_path;


    /**
     * キャッシュデータ
     *
     * @var array
     */
    protected static $cache = [];

    /**
     * @param string $cache_name
     * @param Closure $function
     * @return mixed
     */
    public static function forever(string $cache_name, Closure $function)
    {
        $cache = &static::$cache;

        if (isset($cache[$cache_name])) {
            return $cache[$cache_name];
        }

        if (static::$mode === static::MODE_ORIGINAL ||
            (static::$cache_closure instanceof Closure && static::$mode === static::MODE_AUTO)) {
            // 独自キャッシュモード
            $closure = static::$cache_closure;

            return $cache[$cache_name] = $closure($cache_name, $function);
        } elseif (static::$mode === static::MODE_APC ||
            (static::$mode === static::MODE_AUTO && function_exists('apcu_add'))) {
            // APCモード
            return $cache[$cache_name] = static::apcForever($cache_name, $function);
        } elseif (static::$cache_file_path && (static::$mode === static::MODE_FILE || static::$mode === static::MODE_AUTO)) {
            // ファイルモード
            return $cache[$cache_name] = static::fileForever($cache_name, $function);
        }

        return $cache[$cache_name] = $function();
    }


    /**
     * キャッシュモードをセットする
     *
     * @param int $mode
     */
    public static function setMode(int $mode)
    {
        static::$mode = $mode;
    }

    /**
     * キャッシュファイルパスをセットする
     *
     * @param string $cache_file_path
     */
    public static function setCacheFilePath(string $cache_file_path)
    {
        static::$mode            = static::MODE_FILE;
        static::$cache_file_path = $cache_file_path;
    }

    /**
     * 独自キャッシュロジックのセット
     *
     * @param Closure $function
     */
    public static function setCacheClosure(Closure $function)
    {
        static::$mode          = static::MODE_ORIGINAL;
        static::$cache_closure = $function;
    }

    /**
     * @param string $cache_name
     * @param Closure $function
     * @return mixed
     */
    protected static function apcForever(string $cache_name, Closure $function)
    {
        $success = false;
        $res     = apcu_fetch($cache_name, $success);
        if ($success && $res) {
            return $res;
        }

        $res = $function();

        apcu_add($cache_name, $res);

        return $res;
    }

    /**
     * @param string $cache_name
     * @param Closure $function
     * @return mixed
     */
    protected static function fileForever(string $cache_name, Closure $function)
    {
        $cache_name_path = realpath(static::$cache_file_path) . DIRECTORY_SEPARATOR . sha1($cache_name);

        if (is_file($cache_name_path)) {
            $res = unserialize(file_get_contents($cache_name_path));

            return $res;
        }

        $res = $function();
        file_put_contents($cache_name_path, serialize($res));

        return $res;
    }
}
