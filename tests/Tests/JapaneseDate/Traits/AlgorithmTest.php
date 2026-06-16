<?php

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\MeeusMoon;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Traits\Algorithm;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Algorithm Trait 経由で天文計算アルゴリズムを変更できることを検証する。
 */
#[CoversTrait(Algorithm::class)]
#[CoversMethod(Algorithm::class, 'useSolarAlgorithm')]
#[CoversMethod(Algorithm::class, 'solarAlgorithm')]
#[CoversMethod(Algorithm::class, 'useMoonAlgorithm')]
#[CoversMethod(Algorithm::class, 'moonAlgorithm')]
#[CoversMethod(Algorithm::class, 'useBoundarySolarAlgorithm')]
#[CoversMethod(Algorithm::class, 'boundarySolarAlgorithm')]
#[CoversMethod(Algorithm::class, 'useBoundaryMoonAlgorithm')]
#[CoversMethod(Algorithm::class, 'boundaryMoonAlgorithm')]
class AlgorithmTest extends TestCase
{
    use InvokeTrait;

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

    /**
     * MOON_ALGORITHM_MEEUS47 定数経由で meeus47 を選択できることを確認する。
     *
     * @param class-string $class
     * @throws \ReflectionException
     */
    #[DataProvider('dateTimeClassProvider')]
    public function test_useMoonAlgorithmAlias_meeus47(string $class): void
    {
        try {
            $class::useMoonAlgorithm($class::MOON_ALGORITHM_MEEUS47);
            $this->assertSame(Astronomy::MOON_MEEUS47, $class::moonAlgorithm());
            $impl = $this->invokeGetProperty(Astronomy::factory(), 'moonAlgorithmImpl');
            $this->assertInstanceOf(MeeusMoon::class, $impl);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }

    /**
     * MOON_ALGORITHM_MEEUS47_NO_C 定数経由で meeus47_no_c を選択できることを確認する。
     *
     * @param class-string $class
     * @throws \ReflectionException
     */
    #[DataProvider('dateTimeClassProvider')]
    public function test_useMoonAlgorithmAlias_meeus47_no_c(string $class): void
    {
        try {
            $class::useMoonAlgorithm($class::MOON_ALGORITHM_MEEUS47_NO_C);
            $this->assertSame(Astronomy::MOON_MEEUS47_NO_C, $class::moonAlgorithm());
            $impl = $this->invokeGetProperty(Astronomy::factory(), 'moonAlgorithmImpl');
            $this->assertInstanceOf(MeeusMoon::class, $impl);
        } finally {
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
            $this->invokeSetProperty(Astronomy::class, 'instances', []);
        }
    }

    /**
     * DateTime 系クラス経由で境界太陽アルゴリズムを変更できることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('dateTimeClassProvider')]
    public function test_useBoundarySolarAlgorithmAlias(string $class): void
    {
        try {
            $class::useBoundarySolarAlgorithm(Astronomy::SOLAR_LEGACY);

            $this->assertSame(Astronomy::SOLAR_LEGACY, $class::boundarySolarAlgorithm());
            $this->assertSame(Astronomy::SOLAR_LEGACY, Astronomy::boundarySolarAlgorithm());
        } finally {
            Astronomy::useBoundarySolarAlgorithm(Astronomy::SOLAR_VSOP87);
        }
    }

    /**
     * DateTime 系クラス経由で境界月アルゴリズムを変更できることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('dateTimeClassProvider')]
    public function test_useBoundaryMoonAlgorithmAlias(string $class): void
    {
        try {
            $class::useBoundaryMoonAlgorithm(Astronomy::MOON_LEGACY);

            $this->assertSame(Astronomy::MOON_LEGACY, $class::boundaryMoonAlgorithm());
            $this->assertSame(Astronomy::MOON_LEGACY, Astronomy::boundaryMoonAlgorithm());
        } finally {
            Astronomy::useBoundaryMoonAlgorithm(Astronomy::MOON_ELP2000);
        }
    }

    /**
     * DateTime / DateTimeImmutable に公開定数が正しく定義されていることを確認する。
     */
    public function test_publicConstantsAreExposed(): void
    {
        $this->assertSame('legacy', DateTime::SOLAR_ALGORITHM_LEGACY);
        $this->assertSame('legacy', DateTimeImmutable::SOLAR_ALGORITHM_LEGACY);
        $this->assertSame('vsop87', DateTime::SOLAR_ALGORITHM_VSOP87);
        $this->assertSame('vsop87', DateTimeImmutable::SOLAR_ALGORITHM_VSOP87);
        $this->assertSame('legacy', DateTime::MOON_ALGORITHM_LEGACY);
        $this->assertSame('legacy', DateTimeImmutable::MOON_ALGORITHM_LEGACY);
        $this->assertSame('elp2000', DateTime::MOON_ALGORITHM_ELP2000);
        $this->assertSame('elp2000', DateTimeImmutable::MOON_ALGORITHM_ELP2000);
        $this->assertSame('meeus47', DateTime::MOON_ALGORITHM_MEEUS47);
        $this->assertSame('meeus47', DateTimeImmutable::MOON_ALGORITHM_MEEUS47);
        $this->assertSame('meeus47_no_c', DateTime::MOON_ALGORITHM_MEEUS47_NO_C);
        $this->assertSame('meeus47_no_c', DateTimeImmutable::MOON_ALGORITHM_MEEUS47_NO_C);
    }
}
