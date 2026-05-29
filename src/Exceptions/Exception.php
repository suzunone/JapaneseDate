<?php

/**
 * JapaneseDate パッケージ共通の汎用例外クラス。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Exception
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */

namespace JapaneseDate\Exceptions;

/**
 * JapaneseDate パッケージ共通の汎用例外クラス。
 *
 * パッケージ内で発生する一般的な例外の基底クラスです。
 * 個別の例外クラスはこのクラスを継承して定義します。
 *
 * 【使用例】
 * ```php
 * use JapaneseDate\Exceptions\Exception;
 *
 * throw new Exception('エラーが発生しました。');
 * ```
 *
 * @package     JapaneseDate
 * @subpackage  Exceptions
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */
class Exception extends \Exception
{
}
