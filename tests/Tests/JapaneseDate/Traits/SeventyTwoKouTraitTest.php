<?php

/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpUnusedParameterInspection */

/**
 * SeventyTwoKou Trait のユニットテスト。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Traits\SeventyTwoKou;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * SeventyTwoKou Trait の各メソッドを直接検証するテスト。
 *
 * protected な getter メソッドは InvokeTrait 経由で呼び出します。
 * public な移動メソッドは DateTime / DateTimeImmutable インスタンスを通じて検証します。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 * @covers \JapaneseDate\Traits\SeventyTwoKou
 * @covers \JapaneseDate\Traits\SeventyTwoKou::getSeventyTwoKou
 * @covers \JapaneseDate\Traits\SeventyTwoKou::getSeventyTwoKouText
 * @covers \JapaneseDate\Traits\SeventyTwoKou::getSeventyTwoKouReading
 * @covers \JapaneseDate\Traits\SeventyTwoKou::getSeventyTwoKouType
 * @covers \JapaneseDate\Traits\SeventyTwoKou::nextSeventyTwoKou
 * @covers \JapaneseDate\Traits\SeventyTwoKou::previousSeventyTwoKou
 */
class SeventyTwoKouTraitTest extends TestCase
{
    use InvokeTrait;
    // =========================================================================
    // Data Providers
    // =========================================================================
    /**
     * @return array<string, array{0: string, 1: int, 2: string, 3: string, 4: string}>
     */
    public static function provideKouData(): array
    {
        return [
            '立春初候' => ['2025-02-04', 1, '東風凍を解く', 'はるかぜ こおりをとく', '初候'],
            '立春次候' => ['2025-02-09', 2, 'うぐいす鳴く', 'うぐいす なく', '次候'],
            '立春末候' => ['2025-02-14', 3, '魚氷を上る', 'うお こおりをいずる', '末候'],
            '夏至初候' => ['2025-06-21', 28, '乃東枯る', 'なつかれくさ かるる', '初候'],
            '冬至初候' => ['2025-12-22', 64, '乃東生ず', 'なつかれくさ しょうず', '初候'],
            '大寒末候' => ['2026-01-30', 72, '鶏始めてとやにつく', 'にわとり はじめてとやにつく', '末候'],
        ];
    }
    // =========================================================================
    // getSeventyTwoKou() — protected: InvokeTrait 経由
    // =========================================================================
    /**
     * getSeventyTwoKou() が正しい候番号を返すことを確認する（DateTime）。
     * @dataProvider provideKouData
     */
    public function test_getSeventyTwoKou_via_DateTime(string $dateStr, int $expectedKou, string $_, string $__, string $___): void
    {
        $dt = new DateTime($dateStr);
        $kou = $this->invokeExecuteMethod($dt, 'getSeventyTwoKou', []);
        $this->assertSame($expectedKou, $kou);
    }
    /**
     * getSeventyTwoKou() が正しい候番号を返すことを確認する（DateTimeImmutable）。
     * @dataProvider provideKouData
     */
    public function test_getSeventyTwoKou_via_DateTimeImmutable(string $dateStr, int $expectedKou, string $_, string $__, string $___): void
    {
        $dt = new DateTimeImmutable($dateStr);
        $kou = $this->invokeExecuteMethod($dt, 'getSeventyTwoKou', []);
        $this->assertSame($expectedKou, $kou);
    }
    // =========================================================================
    // getSeventyTwoKouText() — protected: InvokeTrait 経由
    // =========================================================================
    /**
     * getSeventyTwoKouText() が正しい名称を返すことを確認する。
     * @dataProvider provideKouData
     */
    public function test_getSeventyTwoKouText(string $dateStr, int $_, string $expectedText, string $__, string $___): void
    {
        $dt = new DateTime($dateStr);
        $text = $this->invokeExecuteMethod($dt, 'getSeventyTwoKouText', []);
        $this->assertSame($expectedText, $text);
    }
    // =========================================================================
    // getSeventyTwoKouReading() — protected: InvokeTrait 経由
    // =========================================================================
    /**
     * getSeventyTwoKouReading() が正しい読みを返すことを確認する。
     * @dataProvider provideKouData
     */
    public function test_getSeventyTwoKouReading(string $dateStr, int $_, string $__, string $expectedReading, string $___): void
    {
        $dt = new DateTime($dateStr);
        $reading = $this->invokeExecuteMethod($dt, 'getSeventyTwoKouReading', []);
        $this->assertSame($expectedReading, $reading);
    }
    // =========================================================================
    // getSeventyTwoKouType() — protected: InvokeTrait 経由
    // =========================================================================
    /**
     * getSeventyTwoKouType() が正しい候種別を返すことを確認する。
     * @dataProvider provideKouData
     */
    public function test_getSeventyTwoKouType(string $dateStr, int $_, string $__, string $___, string $expectedType): void
    {
        $dt = new DateTime($dateStr);
        $type = $this->invokeExecuteMethod($dt, 'getSeventyTwoKouType', []);
        $this->assertSame($expectedType, $type);
    }
    // =========================================================================
    // nextSeventyTwoKou() — public
    // =========================================================================
    /**
     * nextSeventyTwoKou() が初候→次候の開始日へ移動することを確認する（DateTime）。
     */
    public function test_nextSeventyTwoKou_shokou_to_jikou_DateTime(): void
    {
        $dt = new DateTime('2025-02-04');
        $next = (clone $dt)->nextSeventyTwoKou();

        $this->assertSame('2025-02-08', $next->format('Y-m-d'));
        $this->assertSame(2, $this->invokeExecuteMethod($next, 'getSeventyTwoKou', []));
    }
    /**
     * nextSeventyTwoKou() が末候→次節気の初候へ移動することを確認する（DateTime）。
     */
    public function test_nextSeventyTwoKou_makkou_to_next_term_DateTime(): void
    {
        $dt = new DateTime('2025-02-14');
        $next = (clone $dt)->nextSeventyTwoKou();

        $this->assertSame(4, $this->invokeExecuteMethod($next, 'getSeventyTwoKou', []));
    }
    /**
     * nextSeventyTwoKou() が元のインスタンスを変更せず新インスタンスを返すことを確認する（DateTimeImmutable）。
     */
    public function test_nextSeventyTwoKou_immutable_preserves_original(): void
    {
        $dt = new DateTimeImmutable('2025-02-04');
        $next = $dt->nextSeventyTwoKou();

        $this->assertNotSame($dt, $next);
        $this->assertSame('2025-02-04', $dt->format('Y-m-d'), '元インスタンスは変更されない');
        $this->assertSame(2, $this->invokeExecuteMethod($next, 'getSeventyTwoKou', []));
    }
    /**
     * nextSeventyTwoKou() が年末年始をまたいで翌年の立春初候へ移動することを確認する。
     */
    public function test_nextSeventyTwoKou_crosses_year_boundary(): void
    {
        $dt = new DateTimeImmutable('2026-01-30'); // 大寒末候
        $next = $dt->nextSeventyTwoKou();

        $this->assertSame(1, $this->invokeExecuteMethod($next, 'getSeventyTwoKou', []));
    }
    // =========================================================================
    // previousSeventyTwoKou() — public
    // =========================================================================
    /**
     * previousSeventyTwoKou() が次候→初候の開始日へ移動することを確認する（DateTime）。
     */
    public function test_previousSeventyTwoKou_jikou_to_shokou_DateTime(): void
    {
        $dt = new DateTime('2025-02-09');
        $prev = (clone $dt)->previousSeventyTwoKou();

        $this->assertSame('2025-02-03', $prev->format('Y-m-d'));
        $this->assertSame(1, $this->invokeExecuteMethod($prev, 'getSeventyTwoKou', []));
    }
    /**
     * previousSeventyTwoKou() が初候→前節気の末候へ移動することを確認する（DateTime）。
     */
    public function test_previousSeventyTwoKou_shokou_to_prev_term_DateTime(): void
    {
        $dt = new DateTime('2025-02-04');
        $prev = (clone $dt)->previousSeventyTwoKou();

        $this->assertSame(72, $this->invokeExecuteMethod($prev, 'getSeventyTwoKou', []));
    }
    /**
     * previousSeventyTwoKou() が元のインスタンスを変更せず新インスタンスを返すことを確認する（DateTimeImmutable）。
     */
    public function test_previousSeventyTwoKou_immutable_preserves_original(): void
    {
        $dt = new DateTimeImmutable('2025-02-09');
        $prev = $dt->previousSeventyTwoKou();

        $this->assertNotSame($dt, $prev);
        $this->assertSame('2025-02-09', $dt->format('Y-m-d'), '元インスタンスは変更されない');
        $this->assertSame(1, $this->invokeExecuteMethod($prev, 'getSeventyTwoKou', []));
    }
    /**
     * previousSeventyTwoKou() が年末年始をまたいで前年の大寒末候へ移動することを確認する。
     */
    public function test_previousSeventyTwoKou_crosses_year_boundary(): void
    {
        $dt = new DateTimeImmutable('2026-02-04'); // 立春初候
        $prev = $dt->previousSeventyTwoKou();

        $this->assertSame(72, $this->invokeExecuteMethod($prev, 'getSeventyTwoKou', []));
    }
}
