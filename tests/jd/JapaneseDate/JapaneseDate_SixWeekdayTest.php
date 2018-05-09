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
class JapaneseDate_SixWeekdayTest extends testCaseBase
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

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getSixWeekdayUnixBaseTimeTest()
    {
        $jd = new JapaneseDateTime;

        $jd->setTimestamp(strtotime('1970-01-01 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '仏滅');


        $jd->setTimestamp(strtotime('1970-01-01 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '仏滅');


        $jd->setTimestamp(-32400);
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '仏滅');


        $jd->setTimestamp(strtotime('1970-01-02 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '大安');

        $jd->setTimestamp(strtotime('1970-01-02 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '大安');



        $jd->setTimestamp(strtotime('1970-12-31 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '先負');
        $jd->setTimestamp(strtotime('1970-12-31 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '先負');

    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getSixWeekdayNegativeTimeTest()
    {
        $jd = new JapaneseDateTime;

        $jd->setTimestamp(strtotime('1969-12-31 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '先負');
        $jd->setTimestamp(strtotime('1969-12-31 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '先負');


        $jd->setTimestamp(strtotime('1969-12-30 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '友引');
        $jd->setTimestamp(strtotime('1969-12-30 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '友引');


        $jd->setTimestamp(strtotime('1969-12-29 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '先勝');
        $jd->setTimestamp(strtotime('1969-12-29 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '先勝');

        $jd->setTimestamp(strtotime('1969-12-28 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '赤口');
        $jd->setTimestamp(strtotime('1969-12-28 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '赤口');

        $jd->setTimestamp(strtotime('1969-12-27 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '大安');
        $jd->setTimestamp(strtotime('1969-12-27 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '大安');
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getSixWeekdayCherryPickTimeTest()
    {
        $jd = new JapaneseDateTime;

        $jd->setTimestamp(strtotime('2016-01-01 00:00:00'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '友引');
        $jd->setTimestamp(strtotime('2016-01-01 23:59:59'));
        $six_week = $jd->getSixWeekday();
        $this->assertEquals($jd->viewSixWeekday($six_week), '友引');


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
