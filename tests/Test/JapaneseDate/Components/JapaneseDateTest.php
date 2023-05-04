<?php /** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */

/**
 *
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/04/28 14:20
 */

namespace Test\JapaneseDate\Components;

use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\DateTime;
use JapaneseDate\Exceptions\ErrorException;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class JapaneseDateTest
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Components\JapaneseDate
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class JapaneseDateTest extends TestCase
{
    use InvokeTrait;

    /**
     * @covers \JapaneseDate\Components\JapaneseDate::__construct
     */
    public function test_construct()
    {
        $JapaneseDate = new JapaneseDate();

        $this->assertInstanceOf(
            LunarCalendar::class,
            $this->invokeGetProperty($JapaneseDate, 'LunarCalendar')
        );
    }

    /**
     * dataProvider
     *
     * @access      public
     * @return      array
     */
    public static function createTestObject()
    {
        $JapaneseDate = new JapaneseDate();
        $JapaneseDateTime = new DateTime();

        return [[$JapaneseDate, $JapaneseDateTime]];
    }

    public function test_regnalDay()
    {
        $JapaneseDate = new JapaneseDate();
        $JapaneseDateTime = new DateTime('2019-10-22');

        $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['2020', $JapaneseDateTime->getTimezone()]);

        $this->assertEquals('即位礼正殿の儀', $JapaneseDateTime->holiday_text);
        $this->assertEquals(DateTime::REGNAL_DAY, $JapaneseDateTime->holiday);
    }

    /**
     * 祝日法の開始
     *
     * @access      public
     * @return      void
     * @covers      \JapaneseDate\Components\JapaneseDate::getHolidayList()
     * @covers      \JapaneseDate\Components\JapaneseDate::getJanuaryHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getFebruaryHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getMarchHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getAprilHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getMayHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getJuneHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getJulyHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getAugustHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getSeptemberHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getOctoberHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getNovemberHoliday()
     * @covers      \JapaneseDate\Components\JapaneseDate::getDecemberHoliday()
     *
     */
    public function test_holidayStart()
    {
        $JapaneseDate = new JapaneseDate();
        $JapaneseDateTime = new DateTime('1948-01-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1948-02-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1948-03-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1948-04-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1948-05-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1948-06-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1948-07-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1947-08-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1947-09-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1947-10-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1947-11-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
        $JapaneseDateTime = new DateTime('1947-12-01');
        $res = $JapaneseDate->getHolidayList($JapaneseDateTime);
        $this->assertCount(0, $res);
    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::viewMonth()
     */
    public function test_viewMonth()
    {
        $JapaneseDate = new JapaneseDate();
        $this->assertEquals('睦月', $JapaneseDate->viewMonth(1));
        $this->assertEquals('如月', $JapaneseDate->viewMonth(2));
        $this->assertEquals('弥生', $JapaneseDate->viewMonth(3));
        $this->assertEquals('卯月', $JapaneseDate->viewMonth(4));
        $this->assertEquals('皐月', $JapaneseDate->viewMonth(5));
        $this->assertEquals('水無月', $JapaneseDate->viewMonth(6));
        $this->assertEquals('文月', $JapaneseDate->viewMonth(7));
        $this->assertEquals('葉月', $JapaneseDate->viewMonth(8));
        $this->assertEquals('長月', $JapaneseDate->viewMonth(9));
        $this->assertEquals('神無月', $JapaneseDate->viewMonth(10));
        $this->assertEquals('霜月', $JapaneseDate->viewMonth(11));
        $this->assertEquals('師走', $JapaneseDate->viewMonth(12));
    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::getHolidayList()
     */
    public function test_getHolidayList()
    {
        $JapaneseDate = new JapaneseDate();
        $holidays = $JapaneseDate->getHolidayList(new DateTime('2018-05-01'));
        $this->assertSame(
            [
                3 => DateTime::CONSTITUTION_DAY,
                4 => DateTime::GREENERY_DAY,
                5 => DateTime::CHILDREN_S_DAY,

            ],
            $holidays
        );
    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::viewEraName()
     */
    public function test_viewEraName()
    {
        $JapaneseDate = new JapaneseDate();
        $this->assertEquals(
            '明治',
            $JapaneseDate->viewEraName(DateTime::ERA_MEIJI)
        );

        $this->assertEquals(
            '大正',
            $JapaneseDate->viewEraName(DateTime::ERA_TAISHO)
        );

        $this->assertEquals(
            '昭和',
            $JapaneseDate->viewEraName(DateTime::ERA_SHOWA)
        );

        $this->assertEquals(
            '平成',
            $JapaneseDate->viewEraName(DateTime::ERA_HEISEI)
        );

        $this->assertEquals(
            '令和',
            $JapaneseDate->viewEraName(DateTime::ERA_REIWA)
        );
    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::viewSixWeekday()
     */
    public function test_viewSixWeekday()
    {
        $JapaneseDate = new JapaneseDate();
        $this->assertEquals(
            '大安',
            $JapaneseDate->viewSixWeekday(0)
        );
        $this->assertEquals(
            '赤口',
            $JapaneseDate->viewSixWeekday(1)
        );
        $this->assertEquals(
            '先勝',
            $JapaneseDate->viewSixWeekday(2)
        );
        $this->assertEquals(
            '友引',
            $JapaneseDate->viewSixWeekday(3)
        );
        $this->assertEquals(
            '先負',
            $JapaneseDate->viewSixWeekday(4)
        );
        $this->assertEquals(
            '仏滅',
            $JapaneseDate->viewSixWeekday(5)
        );
    }



    /**
     * @return array
     */
    public static function vernalEquinoxDayDataProvider(): array
    {
        return [
            '1599' => [1599, '0321'],
            '1600' => [1600, '0320'],
            '1979' => [1979, '0321'],
            '1980' => [1980, '0320'],
            '2000' => [2000, '0320'],
            '2099' => [2099, '0320'],
            '2100' => [2100, '0320'],
            '2150' => [2150, '0321'],
            '2151' => [2151, '0321'],
            '2399' => [2399, '0321'],
            '2400' => [2400, '0321'],
        ];
    }


    /**
     *
     * @access              public
     * @return      void
     * @covers              \JapaneseDate\Components\JapaneseDate::getVernalEquinoxDay()
     * @dataProvider vernalEquinoxDayDataProvider
     */
    public function test_getVernalEquinoxDay($year, $expected)
    {
        $JapaneseDate = new JapaneseDate();

        $this->assertEquals(
            $expected,
            DateTime::factory($JapaneseDate->getVernalEquinoxDay($year))->format('md')
        );

    }

    /**
     *
     * @access              public
     * @return      void
     * @covers              \JapaneseDate\Components\JapaneseDate::factory()
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory()
    {
        $JapaneseDate = JapaneseDate::factory();
        $JapaneseDate2 = JapaneseDate::factory();

        $this->assertSame($JapaneseDate, $JapaneseDate2);
    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::viewOrientalZodiac()
     */
    public function test_viewOrientalZodiac()
    {
        $JapaneseDate = new JapaneseDate();

        $this->assertEquals(
            '亥',
            $JapaneseDate->viewOrientalZodiac(0)
        );
        $this->assertEquals(
            '子',
            $JapaneseDate->viewOrientalZodiac(1)
        );
    }

    /**
     * @return array
     */
    public static function autumnEquinoxDayDataProvider(): array
    {
        return [
            '1599' => [1599, '0923'],
            '1600' => [1600, '0923'],
            '1979' => [1979, '0924'],
            '1980' => [1980, '0923'],
            '2000' => [2000, '0923'],
            '2099' => [2099, '0923'],
            '2100' => [2100, '0923'],
            '2150' => [2150, '0923'],
            '2151' => [2151, '0923'],
            '2399' => [2399, '0923'],
            '2400' => [2400, '0923'],
        ];
    }


    /**
     *
     * @access              public
     * @return      void
     * @covers              \JapaneseDate\Components\JapaneseDate::getAutumnEquinoxDay()
     * @dataProvider autumnEquinoxDayDataProvider
     */
    public function test_getAutumnEquinoxDay($year, $expected)
    {
        $JapaneseDate = new JapaneseDate();

        $this->assertEquals(
            $expected,
            DateTime::factory($JapaneseDate->getAutumnEquinoxDay($year))->format('md')
        );

    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::viewHoliday()
     */
    public function test_viewHoliday()
    {
        $JapaneseDate = new JapaneseDate();
        $this->assertEquals(
            '天皇誕生日',
            $JapaneseDate->viewHoliday(DateTime::THE_EMPEROR_S_BIRTHDAY)
        );
    }

    /**
     *
     * @access       public
     * @return      void
     * @covers       \JapaneseDate\Components\JapaneseDate::viewWeekday()
     */
    public function test_viewWeekday()
    {
        $JapaneseDate = new JapaneseDate();
        $this->assertEquals(
            '日',
            $JapaneseDate->viewWeekday(0)
        );

        $this->assertEquals(
            '日',
            $JapaneseDate->viewWeekday(7)
        );
    }

    /**
     * @covers \JapaneseDate\Components\JapaneseDate::getDayByWeekly()
     */
    public function test_getDayByWeekly()
    {
        $JapaneseDate = new JapaneseDate();
        $res = $JapaneseDate->getDayByWeekly(2016, 6, DateTime::SUNDAY, 1, $timezone = null);
        $this->assertEquals(5, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::SUNDAY, 1, $timezone = null);
        $this->assertEquals(1, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 6, DateTime::SUNDAY, 2, $timezone = null);
        $this->assertEquals(5 + 7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::SUNDAY, 2, $timezone = null);
        $this->assertEquals(1 + 7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 6, DateTime::MONDAY, 1, $timezone = null);
        $this->assertEquals(6, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::MONDAY, 1, $timezone = null);
        $this->assertEquals(2, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 6, DateTime::MONDAY, 2, $timezone = null);
        $this->assertEquals(6 + 7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::MONDAY, 2, $timezone = null);
        $this->assertEquals(2 + 7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 6, DateTime::TUESDAY, 1, $timezone = null);
        $this->assertEquals(7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::TUESDAY, 1, $timezone = null);
        $this->assertEquals(3, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 6, DateTime::TUESDAY, 2, $timezone = null);
        $this->assertEquals(7 + 7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::TUESDAY, 2, $timezone = null);
        $this->assertEquals(3 + 7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::WEDNESDAY, 1, $timezone = null);
        $this->assertEquals(4, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::WEDNESDAY, 2, $timezone = null);
        $this->assertEquals(4 + 7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::THURSDAY, 1, $timezone = null);
        $this->assertEquals(5, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::THURSDAY, 2, $timezone = null);
        $this->assertEquals(5 + 7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::FRIDAY, 1, $timezone = null);
        $this->assertEquals(6, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::FRIDAY, 2, $timezone = null);
        $this->assertEquals(6 + 7, $res);

        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::SATURDAY, 1, $timezone = null);
        $this->assertEquals(7, $res);
        $res = $JapaneseDate->getDayByWeekly(2016, 5, DateTime::SATURDAY, 2, $timezone = null);
        $this->assertEquals(7 + 7, $res);
    }

    /**
     * @covers \JapaneseDate\Components\JapaneseDate::getDayByWeekly()
     */
    public function test_getDayByWeekly_error()
    {
        $this->expectException(ErrorException::class);
        $JapaneseDate = new JapaneseDate();
        $JapaneseDate->getDayByWeekly(2018, 3, 100, 3);
    }

    /**
     * 1月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getJanuaryHoliday()
     */
    public function test_getJanuaryHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2000', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(1, $res);
        $this->assertArrayHasKey(10, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('元旦', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('成人の日', $JapaneseDate->viewHoliday($res[10]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['1999', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(1, $res);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('元旦', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('成人の日', $JapaneseDate->viewHoliday($res[15]));
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getJanuaryHoliday()
     */
    public function test_getJanuaryHolidayTransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['1978', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);

        $this->assertEquals('元旦', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[2]));
        $this->assertEquals('成人の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['1984', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['1989', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['1995', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(4, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2006', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2012', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2017', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2023', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2034', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2040', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJanuaryHoliday', ['2045', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(2, $res);
        $this->assertCount(3, $res);
    }

    /**
     * 2月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getFebruaryHoliday()
     */
    public function test_getFebruaryHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2016', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));

        // 境界値のチェック。たまたま振替休日なので、振替休日のテストでもテストされるけど一応
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2018', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2030', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['1989', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('昭和天皇の大喪の礼', $JapaneseDate->viewHoliday($res[24]));
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getFebruaryHoliday()
     */
    public function test_getFebruaryHolidayTransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['1979', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertEquals('建国記念の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));
        $this->assertCount(2, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['1996', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2001', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2007', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2018', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(2, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2024', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(3, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2029', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2035', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(3, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2046', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2020', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getFebruaryHoliday', ['2053', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));
    }

    /**
     * 3月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getMarchHoliday()
     */
    public function test_getMarchHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('春分の日', $JapaneseDate->viewHoliday($res[21]));
    }

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getMarchHoliday()
     */
    public function test_getMarchHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['1988', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('春分の日', $JapaneseDate->viewHoliday($res[20]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[21]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2005', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2016', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2033', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2044', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2050', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['1982', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['1999', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2010', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMarchHoliday', ['2027', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[22]));
    }

    /**
     * 4月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getAprilHoliday()
     */
    public function test_getAprilHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1959', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(29, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('皇太子明仁親王の結婚の儀', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2007', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2006', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1989', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1988', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
    }

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getAprilHoliday()
     */
    public function test_getAprilHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1973', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1979', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1984', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2001', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2007', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2012', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2018', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2029', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2035', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2040', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2046', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[30]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAprilHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(29, $res);
        $this->assertArrayHasKey(30, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('昭和の日', $JapaneseDate->viewHoliday($res[29]));
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[30]));
    }

    /**
     * 5月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getMayHoliday()
     */
    public function test_getMayHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2016', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1982', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));

        // 振替休日
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(1, $res);
        $this->assertArrayHasKey(2, $res);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertArrayHasKey(6, $res);
        $this->assertCount(6, $res);
        $this->assertEquals('天皇の即位の日', $JapaneseDate->viewHoliday($res[1]));
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[2]));
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[6]));
    }

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getMayHoliday()
     */
    public function test_getMayHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertArrayHasKey(6, $res);
        $this->assertCount(4, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('みどりの日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[6]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1981', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1992', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(5, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('憲法記念日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $this->assertEquals('こどもの日', $JapaneseDate->viewHoliday($res[5]));
    }

    /**
     * 6月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getJuneHoliday()
     */
    public function test_getJuneHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJuneHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJuneHoliday', ['1993', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(1, $res);
        $this->assertArrayHasKey(9, $res);
        $this->assertEquals('皇太子徳仁親王の結婚の儀', $JapaneseDate->viewHoliday($res[9]));
    }

    /**
     * 7月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getJulyHoliday()
     */
    public function test_getJulyHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['1995', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['1994', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['1996', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2002', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2013', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2024', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2030', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2041', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2047', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[15]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2007', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2012', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2018', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2029', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2035', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2040', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2046', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[16]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2006', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2017', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2023', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2028', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2034', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2045', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(17, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[17]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2005', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2011', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2016', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2022', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2033', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2039', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2044', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2050', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2004', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2010', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2022', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(18, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[18]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2027', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2032', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2038', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2049', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(19, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[19]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2009', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2020', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('スポーツの日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2021', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[22]));
        $this->assertEquals('スポーツの日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2026', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2037', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2043', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2048', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2003', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2008', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2014', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2025', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2031', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2036', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['2042', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[21]));
    }

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getJulyHoliday()
     */
    public function test_getJulyHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getJulyHoliday', ['1997', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(21, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('海の日', $JapaneseDate->viewHoliday($res[20]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[21]));
    }

    /**
     * 8月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getAugustHoliday()
     */
    public function test_getAugustHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2016', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2020', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[10]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2021', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(8, $res);
        $this->assertArrayHasKey(9, $res);
        $this->assertCount(2, $res);

        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[8]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[9]));
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getAugustHoliday()
     */
    public function test_getAugustHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2024', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2030', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2041', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getAugustHoliday', ['2047', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('山の日', $JapaneseDate->viewHoliday($res[11]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[12]));
    }

    /**
     * 国民の休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getMayHoliday()
     * @covers       \JapaneseDate\Components\JapaneseDate::getSeptemberHoliday()
     */
    public function test_nationalHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1988', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1989', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1991', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1993', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1994', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1995', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1996', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1999', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2000', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2001', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2002', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2004', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2005', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2006', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2032', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2049', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2060', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2077', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2088', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2094', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2009', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2026', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2037', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2043', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2054', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        /*
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', array('2065', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        */
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2071', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2099', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
    }

    /**
     * 9月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getSeptemberHoliday()
     */
    public function test_getSeptemberHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1965', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1966', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2002', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2003', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2004', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(20, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[20]));
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getSeptemberHoliday()
     */
    public function test_getSeptemberHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1974', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1985', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1991', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1996', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2002', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(15, $res);
        $this->assertArrayHasKey(16, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('敬老の日', $JapaneseDate->viewHoliday($res[15]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[16]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2024', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[22]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1973', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1984', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2001', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2007', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2018', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2029', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2035', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2046', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('秋分の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));
    }

    /**
     * 10月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getOctoberHoliday()
     */
    public function test_getOctoberHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['1965', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['1966', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['2000', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(9, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[9]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(14, $res);
        $this->assertArrayHasKey(22, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[14]));
        $this->assertEquals('即位礼正殿の儀', $JapaneseDate->viewHoliday($res[22]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['2020', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['2021', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['2022', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('スポーツの日', $JapaneseDate->viewHoliday($res[10]));
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getOctoberHoliday()
     */
    public function test_getOctoberHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['1976', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['1982', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['1993', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getOctoberHoliday', ['1999', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(10, $res);
        $this->assertArrayHasKey(11, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('体育の日', $JapaneseDate->viewHoliday($res[10]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[11]));
    }

    /**
     * 11月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getNovemberHoliday()
     */
    public function test_getNovemberHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(12, $res);
        $this->assertArrayHasKey(23, $res);

        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('即位礼正殿の儀', $JapaneseDate->viewHoliday($res[12]));
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getNovemberHoliday()
     */
    public function test_getNovemberHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1974', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1985', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1991', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1996', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2002', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2013', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2024', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2030', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2041', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2047', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(4, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('文化の日', $JapaneseDate->viewHoliday($res[3]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[4]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1975', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1980', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1986', $JapaneseDateTime->getTimezone()]);

        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['1997', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2003', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2008', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2014', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2025', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2031', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2036', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getNovemberHoliday', ['2042', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(3, $res);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(3, $res);
        $this->assertEquals('勤労感謝の日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));
    }

    /**
     * 12月
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getDecemberHoliday()
     */
    public function test_getDecemberHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertCount(1, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2019', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);
    }

    /** @noinspection PhpMethodNamingConventionInspection */

    /**
     * 振替休日
     *
     * @access       public
     * @param JapaneseDate $JapaneseDate
     * @param DateTime $JapaneseDateTime
     * @return      void
     * @dataProvider createTestObject
     * @covers       \JapaneseDate\Components\JapaneseDate::getDecemberHoliday()
     */
    public function test_getDecemberHoliday_TransferHoliday(JapaneseDate $JapaneseDate, DateTime $JapaneseDateTime)
    {
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2001', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2007', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2012', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2018', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(23, $res);
        $this->assertArrayHasKey(24, $res);
        $this->assertCount(2, $res);
        $this->assertEquals('天皇誕生日', $JapaneseDate->viewHoliday($res[23]));
        $this->assertEquals('振替休日', $JapaneseDate->viewHoliday($res[24]));

        // 2019年以降最初の振替休日（天皇誕生日がなくなってるので振替なし）
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getDecemberHoliday', ['2029', $JapaneseDateTime->getTimezone()]);
        $this->assertCount(0, $res);
    }

    /**
     * @covers \JapaneseDate\Components\JapaneseDate::getDay()
     */
    public function test_getDay()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        $test_date_time = $FakerGenerator->dateTime();

        $JapaneseDate = new JapaneseDate();

        $res = $this->invokeExecuteMethod(
            $JapaneseDate,
            'getDay',
            [$test_date_time->format('Y-m-d H:i:s'), null]
        );

        $this->assertEquals($test_date_time->format('d'), $res);
    }

    /**
     *
     * @covers \JapaneseDate\Components\JapaneseDate::getWeekday()
     */
    public function test_getWeekday()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        $test_date_time = $FakerGenerator->dateTime();

        $JapaneseDate = new JapaneseDate();

        $res = $this->invokeExecuteMethod(
            $JapaneseDate,
            'getWeekday',
            [$test_date_time->format('Y-m-d H:i:s'), null]
        );

        $this->assertEquals($test_date_time->format('w'), $res);
    }

    /**
     * 国民の休日
     *
     * @access      public
     * @return      void
     * @covers      \JapaneseDate\DateTime
     * @covers      \JapaneseDate\Components\JapaneseDate
     */
    public function test_nationalHolidayTest()
    {
        $JapaneseDate = JapaneseDate::factory();
        $JapaneseDateTime = DateTime::factory('2018-03-01');

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1988', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1989', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1990', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1991', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1993', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1994', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1995', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1996', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['1999', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2000', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2001', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2002', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2004', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2005', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getMayHoliday', ['2006', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(4, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[4]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2032', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2049', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2060', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2077', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2088', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2094', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(21, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[21]));

        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2009', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2015', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2026', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2037', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2043', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2054', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        /*
        $res = $this->call($JapaneseDate, 'getSeptemberHoliday', array('2065', $JapaneseDateTime->getTimezone()));
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        */
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2071', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
        $res = $this->invokeExecuteMethod($JapaneseDate, 'getSeptemberHoliday', ['2099', $JapaneseDateTime->getTimezone()]);
        $this->assertArrayHasKey(22, $res);
        $this->assertEquals('国民の休日', $JapaneseDate->viewHoliday($res[22]));
    }
}
