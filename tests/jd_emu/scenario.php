<?php
/**
 * テストのScenarioクラス
 *
 *
 * PHP versions 5
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */

$scenario_dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
define('ENVI_MVC_APPKEY_PATH', $scenario_dir.'/../../config/');
define('ENVI_TEST_YML', basename(dirname(__FILE__)).'.yml');

require_once dirname(__FILE__).'/testCaseBase.php';

/**
 * テストのScenarioクラス
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */
class Scenario extends EnviTestScenario
{
    public static $stack_data;

    /**
     * +-- データスタック用
     *
     * @access public
     * @static
     * @param  $k
     * @param  $v
     * @return void
     */
    public static function setAttribute($k, $v)
    {
        self::$stack_data[$k] = $v;
    }
    /* ----------------------------------------- */

    /**
     * +-- スタックしたデータを取得する用
     *
     * @access public
     * @static
     * @param  $k
     * @return void
     */
    public static function getAttribute($k)
    {
        return isset(self::$stack_data[$k]) ? self::$stack_data[$k] : NULL;
    }
    /* ----------------------------------------- */

    /**
     * +-- 実行するテストの配列をYamlから返す
     *
     * @access public
     * @return array
     */
    public function execute()
    {
        if (isOption('--auto')) {
            return parent::execute();
        }
        $arr = array();
        if (!isOption('-s')) {
            foreach ($this->system_conf['scenario']['dirs'] as $dir_name) {
                $arr = $this->getTestByDir($dir_name, 1, $arr);
            }
        } else {
            foreach (explode(',', getOption('-s')) as $dir_name) {
                $arr = $this->getTestByDir($this->system_conf['scenario']['dirs'][$dir_name], 1, $arr);
            }
        }
        if (isOption('-t')) {
            $sub_arr = array();
            foreach ($arr as $val) {
                foreach (explode(',', getOption('-t')) as $class_name) {
                    if ($val['class_name'] === $class_name) {
                        $sub_arr[] = $val;
                    }
                }
            }
            return $sub_arr;
        }
        return $arr;
    }
    /* ----------------------------------------- */

}
