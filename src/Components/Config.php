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
    protected static $lc_path = [
        __DIR__ . '/../config/LC/',
    ];

    /**
     * @param array $lc_path
     */
    public static function setLCPath(array $lc_path)
    {
        self::$lc_path = $lc_path;
    }

    /**
     * 旧暦マッピングデータのパスを追加します
     *
     * @param string $lc_path
     */
    public static function addLCPath(string $lc_path)
    {
        array_unshift(self::$lc_path, $lc_path);
    }

    /**
     * @param int $year
     * @return array|mixed
     */
    public static function getLC(int $year)
    {
        foreach (self::$lc_path as $lc_path) {
            $path = realpath($lc_path) . DIRECTORY_SEPARATOR . $year . '.php';
            $res = is_file($path) ? (include $path) : [];
            if (count($res)) {
                break;
            }
        }

        foreach ($res as &$val) {
            $val['jd'] = gregoriantojd($val['month'], $val['day'], $val['year']);
        }

        return $res;
    }
}
