<?php

/**
 * LunarDate.php
 *
 * 旧暦（太陰太陽暦）の年・月・日・閏月フラグ・節気情報を保持する値オブジェクトです。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Elements
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2018-05-10
 */

namespace JapaneseDate\Elements;

use JapaneseDate\Exceptions\ErrorException;

/**
 * 旧暦日付を表す値オブジェクト。
 *
 * 旧暦の年・月・日・閏月フラグおよびその日の節気番号を保持します。
 * プロパティはマジックゲッター経由で読み取り専用として公開されており、
 * 直接の書き込みは禁止されています。
 *
 * **プロパティ一覧**
 * | プロパティ        | 型          | 説明                                      |
 * |------------------|-------------|-------------------------------------------|
 * | `$year`          | int         | 旧暦年                                    |
 * | `$month`         | int         | 旧暦月（1〜12）                           |
 * | `$day`           | int         | 旧暦日（1〜30）                           |
 * | `$is_leap_month` | bool        | 閏月であれば true                         |
 * | `$solar_term`    | int\|bool   | 節気番号（0〜23）、節気でなければ false   |
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Elements
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0
 * @property-read int $year 旧暦年。
 * @property-read int $month 旧暦月（1〜12）。
 * @property-read int $day 旧暦日（1〜30）。
 * @property-read bool $is_leap_month 閏月であれば true。
 * @property-read int|bool $solar_term 節気番号（0〜23）。節気でなければ false。
 */
class LunarDate
{
    /**
     * 内部配列における旧暦年のインデックス。
     */
    public const YEAR_KEY = 0;

    /**
     * 内部配列における閏月フラグのインデックス。
     *
     * 値が真（1）のとき閏月を示します。
     */
    public const IS_LEAP_MONTH_FLAG_KEY = 1;

    /**
     * 内部配列における旧暦月のインデックス。
     */
    public const MONTH_KEY = 2;

    /**
     * 内部配列における旧暦日のインデックス。
     */
    public const DAY_KEY = 3;

    /**
     * 内部配列における節気番号のインデックス。
     *
     * 節気でない日は false が格納されます。
     */
    public const SOLAR_TERM_KEY = 4;

    /**
     * 旧暦データを保持する内部配列。
     *
     * インデックスは各 `*_KEY` 定数に対応します。
     *
     * @var array{0: int, 1: int|bool, 2: int, 3: int, 4: int|bool}
     */
    protected array $lunar;

    /**
     * LunarDate を生成します。
     *
     * `$lunar` 配列は旧暦計算コンポーネントが返す形式（インデックス 0〜3）である必要があります。
     * 少なくとも {@see self::DAY_KEY}（インデックス 3）が存在しない場合は例外を投げます。
     *
     * @param array          $lunar       旧暦データ配列（インデックス: YEAR_KEY=0, IS_LEAP_MONTH_FLAG_KEY=1, MONTH_KEY=2, DAY_KEY=3）
     * @param int|bool       $solar_term  節気番号（0〜23）、節気でなければ false
     * @throws ErrorException DAY_KEY が配列に存在しない場合
     * @throws \JsonException json_encode に失敗した場合
     */
    public function __construct(array $lunar, int|bool $solar_term)
    {
        if (!isset($lunar[self::DAY_KEY])) {
            throw new ErrorException('undefined day key' . json_encode($lunar, JSON_THROW_ON_ERROR) . json_encode($solar_term, JSON_THROW_ON_ERROR));
        }

        $lunar[self::SOLAR_TERM_KEY] = $solar_term;
        $this->lunar = $lunar;
    }

    /**
     * 指定したプロパティ名が有効かどうかを返します。
     *
     * `isset($lunarDate->year)` のような呼び出しに応答します。
     * 有効なプロパティは `year` / `month` / `day` / `is_leap_month` / `solar_term` です。
     *
     * @param  string $name プロパティ名
     * @return bool         有効なプロパティであれば true
     * @noinspection PhpMissingParamTypeInspection
     */
    public function __isset($name): bool
    {
        return match ($name) {
            'year', 'month', 'day', 'is_leap_month', 'solar_term' => true,
            default => false,
        };
    }

    /**
     * プロパティ値を返します。
     *
     * 読み取り可能なプロパティは以下のとおりです。
     *
     * | プロパティ        | 型        | 説明                                    |
     * |------------------|-----------|-----------------------------------------|
     * | `year`           | int       | 旧暦年                                  |
     * | `month`          | int       | 旧暦月（1〜12）                         |
     * | `day`            | int       | 旧暦日（1〜30）                         |
     * | `is_leap_month`  | bool      | 閏月であれば true                       |
     * | `solar_term`     | int\|bool | 節気番号（0〜23）、節気でなければ false |
     *
     * 上記以外のプロパティ名を指定した場合は {@see ErrorException} を投げます。
     *
     * @param  string          $name プロパティ名
     * @return bool|string|int       プロパティ値
     * @throws ErrorException        未定義のプロパティ名が指定された場合
     * @noinspection PhpMissingParamTypeInspection
     */
    public function __get($name): bool|string|int
    {
        return match ($name) {
            'year'          => (int)  $this->lunar[self::YEAR_KEY],
            'month'         => (int)  $this->lunar[self::MONTH_KEY],
            'day'           => (int)  $this->lunar[self::DAY_KEY],
            'is_leap_month' => (bool) $this->lunar[self::IS_LEAP_MONTH_FLAG_KEY],
            'solar_term'    =>        $this->lunar[self::SOLAR_TERM_KEY],
            default         => throw new ErrorException('undefined property:' . $name),
        };
    }

    /**
     * プロパティへの書き込みを禁止します。
     *
     * このクラスは値オブジェクトであり、生成後の変更は許可されていません。
     * 呼び出されると必ず {@see ErrorException} を投げます。
     *
     * @param  string $name  プロパティ名
     * @param  mixed  $value 設定しようとした値
     * @return void
     * @throws ErrorException 常に投げる
     * @noinspection PhpMissingParamTypeInspection
     */
    public function __set($name, $value): void
    {
        throw new ErrorException('cannot set property:' . $name);
    }
}
