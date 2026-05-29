<?php

/**
 * SexagenaryCycle.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        2026-05-29
 */

namespace JapaneseDate\Components;

/**
 * 十二支・十干の計算を行うコンポーネント
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
class SexagenaryCycle
{
    /**
     * 十二支配列
     *
     * インデックスは (year + 9) % 12 で求める。
     * 1984年(甲子)を起点とすると index=1 が子。
     *
     * @var array<int, string>
     */
    public const ORIENTAL_ZODIAC = ['亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌'];

    /**
     * 十干配列
     *
     * インデックスは (year + 6) % 10 で求める。
     * 1984年(甲子)を起点とすると index=0 が甲。
     *
     * @var array<int, string>
     */
    public const HEAVENLY_STEMS = ['甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸'];

    /**
     * ファクトリー (シングルトン)
     *
     * @return static
     */
    public static function factory(): static
    {
        static $instance;
        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * 十二支キーを返す
     *
     * @param int $year 西暦年
     * @return int 0〜11 の整数 (ORIENTAL_ZODIAC 配列のインデックス)
     */
    public function getOrientalZodiacKey(int $year): int
    {
        return ($year + 9) % 12;
    }

    /**
     * 十二支の文字列を返す
     *
     * @param int $key 0〜11
     * @return string
     */
    public function viewOrientalZodiac(int $key): string
    {
        return self::ORIENTAL_ZODIAC[$key] ?? '';
    }

    /**
     * 十干キーを返す
     *
     * @param int $year 西暦年
     * @return int 0〜9 の整数 (HEAVENLY_STEMS 配列のインデックス)
     */
    public function getHeavenlyStemKey(int $year): int
    {
        return ($year + 6) % 10;
    }

    /**
     * 十干の文字列を返す
     *
     * @param int $key 0〜9
     * @return string
     */
    public function viewHeavenlyStem(int $key): string
    {
        return self::HEAVENLY_STEMS[$key] ?? '';
    }
}
