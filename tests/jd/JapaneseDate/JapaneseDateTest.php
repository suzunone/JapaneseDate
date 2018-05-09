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
class JapaneseDateTest extends testCaseBase
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
     * +-- dataProvider
     *
     * @access      public
     * @return array
     */
    public function createTestObject()
    {
        $JapaneseDate = new \JapaneseDate\JapaneseDate();
        $JapaneseDateTime = new JapaneseDateTime();
        return array($JapaneseDate, $JapaneseDateTime);
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     * @covers JapaneseDate\JapaneseDate::getDayByWeekly
     */
    public function getDayByWeeklyTest()
    {
        $JapaneseDate = new \JapaneseDate\JapaneseDate();
        $res = $JapaneseDate->getDayByWeekly(2016, 6, JapaneseDateTime::SUNDAY, 1, $timezone = NULL);
        $this->assertEquals(5, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::SUNDAY, 1, $timezone = NULL);
        $this->assertEquals(1, $res);


        $res = $JapaneseDate->getDayByWeekly(2016, 6, JapaneseDateTime::SUNDAY, 2, $timezone = NULL);
        $this->assertEquals(5+7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::SUNDAY, 2, $timezone = NULL);
        $this->assertEquals(1+7, $res);



        $res = $JapaneseDate->getDayByWeekly(2016, 6, JapaneseDateTime::MONDAY, 1, $timezone = NULL);
        $this->assertEquals(6, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::MONDAY, 1, $timezone = NULL);
        $this->assertEquals(2, $res);


        $res = $JapaneseDate->getDayByWeekly(2016, 6, JapaneseDateTime::MONDAY, 2, $timezone = NULL);
        $this->assertEquals(6+7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::MONDAY, 2, $timezone = NULL);
        $this->assertEquals(2+7, $res);


        $res = $JapaneseDate->getDayByWeekly(2016, 6, JapaneseDateTime::TUESDAY, 1, $timezone = NULL);
        $this->assertEquals(7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::TUESDAY, 1, $timezone = NULL);
        $this->assertEquals(3, $res);


        $res = $JapaneseDate->getDayByWeekly(2016, 6, JapaneseDateTime::TUESDAY, 2, $timezone = NULL);
        $this->assertEquals(7+7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::TUESDAY, 2, $timezone = NULL);
        $this->assertEquals(3+7, $res);



        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::WEDNESDAY, 1, $timezone = NULL);
        $this->assertEquals(4, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::WEDNESDAY, 2, $timezone = NULL);
        $this->assertEquals(4+7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::THURSDAY, 1, $timezone = NULL);
        $this->assertEquals(5, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::THURSDAY, 2, $timezone = NULL);
        $this->assertEquals(5+7, $res);


        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::FRIDAY, 1, $timezone = NULL);
        $this->assertEquals(6, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::FRIDAY, 2, $timezone = NULL);
        $this->assertEquals(6+7, $res);


        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::SATURDAY, 1, $timezone = NULL);
        $this->assertEquals(7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, JapaneseDateTime::SATURDAY, 2, $timezone = NULL);
        $this->assertEquals(7+7, $res);
    }
    /* ----------------------------------------- */

    /**
     * +-- 祝日法の開始
     *
     * @access      public
     * @return      void
     */
    public function HolidayStartTest()
    {
        $JapaneseDate = new \JapaneseDate\JapaneseDate();
        $JapaneseDateTime = new JapaneseDateTime('1948-01-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1948-02-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1948-03-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1948-04-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1948-05-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1948-06-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1948-07-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1947-08-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1947-09-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1947-10-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1947-11-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new JapaneseDateTime('1947-12-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
    }
    /* ----------------------------------------- */

    /**
     * +-- 1月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getJanuaryHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2000', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(1, $res);
        $this->assertArrayHasKey(10, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('元旦', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('成人の日', $JapaneseDate->viewHoliday($res[10]));

        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('1999', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(1, $res);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('元旦', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('成人の日', $JapaneseDate->viewHoliday($res[15]));
    }
    /* ----------------------------------------- */

    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getJanuaryHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('1978', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);

        $this->assertEquals('元旦', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[2]));
        $this->assertEquals('成人の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));


        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('1984', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('1989', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('1995', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);

        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2006', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2012', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2017', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2023', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2034', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2040', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->call($JapaneseDate, 'getJanuaryHoliday', array('2045', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
    }
    /* ----------------------------------------- */


    /**
     * +-- 2月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getFebruaryHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2016', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));



        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('1989', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('昭和天皇の大喪の礼', $JapaneseDate->viewHoliday($res[24]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getFebruaryHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('1979', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('1990', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('1996', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2001', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2007', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2018', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2024', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2029', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2035', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->call($JapaneseDate, 'getFebruaryHoliday', array('2046', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
    }
    /* ----------------------------------------- */


    /**
     * +-- 3月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getMarchHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('春分の日', $JapaneseDate->viewHoliday($res[21]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getMarchHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('1988', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('春分の日', $JapaneseDate->viewHoliday($res[20]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[21]));

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2005', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2016', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2033', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2044', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2050', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('1982', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('1999', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2010', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);

        $res = $this->call($JapaneseDate, 'getMarchHoliday', array('2027', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);
    }
    /* ----------------------------------------- */


    /**
     * +-- 4月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getAprilHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1959', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(29, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('皇太子明仁親王の結婚の儀', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2007', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2006', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1989', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1988', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));

    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getAprilHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1973', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1979', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1984', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('1990', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2001', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2007', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2012', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2018', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));


        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2029', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));



        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2035', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2040', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->call($JapaneseDate, 'getAprilHoliday', array('2046', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 5月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getMayHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2016', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));

        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1982', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getMayHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertArrayHasKey(6, $res);
        $this->assertCount(4, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[6]));


        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1981', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));


        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1992', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));


    }
    /* ----------------------------------------- */


    /**
     * +-- 6月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getJuneHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getJuneHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertCount(0, $res);
        $res = $this->call($JapaneseDate, 'getJuneHoliday', array('1993', $JapaneseDateTime->getTimezone()));
        $this->assertCount(1, $res);
        $this->assertArrayHasKey(9, $res);
        $this->assertEquals('皇太子徳仁親王の結婚の儀', $JapaneseDate->viewHoliday($res[9]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getJuneHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
    }
    /* ----------------------------------------- */


    /**
     * +-- 7月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getJulyHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('1995', $JapaneseDateTime->getTimezone()));
        $this->assertCount(0, $res);
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('1994', $JapaneseDateTime->getTimezone()));
        $this->assertCount(0, $res);
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('1996', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));

        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2002', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));


        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2013', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2019', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2024', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2030', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2041', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2047', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2007', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2012', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2018', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2029', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2035', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2040', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2046', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2006', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2017', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2023', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2028', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2034', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2045', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2005', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2011', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2016', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2022', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2033', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2039', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2044', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2050', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2004', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2010', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2021', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2027', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2032', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2038', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2049', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2009', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2020', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2026', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2037', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2043', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2048', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2003', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2008', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2014', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2025', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2031', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2036', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('2042', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getJulyHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getJulyHoliday', array('1997', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[21]));

    }
    /* ----------------------------------------- */


    /**
     * +-- 8月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getAugustHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertCount(0, $res);
        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2016', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getAugustHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2019', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2024', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2030', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2041', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->call($JapaneseDate, 'getAugustHoliday', array('2047', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

    }
    /* ----------------------------------------- */

    /**
     * +-- 国民の休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function NationalHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1988', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));

        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1989', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1990', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1991', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1993', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1994', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1995', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1996', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('1999', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2000', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2001', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2002', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2004', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2005', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getMayHoliday', array('2006', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));



        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2032', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2049', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2060', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2077', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2088', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2094', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));




        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2009', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2026', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2037', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2043', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2054', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        /*
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2065', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        */
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2071', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2099', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 9月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getSeptemberHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1965', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1966', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2002', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2003', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2004', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[20]));
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getSeptemberHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1974', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1985', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1991', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1996', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2002', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2024', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[22]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[23]));


        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1973', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));


        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1984', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));



        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('1990', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));



        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2001', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));



        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2007', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));



        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2018', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));



        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2029', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));




        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2035', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));




        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2046', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

    }
    /* ----------------------------------------- */


    /**
     * +-- 10月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getOctoberHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('1965', $JapaneseDateTime->getTimezone()));
        $this->assertCount(0, $res);

        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('1966', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(10, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));

        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('2000', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(9, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[9]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getOctoberHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('1976', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('1982', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('1993', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->call($JapaneseDate, 'getOctoberHoliday', array('1999', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));


    }
    /* ----------------------------------------- */


    /**
     * +-- 11月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getNovemberHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));


        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1990', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertArrayHasKey(23, $res);

        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('即位礼正殿の儀', $JapaneseDate->viewHoliday($res[12]));
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getNovemberHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1974', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1985', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1991', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1996', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2002', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2013', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2019', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2024', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2030', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2041', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2047', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));



        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1975', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1980', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1986', $JapaneseDateTime->getTimezone()));

        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('1997', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2003', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2008', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2014', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2025', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2031', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2036', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getNovemberHoliday', array('2042', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

    }
    /* ----------------------------------------- */


    /**
     * +-- 12月
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getDecemberHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('2015', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
    }
    /* ----------------------------------------- */


    /**
     * +-- 振替休日
     *
     * @access       public
     * @param $JapaneseDate
     * @param $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     */
    public function getDecemberHolidayTransferHolidayTest($JapaneseDate, $JapaneseDateTime)
    {
        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('1990', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('2001', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('2007', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('2012', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('2018', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->call($JapaneseDate, 'getDecemberHoliday', array('2029', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

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
