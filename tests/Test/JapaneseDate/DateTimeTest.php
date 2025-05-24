<?php

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
use JapaneseDate\DateTime;
use JapaneseDate\Exceptions\NativeDateTimeException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class DateTimeTest
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
#[CoversClass(\JapaneseDate\Traits\Component::class)] #[CoversClass(\JapaneseDate\Traits\DateTimeImport::class)]
class DateTimeTest extends TestCase
{
    use InvokeTrait;

    #[Covers('setLocale')] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_setLocale()
    {
        DateTime::setLocale('de');
        $this->assertEquals('de', DateTime::getLocale());
        $this->assertEquals('de', Carbon::getLocale());

        DateTime::setLocale('en');
        $this->assertEquals('en', DateTime::getLocale());
        $this->assertEquals('en', Carbon::getLocale());
    }

    #[Covers('create')]
    public function test_create()
    {
        $date1 = DateTime::create(2018, 1, 1, 0, 0, 0);

        $this->assertInstanceOf(DateTime::class, $date1);
    }

    #[Covers('setLocale')] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_setTestNow()
    {
        // create testing date
        $knownDate = DateTime::create(2001, 5, 21, 12);
        DateTime::setTestNow($knownDate);

        $this->assertEquals('2001-05-21 12:00:00', DateTime::getTestNow());
        $this->assertEquals('2001-05-21 12:00:00', Carbon::getTestNow());

        $this->assertEquals('2001-05-21 12:00:00', DateTime::now());
        $this->assertEquals('2001-05-21 12:00:00', Carbon::now());

        $this->assertEquals('2001-05-21 12:00:00', DateTime::factory());
        $this->assertEquals('2001-05-21 12:00:00', (new DateTime()));
        $this->assertEquals('2001-05-21 12:00:00', DateTime::factory()->format('Y-m-d H:i:s'));
        $this->assertEquals('2001-05-21 12:00:00', (new DateTime())->format('Y-m-d H:i:s'));

        $this->assertEquals('2001-05-21 12:00:00', DateTime::parse('now'));
        $this->assertEquals('1 month ago', DateTime::create(2001, 4, 21, 12)->diffForHumans());

        $this->assertTrue(DateTime::hasTestNow());
        $this->assertTrue(Carbon::hasTestNow());

        DateTime::setTestNow();
        $this->assertFalse(DateTime::hasTestNow());
        $this->assertFalse(Carbon::hasTestNow());
    }

    #[Covers('__construct')]
    public function test_construct()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime = new DateTime($test_date_time->format('Y-m-d H:i:s'));
        $this->assertEquals($test_date_time->format('Y-m-d H:i:s'), $DateTime->format('Y-m-d H:i:s'));

        // 日付文字列
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('Y-m-d H:i:s');
        $DateTime = new DateTime($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('Y-m-d H:i:s'));
    }

    #[Covers('factory')] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_factory()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime = DateTime::factory($test_date_time);
        $this->assertEquals($test_date_time->format('Y-m-d H:i:s'), $DateTime->format('Y-m-d H:i:s'));
        $this->assertEquals($test_date_time->getTimestamp(), $DateTime->getTimestamp());

        // タイムスタンプ
        $test_unix_time = $FakerGenerator->unixTime('+3 year');
        $DateTime = DateTime::factory($test_unix_time);
        $this->assertEquals($test_unix_time, $DateTime->timestamp);

        // 日付文字列
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('Y-m-d H:i:s');
        $DateTime = DateTime::factory($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('Y-m-d H:i:s'));

        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('YmdHis');
        $DateTime = DateTime::factory($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('YmdHis'));
    }

    #[Covers('getCalendar')]
    public function test_getCalendar()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime = DateTime::factory($test_date_time);
        $this->assertSame(
            cal_from_jd(
                unixtojd(
                    $test_date_time->getTimestamp()
                ),
                CAL_GREGORIAN
            ),
            $DateTime->getCalendar()
        );
    }

    #[Covers(\JapaneseDate\DateTime::class)]
    public function test_create_Error()
    {
        $this->expectException(\JapaneseDate\Exceptions\NativeDateTimeException::class);
        $this->expectException(NativeDateTimeException::class);
        $dateTime = new DateTime('あああああ');
    }
}
