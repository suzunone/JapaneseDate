<?php

/**
 * Factory.php
 *
 * {@see \JapaneseDate\DateTime} および {@see \JapaneseDate\DateTimeImmutable} の
 * インスタンス生成を担うファクトリメソッドを定義した Trait です。
 *
 * PHP の `DateTime::__construct()` は第一引数に文字列しか受け付けませんが、
 * このトレイトが提供する {@see factory()} メソッドは整数（Unix タイムスタンプ）・
 * 浮動小数点数・既存の DateTimeInterface オブジェクト・日時文字列のすべてを
 * 統一的に扱えるよう拡張しています。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2020-03-11
 */

namespace JapaneseDate\Traits;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\JisEra;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\Components\SeasonalFestival;
use JapaneseDate\Components\SeventyTwoKouCalculator;
use JapaneseDate\Components\SexagenaryCycle;
use JapaneseDate\Exceptions\NativeDateTimeException;

/**
 * JapaneseDate\DateTime / DateTimeImmutable のインスタンス生成を担うファクトリトレイト。
 *
 * Carbon の `parse()` や `new DateTime()` は第一引数に文字列しか受け付けませんが、
 * このトレイトが提供する {@see factory()} は以下の型すべてを安全に受け付け、
 * 適切な方法でインスタンスを生成します。
 *
 * - `int`: Unix タイムスタンプとして解釈
 * - `float`: マイクロ秒を保持した Unix タイムスタンプとして解釈
 * - `DateTimeInterface`: マイクロ秒を保持した書式文字列経由でコピーを生成
 * - 数字のみの文字列（11桁以下）: Unix タイムスタンプとして解釈
 * - 小数点付き数字文字列: `float` と同様に解釈
 * - 和暦・JIS 元号形式の文字列: {@see JisEra::parseJisDate()} でタイムスタンプへ変換
 * - その他の文字列（西暦・相対表現等）: Carbon のコンストラクタに委譲
 * - `null`: 現在時刻を使用
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2020-03-11
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Factory
{
    /**
     * JapaneseDate コンストラクタ。
     *
     * Carbon（親クラス）のコンストラクタに委譲した後、JapaneseDate 固有の
     * 各コンポーネント（JisEra・JapaneseDate・LunarCalendar 等）を初期化します。
     *
     * 第一引数には Carbon が受け付ける日時文字列または `null`（現在日時）を渡してください。
     * Unix タイムスタンプや `DateTimeInterface` を渡してインスタンスを生成したい場合は、
     * 代わりに {@see factory()} を使用してください。
     *
     * **使用例:**
     * ```php
     * $now     = new DateTime();                                   // 現在日時
     * $specific = new DateTime('2026-05-03');                      // 特定日付
     * $tz      = new DateTime('now', new \DateTimeZone('Asia/Tokyo'));
     * ```
     *
     * 文字列の書式については
     * {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式}
     * を参照してください。
     *
     * @param string|DateTimeInterface|null $date_time
     *   生成する日時。日時文字列・`DateTimeInterface` の実装・`null`（現在日時）を渡せます。
     *   Unix タイムスタンプ（int/float）を渡したい場合は {@see factory()} を使用してください。
     * @param DateTimeZone|null $time_zone
     *   タイムゾーン。省略時は PHP のデフォルトタイムゾーンを使用します。
     * @throws NativeDateTimeException 親コンストラクタが例外を投げた場合
     * @throws Exception 日時文字列の解析に失敗した場合
     */
    public function __construct($date_time = null, $time_zone = null)
    {
        try {
            /** @noinspection PhpMultipleClassDeclarationsInspection */
            parent::__construct($date_time, $time_zone);
        } catch (Exception $exception) {
            throw new NativeDateTimeException('Throwing native DateTime class construct exception.', $exception->getCode(), $exception);
        }

        $this->JisEra = JisEra::factory();
        $this->JapaneseDate = JapaneseDate::factory();
        $this->LunarCalendar = LunarCalendar::factory();
        $this->SexagenaryCycle = SexagenaryCycle::factory();
        $this->MiscSeasonalNode = MiscSeasonalNode::factory();
        $this->SeasonalFestival = SeasonalFestival::factory();
        $this->SeventyTwoKouCalculator = SeventyTwoKouCalculator::factory();
    }

    /**
     * 多様な型の引数から {@see \JapaneseDate\DateTime} / {@see \JapaneseDate\DateTimeImmutable}
     * インスタンスを生成するユニバーサルファクトリメソッドです。
     *
     * Carbon の `parse()` や `new DateTime()` は第一引数に文字列しか受け付けませんが、
     * このメソッドは以下のすべての型を安全に受け付けます。
     *
     * **引数の型別動作:**
     *
     * | 型                               | 動作                                                                                      |
     * |----------------------------------|-------------------------------------------------------------------------------------------|
     * | `int`                            | Unix タイムスタンプとして処理。`$time_zone` 指定時はその TZ に変換                       |
     * | `float`                          | マイクロ秒付き Unix タイムスタンプとして処理。`$time_zone` 指定時はその TZ に変換        |
     * | 小数点付き数字文字列             | `float` と同様に処理（例: `'1710936896.75'`）                                            |
     * | `DateTimeInterface`              | `Y-m-d H:i:s.u` 形式でコピーを生成（マイクロ秒保持）。`$time_zone` 省略時は元 TZ を引き継ぐ |
     * | 数字のみの文字列（11桁以下）     | Unix タイムスタンプとして解釈しインスタンス化                                             |
     * | 和暦・JIS 元号形式の文字列       | {@see JisEra::parseJisDate()} で Unix タイムスタンプへ変換。`$time_zone` 省略時は Asia/Tokyo |
     * | その他の文字列（西暦・相対表現等）| Carbon のコンストラクタに委譲（`'2026-05-01'` / `'next monday'` 等）                    |
     * | `null`                           | 現在日時を使用                                                                            |
     *
     * **使用例:**
     *
     * ```php
     * // Unix タイムスタンプ（int）から生成する
     * $dt = DateTime::factory(1609459200);
     *
     * // Unix タイムスタンプ（float、マイクロ秒付き）から生成する
     * $dt = DateTime::factory(1710936896.750123);
     *
     * // 既存の DateTimeInterface オブジェクトから生成する
     * $dt = DateTime::factory(new \DateTime('2026-05-01'));
     *
     * // 西暦標準形式（ハイフン・スラッシュ区切り、時刻省略可）
     * $dt = DateTime::factory('2026-05-01 12:34:56');
     * $dt = DateTime::factory('2026/05/01 12:34');   // 秒省略
     * $dt = DateTime::factory('2026-05-01');          // 時刻省略
     *
     * // 西暦日本語表記（時刻省略可）
     * $dt = DateTime::factory('2026年5月1日');
     * $dt = DateTime::factory('2026年5月1日 12時34分');
     * $dt = DateTime::factory('2026年5月1日 12時34分56秒');
     *
     * // 元号漢字表記（明治・大正・昭和・平成・令和、時刻省略可）
     * $dt = DateTime::factory('令和7年5月1日');
     * $dt = DateTime::factory('昭和64年1月7日 12時34分56秒');
     *
     * // JIS 元号アルファベット表記（M/T/S/H/R、ハイフン・スラッシュ区切り）
     * $dt = DateTime::factory('R7-05-01');   // 令和
     * $dt = DateTime::factory('H1/01/08');   // 平成
     * $dt = DateTime::factory('S64-01-07');  // 昭和
     *
     * // マイクロ秒付き（すべての文字列形式で末尾に `.NNNNNN` を付加可能）
     * $dt = DateTime::factory('2026-05-01 12:34:56.123456');
     * $dt = DateTime::factory('令和7年5月1日 12時34分56秒.500000');
     *
     * // タイムゾーンを指定して生成する
     * $dt = DateTime::factory('2026-05-01 12:34:56', new \DateTimeZone('Asia/Tokyo'));
     * ```
     *
     * @param int|float|string|DateTimeInterface|null $date_time
     *   生成元となる日時値。Unix タイムスタンプ（int/float）、
     *   {@see DateTimeInterface} の実装オブジェクト、
     *   日時文字列（西暦・和暦・相対表現に対応）、または null（現在日時）を渡せます。
     * @param DateTimeZone|null $time_zone
     *   使用するタイムゾーン。省略した場合の挙動は引数の型によって異なります（型別動作の表を参照）。
     * @return static 指定した日時を表す新しいインスタンス
     * @throws \DateInvalidTimeZoneException タイムゾーンの解析に失敗した場合
     * @throws NativeDateTimeException 日時文字列の解析に失敗した場合
     */
    public static function factory(int|float|string|DateTimeInterface|null $date_time = null, DateTimeZone|null $time_zone = null): static
    {
        if ($date_time === null) {
            return new static(null, $time_zone);
        }

        if (is_int($date_time)) {
            return static::newFromTimestamp((float) $date_time, $time_zone);
        }

        if (is_float($date_time)) {
            return static::newFromTimestamp($date_time, $time_zone);
        }

        if (is_string($date_time) && preg_match('/^[+-]?\d+\.\d+$/', $date_time) === 1) {
            return static::newFromTimestamp((float) $date_time, $time_zone);
        }

        if ($date_time instanceof DateTimeInterface) {
            return new static($date_time->format('Y-m-d H:i:s.u'), $time_zone ?? $date_time->getTimezone());
        }

        if (is_string($date_time) && ctype_digit($date_time) && strlen($date_time) <= 11) {
            return static::newFromTimestamp((float) $date_time, $time_zone);
        }

        $is_japanese_date = is_string($date_time) && preg_match('/[年月日時分秒]|^[MTSHR]\d/u', $date_time) === 1;
        $is_era_date = $is_japanese_date && preg_match('/^(?:明治|大正|昭和|平成|令和|[MTSHR]\d)/u', $date_time) === 1;
        $check_time = $is_japanese_date ? static::parseJisDate($date_time, $time_zone) : null;

        if (is_numeric($check_time)) {
            $DisplayDateTimeZone = $time_zone ?? ($is_era_date ? new DateTimeZone('Asia/Tokyo') : null);

            return static::newFromTimestamp((float) $check_time, $DisplayDateTimeZone);
        }

        return new static($date_time, $time_zone);
    }

    /**
     * Unix タイムスタンプからコンストラクタ経由でインスタンスを生成する内部ヘルパー。
     *
     * Carbon の `createFromTimestamp()` はコンストラクタをバイパスするため、
     * JapaneseDate 固有のコンポーネントプロパティが初期化されません。
     * このメソッドはタイムスタンプを `Y-m-d H:i:s.uuuuuu` 形式の文字列に変換してから
     * `new static()` を呼び出すことでコンポーネントの初期化を保証します。
     *
     * @param  float            $timestamp Unix タイムスタンプ（マイクロ秒を含む場合は小数部で表現）
     * @param  DateTimeZone|null $tz       使用するタイムゾーン。省略時は PHP のデフォルトタイムゾーンを使用
     * @return static                      指定したタイムスタンプを表す新しいインスタンス
     * @throws NativeDateTimeException 日時文字列の生成に失敗した場合
     * @throws Exception
     * @throws \DateInvalidTimeZoneException
     */
    protected static function newFromTimestamp(float $timestamp, ?DateTimeZone $tz): static
    {
        $displayTz = $tz ?? new DateTimeZone(date_default_timezone_get());
        $seconds = (int) floor($timestamp);
        $micro = (int) round(($timestamp - $seconds) * 1_000_000);
        if ($micro >= 1_000_000) {
            $seconds++;
            $micro = 0;
        }

        $native = (new DateTimeImmutable('@' . $seconds))->setTimezone($displayTz);

        return new static($native->format('Y-m-d H:i:s') . sprintf('.%06d', $micro), $displayTz);
    }

    /**
     * 和暦・JIS 元号形式の日時文字列を Unix タイムスタンプへ変換します。
     *
     * {@see JisEra::parseJisDate()} に処理を委譲します。
     * 解析に対応する書式は「漢字元号（令和・平成・昭和・大正・明治）」と
     * 「JIS アルファベット元号（R/H/S/T/M）」の両形式です。
     *
     * @param  string           $date_str  パースする日付文字列
     * @param  DateTimeZone|null $timezone 使用するタイムゾーン。元号形式で省略した場合は Asia/Tokyo を使用
     * @return int|float|null              Unix タイムスタンプ（マイクロ秒がある場合は float）、解析失敗時は null
     * @throws \DateInvalidTimeZoneException タイムゾーンの解析に失敗した場合
     */
    protected static function parseJisDate(string $date_str, ?DateTimeZone $timezone = null): int|float|null
    {
        return (new JisEra())->parseJisDate($date_str, $timezone);
    }

    /**
     * フォーマット指定文字列から日時インスタンスを生成します。
     *
     * Carbon の `createFromFormat()` はコンストラクタを経由しないため、
     * JapaneseDate 固有のコンポーネントが未初期化のまま返されることがあります。
     * このオーバーライドにより、返却されたインスタンスのコンポーネントを確実に初期化します。
     *
     * @param  string                       $format   日時フォーマット文字列
     * @param  string                       $time     パース対象の日時文字列
     * @param  DateTimeZone|string|int|null $timezone タイムゾーン（省略可）
     * @return static|null                            生成されたインスタンス。解析失敗時は null
     */
    public static function createFromFormat($format, $time, $timezone = null): ?static
    {
        /** @noinspection PhpMultipleClassDeclarationsInspection */
        $instance = parent::createFromFormat($format, $time, $timezone);

        if ($instance !== null && !isset($instance->SeasonalFestival)) {
            $instance->JisEra = JisEra::factory();
            $instance->JapaneseDate = JapaneseDate::factory();
            $instance->LunarCalendar = LunarCalendar::factory();
            $instance->SexagenaryCycle = SexagenaryCycle::factory();
            $instance->MiscSeasonalNode = MiscSeasonalNode::factory();
            $instance->SeasonalFestival = SeasonalFestival::factory();
            $instance->SeventyTwoKouCalculator = SeventyTwoKouCalculator::factory();
        }

        return $instance;
    }
}
