<?php

namespace Tests\JapaneseDate\Elements;

use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 *
 */

/**
 *
 */
#[CoversClass(SolarTermDate::class)]
class SolarTermDateTest extends TestCase
{
    // -------------------------------------------------------------------------
    // コンストラクタ
    // -------------------------------------------------------------------------

    /**
     * 二十四節気番号と月の対応表を返す
     *
     * @return array
     */
    public static function solarTermMonthProvider(): array
    {
        return [
            [0, 3],  // 春分
            [1, 4],  // 清明
            [2, 4],  // 穀雨
            [3, 5],  // 立夏
            [4, 5],  // 小満
            [5, 6],  // 芒種
            [6, 6],  // 夏至
            [7, 7],  // 小暑
            [8, 7],  // 大暑
            [9, 8],  // 立秋
            [10, 8],  // 処暑
            [11, 9],  // 白露
            [12, 9],  // 秋分
            [13, 10], // 寒露
            [14, 10], // 霜降
            [15, 11], // 立冬
            [16, 11], // 小雪
            [17, 12], // 大雪
            [18, 12], // 冬至
            [19, 1],  // 小寒
            [20, 1],  // 大寒
            [21, 2],  // 立春
            [22, 2],  // 雨水
            [23, 3],  // 啓蟄
        ];
    }

    /**
     * 中気にあたる二十四節気では is_chuki が true になることを確認する
     *
     * @return void
     */
    public function test_construct_chuki_sets_is_chuki_true(): void
    {
        // solar_term が偶数 → is_chuki = true
        $obj = new SolarTermDate(2024, 0, 20); // 春分 (solar_term=0, 偶数)
        $this->assertTrue($obj->is_chuki);
        $this->assertFalse($obj->is_sekki);
    }

    /**
     * 節気にあたる二十四節気では is_sekki が true になることを確認する
     *
     * @return void
     */
    public function test_construct_sekki_sets_is_sekki_true(): void
    {
        // solar_term が奇数 → is_sekki = true
        $obj = new SolarTermDate(2024, 1, 4); // 清明 (solar_term=1, 奇数)
        $this->assertTrue($obj->is_sekki);
        $this->assertFalse($obj->is_chuki);
    }

    /**
     * 年が保持されることを確認する
     *
     * @return void
     */
    public function test_construct_sets_year(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertSame(2024, $obj->year);
    }

    /**
     * 日が保持されることを確認する
     *
     * @return void
     */
    public function test_construct_sets_day(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertSame(20, $obj->day);
    }

    /**
     * 二十四節気番号が保持されることを確認する
     *
     * @return void
     */
    public function test_construct_sets_solar_term(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertSame(0, $obj->solar_term);
    }

    // -------------------------------------------------------------------------
    // 二十四節気と月の対応
    // -------------------------------------------------------------------------

    /**
     * 二十四節気番号から太陽黄経が算出されることを確認する
     *
     * @return void
     */
    public function test_construct_sets_solar_longitude(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertEquals(0, $obj->solar_longitude);

        $obj2 = new SolarTermDate(2024, 6, 21);
        $this->assertEquals(90, $obj2->solar_longitude);
    }

    /**
     * 二十四節気番号から対応する月が設定されることを確認する
     *
     * @param int $solar_term
     * @param int $expected_month
     * @return void
     */
    #[DataProvider('solarTermMonthProvider')]
    public function test_construct_month_mapping(int $solar_term, int $expected_month): void
    {
        $obj = new SolarTermDate(2000, $solar_term, 1);
        $this->assertSame($expected_month, $obj->month);
    }

    // -------------------------------------------------------------------------
    // マジックメソッド __get
    // -------------------------------------------------------------------------

    /**
     * 保持している属性値をプロパティとして取得できることを確認する
     *
     * @return void
     */
    public function test_get_returns_attribute_value(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertSame(2024, $obj->year);
        $this->assertSame(0, $obj->solar_term);
        $this->assertSame(20, $obj->day);
        $this->assertSame(3, $obj->month);
        $this->assertEquals(0, $obj->solar_longitude);
        $this->assertTrue($obj->is_chuki);
        $this->assertFalse($obj->is_sekki);
    }

    /**
     * 二十四節気名を取得できることを確認する
     *
     * @return void
     */
    public function test_get_solar_term_text(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        // noinspection PhpUndefinedFieldInspection
        $this->assertSame(JapaneseDate::SOLAR_TERM[0], $obj->solarTermText);
    }

    /**
     * 二十四節気の日付を DateTime として取得できることを確認する
     *
     * @return void
     */
    public function test_get_date_time(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        // noinspection PhpUndefinedFieldInspection
        $dt = $obj->dateTime;
        $this->assertInstanceOf(DateTime::class, $dt);
        $this->assertSame(2024, (int) $dt->format('Y'));
        $this->assertSame(3, (int) $dt->format('n'));
        $this->assertSame(20, (int) $dt->format('j'));
    }

    /**
     * 未定義キーを取得した場合は null になることを確認する
     *
     * @return void
     */
    public function test_get_unknown_key_returns_null(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        // noinspection PhpUndefinedFieldInspection
        $this->assertNull($obj->nonExistentKey);
    }

    // -------------------------------------------------------------------------
    // マジックメソッド __set
    // -------------------------------------------------------------------------

    /**
     * プロパティ変更を禁止していることを確認する
     *
     * @return void
     */
    public function test_set_throws_runtime_exception(): void
    {
        $this->expectException(RuntimeException::class);
        $obj = new SolarTermDate(2024, 0, 20);
        // IDE での型ヒントを回避するために、あえて stdClass として扱う
        /** @var \stdClass $obj */
        $obj->year = 2025;
    }

    // -------------------------------------------------------------------------
    // マジックメソッド __isset
    // -------------------------------------------------------------------------

    /**
     * 保持している属性キーは isset で true になることを確認する
     *
     * @return void
     */
    public function test_isset_attribute_key_returns_true(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertTrue(isset($obj->year));
        $this->assertTrue(isset($obj->month));
        $this->assertTrue(isset($obj->day));
        $this->assertTrue(isset($obj->solar_term));
        $this->assertTrue(isset($obj->solar_longitude));
        $this->assertTrue(isset($obj->is_chuki));
        $this->assertTrue(isset($obj->is_sekki));
    }

    /**
     * 二十四節気名は isset で true になることを確認する
     *
     * @return void
     */
    public function test_isset_solar_term_text_returns_true(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertTrue(isset($obj->solarTermText));
    }

    /**
     * dateTime は isset で true になることを確認する
     *
     * @return void
     */
    public function test_isset_date_time_returns_true(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertTrue(isset($obj->dateTime));
    }

    /**
     * 未定義キーは isset で false になることを確認する
     *
     * @return void
     */
    public function test_isset_unknown_key_returns_false(): void
    {
        $obj = new SolarTermDate(2024, 0, 20);
        $this->assertFalse(isset($obj->nonExistentKey));
    }
}
