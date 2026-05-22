<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/04/28 11:45
 */

namespace Test\JapaneseDate;

use JapaneseDate\DateTime;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class LunarTest
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class LunarTest extends TestCase
{
    use InvokeTrait;

    /**
     * @covers \JapaneseDate\Traits\Lunar::getMoonAge
     */
    public function test_getMoonAge()
    {
    }

    /**
     * @covers \JapaneseDate\Traits\Lunar
     * @covers \JapaneseDate\Traits\Getter::__get()
     */
    public function test_getSixWeekday()
    {
        $DateTime = DateTime::factory('2018-03-01');

        $this->assertEquals('友引', $DateTime->six_weekday_text);
        $this->assertEquals(3, $DateTime->six_weekday);
    }

    /**
     * @covers \JapaneseDate\Traits\Lunar
     * @covers \JapaneseDate\Traits\Getter::__get()
     */
    public function test_getLunarYMD()
    {
        $DateTime = DateTime::factory('2018-02-01');

        $this->assertEquals('2017', $DateTime->lunar_year);
        $this->assertEquals('12', $DateTime->lunar_month);
        $this->assertEquals('師走', $DateTime->lunar_month_text);
        $this->assertEquals('16', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2018-03-17');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('2', $DateTime->lunar_month);
        $this->assertEquals('如月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2018-03-01');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('1', $DateTime->lunar_month);
        $this->assertEquals('睦月', $DateTime->lunar_month_text);
        $this->assertEquals('14', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2016-08-03');

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('2', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('3', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('4', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2016-08-07');
        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('5', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2020-03-24');
        $this->assertEquals('2020', $DateTime->lunar_year);
        $this->assertEquals('3', $DateTime->lunar_month);
        $this->assertEquals('弥生', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);
    }

    /**
     * @covers \JapaneseDate\Traits\Lunar::isLeapMonth()
     * @covers \JapaneseDate\Traits\Getter::__get()
     */
    public function test_isLeapMonth()
    {
        $DateTime = new DateTime('2017-06-24');
        $this->assertTrue($DateTime->is_leap_month);

        $DateTime = new DateTime('2018-01-01');
        $this->assertFalse($DateTime->is_leap_month);

        $DateTime = new DateTime('2017-06-23');
        $this->assertFalse($DateTime->is_leap_month);
    }
}
