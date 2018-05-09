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
class JapaneseDateTimeTest extends testCaseBase
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
    public function strftimeTest()
    {

        $JDT = JapaneseDateTime::factory('2016-12-23');
        $JDT2 = JapaneseDateTime::factory('2016-09-06');
        $this->assertEquals('%', $JDT->strftime('%%'));
        $this->assertEquals('%Fri', $JDT->strftime('%%%a'));
        $this->assertEquals($JDT->getOrientalZodiac().'-'.$JDT->viewOrientalZodiac(), $JDT->strftime('%o-%O'));
        $this->assertEquals($JDT->getHoliday().'-'.$JDT->viewHoliday(), $JDT->strftime('%l-%L'));
        $this->assertEquals($JDT->viewWeekday().'-'.$JDT->viewSixWeekday().'-'.$JDT->getSixWeekday(), $JDT->strftime('%K-%k-%6'));

        $this->assertEquals('23-12', $JDT->strftime('%e-%g'));
        $this->assertEquals(' 6- 9', $JDT2->strftime('%e-%g'));

        $this->assertEquals($JDT->viewMonth().'-'.$JDT->getMonth(), $JDT->strftime('%G-%N'));
        $this->assertEquals($JDT->getEraName().'-'.$JDT->viewEraName().'-'.$JDT->getEraYear(), $JDT->strftime('%f-%F-%E'));
        $this->assertEquals($JDT->format('j'), $JDT->strftime('%J'));


    }
    /* ----------------------------------------- */

    public function viewHolidayTest()
    {
        $JDT = JapaneseDateTime::factory('2016-12-23');
        $this->assertEquals('天皇誕生日', $JDT->viewHoliday());
        $JDT = JapaneseDateTime::factory('2016-05-01');
        $this->assertEquals('', $JDT->viewHoliday());
    }

    public function viewWeekdayTest()
    {
        $JDT = JapaneseDateTime::factory('2016-05-01');
        $this->assertEquals('日', $JDT->viewWeekday());
    }

    public function viewMonthTest()
    {
        $JDT = JapaneseDateTime::factory('2016-05-01');
        $this->assertEquals('皐月', $JDT->viewMonth());
    }

    public function viewLunarMonthTest()
    {
        $JDT = JapaneseDateTime::factory('2016-06-05');
        $this->assertEquals('皐月', $JDT->viewLunarMonth());
    }

    public function viewOrientalZodiacTest()
    {
        $JDT = JapaneseDateTime::factory('2016-05-21');
        $this->assertEquals('申', $JDT->viewOrientalZodiac());
    }

    public function getOrientalZodiacTest()
    {
        $JDT = JapaneseDateTime::factory('2019-05-21');
        $this->assertEquals(0, $JDT->getOrientalZodiac());
    }

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getEraNameTest()
    {
        $JDT = new JapaneseDateTime('1868-01-25');
        $this->assertEquals('明治', $JDT->viewEraName());
        $this->assertEquals(1, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('1912-07-29');
        $this->assertEquals('明治', $JDT->viewEraName());
        $this->assertEquals(45, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('1912-07-30');
        $this->assertEquals('大正', $JDT->viewEraName());
        $this->assertEquals(1, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('1926-12-24');
        $this->assertEquals('大正', $JDT->viewEraName());
        $this->assertEquals(15, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('1926-12-25');
        $this->assertEquals('昭和', $JDT->viewEraName());
        $this->assertEquals(1, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('1989-01-07');
        $this->assertEquals('昭和', $JDT->viewEraName());
        $this->assertEquals(64, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('1989-01-08');
        $this->assertEquals('平成', $JDT->viewEraName());
        $this->assertEquals(1, $JDT->getEraYear());

        $JDT = new JapaneseDateTime('2016-01-08');
        $this->assertEquals('平成', $JDT->viewEraName());
        $this->assertEquals(28, $JDT->getEraYear());
    }
    /* ----------------------------------------- */

    public function getDatesOfMonthTest()
    {
        $JDT = new JapaneseDateTime('2016-01-15');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);

        $JDT = new JapaneseDateTime('2016-02-01');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(29, $res);

        $JDT = new JapaneseDateTime('2016-03-15');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);

        $JDT = new JapaneseDateTime('2016-04-30');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(30, $res);

        $JDT = new JapaneseDateTime('2016-05-10');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);

        $JDT = new JapaneseDateTime('2016-06-20');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(30, $res);

        $JDT = new JapaneseDateTime('2016-07-01');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);

        $JDT = new JapaneseDateTime('2016-08-22');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);

        $JDT = new JapaneseDateTime('2016-09-23');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(30, $res);

        $JDT = new JapaneseDateTime('2016-10-20');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);

        $JDT = new JapaneseDateTime('2016-11-01');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(30, $res);

        $JDT = new JapaneseDateTime('2016-12-31');
        $res = $JDT->getDatesOfMonth();
        $this->assertCount(31, $res);
    }



    public function getCalendarTest()
    {
        $JDT = new JapaneseDateTime('2016-06-01');
        $JDT->getCalendar();
    }

    public function getChukiCalendarTest()
    {
        $JDT = new JapaneseDateTime('2016-06-01');
        $JDT->getChukiCalendar();
    }

    public function getTsuitachiCalendarTest()
    {
        $JDT = new JapaneseDateTime('2016-06-01');
        $JDT->getTsuitachiCalendar();
    }



    public function getChukiTest()
    {
        $JDT = new JapaneseDateTime('2016-06-01');
        $Chuki = $JDT->getChuki();
        $Chuki2 = $Chuki->getChuki();
        $this->assertEquals($Chuki->format('Y-m-d'), $Chuki2->format('Y-m-d'));

        return $Chuki;
    }

    /**
     * +--
     *
     * @access      public
     * @param $Chuki
     * @return      void
     * @depends     getChukiTest
     */
    public function isChukiTest($Chuki)
    {
        $this->assertTrue($Chuki->isChuki());
        $JDT = new JapaneseDateTime('2016-06-01');
        $this->assertFalse($JDT->isChuki());
    }


    public function getTsuitachiTest()
    {
        $JDT = new JapaneseDateTime('2000-06-06');
        $Tsuitachi = $JDT->getTsuitachi();
        $this->assertEquals($Tsuitachi->format('Y-m-d'), '2000-06-02');

        $JDT = new JapaneseDateTime('2016-06-01');
        $Tsuitachi = $JDT->getTsuitachi();
        $this->assertEquals($Tsuitachi->format('Y-m-d'), '2016-05-07');

        $JDT = new JapaneseDateTime('2016-06-06');
        $Tsuitachi = $JDT->getTsuitachi();
        $this->assertEquals($Tsuitachi->format('Y-m-d'), '2016-06-05');

        $JDT = new JapaneseDateTime('2016-06-05');
        $Tsuitachi = $JDT->getTsuitachi();
        $this->assertEquals($Tsuitachi->format('Y-m-d'), '2016-06-05');
    }



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
