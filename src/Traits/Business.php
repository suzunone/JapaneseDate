<?php

/**
 * Business.php
 *
 * 営業日に関する getter および日付移動メソッドを定義した Trait です。
 * このファイルは {@see \JapaneseDate\DateTime} および
 * {@see \JapaneseDate\DateTimeImmutable} に mix-in されます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace JapaneseDate\Traits;

use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\Exceptions\InfiniteLoopException;

/**
 * 営業日に関する操作メソッドを提供する Trait。
 *
 * 営業日判定・翌営業日・前営業日・N営業日後/前への移動など、
 * ビジネスカレンダーに基づく日付操作をまとめて定義します。
 *
 * カレンダー設定はインスタンス個別 > グローバル > デフォルトの優先順位で適用されます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Business
{
    /**
     * このインスタンスの日付が休業日の場合、そのラベルを返します。
     *
     * 営業日の場合は null を返します。
     *
     * @return string|null 休業ラベル、または null
     */
    public function getBusinessDayLabel(): ?string
    {
        return BusinessCalendar::getClosingLabel($this, $this->businessConfig);
    }

    /**
     * この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。
     *
     * 営業日の場合はそのまま自身を返します。
     *
     * @return static この日または翌以降の直近営業日を表すインスタンス
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function shiftToClosestBusinessDayAfter()
    {
        if ($this->isBusinessDay()) {
            return clone $this;
        }

        return $this->nextBusinessDay();
    }

    /**
     * このインスタンスの日付が営業日かどうかを判定します。
     *
     * 適用されているカレンダー設定（インスタンス個別 > グローバル > デフォルト）に基づいて判定します。
     *
     * @return bool 営業日であれば true、休業日であれば false
     */
    public function isBusinessDay(): bool
    {
        return BusinessCalendar::isBusinessDay($this, $this->businessConfig);
    }

    /**
     * 次の営業日を取得します。
     *
     * 翌日から順に走査し、最初に見つかった営業日を返します。
     *
     * @return static 次の営業日を表すインスタンス
     * @throws InfiniteLoopException 営業日が {@see BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT} 日以内に見つからない場合
     */
    public function nextBusinessDay()
    {
        $dt = clone $this;
        $dt = $dt->addDay();
        $guard = 0;
        while (!BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
            if (++$guard >= BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT) {
                throw new InfiniteLoopException(
                    '営業日が ' . BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT . ' 日以内に見つかりませんでした。営業日の設定を確認してください。'
                );
            }
            $dt = $dt->addDay();
        }

        return $dt;
    }

    /**
     * この日が休業日の場合、前営業日にシフトしたインスタンスを返します。
     *
     * 営業日の場合はそのまま自身を返します。
     *
     * @return static この日または前以前の直近営業日を表すインスタンス
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function shiftToClosestBusinessDayBefore()
    {
        if ($this->isBusinessDay()) {
            return clone $this;
        }

        return $this->previousBusinessDay();
    }

    /**
     * 前の営業日を取得します。
     *
     * 前日から順に走査し、最初に見つかった営業日を返します。
     *
     * @return static 前の営業日を表すインスタンス
     * @throws InfiniteLoopException 営業日が {@see BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT} 日以内に見つからない場合
     */
    public function previousBusinessDay()
    {
        $dt = clone $this;
        $dt = $dt->subDay();
        $guard = 0;
        while (!BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
            if (++$guard >= BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT) {
                throw new InfiniteLoopException(
                    '営業日が ' . BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT . ' 日以内に見つかりませんでした。営業日の設定を確認してください。'
                );
            }
            $dt = $dt->subDay();
        }

        return $dt;
    }

    /**
     * 指定した営業日数後の日付を返します。
     *
     * @param int $days 加算する営業日数（正の整数）
     * @return static N営業日後を表すインスタンス
     * @throws InfiniteLoopException 連続して {@see BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT} 日以上営業日が見つからない場合
     */
    public function addBusinessDays($days)
    {
        $dt = clone $this;
        $count = 0;
        $consecutiveNonBusinessDays = 0;
        while ($count < $days) {
            $dt = $dt->addDay();
            if (BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
                $count++;
                $consecutiveNonBusinessDays = 0;
            } elseif (++$consecutiveNonBusinessDays >= BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT) {
                throw new InfiniteLoopException(
                    '営業日が ' . BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT . ' 日以内に見つかりませんでした。営業日の設定を確認してください。'
                );
            }
        }

        return $dt;
    }

    /**
     * 指定した営業日数前の日付を返します。
     *
     * @param int $days 減算する営業日数（正の整数）
     * @return static N営業日前を表すインスタンス
     * @throws InfiniteLoopException 連続して {@see BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT} 日以上営業日が見つからない場合
     */
    public function subBusinessDays($days)
    {
        $dt = clone $this;
        $count = 0;
        $consecutiveNonBusinessDays = 0;
        while ($count < $days) {
            $dt = $dt->subDay();
            if (BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
                $count++;
                $consecutiveNonBusinessDays = 0;
            } elseif (++$consecutiveNonBusinessDays >= BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT) {
                throw new InfiniteLoopException(
                    '営業日が ' . BusinessCalendar::BUSINESS_DAY_SEARCH_LIMIT . ' 日以内に見つかりませんでした。営業日の設定を確認してください。'
                );
            }
        }

        return $dt;
    }
}
