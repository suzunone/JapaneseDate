<?php
/**
 *
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


/**
 *
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
class LunarCalendarTest extends testCaseBase
{
    /**
     * +-- 初期化
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        $this->free();
    }
    /* ----------------------------------------- */

    /* ----------------------------------------- */

    /**
     * +-- dataProvider
     *
     * @access      public
     * @return      array
     */
    public function createTestObject()
    {
        $LunarCalendar = new \JapaneseDate\LunarCalendar();
        $JapaneseDateTime = new JapaneseDateTime();
        return array($LunarCalendar, $JapaneseDateTime);
    }
    /* ----------------------------------------- */

    /**
     * +-- getChu
     *
     * @access       public
     * @param $LunarCalendar
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getChuTest($LunarCalendar, $JapaneseDateTime)
    {
        $tm = $LunarCalendar->makeJD(9, 0, 0, 2, 29, 2000);

        $i = 2000;
        while ($i < 3000) {
            echo "{$i}\n";
            $tm = $LunarCalendar->makeJD(9, 0, 0, 2, 28, $i);
            $res = $this->call($LunarCalendar, 'JD2DateArray', array($tm, \JapaneseDate\LunarCalendar::JD_CHU));
            $tm = $LunarCalendar->makeJD(9, 0, 0, 2, 29, $i);
            $res = $this->call($LunarCalendar, 'JD2DateArray', array($tm, \JapaneseDate\LunarCalendar::JD_CHU));
            $i++;
        }


    }
    /* ----------------------------------------- */

    /**
     * +-- 終了処理
     *
     * @access public
     * @return void
     */
    public function shutdown()
    {
    }

}
