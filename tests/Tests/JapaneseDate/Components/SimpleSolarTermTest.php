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
            '/public function ([a-z]+)\(int \$year\): SolarTermDate\s*\{/m',
            $source,
            $methodMatches,
            PREG_OFFSET_CAPTURE,
        );

        foreach ($methodMatches[1] as $index => [$method, $methodOffset]) {
            if (!isset(self::SOLAR_TERM_METHODS[$method])) {
                continue;
            }

            $nextMethod = $methodMatches[0][$index + 1][1] ?? strlen($source);
            $methodBody = substr($source, $methodOffset, $nextMethod - $methodOffset);
            preg_match_all(
                '/\$year >= (\d+) && \$year <= (\d+)\) \{\R\s+\$days = \[([^\]]+)\]/',
                $methodBody,
                $rangeMatches,
                PREG_SET_ORDER,
            );

            if ($rangeMatches === []) {
                throw new LogicException($method . ' table ranges were not found.');
            }

            $overrides = self::simpleSolarTermYearOverrideDataProvider();

            foreach ($rangeMatches as $rangeMatch) {
                $rangeStart = (int) $rangeMatch[1];
                $rangeEnd = (int) $rangeMatch[2];
                $days = array_map(
                    'intval',
                    preg_split('/\D+/', trim($rangeMatch[3], " \t\n\r\0\x0B,"))
                );

                // 例外年は例外マップで処理されてレンジコードに到達しないため、
                // 中間点が例外年の場合はレンジ内の非例外年を選ぶ。
                $year = intdiv($rangeStart + $rangeEnd, 2);
                if (isset($overrides[$method . ' ' . $year])) {
                    for ($candidate = $rangeStart; $candidate <= $rangeEnd; $candidate++) {
                        if (!isset($overrides[$method . ' ' . $candidate])) {
                            $year = $candidate;
                            break;
                        }
                    }
                }

                $cases[$method . ' ' . $rangeStart . '-' . $rangeEnd] = [
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
            'syunbun' => [DateTime::SOLAR_TERM_SYUNBUN, [2352 => 20, 2385 => 20]],
            'seimei' => [DateTime::SOLAR_TERM_SEIMEI, [1724 => 5, 2141 => 4, 2302 => 5, 2335 => 5, 2368 => 4]],
            'kokuu' => [DateTime::SOLAR_TERM_KOKUU, [1735 => 21, 2082 => 19, 2272 => 19, 2334 => 20, 2367 => 20]],
            'rikka' => [DateTime::SOLAR_TERM_RIKKA, [1762 => 6, 2163 => 5, 2320 => 5, 2349 => 5, 2382 => 5]],
            'syouman' => [DateTime::SOLAR_TERM_SYOUMAN, [2136 => 20, 2227 => 21, 2318 => 21, 2351 => 21, 2380 => 20]],
            'bousyu' => [DateTime::SOLAR_TERM_BOUSYU, [1608 => 6, 1728 => 6, 2150 => 5, 2241 => 5, 2270 => 5, 2332 => 5, 2361 => 5, 2390 => 5]],
            'geshi' => [DateTime::SOLAR_TERM_GESHI, [2263 => 21, 2292 => 20, 2296 => 20, 2321 => 21, 2383 => 21]],
            'syousyo' => [DateTime::SOLAR_TERM_SYOUSYO, [2111 => 7, 2198 => 6, 2260 => 6, 2318 => 7, 2347 => 7]],
            'taisyo' => [DateTime::SOLAR_TERM_TAISYO, [1719 => 24, 2166 => 23, 2286 => 22, 2344 => 22]],
            'rissyuu' => [DateTime::SOLAR_TERM_RISSYUU, [1799 => 8, 2130 => 7, 2308 => 7, 2370 => 7, 2399 => 7]],
            'syosyo' => [DateTime::SOLAR_TERM_SYOSYO, [2206 => 23, 2235 => 23, 2326 => 23, 2384 => 22]],
            'hakuro' => [DateTime::SOLAR_TERM_HAKURO, [1964 => 7, 2117 => 7, 2270 => 7, 2332 => 7, 2361 => 7, 2394 => 7, 2398 => 7]],
            'syuubun' => [DateTime::SOLAR_TERM_SYUUBUN, [1917 => 24, 2355 => 23, 2384 => 22]],
            'kanro' => [DateTime::SOLAR_TERM_KANRO, [2205 => 8, 2300 => 8, 2362 => 8, 2395 => 8, 2399 => 8]],
            'soukou' => [DateTime::SOLAR_TERM_SOUKOU, [1998 => 23, 2159 => 23, 2192 => 22, 2196 => 22, 2225 => 23, 2258 => 23, 2386 => 23]],
            'rittou' => [DateTime::SOLAR_TERM_RITTOU, [2229 => 7, 2295 => 7, 2299 => 7, 2328 => 7, 2361 => 7, 2394 => 7, 2398 => 7]],
            'syousetsu' => [DateTime::SOLAR_TERM_SYOUSETSU, [2118 => 22, 2320 => 22, 2353 => 22, 2386 => 22]],
            'taisetsu' => [DateTime::SOLAR_TERM_TAISETSU, [1649 => 6, 1752 => 6]],
            'touji' => [DateTime::SOLAR_TERM_TOUJI, [1646 => 21, 2367 => 22]],
            'syoukan' => [DateTime::SOLAR_TERM_SYOUKAN, [1607 => 5, 1710 => 5, 1850 => 5, 2229 => 5, 2332 => 6]],
            'daikan' => [DateTime::SOLAR_TERM_DAIKAN, [1600 => 21, 1604 => 20, 1950 => 21, 2362 => 20]],
            'rissyun' => [DateTime::SOLAR_TERM_RISSYUN, [2157 => 3]],
            'usui' => [DateTime::SOLAR_TERM_USUI, [2030 => 19, 2133 => 18, 2302 => 19]],
            'keichitsu' => [DateTime::SOLAR_TERM_KEICHITSU, [2187 => 5, 2220 => 5, 2253 => 5, 2286 => 5]],
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
     */
    public function test_getSolarTermsMatchesNaoRekiYoko($year, array $expected): void
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
