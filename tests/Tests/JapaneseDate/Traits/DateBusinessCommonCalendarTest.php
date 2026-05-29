<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Calendar の営業日カレンダー機能テスト
 */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Calendar;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use JapaneseDate\Exceptions\NativeDateTimeException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \JapaneseDate\Calendar
 * @covers \JapaneseDate\Components\BusinessCalendar
 * @covers \JapaneseDate\DateBusiness
 * @covers \JapaneseDate\Traits\DateBusinessCommon
 */
class DateBusinessCommonCalendarTest extends TestCase
{
    use SetPropertyTrait;
    protected function setUp(): void
    {
        BusinessCalendar::resetAll();
    }
    protected function tearDown(): void
    {
        BusinessCalendar::resetAll();
    }
    public function test_isBusinessDayByConfig_weekday(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    public function test_isBusinessDayByConfig_saturday(): void
    {
        $calendar = new Calendar('2026-05-30'); // 土曜
        $this->assertFalse($calendar->isBusinessDayByConfig());
    }
    public function test_isBusinessDayByConfig_with_specific_date(): void
    {
        $calendar = new Calendar('2026-05-25');
        $saturday = DateTime::factory('2026-05-30');
        $this->assertFalse($calendar->isBusinessDayByConfig($saturday));
    }
    public function test_isBusinessDayByConfig_with_instance_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-25', '臨時休業');
        $calendar = new Calendar('2026-05-25');
        $calendar->setBusinessConfig($config);
        $this->assertFalse($calendar->isBusinessDayByConfig());
    }
    public function test_getBusinessDaysBySpan_basic(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $result = $calendar->getBusinessDaysBySpan('2026-05-31');

        $dates = array_map(fn($dt) => $dt->format('Y-m-d'), $result);
        $this->assertContains('2026-05-25', $dates);
        $this->assertContains('2026-05-26', $dates);
        $this->assertContains('2026-05-27', $dates);
        $this->assertContains('2026-05-28', $dates);
        $this->assertContains('2026-05-29', $dates);
        $this->assertNotContains('2026-05-30', $dates); // 土
        $this->assertNotContains('2026-05-31', $dates); // 日
        $this->assertCount(5, $dates);
    }
    public function test_getBusinessDaysBySpan_with_closing_date(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業');
        $calendar = new Calendar('2026-05-25');
        $calendar->setBusinessConfig($config);

        $result = $calendar->getBusinessDaysBySpan('2026-05-29');
        $this->assertCount(4, $result);
    }
    public function test_getBusinessDaysByLimit_basic(): void
    {
        $calendar = new Calendar('2026-05-25'); // 月曜
        $result = $calendar->getBusinessDaysByLimit(5);

        $this->assertCount(5, $result);
        $this->assertSame('2026-05-25', $result[0]->format('Y-m-d'));
        $this->assertSame('2026-05-29', $result[4]->format('Y-m-d'));
    }
    public function test_getBusinessDaysByLimit_skips_weekends(): void
    {
        $calendar = new Calendar('2026-05-29'); // 金曜
        $result = $calendar->getBusinessDaysByLimit(2);

        $dates = array_map(fn($dt) => $dt->format('Y-m-d'), $result);
        $this->assertSame('2026-05-29', $dates[0]); // 金曜
        $this->assertSame('2026-06-01', $dates[1]); // 月曜（土日スキップ）
    }
    public function test_getBusinessDaysByLimit_with_closing_date(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業');
        $calendar = new Calendar('2026-05-25');
        $calendar->setBusinessConfig($config);

        $result = $calendar->getBusinessDaysByLimit(4);
        $dates = array_map(fn($dt) => $dt->format('Y-m-d'), $result);

        $this->assertNotContains('2026-05-27', $dates); // 臨時休業
        $this->assertContains('2026-05-28', $dates);
        $this->assertContains('2026-05-29', $dates);
    }
    public function test_BusinessCalendar_trait_on_Calendar(): void
    {
        $calendar = new Calendar('2026-05-25');
        $this->assertNull($calendar->getBusinessConfig());

        $config = new DateBusiness();
        $calendar->setBusinessConfig($config);
        $this->assertSame($config, $calendar->getBusinessConfig());

        $calendar->setBusinessConfig(null);
        $this->assertNull($calendar->getBusinessConfig());
    }
    public function test_setClosingDay_on_calendar(): void
    {
        $calendar = new Calendar('2026-08-14');
        $calendar->setClosingDay('2026-08-14', '夏期休暇');
        $this->assertFalse($calendar->isBusinessDayByConfig());
    }
    public function test_setOpenDay_on_calendar(): void
    {
        $calendar = new Calendar('2026-05-30'); // 土曜
        $calendar->setOpenDay('2026-05-30');
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    public function test_getBusinessDaysBySpan_with_global_config(): void
    {
        $globalConfig = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', 'グローバル臨時休業');
        BusinessCalendar::setGlobalConfig($globalConfig);

        $calendar = new Calendar('2026-05-25');
        $result = $calendar->getBusinessDaysBySpan('2026-05-29');
        $dates = array_map(fn($dt) => $dt->format('Y-m-d'), $result);
        $this->assertNotContains('2026-05-27', $dates);
        $this->assertCount(4, $dates);
    }
    public function test_getBusinessDaysByLimit_zero(): void
    {
        $calendar = new Calendar('2026-05-25');
        $result = $calendar->getBusinessDaysByLimit(0);
        $this->assertCount(0, $result);
    }
    public function test_getBusinessDaysByLimit_throws_NativeDateTimeException(): void
    {
        $calendar = new Calendar('2026-05-25');
        // add() が必ず例外を投げる DateTime を注入する
        $throwing = new ThrowingDateTimeForBusinessLimit('2026-05-25');
        $this->setProperty($calendar, 'start_time_stamp', $throwing);

        $this->expectException(NativeDateTimeException::class);
        $calendar->getBusinessDaysByLimit(1);
    }
    // --- DateBusinessCommon ショートカット（Calendar 固有ルート） ---
    public function test_setClosingWeekdays_on_calendar(): void
    {
        // 月曜（1）を休業にして判定
        $calendar = new Calendar('2026-05-25'); // 月曜
        $calendar->setClosingWeekdays([1]);
        $this->assertFalse($calendar->isBusinessDayByConfig());
    }
    public function test_setBypassHoliday_on_calendar_false(): void
    {
        // Calendar::setBypassHoliday はクラスメソッドが Trait より優先されるため bypass API 用。
        // DateBusiness カレンダー側の祝日設定をオフにするには setBusinessConfig を使う。
        $calendar = new Calendar('2026-01-01'); // 元旦（木曜）
        $config = (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(false);
        $calendar->setBusinessConfig($config);
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    public function test_setOpenNthWeekday_on_calendar(): void
    {
        // 2026-06-13 = 第2土曜 → 営業指定で営業日になる
        $calendar = new Calendar('2026-06-13');
        $calendar->setOpenNthWeekday(6, 2);
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    public function test_setClosingNthWeekday_on_calendar(): void
    {
        // 2026-06-17 = 第3水曜 → 休業指定
        $calendar = new Calendar('2026-06-17');
        $calendar->setClosingNthWeekday(3, 3, '第3水曜定休');
        $this->assertFalse($calendar->isBusinessDayByConfig());
    }
    public function test_addOpenFilter_on_calendar(): void
    {
        // 土曜でもフィルタで営業日にする
        $calendar = new Calendar('2026-05-30'); // 土曜
        $calendar->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('Ymd') === '20260530');
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    public function test_addClosingFilter_on_calendar(): void
    {
        // 月曜でもフィルタで休業日にする
        $calendar = new Calendar('2026-05-25'); // 月曜
        $calendar->addClosingFilter(fn(\DateTimeInterface $d) => $d->format('Ymd') === '20260525', '特別休業');
        $this->assertFalse($calendar->isBusinessDayByConfig());
    }
    public function test_setBusinessMacro_on_calendar(): void
    {
        // マクロで常に営業日
        $calendar = new Calendar('2026-05-30'); // 土曜
        $calendar->setBusinessMacro(fn(\DateTimeInterface $d) => true);
        $this->assertTrue($calendar->isBusinessDayByConfig());
    }
    public function test_checkIsBusinessDay_on_calendar(): void
    {
        $calendar = new Calendar('2026-05-25');
        $saturday = DateTime::factory('2026-05-30');
        $this->assertFalse($calendar->checkIsBusinessDay($saturday));
        $this->assertTrue($calendar->checkIsBusinessDay(DateTime::factory('2026-05-25')));
    }
    public function test_checkGetBusinessDayLabel_on_calendar(): void
    {
        $calendar = new Calendar('2026-05-25');
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', '夏期休暇');
        $calendar->setBusinessConfig($config);
        $target = DateTime::factory('2026-08-14');
        $this->assertSame('夏期休暇', $calendar->checkGetBusinessDayLabel($target));
        $this->assertNull($calendar->checkGetBusinessDayLabel(DateTime::factory('2026-05-25')));
    }
    // --- checkIsBusinessDay / checkGetBusinessDayLabel の null target ブランチ ---
    // Calendar は DateTimeInterface を実装していないため、引数なしで呼ぶと $target === null になる
    public function test_checkIsBusinessDay_null_target_returns_false(): void
    {
        $calendar = new Calendar('2026-05-25');
        // 引数なし + Calendar は DateTimeInterface でない → $target === null → false
        $this->assertFalse($calendar->checkIsBusinessDay());
    }
    public function test_checkGetBusinessDayLabel_null_target_returns_null(): void
    {
        $calendar = new Calendar('2026-05-25');
        // 引数なし + Calendar は DateTimeInterface でない → $target === null → null
        $this->assertNull($calendar->checkGetBusinessDayLabel());
    }
    // --- Calendar 定数 ---
    public function test_weekday_constants(): void
    {
        $this->assertSame(0, Calendar::SUNDAY);
        $this->assertSame(1, Calendar::MONDAY);
        $this->assertSame(2, Calendar::TUESDAY);
        $this->assertSame(3, Calendar::WEDNESDAY);
        $this->assertSame(4, Calendar::THURSDAY);
        $this->assertSame(5, Calendar::FRIDAY);
        $this->assertSame(6, Calendar::SATURDAY);
    }
}

/**
 * getBusinessDaysByLimit の例外テスト用。add() が必ず例外を投げる DateTime。
 */
class ThrowingDateTimeForBusinessLimit extends DateTime
{
    #[\ReturnTypeWillChange]
    public function add($unit, $value = 1, $overflow = null): static
    {
        throw new \Exception('DateTime add failed.');
    }
}

/**
 * テスト用プロパティ設定ヘルパー（ReflectionProperty 経由）。
 */
trait SetPropertyTrait
{
    private function setProperty(object $object, string $property, mixed $value): void
    {
        $ref = new \ReflectionProperty($object, $property);
        $ref->setAccessible(true);
        $ref->setValue($object, $value);
    }
}

