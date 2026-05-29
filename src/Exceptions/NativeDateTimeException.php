<?php

/**
 * NativeDateTimeException.php
 *
 * ネイティブ DateTime および Carbon 由来の例外クラス。
 * PHP 組み込みの DateTime や Carbon ライブラリが送出する例外を
 * JapaneseDate パッケージの例外体系でラップする際に使用します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Exceptions
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2020-03-07
 */

namespace JapaneseDate\Exceptions;

/**
 * ネイティブ DateTime および Carbon 由来の例外クラス。
 *
 * PHP 組み込みの \DateTime や Carbon ライブラリが送出する例外を
 * JapaneseDate パッケージの例外体系でラップするために使用します。
 * 不正な日付文字列や範囲外の日付操作など、日時解析・変換時の
 * エラーを表現します。
 *
 * 【使用例】
 * ```php
 * use JapaneseDate\Exceptions\NativeDateTimeException;
 *
 * try {
 *     // 不正な日付操作
 * } catch (\Exception $e) {
 *     throw new NativeDateTimeException($e->getMessage(), $e->getCode(), $e);
 * }
 * ```
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Exceptions
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2020-03-07
 */
class NativeDateTimeException extends Exception
{
}
