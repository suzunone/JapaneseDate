<?php

/**
 * Map.php
 *
 * 各種マッピングデータの共通処理・汎用検索ロジックを提供する抽象基底クラスです。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Maps
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Maps;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;

/**
 * マッピングデータの共通処理と汎用範囲検索ロジックを提供する基底クラス。
 *
 * サブクラスは `$map` プロパティに多次元配列形式のマッピングデータを定義し、
 * このクラスが提供する静的メソッド経由でデータ検索を行います。
 * 大量データの初期化コストを抑えるため、Lazy Loading パターンを採用しています。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Maps
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */
abstract class Map
{
    /**
     * マッピングデータの静的キャッシュ。
     *
     * クラスごとにキャッシュするため、キーにクラス名を使用します。
     * 初回アクセス時に子クラスの `$map` から読み込み、以後は再利用します。
     *
     * @var array<class-string, array<int, array<string, string>>>
     */
    protected static $cache = [];

    /**
     * サブクラスで定義するマッピングデータ配列。
     *
     * 各要素は `start`・`end`・その他のキーを持つ連想配列です。
     * `start` および `end` は ISO 8601 形式の日付文字列（例: `'645-07-29T00:00:00+09:00'`）。
     *
     * @var array<int, array<string, string>>
     */
    protected $map = [];

    /**
     * 指定された日付が `start`〜`end` の範囲に収まるマッピング要素をすべて返す。
     *
     * - `start` <= $date < `end` の半開区間で判定します。
     * - 南北朝時代のように複数の元号が並存する場合は、複数要素を含む配列を返します。
     * - 該当するデータが存在しない場合は空配列を返します。
     *
     * @param DateTime|DateTimeImmutable $date 検索基準日
     * @return array<int, array<string, string>> 条件に合致したマッピング要素の配列
     * @throws \Exception
     * @throws \Exception
     * @throws \Exception
     */
    public static function findByDate($date): array
    {
        $timestamp = $date->getTimestamp();
        $results = [];

        foreach (static::loadMap() as $entry) {
            $start = (new \DateTimeImmutable($entry['start']))->getTimestamp();
            $end = (new \DateTimeImmutable($entry['end']))->getTimestamp();

            if ($timestamp >= $start && $timestamp < $end) {
                $results[] = $entry;
            }
        }

        return $results;
    }

    /**
     * サブクラスのマッピングデータを遅延ロードし、静的キャッシュに格納して返す。
     *
     * 初回呼び出し時にのみインスタンスを生成してデータを読み込みます。
     * 以降は `static::$cache` から取得するため、大量データでも効率的に動作します。
     *
     * @return array<int, array<string, string>> マッピングデータの配列
     */
    protected static function loadMap(): array
    {
        $class = static::class;
        if (!isset(static::$cache[$class])) {
            $instance = new static();
            static::$cache[$class] = $instance->map;
        }

        return static::$cache[$class];
    }

    /**
     * テスト用途で静的キャッシュをリセットする。
     *
     * @return void
     */
    public static function clearCache(): void
    {
        static::$cache = [];
    }
}
