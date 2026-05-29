<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Modern Trait の現代暦・祝日・元号表示を検証するテスト。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2018/04/28 11:45 リリースから利用可能
 */

namespace Test\JapaneseDate\Traits;

use JapaneseDate\Components\SexagenaryCycle;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Modern Trait が提供する曜日、月名、祝日、元号、干支の取得処理を検証する。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 */
#[CoversTrait(\JapaneseDate\Traits\Modern::class)]
#[CoversClass(\JapaneseDate\DateTime::class)]
#[CoversClass(\JapaneseDate\Components\LunarCalendar::class)]
#[CoversClass(SexagenaryCycle::class)]
#[CoversTrait(\JapaneseDate\Traits\Lunar::class)]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewWeekday')]
#[CoversMethod(\JapaneseDate\Traits\Getter::class, '__get')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewMonth')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewHoliday')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'getHoliday')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'getHeavenlyStem')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewHeavenlyStem')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'getMiscSeasonalNode')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewMiscSeasonalNode')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'getSolarSeasonalFestival')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewSolarSeasonalFestivalName')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewSolarSeasonalFestivalAlias')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'getLunarSeasonalFestival')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewLunarSeasonalFestivalName')]
#[CoversMethod(\JapaneseDate\Traits\Modern::class, 'viewLunarSeasonalFestivalAlias')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'getSolarTerm')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'getSolarTermKey')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'isSolarTerm')]
class ModernTest extends TestCase
{
    use InvokeTrait;

    /**
     * DateTime で曜日名を取得できることを確認する。
     */
    public function test_viewWeekday(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('月', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-02');
        $this->assertEquals('火', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-03');
        $this->assertEquals('水', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-04');
        $this->assertEquals('木', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-05');
        $this->assertEquals('金', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-06');
        $this->assertEquals('土', $DateTime->weekday_text);
        $DateTime = new DateTime('2018-01-07');
        $this->assertEquals('日', $DateTime->weekday_text);
    }

    /**
     * DateTime で和風月名を取得できることを確認する。
     */
    public function test_viewMonth(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('睦月', $DateTime->month_text);
    }

    /**
     * DateTime で主要な祝日名と祝日コードを取得できることを確認する。
     */
    public function test_getHoliday(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertEquals('元旦', $DateTime->holiday_text);
        $this->assertEquals(DateTime::NEW_YEAR_S_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-01-08');
        $this->assertEquals('成人の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMING_OF_AGE_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-02-11');
        $this->assertEquals('建国記念の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::NATIONAL_FOUNDATION_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-02-12');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-03-20');
        $this->assertEquals('', $DateTime->holiday_text);

        $DateTime = new DateTime('2018-03-21');
        $this->assertEquals('春分の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::VERNAL_EQUINOX_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-03-22');
        $this->assertEquals('', $DateTime->holiday_text);

        $DateTime = new DateTime('2018-04-29');
        $this->assertEquals('昭和の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::DAY_OF_SHOWA, $DateTime->holiday);

        $DateTime = new DateTime('2018-04-30');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-05-03');
        $this->assertEquals('憲法記念日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CONSTITUTION_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-05-04');
        $this->assertEquals('みどりの日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::GREENERY_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-05-05');
        $this->assertEquals('こどもの日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CHILDREN_S_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-07-16');
        $this->assertEquals('海の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::MARINE_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-08-11');
        $this->assertEquals('山の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::MOUNTAIN_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-09-17');
        $this->assertEquals('敬老の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-09-23');
        $this->assertEquals('秋分の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::AUTUMNAL_EQUINOX_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-09-24');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-10-08');
        $this->assertEquals('体育の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::LEGACY_SPORTS_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-11-03');
        $this->assertEquals('文化の日', $DateTime->holiday_text);

        $DateTime = new DateTime('2018-11-23');
        $this->assertEquals('勤労感謝の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::LABOR_THANKSGIVING_DAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-12-23');
        $this->assertEquals('天皇誕生日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::THE_EMPEROR_S_BIRTHDAY, $DateTime->holiday);

        $DateTime = new DateTime('2018-12-24');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);
    }

    /**
     * DateTime で祝日かどうかを判定できることを確認する。
     */
    public function test_isHoliday(): void
    {
        $DateTime = new DateTime('2018-12-23');
        $this->assertTrue($DateTime->is_holiday);
        $this->assertTrue($DateTime->isHoliday);

        $DateTime = new DateTime('2019-12-23');
        $this->assertFalse($DateTime->is_holiday);
        $this->assertFalse($DateTime->isHoliday);
    }

    /**
     * DateTime で二十四節気の有無と名称を取得できることを確認する。
     */
    public function test_getSolarTerm(): void
    {
        $DateTime = new DateTime('2018-04-05');


        $this->assertSame(4, $DateTime->month);
        $this->assertSame(5, $DateTime->day);
        $this->assertSame(1, $DateTime->solar_term);
        $this->assertSame('清明', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);

        $DateTime = new DateTime('2018-03-20');
        $this->assertFalse($DateTime->solar_term);
        $this->assertSame('', $DateTime->solar_term_text);
        $this->assertFalse($DateTime->is_solar_term);

        $DateTime = new DateTime('2018-03-21');
        $this->assertSame(0, $DateTime->solar_term);
        $this->assertSame('春分', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);
    }

    /**
     * DateTime で元号名、元号コード、元号年を取得できることを確認する。
     */
    public function test_eraName(): void
    {
        $DateTime = new DateTime('1868-01-25');
        $this->assertEquals('明治', $DateTime->era_name_text);
        $this->assertEquals('1000', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('1912-07-29');
        $this->assertEquals('明治', $DateTime->era_name_text);
        $this->assertEquals('1000', $DateTime->era_name);
        $this->assertEquals(45, $DateTime->era_year);

        $DateTime = new DateTime('1912-07-30');
        $this->assertEquals('大正', $DateTime->era_name_text);
        $this->assertEquals('1001', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('1926-12-24');
        $this->assertEquals('大正', $DateTime->era_name_text);
        $this->assertEquals('1001', $DateTime->era_name);
        $this->assertEquals(15, $DateTime->era_year);

        $DateTime = new DateTime('1926-12-25');
        $this->assertEquals('昭和', $DateTime->era_name_text);
        $this->assertEquals('1002', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('1989-01-07');
        $this->assertEquals('昭和', $DateTime->era_name_text);
        $this->assertEquals('1002', $DateTime->era_name);
        $this->assertEquals(64, $DateTime->era_year);

        $DateTime = new DateTime('1989-01-08');
        $this->assertEquals('平成', $DateTime->era_name_text);
        $this->assertEquals('1003', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTime('2019-04-30');
        $this->assertEquals('平成', $DateTime->era_name_text);
        $this->assertEquals('1003', $DateTime->era_name);
        $this->assertEquals(31, $DateTime->era_year);

        $DateTime = new DateTime('2019-05-01');
        $this->assertEquals('令和', $DateTime->era_name_text);
        $this->assertEquals('1004', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);
    }

    /**
     * DateTime で干支名と干支コードを取得できることを確認する。
     */
    public function test_getOrientalZodiac(): void
    {
        $DateTime = DateTime::factory('2016-05-21');
        $this->assertEquals('申', $DateTime->oriental_zodiac_text);

        $DateTime = DateTime::factory('2019-05-21');
        $this->assertEquals(0, $DateTime->oriental_zodiac);
    }
    
    // DateTimeImmutable でも同じ現代暦情報を取得できることを確認する。


    /**
     * DateTimeImmutable で曜日名を取得できることを確認する。
     */
    public function test_viewWeekday_immutable(): void
    {
        $DateTime = new DateTimeImmutable('2018-01-01');
        $this->assertEquals('月', $DateTime->weekday_text);
        $DateTime = new DateTimeImmutable('2018-01-02');
        $this->assertEquals('火', $DateTime->weekday_text);
        $DateTime = new DateTimeImmutable('2018-01-03');
        $this->assertEquals('水', $DateTime->weekday_text);
        $DateTime = new DateTimeImmutable('2018-01-04');
        $this->assertEquals('木', $DateTime->weekday_text);
        $DateTime = new DateTimeImmutable('2018-01-05');
        $this->assertEquals('金', $DateTime->weekday_text);
        $DateTime = new DateTimeImmutable('2018-01-06');
        $this->assertEquals('土', $DateTime->weekday_text);
        $DateTime = new DateTimeImmutable('2018-01-07');
        $this->assertEquals('日', $DateTime->weekday_text);
    }

    /**
     * DateTimeImmutable で和風月名を取得できることを確認する。
     */
    public function test_viewMonth_immutable(): void
    {
        $DateTime = new DateTimeImmutable('2018-01-01');
        $this->assertEquals('睦月', $DateTime->month_text);
    }

    /**
     * DateTimeImmutable で主要な祝日名と祝日コードを取得できることを確認する。
     */
    public function test_getHoliday_immutable(): void
    {
        $DateTime = new DateTimeImmutable('2018-01-01');
        $this->assertEquals('元旦', $DateTime->holiday_text);
        $this->assertEquals(DateTime::NEW_YEAR_S_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-01-08');
        $this->assertEquals('成人の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMING_OF_AGE_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-02-11');
        $this->assertEquals('建国記念の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::NATIONAL_FOUNDATION_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-02-12');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-03-20');
        $this->assertEquals('', $DateTime->holiday_text);

        $DateTime = new DateTimeImmutable('2018-03-21');
        $this->assertEquals('春分の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::VERNAL_EQUINOX_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-03-22');
        $this->assertEquals('', $DateTime->holiday_text);

        $DateTime = new DateTimeImmutable('2018-04-29');
        $this->assertEquals('昭和の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::DAY_OF_SHOWA, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-04-30');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-05-03');
        $this->assertEquals('憲法記念日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CONSTITUTION_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-05-04');
        $this->assertEquals('みどりの日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::GREENERY_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-05-05');
        $this->assertEquals('こどもの日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::CHILDREN_S_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-07-16');
        $this->assertEquals('海の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::MARINE_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-08-11');
        $this->assertEquals('山の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::MOUNTAIN_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-09-17');
        $this->assertEquals('敬老の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-09-23');
        $this->assertEquals('秋分の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::AUTUMNAL_EQUINOX_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-09-24');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-10-08');
        $this->assertEquals('体育の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::LEGACY_SPORTS_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-11-03');
        $this->assertEquals('文化の日', $DateTime->holiday_text);

        $DateTime = new DateTimeImmutable('2018-11-23');
        $this->assertEquals('勤労感謝の日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::LABOR_THANKSGIVING_DAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-12-23');
        $this->assertEquals('天皇誕生日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::THE_EMPEROR_S_BIRTHDAY, $DateTime->holiday);

        $DateTime = new DateTimeImmutable('2018-12-24');
        $this->assertEquals('振替休日', $DateTime->holiday_text);
        $this->assertEquals(DateTime::COMPENSATING_HOLIDAY, $DateTime->holiday);
    }

    /**
     * DateTimeImmutable で祝日かどうかを判定できることを確認する。
     */
    public function test_isHoliday_immutable(): void
    {
        $DateTime = new DateTimeImmutable('2018-12-23');
        $this->assertTrue($DateTime->is_holiday);
        $this->assertTrue($DateTime->isHoliday);

        $DateTime = new DateTimeImmutable('2019-12-23');
        $this->assertFalse($DateTime->is_holiday);
        $this->assertFalse($DateTime->isHoliday);
    }

    /**
     * DateTimeImmutable で二十四節気の有無と名称を取得できることを確認する。
     */
    public function test_getSolarTerm_immutable(): void
    {
        $DateTime = new DateTimeImmutable('2018-04-05');


        $this->assertSame(4, $DateTime->month);
        $this->assertSame(5, $DateTime->day);
        $this->assertSame(1, $DateTime->solar_term);
        $this->assertSame('清明', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);

        $DateTime = new DateTimeImmutable('2018-03-20');
        $this->assertFalse($DateTime->solar_term);
        $this->assertSame('', $DateTime->solar_term_text);
        $this->assertFalse($DateTime->is_solar_term);

        $DateTime = new DateTimeImmutable('2018-03-21');
        $this->assertSame(0, $DateTime->solar_term);
        $this->assertSame('春分', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);
    }

    /**
     * DateTimeImmutable で元号名、元号コード、元号年を取得できることを確認する。
     */
    public function test_eraName_immutable(): void
    {
        $DateTime = new DateTimeImmutable('1868-01-25');
        $this->assertEquals('明治', $DateTime->era_name_text);
        $this->assertEquals('1000', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('1912-07-29');
        $this->assertEquals('明治', $DateTime->era_name_text);
        $this->assertEquals('1000', $DateTime->era_name);
        $this->assertEquals(45, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('1912-07-30');
        $this->assertEquals('大正', $DateTime->era_name_text);
        $this->assertEquals('1001', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('1926-12-24');
        $this->assertEquals('大正', $DateTime->era_name_text);
        $this->assertEquals('1001', $DateTime->era_name);
        $this->assertEquals(15, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('1926-12-25');
        $this->assertEquals('昭和', $DateTime->era_name_text);
        $this->assertEquals('1002', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('1989-01-07');
        $this->assertEquals('昭和', $DateTime->era_name_text);
        $this->assertEquals('1002', $DateTime->era_name);
        $this->assertEquals(64, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('1989-01-08');
        $this->assertEquals('平成', $DateTime->era_name_text);
        $this->assertEquals('1003', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('2019-04-30');
        $this->assertEquals('平成', $DateTime->era_name_text);
        $this->assertEquals('1003', $DateTime->era_name);
        $this->assertEquals(31, $DateTime->era_year);

        $DateTime = new DateTimeImmutable('2019-05-01');
        $this->assertEquals('令和', $DateTime->era_name_text);
        $this->assertEquals('1004', $DateTime->era_name);
        $this->assertEquals(1, $DateTime->era_year);
    }

    /**
     * DateTimeImmutable で干支名と干支コードを取得できることを確認する。
     */
    public function test_getOrientalZodiac_immutable(): void
    {
        $DateTime = DateTime::factory('2016-05-21');
        $this->assertEquals('申', $DateTime->oriental_zodiac_text);

        $DateTime = DateTime::factory('2019-05-21');
        $this->assertEquals(0, $DateTime->oriental_zodiac);
    }

    /**
     * DateTime で十干名と十干コードを取得できることを確認する。
     *
     * 検証出典: 国立天文台 理科年表 / 干支早見表
     *   1984年=甲子(甲=0), 2023年=癸卯(癸=9), 2024年=甲辰(甲=0)
     */
    public function test_getHeavenlyStem(): void
    {
        // 1984年 = 甲子 → 十干: 甲 (key=0)
        $DateTime = new DateTime('1984-01-01');
        $this->assertSame(0, $DateTime->heavenly_stem);
        $this->assertSame('甲', $DateTime->heavenly_stem_text);
        $this->assertSame(0, $DateTime->heavenlyStem);
        $this->assertSame('甲', $DateTime->heavenlyStemText);

        // 2023年 = 癸卯 → 十干: 癸 (key=9)
        $DateTime = new DateTime('2023-06-01');
        $this->assertSame(9, $DateTime->heavenly_stem);
        $this->assertSame('癸', $DateTime->heavenly_stem_text);

        // 2024年 = 甲辰 → 十干: 甲 (key=0)
        $DateTime = new DateTime('2024-06-01');
        $this->assertSame(0, $DateTime->heavenly_stem);
        $this->assertSame('甲', $DateTime->heavenly_stem_text);

        // 十干が10年周期で循環することを確認
        $stems = ['甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸'];
        for ($i = 0; $i < 10; $i++) {
            $DateTime = new DateTime((1984 + $i) . '-01-01');
            $this->assertSame($stems[$i], $DateTime->heavenly_stem_text, (1984 + $i) . '年の十干が正しくない');
        }
    }

    /**
     * DateTimeImmutable で十干名と十干コードを取得できることを確認する。
     */
    public function test_getHeavenlyStem_immutable(): void
    {
        // 2025年 = 乙巳 → 十干: 乙 (key=1)
        $DateTime = new DateTimeImmutable('2025-01-01');
        $this->assertSame(1, $DateTime->heavenly_stem);
        $this->assertSame('乙', $DateTime->heavenly_stem_text);
        $this->assertSame(1, $DateTime->heavenlyStem);
        $this->assertSame('乙', $DateTime->heavenlyStemText);
    }

    /**
     * DateTime::HEAVENLY_STEM_* 定数が正しいことを確認する。
     */
    public function test_heavenlyStem_constants(): void
    {
        $this->assertSame(0, DateTime::HEAVENLY_STEM_KINOE);
        $this->assertSame(1, DateTime::HEAVENLY_STEM_KINOTO);
        $this->assertSame(2, DateTime::HEAVENLY_STEM_HINOE);
        $this->assertSame(3, DateTime::HEAVENLY_STEM_HINOTO);
        $this->assertSame(4, DateTime::HEAVENLY_STEM_TSUCHINOE);
        $this->assertSame(5, DateTime::HEAVENLY_STEM_TSUCHINOTO);
        $this->assertSame(6, DateTime::HEAVENLY_STEM_KANOE);
        $this->assertSame(7, DateTime::HEAVENLY_STEM_KANOTO);
        $this->assertSame(8, DateTime::HEAVENLY_STEM_MIZUNOE);
        $this->assertSame(9, DateTime::HEAVENLY_STEM_MIZUNOTO);
    }

    /**
     * getSolarSeasonalFestival が端午の節句（5月5日）に SEASONAL_FESTIVAL_TANGO を返すことを確認する。
     */
    public function test_getSolarSeasonalFestival_tango(): void
    {
        $date = new DateTime('2026-05-05');
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $date->solarSeasonalFestival);
    }

    /**
     * viewSolarSeasonalFestivalName が端午の節句の式名を返すことを確認する。
     */
    public function test_viewSolarSeasonalFestivalName_tango(): void
    {
        $date = new DateTime('2026-05-05');
        $this->assertSame('端午の節句', $date->solarSeasonalFestivalName);
    }

    /**
     * viewSolarSeasonalFestivalAlias が端午の節句の別名を返すことを確認する。
     */
    public function test_viewSolarSeasonalFestivalAlias_tango(): void
    {
        $date = new DateTime('2026-05-05');
        $this->assertSame('菖蒲の節句', $date->solarSeasonalFestivalAlias);
    }

    /**
     * getLunarSeasonalFestival が旧暦5月5日（端午）に SEASONAL_FESTIVAL_TANGO を返すことを確認する。
     *
     * 2026-06-19 = 旧暦5月5日（端午）。
     */
    public function test_getLunarSeasonalFestival_tango(): void
    {
        // 2026-06-19 = 旧暦5月5日（端午）
        $date = new DateTime('2026-06-19');
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $date->lunarSeasonalFestival);
    }

    /**
     * viewLunarSeasonalFestivalName が旧暦端午の節句の式名を返すことを確認する。
     */
    public function test_viewLunarSeasonalFestivalName_tango(): void
    {
        $date = new DateTime('2026-06-19');
        $this->assertSame('端午の節句', $date->lunarSeasonalFestivalName);
    }

    /**
     * viewLunarSeasonalFestivalAlias が旧暦端午の節句の別名を返すことを確認する。
     */
    public function test_viewLunarSeasonalFestivalAlias_tango(): void
    {
        $date = new DateTime('2026-06-19');
        $this->assertSame('菖蒲の節句', $date->lunarSeasonalFestivalAlias);
    }

    /**
     * 五節句でない日はすべてのプロパティが 0 または空文字列を返すことを確認する。
     */
    public function test_solarSeasonalFestival_none(): void
    {
        $date = new DateTime('2026-04-15');
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_NONE, $date->solarSeasonalFestival);
        $this->assertSame('', $date->solarSeasonalFestivalName);
        $this->assertSame('', $date->solarSeasonalFestivalAlias);
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_NONE, $date->lunarSeasonalFestival);
        $this->assertSame('', $date->lunarSeasonalFestivalName);
        $this->assertSame('', $date->lunarSeasonalFestivalAlias);
    }

    /**
     * getMiscSeasonalNode が節分の日に MISC_SEASONAL_NODE_SETSUBUN を返すことを確認する。
     */
    public function test_getMiscSeasonalNode_setsubun(): void
    {
        $date = new DateTime('2026-02-03');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $date->miscSeasonalNode);
    }

    /**
     * viewMiscSeasonalNode が節分の日本語名を返すことを確認する。
     */
    public function test_viewMiscSeasonalNode_setsubun(): void
    {
        $date = new DateTime('2026-02-03');
        $this->assertSame('節分', $date->miscSeasonalNodeText);
    }

    /**
     * getMiscSeasonalNode が雑節でない日に MISC_SEASONAL_NODE_NONE を返すことを確認する。
     */
    public function test_getMiscSeasonalNode_none(): void
    {
        $date = new DateTime('2026-04-15');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NONE, $date->miscSeasonalNode);
        $this->assertSame('', $date->miscSeasonalNodeText);
    }

    /**
     * DateTime::ORIENTAL_ZODIAC_* 定数が正しいことを確認する。
     */
    public function test_orientalZodiac_constants(): void
    {
        $this->assertSame(0, DateTime::ORIENTAL_ZODIAC_I);
        $this->assertSame(1, DateTime::ORIENTAL_ZODIAC_NE);
        $this->assertSame(2, DateTime::ORIENTAL_ZODIAC_USHI);
        $this->assertSame(3, DateTime::ORIENTAL_ZODIAC_TORA);
        $this->assertSame(4, DateTime::ORIENTAL_ZODIAC_U);
        $this->assertSame(5, DateTime::ORIENTAL_ZODIAC_TATSU);
        $this->assertSame(6, DateTime::ORIENTAL_ZODIAC_MI);
        $this->assertSame(7, DateTime::ORIENTAL_ZODIAC_UMA);
        $this->assertSame(8, DateTime::ORIENTAL_ZODIAC_HITSUJI);
        $this->assertSame(9, DateTime::ORIENTAL_ZODIAC_SARU);
        $this->assertSame(10, DateTime::ORIENTAL_ZODIAC_TORI);
        $this->assertSame(11, DateTime::ORIENTAL_ZODIAC_INU);
    }
}
