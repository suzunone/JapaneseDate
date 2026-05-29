<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * BusinessCalendarManager クラスのテスト
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(BusinessCalendar::class)]
#[CoversClass(DateBusiness::class)]
class BusinessCalendarTest extends TestCase
{
    protected function setUp(): void
    {
        BusinessCalendar::resetAll();
    }

    protected function tearDown(): void
    {
        BusinessCalendar::resetAll();
    }

    public function test_default_config_is_weekends_and_holidays(): void
    {
        $config = BusinessCalendar::getDefaultConfig();
        $this->assertInstanceOf(DateBusiness::class, $config);
        $this->assertArrayHasKey(0, $config->getClosingWeekdays()); // 日曜
        $this->assertArrayHasKey(6, $config->getClosingWeekdays()); // 土曜
        $this->assertTrue($config->isBypassHoliday());
    }

    public function test_global_config_null_by_default(): void
    {
        $this->assertNull(BusinessCalendar::getGlobalConfig());
    }

    public function test_setGlobalConfig_and_getGlobalConfig(): void
    {
        $config = new DateBusiness();
        BusinessCalendar::setGlobalConfig($config);
        $this->assertSame($config, BusinessCalendar::getGlobalConfig());
    }

    public function test_setGlobalConfig_null_resets(): void
    {
        $config = new DateBusiness();
        BusinessCalendar::setGlobalConfig($config);
        BusinessCalendar::setGlobalConfig(null);
        $this->assertNull(BusinessCalendar::getGlobalConfig());
    }

    public function test_setDefaultConfig(): void
    {
        $config = (new DateBusiness())->setClosingWeekdays([0])->setBypassHoliday(false);
        BusinessCalendar::setDefaultConfig($config);
        $this->assertSame($config, BusinessCalendar::getDefaultConfig());
    }

    public function test_setDefaultConfig_null_resets_to_lazy_init(): void
    {
        BusinessCalendar::setDefaultConfig(null);
        $config = BusinessCalendar::getDefaultConfig();
        $this->assertArrayHasKey(0, $config->getClosingWeekdays());
        $this->assertArrayHasKey(6, $config->getClosingWeekdays());
    }

    public function test_resolveConfig_prefers_instance_over_global(): void
    {
        $globalConfig = (new DateBusiness())->setBypassHoliday(false);
        BusinessCalendar::setGlobalConfig($globalConfig);

        $instanceConfig = (new DateBusiness())->setBypassHoliday(true);
        $resolved = BusinessCalendar::resolveConfig($instanceConfig);
        $this->assertSame($instanceConfig, $resolved);
    }

    public function test_resolveConfig_uses_global_when_no_instance(): void
    {
        $globalConfig = (new DateBusiness())->setBypassHoliday(false);
        BusinessCalendar::setGlobalConfig($globalConfig);

        $resolved = BusinessCalendar::resolveConfig(null);
        $this->assertSame($globalConfig, $resolved);
    }

    public function test_resolveConfig_uses_default_when_nothing_set(): void
    {
        $resolved = BusinessCalendar::resolveConfig(null);
        $this->assertSame(BusinessCalendar::getDefaultConfig(), $resolved);
    }

    // --- isBusinessDay のテスト ---

    public function test_weekday_is_business_day(): void
    {
        // 2026-05-25 は月曜日
        $dt = DateTime::factory('2026-05-25');
        $this->assertTrue(BusinessCalendar::isBusinessDay($dt));
    }

    public function test_saturday_is_not_business_day(): void
    {
        // 2026-05-30 は土曜日
        $dt = DateTime::factory('2026-05-30');
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt));
    }

    public function test_sunday_is_not_business_day(): void
    {
        // 2026-05-31 は日曜日
        $dt = DateTime::factory('2026-05-31');
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt));
    }

    public function test_holiday_is_not_business_day(): void
    {
        // 2026-01-01 は元旦（祝日）
        $dt = DateTime::factory('2026-01-01');
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt));
    }

    public function test_bypass_holiday_false_makes_holiday_open(): void
    {
        $config = (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(false);
        // 2026-01-01 は元旦（木曜）
        $dt = DateTime::factory('2026-01-01');
        $this->assertTrue(BusinessCalendar::isBusinessDay($dt, $config));
    }

    // 優先度3: 第XX曜日 営業指定が曜日設定を上書き
    public function test_open_nth_weekday_overrides_closing_weekday(): void
    {
        // 2026-06-13 は第2土曜（2026-06-06が第1土曜）
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6]) // 土曜は通常休み
            ->addOpenNthWeekday(6, 2);   // 第2土曜は営業

        $dt = DateTime::factory('2026-06-13'); // 第2土曜
        $this->assertTrue(BusinessCalendar::isBusinessDay($dt, $config));

        $dt2 = DateTime::factory('2026-06-06'); // 第1土曜（通常の休み）
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt2, $config));
    }

    // 優先度4: 第XX曜日 休業指定が営業指定を上書き
    public function test_closing_nth_weekday_overrides_open_nth_weekday(): void
    {
        // 第2土曜を営業指定 AND 第2土曜を休業指定 → 休業が勝つ
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addOpenNthWeekday(6, 2)
            ->addClosingNthWeekday(6, 2, '特別定休');

        $dt = DateTime::factory('2026-06-13');
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt, $config));
    }

    // 優先度5: 特定日 営業指定が休業設定を上書き
    public function test_open_date_overrides_weekday_closing(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addOpenDate('2026-06-13'); // 第2土曜を特別営業

        $dt = DateTime::factory('2026-06-13');
        $this->assertTrue(BusinessCalendar::isBusinessDay($dt, $config));
    }

    // 優先度6: 特定日 休業指定が営業指定を上書き
    public function test_closing_date_overrides_open_date(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addOpenDate('2026-05-25')     // 月曜を営業指定（これはデフォルトで営業だが）
            ->addClosingDate('2026-05-25', '臨時休業'); // 月曜を休業指定

        $dt = DateTime::factory('2026-05-25');
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt, $config));
    }

    // 優先度7: 営業指定フィルタが休業日指定を上書き
    public function test_open_filter_overrides_closing_date(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-25', '臨時休業')
            ->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('Ymd') === '20260525');

        $dt = DateTime::factory('2026-05-25');
        $this->assertTrue(BusinessCalendar::isBusinessDay($dt, $config));
    }

    // 優先度8: 休業指定フィルタが営業フィルタを上書き
    public function test_closing_filter_overrides_open_filter(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('Ymd') === '20260525')
            ->addClosingFilter(fn(\DateTimeInterface $d) => $d->format('Ymd') === '20260525', '最高優先休業');

        $dt = DateTime::factory('2026-05-25');
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt, $config));
    }

    // 優先度9: マクロが最高優先度
    public function test_macro_overrides_all(): void
    {
        // マクロが true を返せば、他のどの設定があっても営業日
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-30')
            ->setMacro(fn(\DateTimeInterface $d) => true); // 常に営業

        $saturday = DateTime::factory('2026-05-30'); // 土曜
        $this->assertTrue(BusinessCalendar::isBusinessDay($saturday, $config));
    }

    public function test_macro_false_overrides_all(): void
    {
        $config = (new DateBusiness())
            ->setMacro(fn(\DateTimeInterface $d) => false); // 常に休業

        $monday = DateTime::factory('2026-05-25');
        $this->assertFalse(BusinessCalendar::isBusinessDay($monday, $config));
    }

    // --- getClosingLabel のテスト ---

    public function test_getClosingLabel_returns_null_on_business_day(): void
    {
        $dt = DateTime::factory('2026-05-25'); // 月曜
        $this->assertNull(BusinessCalendar::getClosingLabel($dt));
    }

    public function test_getClosingLabel_returns_null_on_weekday_closing(): void
    {
        // 曜日設定にはラベルなし（null）
        $dt = DateTime::factory('2026-05-30'); // 土曜
        $this->assertNull(BusinessCalendar::getClosingLabel($dt));
    }

    public function test_getClosingLabel_from_closing_date(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', '夏期休暇'); // 金曜

        $dt = DateTime::factory('2026-08-14');
        $this->assertSame('夏期休暇', BusinessCalendar::getClosingLabel($dt, $config));
    }

    public function test_getClosingLabel_from_closing_nth_weekday(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0])
            ->addClosingNthWeekday(3, 3, '第3水曜定休');

        // 2026-06-17 は第3水曜
        $dt = DateTime::factory('2026-06-17');
        $this->assertSame('第3水曜定休', BusinessCalendar::getClosingLabel($dt, $config));
    }

    public function test_getClosingLabel_from_closing_filter(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingFilter(fn(\DateTimeInterface $d) => $d->format('Ymd') === '20260814', '夏期休暇フィルタ');

        $dt = DateTime::factory('2026-08-14'); // 金曜
        $this->assertSame('夏期休暇フィルタ', BusinessCalendar::getClosingLabel($dt, $config));
    }

    public function test_getClosingLabel_macro_returns_null(): void
    {
        $config = (new DateBusiness())
            ->setMacro(fn(\DateTimeInterface $d) => false);

        $dt = DateTime::factory('2026-05-25');
        $this->assertNull(BusinessCalendar::getClosingLabel($dt, $config));
    }

    public function test_getClosingLabel_holiday_returns_null(): void
    {
        // 祝日は DateTime::holidayText で取得するため、ラベルは null
        $dt = DateTime::factory('2026-01-01');
        $this->assertNull(BusinessCalendar::getClosingLabel($dt));
    }

    public function test_global_config_used_when_no_instance_config(): void
    {
        $globalConfig = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-08-14', 'グローバル休業');

        BusinessCalendar::setGlobalConfig($globalConfig);

        $dt = DateTime::factory('2026-08-14'); // 金曜
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt));
        $this->assertSame('グローバル休業', BusinessCalendar::getClosingLabel($dt));
    }

    public function test_resetAll(): void
    {
        $config = new DateBusiness();
        BusinessCalendar::setGlobalConfig($config);
        BusinessCalendar::setDefaultConfig($config);
        BusinessCalendar::resetAll();

        $this->assertNull(BusinessCalendar::getGlobalConfig());
        // defaultConfig は null にリセットされ、次のアクセスで再生成される
        $newDefault = BusinessCalendar::getDefaultConfig();
        $this->assertNotSame($config, $newDefault);
    }

    public function test_isBusinessDay_with_non_JapaneseDate_DateTime(): void
    {
        // JapaneseDate\DateTime 以外の DateTimeInterface でも動作する
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->setBypassHoliday(true);

        $dt = new \DateTime('2026-05-30'); // 土曜
        $this->assertFalse(BusinessCalendar::isBusinessDay($dt, $config));
    }

    /**
     * getHoliday() の catch ブランチ:
     * getTimezone() が false を返す DateTimeInterface を渡すと
     * DateTime::factory(..., false) が TypeError を投げ、catch で NO_HOLIDAY が返る。
     * よって bypassHoliday=true でも祝日扱いにならず、曜日設定のみで判定される。
     */
    public function test_getHoliday_catch_branch_returns_NO_HOLIDAY(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->setBypassHoliday(true);

        // getTimezone() が false を返す → DateTime::factory(..., false) → TypeError → catch → NO_HOLIDAY
        $badDate = new FalseTimezoneDate('2026-01-01'); // 元旦だが getTimezone()=false で祝日判定不可
        // 木曜日（weekday=4、[0,6]に含まれない）なので曜日では休業にならない
        // 祝日判定も catch により NO_HOLIDAY → 営業日
        $this->assertTrue(BusinessCalendar::isBusinessDay($badDate, $config));
    }

    /**
     * getClosingLabel() で isBypassHoliday() が false のとき、祝日チェックをスキップするブランチ。
     */
    public function test_getClosingLabel_bypass_holiday_false_skips_holiday_check(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->setBypassHoliday(false)                         // 祝日チェック OFF
            ->addClosingDate('2026-05-25', '臨時休業');       // 月曜を休業指定

        $dt = DateTime::factory('2026-05-25'); // 月曜
        // isBusinessDay は false（特定日休業） → getClosingLabel が呼ばれる
        // bypassHoliday=false → 祝日チェックブロックに入らない ← 未カバーブランチ
        $this->assertSame('臨時休業', BusinessCalendar::getClosingLabel($dt, $config));
    }
}

/**
 * getTimezone() が false を返すテスト用 DateTimeInterface 実装。
 * DateTime::factory() に渡すと TypeError が発生し、catch ブランチをカバーする。
 */
class FalseTimezoneDate extends \DateTimeImmutable
{
    /**
     * @return \DateTimeZone|false
     */
    public function getTimezone(): \DateTimeZone|bool
    {
        return false;
    }
}
