<?php

/**
 * CacheSetting.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Traits;

use Closure;
use JapaneseDate\Components\Cache;

/**
 * Trait CacheSetting
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait CacheSetting
{
    /**
     * キャッシュモードを指定する
     *
     * 指定するキャッシュモードは、{@see \JapaneseDate\CacheMode}参照。
     *
     * @param int $mode キャッシュモード
     * @see \JapaneseDate\CacheMode::MODE_AUTO 自動でキャッシュモードを選択
     * @see \JapaneseDate\CacheMode::MODE_APC APCを使用したキャッシュ
     * @see \JapaneseDate\CacheMode::MODE_FILE ファイルを使用したキャッシュ
     * @see \JapaneseDate\CacheMode::MODE_ORIGINAL 独自キャッシュ
     * @see \JapaneseDate\CacheMode::MODE_NONE キャッシュなし
     */
    public static function setCacheMode(int $mode): void
    {
        Cache::setMode($mode);
    }

    /**
     * キャッシュファイル保存ディレクトリをセットします
     *
     * キャッシュモードがファイル{@see \JapaneseDate\CacheMode::MODE_FILE}の時に使用する、キャッシュファイル保存ディレクトリをセットします。
     *
     * @param string $cache_file_path キャッシュファイルを保存するディレクトリ
     */
    public static function setCacheFilePath(string $cache_file_path): void
    {
        Cache::setCacheFilePath($cache_file_path);
    }

    /**
     * 独自キャッシュロジックのセット
     *
     * キャッシュモードが独自キャッシュ{@see \JapaneseDate\CacheMode::MODE_ORIGINAL}の時に使用する、クロージャをセットします。
     *
     * セットされるクロージャは、
     *
     * mixed ClosureFunction(string $key, Closure $function)
     *
     * | Parameter | Type | Description |
     * |-----------|------|-------------|
     * | `$key` | **string** | キャッシュ単位の一意なキー。このキーにマッチしたキャッシュデータが有る場合は、キャッシュされたデータをreturnしてください。 |
     * | `$function` | **\Closure** | キャッシュされたデータが取得できない場合に実行するクロージャです。実行すれば、キャッシュするべきデータが返されます。 |
     *
     * @param Closure $function 独自キャッシュのロジックが含まれたクロージャ
     */
    public static function setCacheClosure(Closure $function): void
    {
        Cache::setCacheClosure($function);
    }

    /**
     * @param string $date_text
     * @return static
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    protected function innerDateTime(string $date_text): static
    {
        static $cache;

        return $cache[$date_text] ?? ($cache[$date_text] = new static($date_text, $this->getTimezone()));
    }
}
