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
 * @since      2020-12-19
 */

namespace JapaneseDate\Components;

/**
 * 旧暦・二十四節気の年別マッピングデータを読み込む設定コンポーネント。
 *
 * このクラスは外部から登録されたデータディレクトリを探索し、指定年に対応する
 * PHP 配列形式の暦データを取得します。主に旧暦計算で使用する朔日テーブルと、
 * 二十四節気の対応表データを読み込むために利用されます。
 *
 * **管理するデータ:**
 * - `KEY_LUNAR_CALENDAR` — 旧暦月・日・閏月情報を含む年別データ
 * - `KEY_SOLAR_TERM` — 二十四節気の日付を含む年別データ
 *
 * **探索方法:**
 * {@see setLCPath()} または {@see addLCPath()} で登録されたパスを順に確認し、
 * 最初に見つかった `{year}.php` の内容を採用します。複数のデータソースを
 * 優先順位付きで差し替えたい場合は、先頭に追加される {@see addLCPath()} を使用します。
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
 * @since      2020-12-19
 */
class Config
{
    public const KEY_LUNAR_CALENDAR = 'lunarCalendar';

    public const KEY_SOLAR_TERM = 'solarTerm';

    /**
     * @var mixed[]
     */
    protected static $lc_path = [];

    /**
     * 配列で旧暦マッピングデータのパスを置き換えます
     *
     * @param array $lc_path
     */
    public static function setLCPath($lc_path): void
    {
        self::$lc_path = $lc_path;
    }

    /**
     * 旧暦マッピングデータのパスを追加します
     *
     * @param string $lc_path
     */
    public static function addLCPath($lc_path): void
    {
        array_unshift(self::$lc_path, $lc_path);
    }

    /**
     * 指定された年の旧暦カレンダーデータを取得する
     *
     * @param int $year
     * @return array
     */
    public static function getLC($year): array
    {
        $config = self::getConfig($year);
        if (!count($config) || !isset($config[self::KEY_LUNAR_CALENDAR])) {
            return [];
        }

        $res = $config[self::KEY_LUNAR_CALENDAR];

        foreach ($res as &$val) {
            $val['jd'] = gregoriantojd($val['month'], $val['day'], $val['year']);
        }

        return $res;
    }

    /**
     * 指定された年の旧暦マッピングデータを取得する
     *
     * @param int $year
     * @return array
     */
    public static function getConfig($year): array
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

    /**
     * 指定された年の二十四節気データを取得する
     *
     * @param int $year
     * @return array
     */
    public static function getST($year): array
    {
        $config = self::getConfig($year);
        if (!count($config) || !isset($config[self::KEY_SOLAR_TERM])) {
            return [];
        }

        return $config[self::KEY_SOLAR_TERM];
    }
}
