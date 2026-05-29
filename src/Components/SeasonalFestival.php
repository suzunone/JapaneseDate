<?php

/**
 * SeasonalFestival.php
 *
 * 五節句（ごせっく）の判定を行うコンポーネント。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace JapaneseDate\Components;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;

/**
 * 五節句（人日・上巳・端午・七夕・重陽）の判定を行うコンポーネントクラス。
 *
 * 五節句には**西暦（新暦）**と**旧暦（旧暦の月日）**の2種類の判定方法があります。
 * 現代日本では西暦固定日で祝う場合がほとんどですが、
 * 伝統的には旧暦の対応する日に行われていました。
 *
 * **五節句と西暦固定日:**
 * | 定数                     | 西暦日付 | 式名         | 別名（通称）   |
 * |--------------------------|----------|--------------|----------------|
 * | SEASONAL_FESTIVAL_JINJITSU  | 1月7日   | 人日の節句   | 七草の節句     |
 * | SEASONAL_FESTIVAL_JOSHI     | 3月3日   | 上巳の節句   | 桃の節句       |
 * | SEASONAL_FESTIVAL_TANGO     | 5月5日   | 端午の節句   | 菖蒲の節句     |
 * | SEASONAL_FESTIVAL_TANABATA  | 7月7日   | 七夕の節句   | 笹の節句       |
 * | SEASONAL_FESTIVAL_CHOYO     | 9月9日   | 重陽の節句   | 菊の節句       |
 *
 * **旧暦判定:**
 * 旧暦判定は `$date->lunarMonth` と `$date->lunarDay` プロパティを使用し、
 * 旧暦1月7日・3月3日・5月5日・7月7日・9月9日に該当するかを判定します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */
class SeasonalFestival
{
    /**
     * 五節句の式名（正式名称）の配列。
     *
     * キーは {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_*} 定数に対応します。
     * 節句でない場合（key=0）は空文字列を返します。
     *
     * @var array<int, string>
     */
    public const FESTIVAL_NAMES = [
        0 => '',
        1 => '人日の節句',
        2 => '上巳の節句',
        3 => '端午の節句',
        4 => '七夕の節句',
        5 => '重陽の節句',
    ];

    /**
     * 五節句の別名（通称）の配列。
     *
     * キーは {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_*} 定数に対応します。
     * 節句でない場合（key=0）は空文字列を返します。
     *
     * @var array<int, string>
     */
    public const FESTIVAL_ALIASES = [
        0 => '',
        1 => '七草の節句',
        2 => '桃の節句',
        3 => '菖蒲の節句',
        4 => '笹の節句',
        5 => '菊の節句',
    ];

    /**
     * 五節句の西暦固定日（月 => 日）のマッピング。
     *
     * @var array<int, array{month: int, day: int, key: int}>
     */
    private const SOLAR_FESTIVALS = [
        ['month' => 1, 'day' => 7, 'key' => DateTime::SEASONAL_FESTIVAL_JINJITSU],
        ['month' => 3, 'day' => 3, 'key' => DateTime::SEASONAL_FESTIVAL_JOSHI],
        ['month' => 5, 'day' => 5, 'key' => DateTime::SEASONAL_FESTIVAL_TANGO],
        ['month' => 7, 'day' => 7, 'key' => DateTime::SEASONAL_FESTIVAL_TANABATA],
        ['month' => 9, 'day' => 9, 'key' => DateTime::SEASONAL_FESTIVAL_CHOYO],
    ];

    /**
     * 五節句の旧暦月日のマッピング。
     *
     * @var array<int, array{month: int, day: int, key: int}>
     */
    private const LUNAR_FESTIVALS = [
        ['month' => 1, 'day' => 7, 'key' => DateTime::SEASONAL_FESTIVAL_JINJITSU],
        ['month' => 3, 'day' => 3, 'key' => DateTime::SEASONAL_FESTIVAL_JOSHI],
        ['month' => 5, 'day' => 5, 'key' => DateTime::SEASONAL_FESTIVAL_TANGO],
        ['month' => 7, 'day' => 7, 'key' => DateTime::SEASONAL_FESTIVAL_TANABATA],
        ['month' => 9, 'day' => 9, 'key' => DateTime::SEASONAL_FESTIVAL_CHOYO],
    ];

    /**
     * ファクトリー（シングルトン）。
     *
     * @return static
     */
    public static function factory()
    {
        static $instance;
        if (!$instance) {
            // @codeCoverageIgnoreStart
            $instance = new static();
            // @codeCoverageIgnoreEnd
        }

        return $instance;
    }

    // =========================================================================
    // 西暦（新暦）判定メソッド
    // =========================================================================

    /**
     * 西暦の月日から五節句の定数キーを返します。
     *
     * グレゴリオ暦（新暦）の月日を基準に判定します。
     * 現代日本における五節句の一般的な観し方です。
     *
     * 対応する月日:
     * - 1月7日 → 人日の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_JINJITSU}）
     * - 3月3日 → 上巳の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_JOSHI}）
     * - 5月5日 → 端午の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_TANGO}）
     * - 7月7日 → 七夕の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_TANABATA}）
     * - 9月9日 → 重陽の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}）
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return int 五節句定数。節句でない場合は {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（= 0）
     */
    public function getSolarFestivalKey($date): int
    {
        foreach (self::SOLAR_FESTIVALS as $festival) {
            if ($date->month === $festival['month'] && $date->day === $festival['day']) {
                return $festival['key'];
            }
        }

        return DateTime::SEASONAL_FESTIVAL_NONE;
    }

    /**
     * 西暦の月日から五節句の式名（正式名称）を返します。
     *
     * 内部で {@see getSolarFestivalKey()} を呼び出して定数キーを取得し、
     * 対応する式名（「人日の節句」「上巳の節句」など）を返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return string 五節句の式名、または節句でない場合は空文字列
     */
    public function viewSolarFestivalName($date): string
    {
        return self::FESTIVAL_NAMES[$this->getSolarFestivalKey($date)] ?? '';
    }

    /**
     * 西暦の月日から五節句の別名（通称）を返します。
     *
     * 内部で {@see getSolarFestivalKey()} を呼び出して定数キーを取得し、
     * 対応する別名（「七草の節句」「桃の節句」など）を返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return string 五節句の別名（通称）、または節句でない場合は空文字列
     */
    public function viewSolarFestivalAlias($date): string
    {
        return self::FESTIVAL_ALIASES[$this->getSolarFestivalKey($date)] ?? '';
    }

    // =========================================================================
    // 旧暦判定メソッド
    // =========================================================================

    /**
     * 旧暦の月日から五節句の定数キーを返します。
     *
     * 旧暦（太陰太陽暦）の月日を基準に判定します。
     * 伝統的な五節句の観し方で、毎年異なるグレゴリオ暦の日付に相当します。
     *
     * `$date->lunarMonth` および `$date->lunarDay` プロパティを使用して旧暦の月日を取得します。
     *
     * 対応する旧暦月日:
     * - 旧暦1月7日 → 人日の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_JINJITSU}）
     * - 旧暦3月3日 → 上巳の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_JOSHI}）
     * - 旧暦5月5日 → 端午の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_TANGO}）
     * - 旧暦7月7日 → 七夕の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_TANABATA}）
     * - 旧暦9月9日 → 重陽の節句（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}）
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return int 五節句定数。節句でない場合は {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（= 0）
     */
    public function getLunarFestivalKey($date): int
    {
        $lunarMonth = $date->lunarMonth;
        $lunarDay = $date->lunarDay;

        foreach (self::LUNAR_FESTIVALS as $festival) {
            if ($lunarMonth === $festival['month'] && $lunarDay === $festival['day']) {
                return $festival['key'];
            }
        }

        return DateTime::SEASONAL_FESTIVAL_NONE;
    }

    /**
     * 旧暦の月日から五節句の式名（正式名称）を返します。
     *
     * 内部で {@see getLunarFestivalKey()} を呼び出して定数キーを取得し、
     * 対応する式名（「人日の節句」「上巳の節句」など）を返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return string 五節句の式名、または節句でない場合は空文字列
     */
    public function viewLunarFestivalName($date): string
    {
        return self::FESTIVAL_NAMES[$this->getLunarFestivalKey($date)] ?? '';
    }

    /**
     * 旧暦の月日から五節句の別名（通称）を返します。
     *
     * 内部で {@see getLunarFestivalKey()} を呼び出して定数キーを取得し、
     * 対応する別名（「七草の節句」「桃の節句」など）を返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return string 五節句の別名（通称）、または節句でない場合は空文字列
     */
    public function viewLunarFestivalAlias($date): string
    {
        return self::FESTIVAL_ALIASES[$this->getLunarFestivalKey($date)] ?? '';
    }

    // =========================================================================
    // キーから名称を取得するユーティリティメソッド
    // =========================================================================

    /**
     * 五節句定数キーから式名（正式名称）を返します。
     *
     * @param int $key 五節句定数（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_*}）
     * @return string 式名（例: 「人日の節句」「端午の節句」）、または節句でない場合は空文字列
     */
    public function viewName($key): string
    {
        return self::FESTIVAL_NAMES[$key] ?? '';
    }

    /**
     * 五節句定数キーから別名（通称）を返します。
     *
     * @param int $key 五節句定数（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_*}）
     * @return string 別名（例: 「七草の節句」「桃の節句」）、または節句でない場合は空文字列
     */
    public function viewAlias($key): string
    {
        return self::FESTIVAL_ALIASES[$key] ?? '';
    }
}
