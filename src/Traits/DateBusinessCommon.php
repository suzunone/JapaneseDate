<?php

/**
 * BusinessCalendar.php
 *
 * 営業日カレンダー機能を各クラスに付与する共通Trait。
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

use DateTimeInterface;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;

/**
 * 営業日カレンダー機能を各日時クラスに付与する共通Trait。
 *
 * このTraitを `use` したクラスは、インスタンスごとに {@link DateBusiness} 設定を保持でき、
 * 設定を保持していない場合は {@link BusinessCalendar} のグローバル/デフォルト設定を参照します。
 *
 * **提供するインターフェイス:**
 * - `setBusinessConfig()` / `getBusinessConfig()` でインスタンス個別設定を操作
 * - `setClosingDay()`, `setOpenDay()`, `setClosingWeekdays()` などの直接設定ショートカット
 * - `isBusinessDay()`, `getBusinessDayLabel()` で判定
 *
 * **設定の優先順位（強い順）:**
 * 1. インスタンス個別設定（このTraitが保持）
 * 2. グローバル設定（`BusinessCalendarManager::setGlobalConfig()` で設定）
 * 3. デフォルト設定（土日・祝日休み）
 *
 * @package JapaneseDate\Traits
 * @since   2026-05-29
 */
trait DateBusinessCommon
{
    /**
     * インスタンス個別の営業日設定
     *
     * null の場合はマネージャーのグローバル/デフォルト設定を参照します。
     *
     * @var DateBusiness|null
     */
    protected $businessConfig;

    /**
     * インスタンスが保持している個別の営業日設定を取得します。
     *
     * 個別設定を持っていない場合は `null` を返します。
     * 判定に実際に使用される設定（グローバル/デフォルト含む解決済み設定）は
     * {@link BusinessCalendar::resolveConfig()} で取得できます。
     *
     * @return DateBusiness|null インスタンス個別設定、または null
     */
    public function getBusinessConfig(): ?DateBusiness
    {
        return $this->businessConfig;
    }

    /**
     * インスタンスに個別の営業日設定を適用します。
     *
     * 設定後、このインスタンスのすべての営業日判定にこの設定が使用されます。
     * `null` を渡すとインスタンス個別設定を解除し、グローバル/デフォルト設定に戻ります。
     *
     * **使用例:**
     * ```php
     * $dt->setBusinessConfig(
     *     (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(true)
     * );
     * ```
     *
     * @param DateBusiness|null $config インスタンスに適用する設定オブジェクト、または null（解除）
     * @return static メソッドチェーン用に自身を返します
     */
    public function setBusinessConfig($config)
    {
        $this->businessConfig = $config;

        return $this;
    }

    /**
     * 特定の日付を休業日として指定します。
     *
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->setClosingDay('2026-08-15', '夏期休暇');
     * ```
     *
     * @param string|DateTimeInterface $date 休業日として指定する日付
     * @param string|null $label 休業理由のラベル（例: '夏期休暇'）
     * @return static メソッドチェーン用に自身を返します
     * @throws \Exception
     */
    public function setClosingDay($date, $label = null)
    {
        $this->getOrCreateBusinessConfig()->addClosingDate($date, $label);

        return $this;
    }

    /**
     * インスタンスに個別設定がなければ新規作成してから返します（内部ヘルパー）。
     *
     * このメソッドは直接設定ショートカット（`setClosingDay()` 等）の内部で使用します。
     * ショートカットを呼び出すと自動的にインスタンス個別設定が生成されます。
     *
     * @return DateBusiness インスタンスの有効な設定オブジェクト
     */
    protected function getOrCreateBusinessConfig(): DateBusiness
    {
        if ($this->businessConfig === null) {
            $this->businessConfig = clone BusinessCalendar::resolveConfig(null);
        }

        return $this->businessConfig;
    }

    /**
     * 特定の日付を営業日として指定します。
     *
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->setOpenDay('2026-12-30'); // 特別営業日
     * ```
     *
     * @param string|DateTimeInterface $date 営業日として指定する日付
     * @return static メソッドチェーン用に自身を返します
     * @throws \Exception
     */
    public function setOpenDay($date)
    {
        $this->getOrCreateBusinessConfig()->addOpenDate($date);

        return $this;
    }

    /**
     * 休業曜日を一括設定します。
     *
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->setClosingWeekdays([0, 6]); // 日・土を休業に
     * ```
     *
     * @param array<int> $weekdays 休業曜日の配列（例: [0, 6] で日・土）
     * @return static メソッドチェーン用に自身を返します
     */
    public function setClosingWeekdays($weekdays)
    {
        $this->getOrCreateBusinessConfig()->setClosingWeekdays($weekdays);

        return $this;
    }

    /**
     * 祝日を休業日として扱うかどうかを設定します。
     *
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * @param bool $bypass true の場合、祝日を休業日とする
     * @return static メソッドチェーン用に自身を返します
     */
    public function setBypassHoliday($bypass)
    {
        $this->getOrCreateBusinessConfig()->setBypassHoliday($bypass);

        return $this;
    }

    /**
     * 第XX曜日を営業日として指定します。
     *
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->setOpenNthWeekday(6, 2); // 第2土曜日は営業
     * ```
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @param int $nth 第何曜日か（1〜5）
     * @return static メソッドチェーン用に自身を返します
     */
    public function setOpenNthWeekday($weekday, $nth)
    {
        $this->getOrCreateBusinessConfig()->addOpenNthWeekday($weekday, $nth);

        return $this;
    }

    /**
     * 第XX曜日を休業日として指定します。
     *
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->setClosingNthWeekday(3, 3, '定休日'); // 第3水曜日は休業
     * ```
     *
     * @param int $weekday 曜日（0=日曜〜6=土曜）
     * @param int $nth 第何曜日か（1〜5）
     * @param string|null $label 休業ラベル
     * @return static メソッドチェーン用に自身を返します
     */
    public function setClosingNthWeekday($weekday, $nth, $label = null)
    {
        $this->getOrCreateBusinessConfig()->addClosingNthWeekday($weekday, $nth, $label);

        return $this;
    }

    /**
     * 営業指定フィルタを追加します。
     *
     * フィルタが `true` を返した場合にその日を営業日として扱います。
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('d') === '10');
     * ```
     *
     * @param callable $filter `fn(\DateTimeInterface $date): bool` 形式のコールバック
     * @return static メソッドチェーン用に自身を返します
     */
    public function addOpenFilter($filter)
    {
        $this->getOrCreateBusinessConfig()->addOpenFilter($filter);

        return $this;
    }

    /**
     * 休業指定フィルタを追加します。
     *
     * フィルタが `true` を返した場合にその日を休業日として扱います。
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->addClosingFilter(
     *     fn(\DateTimeInterface $d) => $d->format('md') === '1231',
     *     '大晦日休業'
     * );
     * ```
     *
     * @param callable $filter `fn(\DateTimeInterface $date): bool` 形式のコールバック
     * @param string|null $label 休業理由のラベル
     * @return static メソッドチェーン用に自身を返します
     */
    public function addClosingFilter($filter, $label = null)
    {
        $this->getOrCreateBusinessConfig()->addClosingFilter($filter, $label);

        return $this;
    }

    /**
     * 判定ロジックを完全に上書きするマクロを設定します。
     *
     * マクロは他のすべての設定より優先されます。
     * `null` を渡すとマクロを解除します。
     * インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。
     *
     * **使用例:**
     * ```php
     * $dt->setBusinessMacro(fn(\DateTimeInterface $d) => in_array((int)$d->format('N'), [1,2,3,4]));
     * ```
     *
     * @param callable|null $macro `fn(\DateTimeInterface $date): bool` 形式のコールバック、または null
     * @return static メソッドチェーン用に自身を返します
     */
    public function setBusinessMacro($macro)
    {
        $this->getOrCreateBusinessConfig()->setMacro($macro);

        return $this;
    }

    /**
     * 指定した日付（または自身が保持する日付）が営業日かどうかを判定します。
     *
     * このメソッドはTraitを適用したクラスが `DateTimeInterface` を実装している場合に
     * 自身の日付を使って判定します。`$date` を省略した場合は自身を対象とします。
     *
     * @param DateTimeInterface|null $date 判定する日付（省略時は自身）
     * @return bool 営業日であれば true
     */
    public function checkIsBusinessDay($date = null): bool
    {
        $target = $date ?? ($this instanceof DateTimeInterface ? $this : null);
        if ($target === null) {
            return false;
        }

        return BusinessCalendar::isBusinessDay($target, $this->businessConfig);
    }

    /**
     * 指定した日付（または自身が保持する日付）の休業ラベルを取得します。
     *
     * 営業日の場合は `null` を返します。
     *
     * @param DateTimeInterface|null $date 判定する日付（省略時は自身）
     * @return string|null 休業ラベル、または null
     */
    public function checkGetBusinessDayLabel($date = null): ?string
    {
        $target = $date ?? ($this instanceof DateTimeInterface ? $this : null);
        if ($target === null) {
            return null;
        }

        return BusinessCalendar::getClosingLabel($target, $this->businessConfig);
    }
}
