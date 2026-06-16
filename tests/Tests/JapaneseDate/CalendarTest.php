<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpUndefinedMethodInspection */

/**
 * Calendar クラスのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Release 2018/05/09 17:10 から利用可能
 */

namespace Tests\JapaneseDate;

use DateTimeImmutable;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Faker\Provider\DateTime as FakerDateTime;
use JapaneseDate\Calendar;
use JapaneseDate\DateTime;
use JapaneseDate\Exceptions\NativeDateTimeException;
use Mockery as m;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

/**
 * Calendar クラスのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Release 1.0.0 から利用可能
 * @covers \JapaneseDate\Calendar
 * @covers \JapaneseDate\Calendar::getWorkingDay
 * @covers \JapaneseDate\Calendar::getCompareFormat
 * @covers \JapaneseDate\Calendar::isWorkingDay
 * @covers \JapaneseDate\Calendar::isBusinessDayByConfig
 * @covers \JapaneseDate\Calendar::getBusinessDaysBySpan
 * @covers \JapaneseDate\Calendar::getBusinessDaysByLimit
 */
class CalendarTest extends TestCase
{
    use InvokeTrait;
    /**
     * コンストラクタに渡した日時とタイムゾーンが内部プロパティに保持されることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \ReflectionException
     */
    public function test_construct(): void
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 基準日時として使用する日付オブジェクトを作成する
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = new DateTime($test_date_time->format('Y-m-d H:i:s'));

        $Calendar = new Calendar($test_date_time);

        // コンストラクタに渡した日時とタイムゾーンが内部状態に保持されることを確認する
        $this->assertSame(
            $test_date_time->timestamp,
            $this->invokeGetProperty($Calendar, 'start_time_stamp')->timestamp
        );
        $this->assertSame(
            $test_date_time->getTimezone()->getName(),
            $this->invokeGetProperty($Calendar, 'timezone')->getName()
        );
    }
    /**
     * getDatesOfMonth() が対象月の 1 日から月末までの DateTime 配列を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_getDatesOfMonth(): void
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 対象月を決めるための日付オブジェクトを作成する
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = DateTime::factory($test_date_time);

        $Calendar = new Calendar($test_date_time);
        $res = $Calendar->getDatesOfMonth();

        // 対象月の 1 日から月末までが DateTime 配列で返ることを確認する
        $this->assertCount($test_date_time->daysInMonth, $res);
        $this->assertEquals($test_date_time->month, $res[0]->month);
        $this->assertEquals(1, $res[0]->day);
        $this->assertInstanceOf(DateTime::class, $res[0]);
    }
    /**
     * getWorkingDayByLimit() が開始日から指定件数分の営業日をバイパス日を除外して返すことを確認する。
     *
     * @return array|null
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_getWorkingDayByLimit(): ?array
    {
        $faker = FakerFactory::create();

        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 任意の日付から指定件数の営業日を取得するための日付オブジェクトを作成する
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = DateTime::factory($test_date_time);

        // 日付指定のバイパス
        $Calendar = new Calendar('2018-05-01');
        // 20 件取得時の範囲内にある除外日
        $Calendar->addBypassDay('2018-05-10');
        $Calendar->addBypassDay('2018-05-15');

        // 20 件取得時の範囲外にある除外日
        $Calendar->addBypassDay('2018-06-01');

        $res = $Calendar->getWorkingDayByLimit(20);
        // 範囲内のバイパス日を除外しながら、開始日から 20 件分の営業日を返すことを確認する
        $this->assertCount(20, $res);
        $this->assertEquals('2018-05-01', $res[0]->format('Y-m-d'));
        $this->assertEquals('2018-05-11', $res[9]->format('Y-m-d'));
        $this->assertEquals('2018-05-16', $res[13]->format('Y-m-d'));
        $this->assertEquals('2018-05-22', $res[19]->format('Y-m-d'));

        // 範囲外も範囲内にして再計算
        $res = $Calendar->getWorkingDayByLimit(50);
        // 取得件数を増やした場合、当初は範囲外だったバイパス日も除外対象になることを確認する
        $this->assertCount(50, $res);
        $this->assertEquals('2018-05-01', $res[0]->format('Y-m-d'));
        $this->assertEquals('2018-05-11', $res[9]->format('Y-m-d'));
        $this->assertEquals('2018-05-16', $res[13]->format('Y-m-d'));
        $this->assertEquals('2018-05-31', $res[28]->format('Y-m-d'));
        $this->assertEquals('2018-06-02', $res[29]->format('Y-m-d'));

        // 任意の日付での件数指定テスト
        $Calendar = new Calendar($test_date_time);
        $lim = $faker->numberBetween(10, 1000);
        $res = $Calendar->getWorkingDayByLimit($lim);

        // 任意の開始日でも、指定件数分の営業日が開始日から返ることを確認する
        $this->assertEquals($test_date_time->format('Y-m-d'), $res[0]->format('Y-m-d'));
        $this->assertArrayHasKey(1, $res);
        $this->assertCount($lim, $res);

        return $res;
    }
    /**
     * getWorkingDayByLimit() が DateTime::add() 失敗時に NativeDateTimeException へ変換して投げることを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \ReflectionException
     */
    public function test_getWorkingDayByLimit_wrapsNativeDateTimeException(): void
    {
        $Calendar = new Calendar('2018-05-01');
        // add() が失敗する DateTime を注入し、ネイティブ例外が専用例外へ変換されることを確認する
        $this->invokeSetProperty($Calendar, 'start_time_stamp', new ThrowingDateTime('2018-05-01'));

        $this->expectException(NativeDateTimeException::class);
        $this->expectExceptionMessage('Throwing native DateInterval class construct exception.');

        $Calendar->getWorkingDayByLimit(1);
    }
    /**
     * getWorkingDay() が getWorkingDayByLimit() に処理を委譲して同じ結果を返すことを確認する。
     *
     * @param array $res
     * @depends test_getWorkingDayByLimit
     */
    public function test_getWorkingDay(array $res = []): void
    {
        $faker = FakerFactory::create();
        $lim = $faker->numberBetween(1, 1000);
        $Calendar = m::mock(Calendar::class . '[getWorkingDayByLimit]');
        $Calendar->shouldReceive('getWorkingDayByLimit')
            ->once()
            ->with($lim)
            ->andReturn($res);
        /**
         * @var Calendar $Calendar
         */
        // getWorkingDay() が getWorkingDayByLimit() に処理を委譲することを確認する
        $this->assertEquals($res, $Calendar->getWorkingDay($lim));
    }
    /**
     * getWorkingDayBySpan() が開始日から終了日までの全日付を DateTime 配列で返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_getWorkingDayBySpan(): void
    {
        $Calendar = new Calendar('2018-05-01');
        $res = $Calendar->getWorkingDayBySpan('2018-05-31');

        // 開始日から終了日までの範囲に含まれる日付がすべて返ることを確認する
        $this->assertEquals('2018-05-01', $res[0]->format('Y-m-d'));
        $this->assertEquals('2018-05-31', $res[30]->format('Y-m-d'));
        $this->assertCount(31, $res);
    }
    /**
     * getCompareFormat() が日付を Ymd 形式の整数値に変換することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \ReflectionException
     */
    public function test_getCompareFormat(): void
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // 比較用の整数値に変換する日付オブジェクトを作成する
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time = DateTime::factory($test_date_time);

        $Calendar = new Calendar();

        // 日付比較用フォーマットが Ymd の整数値になることを確認する
        $this->assertEquals(
            (int) $test_date_time->format('Ymd'),
            $this->invokeExecuteMethod($Calendar, 'getCompareFormat', [$test_date_time])
        );
    }
    /**
     * isWorkingDay() が特定日・祝日・曜日のバイパス設定を反映して営業日判定を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \ReflectionException
     */
    public function test_isWorkingDay(): void
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // バイパス対象日と比較対象日が同日にならないように 2 つの日付を作成する
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time2 = $FakerGenerator->dateTime();
        while ($test_date_time->format('Ymd') === $test_date_time2->format('Ymd')) {
            $test_date_time2 = $FakerGenerator->dateTime();
        }

        // 特定日
        $Calendar = new Calendar();
        // バイパス指定前は営業日として扱われることを確認する
        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory($test_date_time)])
        );
        $Calendar->addBypassDay($test_date_time);

        // 特定日をバイパス指定すると営業日から除外されることを確認する
        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory($test_date_time)])
        );

        // バイパスしていない別日は営業日として扱われることを確認する
        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory($test_date_time2)])
        );

        // 祝日
        $Calendar = new Calendar();

        // 祝日バイパスが無効な場合は祝日も営業日として扱われる
        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-03')])
        );

        $Calendar->setBypassHoliday(true);

        // 祝日バイパスを有効にすると祝日が営業日から除外される
        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-03')])
        );

        // 曜日
        $Calendar = new Calendar();

        // 曜日バイパスが未指定の場合は日曜日も営業日として扱われる
        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-06')])
        );

        $Calendar->addBypassWeekDay(0);

        // 日曜日をバイパス指定すると営業日から除外される
        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-06')])
        );

        // 土曜日をバイパス指定する前は営業日として扱われる
        $this->assertTrue(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-05')])
        );

        $Calendar->addBypassWeekDay(6);

        // 土曜日もバイパス指定すると営業日から除外される
        $this->assertFalse(
            $this->invokeExecuteMethod($Calendar, 'isWorkingDay', [DateTime::factory('2018-05-05')])
        );
    }
    /**
     * addBypassWeekDay() が指定した曜日番号をバイパス一覧に登録することを確認する。
     *
     * @return Calendar
     */
    public function test_addBypassWeekDay(): Calendar
    {
        $Calendar = new Calendar();

        // 初期状態では曜日バイパスが空であることを確認する
        $this->assertEquals(
            [],
            $this->invokeGetProperty($Calendar, 'bypass_week_day_arr')
        );

        $Calendar->addBypassWeekDay(0);
        // 日曜日をバイパス曜日として登録できることを確認する
        $this->assertEquals(
            [0 => true],
            $this->invokeGetProperty($Calendar, 'bypass_week_day_arr')
        );

        $Calendar->addBypassWeekDay('6');
        // 文字列で指定した土曜日も整数キーとして登録されることを確認する
        $this->assertEquals(
            [0 => true, 6 => true],
            $this->invokeGetProperty($Calendar, 'bypass_week_day_arr')
        );

        return $Calendar;
    }
    /**
     * addBypassDay() が指定した日付を Ymd 整数キーでバイパス一覧に登録することを確認する。
     *
     * @return Calendar
     */
    public function test_addBypassDay(): Calendar
    {
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);

        // バイパス日として登録する 2 つの日付が同日にならないように作成する
        $test_date_time = $FakerGenerator->dateTime();
        $test_date_time2 = $FakerGenerator->dateTime();
        while ($test_date_time->format('Ymd') === $test_date_time2->format('Ymd')) {
            $test_date_time2 = $FakerGenerator->dateTime();
        }

        $Calendar = new Calendar();

        // 初期状態では日付バイパスが空であることを確認する
        $this->assertEquals(
            [],
            $this->invokeGetProperty($Calendar, 'bypass_day_arr')
        );

        $Calendar->addBypassDay($test_date_time);
        // 1 件目の日付が Ymd の整数キーで登録されることを確認する
        $this->assertArrayHasKey(
            (int) $test_date_time->format('Ymd'),
            $this->invokeGetProperty($Calendar, 'bypass_day_arr')
        );
        $this->assertCount(1, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        $Calendar->addBypassDay($test_date_time2);
        // 2 件目の日付も追加され、登録件数が増えることを確認する
        $this->assertArrayHasKey(
            (int) $test_date_time2->format('Ymd'),
            $this->invokeGetProperty($Calendar, 'bypass_day_arr')
        );
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));

        return $Calendar;
    }
    /**
     * setBypassHoliday() が真偽値を受け取り祝日バイパスフラグを切り替えることを確認する。
     *
     * @return void
     * @throws \ReflectionException
     */
    public function test_setBypassHoliday(): void
    {
        $Calendar = new Calendar();
        // 初期状態では祝日バイパスが無効であることを確認する
        $this->assertFalse(
            $this->invokeGetProperty($Calendar, 'is_bypass_holiday')
        );

        $Calendar->setBypassHoliday(true);
        // true を指定すると祝日バイパスが有効になることを確認する
        $this->assertTrue(
            $this->invokeGetProperty($Calendar, 'is_bypass_holiday')
        );

        $Calendar->setBypassHoliday(false);
        // false を指定すると祝日バイパスが無効に戻ることを確認する
        $this->assertFalse(
            $this->invokeGetProperty($Calendar, 'is_bypass_holiday')
        );
    }
    /**
     * removeBypassDay() が登録済みの日付を削除し、未登録日の削除が件数に影響しないことを確認する。
     *
     * @param \JapaneseDate\Calendar $Calendar
     * @depends test_addBypassDay
     */
    public function test_removeBypassDay(Calendar $Calendar): void
    {
        // Depends で受け取った Calendar を他テストへ影響させないよう複製する
        $Calendar = clone $Calendar;
        $FakerGenerator = new FakerGenerator();
        $FakerGenerator->addProvider(FakerDateTime::class);
        $bypass_day_arr = $this->invokeGetProperty($Calendar, 'bypass_day_arr');
        $key = current(array_keys($bypass_day_arr));
        // 前段のテストで 2 件の日付バイパスが登録されていることを確認する
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
        // 未登録日を削除するための日付
        $test_date_time = $FakerGenerator->dateTime();
        while (isset($bypass_day_arr[(int) $test_date_time->format('Ymd')])) {
            $test_date_time = $FakerGenerator->dateTime();
        }
        // 未登録日の削除
        $Calendar->removeBypassDay($test_date_time);
        // 未登録の日付を削除しても登録件数が変わらないことを確認する
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
        // 登録済み日の削除
        $Calendar->removeBypassDay($bypass_day_arr[$key]);
        // 登録済みの日付を削除すると登録件数が減ることを確認する
        $this->assertCount(1, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
    }
    /**
     * resetBypassDay() が登録されている全日付バイパスを一括削除することを確認する。
     *
     * @param \JapaneseDate\Calendar $Calendar
     * @depends test_addBypassDay
     */
    public function test_resetBypassDay(Calendar $Calendar): void
    {
        // 前段のテストで登録された日付バイパスをまとめて削除できることを確認する
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
        $Calendar->resetBypassDay();
        $this->assertCount(0, $this->invokeGetProperty($Calendar, 'bypass_day_arr'));
    }
    /**
     * removeBypassWeekDay() が登録済みの曜日を削除し、未登録曜日の削除が件数に影響しないことを確認する。
     *
     * @param \JapaneseDate\Calendar $Calendar
     * @noinspection PhpUnused
     * @depends test_addBypassWeekDay
     */
    public function test_removeBypassWeekDay(Calendar $Calendar): void
    {
        // Depends で受け取った Calendar を他テストへ影響させないよう複製する
        $Calendar = clone $Calendar;
        // 前段のテストで 2 件の曜日バイパスが登録されていることを確認する
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
        $this->invokeGetProperty($Calendar, 'bypass_week_day_arr');
        $Calendar->removeBypassWeekDay(1);
        // 未登録の曜日を削除しても登録件数が変わらないことを確認する
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
        $Calendar->removeBypassWeekDay(0);
        // 登録済みの曜日を削除すると登録件数が減ることを確認する
        $this->assertCount(1, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
    }
    /**
     * resetBypassWeekDay() が登録されている全曜日バイパスを一括削除することを確認する。
     *
     * @param \JapaneseDate\Calendar $Calendar
     * @depends test_addBypassWeekDay
     */
    public function test_resetBypassWeekDay(Calendar $Calendar): void
    {
        $this->invokeGetProperty($Calendar, 'bypass_week_day_arr');
        // 前段のテストで登録された曜日バイパスをまとめて削除できることを確認する
        $this->assertCount(2, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
        $Calendar->resetBypassWeekDay();
        $this->assertCount(0, $this->invokeGetProperty($Calendar, 'bypass_week_day_arr'));
    }
    // -----------------------------------------------------------------------
    // isBusinessDayByConfig
    // -----------------------------------------------------------------------
    /**
     * isBusinessDayByConfig() が $date=null のとき start_time_stamp で判定することを確認する。
     */
    public function test_isBusinessDayByConfig_uses_start_when_date_is_null(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    /**
     * isBusinessDayByConfig() に明示的な日付を渡したとき、その日付で判定することを確認する。
     */
    public function test_isBusinessDayByConfig_with_explicit_date(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $saturday = new DateTimeImmutable('2026-05-30'); // 土曜

        $this->assertFalse($calendar->isBusinessDayByConfig($saturday));
    }
    // -----------------------------------------------------------------------
    // getBusinessDaysBySpan
    // -----------------------------------------------------------------------
    /**
     * getBusinessDaysBySpan() が指定期間内の営業日を返すことを確認する。
     */
    public function test_getBusinessDaysBySpan_returns_business_days(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $days = $calendar->getBusinessDaysBySpan('2026-05-31');

        // 2026-05-25(月)〜31(日) のうち営業日は月〜金の5日
        $this->assertCount(5, $days);
        $this->assertContainsOnlyInstancesOf(DateTime::class, $days);
        $this->assertSame('2026-05-25', $days[0]->format('Y-m-d'));
        $this->assertSame('2026-05-29', $days[4]->format('Y-m-d'));
    }
    // -----------------------------------------------------------------------
    // getBusinessDaysByLimit
    // -----------------------------------------------------------------------
    /**
     * getBusinessDaysByLimit() が指定件数の営業日を返すことを確認する。
     */
    public function test_getBusinessDaysByLimit_returns_specified_count(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $days = $calendar->getBusinessDaysByLimit(3);

        $this->assertCount(3, $days);
        $this->assertContainsOnlyInstancesOf(DateTime::class, $days);
        $this->assertSame('2026-05-25', $days[0]->format('Y-m-d'));
        $this->assertSame('2026-05-26', $days[1]->format('Y-m-d'));
        $this->assertSame('2026-05-27', $days[2]->format('Y-m-d'));
    }
    /**
     * getBusinessDaysByLimit() が DateTime::add() 失敗時に NativeDateTimeException を投げることを確認する。
     */
    public function test_getBusinessDaysByLimit_wraps_native_exception(): void
    {
        $this->expectException(NativeDateTimeException::class);

        $calendar = new Calendar('2026-05-25');
        $this->invokeSetProperty($calendar, 'start_time_stamp', new ThrowingDateTime('2026-05-25'));
        // 1件目を取得しようとした直後に add() が例外を投げる
        $calendar->getBusinessDaysByLimit(2);
    }
}

/**
 * DateTime::add() の失敗を再現するためのテスト用 DateTime。
 */
class ThrowingDateTime extends DateTime
{
    /**
     * 常に RuntimeException を投げることで DateTime::add() の失敗を再現する。
     *
     * @param mixed $unit
     * @param mixed $value
     * @param mixed $overflow
     * @param mixed $anchorDay
     * @return static
     * @throws \RuntimeException
     * @noinspection PhpUnused
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    #[\ReturnTypeWillChange]
    public function add(mixed $unit, mixed $value = 1, mixed $overflow = null, mixed $anchorDay = null): static
    {
        // Calendar 側で NativeDateTimeException に変換される例外を発生させる
        throw new \RuntimeException('DateTime add failed.');
    }
}
