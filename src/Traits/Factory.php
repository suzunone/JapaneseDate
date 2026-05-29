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

use DateTimeInterface;
use DateTimeZone;

/**
 * JapaneseDate\DateTime / DateTimeImmutable のインスタンス生成を担うファクトリトレイト。
 *
 * Carbon の `parse()` メソッドは文字列しか受け付けないため、
 * Unix タイムスタンプ・`DateTimeInterface` オブジェクトを渡した場合に
 * 正しく動作しないことがあります。このトレイトが提供する {@see factory()} は
 * 以下の型すべてを安全に受け付け、適切な方法でインスタンスを生成します。
 *
 * - `int` / `float`: Unix タイムスタンプとして解釈
 * - `DateTimeInterface`: 書式文字列経由でコピーを生成
 * - `string`（数字のみ）: `strtotime()` でパースを試みてタイムスタンプとして解釈
 * - `string`（その他）: Carbon のコンストラクタに委譲
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
     * 多様な型の引数から {@see \JapaneseDate\DateTime} / {@see \JapaneseDate\DateTimeImmutable}
     * インスタンスを生成するユニバーサルファクトリメソッドです。
     *
     * Carbon の `parse()` や `new DateTime()` は第一引数に文字列しか受け付けませんが、
     * このメソッドは以下のすべての型を安全に受け付けます。
     *
     * **引数の型別動作:**
     *
     * | 型 | 動作 |
     * |---|---|
     * | `int` / `float` | Unix タイムスタンプとして解釈し `@timestamp` 形式でインスタンス化 |
     * | `DateTimeInterface` | `Y-m-d H:i:s` 形式に変換してからインスタンス化 |
     * | 数字のみの `string` | `strtotime()` でパースを試み、成功すればタイムスタンプとして処理 |
     * | その他の `string` | Carbon のコンストラクタに直接委譲（相対表現・絶対表現に対応） |
     * | `null` | 現在日時を使用（`new static()` と同等） |
     *
     * **使用例:**
     *
     * ```php
     * // Unix タイムスタンプから生成する
     * $dt = DateTime::factory(1609459200);
     *
     * // 既存の DateTimeInterface オブジェクトから生成する
     * $dt = DateTime::factory(new \DateTime('2026-05-01'));
     *
     * // 日時文字列から生成する（Carbon::parse() と同等）
     * $dt = DateTime::factory('2026-05-01 12:34:56');
     *
     * // タイムゾーンを指定して生成する
     * $dt = DateTime::factory('now', new \DateTimeZone('Asia/Tokyo'));
     * ```
     *
     * 日付/時刻 文字列の書式については
     * {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式}
     * を参照してください。
     *
     * @param int|float|string|\DateTimeInterface|null $date_time
     *   生成元となる日時値。Unix タイムスタンプ（int/float）、
     *   {@see \DateTimeInterface} の実装オブジェクト、
     *   日時文字列（相対・絶対の両方に対応）、または null（現在日時）を渡せます。
     * @param \DateTimeZone|null $time_zone
     *   使用するタイムゾーン。省略した場合は $date_time が保持するタイムゾーンか、
     *   PHP のデフォルトタイムゾーンが使用されます。
     * @return static 指定した日時を表す新しいインスタンス
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     *   日時文字列の解析に失敗した場合にスローされます。
     */
    public static function factory($date_time = null, $time_zone = null)
    {
        if (is_int($date_time) || is_float($date_time)) {
            $obj = new static('@' . (int) $date_time);
            return $time_zone !== null ? $obj->setTimezone($time_zone) : $obj;
        }


        if ($date_time instanceof DateTimeInterface) {
            return new static($date_time->format('Y-m-d H:i:s'), $time_zone ?? $date_time->getTimezone());
        }

        if (is_string($date_time) && ctype_digit($date_time)) {
            $check_time = strtotime($date_time);
            if (is_int($check_time)) {
                $date_time = $check_time;
            }

            return new static(date('Y-m-d H:i:s', $date_time), $time_zone);
        }


        return new static($date_time, $time_zone);
    }
}
