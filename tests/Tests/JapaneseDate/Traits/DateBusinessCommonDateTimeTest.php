<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Traits;

use DateTimeInterface;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Traits\DateBusinessCommon;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;


/**
 * DateBusinessCommon トレイトを DateTime / DateTimeImmutable クラス経由で検証するテスト。
 *
 * isBusinessDay / getBusinessDayLabel / nextBusinessDay / previousBusinessDay /
 * shiftToClosestBusinessDayAfter / shiftToClosestBusinessDayBefore /
 * addBusinessDays / subBusinessDays などの営業日操作メソッドが
 * DateBusiness 設定・グローバル設定・各種フィルタと正しく連動することを確認する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests\Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Release 1.0.0 から利用可能
 * @covers \JapaneseDate\Traits\DateBusinessCommon
 */
class DateBusinessCommonDateTimeTest extends TestCase
{
    /**
     * DateTime::isBusinessDay() が平日を営業日と判定することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_isBusinessDay_weekday(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * DateTime::isBusinessDay() が土曜日を休業日と判定することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_isBusinessDay_saturday(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $this->assertFalse($dt->isBusinessDay());
    }
    // --- DateTime::isBusinessDay ---
    /**
     * DateTime::isBusinessDay() が祝日を休業日と判定することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_isBusinessDay_holiday(): void
    {
        $dt = DateTime::factory('2026-01-01'); // 元旦
        $this->assertFalse($dt->isBusinessDay());
    }
    /**
     * setBusinessConfig() で祝日バイパスをオフにしたとき、祝日が営業日として扱われることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_isBusinessDay_with_instance_config(): void
    {
        $dt = DateTime::factory('2026-01-01'); // 元旦（木曜）
        $config = (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(false);
        $dt->setBusinessConfig($config);
        $this->assertTrue($dt->isBusinessDay()); // 祝日設定オフ → 営業日
    }
    /**
     * DateTime::getBusinessDayLabel() が営業日のとき null を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_getBusinessDayLabel_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $this->assertNull($dt->getBusinessDayLabel());
    }
    /**
     * DateTime::getBusinessDayLabel() が休業日登録済みの日付のラベル文字列を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_getBusinessDayLabel_on_closing_date(): void
    {
        $dt = DateTime::factory('2026-08-14'); // 金曜
        $dt->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertSame('夏期休暇', $dt->getBusinessDayLabel());
    }
    // --- DateTime::getBusinessDayLabel ---
    /**
     * DateTime::nextBusinessDay() が金曜から呼ぶと土日をスキップして月曜を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_nextBusinessDay_from_friday(): void
    {
        $dt = DateTime::factory('2026-05-29'); // 金曜
        $next = $dt->nextBusinessDay();
        $this->assertSame('2026-06-01', $next->format('Y-m-d')); // 月曜（土日スキップ）
    }
    /**
     * DateTime::nextBusinessDay() が平日から呼ぶと翌営業日を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_nextBusinessDay_from_weekday(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $next = $dt->nextBusinessDay();
        $this->assertSame('2026-05-26', $next->format('Y-m-d'));
    }
    // --- DateTime::nextBusinessDay ---
    /**
     * DateTime::nextBusinessDay() が元のインスタンスを変更せず新しいインスタンスを返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_nextBusinessDay_is_clone(): void
    {
        $dt = DateTime::factory('2026-05-29');
        $next = $dt->nextBusinessDay();
        $this->assertNotSame($dt, $next);
        $this->assertSame('2026-05-29', $dt->format('Y-m-d')); // 元のインスタンスは変わらない
    }
    /**
     * DateTime::previousBusinessDay() が月曜から呼ぶと土日をスキップして前週金曜を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_previousBusinessDay_from_monday(): void
    {
        $dt = DateTime::factory('2026-06-01'); // 月曜
        $prev = $dt->previousBusinessDay();
        $this->assertSame('2026-05-29', $prev->format('Y-m-d')); // 金曜（土日スキップ）
    }
    /**
     * DateTime::previousBusinessDay() が平日から呼ぶと前営業日を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_previousBusinessDay_from_wednesday(): void
    {
        $dt = DateTime::factory('2026-05-27'); // 水曜
        $prev = $dt->previousBusinessDay();
        $this->assertSame('2026-05-26', $prev->format('Y-m-d'));
    }
    // --- DateTime::previousBusinessDay ---
    /**
     * DateTime::shiftToClosestBusinessDayAfter() が営業日のとき同日を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_shiftToClosestBusinessDayAfter_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜（営業日）
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }
    /**
     * DateTime::shiftToClosestBusinessDayAfter() が休業日のとき直後の営業日へシフトすることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_shiftToClosestBusinessDayAfter_on_holiday(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-06-01', $shifted->format('Y-m-d')); // 月曜
    }
    // --- DateTime::shiftToClosestBusinessDayAfter ---
    /**
     * DateTime::shiftToClosestBusinessDayBefore() が営業日のとき同日を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_shiftToClosestBusinessDayBefore_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜（営業日）
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }
    /**
     * DateTime::shiftToClosestBusinessDayBefore() が休業日のとき直前の営業日へシフトすることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_shiftToClosestBusinessDayBefore_on_holiday(): void
    {
        $dt = DateTime::factory('2026-05-31'); // 日曜
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-29', $shifted->format('Y-m-d')); // 金曜
    }
    // --- DateTime::shiftToClosestBusinessDayBefore ---
    /**
     * DateTime::addBusinessDays() が指定日数分の営業日を加算した日付を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_addBusinessDays(): void
    {
        $dt = DateTime::factory('2026-05-29'); // 金曜
        $result = $dt->addBusinessDays(3);
        $this->assertSame('2026-06-03', $result->format('Y-m-d')); // 月・火・水
    }
    /**
     * DateTime::addBusinessDays() に 0 を渡したとき同日を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_addBusinessDays_zero(): void
    {
        $dt = DateTime::factory('2026-05-29');
        $result = $dt->addBusinessDays(0);
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    // --- DateTime::addBusinessDays ---
    /**
     * DateTime::subBusinessDays() が指定日数分の営業日を遡った日付を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_DateTime_subBusinessDays(): void
    {
        $dt = DateTime::factory('2026-06-03'); // 水曜
        $result = $dt->subBusinessDays(3);
        $this->assertSame('2026-05-29', $result->format('Y-m-d')); // 金・木・水→金曜
    }
    /**
     * setClosingDay() で登録した日付がインスタンス設定を自動生成して休業日と判定されることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setClosingDay_creates_instance_config(): void
    {
        $dt = DateTime::factory('2026-08-14'); // 金曜
        $this->assertTrue($dt->isBusinessDay()); // 元は営業日
        $dt->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertFalse($dt->isBusinessDay());
    }
    // --- DateTime::subBusinessDays ---
    /**
     * setOpenDay() で登録した土曜日が営業日として扱われることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setOpenDay(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->setOpenDay('2026-05-30');
        $this->assertTrue($dt->isBusinessDay());
    }
    // --- BusinessCalendar Trait ショートカット ---
    /**
     * setClosingWeekdays() で指定した曜日が休業日と判定されることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setClosingWeekdays_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-26'); // 火曜
        $dt->setClosingWeekdays([2]); // 火曜を休業
        $this->assertFalse($dt->isBusinessDay());
    }
    /**
     * setBypassHoliday(false) を設定したとき祝日が営業日として扱われることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setBypassHoliday_on_trait(): void
    {
        $dt = DateTime::factory('2026-01-01'); // 元旦
        $dt->setBypassHoliday(false);
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * setOpenNthWeekday() で指定した第 N 曜日が営業日として扱われることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setOpenNthWeekday_on_trait(): void
    {
        // 2026-06-13 = 第2土曜
        $dt = DateTime::factory('2026-06-13');
        $dt->setOpenNthWeekday(6, 2);
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * setClosingNthWeekday() で指定した第 N 曜日が休業日として扱われラベルも返ることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setClosingNthWeekday_on_trait(): void
    {
        // 2026-06-17 = 第3水曜
        $dt = DateTime::factory('2026-06-17');
        $dt->setClosingNthWeekday(3, 3, '定休日');
        $this->assertFalse($dt->isBusinessDay());
        $this->assertSame('定休日', $dt->getBusinessDayLabel());
    }
    /**
     * addOpenFilter() で登録したコールバックが休業日を営業日として上書き判定することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_addOpenFilter_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->addOpenFilter(function (DateTimeInterface $d) {
            return $d->format('Ymd') === '20260530';
        });
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * addClosingFilter() で登録したコールバックが営業日を休業日として上書き判定することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_addClosingFilter_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $dt->addClosingFilter(function (DateTimeInterface $d) {
            return $d->format('Ymd') === '20260525';
        }, '特別休業');
        $this->assertFalse($dt->isBusinessDay());
        $this->assertSame('特別休業', $dt->getBusinessDayLabel());
    }
    /**
     * setBusinessMacro() で登録したマクロが営業日判定の最優先ロジックとして機能することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setBusinessMacro_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->setBusinessMacro(function (DateTimeInterface $d) {
            return true;
        });
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * setBusinessMacro(null) でマクロを解除すると元の営業日判定ルールに戻ることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setBusinessMacro_null_removes_macro(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->setBusinessMacro(function (DateTimeInterface $d) {
            return true;
        });
        $dt->setBusinessMacro(null);
        $this->assertFalse($dt->isBusinessDay()); // 土曜なので再び休業
    }
    /**
     * getBusinessConfig() が初期状態で null を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_getBusinessConfig_returns_null_initially(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $this->assertNull($dt->getBusinessConfig());
    }
    /**
     * setBusinessConfig() で設定した DateBusiness インスタンスを getBusinessConfig() で取得できることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setBusinessConfig_and_getBusinessConfig(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $config = new DateBusiness();
        $dt->setBusinessConfig($config);
        $this->assertSame($config, $dt->getBusinessConfig());
    }
    /**
     * setBusinessConfig(null) でインスタンス設定を削除すると getBusinessConfig() が null を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_setBusinessConfig_null_removes(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $config = new DateBusiness();
        $dt->setBusinessConfig($config);
        $dt->setBusinessConfig(null);
        $this->assertNull($dt->getBusinessConfig());
    }
    /**
     * DateTimeImmutable::isBusinessDay() が平日を営業日と判定することを確認する。
     *
     * @return void
     */
    public function test_DateTimeImmutable_isBusinessDay_weekday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * DateTimeImmutable::isBusinessDay() が土曜日を休業日と判定することを確認する。
     *
     * @return void
     */
    public function test_DateTimeImmutable_isBusinessDay_saturday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-30');
        $this->assertFalse($dt->isBusinessDay());
    }
    // --- DateTimeImmutable のテスト ---
    /**
     * DateTimeImmutable::getBusinessDayLabel() が営業日のとき null を返すことを確認する。
     *
     * @return void
     */
    public function test_DateTimeImmutable_getBusinessDayLabel_on_business_day(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $this->assertNull($dt->getBusinessDayLabel());
    }
    /**
     * DateTimeImmutable::nextBusinessDay() が翌営業日を返し、元のインスタンスが変化しないことを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_nextBusinessDay(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-29'); // 金曜
        $next = $dt->nextBusinessDay();
        $this->assertSame('2026-06-01', $next->format('Y-m-d'));
        $this->assertSame('2026-05-29', $dt->format('Y-m-d')); // immutable: 元は変わらない
    }
    /**
     * DateTimeImmutable::previousBusinessDay() が前営業日を返すことを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_previousBusinessDay(): void
    {
        $dt = DateTimeImmutable::parse('2026-06-01'); // 月曜
        $prev = $dt->previousBusinessDay();
        $this->assertSame('2026-05-29', $prev->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::shiftToClosestBusinessDayAfter() が営業日のとき同日を返すことを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_shiftToClosestBusinessDayAfter_on_business_day(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::shiftToClosestBusinessDayAfter() が土曜日のとき月曜へシフトすることを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_shiftToClosestBusinessDayAfter_on_saturday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-30');
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-06-01', $shifted->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::shiftToClosestBusinessDayBefore() が営業日のとき同日を返すことを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_shiftToClosestBusinessDayBefore_on_business_day(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::shiftToClosestBusinessDayBefore() が日曜日のとき前週金曜へシフトすることを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_shiftToClosestBusinessDayBefore_on_sunday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-31');
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-29', $shifted->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::addBusinessDays() が指定日数分の営業日を加算した日付を返すことを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_addBusinessDays(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-29');
        $result = $dt->addBusinessDays(3);
        $this->assertSame('2026-06-03', $result->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::subBusinessDays() が指定日数分の営業日を遡った日付を返すことを確認する。
     *
     * @return void
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
     */
    public function test_DateTimeImmutable_subBusinessDays(): void
    {
        $dt = DateTimeImmutable::parse('2026-06-03');
        $result = $dt->subBusinessDays(3);
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    /**
     * DateTimeImmutable::setClosingDay() が新しいインスタンスに休業日を反映して返すことを確認する。
     *
     * @return void
     * @throws \Exception
     */
    public function test_DateTimeImmutable_setClosingDay(): void
    {
        $dt = DateTimeImmutable::parse('2026-08-14');
        $dt2 = $dt->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertFalse($dt2->isBusinessDay());
    }
    /**
     * DateTimeImmutable::setBusinessConfig() が設定を反映した新しいインスタンスを返すことを確認する。
     *
     * @return void
     */
    public function test_DateTimeImmutable_trait_setBusinessConfig(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $config = (new DateBusiness())->setClosingWeekdays([1])->setBypassHoliday(false); // 月曜休み
        $dt2 = $dt->setBusinessConfig($config);
        $this->assertFalse($dt2->isBusinessDay());
    }
    /**
     * DateTimeImmutable の休業日設定を反映したインスタンスで getBusinessDayLabel() がラベルを返すことを確認する。
     *
     * @return void
     * @throws \Exception
     */
    public function test_DateTimeImmutable_getBusinessDayLabel_closing_date(): void
    {
        $dt = DateTimeImmutable::parse('2026-08-14');
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', '夏期休暇');
        $dt2 = $dt->setBusinessConfig($config);
        $this->assertSame('夏期休暇', $dt2->getBusinessDayLabel());
    }
    /**
     * BusinessCalendar::setGlobalConfig() の設定が全インスタンスの営業日判定に反映されることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_global_config_affects_all_instances(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', 'グローバル夏休み');
        BusinessCalendar::setGlobalConfig($config);

        $dt = DateTime::factory('2026-08-14'); // 金曜
        $this->assertFalse($dt->isBusinessDay());
        $this->assertSame('グローバル夏休み', $dt->getBusinessDayLabel());
    }
    /**
     * インスタンス設定がグローバル設定より優先されて営業日判定に使われることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_instance_config_overrides_global(): void
    {
        $globalConfig = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', 'グローバル夏休み');
        BusinessCalendar::setGlobalConfig($globalConfig);

        $instanceConfig = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->setBypassHoliday(true);

        $dt = DateTime::factory('2026-08-14');
        $dt->setBusinessConfig($instanceConfig);
        $this->assertTrue($dt->isBusinessDay()); // インスタンス設定では閉店日でない
    }
    // --- グローバル設定との連携 ---
    /**
     * checkIsBusinessDay() に日付を渡したとき、その日付で営業日判定を行うことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_checkIsBusinessDay_with_date(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $target = DateTime::factory('2026-05-30'); // 土曜
        $this->assertFalse($dt->checkIsBusinessDay($target));
    }
    /**
     * checkIsBusinessDay() に引数を渡さないとき、自身の日付で営業日判定を行うことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_checkIsBusinessDay_self(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $this->assertTrue($dt->checkIsBusinessDay());
    }
    // --- checkIsBusinessDay / checkGetBusinessDayLabel (Trait共通メソッド) ---
    /**
     * checkGetBusinessDayLabel() に日付を渡したとき、その日付の休業日ラベルを返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_checkGetBusinessDayLabel_with_date(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', '特別休業');
        $dt->setBusinessConfig($config);
        $target = DateTime::factory('2026-08-14');
        $this->assertSame('特別休業', $dt->checkGetBusinessDayLabel($target));
    }
    /**
     * checkGetBusinessDayLabel() に引数を渡さないとき、自身の日付で判定し営業日なら null を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_checkGetBusinessDayLabel_self(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $this->assertNull($dt->checkGetBusinessDayLabel());
    }
    /**
     * 各テスト実行前に BusinessCalendar のグローバル設定をリセットして、テスト間の干渉を防ぐ。
     *
     * @return void
     */
    protected function setUp(): void
    {
        BusinessCalendar::resetAll();
    }
    /**
     * 各テスト実行後に BusinessCalendar のグローバル設定をリセットして、後続テストへの副作用を除去する。
     *
     * @return void
     */
    protected function tearDown(): void
    {
        BusinessCalendar::resetAll();
    }
}
