<?php

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Traits\Algorithm;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Algorithm Trait 経由で天文計算アルゴリズムを変更できることを検証する。
 */
#[CoversTrait(Algorithm::class)]
#[CoversMethod(Algorithm::class, 'useSolarAlgorithm')]
#[CoversMethod(Algorithm::class, 'solarAlgorithm')]
#[CoversMethod(Algorithm::class, 'useMoonAlgorithm')]
#[CoversMethod(Algorithm::class, 'moonAlgorithm')]
class AlgorithmTest extends TestCase
{
    /**
     * DateTime 系クラスの一覧を返す。
     *
     * @return array<string, array{class-string}>
     */
    public static function dateTimeClassProvider(): array
    {
        return [
            'DateTime' => [DateTime::class],
            'DateTimeImmutable' => [DateTimeImmutable::class],
        ];
    }

    /**
     * DateTime 系クラス経由で太陽アルゴリズムを変更できることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('dateTimeClassProvider')]
    public function test_useSolarAlgorithmAlias(string $class): void
    {
        try {
            $class::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            $this->assertSame(Astronomy::SOLAR_VSOP87, $class::solarAlgorithm());
            $this->assertSame(Astronomy::SOLAR_VSOP87, Astronomy::solarAlgorithm());
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }

    /**
     * DateTime 系クラス経由で月アルゴリズムを変更できることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('dateTimeClassProvider')]
    public function test_useMoonAlgorithmAlias(string $class): void
    {
        try {
            $class::useMoonAlgorithm(Astronomy::MOON_ELP2000);

            $this->assertSame(Astronomy::MOON_ELP2000, $class::moonAlgorithm());
            $this->assertSame(Astronomy::MOON_ELP2000, Astronomy::moonAlgorithm());
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
}
