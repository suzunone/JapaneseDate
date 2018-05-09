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
class JapaneseDate_LunarCalendarTest extends testCaseBase
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
     * @throws \Exception
     * @throws \Exception
     * @throws \Exception
     */
    public function getLunarDate2014To2015Test()
    {
        $JapaneseDateTime = new JapaneseDateTime('2014-01-01 00:00:00');
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2013);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 12);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 1);

        $JapaneseDateTime->add(new DateInterval('P10D'));
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2013);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 12);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 11);

        $JapaneseDateTime->add(new DateInterval('P20D'));
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2014);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 1);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 1);

    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     * @throws \Exception
     * @throws \Exception
     * @throws \Exception
     */
    public function getLunarDate2014UruuTest()
    {
        $JapaneseDateTime = new JapaneseDateTime('2014-09-23 00:00:00');
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2014);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 8);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 30);

        $JapaneseDateTime->add(new DateInterval('P1D'));
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2014);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 9);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 1);

        $JapaneseDateTime = new JapaneseDateTime('2014-10-23 00:00:00');
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2014);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 9);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 30);

        $JapaneseDateTime->add(new DateInterval('P1D'));
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2014);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 9);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 1);
        $this->assertTrue($JapaneseDateTime->isUruu());
    }
    /* ----------------------------------------- */




    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getLunarDate2016Test()
    {
        $JapaneseDateTime = new JapaneseDateTime('2016-01-01 00:00:00');
        $this->assertEquals($JapaneseDateTime->getLunarYear(), 2015);
        $this->assertEquals($JapaneseDateTime->getLunarMonth(), 11);
        $this->assertEquals($JapaneseDateTime->getLunarDay(), 22);

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
