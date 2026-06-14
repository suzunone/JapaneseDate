<?php

/**
 * SeasonalFestival コンポーネントのテスト
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

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\SeasonalFestival;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * SeasonalFestival コンポーネントのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 * @covers \JapaneseDate\Components\SeasonalFestival
 * @covers \JapaneseDate\Components\SeasonalFestival::factory
 * @covers \JapaneseDate\Components\SeasonalFestival::getSolarFestivalKey
 * @covers \JapaneseDate\Components\SeasonalFestival::viewSolarFestivalName
 * @covers \JapaneseDate\Components\SeasonalFestival::viewSolarFestivalAlias
 * @covers \JapaneseDate\Components\SeasonalFestival::getLunarFestivalKey
 * @covers \JapaneseDate\Components\SeasonalFestival::viewLunarFestivalName
 * @covers \JapaneseDate\Components\SeasonalFestival::viewLunarFestivalAlias
 * @covers \JapaneseDate\Components\SeasonalFestival::viewName
 * @covers \JapaneseDate\Components\SeasonalFestival::viewAlias
 */
class SeasonalFestivalTest extends TestCase
{
    // =========================================================================
    // ファクトリー・定数テスト
    // =========================================================================
    /**
     * @return array[]
     */
    public static function viewNameProvider(): array
    {
        return [
            '節句なし' => [0, ''],
            '人日の節句' => [1, '人日の節句'],
            '上巳の節句' => [2, '上巳の節句'],
            '端午の節句' => [3, '端午の節句'],
            '七夕の節句' => [4, '七夕の節句'],
            '重陽の節句' => [5, '重陽の節句'],
            '存在しないキー' => [999, ''],
        ];
    }
    /**
     * @return array[]
     */
    public static function viewAliasProvider(): array
    {
        return [
            '節句なし' => [0, ''],
            '七草の節句' => [1, '七草の節句'],
            '桃の節句' => [2, '桃の節句'],
            '菖蒲の節句' => [3, '菖蒲の節句'],
            '笹の節句' => [4, '笹の節句'],
            '菊の節句' => [5, '菊の節句'],
            '存在しないキー' => [999, ''],
        ];
    }
    /**
     * @return array[]
     */
    public static function solarFestivalProvider(): array
    {
        return [
            '1月7日（人日）' => ['2026-01-07', DateTime::SEASONAL_FESTIVAL_JINJITSU],
            '3月3日（上巳）' => ['2026-03-03', DateTime::SEASONAL_FESTIVAL_JOSHI],
            '5月5日（端午）' => ['2026-05-05', DateTime::SEASONAL_FESTIVAL_TANGO],
            '7月7日（七夕）' => ['2026-07-07', DateTime::SEASONAL_FESTIVAL_TANABATA],
            '9月9日（重陽）' => ['2026-09-09', DateTime::SEASONAL_FESTIVAL_CHOYO],
            '節句でない日' => ['2026-06-01', DateTime::SEASONAL_FESTIVAL_NONE],
            '12月31日（なし）' => ['2026-12-31', DateTime::SEASONAL_FESTIVAL_NONE],
        ];
    }
    // =========================================================================
    // viewName / viewAlias ユーティリティテスト
    // =========================================================================
    /**
     * @return array[]
     */
    public static function lunarFestivalProvider(): array
    {
        return [
            '旧暦1月7日=2026-02-23（人日）' => ['2026-02-23', DateTime::SEASONAL_FESTIVAL_JINJITSU],
            '旧暦3月3日=2026-04-19（上巳）' => ['2026-04-19', DateTime::SEASONAL_FESTIVAL_JOSHI],
            '旧暦5月5日=2026-06-19（端午）' => ['2026-06-19', DateTime::SEASONAL_FESTIVAL_TANGO],
            '旧暦7月7日=2026-08-19（七夕）' => ['2026-08-19', DateTime::SEASONAL_FESTIVAL_TANABATA],
            '旧暦9月9日=2026-10-19（重陽）' => ['2026-10-19', DateTime::SEASONAL_FESTIVAL_CHOYO],
            '節句でない旧暦日' => ['2026-06-01', DateTime::SEASONAL_FESTIVAL_NONE],
        ];
    }
    /**
     * factory() がシングルトンを返すことを確認する。
     */
    public function test_factory_returnsSameInstance(): void
    {
        $a = SeasonalFestival::factory();
        $b = SeasonalFestival::factory();
        $this->assertSame($a, $b);
        $this->assertInstanceOf(SeasonalFestival::class, $a);
    }
    /**
     * FESTIVAL_NAMES 定数がすべての式名を含むことを確認する。
     */
    public function test_festivalNamesConstant(): void
    {
        $names = SeasonalFestival::FESTIVAL_NAMES;
        $this->assertSame('', $names[0]);
        $this->assertSame('人日の節句', $names[1]);
        $this->assertSame('上巳の節句', $names[2]);
        $this->assertSame('端午の節句', $names[3]);
        $this->assertSame('七夕の節句', $names[4]);
        $this->assertSame('重陽の節句', $names[5]);
    }
    /**
     * FESTIVAL_ALIASES 定数がすべての別名（通称）を含むことを確認する。
     */
    public function test_festivalAliasesConstant(): void
    {
        $aliases = SeasonalFestival::FESTIVAL_ALIASES;
        $this->assertSame('', $aliases[0]);
        $this->assertSame('七草の節句', $aliases[1]);
        $this->assertSame('桃の節句', $aliases[2]);
        $this->assertSame('菖蒲の節句', $aliases[3]);
        $this->assertSame('笹の節句', $aliases[4]);
        $this->assertSame('菊の節句', $aliases[5]);
    }
    // =========================================================================
    // 西暦（新暦）五節句テスト
    // =========================================================================
    /**
     * viewName がキーから正しい式名を返すことを確認する。
     *
     * @param int $key 五節句定数
     * @param string $expected 期待する式名
     * @dataProvider viewNameProvider
     */
    public function test_viewName($key, $expected): void
    {
        $festival = SeasonalFestival::factory();
        $this->assertSame($expected, $festival->viewName($key));
    }
    /**
     * viewAlias がキーから正しい別名（通称）を返すことを確認する。
     *
     * @param int $key 五節句定数
     * @param string $expected 期待する別名
     * @dataProvider viewAliasProvider
     */
    public function test_viewAlias($key, $expected): void
    {
        $festival = SeasonalFestival::factory();
        $this->assertSame($expected, $festival->viewAlias($key));
    }
    /**
     * 西暦固定日の五節句が正しく判定されることを確認する。
     *
     * @param string $date テスト日付（Y-m-d 形式）
     * @param int $expected 期待する五節句定数
     * @dataProvider solarFestivalProvider
     */
    public function test_getSolarFestivalKey($date, $expected): void
    {
        $festival = SeasonalFestival::factory();
        $this->assertSame($expected, $festival->getSolarFestivalKey(DateTime::parse($date)));
    }
    /**
     * 西暦の五節句の式名が正しく返されることを確認する。
     */
    public function test_viewSolarFestivalName(): void
    {
        $festival = SeasonalFestival::factory();
        $this->assertSame('人日の節句', $festival->viewSolarFestivalName(DateTime::parse('2026-01-07')));
        $this->assertSame('上巳の節句', $festival->viewSolarFestivalName(DateTime::parse('2026-03-03')));
        $this->assertSame('端午の節句', $festival->viewSolarFestivalName(DateTime::parse('2026-05-05')));
        $this->assertSame('七夕の節句', $festival->viewSolarFestivalName(DateTime::parse('2026-07-07')));
        $this->assertSame('重陽の節句', $festival->viewSolarFestivalName(DateTime::parse('2026-09-09')));
        $this->assertSame('', $festival->viewSolarFestivalName(DateTime::parse('2026-06-01')));
    }
    // =========================================================================
    // 旧暦五節句テスト
    // =========================================================================
    /**
     * 西暦の五節句の別名（通称）が正しく返されることを確認する。
     */
    public function test_viewSolarFestivalAlias(): void
    {
        $festival = SeasonalFestival::factory();
        $this->assertSame('七草の節句', $festival->viewSolarFestivalAlias(DateTime::parse('2026-01-07')));
        $this->assertSame('桃の節句', $festival->viewSolarFestivalAlias(DateTime::parse('2026-03-03')));
        $this->assertSame('菖蒲の節句', $festival->viewSolarFestivalAlias(DateTime::parse('2026-05-05')));
        $this->assertSame('笹の節句', $festival->viewSolarFestivalAlias(DateTime::parse('2026-07-07')));
        $this->assertSame('菊の節句', $festival->viewSolarFestivalAlias(DateTime::parse('2026-09-09')));
        $this->assertSame('', $festival->viewSolarFestivalAlias(DateTime::parse('2026-06-01')));
    }
    /**
     * 旧暦の五節句が正しく判定されることを確認する。
     *
     * 2026年の旧暦対応グレゴリオ暦日:
     * - 人日（旧暦1月7日）= 2026-02-23
     * - 上巳（旧暦3月3日）= 2026-04-19
     * - 端午（旧暦5月5日）= 2026-06-19
     * - 七夕（旧暦7月7日）= 2026-08-19
     * - 重陽（旧暦9月9日）= 2026-10-19
     *
     * @param string $date テスト日付（Y-m-d 形式）
     * @param int $expected 期待する五節句定数
     * @dataProvider lunarFestivalProvider
     */
    public function test_getLunarFestivalKey($date, $expected): void
    {
        $festival = SeasonalFestival::factory();
        $result = $festival->getLunarFestivalKey(DateTime::parse($date));
        $this->assertSame($expected, $result);
    }
    /**
     * 旧暦の五節句の式名が正しく返されることを確認する。
     */
    public function test_viewLunarFestivalName(): void
    {
        $festival = SeasonalFestival::factory();
        // 旧暦1月7日 = 2026-02-23（人日）
        $this->assertSame('人日の節句', $festival->viewLunarFestivalName(DateTime::parse('2026-02-23')));
        // 旧暦5月5日 = 2026-06-19（端午）
        $this->assertSame('端午の節句', $festival->viewLunarFestivalName(DateTime::parse('2026-06-19')));
        // 節句でない日
        $this->assertSame('', $festival->viewLunarFestivalName(DateTime::parse('2026-06-01')));
    }
    /**
     * 旧暦の五節句の別名（通称）が正しく返されることを確認する。
     */
    public function test_viewLunarFestivalAlias(): void
    {
        $festival = SeasonalFestival::factory();
        // 旧暦1月7日 = 2026-02-23（人日）→ 七草の節句
        $this->assertSame('七草の節句', $festival->viewLunarFestivalAlias(DateTime::parse('2026-02-23')));
        // 旧暦5月5日 = 2026-06-19（端午）→ 菖蒲の節句
        $this->assertSame('菖蒲の節句', $festival->viewLunarFestivalAlias(DateTime::parse('2026-06-19')));
        // 節句でない日
        $this->assertSame('', $festival->viewLunarFestivalAlias(DateTime::parse('2026-06-01')));
    }
    // =========================================================================
    // 西暦と旧暦の日付差異テスト
    // =========================================================================
    /**
     * 西暦5月5日は端午の節句だが、旧暦では端午の節句でないことを確認する。
     *
     * 2026年の場合: 西暦5月5日の旧暦は3月17日であり、旧暦5月5日ではない。
     */
    public function test_solarAndLunarDifference(): void
    {
        $festival = SeasonalFestival::factory();
        $date = DateTime::parse('2026-05-05'); // 西暦5月5日

        // 西暦では端午の節句
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $festival->getSolarFestivalKey($date));

        // 旧暦では端午の節句ではない（旧暦5月5日はまだ先）
        $lunarKey = $festival->getLunarFestivalKey($date);
        $this->assertNotSame(DateTime::SEASONAL_FESTIVAL_TANGO, $lunarKey);
    }
    // =========================================================================
    // DateTimeImmutable 統合テスト
    // =========================================================================
    /**
     * DateTimeImmutable でも五節句が正しく判定されることを確認する。
     */
    public function test_withDateTimeImmutable(): void
    {
        $festival = SeasonalFestival::factory();
        $date = DateTimeImmutable::parse('2026-03-03');

        $this->assertSame(DateTime::SEASONAL_FESTIVAL_JOSHI, $festival->getSolarFestivalKey($date));
        $this->assertSame('上巳の節句', $festival->viewSolarFestivalName($date));
        $this->assertSame('桃の節句', $festival->viewSolarFestivalAlias($date));
    }
    // =========================================================================
    // DateTime プロパティ統合テスト
    // =========================================================================
    /**
     * DateTime の西暦五節句プロパティが正しく動作することを確認する。
     */
    public function test_datetime_solarProperties(): void
    {
        // 端午の節句（5月5日）
        $date = DateTime::parse('2026-05-05');
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $date->solarSeasonalFestival);
        $this->assertSame('端午の節句', $date->solarSeasonalFestivalName);
        $this->assertSame('菖蒲の節句', $date->solarSeasonalFestivalAlias);

        // スネークケースでもアクセス可能
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $date->solar_seasonal_festival);
        $this->assertSame('端午の節句', $date->solar_seasonal_festival_name);
        $this->assertSame('菖蒲の節句', $date->solar_seasonal_festival_alias);
    }
    /**
     * DateTime の旧暦五節句プロパティが正しく動作することを確認する。
     *
     * 2026-06-19 = 旧暦5月5日（端午の節句）。
     */
    public function test_datetime_lunarProperties(): void
    {
        $date = DateTime::parse('2026-06-19');
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $date->lunarSeasonalFestival);
        $this->assertSame('端午の節句', $date->lunarSeasonalFestivalName);
        $this->assertSame('菖蒲の節句', $date->lunarSeasonalFestivalAlias);

        // スネークケースでもアクセス可能
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_TANGO, $date->lunar_seasonal_festival);
        $this->assertSame('端午の節句', $date->lunar_seasonal_festival_name);
        $this->assertSame('菖蒲の節句', $date->lunar_seasonal_festival_alias);
    }
    /**
     * DateTimeImmutable のプロパティが正しく動作することを確認する。
     */
    public function test_datetimeImmutable_properties(): void
    {
        $date = DateTimeImmutable::parse('2026-09-09');
        $this->assertSame(DateTimeImmutable::SEASONAL_FESTIVAL_CHOYO, $date->solarSeasonalFestival);
        $this->assertSame('重陽の節句', $date->solarSeasonalFestivalName);
        $this->assertSame('菊の節句', $date->solarSeasonalFestivalAlias);
    }
    /**
     * 節句でない日は SEASONAL_FESTIVAL_NONE（0）と空文字列を返すことを確認する。
     */
    public function test_datetime_none(): void
    {
        $date = DateTime::parse('2026-04-15');
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_NONE, $date->solarSeasonalFestival);
        $this->assertSame('', $date->solarSeasonalFestivalName);
        $this->assertSame('', $date->solarSeasonalFestivalAlias);
        $this->assertSame(DateTime::SEASONAL_FESTIVAL_NONE, $date->lunarSeasonalFestival);
        $this->assertSame('', $date->lunarSeasonalFestivalName);
        $this->assertSame('', $date->lunarSeasonalFestivalAlias);
    }
    /**
     * 五節句定数が DateTime クラスに正しく定義されていることを確認する。
     */
    public function test_constants(): void
    {
        $this->assertSame(0, DateTime::SEASONAL_FESTIVAL_NONE);
        $this->assertSame(1, DateTime::SEASONAL_FESTIVAL_JINJITSU);
        $this->assertSame(2, DateTime::SEASONAL_FESTIVAL_JOSHI);
        $this->assertSame(3, DateTime::SEASONAL_FESTIVAL_TANGO);
        $this->assertSame(4, DateTime::SEASONAL_FESTIVAL_TANABATA);
        $this->assertSame(5, DateTime::SEASONAL_FESTIVAL_CHOYO);
    }
}
