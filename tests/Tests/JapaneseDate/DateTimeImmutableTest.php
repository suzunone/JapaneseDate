<?php

/** @noinspection PhpDeprecationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/**
 * イミュータブルな日時クラスのテスト
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

use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Exceptions\NativeDateTimeException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * DateTimeImmutable クラスのテスト
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 */
#[CoversTrait(\JapaneseDate\Traits\Component::class)]
#[CoversTrait(\JapaneseDate\Traits\DateTimeImport::class)]
#[CoversClass(\JapaneseDate\DateTimeImmutable::class)]
#[CoversMethod(\JapaneseDate\DateTimeImmutable::class, 'setLocale')]
#[CoversMethod(\JapaneseDate\DateTimeImmutable::class, 'create')]
#[CoversMethod(\JapaneseDate\DateTimeImmutable::class, '__construct')]
#[CoversMethod(\JapaneseDate\DateTimeImmutable::class, 'factory')]
#[CoversMethod(\JapaneseDate\DateTimeImmutable::class, 'getCalendar')]
class DateTimeImmutableTest extends TestCase
{
    use InvokeTrait;

    /**
     * ロケール設定を変更して取得できることを確認する
     *
     * @return void
     */
    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_setLocale(): void
    {
        DateTimeImmutable::setLocale('de');
        $this->assertEquals('de', DateTimeImmutable::getLocale());

        DateTimeImmutable::setLocale('en');
        $this->assertEquals('en', DateTimeImmutable::getLocale());
    }

    /**
     * create が DateTimeImmutable インスタンスを生成することを確認する
     *
     * @return void
     */
    public function test_create(): void
    {
        $date1 = DateTimeImmutable::create(2018, 1, 1, 0, 0, 0);

        $this->assertInstanceOf(DateTimeImmutable::class, $date1);
    }

    /**
     * 六曜定数の値が期待どおりであることを確認する
     *
     * @return void
     */
    public function test_six_weekday_constants(): void
    {
        $this->assertSame(0, DateTimeImmutable::SIX_WEEKDAY_TAIAN);
        $this->assertSame(1, DateTimeImmutable::SIX_WEEKDAY_SYAKKOU);
        $this->assertSame(2, DateTimeImmutable::SIX_WEEKDAY_SENSYOU);
        $this->assertSame(3, DateTimeImmutable::SIX_WEEKDAY_TOMOBIKI);
        $this->assertSame(4, DateTimeImmutable::SIX_WEEKDAY_SENBU);
        $this->assertSame(5, DateTimeImmutable::SIX_WEEKDAY_BUTSUMETSU);
    }

    /**
     * テスト用の現在日時が生成系メソッドに反映されることを確認する
     *
     * @return void
     */
    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_setTestNow(): void
    {
        $knownDate = DateTimeImmutable::create(2001, 5, 21, 12);
        DateTimeImmutable::setTestNow($knownDate);

        $this->assertEquals('2001-05-21 12:00:00', DateTimeImmutable::getTestNow());

        $this->assertEquals('2001-05-21 12:00:00', DateTimeImmutable::now());

        $this->assertEquals('2001-05-21 12:00:00', DateTimeImmutable::factory());
        $this->assertEquals('2001-05-21 12:00:00', (new DateTimeImmutable()));
        $this->assertEquals('2001-05-21 12:00:00', DateTimeImmutable::factory()->format('Y-m-d H:i:s'));
        $this->assertEquals('2001-05-21 12:00:00', (new DateTimeImmutable())->format('Y-m-d H:i:s'));

        $this->assertEquals('2001-05-21 12:00:00', DateTimeImmutable::parse('now'));
        $this->assertEquals('1 month ago', DateTimeImmutable::create(2001, 4, 21, 12)->diffForHumans());

        $this->assertTrue(DateTimeImmutable::hasTestNow());

        DateTimeImmutable::setTestNow();
        $this->assertFalse(DateTimeImmutable::hasTestNow());
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
        $DateTime = new DateTimeImmutable($test_date_time->format('Y-m-d H:i:s'));
        $this->assertEquals($test_date_time->format('Y-m-d H:i:s'), $DateTime->format('Y-m-d H:i:s'));

        // 日付文字列
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('Y-m-d H:i:s');
        $DateTime = new DateTimeImmutable($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('Y-m-d H:i:s'));
    }

    /**
     * factory が複数形式の入力から日時を生成できることを確認する
     *
     * @return void
     */
    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_factory(): void
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 日付オブジェクト
        $test_date_time = $FakerGenerator->dateTime();
        $DateTime = DateTimeImmutable::factory($test_date_time);
        $this->assertEquals($test_date_time->format('Y-m-d H:i:s'), $DateTime->format('Y-m-d H:i:s'));
        $this->assertEquals($test_date_time->getTimestamp(), $DateTime->getTimestamp());

        // タイムスタンプ
        $test_unix_time = $FakerGenerator->unixTime('+3 year');
        $DateTime = DateTimeImmutable::factory($test_unix_time);
        $this->assertEquals($test_unix_time, $DateTime->timestamp);

        // 日付文字列
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('Y-m-d H:i:s');
        $DateTime = DateTimeImmutable::factory($test_date_time);
        $this->assertEquals($test_date_time, $DateTime->format('Y-m-d H:i:s'));

        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = $test_date_time->format('YmdHis');
        $DateTime = DateTimeImmutable::factory($test_date_time);
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
        $DateTime = DateTimeImmutable::factory($test_date_time);
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
     * addDay が元のインスタンスを変更せず新しい日時を返すことを確認する
     *
     * @return void
     * @throws NativeDateTimeException
     */
    public function testCreate_Success(): void
    {
        $DateTime = new DateTimeImmutable('2020-03-04');
        $DateTime2 = $DateTime->addDay();

        $this->assertEquals('2020-03-04', $DateTime->format('Y-m-d'));
        $this->assertEquals('2020-03-05', $DateTime2->format('Y-m-d'));
    }

    /**
     * 不正な日時文字列では例外が発生することを確認する
     *
     * @return void
     */
    public function test_create_Error(): void
    {
        $this->expectException(NativeDateTimeException::class);
        $this->expectException(NativeDateTimeException::class);
        $dateTime = new DateTimeImmutable('あああああ');
    }
}
