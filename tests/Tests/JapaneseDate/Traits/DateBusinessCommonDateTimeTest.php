<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * DateTime・DateTimeImmutable の営業日機能テスト
 */

namespace Tests\JapaneseDate\Traits;

use DateTimeInterface;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Traits\DateBusinessCommon;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;

#[CoversTrait(DateBusinessCommon::class)]
class DateBusinessCommonDateTimeTest extends TestCase
{
    public function test_DateTime_isBusinessDay_weekday(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $this->assertTrue($dt->isBusinessDay());
    }

    public function test_DateTime_isBusinessDay_saturday(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $this->assertFalse($dt->isBusinessDay());
    }

    // --- DateTime::isBusinessDay ---

    public function test_DateTime_isBusinessDay_holiday(): void
    {
        $dt = DateTime::factory('2026-01-01'); // 元旦
        $this->assertFalse($dt->isBusinessDay());
    }

    public function test_DateTime_isBusinessDay_with_instance_config(): void
    {
        $dt = DateTime::factory('2026-01-01'); // 元旦（木曜）
        $config = (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(false);
        $dt->setBusinessConfig($config);
        $this->assertTrue($dt->isBusinessDay()); // 祝日設定オフ → 営業日
    }

    public function test_DateTime_getBusinessDayLabel_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $this->assertNull($dt->getBusinessDayLabel());
    }

    public function test_DateTime_getBusinessDayLabel_on_closing_date(): void
    {
        $dt = DateTime::factory('2026-08-14'); // 金曜
        $dt->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertSame('夏期休暇', $dt->getBusinessDayLabel());
    }

    // --- DateTime::getBusinessDayLabel ---

    public function test_DateTime_nextBusinessDay_from_friday(): void
    {
        $dt = DateTime::factory('2026-05-29'); // 金曜
        $next = $dt->nextBusinessDay();
        $this->assertSame('2026-06-01', $next->format('Y-m-d')); // 月曜（土日スキップ）
    }

    public function test_DateTime_nextBusinessDay_from_weekday(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $next = $dt->nextBusinessDay();
        $this->assertSame('2026-05-26', $next->format('Y-m-d'));
    }

    // --- DateTime::nextBusinessDay ---

    public function test_DateTime_nextBusinessDay_is_clone(): void
    {
        $dt = DateTime::factory('2026-05-29');
        $next = $dt->nextBusinessDay();
        $this->assertNotSame($dt, $next);
        $this->assertSame('2026-05-29', $dt->format('Y-m-d')); // 元のインスタンスは変わらない
    }

    public function test_DateTime_previousBusinessDay_from_monday(): void
    {
        $dt = DateTime::factory('2026-06-01'); // 月曜
        $prev = $dt->previousBusinessDay();
        $this->assertSame('2026-05-29', $prev->format('Y-m-d')); // 金曜（土日スキップ）
    }

    public function test_DateTime_previousBusinessDay_from_wednesday(): void
    {
        $dt = DateTime::factory('2026-05-27'); // 水曜
        $prev = $dt->previousBusinessDay();
        $this->assertSame('2026-05-26', $prev->format('Y-m-d'));
    }

    // --- DateTime::previousBusinessDay ---

    public function test_DateTime_shiftToClosestBusinessDayAfter_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜（営業日）
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }

    public function test_DateTime_shiftToClosestBusinessDayAfter_on_holiday(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-06-01', $shifted->format('Y-m-d')); // 月曜
    }

    // --- DateTime::shiftToClosestBusinessDayAfter ---

    public function test_DateTime_shiftToClosestBusinessDayBefore_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜（営業日）
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }

    public function test_DateTime_shiftToClosestBusinessDayBefore_on_holiday(): void
    {
        $dt = DateTime::factory('2026-05-31'); // 日曜
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-29', $shifted->format('Y-m-d')); // 金曜
    }

    // --- DateTime::shiftToClosestBusinessDayBefore ---

    public function test_DateTime_addBusinessDays(): void
    {
        $dt = DateTime::factory('2026-05-29'); // 金曜
        $result = $dt->addBusinessDays(3);
        $this->assertSame('2026-06-03', $result->format('Y-m-d')); // 月・火・水
    }

    public function test_DateTime_addBusinessDays_zero(): void
    {
        $dt = DateTime::factory('2026-05-29');
        $result = $dt->addBusinessDays(0);
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }

    // --- DateTime::addBusinessDays ---

    public function test_DateTime_subBusinessDays(): void
    {
        $dt = DateTime::factory('2026-06-03'); // 水曜
        $result = $dt->subBusinessDays(3);
        $this->assertSame('2026-05-29', $result->format('Y-m-d')); // 金・木・水→金曜
    }

    public function test_setClosingDay_creates_instance_config(): void
    {
        $dt = DateTime::factory('2026-08-14'); // 金曜
        $this->assertTrue($dt->isBusinessDay()); // 元は営業日
        $dt->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertFalse($dt->isBusinessDay());
    }

    // --- DateTime::subBusinessDays ---

    public function test_setOpenDay(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->setOpenDay('2026-05-30');
        $this->assertTrue($dt->isBusinessDay());
    }

    // --- BusinessCalendar Trait ショートカット ---

    public function test_setClosingWeekdays_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-26'); // 火曜
        $dt->setClosingWeekdays([2]); // 火曜を休業
        $this->assertFalse($dt->isBusinessDay());
    }

    public function test_setBypassHoliday_on_trait(): void
    {
        $dt = DateTime::factory('2026-01-01'); // 元旦
        $dt->setBypassHoliday(false);
        $this->assertTrue($dt->isBusinessDay());
    }

    public function test_setOpenNthWeekday_on_trait(): void
    {
        // 2026-06-13 = 第2土曜
        $dt = DateTime::factory('2026-06-13');
        $dt->setOpenNthWeekday(6, 2);
        $this->assertTrue($dt->isBusinessDay());
    }

    public function test_setClosingNthWeekday_on_trait(): void
    {
        // 2026-06-17 = 第3水曜
        $dt = DateTime::factory('2026-06-17');
        $dt->setClosingNthWeekday(3, 3, '定休日');
        $this->assertFalse($dt->isBusinessDay());
        $this->assertSame('定休日', $dt->getBusinessDayLabel());
    }

    public function test_addOpenFilter_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->addOpenFilter(fn(DateTimeInterface $d) => $d->format('Ymd') === '20260530');
        $this->assertTrue($dt->isBusinessDay());
    }

    public function test_addClosingFilter_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $dt->addClosingFilter(fn(DateTimeInterface $d) => $d->format('Ymd') === '20260525', '特別休業');
        $this->assertFalse($dt->isBusinessDay());
        $this->assertSame('特別休業', $dt->getBusinessDayLabel());
    }

    public function test_setBusinessMacro_on_trait(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->setBusinessMacro(fn(DateTimeInterface $d) => true);
        $this->assertTrue($dt->isBusinessDay());
    }

    public function test_setBusinessMacro_null_removes_macro(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $dt->setBusinessMacro(fn(DateTimeInterface $d) => true);
        $dt->setBusinessMacro(null);
        $this->assertFalse($dt->isBusinessDay()); // 土曜なので再び休業
    }

    public function test_getBusinessConfig_returns_null_initially(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $this->assertNull($dt->getBusinessConfig());
    }

    public function test_setBusinessConfig_and_getBusinessConfig(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $config = new DateBusiness();
        $dt->setBusinessConfig($config);
        $this->assertSame($config, $dt->getBusinessConfig());
    }

    public function test_setBusinessConfig_null_removes(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $config = new DateBusiness();
        $dt->setBusinessConfig($config);
        $dt->setBusinessConfig(null);
        $this->assertNull($dt->getBusinessConfig());
    }

    public function test_DateTimeImmutable_isBusinessDay_weekday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $this->assertTrue($dt->isBusinessDay());
    }

    public function test_DateTimeImmutable_isBusinessDay_saturday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-30');
        $this->assertFalse($dt->isBusinessDay());
    }

    // --- DateTimeImmutable のテスト ---

    public function test_DateTimeImmutable_getBusinessDayLabel_on_business_day(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $this->assertNull($dt->getBusinessDayLabel());
    }

    public function test_DateTimeImmutable_nextBusinessDay(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-29'); // 金曜
        $next = $dt->nextBusinessDay();
        $this->assertSame('2026-06-01', $next->format('Y-m-d'));
        $this->assertSame('2026-05-29', $dt->format('Y-m-d')); // immutable: 元は変わらない
    }

    public function test_DateTimeImmutable_previousBusinessDay(): void
    {
        $dt = DateTimeImmutable::parse('2026-06-01'); // 月曜
        $prev = $dt->previousBusinessDay();
        $this->assertSame('2026-05-29', $prev->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_shiftToClosestBusinessDayAfter_on_business_day(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_shiftToClosestBusinessDayAfter_on_saturday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-30');
        $shifted = $dt->shiftToClosestBusinessDayAfter();
        $this->assertSame('2026-06-01', $shifted->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_shiftToClosestBusinessDayBefore_on_business_day(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_shiftToClosestBusinessDayBefore_on_sunday(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-31');
        $shifted = $dt->shiftToClosestBusinessDayBefore();
        $this->assertSame('2026-05-29', $shifted->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_addBusinessDays(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-29');
        $result = $dt->addBusinessDays(3);
        $this->assertSame('2026-06-03', $result->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_subBusinessDays(): void
    {
        $dt = DateTimeImmutable::parse('2026-06-03');
        $result = $dt->subBusinessDays(3);
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }

    public function test_DateTimeImmutable_setClosingDay(): void
    {
        $dt = DateTimeImmutable::parse('2026-08-14');
        $dt2 = $dt->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertFalse($dt2->isBusinessDay());
    }

    public function test_DateTimeImmutable_trait_setBusinessConfig(): void
    {
        $dt = DateTimeImmutable::parse('2026-05-25');
        $config = (new DateBusiness())->setClosingWeekdays([1])->setBypassHoliday(false); // 月曜休み
        $dt2 = $dt->setBusinessConfig($config);
        $this->assertFalse($dt2->isBusinessDay());
    }

    public function test_DateTimeImmutable_getBusinessDayLabel_closing_date(): void
    {
        $dt = DateTimeImmutable::parse('2026-08-14');
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', '夏期休暇');
        $dt2 = $dt->setBusinessConfig($config);
        $this->assertSame('夏期休暇', $dt2->getBusinessDayLabel());
    }

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

    public function test_checkIsBusinessDay_with_date(): void
    {
        $dt = DateTime::factory('2026-05-25');
        $target = DateTime::factory('2026-05-30'); // 土曜
        $this->assertFalse($dt->checkIsBusinessDay($target));
    }

    public function test_checkIsBusinessDay_self(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $this->assertTrue($dt->checkIsBusinessDay());
    }

    // --- checkIsBusinessDay / checkGetBusinessDayLabel (Trait共通メソッド) ---

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

    public function test_checkGetBusinessDayLabel_self(): void
    {
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $this->assertNull($dt->checkGetBusinessDayLabel());
    }

    protected function setUp(): void
    {
        BusinessCalendar::resetAll();
    }

    protected function tearDown(): void
    {
        BusinessCalendar::resetAll();
    }
}
