<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\Cache;
use JapaneseDate\Components\SolarTerm;
use JapaneseDate\Components\Traits\GetSolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Exceptions\Exception;
use JapaneseDate\Exceptions\SolarTermException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\Components\Traits\SolarTermDataProviderTrait;

/**
 * @covers \JapaneseDate\Components\SolarTerm
 * @covers \JapaneseDate\Components\Traits\GetSolarTerm
 * @covers \JapaneseDate\Components\SolarTerm::__construct
 * @covers \JapaneseDate\Components\SolarTerm::getSolarTerm
 * @covers \JapaneseDate\Components\Traits\GetSolarTerm::getSolarTerms
 * @covers \JapaneseDate\Components\SolarTerm::syunbun
 * @covers \JapaneseDate\Components\SolarTerm::seimei
 * @covers \JapaneseDate\Components\SolarTerm::kokuu
 * @covers \JapaneseDate\Components\SolarTerm::rikka
 * @covers \JapaneseDate\Components\SolarTerm::syouman
 * @covers \JapaneseDate\Components\SolarTerm::bousyu
 * @covers \JapaneseDate\Components\SolarTerm::geshi
 * @covers \JapaneseDate\Components\SolarTerm::syousyo
 * @covers \JapaneseDate\Components\SolarTerm::taisyo
 * @covers \JapaneseDate\Components\SolarTerm::rissyuu
 * @covers \JapaneseDate\Components\SolarTerm::syosyo
 * @covers \JapaneseDate\Components\SolarTerm::hakuro
 * @covers \JapaneseDate\Components\SolarTerm::syuubun
 * @covers \JapaneseDate\Components\SolarTerm::kanro
 * @covers \JapaneseDate\Components\SolarTerm::soukou
 * @covers \JapaneseDate\Components\SolarTerm::rittou
 * @covers \JapaneseDate\Components\SolarTerm::syousetsu
 * @covers \JapaneseDate\Components\SolarTerm::taisetsu
 * @covers \JapaneseDate\Components\SolarTerm::touji
 * @covers \JapaneseDate\Components\SolarTerm::syoukan
 * @covers \JapaneseDate\Components\SolarTerm::daikan
 * @covers \JapaneseDate\Components\SolarTerm::rissyun
 * @covers \JapaneseDate\Components\SolarTerm::usui
 * @covers \JapaneseDate\Components\SolarTerm::keichitsu
 * @covers \JapaneseDate\Components\SolarTerm::findSolarTerm
 * @covers \JapaneseDate\Components\SolarTerm::dayBoundaryHour
 * @covers \JapaneseDate\Components\SolarTerm::longitudeSunAt
 */
class SolarTermTest extends TestCase
{
    use SolarTermDataProviderTrait;
    /**
     * SolarTerm のメソッド名と二十四節気コードの対応表。
     */
    private const SOLAR_TERM_METHODS = [
        'syunbun' => DateTime::SOLAR_TERM_SYUNBUN,
        'seimei' => DateTime::SOLAR_TERM_SEIMEI,
        'kokuu' => DateTime::SOLAR_TERM_KOKUU,
        'rikka' => DateTime::SOLAR_TERM_RIKKA,
        'syouman' => DateTime::SOLAR_TERM_SYOUMAN,
        'bousyu' => DateTime::SOLAR_TERM_BOUSYU,
        'geshi' => DateTime::SOLAR_TERM_GESHI,
        'syousyo' => DateTime::SOLAR_TERM_SYOUSYO,
        'taisyo' => DateTime::SOLAR_TERM_TAISYO,
        'rissyuu' => DateTime::SOLAR_TERM_RISSYUU,
        'syosyo' => DateTime::SOLAR_TERM_SYOSYO,
        'hakuro' => DateTime::SOLAR_TERM_HAKURO,
        'syuubun' => DateTime::SOLAR_TERM_SYUUBUN,
        'kanro' => DateTime::SOLAR_TERM_KANRO,
        'soukou' => DateTime::SOLAR_TERM_SOUKOU,
        'rittou' => DateTime::SOLAR_TERM_RITTOU,
        'syousetsu' => DateTime::SOLAR_TERM_SYOUSETSU,
        'taisetsu' => DateTime::SOLAR_TERM_TAISETSU,
        'touji' => DateTime::SOLAR_TERM_TOUJI,
        'syoukan' => DateTime::SOLAR_TERM_SYOUKAN,
        'daikan' => DateTime::SOLAR_TERM_DAIKAN,
        'rissyun' => DateTime::SOLAR_TERM_RISSYUN,
        'usui' => DateTime::SOLAR_TERM_USUI,
        'keichitsu' => DateTime::SOLAR_TERM_KEICHITSU,
    ];
    /**
     * 年ごとの二十四節気一覧を検証するため、暦要項のデータを年単位にまとめる。
     */
    public static function naoRekiYokoYearDataProvider(): array
    {
        $years = [];

        foreach (self::naoRekiYokoSolarTermDataProvider() as [$year, $solarTerm, $month, $day]) {
            $years[$year][$solarTerm] = [$month, $day];
        }

        $cases = [];

        foreach ($years as $year => $expected) {
            ksort($expected);
            $cases[$year] = [(int) $year, $expected];
        }

        return $cases;
    }
    /**
     * 国立天文台暦要項の「二十四節気および雑節」で確認した日付を返す。
     */
    public static function naoRekiYokoSolarTermDataProvider(): array
    {
        return array_merge(
            self::getSolarTermDataProvider(),
            self::solarTermsForYear(2020, [
                DateTime::SOLAR_TERM_SYOUKAN => [1, 6],
                DateTime::SOLAR_TERM_DAIKAN => [1, 20],
                DateTime::SOLAR_TERM_RISSYUN => [2, 4],
                DateTime::SOLAR_TERM_USUI => [2, 19],
                DateTime::SOLAR_TERM_KEICHITSU => [3, 5],
                DateTime::SOLAR_TERM_SYUNBUN => [3, 20],
                DateTime::SOLAR_TERM_SEIMEI => [4, 4],
                DateTime::SOLAR_TERM_KOKUU => [4, 19],
                DateTime::SOLAR_TERM_RIKKA => [5, 5],
                DateTime::SOLAR_TERM_SYOUMAN => [5, 20],
                DateTime::SOLAR_TERM_BOUSYU => [6, 5],
                DateTime::SOLAR_TERM_GESHI => [6, 21],
                DateTime::SOLAR_TERM_SYOUSYO => [7, 7],
                DateTime::SOLAR_TERM_TAISYO => [7, 22],
                DateTime::SOLAR_TERM_RISSYUU => [8, 7],
                DateTime::SOLAR_TERM_SYOSYO => [8, 23],
                DateTime::SOLAR_TERM_HAKURO => [9, 7],
                DateTime::SOLAR_TERM_SYUUBUN => [9, 22],
                DateTime::SOLAR_TERM_KANRO => [10, 8],
                DateTime::SOLAR_TERM_SOUKOU => [10, 23],
                DateTime::SOLAR_TERM_RITTOU => [11, 7],
                DateTime::SOLAR_TERM_SYOUSETSU => [11, 22],
                DateTime::SOLAR_TERM_TAISETSU => [12, 7],
                DateTime::SOLAR_TERM_TOUJI => [12, 21],
            ]),
            self::solarTermsForYear(2024, [
                DateTime::SOLAR_TERM_SYOUKAN => [1, 6],
                DateTime::SOLAR_TERM_DAIKAN => [1, 20],
                DateTime::SOLAR_TERM_RISSYUN => [2, 4],
                DateTime::SOLAR_TERM_USUI => [2, 19],
                DateTime::SOLAR_TERM_KEICHITSU => [3, 5],
                DateTime::SOLAR_TERM_SYUNBUN => [3, 20],
                DateTime::SOLAR_TERM_SEIMEI => [4, 4],
                DateTime::SOLAR_TERM_KOKUU => [4, 19],
                DateTime::SOLAR_TERM_RIKKA => [5, 5],
                DateTime::SOLAR_TERM_SYOUMAN => [5, 20],
                DateTime::SOLAR_TERM_BOUSYU => [6, 5],
                DateTime::SOLAR_TERM_GESHI => [6, 21],
                DateTime::SOLAR_TERM_SYOUSYO => [7, 6],
                DateTime::SOLAR_TERM_TAISYO => [7, 22],
                DateTime::SOLAR_TERM_RISSYUU => [8, 7],
                DateTime::SOLAR_TERM_SYOSYO => [8, 22],
                DateTime::SOLAR_TERM_HAKURO => [9, 7],
                DateTime::SOLAR_TERM_SYUUBUN => [9, 22],
                DateTime::SOLAR_TERM_KANRO => [10, 8],
                DateTime::SOLAR_TERM_SOUKOU => [10, 23],
                DateTime::SOLAR_TERM_RITTOU => [11, 7],
                DateTime::SOLAR_TERM_SYOUSETSU => [11, 22],
                DateTime::SOLAR_TERM_TAISETSU => [12, 7],
                DateTime::SOLAR_TERM_TOUJI => [12, 21],
            ]),
            self::solarTermsForYear(2026, [
                DateTime::SOLAR_TERM_SYOUKAN => [1, 5],
                DateTime::SOLAR_TERM_DAIKAN => [1, 20],
                DateTime::SOLAR_TERM_RISSYUN => [2, 4],
                DateTime::SOLAR_TERM_USUI => [2, 19],
                DateTime::SOLAR_TERM_KEICHITSU => [3, 5],
                DateTime::SOLAR_TERM_SYUNBUN => [3, 20],
                DateTime::SOLAR_TERM_SEIMEI => [4, 5],
                DateTime::SOLAR_TERM_KOKUU => [4, 20],
                DateTime::SOLAR_TERM_RIKKA => [5, 5],
                DateTime::SOLAR_TERM_SYOUMAN => [5, 21],
                DateTime::SOLAR_TERM_BOUSYU => [6, 6],
                DateTime::SOLAR_TERM_GESHI => [6, 21],
                DateTime::SOLAR_TERM_SYOUSYO => [7, 7],
                DateTime::SOLAR_TERM_TAISYO => [7, 23],
                DateTime::SOLAR_TERM_RISSYUU => [8, 7],
                DateTime::SOLAR_TERM_SYOSYO => [8, 23],
                DateTime::SOLAR_TERM_HAKURO => [9, 7],
                DateTime::SOLAR_TERM_SYUUBUN => [9, 23],
                DateTime::SOLAR_TERM_KANRO => [10, 8],
                DateTime::SOLAR_TERM_SOUKOU => [10, 23],
                DateTime::SOLAR_TERM_RITTOU => [11, 7],
                DateTime::SOLAR_TERM_SYOUSETSU => [11, 22],
                DateTime::SOLAR_TERM_TAISETSU => [12, 7],
                DateTime::SOLAR_TERM_TOUJI => [12, 22],
            ]),
        );
    }
    /**
     * 指定年の二十四節気データをデータプロバイダ用のケース配列に変換する。
     */
    private static function solarTermsForYear(int $year, array $solarTerms): array
    {
        $cases = [];

        foreach ($solarTerms as $solarTerm => [$month, $day]) {
            $cases[$year . ' ' . $solarTerm] = [$year, $solarTerm, $month, $day];
        }

        return $cases;
    }
    /**
     * 各二十四節気メソッドを暦要項の期待値で検証するためのケースを返す。
     */
    public static function solarTermMethodDataProvider(): array
    {
        $methods = array_flip(self::SOLAR_TERM_METHODS);
        $cases = [];

        foreach (self::getSolarTermDataProvider() as $label => [$year, $solarTerm, $month, $day]) {
            $cases[$label] = [$methods[$solarTerm], $year, $solarTerm, $month, $day];
        }

        return $cases;
    }
    /**
     * 二十四節気コードから取得した日付が暦要項の期待値と一致することを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @dataProvider naoRekiYokoSolarTermDataProvider
     */
    public function test_getSolarTermMatchesNaoRekiYoko(int $year, int $solarTerm, int $month, int $day): void
    {
        $solarTermDate = (new SolarTerm())->getSolarTerm($year, $solarTerm);
        self::assertSolarTermDate($year, $solarTerm, $month, $day, $solarTermDate);
    }
    /**
     * SolarTermDate の各プロパティが期待値と一致することを確認する。
     */
    private static function assertSolarTermDate(
        int $year,
        int $solarTerm,
        int $month,
        int $day,
        SolarTermDate $solarTermDate
    ): void {
        self::assertSame($year, $solarTermDate->year);
        self::assertSame($solarTerm, $solarTermDate->solar_term);
        self::assertSame($month, $solarTermDate->month);
        self::assertSame($day, $solarTermDate->day);
    }
    /**
     * 各二十四節気メソッドが暦要項の期待値と一致することを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @dataProvider solarTermMethodDataProvider
     */
    public function test_eachSolarTermMethodMatchesNaoRekiYoko2000(string $method, int $year, int $solarTerm, int $month, int $day): void
    {
        $solarTermDate = (new SolarTerm())->{$method}($year);
        self::assertSolarTermDate($year, $solarTerm, $month, $day, $solarTermDate);
    }
    /**
     * 年単位で取得した二十四節気一覧が暦要項の期待値と一致することを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @dataProvider naoRekiYokoYearDataProvider
     */
    public function test_getSolarTermsMatchesNaoRekiYoko(int $year, array $expected): void
    {
        $solarTerms = (new SolarTerm())->getSolarTerms($year);
        $this->assertSame(array_keys($expected), array_keys($solarTerms));
        foreach ($expected as $solarTerm => [$month, $day]) {
            self::assertSolarTermDate($year, $solarTerm, $month, $day, $solarTerms[$solarTerm]);
        }
    }
    /**
     * findSolarTerm() が二十四節気を検出し、旧来範囲では6時境界を使うことを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTermReturnsSolarTermAndUsesLegacyBoundary(): void
    {
        $prevAlgorithm = Astronomy::solarAlgorithm();
        Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);

        try {
            $astronomy = new class () extends Astronomy {

                /** @var int[] */
                public array $hours = [];

                private int $calls = 0;

                public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
                {
                    $this->hours[] = (int) $hour;

                    return $this->calls++ === 0 ? 0.0 : 15.0;
                }
            };

            $solarTerm = (new SolarTerm($astronomy))->findSolarTerm(2000, 3, 20);

            $this->assertSame(DateTime::SOLAR_TERM_SEIMEI, $solarTerm);
            $this->assertSame([6, 6], $astronomy->hours);
        } finally {
            Astronomy::useSolarAlgorithm($prevAlgorithm);
        }
    }
    /**
     * 太陽黄経の範囲が変化しない場合、二十四節気を検出しないことを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTermReturnsFalseWhenLongitudeRangeDoesNotChange(): void
    {
        $astronomy = new class () extends Astronomy {
            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
            {
                return 10.0;
            }
        };

        $this->assertFalse((new SolarTerm($astronomy))->findSolarTerm(2000, 3, 21));
    }
    /**
     * 次の太陽黄経が二十四節気表の範囲外になる場合、検出しないことを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTermReturnsFalseWhenNextLongitudeIsOutsideSolarTermTable(): void
    {
        $astronomy = new class () extends Astronomy {
            private int $calls = 0;

            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
            {
                return $this->calls++ === 0 ? 350.0 : 360.0;
            }
        };

        $this->assertFalse((new SolarTerm($astronomy))->findSolarTerm(2000, 3, 21));
    }
    /**
     * 旧来範囲外では0時境界を使って二十四節気を検出することを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function test_findSolarTermUsesMidnightBoundaryOutsideLegacyTableRange(): void
    {
        $astronomy = new class () extends Astronomy {
            /** @var int[] */
            public array $hours = [];

            private int $calls = 0;

            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
            {
                $this->hours[] = (int) $hour;

                return $this->calls++ === 0 ? 0.0 : 15.0;
            }
        };

        $solarTerm = (new SolarTerm($astronomy))->findSolarTerm(1599, 3, 20);

        $this->assertSame(DateTime::SOLAR_TERM_SEIMEI, $solarTerm);
        $this->assertSame([0, 0], $astronomy->hours);
    }
    public function test_findSolarTermUsesMidnightBoundaryForVsop87(): void
    {
        $astronomy = new class () extends Astronomy {
            /** @var int[] */
            public array $hours = [];

            private int $calls = 0;

            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
            {
                $this->hours[] = (int) $hour;

                return $this->calls++ === 0 ? 0.0 : 15.0;
            }
        };

        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            $solarTerm = (new SolarTerm($astronomy))->findSolarTerm(2000, 3, 20);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }

        $this->assertSame(DateTime::SOLAR_TERM_SEIMEI, $solarTerm);
        $this->assertSame([0, 0], $astronomy->hours);
    }
    public function test_vsop87SolarTermsMatchNaoRekiYokoData(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            foreach (self::naoRekiYokoYearDataProvider() as [$year, $expected]) {
                if (!in_array($year, [2020, 2024, 2026], true)) {
                    continue;
                }

                $actual = [];
                foreach ((new SolarTerm())->getSolarTerms($year) as $solarTerm => $date) {
                    $actual[$solarTerm] = [$date->month, $date->day];
                }

                $this->assertSame($expected, $actual, (string) $year);
            }
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    /**
     * 天文計算で該当日が見つからない場合に例外が発生することを確認する。
     */
    public function test_getSolarTermThrowsWhenAstronomicalCalculationFindsNoMatchingDay(): void
    {
        $astronomy = new class () extends Astronomy {
            public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
            {
                return 10.0;
            }
        };

        $this->expectException(SolarTermException::class);

        (new SolarTerm($astronomy))->getSolarTerm(2000, DateTime::SOLAR_TERM_SYUNBUN);
    }
    /**
     * 未定義の二十四節気コードを指定した場合に例外が発生することを確認する。
     */
    public function test_getSolarTermRejectsUndefinedSolarTerm(): void
    {
        $this->expectException(Exception::class);

        (new SolarTerm())->getSolarTerm(2000, 999);
    }
}
