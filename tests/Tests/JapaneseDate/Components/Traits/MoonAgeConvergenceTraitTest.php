<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Components\Traits;

use JapaneseDate\Components\Traits\MoonAgeConvergenceTrait;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 *
 */

/**
 *
 */
#[CoversTrait(MoonAgeConvergenceTrait::class)]
#[CoversMethod(MoonAgeConvergenceTrait::class, 'applyConvergenceStep')]
class MoonAgeConvergenceTraitTest extends TestCase
{
    use InvokeTrait;

    private const SYNODIC_MONTH = 29.530589;

    /**
     * @return object
     */
    private function makeInstance(): object
    {
        return new class () {
            use MoonAgeConvergenceTrait;
        };
    }

    /**
     * 標準ケース: tm2 が 0 以上の場合、減算のみで補正が完了する。
     *
     * delta_rm = 1.0 → delta_t2_raw ≈ 0.082 → delta_t1 = 0, delta_t2 ≈ 0.082
     * tm2 = 0.5 → 0.5 - 0.082 ≈ 0.418 (0 以上) → 繰り上げなし
     */
    public function test_applyConvergenceStep_tm2_positive(): void
    {
        $instance = $this->makeInstance();

        [$tm1, $tm2, $delta_t1, $delta_t2, $shouldBreak] = $this->invokeExecuteMethod(
            $instance,
            'applyConvergenceStep',
            [
                1.0,           // delta_rm（小さい値: 補正後の tm2 が 0 以上になる）
                self::SYNODIC_MONTH,
                2451550.0,     // tm1
                0.5,           // tm2
                2451550.0,     // julian_date_0
                1,             // counter
            ]
        );

        $deltaT2Raw = self::SYNODIC_MONTH / 360.0;
        $expectedDeltaT1 = floor($deltaT2Raw);
        $expectedDeltaT2 = $deltaT2Raw - $expectedDeltaT1;

        $this->assertEqualsWithDelta(2451550.0 - $expectedDeltaT1, $tm1, 1e-10);
        $this->assertEqualsWithDelta(0.5 - $expectedDeltaT2, $tm2, 1e-10);
        $this->assertGreaterThanOrEqual(0.0, $tm2);
        $this->assertSame($expectedDeltaT1, $delta_t1);
        $this->assertEqualsWithDelta($expectedDeltaT2, $delta_t2, 1e-10);
        $this->assertFalse($shouldBreak);
    }

    /**
     * tm2 < 0 になる場合、tm2++ / tm1-- で繰り上げ補正される。
     */
    public function test_applyConvergenceStep_tm2_negative_triggers_carry(): void
    {
        $instance = $this->makeInstance();

        // delta_rm を大きくして delta_t2（小数部）が tm2 を超えるようにする
        // delta_rm = 180 → delta_t2_raw = 180 * 29.530589 / 360 ≈ 14.765
        // floor(14.765) = 14, 小数部 = 0.765
        // tm2 = 0.3 → 0.3 - 0.765 = -0.465 < 0 → 繰り上げ
        [$tm1, $tm2, $delta_t1, $delta_t2, $shouldBreak] = $this->invokeExecuteMethod(
            $instance,
            'applyConvergenceStep',
            [
                180.0,         // delta_rm
                self::SYNODIC_MONTH,
                2451550.0,     // tm1
                0.3,           // tm2（小さい値: 補正後に負になる）
                2451550.0,     // julian_date_0
                1,             // counter
            ]
        );

        $deltaT2Raw = 180.0 * self::SYNODIC_MONTH / 360.0;
        $expectedDeltaT1 = floor($deltaT2Raw);
        $expectedDeltaT2 = $deltaT2Raw - $expectedDeltaT1;

        $this->assertEqualsWithDelta(2451550.0 - $expectedDeltaT1 - 1.0, $tm1, 1e-10);
        $this->assertEqualsWithDelta(1.3 - $expectedDeltaT2, $tm2, 1e-10);
        $this->assertGreaterThanOrEqual(0.0, $tm2);
        $this->assertSame($expectedDeltaT1, $delta_t1);
        $this->assertEqualsWithDelta($expectedDeltaT2, $delta_t2, 1e-10);
        $this->assertFalse($shouldBreak);
    }
}
