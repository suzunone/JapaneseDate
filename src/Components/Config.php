<?php

/**
 * Config.php
 *
 * Class ${NAME}
 *
 * @category   Contender
 * @subpackage ${NAMESPACE}
 * @author     suzunone<suzunone.eleven@gmail.com>
 * @copyright  Project Contender
 * @license    MIT
 * @version    1.0
 * @link       https://github.com/suzunone/Contender
 * @see        https://github.com/suzunone/Contender
 * @since      2020/12/19
 */

namespace JapaneseDate\Components;

/**
 * Class Config
 *
 * 旧暦マッピングデータクラス
 *
 * @category   JapaneseDate
 * @package    JapaneseDate\Components
 * @subpackage JapaneseDate\Components
 * @author     suzunone<suzunone.eleven@gmail.com>
 * @copyright  Project Contender
 * @license    MIT
 * @version    1.0
 * @link       https://github.com/suzunone/JapaneseDate
 * @see        https://github.com/suzunone/JapaneseDate
 * @since      2020/12/19
 */
class Config
{
    public const KEY_LUNAR_CALENDAR = 'lunarCalendar';

    public const KEY_SOLAR_TERM = 'solarTerm';

    protected static array $lc_path = [];

    /**
     * 配列で旧暦マッピングデータのパスを置き換えます
     *
     * @param array $lc_path
     */
    public static function setLCPath(array $lc_path): void
    {
        self::$lc_path = $lc_path;
    }

    /**
     * 旧暦マッピングデータのパスを追加します
     *
     * @param string $lc_path
     */
    public static function addLCPath(string $lc_path): void
    {
        array_unshift(self::$lc_path, $lc_path);
    }

    /**
     * 指定された年の旧暦カレンダーデータを取得する
     *
     * @param int $year
     * @return array
     */
    public static function getLC(int $year): array
    {
        $config = self::getConfig($year);
        if (!count($config) || isset($config[self::KEY_LUNAR_CALENDAR])) {
            return [];
        }

        $res = $config[self::KEY_LUNAR_CALENDAR];

        foreach ($res as &$val) {
            $val['jd'] = gregoriantojd($val['month'], $val['day'], $val['year']);
        }

        return $res;
    }

    /**
     * 指定された年の二十四節気データを取得する
     *
     * @param int $year
     * @return array
     */
    public static function getST(int $year): array
    {
        $config = self::getConfig($year);
        if (!count($config) || isset($config[self::KEY_SOLAR_TERM])) {
            return [];
        }

        return $config[self::KEY_SOLAR_TERM];
    }

    /**
     * 指定された年の旧暦マッピングデータを取得する
     *
     * @param int $year
     * @return array
     */
    public static function getConfig(int $year): array
    {
        $res = [];
        foreach (self::$lc_path as $lc_path) {
            $path = realpath($lc_path) . DIRECTORY_SEPARATOR . $year . '.php';
            $res = is_file($path) ? (include $path) : [];
            if (count($res)) {
                break;
            }
        }

        return $res;
    }
}
