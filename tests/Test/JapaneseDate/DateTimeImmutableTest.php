<?php /** @noinspection PhpDeprecationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
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

use Carbon\Carbon;
use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class DateTimeImmutableTest
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @covers \JapaneseDate\Traits\Component
 * @covers \JapaneseDate\Traits\DateTimeImport
 */
class DateTimeImmutableTest extends TestCase
{
    /**
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @covers \JapaneseDate\DateTimeImmutable
     */
    public function testCreate_Success()
    {
        $DateTime = new DateTimeImmutable('2020-03-04');
        $DateTime2 = $DateTime->addDay();

        $this->assertEquals('2020-03-04', $DateTime->format('Y-m-d'));
        $this->assertEquals('2020-03-05', $DateTime2->format('Y-m-d'));
    }

    /**
     * @expectedException  \JapaneseDate\Exceptions\NativeDateTimeException
     * @covers \JapaneseDate\DateTimeImmutable
     */
    public function test_create_Error()
    {
        $dateTime = new DateTimeImmutable('あああああ');
    }
}
