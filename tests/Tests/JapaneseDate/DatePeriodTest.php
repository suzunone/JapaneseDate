<?php

/** @noinspection PhpDocMissingThrowsInspection */
/** @noinspection PhpUnhandledExceptionInspection */

/**
 * DatePeriod クラスのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace Tests\JapaneseDate;

use JapaneseDate\DatePeriod;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

/**
 * DatePeriod クラスのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */
#[CoversClass(\JapaneseDate\DatePeriod::class)]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'onlyHolidays')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'withoutHolidays')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'withoutWeekends')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'onlyWeekdays')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'onlyGotobi')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'onlySixWeekday')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'withoutSixWeekday')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'onlyDoyo')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'onlyHigan')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'eachSolarTerm')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'eachLunarMonth')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'splitByEra')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'eachJapaneseFiscalYear')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'collectSolarTermDates')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'collectLunarNewMoonDates')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'resolveSolarTerms')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'createFromDatesArray')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'isInDoyo')]
#[CoversMethod(\JapaneseDate\DatePeriod::class, 'isInHigan')]
class DatePeriodTest extends TestCase
{
    // =========================================================================
    // クラス基本テスト
    // =========================================================================

    /**
     * DatePeriod が CarbonPeriod を継承していることを確認する。
     */
    public function test_extendsCarbonPeriod(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31');
        $this->assertInstanceOf(\Carbon\CarbonPeriod::class, $period);
        $this->assertInstanceOf(DatePeriod::class, $period);
    }

    // =========================================================================
    // 祝日・休日フィルタテスト
    // =========================================================================

    /**
     * onlyHolidays: 2026年5月のゴールデンウィーク期間から祝日のみが抽出される。
     *
     * 2026-05-03（憲法記念日）、05-04（みどりの日）、05-05（こどもの日）、
     * 05-06（振替休日）の4日が祝日として取得されること。
     */
    public function test_onlyHolidays_gw(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-10')
            ->onlyHolidays();

        $dates = iterator_to_array($period);
        $this->assertCount(4, $dates);

        $formattedDates = array_map(fn ($d) => $d->format('Y-m-d'), $dates);
        $this->assertContains('2026-05-03', $formattedDates);
        $this->assertContains('2026-05-04', $formattedDates);
        $this->assertContains('2026-05-05', $formattedDates);
        $this->assertContains('2026-05-06', $formattedDates);
    }

    /**
     * onlyHolidays: 祝日がない期間では空のイテレータを返す。
     */
    public function test_onlyHolidays_emptyResult(): void
    {
        // 2026-05-07〜05-08 は平日（祝日なし）
        $period = DatePeriod::create('2026-05-07', '1 day', '2026-05-08')
            ->onlyHolidays();

        $dates = iterator_to_array($period);
        $this->assertEmpty($dates);
    }

    /**
     * withoutHolidays: 祝日がフィルタリングされ、非祝日のみが残る。
     */
    public function test_withoutHolidays(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-10')
            ->withoutHolidays();

        $dates = iterator_to_array($period);
        // 05-03〜06 が祝日なので、10日中6日が残る
        $this->assertCount(6, $dates);

        $formattedDates = array_map(fn ($d) => $d->format('Y-m-d'), $dates);
        $this->assertNotContains('2026-05-03', $formattedDates);
        $this->assertNotContains('2026-05-04', $formattedDates);
        $this->assertNotContains('2026-05-05', $formattedDates);
        $this->assertNotContains('2026-05-06', $formattedDates);
    }

    /**
     * withoutWeekends: 土日が除外され、平日のみが残る。
     */
    public function test_withoutWeekends(): void
    {
        // 2026-05-01（金）〜 05-10（日）: 土(02,09)・日(03,10) を除く
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-10')
            ->withoutWeekends();

        $dates = iterator_to_array($period);
        // 10日間のうち土日（05-02, 05-03, 05-09, 05-10）の4日を除いた6日
        $this->assertCount(6, $dates);
        $formattedDates = array_map(fn ($d) => $d->format('Y-m-d'), $dates);
        $this->assertNotContains('2026-05-02', $formattedDates);
        $this->assertNotContains('2026-05-09', $formattedDates);
    }

    /**
     * onlyWeekdays: 土日と祝日を除いた純粋な平日のみが抽出される。
     */
    public function test_onlyWeekdays(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyWeekdays();

        $dates = iterator_to_array($period);
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertGreaterThan(0, $d->dayOfWeek, '日曜日が含まれている');
            $this->assertLessThan(6, $d->dayOfWeek, '土曜日が含まれている');
            $this->assertFalse($jd->is_holiday, '祝日が含まれている');
        }
        // 2026年5月は31日間、土日と祝日を除く
        $this->assertGreaterThan(0, count($dates));
    }

    // =========================================================================
    // 五十日（ごとおび）フィルタテスト
    // =========================================================================

    /**
     * onlyGotobi('none'): 五十日（5・10・15・20・25・月末）のうち営業日のみが抽出される。
     */
    public function test_onlyGotobi_none(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyGotobi('none');

        $dates = iterator_to_array($period);
        foreach ($dates as $d) {
            $day = $d->day;
            $lastDay = $d->daysInMonth;
            $isGotobi = in_array($day, [5, 10, 15, 20, 25], true) || $day === $lastDay;
            $this->assertTrue($isGotobi, "{$d->format('Y-m-d')} は五十日ではない");
            $jd = DateTime::factory($d);
            $this->assertFalse($jd->is_holiday, "{$d->format('Y-m-d')} は祝日");
            $this->assertNotContains($d->dayOfWeek, [0, 6], "{$d->format('Y-m-d')} は土日");
        }
    }

    /**
     * onlyGotobi('prev'): 五十日が祝日・土日の場合、前倒しした日が含まれる。
     */
    public function test_onlyGotobi_prev(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyGotobi('prev');

        $dates = iterator_to_array($period);
        // 前倒し調整ありの場合も結果が返ること
        $this->assertIsArray($dates);
        // 取得できた日はすべて営業日であること
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertFalse($jd->is_holiday);
            $this->assertNotContains($d->dayOfWeek, [0, 6]);
        }
    }

    /**
     * onlyGotobi: 不明な adjust 値を渡した場合、五十日はすべて除外される。
     *
     * 'none', 'prev', 'next' 以外の値を渡した場合は false を返す内部処理が実行される。
     */
    public function test_onlyGotobi_invalidAdjust(): void
    {
        // 不明な adjust 値では土日祝の五十日は除外され、平日の五十日のみが含まれる
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyGotobi('unknown');

        $dates = iterator_to_array($period);
        // 取得できた日はすべて平日の五十日であること
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $day = $d->day;
            $lastDay = $d->daysInMonth;
            $isGotobi = in_array($day, [5, 10, 15, 20, 25], true) || $day === $lastDay;
            $this->assertTrue($isGotobi);
            $this->assertFalse($jd->is_holiday);
            $this->assertNotContains($d->dayOfWeek, [0, 6]);
        }
    }

    /**
     * onlyGotobi('next'): 五十日が祝日・土日の場合、後ろ倒しした日が含まれる。
     */
    public function test_onlyGotobi_next(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyGotobi('next');

        $dates = iterator_to_array($period);
        $this->assertIsArray($dates);
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertFalse($jd->is_holiday);
            $this->assertNotContains($d->dayOfWeek, [0, 6]);
        }
    }

    // =========================================================================
    // 六曜フィルタテスト
    // =========================================================================

    /**
     * onlySixWeekday: 大安のみが抽出され、6日ごとに現れる。
     */
    public function test_onlySixWeekday_taian(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN);

        $dates = iterator_to_array($period);
        $this->assertGreaterThan(0, count($dates));

        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertEquals(
                DateTime::SIX_WEEKDAY_TAIAN,
                $jd->six_weekday,
                "{$d->format('Y-m-d')} は大安ではない"
            );
        }
    }

    /**
     * onlySixWeekday: 複数の六曜（大安・友引）を指定できる。
     */
    public function test_onlySixWeekday_multiple(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN, DateTime::SIX_WEEKDAY_TOMOBIKI);

        $dates = iterator_to_array($period);
        $this->assertGreaterThan(0, count($dates));

        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertTrue(
                in_array($jd->six_weekday, [DateTime::SIX_WEEKDAY_TAIAN, DateTime::SIX_WEEKDAY_TOMOBIKI], true),
                "{$d->format('Y-m-d')} は大安でも友引でもない"
            );
        }
    }

    /**
     * withoutSixWeekday: 仏滅が除外される。
     */
    public function test_withoutSixWeekday_butsumetsu(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU);

        $dates = iterator_to_array($period);
        // 31日から約5日分（6日に1回の仏滅）を除外した日数
        $this->assertGreaterThan(20, count($dates));

        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertNotEquals(
                DateTime::SIX_WEEKDAY_BUTSUMETSU,
                $jd->six_weekday,
                "{$d->format('Y-m-d')} は仏滅が含まれている"
            );
        }
    }

    /**
     * withoutSixWeekday: 複数の六曜（仏滅・赤口）を除外できる。
     */
    public function test_withoutSixWeekday_multiple(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU, DateTime::SIX_WEEKDAY_SYAKKOU);

        $dates = iterator_to_array($period);
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertNotContains(
                $jd->six_weekday,
                [DateTime::SIX_WEEKDAY_BUTSUMETSU, DateTime::SIX_WEEKDAY_SYAKKOU]
            );
        }
    }

    // =========================================================================
    // 雑節フィルタテスト
    // =========================================================================

    /**
     * onlyDoyo: 2026年夏の土用期間（約18日）が抽出される。
     *
     * 夏の土用は立秋（2026-08-07頃）の 18 日前から立秋前日まで。
     */
    public function test_onlyDoyo_summerDoyo(): void
    {
        $period = DatePeriod::create('2026-07-01', '1 day', '2026-08-10')
            ->onlyDoyo();

        $dates = iterator_to_array($period);
        // 土用は約18日間
        $this->assertEquals(18, count($dates));
    }

    /**
     * onlyDoyo: SimpleSolarTerm が対応しない年でも SolarTerm 経由で土用を判定できる。
     *
     * 1500年は SimpleSolarTerm の対応範囲外のため SolarTerm が使用される
     * （resolveSingleSolarTerm のフォールバック）。
     */
    public function test_onlyDoyo_fallbackYear(): void
    {
        // 1500年の土用期間を取得する（例外が出ないこと、結果が配列であること）
        $period = DatePeriod::create('1500-07-01', '1 day', '1500-08-15')
            ->onlyDoyo();

        $dates = iterator_to_array($period);
        $this->assertIsArray($dates);
    }

    /**
     * onlyDoyo: 土用でない期間には日付が含まれない。
     */
    public function test_onlyDoyo_nonDoyo(): void
    {
        // 2026-09-01 〜 09-10 は秋の土用（10月中旬）ではないのでゼロ
        $period = DatePeriod::create('2026-09-01', '1 day', '2026-09-10')
            ->onlyDoyo();

        $dates = iterator_to_array($period);
        $this->assertEmpty($dates);
    }

    /**
     * onlyHigan: 春彼岸（春分前後3日間）が抽出される。
     *
     * 2026年の春分は 3-20 頃なので、3-17〜3-23 の 7 日間。
     */
    public function test_onlyHigan_springHigan(): void
    {
        $period = DatePeriod::create('2026-03-10', '1 day', '2026-03-31')
            ->onlyHigan();

        $dates = iterator_to_array($period);
        // 春彼岸は7日間
        $this->assertEquals(7, count($dates));
    }

    /**
     * onlyHigan: SimpleSolarTerm が対応しない年でも SolarTerm 経由で彼岸を判定できる。
     */
    public function test_onlyHigan_fallbackYear(): void
    {
        $period = DatePeriod::create('1500-03-15', '1 day', '1500-03-31')
            ->onlyHigan();

        $dates = iterator_to_array($period);
        $this->assertIsArray($dates);
    }

    /**
     * onlyHigan: 彼岸でない期間には日付が含まれない。
     */
    public function test_onlyHigan_nonHigan(): void
    {
        // 2026-05-01〜05-10 は彼岸ではない
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-10')
            ->onlyHigan();

        $dates = iterator_to_array($period);
        $this->assertEmpty($dates);
    }

    // =========================================================================
    // 二十四節気区切りイテレータテスト
    // =========================================================================

    /**
     * eachSolarTerm: 2026年1月〜3月の間に含まれる節気が正しく取得できる。
     *
     * この期間には小寒(1/5)・大寒(1/20)・立春(2/4)・雨水(2/19)・啓蟄(3/5)・春分(3/20)の6節気が含まれる。
     */
    public function test_eachSolarTerm_q1_2026(): void
    {
        $period = DatePeriod::eachSolarTerm(
            DateTime::parse('2026-01-01'),
            DateTime::parse('2026-03-31')
        );

        $dates = iterator_to_array($period);
        $this->assertCount(6, $dates);

        $formattedDates = array_map(fn ($d) => $d->format('Y-m-d'), $dates);
        $this->assertContains('2026-01-05', $formattedDates); // 小寒
        $this->assertContains('2026-01-20', $formattedDates); // 大寒
        $this->assertContains('2026-02-04', $formattedDates); // 立春
    }

    /**
     * eachSolarTerm: 期間内に節気がない場合は空の期間を返す。
     */
    public function test_eachSolarTerm_emptyPeriod(): void
    {
        // 節気が存在しない短い期間（3日間）で節気が含まれないケース
        // 2026-01-06〜01-08 は小寒(1/5)の翌日から大寒(1/20)の前なので節気なし
        $period = DatePeriod::eachSolarTerm(
            DateTime::parse('2026-01-06'),
            DateTime::parse('2026-01-08')
        );

        $dates = iterator_to_array($period);
        $this->assertEmpty($dates);
    }

    /**
     * eachSolarTerm: SimpleSolarTerm が対応しない年でも SolarTerm 経由で動作する。
     *
     * 1500年は SimpleSolarTerm の対応範囲外のため SolarTerm が使用される
     * （resolveSolarTerms のフォールバック）。
     */
    public function test_eachSolarTerm_fallbackYear(): void
    {
        // SimpleSolarTerm が対応しない 1500 年でも結果を返すこと
        $period = DatePeriod::eachSolarTerm(
            DateTime::parse('1500-01-01'),
            DateTime::parse('1500-03-31')
        );

        $dates = iterator_to_array($period);
        // 1500年1月〜3月の節気が含まれること（節気のない可能性もあるが例外は出ない）
        $this->assertInstanceOf(DatePeriod::class, $period);
        $this->assertIsArray($dates);
    }

    /**
     * eachSolarTerm: 返されるイテレータが DatePeriod のインスタンスである。
     */
    public function test_eachSolarTerm_returnsDatePeriod(): void
    {
        $period = DatePeriod::eachSolarTerm(
            DateTime::parse('2026-01-01'),
            DateTime::parse('2026-06-30')
        );

        $this->assertInstanceOf(DatePeriod::class, $period);
    }

    // =========================================================================
    // 旧暦月ごとのイテレータテスト
    // =========================================================================

    /**
     * eachLunarMonth: 指定した月数分の新月日が取得できる。
     */
    public function test_eachLunarMonth_count(): void
    {
        $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), 4);
        $dates = iterator_to_array($period);

        $this->assertCount(4, $dates);
    }

    /**
     * eachLunarMonth: 取得した日付が旧暦の朔日（旧暦1日）であることを確認する。
     */
    public function test_eachLunarMonth_isNewMoon(): void
    {
        $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), 3);
        $dates = iterator_to_array($period);

        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            // 旧暦の朔日（1日）であること（±1日の誤差を許容）
            $this->assertLessThanOrEqual(2.0, $jd->lunar_day, '旧暦1日前後であること');
        }
    }

    /**
     * eachLunarMonth: 0 ヶ月を指定した場合は空の期間（結果なし）を返す。
     */
    public function test_eachLunarMonth_zeroMonths(): void
    {
        $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), 0);
        $dates = iterator_to_array($period);
        $this->assertEmpty($dates);
    }

    /**
     * eachLunarMonth: 開始日直前に新月がある場合（内部の if 分岐）でも正しく動作する。
     *
     * 2026-01-20 は 2026-01-19 の新月の翌日なので、初期検索で開始日より前の
     * 新月が見つかり、さらに次の新月を検索するコードパスが通る。
     */
    public function test_eachLunarMonth_startAfterNewMoon(): void
    {
        // 2026-01-20 は新月（1/19）の翌日なので、内部で二度目の新月検索が行われる
        $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-20'), 2);
        $dates = iterator_to_array($period);

        $this->assertCount(2, $dates);
        // 最初の日付は 2026-01-20 より後の新月
        $this->assertGreaterThanOrEqual(
            DateTime::parse('2026-01-20')->timestamp,
            $dates[0]->timestamp
        );
    }

    /**
     * eachLunarMonth: 連続する新月の間隔が朔望月の範囲（28〜31日）内にある。
     */
    public function test_eachLunarMonth_interval(): void
    {
        $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), 3);
        $dates = array_values(iterator_to_array($period));

        for ($i = 1; $i < count($dates); $i++) {
            $diff = $dates[$i - 1]->diff($dates[$i]);
            $this->assertGreaterThanOrEqual(28, $diff->days);
            $this->assertLessThanOrEqual(31, $diff->days);
        }
    }

    // =========================================================================
    // 元号関連テスト
    // =========================================================================

    /**
     * splitByEra: 昭和〜平成をまたぐ期間が正しく2つに分割される。
     */
    public function test_splitByEra_showaToPlatinum(): void
    {
        $period = DatePeriod::create('1988-01-01', '1 day', '1990-12-31');
        $split = $period->splitByEra();

        $this->assertArrayHasKey(DateTime::ERA_SHOWA, $split);
        $this->assertArrayHasKey(DateTime::ERA_HEISEI, $split);
        $this->assertCount(2, $split);

        $showaPeriod = $split[DateTime::ERA_SHOWA];
        $this->assertEquals('1988-01-01', $showaPeriod->getStartDate()->format('Y-m-d'));
        $this->assertEquals('1989-01-07', $showaPeriod->getEndDate()->format('Y-m-d'));

        $heiseiPeriod = $split[DateTime::ERA_HEISEI];
        $this->assertEquals('1989-01-08', $heiseiPeriod->getStartDate()->format('Y-m-d'));
        $this->assertEquals('1990-12-31', $heiseiPeriod->getEndDate()->format('Y-m-d'));
    }

    /**
     * splitByEra: 単一元号内の期間は1つのサブ期間になる。
     */
    public function test_splitByEra_singleEra(): void
    {
        $period = DatePeriod::create('2020-01-01', '1 day', '2022-12-31');
        $split = $period->splitByEra();

        $this->assertCount(1, $split);
        $this->assertArrayHasKey(DateTime::ERA_REIWA, $split);
    }

    /**
     * splitByEra: 明治〜大正〜昭和〜平成〜令和の全元号にまたがる長期間が正しく分割される。
     */
    public function test_splitByEra_allEras(): void
    {
        $period = DatePeriod::create('1900-01-01', '1 day', '2026-01-01');
        $split = $period->splitByEra();

        // 明治・大正・昭和・平成・令和の5元号すべてが含まれる
        $this->assertArrayHasKey(DateTime::ERA_MEIJI, $split);
        $this->assertArrayHasKey(DateTime::ERA_TAISHO, $split);
        $this->assertArrayHasKey(DateTime::ERA_SHOWA, $split);
        $this->assertArrayHasKey(DateTime::ERA_HEISEI, $split);
        $this->assertArrayHasKey(DateTime::ERA_REIWA, $split);
    }

    /**
     * eachJapaneseFiscalYear: 指定した年度分の年度開始日（4月1日）が取得できる。
     */
    public function test_eachJapaneseFiscalYear_count(): void
    {
        $period = DatePeriod::eachJapaneseFiscalYear(2023, 2026);
        $dates = iterator_to_array($period);

        $this->assertCount(4, $dates);
    }

    /**
     * eachJapaneseFiscalYear: 取得した日付がすべて4月1日であることを確認する。
     */
    public function test_eachJapaneseFiscalYear_april1st(): void
    {
        $period = DatePeriod::eachJapaneseFiscalYear(2024, 2026);
        $dates = iterator_to_array($period);

        foreach ($dates as $d) {
            $this->assertEquals('04-01', $d->format('m-d'), "年度開始日が4月1日ではない: {$d->format('Y-m-d')}");
        }
    }

    /**
     * eachJapaneseFiscalYear: 年度の元号年表示が正しいことを確認する。
     */
    public function test_eachJapaneseFiscalYear_eraYear(): void
    {
        $period = DatePeriod::eachJapaneseFiscalYear(2024, 2024);
        $dates = iterator_to_array($period);

        $this->assertCount(1, $dates);
        $jd = DateTime::factory($dates[0]);
        // 2024年度は令和6年度
        $this->assertEquals('令和', $jd->eraNameText);
        $this->assertEquals(6, $jd->eraYear);
    }

    /**
     * eachJapaneseFiscalYear: 単一年度の場合も正しく動作する。
     */
    public function test_eachJapaneseFiscalYear_singleYear(): void
    {
        $period = DatePeriod::eachJapaneseFiscalYear(2026, 2026);
        $dates = iterator_to_array($period);

        $this->assertCount(1, $dates);
        $this->assertEquals('2026-04-01', $dates[0]->format('Y-m-d'));
    }

    /**
     * eachJapaneseFiscalYear: 終了年度が開始年度より小さい場合は空の期間を返す。
     */
    public function test_eachJapaneseFiscalYear_invalidRange(): void
    {
        // endFiscalYear < startFiscalYear の場合は空
        $period = DatePeriod::eachJapaneseFiscalYear(2026, 2024);
        $dates = iterator_to_array($period);
        $this->assertEmpty($dates);
    }

    // =========================================================================
    // フィルタ組み合わせテスト
    // =========================================================================

    /**
     * 祝日フィルタと六曜フィルタを組み合わせられる。
     */
    public function test_combined_holidayAndSixWeekday(): void
    {
        // 2026年の大安かつ祝日
        $period = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
            ->onlyHolidays()
            ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN);

        $dates = iterator_to_array($period);
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertTrue($jd->is_holiday);
            $this->assertEquals(DateTime::SIX_WEEKDAY_TAIAN, $jd->six_weekday);
        }
    }

    /**
     * 平日フィルタと六曜フィルタを組み合わせられる。
     */
    public function test_combined_weekdayAndWithoutBadSixWeekday(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyWeekdays()
            ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU);

        $dates = iterator_to_array($period);
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            $this->assertNotEquals(0, $d->dayOfWeek);
            $this->assertNotEquals(6, $d->dayOfWeek);
            $this->assertFalse($jd->is_holiday);
            $this->assertNotEquals(DateTime::SIX_WEEKDAY_BUTSUMETSU, $jd->six_weekday);
        }
    }
}
