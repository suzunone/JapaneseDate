<?php

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\BusinessCalendar;
use JapaneseDate\DateBusiness;
use JapaneseDate\DatePeriod;
use JapaneseDate\Traits\DateBusinessCommon;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;


/**
 * DateBusinessCommon トレイトを DatePeriod クラス経由で検証するテスト。
 *
 * onlyBusinessDays / withoutBusinessDays などの期間フィルタメソッドが
 * DateBusiness 設定・グローバル設定・インスタンス設定と正しく連動することを確認する。
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
class DateBusinessCommonDatePeriodTest extends TestCase
{
    /**
     * onlyBusinessDays() が期間内の土日を除外して平日のみを返すことを確認する。
     *
     * @return void
     */
    public function test_onlyBusinessDays_excludes_weekends(): void
    {
        // 2026-05-25(月) 〜 2026-05-31(日)
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->onlyBusinessDays();

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertContains('2026-05-25', $dates); // 月
        $this->assertContains('2026-05-26', $dates); // 火
        $this->assertContains('2026-05-27', $dates); // 水
        $this->assertContains('2026-05-28', $dates); // 木
        $this->assertContains('2026-05-29', $dates); // 金
        $this->assertNotContains('2026-05-30', $dates); // 土
        $this->assertNotContains('2026-05-31', $dates); // 日
        $this->assertCount(5, $dates);
    }

    /**
     * onlyBusinessDays() が期間内の祝日を除外して営業日のみを返すことを確認する。
     *
     * @return void
     */
    public function test_onlyBusinessDays_excludes_holidays(): void
    {
        // 2026-01-01(木 元旦) 〜 2026-01-05(月)
        $period = DatePeriod::create('2026-01-01', '1 day', '2026-01-05')
            ->onlyBusinessDays();

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertNotContains('2026-01-01', $dates); // 元旦（祝）
        $this->assertContains('2026-01-02', $dates);    // 金
        $this->assertNotContains('2026-01-03', $dates); // 土
        $this->assertNotContains('2026-01-04', $dates); // 日
        $this->assertContains('2026-01-05', $dates);    // 月
    }

    /**
     * onlyBusinessDays() に DateBusiness 設定を渡したとき臨時休業日が除外されることを確認する。
     *
     * @return void
     * @throws \Exception
     */
    public function test_onlyBusinessDays_with_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業'); // 水曜

        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-29')
            ->onlyBusinessDays($config);

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertContains('2026-05-25', $dates);
        $this->assertContains('2026-05-26', $dates);
        $this->assertNotContains('2026-05-27', $dates); // 臨時休業
        $this->assertContains('2026-05-28', $dates);
        $this->assertContains('2026-05-29', $dates);
        $this->assertCount(4, $dates);
    }

    /**
     * setBusinessConfig() で設定したインスタンス設定を onlyBusinessDays() が自動的に参照することを確認する。
     *
     * @return void
     * @throws \Exception
     */
    public function test_onlyBusinessDays_with_instance_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業');

        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-29');
        $period->setBusinessConfig($config);
        $filtered = $period->onlyBusinessDays();

        $dates = [];
        foreach ($filtered as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertNotContains('2026-05-27', $dates);
        $this->assertCount(4, $dates);
    }

    /**
     * withoutBusinessDays() が期間内の営業日を除外して休日・週末のみを返すことを確認する。
     *
     * @return void
     */
    public function test_withoutBusinessDays_returns_holidays_and_weekends(): void
    {
        // 2026-05-25(月) 〜 2026-05-31(日)
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->withoutBusinessDays();

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertNotContains('2026-05-25', $dates); // 月（営業日）
        $this->assertNotContains('2026-05-26', $dates);
        $this->assertNotContains('2026-05-27', $dates);
        $this->assertNotContains('2026-05-28', $dates);
        $this->assertNotContains('2026-05-29', $dates);
        $this->assertContains('2026-05-30', $dates); // 土
        $this->assertContains('2026-05-31', $dates); // 日
        $this->assertCount(2, $dates);
    }

    /**
     * withoutBusinessDays() に DateBusiness 設定を渡したとき臨時休業日も休業日として含まれることを確認する。
     *
     * @return void
     * @throws \Exception
     */
    public function test_withoutBusinessDays_with_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業');

        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->withoutBusinessDays($config);

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertContains('2026-05-27', $dates); // 臨時休業（土でも日でもないが休業）
        $this->assertContains('2026-05-30', $dates); // 土
        $this->assertContains('2026-05-31', $dates); // 日
        $this->assertCount(3, $dates);
    }

    /**
     * setBusinessConfig() / getBusinessConfig() が DatePeriod インスタンスに設定を正しく保持・削除することを確認する。
     *
     * @return void
     */
    public function test_BusinessCalendar_trait_on_DatePeriod(): void
    {
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31');
        $this->assertNull($period->getBusinessConfig());

        $config = new DateBusiness();
        $period->setBusinessConfig($config);
        $this->assertSame($config, $period->getBusinessConfig());

        $period->setBusinessConfig(null);
        $this->assertNull($period->getBusinessConfig());
    }

    /**
     * onlyBusinessDays() が開始と終了が同じ休業日の期間で空のコレクションを返すことを確認する。
     *
     * @return void
     */
    public function test_onlyBusinessDays_empty_period(): void
    {
        // 開始と終了が同じ日（土曜）
        $period = DatePeriod::create('2026-05-30', '1 day', '2026-05-30')
            ->onlyBusinessDays();

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertCount(0, $dates);
    }

    /**
     * setBusinessConfig() で設定したインスタンス設定を withoutBusinessDays() が自動的に参照することを確認する。
     *
     * @return void
     * @throws \Exception
     */
    public function test_withoutBusinessDays_with_instance_config(): void
    {
        $config = (new DateBusiness())
            ->setClosingWeekdays([0, 6])
            ->addClosingDate('2026-05-27', '臨時休業');

        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-29');
        $period->setBusinessConfig($config);
        $filtered = $period->withoutBusinessDays();

        $dates = [];
        foreach ($filtered as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        $this->assertContains('2026-05-27', $dates);
        $this->assertCount(1, $dates);
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
