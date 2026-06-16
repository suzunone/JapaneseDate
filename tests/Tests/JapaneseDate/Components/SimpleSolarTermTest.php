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
 * SimpleSolarTerm クラスのテスト。
 *
 * 生成済み参照テーブルによる二十四節気日付取得が国立天文台暦要項の期待値と一致すること、
 * 期間境界・年単位オーバーライド・サポート範囲外年の例外処理を確認する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests\Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Release 1.0.0 から利用可能
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
     * 生成済みテーブルの各期間を検証するデータを返す。
     */
    public static function simpleSolarTermTableRangeDataProvider(): array
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
                $year = intdiv((int) $rangeMatch[1] + (int) $rangeMatch[2], 2);
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
     * 生成済みテーブルに定義された年単位の例外オーバーライドを返す。
     */
    public static function simpleSolarTermYearOverrideDataProvider(): array
    {
        $cases = [];
        $overrides = [
            'syunbun' => [DateTime::SOLAR_TERM_SYUNBUN, [2352 => 21, 2385 => 21]],
            'seimei' => [DateTime::SOLAR_TERM_SEIMEI, [2302 => 6, 2335 => 6, 2368 => 5, 1724 => 4, 2141 => 5]],
            'kokuu' => [DateTime::SOLAR_TERM_KOKUU, [2334 => 21, 2367 => 21, 1735 => 20, 2082 => 20, 2272 => 20]],
            'rikka' => [DateTime::SOLAR_TERM_RIKKA, [2320 => 6, 2382 => 6, 1762 => 5, 2163 => 6]],
            'syouman' => [DateTime::SOLAR_TERM_SYOUMAN, [2318 => 22, 2351 => 22, 2380 => 21, 2136 => 21, 2227 => 22]],
            'bousyu' => [DateTime::SOLAR_TERM_BOUSYU, [2332 => 6, 2361 => 6, 2270 => 6, 1608 => 5, 1728 => 5, 2150 => 6, 2241 => 6]],
            'geshi' => [DateTime::SOLAR_TERM_GESHI, [2321 => 22, 2383 => 22, 2263 => 22, 2296 => 20]],
            'syousyo' => [DateTime::SOLAR_TERM_SYOUSYO, [2318 => 8, 2347 => 8, 2260 => 7, 2111 => 8]],
            'taisyo' => [DateTime::SOLAR_TERM_TAISYO, [2344 => 23, 1719 => 23, 2166 => 23, 2286 => 23]],
            'rissyuu' => [DateTime::SOLAR_TERM_RISSYUU, [2308 => 8, 2370 => 8, 1799 => 7, 2130 => 8]],
            'syosyo' => [DateTime::SOLAR_TERM_SYOSYO, [2326 => 24, 2384 => 23, 2206 => 24, 2235 => 24]],
            'hakuro' => [DateTime::SOLAR_TERM_HAKURO, [2332 => 8, 2361 => 8, 2398 => 7, 1964 => 8, 2117 => 8, 2270 => 8]],
            'syuubun' => [DateTime::SOLAR_TERM_SYUUBUN, [2355 => 24, 2384 => 23, 1917 => 23]],
            'kanro' => [DateTime::SOLAR_TERM_KANRO, [2362 => 9, 2399 => 8, 2205 => 9, 2300 => 9]],
            'soukou' => [DateTime::SOLAR_TERM_SOUKOU, [2386 => 24, 1998 => 24, 2159 => 24, 2196 => 22, 2225 => 24, 2258 => 24]],
            'rittou' => [DateTime::SOLAR_TERM_RITTOU, [2328 => 8, 2361 => 8, 2398 => 7, 2229 => 8, 2299 => 7]],
            'syousetsu' => [DateTime::SOLAR_TERM_SYOUSETSU, [2320 => 23, 2353 => 23, 2386 => 23, 2118 => 23]],
            'taisetsu' => [DateTime::SOLAR_TERM_TAISETSU, [1649 => 7, 1752 => 7]],
            'touji' => [DateTime::SOLAR_TERM_TOUJI, [2367 => 23, 1646 => 22]],
            'syoukan' => [DateTime::SOLAR_TERM_SYOUKAN, [2332 => 7, 1607 => 6, 1710 => 6, 1850 => 6, 2229 => 6]],
            'daikan' => [DateTime::SOLAR_TERM_DAIKAN, [2362 => 21, 1604 => 21, 1950 => 21]],
            'rissyun' => [DateTime::SOLAR_TERM_RISSYUN, [2157 => 4]],
            'usui' => [DateTime::SOLAR_TERM_USUI, [2302 => 20, 2030 => 19, 2133 => 19]],
            'keichitsu' => [DateTime::SOLAR_TERM_KEICHITSU, [2187 => 6, 2220 => 6, 2253 => 6, 2286 => 6]],
        ];

        foreach ($overrides as $method => [$solarTerm, $years]) {
            foreach ($years as $year => $day) {
                $cases[$method . ' ' . $year] = [
                    $method,
                    $year,
                    $solarTerm,
                    $day,
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
            $cases[$method . ' after supported range'] = [$method, 2400];
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
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
     * 対応表の開始年で全二十四節気を取得できることを確認する。
     *
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function test_getSolarTermsSupportsTableStartYear(): void
    {
        $solarTerms = (new SimpleSolarTerm())->getSolarTerms(1600);

        $this->assertCount(24, $solarTerms);

        foreach ($solarTerms as $solarTerm => $solarTermDate) {
            $this->assertInstanceOf(SolarTermDate::class, $solarTermDate);
            $this->assertSame(1600, $solarTermDate->year);
            $this->assertSame($solarTerm, $solarTermDate->solar_term);
        }
    }
    /**
     * 生成済みテーブルの期間境界で、各メソッドが期待する日付を返すことを確認する。
     * @dataProvider simpleSolarTermTableRangeDataProvider
     */
    public function test_simpleSolarTermTableRanges($method, $year, $solarTerm, $day): void
    {
        $solarTermDate = (new SimpleSolarTerm())->{$method}($year);
        $this->assertInstanceOf(SolarTermDate::class, $solarTermDate);
        $this->assertSame($year, $solarTermDate->year);
        $this->assertSame($solarTerm, $solarTermDate->solar_term);
        $this->assertSame($day, $solarTermDate->day, $year);
    }
    /**
     * 年単位の例外オーバーライドが期待する日付を返すことを確認する。
     * @dataProvider simpleSolarTermYearOverrideDataProvider
     */
    public function test_simpleSolarTermYearOverrides($method, $year, $solarTerm, $day): void
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function test_getSolarTermRejectsUndefinedSolarTerm(): void
    {
        $this->expectException(Exception::class);

        (new SimpleSolarTerm())->getSolarTerm(2000, 999);
    }
}
