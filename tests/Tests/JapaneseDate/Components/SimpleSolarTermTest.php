<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Exceptions\Exception;
use JapaneseDate\Exceptions\SolarTermException;
use LogicException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\Components\Traits\SolarTermDataProviderTrait;

/**
 * @covers \JapaneseDate\Components\SimpleSolarTerm
 */
class SimpleSolarTermTest extends TestCase
{
    use SolarTermDataProviderTrait;
    /**
     * SimpleSolarTerm のメソッド名と二十四節気コードの対応表。
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
            ])
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
     * 生成済みテーブルの各期間の開始年を境界値として検証するデータを返す。
     */
    public static function simpleSolarTermTableBoundaryDataProvider(): array
    {
        // SimpleSolarTerm は生成済みの参照テーブルなので、実測日付の正確性は上のテストで検証する。
        $source = file_get_contents(__DIR__ . '/../../../../src/Components/SimpleSolarTerm.php');
        if ($source === false) {
            throw new LogicException('SimpleSolarTerm.php could not be read.');
        }

        $cases = [];
        preg_match_all(
            '/public function ([a-z]+)\(\$year\): SolarTermDate\s*\{/m',
            $source,
            $methodMatches,
            PREG_OFFSET_CAPTURE
        );

        foreach ($methodMatches[1] as $index => [$method, $methodOffset]) {
            if (!isset(self::SOLAR_TERM_METHODS[$method])) {
                continue;
            }

            $nextMethod = $methodMatches[0][$index + 1][1] ?? strlen($source);
            $methodBody = (string) substr($source, $methodOffset, $nextMethod - $methodOffset);
            preg_match_all(
                '/\$year >= (\d+) && \$year <= (\d+)\) \{\R\s+\$days = \[([^\]]+)\]/',
                $methodBody,
                $rangeMatches,
                PREG_SET_ORDER
            );

            if ($rangeMatches === []) {
                throw new LogicException($method . ' table ranges were not found.');
            }

            foreach ($rangeMatches as $rangeMatch) {
                $year = (int) $rangeMatch[1];
                $days = array_map(
                    'intval',
                    preg_split('/\D+/', trim($rangeMatch[3], " \t\n\r\0\x0B,"))
                );

                $cases[$method . ' ' . $rangeMatch[1] . '-' . $rangeMatch[2]] = [
                    $method,
                    $year,
                    self::SOLAR_TERM_METHODS[$method],
                    $days[$year % 4],
                ];
            }
        }

        return $cases;
    }
    /**
     * サポート範囲外の年を検証するため、各二十四節気メソッドのケースを返す。
     */
    public static function unsupportedYearDataProvider(): array
    {
        $cases = [];

        foreach (array_keys(self::SOLAR_TERM_METHODS) as $method) {
            $cases[$method . ' before supported range'] = [$method, 1599];
        }

        return $cases;
    }
    /**
     * 二十四節気コードから該当年の日付を取得できることを確認する。
     *
     * @param $year
     * @param $solar_term_code
     * @param $month
     * @param $day
     * @return void
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @dataProvider naoRekiYokoSolarTermDataProvider
     */
    public function test_getSolarTerm($year, $solar_term_code, $month, $day): void
    {
        $SolarTerm = new SimpleSolarTerm();
        $SolarTermData = $SolarTerm->getSolarTerm($year, $solar_term_code);
        $this->assertInstanceOf(SolarTermDate::class, $SolarTermData);
        $this->assertSame($year, $SolarTermData->year);
        $this->assertSame($solar_term_code, $SolarTermData->solar_term);
        $this->assertSame($month, $SolarTermData->month);
        $this->assertSame($day, $SolarTermData->day);
    }
    /**
     * 年単位で取得した二十四節気一覧が暦要項の期待値と一致することを確認する。
     * @dataProvider naoRekiYokoYearDataProvider
     * @param mixed[] $expected
     */
    public function test_getSolarTermsMatchesNaoRekiYoko($year, $expected): void
    {
        $solarTerms = (new SimpleSolarTerm())->getSolarTerms($year);
        $this->assertSame(array_keys($expected), array_keys($solarTerms));
        foreach ($expected as $solarTerm => [$month, $day]) {
            $this->assertInstanceOf(SolarTermDate::class, $solarTerms[$solarTerm]);
            $this->assertSame($year, $solarTerms[$solarTerm]->year);
            $this->assertSame($solarTerm, $solarTerms[$solarTerm]->solar_term);
            $this->assertSame($month, $solarTerms[$solarTerm]->month);
            $this->assertSame($day, $solarTerms[$solarTerm]->day);
        }
    }
    /**
     * 生成済みテーブルの期間境界で、各メソッドが期待する日付を返すことを確認する。
     * @dataProvider simpleSolarTermTableBoundaryDataProvider
     */
    public function test_simpleSolarTermTableBoundaries($method, $year, $solarTerm, $day): void
    {
        $solarTermDate = (new SimpleSolarTerm())->{$method}($year);
        $this->assertInstanceOf(SolarTermDate::class, $solarTermDate);
        $this->assertSame($year, $solarTermDate->year);
        $this->assertSame($solarTerm, $solarTermDate->solar_term);
        $this->assertSame($day, $solarTermDate->day);
    }
    /**
     * サポート範囲外の年を指定した場合に例外が発生することを確認する。
     * @dataProvider unsupportedYearDataProvider
     */
    public function test_simpleSolarTermMethodsRejectUnsupportedYear($method, $year): void
    {
        $this->expectException(SolarTermException::class);
        (new SimpleSolarTerm())->{$method}($year);
    }
    /**
     * 未定義の二十四節気コードを指定した場合に例外が発生することを確認する。
     */
    public function test_getSolarTermRejectsUndefinedSolarTerm(): void
    {
        $this->expectException(Exception::class);

        (new SimpleSolarTerm())->getSolarTerm(2000, 999);
    }
}
