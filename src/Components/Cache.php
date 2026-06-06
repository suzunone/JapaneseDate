<?php

/**
 * Cache.php
 *
 * 暦計算結果を複数の方式で保存するキャッシュコンポーネント。
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
 * @since        2018/04/29 23:36
 */

namespace JapaneseDate\Components;

use Closure;
use JapaneseDate\CacheMode;

/**
 * 暦計算結果をメモリ・APCu・ファイル・独自処理でキャッシュするコンポーネント。
 *
 * 旧暦や二十四節気など、同じ入力に対して繰り返し実行されやすい重い計算を
 * {@see forever()} 経由で保存し、次回以降の計算負荷を抑えます。
 * キャッシュ方式は {@see \JapaneseDate\CacheMode} の定数で切り替えられます。
 *
 * **対応するキャッシュ方式:**
 * - `MODE_NONE` — キャッシュせず毎回クロージャを実行
 * - `MODE_AUTO` — 独自クロージャ、APCu、ファイルの順に利用可能な方式を選択
 * - `MODE_ORIGINAL` — ユーザーが設定したクロージャへ委譲
 * - `MODE_APC` — APCu を利用
 * - `MODE_FILE` — 指定ディレクトリにシリアライズして保存
 *
 * ファイルキャッシュを利用する場合は {@see setCacheFilePath()} で保存先を設定します。
 * 独自のキャッシュストアに接続したい場合は {@see setCacheClosure()} を使用します。
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
class Cache extends CacheMode
{
    /**
     * キャッシュモード
     *
     * @var int
     */
    protected static int $mode = 1;

    /**
     * @var ?Closure
     */
    protected static ?Closure $cache_closure = null;

    /**
     * @var string|null
     */
    protected static ?string $cache_file_path = null;

    /**
     * キャッシュデータ
     *
     * @var array
     */
    protected static array $cache = [];

    /**
     * 永続キャッシュ
     *
     * @param string $cache_name
     * @param Closure $function
     * @return mixed
     */
    public static function forever(string $cache_name, Closure $function): mixed
    {
        if (static::$mode === static::MODE_NONE) {
            return $function();
        }

        $cache = &static::$cache;

        if (isset($cache[$cache_name])) {
            return $cache[$cache_name];
        }

        if (static::$mode === static::MODE_ORIGINAL ||
            (static::$cache_closure instanceof Closure && static::$mode === static::MODE_AUTO)) {
            // 独自キャッシュモード
            $closure = static::$cache_closure;

            return $cache[$cache_name] = $closure($cache_name, $function);
        }

        if (static::$mode === static::MODE_APC ||
            (static::$mode === static::MODE_AUTO && function_exists('apcu_add'))) {
            // APC モード
            return $cache[$cache_name] = static::apcForever($cache_name, $function);
        }

        if (static::$cache_file_path && (static::$mode === static::MODE_FILE || static::$mode === static::MODE_AUTO)) {
            // ファイルモード
            return $cache[$cache_name] = static::fileForever($cache_name, $function);
        }

        return $cache[$cache_name] = $function();
    }

    /**
     * APCによる永続キャッシュ
     * @param string $cache_name
     * @param Closure $function
     * @return mixed
     */
    protected static function apcForever(string $cache_name, Closure $function): mixed
    {
        if (!(function_exists('apcu_fetch') && function_exists('apcu_add'))) {
            return $function();
        }

        $success = false;
        $res = apcu_fetch($cache_name, $success);
        if ($success && $res) {
            return $res;
        }

        $res = $function();

        apcu_add($cache_name, $res);

        return $res;
    }

    /**
     * ファイルによる永続キャッシュ
     *
     * @param string $cache_name
     * @param Closure $function
     * @return mixed
     */
    protected static function fileForever(string $cache_name, Closure $function): mixed
    {
        $cache_name_path = realpath(static::$cache_file_path) . DIRECTORY_SEPARATOR . sha1($cache_name);

        if (is_file($cache_name_path)) {
            /** @noinspection UnserializeExploitsInspection */
            return unserialize(file_get_contents($cache_name_path));
        }

        $res = $function();
        file_put_contents($cache_name_path, serialize($res));

        return $res;
    }

    /**
     * キャッシュモードをセットする
     *
     * @param int $mode
     */
    public static function setMode(int $mode): void
    {
        static::$mode = $mode;
    }

    /**
     * キャッシュファイルパスをセットする
     *
     * @param string $cache_file_path
     */
    public static function setCacheFilePath(string $cache_file_path): void
    {
        static::$mode = static::MODE_FILE;
        static::$cache_file_path = $cache_file_path;
    }

    /**
     * 独自キャッシュロジックのセット
     *
     * @param Closure $function
     */
    public static function setCacheClosure(Closure $function): void
    {
        static::$mode = static::MODE_ORIGINAL;
        static::$cache_closure = $function;
    }
}
