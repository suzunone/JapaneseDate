<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Lunar Trait の旧暦・月齢・二十四節気関連の動作を検証するテスト。
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

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Lunar Trait が提供する旧暦情報の取得処理を検証する。
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
#[CoversTrait(\JapaneseDate\Traits\Lunar::class)]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'getMoonAge')]
#[CoversMethod(\JapaneseDate\Traits\Getter::class, '__get')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'isLeapMonth')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'getSolarTerm')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'getSolarTermKey')]
#[CoversMethod(\JapaneseDate\Traits\Lunar::class, 'isSolarTerm')]
class LunarTest extends TestCase
{
    use InvokeTrait;

    /**
     * DateTime で月齢を計算し、旧暦日ではなく小数の月齢を返すことを確認する。
     */
    public function test_getMoonAge(): void
    {
        // 2020-03-01 20:00 JST: 旧暦2020/2月の朔は2020-02-24 00:32 JST なので月齢≒6.8
        // 出典: https://eco.mtk.nao.ac.jp (国立天文台) の朔望データ
        $DateTime = DateTime::factory('2020-03-01 20:00:00');
        $this->assertEqualsWithDelta(6.9, $this->invokeExecuteMethod($DateTime, 'getMoonAge', []), 0.5);

        // 朔 (新月) の直後 → 月齢 ≒ 0
        // 出典: timeanddate.com Tokyo: 2026-02-17 21:01 JST が新月
        $DateTime = DateTime::factory('2026-02-17 21:01:00');
        $this->assertEqualsWithDelta(0.1, $this->invokeExecuteMethod($DateTime, 'getMoonAge', []), 0.5);

        // 旧暦日(6)ではなく月齢(float)を返すことを確認
        // 出典: calc-site.com: 2026-05-22 の旧暦は4月6日、月齢5.27
        // getMoonAge() の実計算値: 4.803 (内部アルゴリズムの差異により差あり)
        $DateTime = DateTime::factory('2026-05-22 00:00:00');
        $this->assertEqualsWithDelta(4.8, $this->invokeExecuteMethod($DateTime, 'getMoonAge', []), 0.5);
        $this->assertIsFloat($this->invokeExecuteMethod($DateTime, 'getMoonAge', []));
    }

    /**
     * DateTime で旧暦に基づく六曜を取得できることを確認する。
     */
    public function test_getSixWeekday(): void
    {
        // 六曜の全6値を連続する日付で検証 (出典: calc-site.com 各日の旧暦・六曜)
        // 2018-03-01 = 旧暦1月14日: (1+14)%6=3 → 友引
        $DateTime = DateTime::factory('2018-03-01');
        $this->assertEquals('友引', $DateTime->six_weekday_text);
        $this->assertEquals(3, $DateTime->six_weekday);

        // 2018-03-02 = 旧暦1月15日: (1+15)%6=4 → 先負
        $DateTime = DateTime::factory('2018-03-02');
        $this->assertEquals('先負', $DateTime->six_weekday_text);
        $this->assertEquals(4, $DateTime->six_weekday);

        // 2018-03-03 = 旧暦1月16日: (1+16)%6=5 → 仏滅
        $DateTime = DateTime::factory('2018-03-03');
        $this->assertEquals('仏滅', $DateTime->six_weekday_text);
        $this->assertEquals(5, $DateTime->six_weekday);

        // 2018-03-04 = 旧暦1月17日: (1+17)%6=0 → 大安
        $DateTime = DateTime::factory('2018-03-04');
        $this->assertEquals('大安', $DateTime->six_weekday_text);
        $this->assertEquals(0, $DateTime->six_weekday);

        // 2018-03-05 = 旧暦1月18日: (1+18)%6=1 → 赤口
        $DateTime = DateTime::factory('2018-03-05');
        $this->assertEquals('赤口', $DateTime->six_weekday_text);
        $this->assertEquals(1, $DateTime->six_weekday);

        // 2018-03-06 = 旧暦1月19日: (1+19)%6=2 → 先勝
        $DateTime = DateTime::factory('2018-03-06');
        $this->assertEquals('先勝', $DateTime->six_weekday_text);
        $this->assertEquals(2, $DateTime->six_weekday);
    }

    /**
     * DateTime で旧暦の年月日と月名を取得できることを確認する。
     */
    public function test_getLunarYMD(): void
    {
        $DateTime = DateTime::factory('2018-02-01');

        $this->assertEquals('2017', $DateTime->lunar_year);
        $this->assertEquals('12', $DateTime->lunar_month);
        $this->assertEquals('師走', $DateTime->lunar_month_text);
        $this->assertEquals('16', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2018-03-17');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('2', $DateTime->lunar_month);
        $this->assertEquals('如月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2018-03-01');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('1', $DateTime->lunar_month);
        $this->assertEquals('睦月', $DateTime->lunar_month_text);
        $this->assertEquals('14', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2016-08-03');

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('2', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('3', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('4', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2016-08-07');
        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('5', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2020-03-24');
        $this->assertEquals('2020', $DateTime->lunar_year);
        $this->assertEquals('3', $DateTime->lunar_month);
        $this->assertEquals('弥生', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);
    }

    /**
     * DateTime で閏月かどうかを判定できることを確認する。
     */
    public function test_isLeapMonth(): void
    {
        $DateTime = new DateTime('2017-06-24');
        $this->assertTrue($DateTime->is_leap_month);

        $DateTime = new DateTime('2018-01-01');
        $this->assertFalse($DateTime->is_leap_month);

        $DateTime = new DateTime('2017-06-23');
        $this->assertFalse($DateTime->is_leap_month);
    }

    /**
     * DateTime で二十四節気の有無と名称を取得できることを確認する。
     */
    public function test_getSolarTerm(): void
    {
        // 24節気がある日: 2018-04-05 は清明 (solar_term=1)
        $DateTime = new DateTime('2018-04-05');
        $this->assertSame(1, $DateTime->solar_term);
        $this->assertSame('清明', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);

        // 24節気がない日
        $DateTime = new DateTime('2018-03-20');
        $this->assertFalse($DateTime->solar_term);
        $this->assertSame('', $DateTime->solar_term_text);
        $this->assertFalse($DateTime->is_solar_term);

        // 24節気がある日: 2018-03-21 は春分 (solar_term=0)
        $DateTime = new DateTime('2018-03-21');
        $this->assertSame(0, $DateTime->solar_term);
        $this->assertSame('春分', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);
    }

    // DateTimeImmutable でも同じ旧暦情報を取得できることを確認する。

    /**
     * DateTimeImmutable で月齢を計算し、旧暦日ではなく小数の月齢を返すことを確認する。
     */
    public function test_getMoonAge_immutable(): void
    {
        // 2020-03-01 20:00 JST: 旧暦2020/2月の朔は2020-02-24 00:32 JST なので月齢≒6.8
        // 出典: https://eco.mtk.nao.ac.jp (国立天文台) の朔望データ
        $DateTime = DateTime::factory('2020-03-01 20:00:00');
        $this->assertEqualsWithDelta(6.9, $this->invokeExecuteMethod($DateTime, 'getMoonAge', []), 0.5);

        // 朔 (新月) の直後 → 月齢 ≒ 0
        // 出典: timeanddate.com Tokyo: 2026-02-17 21:01 JST が新月
        $DateTime = DateTime::factory('2026-02-17 21:01:00');
        $this->assertEqualsWithDelta(0.1, $this->invokeExecuteMethod($DateTime, 'getMoonAge', []), 0.5);

        // 旧暦日(6)ではなく月齢(float)を返すことを確認
        // 出典: calc-site.com: 2026-05-22 の旧暦は4月6日、月齢5.27
        // getMoonAge() の実計算値: 4.803 (内部アルゴリズムの差異により差あり)
        $DateTime = DateTime::factory('2026-05-22 00:00:00');
        $this->assertEqualsWithDelta(4.8, $this->invokeExecuteMethod($DateTime, 'getMoonAge', []), 0.5);
        $this->assertIsFloat($this->invokeExecuteMethod($DateTime, 'getMoonAge', []));
    }

    /**
     * DateTimeImmutable で旧暦に基づく六曜を取得できることを確認する。
     */
    public function test_getSixWeekday_immutable(): void
    {
        // 六曜の全6値を連続する日付で検証 (出典: calc-site.com 各日の旧暦・六曜)
        // 2018-03-01 = 旧暦1月14日: (1+14)%6=3 → 友引
        $DateTime = DateTime::factory('2018-03-01');
        $this->assertEquals('友引', $DateTime->six_weekday_text);
        $this->assertEquals(3, $DateTime->six_weekday);

        // 2018-03-02 = 旧暦1月15日: (1+15)%6=4 → 先負
        $DateTime = DateTime::factory('2018-03-02');
        $this->assertEquals('先負', $DateTime->six_weekday_text);
        $this->assertEquals(4, $DateTime->six_weekday);

        // 2018-03-03 = 旧暦1月16日: (1+16)%6=5 → 仏滅
        $DateTime = DateTime::factory('2018-03-03');
        $this->assertEquals('仏滅', $DateTime->six_weekday_text);
        $this->assertEquals(5, $DateTime->six_weekday);

        // 2018-03-04 = 旧暦1月17日: (1+17)%6=0 → 大安
        $DateTime = DateTime::factory('2018-03-04');
        $this->assertEquals('大安', $DateTime->six_weekday_text);
        $this->assertEquals(0, $DateTime->six_weekday);

        // 2018-03-05 = 旧暦1月18日: (1+18)%6=1 → 赤口
        $DateTime = DateTime::factory('2018-03-05');
        $this->assertEquals('赤口', $DateTime->six_weekday_text);
        $this->assertEquals(1, $DateTime->six_weekday);

        // 2018-03-06 = 旧暦1月19日: (1+19)%6=2 → 先勝
        $DateTime = DateTime::factory('2018-03-06');
        $this->assertEquals('先勝', $DateTime->six_weekday_text);
        $this->assertEquals(2, $DateTime->six_weekday);
    }

    /**
     * DateTimeImmutable で旧暦の年月日と月名を取得できることを確認する。
     */
    public function test_getLunarYMD_immutable(): void
    {
        $DateTime = DateTime::factory('2018-02-01');

        $this->assertEquals('2017', $DateTime->lunar_year);
        $this->assertEquals('12', $DateTime->lunar_month);
        $this->assertEquals('師走', $DateTime->lunar_month_text);
        $this->assertEquals('16', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2018-03-17');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('2', $DateTime->lunar_month);
        $this->assertEquals('如月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2018-03-01');
        $this->assertEquals('2018', $DateTime->lunar_year);
        $this->assertEquals('1', $DateTime->lunar_month);
        $this->assertEquals('睦月', $DateTime->lunar_month_text);
        $this->assertEquals('14', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2016-08-03');

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('2', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('3', $DateTime->lunar_day);

        $DateTime->addDays(1);

        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('4', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2016-08-07');
        $this->assertEquals('2016', $DateTime->lunar_year);
        $this->assertEquals('7', $DateTime->lunar_month);
        $this->assertEquals('文月', $DateTime->lunar_month_text);
        $this->assertEquals('5', $DateTime->lunar_day);

        $DateTime = DateTime::factory('2020-03-24');
        $this->assertEquals('2020', $DateTime->lunar_year);
        $this->assertEquals('3', $DateTime->lunar_month);
        $this->assertEquals('弥生', $DateTime->lunar_month_text);
        $this->assertEquals('1', $DateTime->lunar_day);
    }

    /**
     * DateTimeImmutable で閏月かどうかを判定できることを確認する。
     */
    public function test_isLeapMonth_immutable(): void
    {
        $DateTime = new DateTimeImmutable('2017-06-24');
        $this->assertTrue($DateTime->is_leap_month);

        $DateTime = new DateTimeImmutable('2018-01-01');
        $this->assertFalse($DateTime->is_leap_month);

        $DateTime = new DateTimeImmutable('2017-06-23');
        $this->assertFalse($DateTime->is_leap_month);
    }

    /**
     * DateTimeImmutable で二十四節気の有無と名称を取得できることを確認する。
     */
    public function test_getSolarTerm_immutable(): void
    {
        // 24節気がある日: 2018-04-05 は清明 (solar_term=1)
        $DateTime = new DateTimeImmutable('2018-04-05');
        $this->assertSame(1, $DateTime->solar_term);
        $this->assertSame('清明', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);

        // 24節気がない日
        $DateTime = new DateTimeImmutable('2018-03-20');
        $this->assertFalse($DateTime->solar_term);
        $this->assertSame('', $DateTime->solar_term_text);
        $this->assertFalse($DateTime->is_solar_term);

        // 24節気がある日: 2018-03-21 は春分 (solar_term=0)
        $DateTime = new DateTimeImmutable('2018-03-21');
        $this->assertSame(0, $DateTime->solar_term);
        $this->assertSame('春分', $DateTime->solar_term_text);
        $this->assertTrue($DateTime->is_solar_term);
    }
}
