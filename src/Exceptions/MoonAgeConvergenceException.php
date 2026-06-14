<?php

namespace JapaneseDate\Exceptions;

/**
 * 月齢収束失敗例外。
 *
 * {@see \JapaneseDate\Components\MeeusMoonAge::moonAge()} で朔の時刻が
 * 最大反復回数（30回）以内に収束しなかった場合にスローされます。
 *
 * Elp2000MoonAge の「入力時刻を朔として返す」静かなフォールバックとは異なり、
 * 収束失敗を明示的に例外として通知します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Exceptions
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-13
 */
class MoonAgeConvergenceException extends Exception
{
}
