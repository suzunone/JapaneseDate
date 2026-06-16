<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateInterval;
use JapaneseDate\DateTime;
use JapaneseDate\Traits\DateBusinessCommon;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;


/**
 * DateBusinessCommon トレイトを DateInterval クラス経由で検証するテスト。
 *
 * addBusinessDaysTo / subBusinessDaysFrom / countBusinessDaysBetween などの
 * 営業日加減算・集計メソッドが DateBusiness 設定・インスタンス設定と正しく連動することを確認する。
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
 */
#[CoversTrait(DateBusinessCommon::class)]
class DateBusinessCommonDateIntervalTest extends TestCase
{
    /**
     * addBusinessDaysTo() が基準日から指定営業日数後の日付を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * addBusinessDaysTo() に DateBusiness 設定を渡したとき臨時休業日を除外して加算することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * addBusinessDaysTo() に 0 を渡したとき基準日をそのまま返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * addBusinessDaysTo() が設定引数未指定のときインスタンス設定を自動参照することを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * subBusinessDaysFrom() が基準日から指定営業日数前の日付を返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * subBusinessDaysFrom() に DateBusiness 設定を渡したとき臨時休業日を除外して遡ることを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * subBusinessDaysFrom() に 0 を渡したとき基準日をそのまま返すことを確認する。
     *
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\InfiniteLoopException
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
     * countBusinessDaysBetween() が開始日から終了日までの営業日数を正しく返すことを確認する。
     *
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
     * countBusinessDaysBetween() が週をまたぐ期間で土日を除いた営業日数を返すことを確認する。
     *
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
     * countBusinessDaysBetween() が期間内の祝日を除いた営業日数を返すことを確認する。
     *
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
     * countBusinessDaysBetween() が同じ営業日を開始・終了に渡したとき 1 を返すことを確認する。
     *
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
     * countBusinessDaysBetween() が同じ休業日を開始・終了に渡したとき 0 を返すことを確認する。
     *
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
     * countBusinessDaysBetween() に DateBusiness 設定を渡したとき臨時休業日を除いた営業日数を返すことを確認する。
     *
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
     * setBusinessConfig() / getBusinessConfig() が DateInterval インスタンスに設定を正しく保持・削除することを確認する。
     *
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
