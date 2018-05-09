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
class JapaneseDateCalendarTest extends testCaseBase
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
    public function getWorkingDayBySpanNoneTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-06-30 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            '2016-06-01 00:00:00'
        );

        $this->assertArray($res);
        $this->assertCount(0, $res);
    }
    /* ----------------------------------------- */



    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getWorkingDayBySpanTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar(new JapaneseDateTime('2016-01-01 00:00:00'));
        $JapaneseDateCalendar->setBypassHoliday(false);

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-12-31 00:00:00')
        );
        $this->assertArray($res);
        $this->assertCount(366, $res);
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getWorkingDayByWithWeekAndDayTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-01-01 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-12-31 00:00:00')
        );

        $this->assertArray($res);

        $this->assertCount(245-2, $res);
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getWorkingDayByWithWeekAndDayUseStringDateTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );


        $this->assertArray($res);
        $this->assertCount(1, $res);

        return $res;
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function removeBypassWeekDayTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));


        $JapaneseDateCalendar->removeBypassWeekDay(JapaneseDateTime::SUNDAY);

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );


        $this->assertArray($res);
        $this->assertCount(3, $res);

        $JapaneseDateCalendar->removeBypassWeekDay(JapaneseDateTime::SUNDAY);

        $res2 = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );

        $this->assertArray($res2);
        $this->assertCount(3, $res2);
        $this->assertSame($res2[0]->getTimestamp(), $res[0]->getTimestamp());

    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function resetBypassWeekDayTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));


        $JapaneseDateCalendar->resetBypassWeekDay();

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );


        $this->assertArray($res);
        $this->assertCount(5, $res);

    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function removeBypassDayTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));


        $JapaneseDateCalendar->removeBypassDay('2016-05-02');

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );

        $this->assertArray($res);
        $this->assertCount(2, $res);



        $JapaneseDateCalendar->removeBypassDay('2016-05-06');

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );

        $this->assertArray($res);
        $this->assertCount(3, $res);

    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function resetBypassDayTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));


        $JapaneseDateCalendar->resetBypassDay();

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-09 00:00:00')
        );


        $this->assertArray($res);
        $this->assertCount(3, $res);

    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @param $data
     * @return      void
     * @depends     getWorkingDayByWithWeekAndDayUseStringDateTest
     */
    public function getWorkingDayByLimitTest($data)
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));

        $res = $JapaneseDateCalendar->getWorkingDayByLimit(
            1
        );


        $this->assertArray($res);
        $this->assertCount(1, $res);
        $this->assertSame($data[0]->getTimestamp(), $res[0]->getTimestamp());

       $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');

       $res2 = $JapaneseDateCalendar->getWorkingDayByLimit(
            1
        );


        $this->assertArray($res2);
        $this->assertCount(1, $res2);
        $this->assertSame('2016-04-29', $res2[0]->format('Y-m-d'));

        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-04-29'));

        $res2 = $JapaneseDateCalendar->getWorkingDayByLimit(
            1
        );

        $this->assertArray($res2);
        $this->assertCount(1, $res2);
        $this->assertSame($res2[0]->getTimestamp(), $res[0]->getTimestamp());




        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::FRIDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-04-29'));

        $res2 = $JapaneseDateCalendar->getWorkingDayByLimit(
            1
        );

        $this->assertArray($res2);
        $this->assertCount(1, $res2);
        $this->assertSame($res2[0]->getTimestamp(), $res[0]->getTimestamp());

        return $res;
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @param $data
     * @return      void
     * @depends     getWorkingDayByLimitTest
     * @covers      JapaneseDateCalendar::getWorkingDay
     */
    public function getWorkingDayTest($data)
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));

        $res = $JapaneseDateCalendar->getWorkingDay(
            1
        );


        $this->assertArray($res);
        $this->assertCount(1, $res);
        $this->assertSame($data[0]->getTimestamp(), $res[0]->getTimestamp());

        return $res;
    }
    /* ----------------------------------------- */



    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getWorkingDayByWithWeekAndDayUseStringDateEmptyTest()
    {
        $JapaneseDateCalendar = new JapaneseDateCalendar('2016-04-29 00:00:00');
        $JapaneseDateCalendar->setBypassHoliday(true);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
        $JapaneseDateCalendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
        $JapaneseDateCalendar->addBypassDay('2016-05-02');
        $JapaneseDateCalendar->addBypassDay(new JapaneseDateTime('2016-05-06'));

        $res = $JapaneseDateCalendar->getWorkingDayBySpan(
            strtotime('2016-05-08 00:00:00')
        );


        $this->assertArray($res);
        $this->assertCount(0, $res);
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
