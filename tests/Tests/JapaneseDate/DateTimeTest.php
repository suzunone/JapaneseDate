<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * ミュータブルな日時クラスのテスト
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
 * @since       2018/04/28 11:45 リリースから利用可能
 */

namespace Test\JapaneseDate;

use Carbon\Carbon;
use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\DateTime;
use JapaneseDate\Exceptions\NativeDateTimeException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * DateTime クラスのテスト
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 * @covers \JapaneseDate\Traits\Component
 * @covers \JapaneseDate\Traits\DateTimeImport
 * @covers \JapaneseDate\DateTime
 * @covers \JapaneseDate\DateTime::setLocale
 * @covers \JapaneseDate\DateTime::create
 * @covers \JapaneseDate\DateTime::__construct
 * @covers \JapaneseDate\DateTime::factory
 * @covers \JapaneseDate\DateTime::getCalendar
 */
class DateTimeTest extends TestCase
{
    use InvokeTrait;
    /**
     * ロケール設定が DateTime と Carbon の両方に反映されることを確認する
     *
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setLocale(): void
    {
        DateTime::setLocale('de');
        $this->assertEquals('de', DateTime::getLocale());
        $this->assertEquals('de', Carbon::getLocale());
        DateTime::setLocale('en');
        $this->assertEquals('en', DateTime::getLocale());
        $this->assertEquals('en', Carbon::getLocale());
    }
    /**
     * create が DateTime インスタンスを生成することを確認する
     *
     * @return void
     */
    public function test_create(): void
    {
        $date1 = DateTime::create(2018, 1, 1, 0, 0, 0);

        $this->assertInstanceOf(DateTime::class, $date1);
    }
    /**
     * 六曜定数の値が期待どおりであることを確認する
     *
     * @return void
     */
    public function test_six_weekday_constants(): void
    {
        $this->assertSame(0, DateTime::SIX_WEEKDAY_TAIAN);
        $this->assertSame(1, DateTime::SIX_WEEKDAY_SYAKKOU);
        $this->assertSame(2, DateTime::SIX_WEEKDAY_SENSYOU);
        $this->assertSame(3, DateTime::SIX_WEEKDAY_TOMOBIKI);
        $this->assertSame(4, DateTime::SIX_WEEKDAY_SENBU);
        $this->assertSame(5, DateTime::SIX_WEEKDAY_BUTSUMETSU);
    }
    /**
     * テスト用の現在日時が DateTime と Carbon の生成系メソッドに反映されることを確認する
     *
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setTestNow(): void
    {
        // テスト用日時を作成する
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
    /**
     * コンストラクタが日時オブジェクト由来の文字列と日時文字列を解釈できることを確認する
     *
     * @return void
     */
    public function test_construct(): void
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
    /**
     * factory が複数形式の入力から日時を生成できることを確認する
     *
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory(): void
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
    /**
     * ユリウス日から算出したグレゴリオ暦情報を取得できることを確認する
     *
     * @return void
     */
    public function test_getCalendar(): void
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
    /**
     * 不正な日時文字列では例外が発生することを確認する
     *
     * @return void
     */
    public function test_create_Error(): void
    {
        $this->expectException(\JapaneseDate\Exceptions\NativeDateTimeException::class);
        $this->expectException(NativeDateTimeException::class);
        $dateTime = new DateTime('あああああ');
    }
}
