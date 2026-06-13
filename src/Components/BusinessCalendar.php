<?php

/**
 * BusinessCalendar.php
 *
 * 営業日カレンダーのグローバル設定を管理し、日付の営業日判定を行うマネージャークラス。
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

namespace JapaneseDate\Components;

use DateTimeInterface;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use Throwable;

/**
 * 営業日カレンダーのグローバル設定管理と日付判定を担うシングルトン的マネージャークラス。
 *
 * このクラスは以下の役割を持ちます。
 *
 * - **グローバル設定の保持:** {@link setGlobalConfig()} で設定したルールを
 *   ライブラリ全体に反映します。
 * - **デフォルト設定の提供:** グローバル設定が存在しない場合に使用される
 *   「土日・祝日休み」のデフォルトルールを管理します。
 * - **判定ロジックの集約:** {@link isBusinessDay()} および {@link getClosingLabel()}
 *   で、設定の優先順位に従った判定を一元的に実行します。
 *
 * **設定の優先順位（インスタンス > グローバル > デフォルト）:**
 *
 * 各 `DateTime` 等のインスタンスが個別の {@link DateBusiness} 設定を持つ場合、
 * その設定が最優先されます。持たない場合はグローバル設定、さらにそれもない場合は
 * デフォルト（土日・祝日休み）が使用されます。
 *
 * **使用例:**
 * ```php
 * use JapaneseDate\Components\BusinessCalendar;
 * use JapaneseDate\DateBusiness;
 *
 * // グローバル設定を変更する（土日・祝日に加え、8月15日を夏期休暇に）
 * $config = (new DateBusiness())
 *     ->setClosingWeekdays([0, 6])
 *     ->setBypassHoliday(true)
 *     ->addClosingDate('2026-08-15', '夏期休暇');
 *
 * BusinessCalendar::setGlobalConfig($config);
 * ```
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
class BusinessCalendar
{
    /**
     * ライブラリ全体に適用するグローバル設定
     *
     * @var DateBusiness|null
     */
    protected static ?DateBusiness $globalConfig = null;

    /**
     * デフォルト設定（土日休み・祝日休み）
     *
     * @var DateBusiness|null
     */
    protected static ?DateBusiness $defaultConfig = null;

    /**
     * グローバル設定を取得します。
     *
     * グローバル設定が未設定の場合は `null` を返します。
     *
     * @return DateBusiness|null 現在のグローバル設定、または null
     */
    public static function getGlobalConfig(): ?DateBusiness
    {
        return static::$globalConfig;
    }

    /**
     * グローバル設定を設定します。
     *
     * ここで設定した {@link DateBusiness} オブジェクトは、インスタンス個別の
     * 設定を持たないすべての日時オブジェクトの判定に使用されます。
     * `null` を渡すとグローバル設定をリセットし、デフォルト設定が使用されます。
     *
     * **使用例:**
     * ```php
     * BusinessCalendar::setGlobalConfig(
     *     (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(true)
     * );
     * ```
     *
     * @param DateBusiness|null $config 設定オブジェクト、または null（リセット）
     * @return void
     */
    public static function setGlobalConfig(?DateBusiness $config): void
    {
        static::$globalConfig = $config;
    }

    /**
     * グローバル設定とデフォルト設定をすべてリセットします。
     *
     * テストの独立性を保つためにテストの setUp/tearDown で呼ぶことを推奨します。
     *
     * @return void
     */
    public static function resetAll(): void
    {
        static::$globalConfig = null;
        static::$defaultConfig = null;
    }

    /**
     * 指定した日付が休業日の場合、そのラベルを返します。
     *
     * 営業日の場合は `null` を返します。
     * 複数の条件が一致する場合は最高優先度の条件のラベルを返します。
     * ラベルが設定されていない場合も `null` を返します（祝日の場合は祝日名は別途取得）。
     *
     * @param DateTimeInterface $date 判定する日付
     * @param DateBusiness|null $instanceConfig インスタンス個別設定（なければ null）
     * @return string|null 休業ラベル、または null
     */
    public static function getClosingLabel(DateTimeInterface $date, ?DateBusiness $instanceConfig = null): ?string
    {
        if (static::isBusinessDay($date, $instanceConfig)) {
            return null;
        }

        $config = static::resolveConfig($instanceConfig);

        // マクロの場合はラベルなし
        if ($config->getMacro() !== null) {
            return null;
        }

        $label = null;
        $weekday = (int)$date->format('w');

        // 優先度1: 曜日
        // ラベルなしのため処理なし

        // 優先度2: 祝日
        // ラベルなしのため処理なし

        // 優先度4: 第XX曜日 休業指定
        $nth = static::getNthWeekday($date);
        $nthKey = $weekday . '_' . $nth;
        if (array_key_exists($nthKey, $config->getClosingNthWeekdays())) {
            $label = $config->getClosingNthWeekdays()[$nthKey];
        }

        // 優先度6: 特定日 休業指定
        $dateKey = $date->format('Ymd');
        if (array_key_exists($dateKey, $config->getClosingDates())) {
            $label = $config->getClosingDates()[$dateKey];
        }

        // 優先度8: 休業指定フィルタ
        foreach ($config->getClosingFilters() as $entry) {
            if ($entry['filter']($date)) {
                $label = $entry['label'];

                break;
            }
        }

        return $label;
    }

    /**
     * 指定した日付が営業日かどうかを判定します。
     *
     * 優先順位に従って設定を評価し、最終的に営業日か否かを返します。
     * 優先順位は {@link DateBusiness} クラスの定義を参照してください。
     *
     * **判定の優先順位（下ほど強い）:**
     * 1. 曜日設定
     * 2. 祝日設定
     * 3. 第XX曜日 営業指定
     * 4. 第XX曜日 休業指定
     * 5. 特定日 営業指定
     * 6. 特定日 休業指定
     * 7. 営業指定フィルタ
     * 8. 休業指定フィルタ
     * 9. マクロ（最高優先度）
     *
     * @param DateTimeInterface $date 判定する日付
     * @param DateBusiness|null $instanceConfig インスタンス個別設定（なければ null）
     * @return bool 営業日であれば true、休業日であれば false
     */
    public static function isBusinessDay(DateTimeInterface $date, ?DateBusiness $instanceConfig = null): bool
    {
        $config = static::resolveConfig($instanceConfig);

        // 優先度9: マクロ（最高優先度）
        $macro = $config->getMacro();
        if ($macro !== null) {
            return (bool)$macro($date);
        }

        $result = true;

        // 優先度1: 曜日設定
        $weekday = (int)$date->format('w');
        if (isset($config->getClosingWeekdays()[$weekday])) {
            $result = false;
        }

        // 優先度2: 祝日設定
        if ($config->isBypassHoliday()) {
            $holiday = static::getHoliday($date);
            if ($holiday !== DateTime::NO_HOLIDAY) {
                $result = false;
            }
        }

        // 優先度3: 第XX曜日 営業指定
        $nth = static::getNthWeekday($date);
        $nthKey = $weekday . '_' . $nth;
        if (isset($config->getOpenNthWeekdays()[$nthKey])) {
            $result = true;
        }

        // 優先度4: 第XX曜日 休業指定
        if (array_key_exists($nthKey, $config->getClosingNthWeekdays())) {
            $result = false;
        }

        // 優先度5: 特定日 営業指定
        $dateKey = $date->format('Ymd');
        if (isset($config->getOpenDates()[$dateKey])) {
            $result = true;
        }

        // 優先度6: 特定日 休業指定
        if (array_key_exists($dateKey, $config->getClosingDates())) {
            $result = false;
        }

        // 優先度7: 営業指定フィルタ
        foreach ($config->getOpenFilters() as $filter) {
            if ($filter($date)) {
                $result = true;

                break;
            }
        }

        // 優先度8: 休業指定フィルタ
        foreach ($config->getClosingFilters() as $entry) {
            if ($entry['filter']($date)) {
                $result = false;

                break;
            }
        }

        return $result;
    }

    /**
     * 有効な設定を解決して返します。
     *
     * インスタンス個別設定 → グローバル設定 → デフォルト設定 の順で解決します。
     *
     * @param DateBusiness|null $instanceConfig インスタンスが保持する個別設定（保持しない場合 null）
     * @return DateBusiness 判定に使用する有効な設定オブジェクト
     */
    public static function resolveConfig(?DateBusiness $instanceConfig): DateBusiness
    {
        return $instanceConfig
            ?? static::$globalConfig
            ?? static::getDefaultConfig();
    }

    /**
     * デフォルト設定を取得します。
     *
     * 未設定の場合は「土日休み・祝日休み」の初期設定を生成して返します。
     *
     * @return DateBusiness デフォルト設定オブジェクト
     */
    public static function getDefaultConfig(): DateBusiness
    {
        if (static::$defaultConfig === null) {
            static::$defaultConfig = (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->setBypassHoliday(true);
        }

        return static::$defaultConfig;
    }

    /**
     * デフォルト設定を変更します。
     *
     * `null` を渡すと出荷時の設定（土日休み・祝日休み）にリセットされます。
     *
     * @param DateBusiness|null $config デフォルト設定オブジェクト、または null（リセット）
     * @return void
     */
    public static function setDefaultConfig(?DateBusiness $config): void
    {
        static::$defaultConfig = $config;
    }

    /**
     * DateTimeInterface から祝日定数を取得します。
     *
     * JapaneseDate\DateTime でない場合は NO_HOLIDAY を返します。
     *
     * @param DateTimeInterface $date
     * @return int
     */
    protected static function getHoliday(DateTimeInterface $date): int
    {
        if ($date instanceof DateTime) {
            return $date->holiday;
        }

        // DateTime 以外は DateTime に変換して判定
        try {
            return DateTime::factory($date->format('Y-m-d'), $date->getTimezone())->holiday;
        } catch (Throwable) {
            return DateTime::NO_HOLIDAY;
        }
    }

    /**
     * 指定した日付が当月の第何曜日かを返します（1始まり）。
     *
     * 例: 月の7日〜13日の間であれば第2週、よって 2 を返します。
     *
     * @param DateTimeInterface $date
     * @return int 第何曜日か（1〜5）
     */
    protected static function getNthWeekday(DateTimeInterface $date): int
    {
        return (int)ceil((int)$date->format('j') / 7);
    }
}
