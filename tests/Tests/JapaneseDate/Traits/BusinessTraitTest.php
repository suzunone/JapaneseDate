<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Business Trait のテスト。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Exceptions\InfiniteLoopException;
use JapaneseDate\Traits\Business;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;

/**
 * Business Trait が提供する営業日判定・移動メソッドを検証する。
 *
 * DateTime / DateTimeImmutable 両クラスで動作することを確認します。
 * @covers \JapaneseDate\Traits\Business
 * @covers \JapaneseDate\Exceptions\InfiniteLoopException
 * @covers \JapaneseDate\Traits\Business::isBusinessDay
 * @covers \JapaneseDate\Traits\Business::getBusinessDayLabel
 * @covers \JapaneseDate\Traits\Business::nextBusinessDay
 * @covers \JapaneseDate\Traits\Business::previousBusinessDay
 * @covers \JapaneseDate\Traits\Business::shiftToClosestBusinessDayAfter
 * @covers \JapaneseDate\Traits\Business::shiftToClosestBusinessDayBefore
 * @covers \JapaneseDate\Traits\Business::addBusinessDays
 * @covers \JapaneseDate\Traits\Business::subBusinessDays
 */
class BusinessTraitTest extends TestCase
{
    /**
     * 平日（月曜）は営業日と判定されることを確認する（DateTime）。
     */
    public function test_isBusinessDay_weekday_DateTime(): void
    {
        $dt = new DateTime('2026-05-25'); // 月曜
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * 土曜は休業日と判定されることを確認する（DateTime）。
     */
    public function test_isBusinessDay_saturday_DateTime(): void
    {
        $dt = new DateTime('2026-05-30'); // 土曜
        $this->assertFalse($dt->isBusinessDay());
    }
    // =========================================================================
    // isBusinessDay
    // =========================================================================
    /**
     * 平日（月曜）は営業日と判定されることを確認する（DateTimeImmutable）。
     */
    public function test_isBusinessDay_weekday_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('2026-05-25'); // 月曜
        $this->assertTrue($dt->isBusinessDay());
    }
    /**
     * 日曜は休業日と判定されることを確認する（DateTimeImmutable）。
     */
    public function test_isBusinessDay_sunday_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('2026-05-31'); // 日曜
        $this->assertFalse($dt->isBusinessDay());
    }
    /**
     * 営業日は null を返すことを確認する。
     */
    public function test_getBusinessDayLabel_returns_null_on_business_day(): void
    {
        $dt = new DateTime('2026-05-25'); // 月曜
        $this->assertNull($dt->getBusinessDayLabel());
    }
    /**
     * 臨時休業日は設定したラベルを返すことを確認する。
     */
    public function test_getBusinessDayLabel_returns_label_on_closing_day(): void
    {
        $config = (new DateBusiness())->addClosingDate('2026-05-25', '臨時休業');
        $dt = new DateTime('2026-05-25');
        $dt->setBusinessConfig($config);

        $this->assertSame('臨時休業', $dt->getBusinessDayLabel());
    }
    // =========================================================================
    // getBusinessDayLabel
    // =========================================================================
    /**
     * 金曜の次営業日は翌週月曜であることを確認する（DateTime）。
     */
    public function test_nextBusinessDay_skips_weekend_DateTime(): void
    {
        $dt = new DateTime('2026-05-29'); // 金曜
        $next = $dt->nextBusinessDay();

        $this->assertSame('2026-06-01', $next->format('Y-m-d'));
    }
    /**
     * nextBusinessDay が元のインスタンスを変更しないことを確認する（DateTimeImmutable）。
     */
    public function test_nextBusinessDay_immutable_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('2026-05-29'); // 金曜
        $next = $dt->nextBusinessDay();

        $this->assertSame('2026-05-29', $dt->format('Y-m-d'));
        $this->assertSame('2026-06-01', $next->format('Y-m-d'));
    }
    // =========================================================================
    // nextBusinessDay
    // =========================================================================
    /**
     * 月曜の前営業日は前週金曜であることを確認する（DateTime）。
     */
    public function test_previousBusinessDay_skips_weekend_DateTime(): void
    {
        $dt = new DateTime('2026-06-01'); // 月曜
        $prev = $dt->previousBusinessDay();

        $this->assertSame('2026-05-29', $prev->format('Y-m-d'));
    }
    /**
     * previousBusinessDay が元のインスタンスを変更しないことを確認する（DateTimeImmutable）。
     */
    public function test_previousBusinessDay_immutable_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('2026-06-01'); // 月曜
        $prev = $dt->previousBusinessDay();

        $this->assertSame('2026-06-01', $dt->format('Y-m-d'));
        $this->assertSame('2026-05-29', $prev->format('Y-m-d'));
    }
    // =========================================================================
    // previousBusinessDay
    // =========================================================================
    /**
     * 営業日の場合はそのまま同日を返すことを確認する。
     */
    public function test_shiftToClosestBusinessDayAfter_on_business_day(): void
    {
        $dt = new DateTime('2026-05-25'); // 月曜（営業日）
        $shifted = $dt->shiftToClosestBusinessDayAfter();

        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }
    /**
     * 土曜の場合は翌月曜にシフトすることを確認する。
     */
    public function test_shiftToClosestBusinessDayAfter_on_saturday(): void
    {
        $dt = new DateTime('2026-05-30'); // 土曜
        $shifted = $dt->shiftToClosestBusinessDayAfter();

        $this->assertSame('2026-06-01', $shifted->format('Y-m-d'));
    }
    // =========================================================================
    // shiftToClosestBusinessDayAfter
    // =========================================================================
    /**
     * 営業日の場合はそのまま同日を返すことを確認する。
     */
    public function test_shiftToClosestBusinessDayBefore_on_business_day(): void
    {
        $dt = new DateTime('2026-05-25'); // 月曜（営業日）
        $shifted = $dt->shiftToClosestBusinessDayBefore();

        $this->assertSame('2026-05-25', $shifted->format('Y-m-d'));
    }
    /**
     * 日曜の場合は前週金曜にシフトすることを確認する。
     */
    public function test_shiftToClosestBusinessDayBefore_on_sunday(): void
    {
        $dt = new DateTime('2026-05-31'); // 日曜
        $shifted = $dt->shiftToClosestBusinessDayBefore();

        $this->assertSame('2026-05-29', $shifted->format('Y-m-d'));
    }
    // =========================================================================
    // shiftToClosestBusinessDayBefore
    // =========================================================================
    /**
     * 3営業日後が正しく計算されることを確認する（DateTime）。
     */
    public function test_addBusinessDays_DateTime(): void
    {
        $dt = new DateTime('2026-05-29'); // 金曜
        $result = $dt->addBusinessDays(3);

        // 金の翌日から3営業日: 月・火・水 = 2026-06-03
        $this->assertSame('2026-06-03', $result->format('Y-m-d'));
    }
    /**
     * addBusinessDays が元のインスタンスを変更しないことを確認する（DateTimeImmutable）。
     */
    public function test_addBusinessDays_immutable_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('2026-05-29'); // 金曜
        $result = $dt->addBusinessDays(1);

        $this->assertSame('2026-05-29', $dt->format('Y-m-d'));
        $this->assertSame('2026-06-01', $result->format('Y-m-d'));
    }
    // =========================================================================
    // addBusinessDays
    // =========================================================================
    /**
     * 3営業日前が正しく計算されることを確認する（DateTime）。
     */
    public function test_subBusinessDays_DateTime(): void
    {
        $dt = new DateTime('2026-06-03'); // 水曜
        $result = $dt->subBusinessDays(3);

        // 水曜から3営業日前: 火・月・金 = 2026-05-29
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    /**
     * subBusinessDays が元のインスタンスを変更しないことを確認する（DateTimeImmutable）。
     */
    public function test_subBusinessDays_immutable_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('2026-06-01'); // 月曜
        $result = $dt->subBusinessDays(1);

        $this->assertSame('2026-06-01', $dt->format('Y-m-d'));
        $this->assertSame('2026-05-29', $result->format('Y-m-d'));
    }
    // =========================================================================
    // subBusinessDays
    // =========================================================================
    // =========================================================================
    // InfiniteLoopException （無限ループ防止ガード）
    // =========================================================================
    /**
     * nextBusinessDay: マクロが常に false を返す設定で InfiniteLoopException がスローされる。
     */
    public function test_nextBusinessDay_throws_InfiniteLoopException(): void
    {
        $dt = new DateTime('2026-05-25');
        $dt->setBusinessMacro(fn() => false);

        $this->expectException(InfiniteLoopException::class);
        $dt->nextBusinessDay();
    }
    /**
     * previousBusinessDay: マクロが常に false を返す設定で InfiniteLoopException がスローされる。
     */
    public function test_previousBusinessDay_throws_InfiniteLoopException(): void
    {
        $dt = new DateTime('2026-05-25');
        $dt->setBusinessMacro(fn() => false);

        $this->expectException(InfiniteLoopException::class);
        $dt->previousBusinessDay();
    }
    /**
     * addBusinessDays: マクロが常に false を返す設定で InfiniteLoopException がスローされる。
     */
    public function test_addBusinessDays_throws_InfiniteLoopException(): void
    {
        $dt = new DateTime('2026-05-25');
        $dt->setBusinessMacro(fn() => false);

        $this->expectException(InfiniteLoopException::class);
        $dt->addBusinessDays(1);
    }
    /**
     * subBusinessDays: マクロが常に false を返す設定で InfiniteLoopException がスローされる。
     */
    public function test_subBusinessDays_throws_InfiniteLoopException(): void
    {
        $dt = new DateTime('2026-05-25');
        $dt->setBusinessMacro(fn() => false);

        $this->expectException(InfiniteLoopException::class);
        $dt->subBusinessDays(1);
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
