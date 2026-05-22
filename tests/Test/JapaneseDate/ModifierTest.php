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

namespace Tests\JapaneseDate;

use JapaneseDate\DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class ModifierTest
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
class ModifierTest extends TestCase
{
    /**
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @covers       \JapaneseDate\Traits\Modifier::nextHoliday
     */
    public function test_nextHoliday()
    {
        $dateTime = new DateTime('2020-03-01');
        $res = $dateTime->nextHoliday();

        $this->assertInstanceOf(DateTime::class, $dateTime);

        $this->assertEquals('春分の日', $res->holiday_text);
        $this->assertEquals('春分の日', $dateTime->holiday_text);
        $this->assertSame($res, $dateTime);
    }

    public static function dataProviderNextSixWeek()
    {
        return [
            'equals' => [
                '2020-03-01',
                3,
                '2020-03-01',
            ],
            'lt' => [
                '2020-03-01',
                4,
                '2020-03-02',
            ],
            'gt_zero' => [
                '2020-03-01',
                0,
                '2020-03-04',
            ],
            'gt' => [
                '2020-03-01',
                1,
                '2020-03-05',
            ],
        ];
    }

    /**
     * @param string $start
     * @param int $six_weekday
     * @param string $expected
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @covers       \JapaneseDate\Traits\Modifier::nextSixWeek
     * @dataProvider dataProviderNextSixWeek
     */
    public function test_nextSixWeek(string $start, int $six_weekday, string $expected)
    {
        $dateTime = new DateTime($start);
        $this->assertEquals($six_weekday, $dateTime->nextSixWeek($six_weekday)->six_weekday);
        $this->assertEquals($expected, $dateTime->format('Y-m-d'));
    }
}
