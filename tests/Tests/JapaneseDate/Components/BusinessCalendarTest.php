<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * BusinessCalendarManager クラスのテスト
 */

namespace Tests\JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @covers \JapaneseDate\Components\BusinessCalendar
 * @covers \JapaneseDate\DateBusiness
 */
class BusinessCalendarTest extends TestCase
{
    /**
     * resolveConfig がインスタンス設定・グローバル設定・デフォルト設定を優先順に返すことを確認するケースを返す。
     *
     * @return array<string, array{string}>
     */
    public static function resolveConfigDataProvider(): array
    {
        return [
            'インスタンス設定を優先' => ['instance'],
            'インスタンス設定がなければグローバル設定' => ['global'],
            'どちらもなければデフォルト設定' => ['default'],
        ];
    }
    /**
     * 営業日判定が平日・週末・祝日・祝日無視設定を正しく扱うことを確認するケースを返す。
     *
     * @return array<string, array{string, bool, string}>
     */
    public static function businessDayDataProvider(): array
    {
        return [
            '平日' => ['2026-05-25', true, 'default'],
            '土曜日' => ['2026-05-30', false, 'default'],
            '日曜日' => ['2026-05-31', false, 'default'],
            '祝日' => ['2026-01-01', false, 'default'],
            '祝日無視設定では祝日も営業日' => ['2026-01-01', true, 'ignore_holiday'],
        ];
    }
    /**
     * 営業日判定の優先度ルールが期待どおりに上書きされることを確認するケースを返す。
     *
     * @return array<string, array{string, string, bool}>
     */
    public static function businessDayPriorityDataProvider(): array
    {
        return [
            '第2土曜営業指定は曜日休業を上書き' => ['open_nth_weekday', '2026-06-13', true],
            '第2土曜営業指定の対象外土曜は休業' => ['open_nth_weekday', '2026-06-06', false],
            '第2土曜休業指定は営業指定を上書き' => ['closing_nth_weekday', '2026-06-13', false],
            '特定日営業指定は曜日休業を上書き' => ['open_date', '2026-06-13', true],
            '特定日休業指定は営業指定を上書き' => ['closing_date', '2026-05-25', false],
            '営業フィルタは特定日休業を上書き' => ['open_filter', '2026-05-25', true],
            '休業フィルタは営業フィルタを上書き' => ['closing_filter', '2026-05-25', false],
            'true を返すマクロはすべて営業日にする' => ['macro_true', '2026-05-30', true],
            'false を返すマクロはすべて休業日にする' => ['macro_false', '2026-05-25', false],
        ];
    }
    /**
     * 休業ラベルが存在しないケースで null を返すことを確認するケースを返す。
     *
     * @return array<string, array{string, string}>
     */
    public static function closingLabelNullDataProvider(): array
    {
        return [
            '営業日' => ['business_day', '2026-05-25'],
            '曜日休業' => ['weekday_closing', '2026-05-30'],
            'マクロ休業' => ['macro_false', '2026-05-25'],
            '祝日' => ['holiday', '2026-01-01'],
        ];
    }
    /**
     * 休業ラベルが休業設定種別ごとに取得できることを確認するケースを返す。
     *
     * @return array<string, array{string, string, string}>
     */
    public static function closingLabelDataProvider(): array
    {
        return [
            '特定日休業' => ['closing_date', '2026-08-14', '夏期休暇'],
            '第3水曜休業' => ['closing_nth_weekday', '2026-06-17', '第3水曜定休'],
            '休業フィルタ' => ['closing_filter', '2026-08-14', '夏期休暇フィルタ'],
            '祝日チェック無効時の特定日休業' => ['bypass_holiday_false', '2026-05-25', '臨時休業'],
        ];
    }
    /**
     * デフォルト設定が土日・祝日を休業日として扱うことを確認する。
     */
    public function test_default_config_is_weekends_and_holidays(): void
    {
        $config = BusinessCalendar::getDefaultConfig();
        $this->assertArrayHasKey(0, $config->getClosingWeekdays()); // 日曜
        $this->assertArrayHasKey(6, $config->getClosingWeekdays()); // 土曜
        $this->assertTrue($config->isBypassHoliday());
    }
    /**
     * 初期状態ではグローバル設定が登録されていないことを確認する。
     */
    public function test_global_config_null_by_default(): void
    {
        $this->assertNull(BusinessCalendar::getGlobalConfig());
    }
    /**
     * setGlobalConfig で登録した設定を getGlobalConfig で同一インスタンスとして取得できることを確認する。
     */
    public function test_setGlobalConfig_and_getGlobalConfig(): void
    {
        $config = new DateBusiness();
        BusinessCalendar::setGlobalConfig($config);
        $this->assertSame($config, BusinessCalendar::getGlobalConfig());
    }
    /**
     * setGlobalConfig に null を渡すとグローバル設定がリセットされることを確認する。
     */
    public function test_setGlobalConfig_null_resets(): void
    {
        $config = new DateBusiness();
        BusinessCalendar::setGlobalConfig($config);
        BusinessCalendar::setGlobalConfig(null);
        $this->assertNull(BusinessCalendar::getGlobalConfig());
    }
    /**
     * setDefaultConfig で登録した設定をデフォルト設定として取得できることを確認する。
     */
    public function test_setDefaultConfig(): void
    {
        $config = (new DateBusiness())->setClosingWeekdays([0])->setBypassHoliday(false);
        BusinessCalendar::setDefaultConfig($config);
        $this->assertSame($config, BusinessCalendar::getDefaultConfig());
    }
    /**
     * setDefaultConfig に null を渡すと、次回取得時にデフォルト設定が遅延初期化されることを確認する。
     */
    public function test_setDefaultConfig_null_resets_to_lazy_init(): void
    {
        BusinessCalendar::setDefaultConfig(null);
        $config = BusinessCalendar::getDefaultConfig();
        $this->assertArrayHasKey(0, $config->getClosingWeekdays());
        $this->assertArrayHasKey(6, $config->getClosingWeekdays());
    }
    /**
     * resolveConfig がインスタンス設定、グローバル設定、デフォルト設定の優先順で設定を解決することを確認する。
     * @dataProvider resolveConfigDataProvider
     */
    public function test_resolveConfig(string $scenario): void
    {
        $globalConfig = (new DateBusiness())->setBypassHoliday(false);
        $instanceConfig = (new DateBusiness())->setBypassHoliday(true);
        $expected = match ($scenario) {
            'instance' => $instanceConfig,
            'global' => $globalConfig,
            'default' => BusinessCalendar::getDefaultConfig(),
        };
        if ($scenario !== 'default') {
            BusinessCalendar::setGlobalConfig($globalConfig);
        }
        $resolved = BusinessCalendar::resolveConfig($scenario === 'instance' ? $instanceConfig : null);
        $this->assertSame($expected, $resolved);
    }
    /**
     * isBusinessDay が基本的な平日・週末・祝日判定と祝日無視設定を正しく反映することを確認する。
     *
     * @param string $date
     * @param bool $expected
     * @param string $configType
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @dataProvider businessDayDataProvider
     */
    public function test_isBusinessDay(string $date, bool $expected, string $configType): void
    {
        $config = match ($configType) {
            'default' => null,
            'ignore_holiday' => (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(false),
        };
        $this->assertSame($expected, BusinessCalendar::isBusinessDay(DateTime::factory($date), $config));
    }
    /**
     * 営業日判定の各優先度ルールが期待どおりに上書きされることを確認する。
     *
     * @param string $scenario
     * @param string $date
     * @param bool $expected
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @dataProvider businessDayPriorityDataProvider
     */
    public function test_isBusinessDay_priority(string $scenario, string $date, bool $expected): void
    {
        $config = $this->createPriorityConfig($scenario);
        $this->assertSame($expected, BusinessCalendar::isBusinessDay(DateTime::factory($date), $config));
    }
    /**
     * getClosingLabel がラベルのない休業理由や営業日では null を返すことを確認する。
     *
     * @param string $scenario
     * @param string $date
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @dataProvider closingLabelNullDataProvider
     */
    public function test_getClosingLabel_returns_null(string $scenario, string $date): void
    {
        $config = match ($scenario) {
            'business_day', 'weekday_closing', 'holiday' => null,
            'macro_false' => (new DateBusiness())->setMacro(fn (DateTimeInterface $d) => false),
        };
        $this->assertNull(BusinessCalendar::getClosingLabel(DateTime::factory($date), $config));
    }
    /**
     * getClosingLabel が特定日・第 N 曜日・フィルタ由来の休業ラベルを返すことを確認する。
     *
     * @param string $scenario
     * @param string $date
     * @param string $expected
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @dataProvider closingLabelDataProvider
     */
    public function test_getClosingLabel(string $scenario, string $date, string $expected): void
    {
        $config = match ($scenario) {
            'closing_date' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addClosingDate('2026-08-14', '夏期休暇'),
            'closing_nth_weekday' => (new DateBusiness())
                ->setClosingWeekdays([0])
                ->addClosingNthWeekday(3, 3, '第3水曜定休'),
            'closing_filter' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addClosingFilter(fn (DateTimeInterface $d) => $d->format('Ymd') === '20260814', '夏期休暇フィルタ'),
            'bypass_holiday_false' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->setBypassHoliday(false)
                ->addClosingDate('2026-05-25', '臨時休業'),
        };
        $this->assertSame($expected, BusinessCalendar::getClosingLabel(DateTime::factory($date), $config));
    }
    /**
     * インスタンス設定がない場合、営業日判定と休業ラベル取得にグローバル設定が使われることを確認する。
     *
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
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
    /**
     * resetAll がグローバル設定とデフォルト設定をリセットすることを確認する。
     */
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
    /**
     * JapaneseDate\DateTime 以外の DateTimeInterface でも曜日ベースの営業日判定ができることを確認する。
     */
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
     * 各テストの開始前にグローバル設定とデフォルト設定を初期状態へ戻す。
     */
    protected function setUp(): void
    {
        BusinessCalendar::resetAll();
    }
    /**
     * テスト間でグローバル設定とデフォルト設定が共有されないようにリセットする。
     */
    protected function tearDown(): void
    {
        BusinessCalendar::resetAll();
    }
    /**
     * 営業日判定の優先度検証用設定を生成する。
     *
     * @param string $scenario
     * @return \JapaneseDate\DateBusiness
     */
    private function createPriorityConfig(string $scenario): DateBusiness
    {
        return match ($scenario) {
            'open_nth_weekday' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addOpenNthWeekday(6, 2),
            'closing_nth_weekday' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addOpenNthWeekday(6, 2)
                ->addClosingNthWeekday(6, 2, '特別定休'),
            'open_date' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addOpenDate('2026-06-13'),
            'closing_date' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addOpenDate('2026-05-25')
                ->addClosingDate('2026-05-25', '臨時休業'),
            'open_filter' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addClosingDate('2026-05-25', '臨時休業')
                ->addOpenFilter(fn (DateTimeInterface $d) => $d->format('Ymd') === '20260525'),
            'closing_filter' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addOpenFilter(fn (DateTimeInterface $d) => $d->format('Ymd') === '20260525')
                ->addClosingFilter(fn (DateTimeInterface $d) => $d->format('Ymd') === '20260525', '最高優先休業'),
            'macro_true' => (new DateBusiness())
                ->setClosingWeekdays([0, 6])
                ->addClosingDate('2026-05-30')
                ->setMacro(fn (DateTimeInterface $d) => true),
            'macro_false' => (new DateBusiness())
                ->setMacro(fn (DateTimeInterface $d) => false),
        };
    }
}

/**
 * getTimezone() が false を返すテスト用 DateTimeInterface 実装。
 * DateTime::factory() に渡すと TypeError が発生し、catch ブランチをカバーする。
 */
class FalseTimezoneDate extends DateTimeImmutable
{
    /**
     * @return \DateTimeZone|false
     */
    public function getTimezone(): DateTimeZone|false
    {
        return false;
    }
}
