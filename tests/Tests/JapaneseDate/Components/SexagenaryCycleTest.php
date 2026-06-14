<?php

/**
 * SexagenaryCycle コンポーネントの十二支・十干計算を検証するテスト。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\SexagenaryCycle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;

/**
 * SexagenaryCycle クラスのファクトリー・十二支・十干の計算と表示を検証する。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Components\SexagenaryCycle
 * @since       2026-05-29
 * @covers \JapaneseDate\Components\SexagenaryCycle
 * @covers \JapaneseDate\Components\SexagenaryCycle::factory
 * @covers \JapaneseDate\Components\SexagenaryCycle::getOrientalZodiacKey
 * @covers \JapaneseDate\Components\SexagenaryCycle::viewOrientalZodiac
 * @covers \JapaneseDate\Components\SexagenaryCycle::getHeavenlyStemKey
 * @covers \JapaneseDate\Components\SexagenaryCycle::viewHeavenlyStem
 */
class SexagenaryCycleTest extends TestCase
{
    // ==================== factory ====================
    /**
     * @return array[]
     */
    public static function orientalZodiacProvider(): array
    {
        return [
            // 検証出典: 1984年=甲子(子), 2019年=己亥(亥), 2023年=癸卯(卯), 2024年=甲辰(辰)
            '1984年(子)' => [1984, 1, '子'],
            '2019年(亥)' => [2019, 0, '亥'],
            '2020年(子)' => [2020, 1, '子'],
            '2021年(丑)' => [2021, 2, '丑'],
            '2022年(寅)' => [2022, 3, '寅'],
            '2023年(卯)' => [2023, 4, '卯'],
            '2024年(辰)' => [2024, 5, '辰'],
            '2025年(巳)' => [2025, 6, '巳'],
            '2026年(午)' => [2026, 7, '午'],
            '2027年(未)' => [2027, 8, '未'],
            '2028年(申)' => [2028, 9, '申'],
            '2029年(酉)' => [2029, 10, '酉'],
            '2030年(戌)' => [2030, 11, '戌'],
        ];
    }
    /**
     * @return array[]
     */
    public static function heavenlyStemProvider(): array
    {
        return [
            // 検証出典: 1984年=甲子(甲), 2023年=癸卯(癸), 2024年=甲辰(甲)
            '1984年(甲)' => [1984, 0, '甲'],
            '1985年(乙)' => [1985, 1, '乙'],
            '1986年(丙)' => [1986, 2, '丙'],
            '1987年(丁)' => [1987, 3, '丁'],
            '1988年(戊)' => [1988, 4, '戊'],
            '1989年(己)' => [1989, 5, '己'],
            '1990年(庚)' => [1990, 6, '庚'],
            '1991年(辛)' => [1991, 7, '辛'],
            '1992年(壬)' => [1992, 8, '壬'],
            '1993年(癸)' => [1993, 9, '癸'],
            '2023年(癸)' => [2023, 9, '癸'],
            '2024年(甲)' => [2024, 0, '甲'],
            '2025年(乙)' => [2025, 1, '乙'],
        ];
    }
    // ==================== getOrientalZodiacKey ====================
    /**
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory_returnsSameInstance(): void
    {
        $instance1 = SexagenaryCycle::factory();
        $instance2 = SexagenaryCycle::factory();
        $this->assertSame($instance1, $instance2, 'factory() はシングルトンを返す必要があります');
    }
    /**
     * @return void
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_factory_returnsSexagenaryCycleInstance(): void
    {
        $this->assertInstanceOf(SexagenaryCycle::class, SexagenaryCycle::factory());
    }
    // ==================== viewOrientalZodiac ====================
    /**
     * @noinspection PhpUnusedParameterInspection
     * @param int $year
     * @param int $expectedKey
     * @param string $expectedText
     * @return void
     * @dataProvider orientalZodiacProvider
     */
    public function test_getOrientalZodiacKey($year, $expectedKey, $expectedText): void
    {
        $cycle = new SexagenaryCycle();
        $this->assertSame($expectedKey, $cycle->getOrientalZodiacKey($year));
    }
    /**
     * @noinspection PhpUnusedParameterInspection
     * @param int $year
     * @param int $key
     * @param string $expectedText
     * @return void
     * @dataProvider orientalZodiacProvider
     */
    public function test_viewOrientalZodiac_validKey($year, $key, $expectedText): void
    {
        $cycle = new SexagenaryCycle();
        $this->assertSame($expectedText, $cycle->viewOrientalZodiac($key));
    }
    // ==================== getHeavenlyStemKey ====================
    /**
     * @return void
     */
    public function test_viewOrientalZodiac_invalidKey_returnsEmpty(): void
    {
        $cycle = new SexagenaryCycle();
        $this->assertSame('', $cycle->viewOrientalZodiac(99));
    }
    /**
     * @noinspection PhpUnusedParameterInspection
     * @param int $year
     * @param int $expectedKey
     * @param string $expectedText
     * @return void
     * @dataProvider heavenlyStemProvider
     */
    public function test_getHeavenlyStemKey($year, $expectedKey, $expectedText): void
    {
        $cycle = new SexagenaryCycle();
        $this->assertSame($expectedKey, $cycle->getHeavenlyStemKey($year));
    }
    // ==================== viewHeavenlyStem ====================
    /**
     * @noinspection PhpUnusedParameterInspection
     * @param int $year
     * @param int $key
     * @param string $expectedText
     * @return void
     * @dataProvider heavenlyStemProvider
     */
    public function test_viewHeavenlyStem_validKey($year, $key, $expectedText): void
    {
        $cycle = new SexagenaryCycle();
        $this->assertSame($expectedText, $cycle->viewHeavenlyStem($key));
    }
    /**
     * @return void
     */
    public function test_viewHeavenlyStem_invalidKey_returnsEmpty(): void
    {
        $cycle = new SexagenaryCycle();
        $this->assertSame('', $cycle->viewHeavenlyStem(99));
    }
}
