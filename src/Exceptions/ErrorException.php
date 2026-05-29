<?php

/**
 * ErrorException.php
 *
 * JapaneseDate パッケージ共通のエラー例外クラス。
 * PHP 組み込みの \ErrorException を継承し、パッケージ内の
 * エラーレベルの例外に使用します。
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
 * JapaneseDate パッケージ共通のエラー例外クラス。
 *
 * PHP 組み込みの \ErrorException を継承しており、パッケージ内で
 * エラーレベルの例外を送出する際に使用します。
 *
 * 【使用例】
 * ```php
 * use JapaneseDate\Exceptions\ErrorException;
 *
 * throw new ErrorException('処理中にエラーが発生しました。');
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
class ErrorException extends \ErrorException
{
}
