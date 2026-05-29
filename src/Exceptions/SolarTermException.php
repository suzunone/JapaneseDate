<?php

/**
 * SolarTermException.php
 *
 * 二十四節気に関連する例外クラス。
 * 不正な節気コードの指定や節気計算の失敗など、
 * 二十四節気処理に特有のエラーを表現します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Exceptions
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2023-05-04
 */

namespace JapaneseDate\Exceptions;

/**
 * 二十四節気に関連する例外クラス。
 *
 * 不正な節気コードの指定や節気計算の失敗など、
 * 二十四節気処理に特有のエラーを表現します。
 *
 * 【使用例】
 * ```php
 * use JapaneseDate\Exceptions\SolarTermException;
 *
 * if (!isset($solarTermMap[$code])) {
 *     throw new SolarTermException('不正な節気コードが指定されました: ' . $code);
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
 * @since       2023-05-04
 */
class SolarTermException extends Exception
{
}
