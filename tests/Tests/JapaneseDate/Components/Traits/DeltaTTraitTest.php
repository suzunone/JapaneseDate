<?php

namespace Tests\JapaneseDate\Components\Traits;

use JapaneseDate\Components\Traits\DeltaTTrait;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;


/**
 * DeltaTTrait のテスト。
 *
 * approximateDeltaTSeconds() が各時代区分の多項式分岐で正しい ΔT（秒）を返すことを確認する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests\Components\Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Release 1.0.0 から利用可能
 * @covers \JapaneseDate\Components\Traits\DeltaTTrait
 * @covers \JapaneseDate\Components\Traits\DeltaTTrait::deltaTPolynomialForDecimalYear
 * @covers \JapaneseDate\Components\Traits\DeltaTTrait::approximateDeltaTSeconds
 */
class DeltaTTraitTest extends TestCase
{
    use InvokeTrait;
    /**
     * 各時代区分の境界年における ΔT 期待値（秒）を返すデータプロバイダ。
     *
     * @return array<string, array{0: int, 1: int, 2: float}>
     */
    public static function dataProvider_approximateDeltaTSeconds(): array
    {
        return [
            '-600年1月（-500年より前の外挿分岐）' => [-600, 1, 18719.8347],
            '0年1月（-500-500 分岐）' => [0, 1, 10583.1773],
            '1000年1月（500-1600 分岐）' => [1000, 1, 1573.9683],
            '1600年1月（1600-1700 分岐）' => [1600, 1, 119.9591],
            '1700年1月（1700-1800 分岐）' => [1700, 1, 8.8367],
            '1800年1月（1800-1860 分岐）' => [1800, 1, 13.7062],
            '1860年1月（1860-1900 分岐）' => [1860, 1, 7.6435],
            '1900年1月（1900-1920 分岐）' => [1900, 1, -2.7278],
            '1920年1月（1920-1941 分岐）' => [1920, 1, 21.2351],
            '1941年1月（1941-1961 分岐）' => [1941, 1, 24.7973],
            '1961年1月（1961-1986 分岐）' => [1961, 1, 33.5948],
            '1986年1月（1986-2005 分岐）' => [1986, 1, 54.8963],
            '2000年1月（1986-2005 分岐）' => [2000, 1, 63.8738],
            '2005年1月（2005-2050 分岐）' => [2005, 1, 64.6863],
            '2025年6月（2005-2050 分岐）' => [2025, 6, 74.7443],
            '2050年1月（2050-2150 分岐）' => [2050, 1, 93.0848],
            '2150年1月（2150年以降分岐）' => [2150, 1, 328.5680],
        ];
    }
    /**
     * approximateDeltaTSeconds() が各時代区分の境界年で期待する ΔT 秒数を返すことを確認する。
     *
     * @param int $year
     * @param int $month
     * @param float $expected
     * @return void
     * @throws \ReflectionException
     * @dataProvider dataProvider_approximateDeltaTSeconds
     */
    public function test_approximateDeltaTSeconds(int $year, int $month, float $expected): void
    {
        $instance = new class () {
            use DeltaTTrait;
        };
        $result = $this->invokeExecuteMethod($instance, 'approximateDeltaTSeconds', [$year, $month]);
        $this->assertEqualsWithDelta($expected, $result, 0.001);
    }
}
