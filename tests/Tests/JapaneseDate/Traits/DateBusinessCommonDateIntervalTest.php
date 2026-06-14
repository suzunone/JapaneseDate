<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * DateInterval の営業日機能テスト
 */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateInterval;
use JapaneseDate\DateTime;
use JapaneseDate\Traits\DateBusinessCommon;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;

/**
 *
 */
/**
 *
 * @covers \JapaneseDate\Traits\DateBusinessCommon
 */
class DateBusinessCommonDateIntervalTest extends TestCase
{
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_addBusinessDaysTo_basic(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-05-29'); // 金曜
        $result = $interval->addBusinessDaysTo($base, 3);
        // 金の翌日から3営業日: 月・火・水 = 2026-06-03
        $this->assertSame('2026-06-03', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_addBusinessDaysTo_with_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-06-01', '特別休業'); // 月曜を休業

        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-05-29'); // 金曜
        $result = $interval->addBusinessDaysTo($base, 3, $config);
        // 月が休み → 火・水・木 = 2026-06-04
        $this->assertSame('2026-06-04', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_addBusinessDaysTo_zero(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-05-29');
        $result = $interval->addBusinessDaysTo($base, 0);
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_addBusinessDaysTo_uses_instance_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-06-01', '特別休業');
        $interval = new DateInterval('P1D');
        $interval->setBusinessConfig($config);

        $base = DateTime::factory('2026-05-29');
        $result = $interval->addBusinessDaysTo($base, 3); // 設定なし = インスタンス設定を使用
        $this->assertSame('2026-06-04', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_subBusinessDaysFrom_basic(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-06-03'); // 水曜
        $result = $interval->subBusinessDaysFrom($base, 3);
        // 水曜から3営業日前: 火・月・金 = 2026-05-29
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_subBusinessDaysFrom_with_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-06-01', '特別休業'); // 月曜を休業

        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-06-04'); // 木曜
        $result = $interval->subBusinessDaysFrom($base, 3, $config);
        // 月が休み → 水・火・金 = 2026-05-29
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_subBusinessDaysFrom_zero(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-06-03');
        $result = $interval->subBusinessDaysFrom($base, 0);
        $this->assertSame('2026-06-03', $result->format('Y-m-d'));
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_countBusinessDaysBetween_basic(): void
    {
        $interval = new DateInterval('P1D');
        $start = DateTime::factory('2026-05-25'); // 月
        $end = DateTime::factory('2026-05-29');   // 金

        // 月〜金 = 5営業日
        $count = $interval->countBusinessDaysBetween($start, $end);
        $this->assertSame(5, $count);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_countBusinessDaysBetween_with_weekend(): void
    {
        $interval = new DateInterval('P1D');
        $start = DateTime::factory('2026-05-25'); // 月
        $end = DateTime::factory('2026-06-01');   // 月（翌週）

        // 月〜金 + 月 = 6営業日（土日は除外）
        $count = $interval->countBusinessDaysBetween($start, $end);
        $this->assertSame(6, $count);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_countBusinessDaysBetween_with_holiday(): void
    {
        $interval = new DateInterval('P1D');
        // 2026-01-01 元旦（木曜）〜 2026-01-05（月曜）
        $start = DateTime::factory('2026-01-01');
        $end = DateTime::factory('2026-01-05');

        // 元旦(祝)・土・日 除外 → 金・月 = 2日
        $count = $interval->countBusinessDaysBetween($start, $end);
        $this->assertSame(2, $count);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_countBusinessDaysBetween_same_day_business(): void
    {
        $interval = new DateInterval('P1D');
        $date = DateTime::factory('2026-05-25'); // 月曜
        $count = $interval->countBusinessDaysBetween($date, $date);
        $this->assertSame(1, $count);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_countBusinessDaysBetween_same_day_holiday(): void
    {
        $interval = new DateInterval('P1D');
        $date = DateTime::factory('2026-05-30'); // 土曜
        $count = $interval->countBusinessDaysBetween($date, $date);
        $this->assertSame(0, $count);
    }
    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_countBusinessDaysBetween_with_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業'); // 水曜

        $interval = new DateInterval('P1D');
        $start = DateTime::factory('2026-05-25');
        $end = DateTime::factory('2026-05-29');

        // 月・火・水(休)・木・金 → 4日
        $count = $interval->countBusinessDaysBetween($start, $end, $config);
        $this->assertSame(4, $count);
    }
    /**
     * @return void
     */
    public function test_BusinessCalendar_trait_on_DateInterval(): void
    {
        $interval = new DateInterval('P1D');
        $this->assertNull($interval->getBusinessConfig());

        $config = new DateBusiness();
        $interval->setBusinessConfig($config);
        $this->assertSame($config, $interval->getBusinessConfig());

        $interval->setBusinessConfig(null);
        $this->assertNull($interval->getBusinessConfig());
    }
    /**
     * @return void
     */
    protected function setUp(): void
    {
        BusinessCalendar::resetAll();
    }
    /**
     * @return void
     */
    protected function tearDown(): void
    {
        BusinessCalendar::resetAll();
    }
}
