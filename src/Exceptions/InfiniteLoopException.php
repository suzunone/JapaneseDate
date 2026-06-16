<?php

namespace JapaneseDate\Exceptions;

/**
 * 営業日探索の無限ループ防止例外。
 *
 * {@see \JapaneseDate\Traits\Business} および {@see \JapaneseDate\DateInterval} の
 * 営業日探索ループが上限（{@see \JapaneseDate\Components\BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT}）
 * を超えた場合にスローされます。
 *
 * 全曜日を休業に設定した場合や、マクロが常に false を返す設定で
 * 営業日が存在しない状態になると、このループは終了しません。
 * このような設定ミスを早期に検出するため、上限に達した時点で本例外を投げます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Exceptions
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.6.3
 */
class InfiniteLoopException extends Exception
{
}
