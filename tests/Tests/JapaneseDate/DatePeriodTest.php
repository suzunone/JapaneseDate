<?php

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

use Carbon\CarbonPeriod;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\DateBusiness;
use JapaneseDate\DatePeriod;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
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
 * @covers \JapaneseDate\DatePeriod
 * @covers \JapaneseDate\DatePeriod::onlyHolidays
 * @covers \JapaneseDate\DatePeriod::withoutHolidays
 * @covers \JapaneseDate\DatePeriod::withoutWeekends
 * @covers \JapaneseDate\DatePeriod::onlyWeekdays
 * @covers \JapaneseDate\DatePeriod::onlyGotobi
 * @covers \JapaneseDate\DatePeriod::onlySixWeekday
 * @covers \JapaneseDate\DatePeriod::withoutSixWeekday
 * @covers \JapaneseDate\DatePeriod::onlyDoyo
 * @covers \JapaneseDate\DatePeriod::onlyHigan
 * @covers \JapaneseDate\DatePeriod::eachSolarTerm
 * @covers \JapaneseDate\DatePeriod::eachLunarMonth
 * @covers \JapaneseDate\DatePeriod::splitByEra
 * @covers \JapaneseDate\DatePeriod::eachJapaneseFiscalYear
 * @covers \JapaneseDate\DatePeriod::collectSolarTermDates
 * @covers \JapaneseDate\DatePeriod::collectLunarNewMoonDates
 * @covers \JapaneseDate\DatePeriod::resolveSolarTerms
 * @covers \JapaneseDate\DatePeriod::createFromDatesArray
 * @covers \JapaneseDate\DatePeriod::isInDoyo
 * @covers \JapaneseDate\DatePeriod::isInHigan
 * @covers \JapaneseDate\DatePeriod::onlyBusinessDays
 * @covers \JapaneseDate\DatePeriod::withoutBusinessDays
 */
class DatePeriodTest extends TestCase
{
    /**
     * 五十日フィルタが adjust 指定ごとに営業日へ絞り込むことを確認するケースを返す。
     *
     * @return array<string, array{string, bool}>
     */
    public static function gotobiAdjustDataProvider(): array
    {
        return [
            'none: 五十日の営業日のみ' => ['none', true],
            'unknown: 不明な adjust は平日の五十日のみ' => ['unknown', true],
            'prev: 前倒し調整後の日付が営業日' => ['prev', false],
            'next: 後ろ倒し調整後の日付が営業日' => ['next', false],
        ];
    }
    /**
     * 六曜フィルタが指定した六曜の抽出・除外を行うことを確認するケースを返す。
     *
     * @return array<string, array{string, array<int, int>}>
     */
    public static function sixWeekdayFilterDataProvider(): array
    {
        return [
            'onlySixWeekday: 大安のみ' => ['only', [DateTime::SIX_WEEKDAY_TAIAN]],
            'onlySixWeekday: 大安・友引' => ['only', [DateTime::SIX_WEEKDAY_TAIAN, DateTime::SIX_WEEKDAY_TOMOBIKI]],
            'withoutSixWeekday: 仏滅のみ除外' => ['without', [DateTime::SIX_WEEKDAY_BUTSUMETSU]],
            'withoutSixWeekday: 仏滅・赤口を除外' => [
                'without',
                [DateTime::SIX_WEEKDAY_BUTSUMETSU, DateTime::SIX_WEEKDAY_SYAKKOU],
            ],
        ];
    }
    /**
     * 雑節フィルタが期間内・期間外・フォールバック年で期待する結果になることを確認するケースを返す。
     *
     * @return array<string, array{string, string, string, string, int|null}>
     */
    public static function seasonalFilterDataProvider(): array
    {
        return [
            '土用: 夏土用18日' => ['doyo', '2026-07-01', '2026-08-10', 'count', 18],
            '土用: フォールバック年' => ['doyo', '1500-07-01', '1500-08-15', 'array', null],
            '土用: 期間外' => ['doyo', '2026-09-01', '2026-09-10', 'empty', null],
            '彼岸: 春彼岸7日' => ['higan', '2026-03-10', '2026-03-31', 'count', 7],
            '彼岸: フォールバック年' => ['higan', '1500-03-15', '1500-03-31', 'array', null],
            '彼岸: 期間外' => ['higan', '2026-05-01', '2026-05-10', 'empty', null],
        ];
    }
    /**
     * 旧暦月イテレータの月数指定で期待する件数になることを確認するケースを返す。
     *
     * @return array<string, array{int, int}>
     */
    public static function lunarMonthCountDataProvider(): array
    {
        return [
            '4ヶ月' => [4, 4],
            '0ヶ月' => [0, 0],
        ];
    }
    /**
     * 日本の年度イテレータが年度範囲ごとに期待する開始日を返すことを確認するケースを返す。
     *
     * @return array<string, array{int, int, int, string|null}>
     */
    public static function japaneseFiscalYearDataProvider(): array
    {
        return [
            '複数年度' => [2023, 2026, 4, null],
            '単一年度' => [2026, 2026, 1, '2026-04-01'],
            '終了年度が開始年度より前' => [2026, 2024, 0, null],
        ];
    }
    // =========================================================================
    // クラス基本テスト
    // =========================================================================
    /**
     * DatePeriod が CarbonPeriod を継承していることを確認する。
     */
    public function test_extendsCarbonPeriod(): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31');
        $this->assertInstanceOf(CarbonPeriod::class, $period);
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

        $formattedDates = array_map(static fn ($d) => $d->format('Y-m-d'), $dates);
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

        $formattedDates = array_map(static fn ($d) => $d->format('Y-m-d'), $dates);
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
        $formattedDates = array_map(static fn ($d) => $d->format('Y-m-d'), $dates);
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
     * onlyGotobi: adjust 指定ごとに五十日または調整後の営業日が抽出されることを確認する。
     * @dataProvider gotobiAdjustDataProvider
     */
    public function test_onlyGotobi(string $adjust, bool $mustBeGotobi): void
    {
        $period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
            ->onlyGotobi($adjust);
        $dates = iterator_to_array($period);
        $this->assertIsArray($dates);
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            if ($mustBeGotobi) {
                $day = $d->day;
                $daysInMonth = $d->daysInMonth;
                $isGotobi = in_array($day, [5, 10, 15, 20, 25], true) || $day === $daysInMonth;
                $this->assertTrue($isGotobi, "{$d->format('Y-m-d')} は五十日ではない");
            }
            $this->assertFalse($jd->is_holiday);
            $this->assertNotContains($d->dayOfWeek, [0, 6]);
        }
    }
    // =========================================================================
    // 六曜フィルタテスト
    // =========================================================================
    /**
     * onlySixWeekday / withoutSixWeekday: 指定した六曜の抽出・除外ができることを確認する。
     * @dataProvider sixWeekdayFilterDataProvider
     */
    public function test_sixWeekdayFilter(string $filter, array $sixWeekdays): void
    {
        $period = match ($filter) {
            'only' => DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
                ->onlySixWeekday(...$sixWeekdays),
            'without' => DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
                ->withoutSixWeekday(...$sixWeekdays),
        };
        $dates = iterator_to_array($period);
        $this->assertGreaterThan(0, count($dates));
        foreach ($dates as $d) {
            $jd = DateTime::factory($d);
            if ($filter === 'only') {
                $this->assertContains($jd->six_weekday, $sixWeekdays, "{$d->format('Y-m-d')} は指定六曜ではない");
            } else {
                $this->assertNotContains($jd->six_weekday, $sixWeekdays);
            }
        }
    }
    // =========================================================================
    // 雑節フィルタテスト
    // =========================================================================
    /**
     * onlyDoyo / onlyHigan: 雑節期間の抽出、期間外の空結果、フォールバック年の動作を確認する。
     * @dataProvider seasonalFilterDataProvider
     */
    public function test_seasonalFilter(string $filter, string $start, string $end, string $expectation, ?int $expectedCount): void
    {
        $period = match ($filter) {
            'doyo' => DatePeriod::create($start, '1 day', $end)->onlyDoyo(),
            'higan' => DatePeriod::create($start, '1 day', $end)->onlyHigan(),
        };
        $dates = iterator_to_array($period);
        match ($expectation) {
            'count' => $this->assertCount((int) $expectedCount, $dates),
            'array' => $this->assertIsArray($dates),
            'empty' => $this->assertEmpty($dates),
        };
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

        $formattedDates = array_map(static fn ($d) => $d->format('Y-m-d'), $dates);
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
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_eachSolarTerm_usesVsop87AlgorithmWhenSelected(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            $period = DatePeriod::eachSolarTerm(
                DateTime::parse('2026-03-01'),
                DateTime::parse('2026-03-31')
            );

            $dates = iterator_to_array($period);
            $formattedDates = array_map(static fn ($d) => $d->format('Y-m-d'), $dates);

            $this->assertContains('2026-03-20', $formattedDates);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
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
     * @dataProvider lunarMonthCountDataProvider
     */
    public function test_eachLunarMonth_count(int $months, int $expectedCount): void
    {
        $period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), $months);
        $dates = iterator_to_array($period);
        $this->assertCount($expectedCount, $dates);
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

        for ($i = 1, $iMax = count($dates); $i < $iMax; $i++) {
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
     * splitByEra: 明治開始前の期間も欠落せず元号なし区間として返る。
     */
    public function test_splitByEra_keeps_period_before_meiji_start(): void
    {
        $period = DatePeriod::create('1860-01-01', '1 day', '1868-02-01');
        $split = $period->splitByEra();

        $this->assertArrayHasKey(0, $split);
        $this->assertArrayHasKey(DateTime::ERA_MEIJI, $split);

        $noEraPeriod = $split[0];
        $this->assertEquals('1860-01-01', $noEraPeriod->getStartDate()->format('Y-m-d'));
        $this->assertEquals('1868-01-24', $noEraPeriod->getEndDate()->format('Y-m-d'));

        $meijiPeriod = $split[DateTime::ERA_MEIJI];
        $this->assertEquals('1868-01-25', $meijiPeriod->getStartDate()->format('Y-m-d'));
        $this->assertEquals('1868-02-01', $meijiPeriod->getEndDate()->format('Y-m-d'));
    }
    /**
     * eachJapaneseFiscalYear: 年度範囲ごとの件数と年度開始日（4月1日）を確認する。
     * @dataProvider japaneseFiscalYearDataProvider
     */
    public function test_eachJapaneseFiscalYear(int $startFiscalYear, int $endFiscalYear, int $expectedCount, ?string $expectedFirstDate): void
    {
        $period = DatePeriod::eachJapaneseFiscalYear($startFiscalYear, $endFiscalYear);
        $dates = iterator_to_array($period);
        $this->assertCount($expectedCount, $dates);
        foreach ($dates as $d) {
            $this->assertEquals('04-01', $d->format('m-d'), "年度開始日が4月1日ではない: {$d->format('Y-m-d')}");
        }
        if ($expectedFirstDate !== null) {
            $this->assertEquals($expectedFirstDate, $dates[0]->format('Y-m-d'));
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
    // =========================================================================
    // onlyBusinessDays / withoutBusinessDays
    // =========================================================================
    /**
     * onlyBusinessDays() が週末を除いた営業日のみを返すことを確認する。
     */
    public function test_onlyBusinessDays_excludes_weekends(): void
    {
        // 2026-05-25(月) 〜 2026-05-31(日) の7日間
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->onlyBusinessDays();

        $dates = iterator_to_array($period);
        $this->assertCount(5, $dates); // 月〜金の5日

        foreach ($dates as $d) {
            $dow = (int) $d->format('N'); // 1=月, 7=日
            $this->assertNotContains($dow, [6, 7], $d->format('Y-m-d') . ' は週末であるべきでない');
        }
    }
    /**
     * onlyBusinessDays() に $config を渡したとき、その設定で営業日を判定することを確認する。
     */
    public function test_onlyBusinessDays_with_explicit_config(): void
    {
        $config = (new DateBusiness())->setClosingWeekdays([0, 6]);
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->onlyBusinessDays($config);

        $dates = iterator_to_array($period);
        $this->assertCount(5, $dates); // 月〜金の5日
    }
    /**
     * withoutBusinessDays() が営業日を除いた休業日のみを返すことを確認する。
     */
    public function test_withoutBusinessDays_returns_non_business_days(): void
    {
        // 2026-05-25(月) 〜 2026-05-31(日) の7日間
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->withoutBusinessDays();

        $dates = iterator_to_array($period);
        $this->assertCount(2, $dates); // 土・日の2日

        foreach ($dates as $d) {
            $dow = (int) $d->format('N');
            $this->assertContains($dow, [6, 7], $d->format('Y-m-d') . ' は週末であるべき');
        }
    }
    /**
     * withoutBusinessDays() に $config を渡したとき、その設定で判定することを確認する。
     */
    public function test_withoutBusinessDays_with_explicit_config(): void
    {
        $config = (new DateBusiness())->setClosingWeekdays([0, 6]);
        $period = DatePeriod::create('2026-05-25', '1 day', '2026-05-31')
            ->withoutBusinessDays($config);

        $dates = iterator_to_array($period);
        $this->assertCount(2, $dates); // 土・日の2日
    }
}
