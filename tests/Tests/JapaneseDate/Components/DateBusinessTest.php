<?php

/**
 * DateBusiness クラスのテスト
 */

namespace Tests\JapaneseDate\Components;

use DateTime;
use DateTimeInterface;
use JapaneseDate\DateBusiness;
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
 */
#[CoversClass(DateBusiness::class)]
class DateBusinessTest extends TestCase
{
    /**
     * 曜日休業設定の一括設定・追加・削除を確認するケースを返す。
     *
     * @return array<string, array{string}>
     */
    public static function closingWeekdayDataProvider(): array
    {
        return [
            '一括設定' => ['set'],
            '追加と削除' => ['add_remove'],
        ];
    }

    /**
     * 第 N 曜日の営業・休業設定を追加削除できることを確認するケースを返す。
     *
     * @return array<string, array{string}>
     */
    public static function nthWeekdayDataProvider(): array
    {
        return [
            '営業指定' => ['open'],
            '休業指定' => ['closing'],
        ];
    }

    /**
     * 特定日の営業・休業設定を日付入力種別ごとに確認するケースを返す。
     *
     * @return array<string, array{string, string}>
     */
    public static function dateConfigDataProvider(): array
    {
        return [
            '営業日指定を文字列で追加削除' => ['open', 'string'],
            '営業日指定を DateTimeInterface で追加' => ['open', 'datetime'],
            '休業日指定を文字列で追加削除' => ['closing', 'string'],
            '休業日指定を DateTimeInterface で追加' => ['closing', 'datetime'],
            '休業日指定のラベル省略' => ['closing_null_label', 'string'],
        ];
    }

    /**
     * 営業・休業フィルタの登録内容とラベルを確認するケースを返す。
     *
     * @return array<string, array{string}>
     */
    public static function filterDataProvider(): array
    {
        return [
            '営業フィルタ' => ['open'],
            '休業フィルタのラベルあり' => ['closing_label'],
            '休業フィルタのラベルなし' => ['closing_null_label'],
        ];
    }

    /**
     * 曜日休業設定が一括設定・追加・削除で期待どおり保持されることを確認する。
     *
     * @param string $scenario
     */
    #[DataProvider('closingWeekdayDataProvider')]
    public function test_closingWeekdays(string $scenario): void
    {
        $db = new DateBusiness();

        match ($scenario) {
            'set' => $db->setClosingWeekdays([0, 6]),
            'add_remove' => $db->addClosingWeekday(6),
        };

        $this->assertArrayHasKey(6, $db->getClosingWeekdays());

        if ($scenario === 'set') {
            $this->assertArrayHasKey(0, $db->getClosingWeekdays());
            $this->assertArrayNotHasKey(1, $db->getClosingWeekdays());

            return;
        }

        $db->removeClosingWeekday(6);
        $this->assertArrayNotHasKey(6, $db->getClosingWeekdays());
    }

    /**
     * 祝日判定を行うかどうかのフラグを変更・取得できることを確認する。
     */
    public function test_setBypassHoliday_and_isBypassHoliday(): void
    {
        $db = new DateBusiness();
        $this->assertTrue($db->isBypassHoliday());
        $db->setBypassHoliday(false);
        $this->assertFalse($db->isBypassHoliday());
        $db->setBypassHoliday(true);
        $this->assertTrue($db->isBypassHoliday());
    }

    /**
     * 第 N 曜日の営業・休業設定を追加し、必要に応じてラベルを保持してから削除できることを確認する。
     *
     * @param string $scenario
     */
    #[DataProvider('nthWeekdayDataProvider')]
    public function test_nthWeekdays(string $scenario): void
    {
        $db = new DateBusiness();

        match ($scenario) {
            'open' => $db->addOpenNthWeekday(6, 2),
            'closing' => $db->addClosingNthWeekday(3, 3, '定休日'),
        };

        if ($scenario === 'open') {
            $this->assertArrayHasKey('6_2', $db->getOpenNthWeekdays());
            $db->removeOpenNthWeekday(6, 2);
            $this->assertArrayNotHasKey('6_2', $db->getOpenNthWeekdays());

            return;
        }

        $this->assertArrayHasKey('3_3', $db->getClosingNthWeekdays());
        $this->assertSame('定休日', $db->getClosingNthWeekdays()['3_3']);
        $db->removeClosingNthWeekday(3, 3);
        $this->assertArrayNotHasKey('3_3', $db->getClosingNthWeekdays());
    }

    /**
     * 特定日の営業・休業設定が文字列日付と DateTimeInterface の両方で保持されることを確認する。
     *
     * @param string $scenario
     * @param string $inputType
     * @throws \Exception
     */
    #[DataProvider('dateConfigDataProvider')]
    public function test_dateConfigs(string $scenario, string $inputType): void
    {
        $db = new DateBusiness();
        $date = match ($scenario) {
            'open' => $inputType === 'datetime' ? new DateTime('2026-12-30') : '2026-12-30',
            'closing', 'closing_null_label' => $inputType === 'datetime' ? new DateTime('2026-08-15') : '2026-08-15',
        };

        match ($scenario) {
            'open' => $db->addOpenDate($date),
            'closing' => $db->addClosingDate($date, '夏期休暇'),
            'closing_null_label' => $db->addClosingDate($date),
        };

        if ($scenario === 'open') {
            $this->assertArrayHasKey('20261230', $db->getOpenDates());
            if ($inputType === 'string') {
                $db->removeOpenDate('2026-12-30');
                $this->assertArrayNotHasKey('20261230', $db->getOpenDates());
            }

            return;
        }

        $this->assertArrayHasKey('20260815', $db->getClosingDates());
        $this->assertSame($scenario === 'closing' ? '夏期休暇' : null, $db->getClosingDates()['20260815']);

        if ($scenario === 'closing' && $inputType === 'string') {
            $db->removeClosingDate('2026-08-15');
            $this->assertArrayNotHasKey('20260815', $db->getClosingDates());
        }
    }

    /**
     * 営業フィルタと休業フィルタが callable とラベルを期待どおり保持することを確認する。
     *
     * @param string $scenario
     */
    #[DataProvider('filterDataProvider')]
    public function test_filters(string $scenario): void
    {
        $db = new DateBusiness();
        $filter = match ($scenario) {
            'open' => fn (DateTimeInterface $d) => $d->format('d') === '10',
            'closing_label' => fn (DateTimeInterface $d) => $d->format('md') === '1231',
            'closing_null_label' => fn (DateTimeInterface $d) => false,
        };

        match ($scenario) {
            'open' => $db->addOpenFilter($filter),
            'closing_label' => $db->addClosingFilter($filter, '大晦日'),
            'closing_null_label' => $db->addClosingFilter($filter),
        };

        if ($scenario === 'open') {
            $this->assertCount(1, $db->getOpenFilters());
            $this->assertSame($filter, $db->getOpenFilters()[0]);

            return;
        }

        $filters = $db->getClosingFilters();
        $this->assertCount(1, $filters);
        $this->assertSame($filter, $filters[0]['filter']);
        $this->assertSame($scenario === 'closing_label' ? '大晦日' : null, $filters[0]['label']);
    }

    /**
     * 営業日判定マクロを設定・取得・解除できることを確認する。
     */
    public function test_setMacro_and_getMacro(): void
    {
        $db = new DateBusiness();
        $this->assertNull($db->getMacro());
        $macro = fn (DateTimeInterface $d) => true;
        $db->setMacro($macro);
        $this->assertSame($macro, $db->getMacro());
        $db->setMacro(null);
        $this->assertNull($db->getMacro());
    }

    /**
     * reset がすべての営業日設定を初期状態へ戻すことを確認する。
     *
     * @throws \Exception
     */
    public function test_reset(): void
    {
        $db = new DateBusiness();
        $db->setClosingWeekdays([0, 6])
            ->setBypassHoliday(false)
            ->addClosingDate('2026-08-15', '夏期休暇')
            ->addOpenDate('2026-12-30')
            ->addOpenNthWeekday(6, 2)
            ->addClosingNthWeekday(3, 3)
            ->addOpenFilter(fn ($d) => true)
            ->addClosingFilter(fn ($d) => false)
            ->setMacro(fn ($d) => true);

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

    /**
     * すべての変更メソッドが fluent interface として同一インスタンスを返すことを確認する。
     *
     * @throws \Exception
     */
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
            ->addOpenFilter(fn ($d) => true)
            ->addClosingFilter(fn ($d) => false)
            ->setMacro(null)
            ->reset();

        $this->assertSame($db, $result);
    }
}
