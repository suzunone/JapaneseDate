<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Era コンポーネントのユニットテスト。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace Tests\JapaneseDate\Components;

use DateTimeZone;
use JapaneseDate\Components\JisEra;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Era コンポーネントのユニットテスト。
 *
 * 以下のケースを網羅します:
 * - 日付から元号定数を判定する getEraKey()
 * - 西暦年と元号定数から元号年を計算する getEraYear()
 * - 元号定数から元号名文字列を返す getEraNameString()
 * - factory() シングルトン動作
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */
#[CoversClass(JisEra::class)]
class EraTest extends TestCase
{
    use InvokeTrait;

    protected function setUp(): void
    {
        // シングルトンをリセットしてテスト間の干渉を防ぐ
        $this->invokeSetProperty(JisEra::class, 'instance', null);
    }

    protected function tearDown(): void
    {
        $this->invokeSetProperty(JisEra::class, 'instance', null);
    }

    // =========================================================================
    // factory()
    // =========================================================================

    /**
     * factory() は同一インスタンスを返すこと。
     */
    public function test_factory_returns_same_instance(): void
    {
        $a = JisEra::factory();
        $b = JisEra::factory();
        $this->assertSame($a, $b);
    }

    // =========================================================================
    // getEraKey()
    // =========================================================================

    /**
     * getEraKey のテストデータ。
     *
     * @return array<string, array{string, int}>
     */
    public static function eraKeyProvider(): array
    {
        return [
            '明治（1912-07-29 JST 直前）' => ['1912-07-29T23:59:59+09:00', DateTime::ERA_MEIJI],
            '大正開始日（1912-07-30 JST）' => ['1912-07-30T00:00:00+09:00', DateTime::ERA_TAISHO],
            '大正（1926-12-24 JST）' => ['1926-12-24T23:59:59+09:00', DateTime::ERA_TAISHO],
            '昭和開始日（1926-12-25 JST）' => ['1926-12-25T00:00:00+09:00', DateTime::ERA_SHOWA],
            '昭和（1989-01-07 JST）' => ['1989-01-07T23:59:59+09:00', DateTime::ERA_SHOWA],
            '平成開始日（1989-01-08 JST）' => ['1989-01-08T00:00:00+09:00', DateTime::ERA_HEISEI],
            '平成（2019-04-30 JST）' => ['2019-04-30T23:59:59+09:00', DateTime::ERA_HEISEI],
            '令和開始日（2019-05-01 JST）' => ['2019-05-01T00:00:00+09:00', DateTime::ERA_REIWA],
            '令和（2026-01-01 JST）' => ['2026-01-01T00:00:00+09:00', DateTime::ERA_REIWA],
        ];
    }

    /**
     * DateTime インスタンスで getEraKey() が正しい元号定数を返すこと。
     */
    #[DataProvider('eraKeyProvider')]
    public function test_getEraKey_with_DateTime(string $dateStr, int $expectedEra): void
    {
        $dt = new DateTime($dateStr);
        $era = new JisEra();
        $this->assertSame($expectedEra, $era->getEraKey($dt));
    }

    /**
     * DateTimeImmutable インスタンスでも getEraKey() が正しい元号定数を返すこと。
     */
    #[DataProvider('eraKeyProvider')]
    public function test_getEraKey_with_DateTimeImmutable(string $dateStr, int $expectedEra): void
    {
        $dt = new DateTimeImmutable($dateStr);
        $era = new JisEra();
        $this->assertSame($expectedEra, $era->getEraKey($dt));
    }

    // =========================================================================
    // getEraYear()
    // =========================================================================

    /**
     * getEraYear のテストデータ。
     *
     * @return array<string, array{int, int, int}>
     */
    public static function eraYearProvider(): array
    {
        return [
            '明治元年（1868年）' => [1868, DateTime::ERA_MEIJI,  1],
            '明治45年（1912年）' => [1912, DateTime::ERA_MEIJI, 45],
            '大正元年（1912年）' => [1912, DateTime::ERA_TAISHO, 1],
            '大正15年（1926年）' => [1926, DateTime::ERA_TAISHO, 15],
            '昭和元年（1926年）' => [1926, DateTime::ERA_SHOWA,  1],
            '昭和64年（1989年）' => [1989, DateTime::ERA_SHOWA, 64],
            '平成元年（1989年）' => [1989, DateTime::ERA_HEISEI, 1],
            '平成31年（2019年）' => [2019, DateTime::ERA_HEISEI, 31],
            '令和元年（2019年）' => [2019, DateTime::ERA_REIWA,  1],
            '令和8年（2026年）' => [2026, DateTime::ERA_REIWA,  8],
        ];
    }

    /**
     * getEraYear() が正しい元号年を返すこと。
     */
    #[DataProvider('eraYearProvider')]
    public function test_getEraYear(int $gregorianYear, int $eraKey, int $expectedYear): void
    {
        $era = new JisEra();
        $this->assertSame($expectedYear, $era->getEraYear($gregorianYear, $eraKey));
    }

    // =========================================================================
    // getEraNameString()
    // =========================================================================

    /**
     * getEraNameString のテストデータ。
     *
     * @return array<string, array{int, string}>
     */
    public static function eraNameProvider(): array
    {
        return [
            '明治' => [DateTime::ERA_MEIJI,  '明治'],
            '大正' => [DateTime::ERA_TAISHO, '大正'],
            '昭和' => [DateTime::ERA_SHOWA,  '昭和'],
            '平成' => [DateTime::ERA_HEISEI, '平成'],
            '令和' => [DateTime::ERA_REIWA,  '令和'],
        ];
    }

    /**
     * getEraNameString() が正しい元号名を返すこと。
     */
    #[DataProvider('eraNameProvider')]
    public function test_getEraNameString(int $eraKey, string $expectedName): void
    {
        $era = new JisEra();
        $this->assertSame($expectedName, $era->getEraNameString($eraKey));
    }

    /**
     * 未知の元号キーを渡すと空文字列を返すこと。
     */
    public function test_getEraNameString_returns_empty_for_unknown_key(): void
    {
        $era = new JisEra();
        $this->assertSame('', $era->getEraNameString(9999));
    }

    // =========================================================================
    // parseJisDate()
    // =========================================================================

    /**
     * JST タイムゾーンで指定日時の Unix タイムスタンプを返すヘルパー。
     */
    private static function jst(int $year, int $month, int $day, int $hour = 0, int $minute = 0, int $second = 0): float
    {
        $dt = \DateTimeImmutable::createFromFormat(
            '!Y-m-d H:i:s',
            sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, $hour, $minute, $second),
            new DateTimeZone('Asia/Tokyo')
        );

        return (float) $dt->getTimestamp();
    }

    /**
     * parseJisDate のテストデータ。
     *
     * @return array<string, array{string, int|float|null}>
     */
    public static function parseJisDateProvider(): array
    {
        return [
            'ISO形式（ハイフン）' => ['2019-05-01',                  self::jst(2019, 5, 1)],
            'ISO形式（スラッシュ）' => ['2019/05/01',                  self::jst(2019, 5, 1)],
            'ISO形式（時刻付き）' => ['2019-05-01 12:34:56',         self::jst(2019, 5, 1, 12, 34, 56)],
            '日本語西暦形式' => ['2019年5月1日',                 self::jst(2019, 5, 1)],
            '日本語西暦形式（時刻付き）' => ['2019年5月1日 12時34分56秒',    self::jst(2019, 5, 1, 12, 34, 56)],
            '漢字元号形式（令和）' => ['令和1年5月1日',                self::jst(2019, 5, 1)],
            '漢字元号形式（平成）' => ['平成31年4月30日',               self::jst(2019, 4, 30)],
            'アルファベット元号（R）' => ['R1-05-01',                     self::jst(2019, 5, 1)],
            'アルファベット元号（H）' => ['H31/04/30',                    self::jst(2019, 4, 30)],
            'マイクロ秒付き' => ['2019-05-01.500000',            self::jst(2019, 5, 1) + 0.5],
            'strtotimeフォールバック' => ['May 1 2019 12:34:56 JST',      self::jst(2019, 5, 1, 12, 34, 56)],
            '不正な日付' => ['令和99年99月99日',              null],
            'パース不可能な文字列' => ['不正な文字列！！',              null],
        ];
    }

    /**
     * parseJisDate() が各書式を正しく Unix タイムスタンプへ変換すること。
     */
    #[DataProvider('parseJisDateProvider')]
    public function test_parseJisDate(string $input, int|float|null $expected): void
    {
        $era = new JisEra();
        $this->assertSame($expected, $era->parseJisDate($input));
    }
}
