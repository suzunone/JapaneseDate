<?php
/**
 * LunarDateTest.php
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

namespace Tests\JapaneseDate\Elements;

use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\LunarDate;
use JapaneseDate\Exceptions\ErrorException;
use PHPUnit\Framework\TestCase;

/**
 * Class LunarDateTest
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @covers \JapaneseDate\Elements\LunarDate
 */
class LunarDateTest extends TestCase
{
    public function test__construct()
    {
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $this->assertInstanceOf(LunarDate::class, $LunarDate);
    }

    public function test__get()
    {
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $this->assertEquals(2020, $LunarDate->year);

        $this->assertEquals(2, $LunarDate->month);

        $this->assertEquals(8, $LunarDate->day);
        $this->assertFalse($LunarDate->is_leap_month);
        $this->assertFalse($LunarDate->solar_term);

        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-20'));
        $this->assertEquals(0, $LunarDate->solar_term);
    }

    /**
     * @expectedException \JapaneseDate\Exceptions\ErrorException
     */
    public function test__get_error()
    {
        $this->expectException(ErrorException::class);
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $LunarDate->aaaaaaaaaaaa;
    }

    public function test__isset()
    {
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $this->assertTrue(isset($LunarDate->solar_term));
        $this->assertFalse(isset($LunarDate->solar_termaaa));
    }

    /**
     * @expectedException \JapaneseDate\Exceptions\ErrorException
     */
    public function test__set()
    {
        $this->expectException(ErrorException::class);
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $LunarDate->__set('is_leap_month', true);
    }
}
