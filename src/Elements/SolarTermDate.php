<?php

/**
 * SolarTermDate.php
 *
 * 二十四節気の1節気分の日付・黄経・種別情報を保持する値オブジェクトです。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Elements
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2023-05-04
 */

namespace JapaneseDate\Elements;

use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\DateTime;
use RuntimeException;

/**
 * 二十四節気の日付情報を表す値オブジェクト。
 *
 * 節気番号（0〜23）・年・日・太陽黄経・節気種別（節気／中気）を保持します。
 * プロパティはマジックゲッター経由で読み取り専用として公開されており、
 * 直接の書き込みは禁止されています。
 *
 * 節気番号と種別の対応:
 * - **偶数**（0, 2, 4, …）: 中気（ちゅうき）— 例: 春分・夏至・秋分・冬至
 * - **奇数**（1, 3, 5, …）: 節気（せっき）— 例: 清明・芒種・白露・大雪
 *
 * **プロパティ一覧**
 * | プロパティ          | 型            | 説明                                                        |
 * |--------------------|---------------|-------------------------------------------------------------|
 * | `$year`            | int           | 西暦年                                                      |
 * | `$solar_term`      | int           | 節気番号（0〜23）                                           |
 * | `$month`           | int           | その節気が属する月（1〜12）                                 |
 * | `$day`             | int           | 節気が始まる日                                              |
 * | `$solar_longitude` | float         | 太陽黄経（度）。節気番号 × 15 度                           |
 * | `$is_sekki`        | bool          | 節気（奇数番号）であれば true                               |
 * | `$is_chuki`        | bool          | 中気（偶数番号）であれば true                               |
 * | `$solarTermText`   | string        | 節気の漢字名称（例: "春分"）                                |
 * | `$dateTime`        | DateTime      | 節気日を表す {@see DateTime} インスタンス                   |
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Elements
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2023-05-04
 * @property-read int $year 西暦年。
 * @property-read int $solar_term 節気番号（0〜23）。
 * @property-read int $month その節気が属する月（1〜12）。
 * @property-read int $day 節気が始まる日。
 * @property-read float $solar_longitude 太陽黄経（度）。節気番号 × 15 度。
 * @property-read bool $is_sekki 節気（奇数番号）であれば true。
 * @property-read bool $is_chuki 中気（偶数番号）であれば true。
 * @property-read string $solarTermText 節気の漢字名称（例: "春分"）。
 * @property-read DateTime $dateTime 節気日を表す DateTime インスタンス。
 */
class SolarTermDate
{
    /**
     * 節気番号（0〜23）に対応する月を定義した配列。
     *
     * インデックスが節気番号に対応し、値がその節気の属する月（1〜12）を示します。
     * 節気番号 0 は小寒（1月）、番号 2 は雨水（2月）... のように循環しています。
     *
     * @var array<int, int>
     */
    protected const SOLAR_TERM_MONTH = [
        3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 1, 1, 2, 2, 3,
    ];

    /**
     * 節気の属性を保持する内部配列。
     *
     * @var array{is_sekki: bool, is_chuki: bool, year: int, solar_term: int, month: int, day: int, solar_longitude: float}
     */
    protected $attribute = [
        'is_sekki'        => false,
        'is_chuki'        => false,
        'year'            => 0,
        'solar_term'      => -1,
        'month'           => 0,
        'day'             => 0,
        'solar_longitude' => 0.0,
    ];

    /**
     * SolarTermDate を生成します。
     *
     * 節気番号が偶数の場合は中気フラグ（`is_chuki`）を、奇数の場合は節気フラグ（`is_sekki`）を true にします。
     * 太陽黄経は `$solar_term × 15` 度として算出します。
     *
     * @param int $year       西暦年
     * @param int $solar_term 節気番号（0〜23）。偶数=中気、奇数=節気
     * @param int $day        節気が始まる日
     */
    public function __construct(int $year, int $solar_term, int $day)
    {
        $this->attribute['year']       = $year;
        $this->attribute['solar_term'] = $solar_term;
        $this->attribute['day']        = $day;

        if ($solar_term % 2 === 0) {
            $this->attribute['is_chuki'] = true;
        } else {
            $this->attribute['is_sekki'] = true;
        }

        $this->attribute['month']           = self::SOLAR_TERM_MONTH[$solar_term];
        $this->attribute['solar_longitude'] = 15 * $solar_term;
    }

    /**
     * プロパティ値を返します。
     *
     * `$attribute` に存在するキーはその値を直接返します。
     * 以下の拡張キーにも対応しています。
     *
     * | キー             | 型       | 説明                              |
     * |-----------------|----------|-----------------------------------|
     * | `solarTermText` | string   | 節気の漢字名称（例: "春分"）      |
     * | `dateTime`      | DateTime | 節気日を表す DateTime インスタンス |
     *
     * 存在しないキーは `null` を返します。
     *
     * @param  string                        $key プロパティ名
     * @return string|DateTime|null|int|bool|float プロパティ値。未定義キーは null
     */
    public function __get(string $key)
    {
        switch ($key) {
            case 'solarTermText':
                return $this->attribute[$key] ?? JapaneseDate::SOLAR_TERM[$this->solar_term];
            case 'dateTime':
                return $this->attribute[$key] ?? DateTime::create($this->year, $this->month, $this->day);
            default:
                return $this->attribute[$key] ?? null;
        }
    }

    /**
     * プロパティへの書き込みを禁止します。
     *
     * このクラスは値オブジェクトであり、生成後の変更は許可されていません。
     * 呼び出されると必ず {@see RuntimeException} を投げます。
     *
     * @param  string $key   プロパティ名
     * @param  mixed  $value 設定しようとした値
     * @return void
     * @throws RuntimeException 常に投げる
     */
    public function __set(string $key, $value): void
    {
        throw new RuntimeException('Can not set key:' . $key . ' =  ' . $value);
    }

    /**
     * 指定したプロパティ名が有効かどうかを返します。
     *
     * `isset($solarTermDate->solarTermText)` のような呼び出しに応答します。
     * `$attribute` に存在するキー、および拡張キー `solarTermText` / `dateTime` を有効とみなします。
     *
     * @param  string $key プロパティ名
     * @return bool        有効なプロパティであれば true
     */
    public function __isset(string $key): bool
    {
        switch ($key) {
            case 'solarTermText':
            case 'dateTime':
                return true;
            default:
                return isset($this->attribute[$key]);
        }
    }
}
