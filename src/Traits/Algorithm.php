<?php

namespace JapaneseDate\Traits;

use JapaneseDate\Components\Astronomy;

/**
 * 天文計算アルゴリズムの選択 API を提供する Trait。
 *
 * 旧暦・二十四節気・月相などの計算で使用する太陽黄経・月黄経の
 * アルゴリズムを、日付クラス経由で切り替えるためのエイリアスを提供します。
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
trait Algorithm
{
    /**
     * 太陽黄経計算で使用するアルゴリズムを設定する。
     *
     * @param string $algorithm 太陽アルゴリズム
     * @return void
     * @throws \InvalidArgumentException 未対応の太陽アルゴリズムが指定された場合
     */
    public static function useSolarAlgorithm($algorithm): void
    {
        Astronomy::useSolarAlgorithm($algorithm);
    }

    /**
     * 現在の太陽黄経計算アルゴリズムを返す。
     *
     * @return string 太陽アルゴリズム
     */
    public static function solarAlgorithm(): string
    {
        return Astronomy::solarAlgorithm();
    }

    /**
     * 月黄経計算で使用するアルゴリズムを設定する。
     *
     * @param string $algorithm 月アルゴリズム
     * @return void
     * @throws \InvalidArgumentException 未対応の月アルゴリズムが指定された場合
     */
    public static function useMoonAlgorithm($algorithm): void
    {
        Astronomy::useMoonAlgorithm($algorithm);
    }

    /**
     * 現在の月黄経計算アルゴリズムを返す。
     *
     * @return string 月アルゴリズム
     */
    public static function moonAlgorithm(): string
    {
        return Astronomy::moonAlgorithm();
    }

    /**
     * 日付境界計算で使用する太陽黄経アルゴリズムを設定する。
     *
     * @param string $algorithm 太陽アルゴリズム
     * @return void
     * @throws \InvalidArgumentException 未対応の太陽アルゴリズムが指定された場合
     */
    public static function useBoundarySolarAlgorithm($algorithm): void
    {
        Astronomy::useBoundarySolarAlgorithm($algorithm);
    }

    /**
     * 現在の日付境界計算用太陽黄経アルゴリズムを返す。
     *
     * @return string 太陽アルゴリズム
     */
    public static function boundarySolarAlgorithm(): string
    {
        return Astronomy::boundarySolarAlgorithm();
    }

    /**
     * 日付境界計算で使用する月黄経アルゴリズムを設定する。
     *
     * @param string $algorithm 月アルゴリズム
     * @return void
     * @throws \InvalidArgumentException 未対応の月アルゴリズムが指定された場合
     */
    public static function useBoundaryMoonAlgorithm($algorithm): void
    {
        Astronomy::useBoundaryMoonAlgorithm($algorithm);
    }

    /**
     * 現在の日付境界計算用月黄経アルゴリズムを返す。
     *
     * @return string 月アルゴリズム
     */
    public static function boundaryMoonAlgorithm(): string
    {
        return Astronomy::boundaryMoonAlgorithm();
    }
}
