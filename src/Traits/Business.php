<?php

namespace JapaneseDate\Traits;

use JapaneseDate\Components\BusinessCalendar;
trait Business
{
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
     * 次の営業日を取得します。
     *
     * 翌日から順に走査し、最初に見つかった営業日を返します。
     *
     * @return static 次の営業日を表すインスタンス
     */
    public function nextBusinessDay(): static
    {
        $dt = clone $this;
        $dt = $dt->addDay();
        while (!BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
            $dt = $dt->addDay();
        }

        return $dt;
    }

    /**
     * 前の営業日を取得します。
     *
     * 前日から順に走査し、最初に見つかった営業日を返します。
     *
     * @return static 前の営業日を表すインスタンス
     */
    public function previousBusinessDay(): static
    {
        $dt = clone $this;
        $dt = $dt->subDay();
        while (!BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
            $dt = $dt->subDay();
        }

        return $dt;
    }

    /**
     * この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。
     *
     * 営業日の場合はそのまま自身を返します。
     *
     * @return static この日または翌以降の直近営業日を表すインスタンス
     */
    public function shiftToClosestBusinessDayAfter(): static
    {
        if ($this->isBusinessDay()) {
            return clone $this;
        }

        return $this->nextBusinessDay();
    }

    /**
     * この日が休業日の場合、前営業日にシフトしたインスタンスを返します。
     *
     * 営業日の場合はそのまま自身を返します。
     *
     * @return static この日または前以前の直近営業日を表すインスタンス
     */
    public function shiftToClosestBusinessDayBefore(): static
    {
        if ($this->isBusinessDay()) {
            return clone $this;
        }

        return $this->previousBusinessDay();
    }

    /**
     * 指定した営業日数後の日付を返します。
     *
     * @param  int $days 加算する営業日数（正の整数）
     * @return static N営業日後を表すインスタンス
     */
    public function addBusinessDays(int $days): static
    {
        $dt = clone $this;
        $count = 0;
        while ($count < $days) {
            $dt = $dt->addDay();
            if (BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
                $count++;
            }
        }

        return $dt;
    }

    /**
     * 指定した営業日数前の日付を返します。
     *
     * @param  int $days 減算する営業日数（正の整数）
     * @return static N営業日前を表すインスタンス
     */
    public function subBusinessDays(int $days): static
    {
        $dt = clone $this;
        $count = 0;
        while ($count < $days) {
            $dt = $dt->subDay();
            if (BusinessCalendar::isBusinessDay($dt, $this->businessConfig)) {
                $count++;
            }
        }

        return $dt;
    }
}