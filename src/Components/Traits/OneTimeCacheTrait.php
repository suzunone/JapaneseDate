<?php

/**
 * OneTimeCacheTrait.php
 *
 * オブジェクト寿命内で同一キーの計算結果を再利用するトレイト。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */

namespace JapaneseDate\Components\Traits;

use Closure;

/**
 * インスタンス内で同一キーの計算結果を一度だけ保持する簡易キャッシュトレイト。
 *
 * 天文計算や暦計算のように、1 回の処理中で同じ入力が何度も評価される箇所に組み込まれます。
 * {@see oneTimeCache()} にキーとクロージャを渡すと、初回のみクロージャを実行し、
 * 以降は同じキーに保存された値を返します。
 *
 * **利用目的:**
 * - メソッド単位の重複計算を避ける
 * - 外部ストレージを使わず、オブジェクト寿命内だけ結果を保持する
 * - キャッシュ対象を呼び出し側のキー設計で柔軟に制御する
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */
trait OneTimeCacheTrait
{
    /**
     * @var array
     */
    protected $one_time_cache = [];

    /**
     * @param string $key
     * @param \Closure $closure
     * @return mixed
     */
    protected function oneTimeCache($key, $closure)
    {
        if (array_key_exists($key, $this->one_time_cache)) {
            return $this->one_time_cache[$key];
        }

        return $this->one_time_cache[$key] = $closure();
    }
}
