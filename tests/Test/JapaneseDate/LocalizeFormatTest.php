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
use JapaneseDate\DateTime;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Class LocalizeFormatTest
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
class LocalizeFormatTest extends TestCase
{
    use InvokeTrait;

    /**
     * @covers \JapaneseDate\Traits\LocalizedFormat::formatLocalizedSimple()
     * @covers \JapaneseDate\Traits\LocalizedFormat::strftimeJa()
     */
    public function test_formatLocalizedSimple()
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        $carbon = Carbon::parse($FakerGenerator->dateTime()->format('Y-m-d H:i:s'));
        $japanese_date = DateTime::factory($carbon);

        $this->assertEquals(
            $carbon->formatLocalized('%Y-%m-%d'),
            $japanese_date->formatLocalized('%Y-%m-%d')
        );

        $this->assertEquals(
            $carbon->formatLocalized('%Y-%m-%d'),
            $japanese_date->formatLocalizedSimple('%Y-%m-%d')
        );

        $this->assertEquals(
            $japanese_date->strftime('%Y-%m-%d %K'),
            $japanese_date->formatLocalized('%Y-%m-%d %#K')
        );

        $this->assertEquals(
            strftime('%Y-%m-%d %K', $japanese_date->timestamp),
            $japanese_date->formatLocalizedSimple('%Y-%m-%d %K')
        );
    }

    /**
     * @covers \JapaneseDate\Traits\LocalizedFormat::formatLocalized()
     * @covers \JapaneseDate\Traits\LocalizedFormat::strftimeJa()
     */
    public function test_formatLocalized()
    {
        $DateTime = DateTime::factory('2018-05-03');
        $this->assertSame(
            '%#123',
            $DateTime->formatLocalized('%%#123')
        );

        $this->assertSame(
            '%#o123',
            $DateTime->formatLocalized('%%#o123')
        );

        $this->assertSame(
            (string) $DateTime->oriental_zodiac,
            $DateTime->formatLocalized('%#o')
        );

        $this->assertSame(
            (string) $DateTime->oriental_zodiac_text,
            $DateTime->formatLocalized('%#O')
        );

        $this->assertSame(
            (string) $DateTime->holiday,
            $DateTime->formatLocalized('%#l')
        );

        $this->assertSame(
            (string) $DateTime->holiday_text,
            $DateTime->formatLocalized('%#L')
        );

        $this->assertSame(
            (string) $DateTime->era_name,
            $DateTime->formatLocalized('%#f')
        );

        $this->assertSame(
            (string) $DateTime->era_name_text,
            $DateTime->formatLocalized('%#F')
        );

        $this->assertSame(
            (string) $DateTime->era_year,
            $DateTime->formatLocalized('%#E')
        );

        $this->assertSame(
            (string) $DateTime->six_weekday_text,
            $DateTime->formatLocalized('%#k')
        );
        $this->assertSame(
            (string) $DateTime->six_weekday,
            $DateTime->formatLocalized('%#6')
        );

        $this->assertSame(
            (string) $DateTime->weekday_text,
            $DateTime->formatLocalized('%#K')
        );

        $this->assertSame(
            ' ' . $DateTime->format('j'),
            $DateTime->formatLocalized('%#e')
        );
        $this->assertSame(
            ' ' . $DateTime->format('n'),
            $DateTime->formatLocalized('%#g')
        );

        $this->assertSame(
            $DateTime->format('j'),
            $DateTime->formatLocalized('%#J')
        );

        $this->assertSame(
            $DateTime->month_text,
            $DateTime->formatLocalized('%#G')
        );

        $this->assertSame(
            '2018-05-03',
            $DateTime->formatLocalized('%Y-%m-%d')
        );

        $DateTime = DateTime::factory('2018-10-09');
        $this->assertSame(
            ' ' . $DateTime->format('j'),
            $DateTime->formatLocalized('%#e')
        );

        $DateTime = DateTime::factory('2018-09-10');
        $this->assertSame(
            ' ' . $DateTime->format('n'),
            $DateTime->formatLocalized('%#g')
        );

        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            '0' . $DateTime->lunar_day,
            $DateTime->formatLocalized('%#d')
        );

        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            $DateTime->lunar_day,
            $DateTime->formatLocalized('%#-d')
        );

        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            ' ' . $DateTime->lunar_day,
            $DateTime->formatLocalized('%#j')
        );

        $DateTime = DateTime::factory('2017-7-1');
        $this->assertSame(
            '閏',
            $DateTime->formatLocalized('%#u')
        );

        $DateTime = DateTime::factory('2017-7-1');
        $this->assertSame(
            '(閏)',
            $DateTime->formatLocalized('%#U')
        );

        $DateTime = DateTime::factory('2017-04-02');
        $this->assertSame(
            $DateTime->lunar_month,
            $DateTime->formatLocalized('%#-m')
        );

        $DateTime = DateTime::factory('2017-04-02');
        $this->assertSame(
            $DateTime->lunar_month_text,
            $DateTime->formatLocalized('%#b')
        );
        $this->assertSame(
            $DateTime->lunar_month_text,
            $DateTime->formatLocalized('%#h')
        );

        $DateTime = DateTime::factory('2017-04-02');
        $this->assertSame(
            '0' . $DateTime->lunar_month,
            $DateTime->formatLocalized('%#m')
        );

        $DateTime = DateTime::factory('2017-04-02');
        $this->assertSame(
            ' ' . $DateTime->lunar_month,
            $DateTime->formatLocalized('%#n')
        );

        $DateTime = DateTime::factory('2017-7-1');
        $this->assertSame(
            $DateTime->lunar_month_text . '(閏月)',
            $DateTime->formatLocalized('%#B')
        );

        $DateTime = DateTime::factory('2017-7-1');
        $this->assertMatchesRegularExpression(
            '/#v/',
            $DateTime->formatLocalized('%#v')
        );
    }

    /**
     * @covers \JapaneseDate\Traits\LocalizedFormat::strftime()
     * @covers \JapaneseDate\Traits\LocalizedFormat::strftimeJa()
     */
    public function test_strftime()
    {
        $DateTime = DateTime::factory('2018-05-03');
        $this->assertSame(
            (string) $DateTime->oriental_zodiac,
            $DateTime->strftime('%o')
        );

        $this->assertSame(
            (string) $DateTime->oriental_zodiac_text,
            $DateTime->strftime('%O')
        );

        $this->assertSame(
            (string) $DateTime->holiday,
            $DateTime->strftime('%l')
        );

        $this->assertSame(
            (string) $DateTime->holiday_text,
            $DateTime->strftime('%L')
        );

        $this->assertSame(
            (string) $DateTime->era_name,
            $DateTime->strftime('%f')
        );

        $this->assertSame(
            (string) $DateTime->era_name_text,
            $DateTime->strftime('%F')
        );

        $this->assertSame(
            (string) $DateTime->era_year,
            $DateTime->strftime('%E')
        );

        $this->assertSame(
            (string) $DateTime->six_weekday_text,
            $DateTime->strftime('%k')
        );
        $this->assertSame(
            (string) $DateTime->six_weekday,
            $DateTime->strftime('%6')
        );

        $this->assertSame(
            (string) $DateTime->weekday_text,
            $DateTime->strftime('%K')
        );

        $this->assertSame(
            ' ' . $DateTime->format('j'),
            $DateTime->strftime('%e')
        );
        $this->assertSame(
            ' ' . $DateTime->format('n'),
            $DateTime->strftime('%g')
        );

        $this->assertSame(
            $DateTime->format('j'),
            $DateTime->strftime('%J')
        );
        $this->assertSame(
            $DateTime->month_text,
            $DateTime->strftime('%G')
        );

        $this->assertSame(
            '2018-05-03',
            $DateTime->strftime('%Y-%m-%d')
        );

        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            $DateTime->format('j'),
            $DateTime->strftime('%e')
        );

        $DateTime = DateTime::factory('2018-10-10');
        $this->assertSame(
            $DateTime->format('n'),
            $DateTime->strftime('%g')
        );
    }
}
