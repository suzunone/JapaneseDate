<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Traits\MoonAgeConvergenceTrait;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * 月齢収束ステップが呼び出し側の継続判定へ返す値を検証する。
 */
#[CoversTrait(MoonAgeConvergenceTrait::class)]
#[CoversMethod(MoonAgeConvergenceTrait::class, 'applyConvergenceStep')]
class MoonAgeConvergenceTraitTest extends TestCase
{
    use InvokeTrait;

    private const SYNODIC_MONTH = 29.530589;

    /**
     * @return array<string, array{0: float}>
     */
    public static function negativeCorrectionProvider(): array
    {
        return [
            'minus half day' => [-0.5],
            'minus two days' => [-2.0],
        ];
    }

    /**
     * 負の補正量でも、修正後の while 式（abs の位置変更）が継続条件を満たすことを確認する。
     *
     * @param float $correctionDays 時刻補正量（日）
     * @return void
     * @throws \ReflectionException
     */
    #[DataProvider('negativeCorrectionProvider')]
    public function test_negativeCorrectionContinuesIteration(float $correctionDays): void
    {
        [, , $deltaT1, $deltaT2] = $this->applyStepForCorrection($correctionDays);
        $whileExpression = abs($deltaT1 + $deltaT2);

        $this->assertGreaterThan(
            Astronomy::DAYS_PER_SEC,
            $whileExpression,
            '負側補正でも while 式が継続条件（> DAYS_PER_SEC）を満たすことを確認する'
        );
    }

    /**
     * @return array<string, array{0: float}>
     */
    public static function positiveCorrectionProvider(): array
    {
        return [
            'plus half day' => [0.5],
            'plus two days' => [2.0],
        ];
    }

    /**
     * 正の補正量では、修正後の while 式が反復継続条件を満たすことを確認する。
     *
     * @param float $correctionDays 時刻補正量（日）
     * @return void
     * @throws \ReflectionException
     */
    #[DataProvider('positiveCorrectionProvider')]
    public function test_positiveCorrectionContinuesIteration(float $correctionDays): void
    {
        [, , $deltaT1, $deltaT2] = $this->applyStepForCorrection($correctionDays);
        $whileExpression = abs($deltaT1 + $deltaT2);

        $this->assertGreaterThan(
            Astronomy::DAYS_PER_SEC,
            $whileExpression,
            '正側補正で while 式が継続条件（> DAYS_PER_SEC）を満たすことを確認する'
        );
    }

    /**
     * 指定した日数の補正量になる黄経差で収束ステップを実行する。
     *
     * @param float $correctionDays 時刻補正量（日）
     * @return array{0: float, 1: float, 2: float, 3: float, 4: bool}
     * @throws \ReflectionException
     */
    private function applyStepForCorrection(float $correctionDays): array
    {
        $instance = new class () {
            use MoonAgeConvergenceTrait;
        };
        $deltaRm = $correctionDays * 360.0 / self::SYNODIC_MONTH;

        return $this->invokeExecuteMethod(
            $instance,
            'applyConvergenceStep',
            [$deltaRm, self::SYNODIC_MONTH, 2451550.0, 0.5, 2451550.5, 1]
        );
    }
}
