<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * DateInterval クラスのテスト
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

use Carbon\CarbonInterval;
use InvalidArgumentException;
use JapaneseDate\Components\Astronomy;
use JapaneseDate\DateBusiness;
use JapaneseDate\DateInterval;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

/**
 * DateInterval クラスのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */
#[CoversClass(DateInterval::class)]
#[CoversMethod(DateInterval::class, 'addBusinessDaysToDate')]
#[CoversMethod(DateInterval::class, 'subBusinessDaysToDate')]
#[CoversMethod(DateInterval::class, 'isBusinessDay')]
#[CoversMethod(DateInterval::class, 'untilNextHoliday')]
#[CoversMethod(DateInterval::class, 'untilNextSixWeek')]
#[CoversMethod(DateInterval::class, 'eraSpan')]
#[CoversMethod(DateInterval::class, 'untilNextSolarTerm')]
#[CoversMethod(DateInterval::class, 'addSolarTermsToDate')]
#[CoversMethod(DateInterval::class, 'subSolarTermsToDate')]
#[CoversMethod(DateInterval::class, 'toSolarTermCount')]
#[CoversMethod(DateInterval::class, 'toLunarMonthCount')]
#[CoversMethod(DateInterval::class, 'untilNextNewMoon')]
#[CoversMethod(DateInterval::class, 'findNextSolarTermDate')]
#[CoversMethod(DateInterval::class, 'findPrevSolarTermDate')]
#[CoversMethod(DateInterval::class, 'addBusinessDaysTo')]
#[CoversMethod(DateInterval::class, 'subBusinessDaysFrom')]
#[CoversMethod(DateInterval::class, 'countBusinessDaysBetween')]
#[CoversMethod(DateInterval::class, 'resolveSolarTerm')]
class DateIntervalTest extends TestCase
{
    // =========================================================================
    // クラス基本テスト
    // =========================================================================

    /**
     * DateInterval が CarbonInterval を継承していることを確認する。
     */
    public function test_extendsCaronInterval(): void
    {
        $this->assertTrue(is_subclass_of(DateInterval::class, CarbonInterval::class));
    }

    /**
     * SYNODIC_MONTH_DAYS 定数が正しい値であることを確認する。
     */
    public function test_synodicMonthDaysConstant(): void
    {
        $this->assertEqualsWithDelta(29.530588853, DateInterval::SYNODIC_MONTH_DAYS, 0.0001);
    }

    /**
     * SOLAR_TERM_AVG_DAYS 定数が正しい値であることを確認する。
     */
    public function test_solarTermAvgDaysConstant(): void
    {
        $this->assertEqualsWithDelta(15.2184375, DateInterval::SOLAR_TERM_AVG_DAYS, 0.0001);
    }

    // =========================================================================
    // 営業日計算テスト
    // =========================================================================

    /**
     * isBusinessDay: 平日（月〜金・非祝日）は true を返す。
     */
    public function test_isBusinessDay_weekday(): void
    {
        // 2026-05-01 は金曜日・非祝日
        $date = DateTime::parse('2026-05-01');
        $this->assertTrue(DateInterval::isBusinessDay($date));
    }

    /**
     * isBusinessDay: 土曜日は false を返す。
     */
    public function test_isBusinessDay_saturday(): void
    {
        // 2026-05-02 は土曜日
        $date = DateTime::parse('2026-05-02');
        $this->assertFalse(DateInterval::isBusinessDay($date));
    }

    /**
     * isBusinessDay: 日曜日は false を返す。
     */
    public function test_isBusinessDay_sunday(): void
    {
        // 2026-05-10 は日曜日
        $date = DateTime::parse('2026-05-10');
        $this->assertFalse(DateInterval::isBusinessDay($date));
    }

    /**
     * isBusinessDay: 祝日は false を返す。
     */
    public function test_isBusinessDay_holiday(): void
    {
        // 2026-05-03 は憲法記念日
        $date = DateTime::parse('2026-05-03');
        $this->assertFalse(DateInterval::isBusinessDay($date));
    }

    /**
     * addBusinessDaysToDate: 祝日が連続する週は正しくスキップする。
     *
     * 2026-05-01（金）から3営業日後は、
     * 05-03〜05-06 が祝日・振替のため 05-11（月）になる。
     */
    public function test_addBusinessDaysToDate_skipsHolidays(): void
    {
        $from = DateTime::parse('2026-05-01');
        $result = DateInterval::addBusinessDaysToDate($from, 3);
        $this->assertEquals('2026-05-11', $result->format('Y-m-d'));
    }

    /**
     * addBusinessDaysToDate: 1 営業日後は翌平日になる。
     */
    public function test_addBusinessDaysToDate_oneDay(): void
    {
        // 2026-05-07（木）から1営業日後は 05-08（金）
        $from = DateTime::parse('2026-05-07');
        $result = DateInterval::addBusinessDaysToDate($from, 1);
        $this->assertEquals('2026-05-08', $result->format('Y-m-d'));
    }

    /**
     * subBusinessDaysToDate: 1 営業日前は直前の平日になる。
     */
    public function test_subBusinessDaysToDate_oneDay(): void
    {
        // 2026-05-11（月）から1営業日前は 05-08（金。祝日を跨がない）
        $from = DateTime::parse('2026-05-11');
        $result = DateInterval::subBusinessDaysToDate($from, 1);
        $this->assertEquals('2026-05-08', $result->format('Y-m-d'));
    }

    /**
     * subBusinessDaysToDate: 祝日をスキップして正しく遡る。
     */
    public function test_subBusinessDaysToDate_skipsHolidays(): void
    {
        // 2026-05-11（月）から3営業日前は 05-01（金。祝日を跨ぐ）
        $from = DateTime::parse('2026-05-11');
        $result = DateInterval::subBusinessDaysToDate($from, 3);
        $this->assertEquals('2026-05-01', $result->format('Y-m-d'));
    }

    // =========================================================================
    // 次の祝日までの残り期間テスト
    // =========================================================================

    /**
     * untilNextHoliday: 次の祝日までの日数が正しく計算される。
     *
     * 2026-05-01 の次の祝日は 05-03（憲法記念日）なので 2 日後。
     */
    public function test_untilNextHoliday_returnsDays(): void
    {
        $from = DateTime::parse('2026-05-01');
        $interval = DateInterval::untilNextHoliday($from);

        $this->assertEquals(2, $interval->d);
    }

    /**
     * untilNextHoliday: 元のオブジェクトが変更されないことを確認する（mutable 対策）。
     */
    public function test_untilNextHoliday_doesNotMutateInput(): void
    {
        $from = DateTime::parse('2026-05-01');
        DateInterval::untilNextHoliday($from);
        $this->assertEquals('2026-05-01', $from->format('Y-m-d'));
    }

    // =========================================================================
    // 六曜ベースの残り期間テスト
    // =========================================================================

    /**
     * untilNextSixWeek: 次の大安までの日数が正しく計算される。
     */
    public function test_untilNextSixWeek_taian(): void
    {
        // 2026-05-01 の六曜を確認し、大安までの日数を検証する
        $from = DateTime::parse('2026-05-01');
        $interval = DateInterval::untilNextSixWeek($from, DateTime::SIX_WEEKDAY_TAIAN);

        // 大安は6日サイクルなので 1〜6 日後になる
        $this->assertGreaterThanOrEqual(1, $interval->d);
        $this->assertLessThanOrEqual(6, $interval->d);

        // 実際に到達した日が大安であることを確認する
        $target = DateTime::parse('2026-05-01')->addDays($interval->d);
        $this->assertEquals(DateTime::SIX_WEEKDAY_TAIAN, $target->six_weekday);
    }

    /**
     * untilNextSixWeek: 現在が大安の場合、次の大安（6日後）までの期間を返す。
     */
    public function test_untilNextSixWeek_currentIsTaian(): void
    {
        // 大安の日を探す
        $date = DateTime::parse('2026-05-01');
        while ($date->six_weekday !== DateTime::SIX_WEEKDAY_TAIAN) {
            $date = $date->addDay();
        }

        $interval = DateInterval::untilNextSixWeek($date, DateTime::SIX_WEEKDAY_TAIAN);
        $this->assertEquals(6, $interval->d);
    }

    /**
     * untilNextSixWeek: 現在の六曜が目的の六曜より小さい場合（if 分岐）。
     *
     * 大安(0)の日から友引(3)を指定した場合は 3 日後になる。
     */
    public function test_untilNextSixWeek_currentLessThanTarget(): void
    {
        // 大安の日を探す
        $date = DateTime::parse('2026-05-01');
        while ($date->six_weekday !== DateTime::SIX_WEEKDAY_TAIAN) {
            $date = $date->addDay();
        }
        // 大安(0) → 友引(3): 3 日後
        $interval = DateInterval::untilNextSixWeek($date, DateTime::SIX_WEEKDAY_TOMOBIKI);
        $this->assertEquals(3, $interval->d);
    }

    /**
     * untilNextSixWeek: 元のオブジェクトが変更されないことを確認する。
     */
    public function test_untilNextSixWeek_doesNotMutateInput(): void
    {
        $from = DateTime::parse('2026-05-01');
        DateInterval::untilNextSixWeek($from, DateTime::SIX_WEEKDAY_TAIAN);
        $this->assertEquals('2026-05-01', $from->format('Y-m-d'));
    }

    // =========================================================================
    // 元号ベースの期間テスト
    // =========================================================================

    /**
     * eraSpan: 昭和の継続期間を正しく算出する。
     *
     * 昭和は 1926-12-25 から 1989-01-07 まで（約 62 年）。
     */
    public function test_eraSpan_showa(): void
    {
        $interval = DateInterval::eraSpan(DateTime::ERA_SHOWA);
        $this->assertEquals(62, $interval->y);
    }

    /**
     * eraSpan: 明治の継続期間を正しく算出する。
     *
     * 明治は 1868-01-25 から 1912-07-29 まで（約 44 年）。
     */
    public function test_eraSpan_meiji(): void
    {
        $interval = DateInterval::eraSpan(DateTime::ERA_MEIJI);
        $this->assertEquals(44, $interval->y);
    }

    /**
     * eraSpan: 令和に $until を指定した場合、正しく計算される。
     * @noinspection SpellCheckingInspection
     */
    public function test_eraSpan_reiwa_withUntil(): void
    {
        $until = DateTime::parse('2026-05-01');
        $interval = DateInterval::eraSpan(DateTime::ERA_REIWA, $until);
        // 令和は 2019-05-01 から 2026-05-01 まで = 7 年
        $this->assertEquals(7, $interval->y);
    }

    /**
     * eraSpan: 令和に $until を省略した場合、現在日時を終了とする。
     * @noinspection SpellCheckingInspection
     */
    public function test_eraSpan_reiwa_withoutUntil(): void
    {
        $interval = DateInterval::eraSpan(DateTime::ERA_REIWA);
        // 令和は 2019年開始なので年数は 6 以上
        $this->assertGreaterThanOrEqual(6, $interval->y);
    }

    /**
     * eraSpan: 不明な元号キーを渡すと InvalidArgumentException がスローされる。
     */
    public function test_eraSpan_invalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DateInterval::eraSpan(9999);
    }

    // =========================================================================
    // 二十四節気ベースの期間テスト
    // =========================================================================

    /**
     * resolveSolarTerm: SimpleSolarTerm が対応しない年は SolarTerm にフォールバックする。
     *
     * 1500年は SimpleSolarTerm の対応範囲外のため SolarTerm が使用される。
     */
    public function test_resolveSolarTerm_fallbackToSolarTerm(): void
    {
        // 1500年を基準とした場合、SimpleSolarTerm が失敗し SolarTerm が使われる
        $from = DateTime::parse('1500-03-01');
        $interval = DateInterval::untilNextSolarTerm($from);
        $this->assertGreaterThanOrEqual(0, $interval->d);
    }

    /**
     * @return void
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function test_resolveSolarTerm_usesVsop87AlgorithmWhenSelected(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            $from = DateTime::parse('2026-03-01');
            $interval = DateInterval::untilNextSolarTerm($from, 'syunbun');

            $this->assertGreaterThan(0, $interval->d);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }

    /**
     * untilNextSolarTerm: 次の節気までの残り期間が取得できる。
     */
    public function test_untilNextSolarTerm_noSpecificTerm(): void
    {
        $from = DateTime::parse('2026-05-01');
        $interval = DateInterval::untilNextSolarTerm($from);

        // 節気の間隔は 14〜16 日程度なので、次の節気は 30 日以内
        $this->assertLessThanOrEqual(30, $interval->d);
        $this->assertGreaterThanOrEqual(0, $interval->d);
    }

    /**
     * untilNextSolarTerm: 特定の節気（夏至）までの残り期間が取得できる。
     */
    public function test_untilNextSolarTerm_specificTerm(): void
    {
        // 2026-05-01 から次の夏至（geshi）は 2026-06-21 頃
        $from = DateTime::parse('2026-05-01');
        $interval = DateInterval::untilNextSolarTerm($from, 'geshi');

        $this->assertGreaterThan(0, $interval->d);
        // 夏至は 6 月なので 20〜55 日後
        $this->assertLessThanOrEqual(55, $interval->d);
    }

    /**
     * addSolarTermsToDate: N 節気後の日付を正しく算出する。
     */
    public function test_addSolarTermsToDate(): void
    {
        // 2026-01-01 から 3 節気後は小寒(1/5)→大寒(1/20)→立春(2/4) → 2026-02-04 頃
        $from = DateTime::parse('2026-01-01');
        $result = DateInterval::addSolarTermsToDate($from, 3);

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertEquals('2026', $result->format('Y'));
        // 3節気後なので約45日後
        $diff = $from->diff($result);
        $this->assertGreaterThan(30, $diff->days);
        $this->assertLessThan(60, $diff->days);
    }

    /**
     * subSolarTermsToDate: N 節気前の日付を正しく算出する。
     */
    public function test_subSolarTermsToDate(): void
    {
        // 2026-06-01 から 2 節気前
        $from = DateTime::parse('2026-06-01');
        $result = DateInterval::subSolarTermsToDate($from, 2);

        $this->assertInstanceOf(DateTime::class, $result);
        // 2節気前なので約30日前
        $diff = $result->diff($from);
        $this->assertGreaterThan(20, $diff->days);
        $this->assertLessThan(45, $diff->days);
        $this->assertTrue($result->lt($from));
    }

    /**
     * toSolarTermCount: 30日が約2節気分に換算される。
     */
    public function test_toSolarTermCount(): void
    {
        $interval = new DateInterval('P30D');
        $count = $interval->toSolarTermCount();

        $this->assertEqualsWithDelta(1.97, $count, 0.1);
    }

    /**
     * toSolarTermCount: 0日のインターバルは 0 節気分を返す。
     */
    public function test_toSolarTermCount_zero(): void
    {
        $interval = new DateInterval('P0D');
        $this->assertEquals(0.0, $interval->toSolarTermCount());
    }

    // =========================================================================
    // 旧暦・月相ベースの期間テスト
    // =========================================================================

    /**
     * toLunarMonthCount: 約 59 日が 2 朔望月に換算される。
     */
    public function test_toLunarMonthCount(): void
    {
        $interval = new DateInterval('P59D');
        $count = $interval->toLunarMonthCount();

        $this->assertEqualsWithDelta(2.0, $count, 0.1);
    }

    /**
     * toLunarMonthCount: 0日のインターバルは 0 朔望月を返す。
     */
    public function test_toLunarMonthCount_zero(): void
    {
        $interval = new DateInterval('P0D');
        $this->assertEquals(0.0, $interval->toLunarMonthCount());
    }

    /**
     * untilNextNewMoon: 次の新月までの残り日数が妥当な範囲内にある。
     */
    public function test_untilNextNewMoon(): void
    {
        $from = DateTime::parse('2026-05-01');
        $interval = DateInterval::untilNextNewMoon($from);

        // 次の新月は 0〜29.5 日後
        $this->assertGreaterThanOrEqual(0, $interval->d);
        $this->assertLessThanOrEqual(30, $interval->d);
    }

    /**
     * untilNextNewMoon: 元のオブジェクトが変更されないことを確認する。
     */
    public function test_untilNextNewMoon_doesNotMutateInput(): void
    {
        $from = DateTime::parse('2026-05-01');
        DateInterval::untilNextNewMoon($from);
        $this->assertEquals('2026-05-01', $from->format('Y-m-d'));
    }

    // -----------------------------------------------------------------------
    // addBusinessDaysTo
    // -----------------------------------------------------------------------

    /**
     * addBusinessDaysTo() が N 営業日後の日付を返すことを確認する。
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
     * addBusinessDaysTo() が $config を明示的に渡したときに使用することを確認する。
     */
    public function test_addBusinessDaysTo_with_explicit_config(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-05-25'); // 月曜
        $config = new DateBusiness();
        $result = $interval->addBusinessDaysTo($base, 1, $config);

        $this->assertSame('2026-05-26', $result->format('Y-m-d'));
    }

    // -----------------------------------------------------------------------
    // subBusinessDaysFrom
    // -----------------------------------------------------------------------

    /**
     * subBusinessDaysFrom() が N 営業日前の日付を返すことを確認する。
     */
    public function test_subBusinessDaysFrom_basic(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-06-01'); // 月曜
        $result = $interval->subBusinessDaysFrom($base, 3);

        // 月曜から3営業日前: 水・火・月 = 2026-05-27
        $this->assertSame('2026-05-27', $result->format('Y-m-d'));
    }

    /**
     * subBusinessDaysFrom() が $config を明示的に渡したときに使用することを確認する。
     */
    public function test_subBusinessDaysFrom_with_explicit_config(): void
    {
        $interval = new DateInterval('P1D');
        $base = DateTime::factory('2026-05-27'); // 水曜
        $config = new DateBusiness();
        $result = $interval->subBusinessDaysFrom($base, 1, $config);

        $this->assertSame('2026-05-26', $result->format('Y-m-d'));
    }

    // -----------------------------------------------------------------------
    // countBusinessDaysBetween
    // -----------------------------------------------------------------------

    /**
     * countBusinessDaysBetween() が期間内の営業日数を返すことを確認する。
     */
    public function test_countBusinessDaysBetween_basic(): void
    {
        $interval = new DateInterval('P1D');
        $start = DateTime::factory('2026-05-25'); // 月曜
        $end = DateTime::factory('2026-05-31'); // 日曜

        $count = $interval->countBusinessDaysBetween($start, $end);

        // 月〜金の5日が営業日
        $this->assertSame(5, $count);
    }

    /**
     * countBusinessDaysBetween() が $config を明示的に渡したときに使用することを確認する。
     */
    public function test_countBusinessDaysBetween_with_explicit_config(): void
    {
        $interval = new DateInterval('P1D');
        $start = DateTime::factory('2026-05-25');
        $end = DateTime::factory('2026-05-25');
        $config = new DateBusiness();

        $count = $interval->countBusinessDaysBetween($start, $end, $config);

        $this->assertSame(1, $count);
    }
}
