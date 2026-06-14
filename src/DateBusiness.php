<?php

/**
 * DateBusiness.php
 *
 * 営業日カレンダーの設定を保持するクラス。
 * 曜日・祝日・第XX曜日・特定日・フィルタ・マクロなどを
 * Fluent Interface で柔軟に組み合わせられます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace JapaneseDate;

use DateTimeInterface;

/**
 * 営業日カレンダーの設定を保持するバリューオブジェクトクラス。
 *
 * このクラスは、企業独自の営業日ルールを「何をどの優先度で適用するか」
 * という観点でまとめて管理します。設定はすべてメソッドチェーン（Fluent Interface）
 * で記述でき、生成したオブジェクトを {@link \JapaneseDate\Components\BusinessCalendar}
 * に渡すことで判定ロジックが動作します。
 *
 * **判定の優先順位（下ほど強い）:**
 * 1. 曜日設定（closingWeekdays）
 * 2. 祝日設定（bypassHoliday）
 * 3. 第XX曜日 営業指定（openNthWeekdays）
 * 4. 第XX曜日 休業指定（closingNthWeekdays）
 * 5. 特定日 営業指定（openDates）
 * 6. 特定日 休業指定（closingDates）
 * 7. 営業指定フィルタ（openFilters）
 * 8. 休業指定フィルタ（closingFilters）
 * 9. マクロ（macro）
 *
 * **使用例:**
 * ```php
 * use JapaneseDate\DateBusiness;
 *
 * $config = (new DateBusiness())
 *     ->setClosingWeekdays([6, 0])           // 土日休み
 *     ->setBypassHoliday(true)               // 祝日休み
 *     ->addClosingDate('2026-08-15', '夏期休暇')
 *     ->addOpenDate('2026-12-30')            // 特別営業日
 *     ->addClosingFilter(
 *         fn(\DateTimeInterface $d) => $d->format('md') === '1231',
 *         '大晦日休業'
 *     );
 * ```
 *
 * @package JapaneseDate\Components
 * @since   2026-05-29
 */
class DateBusiness
{
    /**
     * 休業曜日のリスト（0=日曜〜6=土曜）
     *
     * @var array<int, bool>
     */
    protected array $closingWeekdays = [];

    /**
     * 祝日を休業日とするかどうか
     *
     * @var bool
     */
    protected bool $bypassHoliday = true;

    /**
     * 第XX曜日を営業日に指定する設定リスト
     *
     * キー: "{$weekday}_{$nth}" (例: "6_2" = 第2土曜)、値: true
     *
     * @var array<string, bool>
     */
    protected array $openNthWeekdays = [];

    /**
     * 第XX曜日を休業日に指定する設定リスト
     *
     * キー: "{$weekday}_{$nth}"、値: ラベル文字列|null
     *
     * @var array<string, string|null>
     */
    protected array $closingNthWeekdays = [];

    /**
     * 特定日を営業日に指定する設定リスト
     *
     * キー: "Ymd" 形式の整数文字列、値: true
     *
     * @var array<string, bool>
     */
    protected array $openDates = [];

    /**
     * 特定日を休業日に指定する設定リスト
     *
     * キー: "Ymd" 形式の整数文字列、値: ラベル文字列|null
     *
     * @var array<string, string|null>
     */
    protected array $closingDates = [];

    /**
     * 営業指定フィルタのリスト
     *
     * それぞれ `fn(\DateTimeInterface $date): bool` の形式で、
     * true を返した場合にその日を営業日とします。
     *
     * @var array<int, callable>
     */
    protected array $openFilters = [];

    /**
     * 休業指定フィルタのリスト
     *
     * それぞれ `['filter' => callable, 'label' => string|null]` の形式。
     * フィルタが true を返した場合にその日を休業日とします。
     *
     * @var array<int, array{filter: callable, label: string|null}>
     */
    protected array $closingFilters = [];

    /**
     * 判定ロジックを完全に上書きするマクロ
     *
     * `fn(\DateTimeInterface $date): bool` の形式で、
     * true を返した場合にその日を営業日とします。
     * 設定されている場合、他のすべての設定より優先されます。
     *
     * @var callable|null
     */
    protected $macro;

    /**
     * 休業曜日を1件追加します。
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @return static メソッドチェーン用に自身を返します
     */
    public function addClosingWeekday(int $weekday): static
    {
        $this->closingWeekdays[$weekday] = true;

        return $this;
    }

    /**
     * 休業曜日の設定を削除します。
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @return static メソッドチェーン用に自身を返します
     */
    public function removeClosingWeekday(int $weekday): static
    {
        unset($this->closingWeekdays[$weekday]);

        return $this;
    }

    /**
     * 第XX曜日を営業日として指定します（曜日設定・祝日設定より優先）。
     *
     * 例：第2土曜日を営業日にする場合は `addOpenNthWeekday(6, 2)` とします。
     *
     * **使用例:**
     * ```php
     * $config->addOpenNthWeekday(6, 2); // 第2土曜日は営業
     * ```
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @param int $nth 第何曜日か（1〜5）
     * @return static メソッドチェーン用に自身を返します
     */
    public function addOpenNthWeekday(int $weekday, int $nth): static
    {
        $this->openNthWeekdays[$weekday . '_' . $nth] = true;

        return $this;
    }

    /**
     * 第XX曜日の営業指定を削除します。
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @param int $nth 第何曜日か（1〜5）
     * @return static メソッドチェーン用に自身を返します
     */
    public function removeOpenNthWeekday(int $weekday, int $nth): static
    {
        unset($this->openNthWeekdays[$weekday . '_' . $nth]);

        return $this;
    }

    /**
     * 第XX曜日を休業日として指定します（営業指定より優先）。
     *
     * 例：第3水曜日を定休日にする場合は `addClosingNthWeekday(3, 3, '定休日')` とします。
     *
     * **使用例:**
     * ```php
     * $config->addClosingNthWeekday(3, 3, '定休日'); // 第3水曜日は休業
     * ```
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @param int $nth 第何曜日か（1〜5）
     * @param string|null $label 休業ラベル（例: '定休日'）
     * @return static メソッドチェーン用に自身を返します
     */
    public function addClosingNthWeekday(int $weekday, int $nth, ?string $label = null): static
    {
        $this->closingNthWeekdays[$weekday . '_' . $nth] = $label;

        return $this;
    }

    /**
     * 第XX曜日の休業指定を削除します。
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @param int $nth 第何曜日か（1〜5）
     * @return static メソッドチェーン用に自身を返します
     */
    public function removeClosingNthWeekday(int $weekday, int $nth): static
    {
        unset($this->closingNthWeekdays[$weekday . '_' . $nth]);

        return $this;
    }

    /**
     * 特定の日付を営業日として指定します（休業日設定より優先）。
     *
     * 日付文字列は `Y-m-d` 形式（例: `'2026-12-30'`）を推奨します。
     *
     * **使用例:**
     * ```php
     * $config->addOpenDate('2026-12-30'); // 2026年12月30日は特別営業
     * ```
     *
     * @param string|DateTimeInterface $date 営業日として指定する日付
     * @return static メソッドチェーン用に自身を返します
     * @throws \Exception
     */
    public function addOpenDate(string|DateTimeInterface $date): static
    {
        $key = $this->toDateKey($date);
        $this->openDates[$key] = true;

        return $this;
    }

    /**
     * DateTimeInterface または日付文字列をキー文字列（"Ymd"）に変換します。
     *
     * @param string|DateTimeInterface $date
     * @return string
     * @throws \Exception
     */
    protected function toDateKey(string|DateTimeInterface $date): string
    {
        if ($date instanceof DateTimeInterface) {
            return $date->format('Ymd');
        }

        return (new \DateTime($date))->format('Ymd');
    }

    /**
     * 特定日の営業指定を削除します。
     *
     * @param string|DateTimeInterface $date 削除する日付
     * @return static メソッドチェーン用に自身を返します
     * @throws \Exception
     */
    public function removeOpenDate(string|DateTimeInterface $date): static
    {
        unset($this->openDates[$this->toDateKey($date)]);

        return $this;
    }

    /**
     * 特定の日付を休業日として指定します（営業指定より優先）。
     *
     * 日付文字列は `Y-m-d` 形式を推奨します。
     * オプションでラベル（例: '夏期休暇'）を付与できます。
     *
     * **使用例:**
     * ```php
     * $config->addClosingDate('2026-08-15', '夏期休暇');
     * $config->addClosingDate('2026-12-31', '年末休業');
     * ```
     *
     * @param string|DateTimeInterface $date 休業日として指定する日付
     * @param string|null $label 休業理由のラベル（例: '夏期休暇'）
     * @return static メソッドチェーン用に自身を返します
     * @throws \Exception
     */
    public function addClosingDate(string|DateTimeInterface $date, ?string $label = null): static
    {
        $key = $this->toDateKey($date);
        $this->closingDates[$key] = $label;

        return $this;
    }

    /**
     * 特定日の休業指定を削除します。
     *
     * @param string|DateTimeInterface $date 削除する日付
     * @return static メソッドチェーン用に自身を返します
     * @throws \Exception
     */
    public function removeClosingDate(string|DateTimeInterface $date): static
    {
        unset($this->closingDates[$this->toDateKey($date)]);

        return $this;
    }

    /**
     * 営業指定フィルタを追加します（優先度7）。
     *
     * フィルタは `fn(\DateTimeInterface $date): bool` の形式で、
     * `true` を返した場合にその日を営業日とします。
     * 複数登録した場合、いずれかが `true` を返せば営業日として扱われます。
     *
     * **使用例:**
     * ```php
     * // 毎月10日は営業
     * $config->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('d') === '10');
     * ```
     *
     * @param callable $filter `fn(\DateTimeInterface $date): bool` 形式のコールバック
     * @return static メソッドチェーン用に自身を返します
     */
    public function addOpenFilter(callable $filter): static
    {
        $this->openFilters[] = $filter;

        return $this;
    }

    /**
     * 休業指定フィルタを追加します（優先度8）。
     *
     * フィルタは `fn(\DateTimeInterface $date): bool` の形式で、
     * `true` を返した場合にその日を休業日とします。
     * オプションでラベルを付与できます。
     *
     * **使用例:**
     * ```php
     * // 毎月最終日曜日は休業
     * $config->addClosingFilter(
     *     fn(\DateTimeInterface $d) => $d->format('N') === '7' &&
     *         (int)$d->format('d') > (int)(new \DateTime('+7 days', new \DateTimeZone($d->format('e'))))->format('d'),
     *     '月末休業'
     * );
     * ```
     *
     * @param callable $filter `fn(\DateTimeInterface $date): bool` 形式のコールバック
     * @param string|null $label 休業理由のラベル（例: '月末休業'）
     * @return static メソッドチェーン用に自身を返します
     */
    public function addClosingFilter(callable $filter, ?string $label = null): static
    {
        $this->closingFilters[] = ['filter' => $filter, 'label' => $label];

        return $this;
    }

    /**
     * すべての設定をリセットしてデフォルト状態（土日休み・祝日休み）に戻します。
     *
     * @return static メソッドチェーン用に自身を返します
     */
    public function reset(): static
    {
        $this->closingWeekdays = [];
        $this->bypassHoliday = true;
        $this->openNthWeekdays = [];
        $this->closingNthWeekdays = [];
        $this->openDates = [];
        $this->closingDates = [];
        $this->openFilters = [];
        $this->closingFilters = [];
        $this->macro = null;

        return $this;
    }

    /**
     * 休業曜日の設定を取得します。
     *
     * @return array<int, bool>
     */
    public function getClosingWeekdays(): array
    {
        return $this->closingWeekdays;
    }

    /**
     * 休業曜日を一括設定します。
     *
     * 0（日曜）〜 6（土曜）の整数配列で指定します。
     * 既存の設定を上書きします。
     *
     * **使用例:**
     * ```php
     * $config->setClosingWeekdays([0, 6]); // 日曜・土曜を休業に
     * ```
     *
     * @param array<int> $weekdays 休業曜日の配列（例: [0, 6] で日・土）
     * @return static メソッドチェーン用に自身を返します
     */
    public function setClosingWeekdays(array $weekdays): static
    {
        $this->closingWeekdays = [];
        foreach ($weekdays as $wd) {
            /** @noinspection PhpCastIsUnnecessaryInspection */
            /** @noinspection UnnecessaryCastingInspection */
            $this->closingWeekdays[(int) $wd] = true;
        }

        return $this;
    }

    /**
     * 祝日を休業日とするかどうかを取得します。
     *
     * @return bool
     */
    public function isBypassHoliday(): bool
    {
        return $this->bypassHoliday;
    }

    /**
     * 祝日を休業日として扱うかどうかを設定します。
     *
     * デフォルトは `true`（祝日を休業日とする）です。
     *
     * @param bool $bypass true の場合、祝日を休業日とする
     * @return static メソッドチェーン用に自身を返します
     */
    public function setBypassHoliday(bool $bypass): static
    {
        $this->bypassHoliday = $bypass;

        return $this;
    }

    /**
     * 第XX曜日 営業指定の設定を取得します。
     *
     * @return array<string, bool>
     */
    public function getOpenNthWeekdays(): array
    {
        return $this->openNthWeekdays;
    }

    /**
     * 第XX曜日 休業指定の設定を取得します。
     *
     * @return array<string, string|null>
     */
    public function getClosingNthWeekdays(): array
    {
        return $this->closingNthWeekdays;
    }

    /**
     * 特定日 営業指定の設定を取得します。
     *
     * @return array<string, bool>
     */
    public function getOpenDates(): array
    {
        return $this->openDates;
    }

    /**
     * 特定日 休業指定の設定を取得します。
     *
     * @return array<string, string|null>
     */
    public function getClosingDates(): array
    {
        return $this->closingDates;
    }

    /**
     * 営業指定フィルタの一覧を取得します。
     *
     * @return array<int, callable>
     */
    public function getOpenFilters(): array
    {
        return $this->openFilters;
    }

    /**
     * 休業指定フィルタの一覧を取得します。
     *
     * @return array<int, array{filter: callable, label: string|null}>
     */
    public function getClosingFilters(): array
    {
        return $this->closingFilters;
    }

    /**
     * マクロを取得します。
     *
     * @return callable|null
     */
    public function getMacro(): ?callable
    {
        return $this->macro;
    }

    /**
     * 判定ロジックを完全に上書きするマクロを設定します（優先度9・最高）。
     *
     * マクロは `fn(\DateTimeInterface $date): bool` の形式で、
     * `true` を返した場合にその日を営業日、`false` を返した場合に休業日と判定します。
     * 設定されたマクロは他のすべての設定より優先されます。
     * `null` を渡すとマクロを解除します。
     *
     * **使用例:**
     * ```php
     * // 月〜木のみ営業という完全カスタムロジック
     * $config->setMacro(fn(\DateTimeInterface $d) => in_array((int)$d->format('N'), [1,2,3,4]));
     * ```
     *
     * @param callable|null $macro `fn(\DateTimeInterface $date): bool` 形式のコールバック、または null
     * @return static メソッドチェーン用に自身を返します
     */
    public function setMacro(?callable $macro): static
    {
        $this->macro = $macro;

        return $this;
    }
}
