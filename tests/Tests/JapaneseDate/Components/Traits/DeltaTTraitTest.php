<?php

namespace Tests\JapaneseDate\Components\Traits;

use JapaneseDate\Components\Traits\DeltaTTrait;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 *
 */
/**
 *
 * @covers \JapaneseDate\Components\Traits\DeltaTTrait
 * @covers \JapaneseDate\Components\Traits\DeltaTTrait::approximateDeltaTSeconds
 */
class DeltaTTraitTest extends TestCase
{
    use InvokeTrait;
    /**
     * @return array<string, array{0: int, 1: int, 2: float}>
     */
    public static function dataProvider_approximateDeltaTSeconds(): array
    {
        // 期待値は式から導出:
        // $y < 2050: 62.92 + 0.32217 * ($y - 2000) + 0.005589 * ($y - 2000)^2
        // $y >= 2050: -20 + 32 * (($y - 1820) / 100)^2 - 0.5628 * (2150 - $y)
        return [
            '2000年1月（$y < 2050 分岐）' => [2000, 1, 62.9334],
            '2025年6月（$y < 2050 分岐）' => [2025, 6, 74.7443],
            '2050年1月（$y >= 2050 分岐）' => [2050, 1, 93.0848],
            '2100年6月（$y >= 2050 分岐）' => [2100, 6, 203.820],
        ];
    }
    /**
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
