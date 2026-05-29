<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * DateBusiness クラスのテスト
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\DateBusiness;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DateBusiness::class)]
class DateBusinessTest extends TestCase
{
    public function test_setClosingWeekdays_and_getClosingWeekdays(): void
    {
        $db = new DateBusiness();
        $db->setClosingWeekdays([0, 6]);
        $this->assertArrayHasKey(0, $db->getClosingWeekdays());
        $this->assertArrayHasKey(6, $db->getClosingWeekdays());
        $this->assertArrayNotHasKey(1, $db->getClosingWeekdays());
    }

    public function test_addClosingWeekday_and_removeClosingWeekday(): void
    {
        $db = new DateBusiness();
        $db->addClosingWeekday(6);
        $this->assertArrayHasKey(6, $db->getClosingWeekdays());
        $db->removeClosingWeekday(6);
        $this->assertArrayNotHasKey(6, $db->getClosingWeekdays());
    }

    public function test_setBypassHoliday_and_isBypassHoliday(): void
    {
        $db = new DateBusiness();
        $this->assertTrue($db->isBypassHoliday());
        $db->setBypassHoliday(false);
        $this->assertFalse($db->isBypassHoliday());
        $db->setBypassHoliday(true);
        $this->assertTrue($db->isBypassHoliday());
    }

    public function test_addOpenNthWeekday_and_removeOpenNthWeekday(): void
    {
        $db = new DateBusiness();
        $db->addOpenNthWeekday(6, 2);
        $this->assertArrayHasKey('6_2', $db->getOpenNthWeekdays());
        $db->removeOpenNthWeekday(6, 2);
        $this->assertArrayNotHasKey('6_2', $db->getOpenNthWeekdays());
    }

    public function test_addClosingNthWeekday_and_removeClosingNthWeekday(): void
    {
        $db = new DateBusiness();
        $db->addClosingNthWeekday(3, 3, '定休日');
        $this->assertArrayHasKey('3_3', $db->getClosingNthWeekdays());
        $this->assertSame('定休日', $db->getClosingNthWeekdays()['3_3']);
        $db->removeClosingNthWeekday(3, 3);
        $this->assertArrayNotHasKey('3_3', $db->getClosingNthWeekdays());
    }

    public function test_addOpenDate_and_removeOpenDate(): void
    {
        $db = new DateBusiness();
        $db->addOpenDate('2026-12-30');
        $this->assertArrayHasKey('20261230', $db->getOpenDates());
        $db->removeOpenDate('2026-12-30');
        $this->assertArrayNotHasKey('20261230', $db->getOpenDates());
    }

    public function test_addOpenDate_with_DateTimeInterface(): void
    {
        $db = new DateBusiness();
        $dt = new \DateTime('2026-12-30');
        $db->addOpenDate($dt);
        $this->assertArrayHasKey('20261230', $db->getOpenDates());
    }

    public function test_addClosingDate_and_removeClosingDate(): void
    {
        $db = new DateBusiness();
        $db->addClosingDate('2026-08-15', '夏期休暇');
        $this->assertArrayHasKey('20260815', $db->getClosingDates());
        $this->assertSame('夏期休暇', $db->getClosingDates()['20260815']);
        $db->removeClosingDate('2026-08-15');
        $this->assertArrayNotHasKey('20260815', $db->getClosingDates());
    }

    public function test_addClosingDate_with_DateTimeInterface(): void
    {
        $db = new DateBusiness();
        $dt = new \DateTime('2026-08-15');
        $db->addClosingDate($dt, '夏期休暇');
        $this->assertArrayHasKey('20260815', $db->getClosingDates());
    }

    public function test_addClosingDate_null_label(): void
    {
        $db = new DateBusiness();
        $db->addClosingDate('2026-08-15');
        $this->assertNull($db->getClosingDates()['20260815']);
    }

    public function test_addOpenFilter_and_getOpenFilters(): void
    {
        $db = new DateBusiness();
        $filter = fn(\DateTimeInterface $d) => $d->format('d') === '10';
        $db->addOpenFilter($filter);
        $this->assertCount(1, $db->getOpenFilters());
        $this->assertSame($filter, $db->getOpenFilters()[0]);
    }

    public function test_addClosingFilter_and_getClosingFilters(): void
    {
        $db = new DateBusiness();
        $filter = fn(\DateTimeInterface $d) => $d->format('md') === '1231';
        $db->addClosingFilter($filter, '大晦日');
        $filters = $db->getClosingFilters();
        $this->assertCount(1, $filters);
        $this->assertSame($filter, $filters[0]['filter']);
        $this->assertSame('大晦日', $filters[0]['label']);
    }

    public function test_addClosingFilter_null_label(): void
    {
        $db = new DateBusiness();
        $filter = fn(\DateTimeInterface $d) => false;
        $db->addClosingFilter($filter);
        $this->assertNull($db->getClosingFilters()[0]['label']);
    }

    public function test_setMacro_and_getMacro(): void
    {
        $db = new DateBusiness();
        $this->assertNull($db->getMacro());
        $macro = fn(\DateTimeInterface $d) => true;
        $db->setMacro($macro);
        $this->assertSame($macro, $db->getMacro());
        $db->setMacro(null);
        $this->assertNull($db->getMacro());
    }

    public function test_reset(): void
    {
        $db = new DateBusiness();
        $db->setClosingWeekdays([0, 6])
            ->setBypassHoliday(false)
            ->addClosingDate('2026-08-15', '夏期休暇')
            ->addOpenDate('2026-12-30')
            ->addOpenNthWeekday(6, 2)
            ->addClosingNthWeekday(3, 3)
            ->addOpenFilter(fn($d) => true)
            ->addClosingFilter(fn($d) => false)
            ->setMacro(fn($d) => true);

        $db->reset();

        $this->assertEmpty($db->getClosingWeekdays());
        $this->assertTrue($db->isBypassHoliday());
        $this->assertEmpty($db->getOpenNthWeekdays());
        $this->assertEmpty($db->getClosingNthWeekdays());
        $this->assertEmpty($db->getOpenDates());
        $this->assertEmpty($db->getClosingDates());
        $this->assertEmpty($db->getOpenFilters());
        $this->assertEmpty($db->getClosingFilters());
        $this->assertNull($db->getMacro());
    }

    public function test_fluent_interface_returns_static(): void
    {
        $db = new DateBusiness();
        $result = $db->setClosingWeekdays([6])
            ->addClosingWeekday(0)
            ->removeClosingWeekday(0)
            ->setBypassHoliday(false)
            ->addOpenNthWeekday(6, 2)
            ->removeOpenNthWeekday(6, 2)
            ->addClosingNthWeekday(3, 3)
            ->removeClosingNthWeekday(3, 3)
            ->addOpenDate('2026-01-01')
            ->removeOpenDate('2026-01-01')
            ->addClosingDate('2026-08-15')
            ->removeClosingDate('2026-08-15')
            ->addOpenFilter(fn($d) => true)
            ->addClosingFilter(fn($d) => false)
            ->setMacro(null)
            ->reset();

        $this->assertSame($db, $result);
    }
}
