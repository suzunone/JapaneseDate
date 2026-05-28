<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Test\JapaneseDate\Traits;

use DateTimeZone;
use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\Components\SolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Traits\FindSolarTerm;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * FindSolarTerm Trait が二十四節気の日付を探す処理を検証する。
 */
#[CoversTrait(FindSolarTerm::class)]
class FindSolarTermTest extends TestCase
{
    use InvokeTrait;

    /**
     * 二十四節気ごとのメソッド接尾辞と SimpleSolarTerm メソッド名を返す。
     */
    public static function solarTermDataProvider(): array
    {
        return [
            'Syunbun' => ['Syunbun', 'syunbun'],
            'Seimei' => ['Seimei', 'seimei'],
            'Kokuu' => ['Kokuu', 'kokuu'],
            'Rikka' => ['Rikka', 'rikka'],
            'Syouman' => ['Syouman', 'syouman'],
            'Bousyu' => ['Bousyu', 'bousyu'],
            'Geshi' => ['Geshi', 'geshi'],
            'Syousyo' => ['Syousyo', 'syousyo'],
            'Taisyo' => ['Taisyo', 'taisyo'],
            'Rissyuu' => ['Rissyuu', 'rissyuu'],
            'Syosyo' => ['Syosyo', 'syosyo'],
            'Hakuro' => ['Hakuro', 'hakuro'],
            'Syuubun' => ['Syuubun', 'syuubun'],
            'Kanro' => ['Kanro', 'kanro'],
            'Soukou' => ['Soukou', 'soukou'],
            'Rittou' => ['Rittou', 'rittou'],
            'Syousetsu' => ['Syousetsu', 'syousetsu'],
            'Taisetsu' => ['Taisetsu', 'taisetsu'],
            'Touji' => ['Touji', 'touji'],
            'Syoukan' => ['Syoukan', 'syoukan'],
            'Daikan' => ['Daikan', 'daikan'],
            'Rissyun' => ['Rissyun', 'rissyun'],
            'Usui' => ['Usui', 'usui'],
            'Keichitsu' => ['Keichitsu', 'keichitsu'],
        ];
    }

    /**
     * 次の二十四節気を探す境界日付の期待値を返す。
     */
    public static function nextSolarTermBoundaryDataProvider(): array
    {
        $data = [];
        foreach (self::solarTermDataProvider() as $label => [$methodSuffix, $solarTermMethod]) {
            $term2018 = self::simpleSolarTerm($solarTermMethod, 2018);
            $term2019 = self::simpleSolarTerm($solarTermMethod, 2019);
            $termDate = self::toNativeDateTime($term2018);

            $data[$label . ' day before returns current year'] = [
                $methodSuffix,
                $termDate->modify('-1 day')->format('Y-m-d 12:34:56'),
                self::expectedDate($term2018),
            ];
            $data[$label . ' day returns next year'] = [
                $methodSuffix,
                $termDate->format('Y-m-d 12:34:56'),
                self::expectedDate($term2019),
            ];
            $data[$label . ' day after returns next year'] = [
                $methodSuffix,
                $termDate->modify('+1 day')->format('Y-m-d 12:34:56'),
                self::expectedDate($term2019),
            ];
        }

        return $data;
    }

    /**
     * 前の二十四節気を探す境界日付の期待値を返す。
     */
    public static function beforeSolarTermBoundaryDataProvider(): array
    {
        $data = [];
        foreach (self::solarTermDataProvider() as $label => [$methodSuffix, $solarTermMethod]) {
            $term2017 = self::simpleSolarTerm($solarTermMethod, 2017);
            $term2018 = self::simpleSolarTerm($solarTermMethod, 2018);
            $termDate = self::toNativeDateTime($term2018);

            $data[$label . ' day before returns previous year'] = [
                $methodSuffix,
                $termDate->modify('-1 day')->format('Y-m-d 12:34:56'),
                self::expectedDate($term2017),
            ];
            $data[$label . ' day returns previous year'] = [
                $methodSuffix,
                $termDate->format('Y-m-d 12:34:56'),
                self::expectedDate($term2017),
            ];
            $data[$label . ' day after returns current year'] = [
                $methodSuffix,
                $termDate->modify('+1 day')->format('Y-m-d 12:34:56'),
                self::expectedDate($term2018),
            ];
        }

        return $data;
    }

    /**
     * DateTime で同一年の二十四節気日を取得できることを確認する。
     */
    #[DataProvider('solarTermDataProvider')]
    public function test_getSolarTermReturnsSameYearSolarTermForDateTime(string $methodSuffix, string $solarTermMethod): void
    {
        $dateTime = new DateTime('2024-08-01 07:08:09', new DateTimeZone('Asia/Tokyo'));
        $term = self::simpleSolarTerm($solarTermMethod, 2024);

        $result = $this->invokeExecuteMethod($dateTime, 'get' . $methodSuffix, []);

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame(self::expectedDate($term, '07:08:09'), $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTimeImmutable で同一年の二十四節気日を取得でき、元のインスタンスが変わらないことを確認する。
     */
    #[DataProvider('solarTermDataProvider')]
    public function test_getSolarTermReturnsSameYearSolarTermForDateTimeImmutable(
        string $methodSuffix,
        string $solarTermMethod
    ): void {
        $dateTime = new DateTimeImmutable('2024-08-01 07:08:09', new DateTimeZone('Asia/Tokyo'));
        $term = self::simpleSolarTerm($solarTermMethod, 2024);

        $result = $this->invokeExecuteMethod($dateTime, 'get' . $methodSuffix, []);

        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame(self::expectedDate($term, '07:08:09'), $result->format('Y-m-d H:i:s'));
        $this->assertSame('2024-08-01 07:08:09', $dateTime->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTime で次の二十四節気日が境界条件どおりに見つかることを確認する。
     */
    #[DataProvider('nextSolarTermBoundaryDataProvider')]
    public function test_getNextSolarTermFindsExpectedBoundaryForDateTime(
        string $methodSuffix,
        string $input,
        string $expected
    ): void {
        $dateTime = new DateTime($input, new DateTimeZone('Asia/Tokyo'));

        $result = $this->invokeExecuteMethod($dateTime, 'getNext' . $methodSuffix, []);

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($expected, $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTimeImmutable で次の二十四節気日が境界条件どおりに見つかることを確認する。
     */
    #[DataProvider('nextSolarTermBoundaryDataProvider')]
    public function test_getNextSolarTermFindsExpectedBoundaryForDateTimeImmutable(
        string $methodSuffix,
        string $input,
        string $expected
    ): void {
        $dateTime = new DateTimeImmutable($input, new DateTimeZone('Asia/Tokyo'));

        $result = $this->invokeExecuteMethod($dateTime, 'getNext' . $methodSuffix, []);

        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame($expected, $result->format('Y-m-d H:i:s'));
        $this->assertSame($input, $dateTime->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTime で前の二十四節気日が境界条件どおりに見つかることを確認する。
     */
    #[DataProvider('beforeSolarTermBoundaryDataProvider')]
    public function test_getBeforeSolarTermFindsExpectedBoundaryForDateTime(
        string $methodSuffix,
        string $input,
        string $expected
    ): void {
        $dateTime = new DateTime($input, new DateTimeZone('Asia/Tokyo'));

        $result = $this->invokeExecuteMethod($dateTime, 'getBefore' . $methodSuffix, []);

        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($expected, $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTimeImmutable で前の二十四節気日が境界条件どおりに見つかることを確認する。
     */
    #[DataProvider('beforeSolarTermBoundaryDataProvider')]
    public function test_getBeforeSolarTermFindsExpectedBoundaryForDateTimeImmutable(
        string $methodSuffix,
        string $input,
        string $expected
    ): void {
        $dateTime = new DateTimeImmutable($input, new DateTimeZone('Asia/Tokyo'));

        $result = $this->invokeExecuteMethod($dateTime, 'getBefore' . $methodSuffix, []);

        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame($expected, $result->format('Y-m-d H:i:s'));
        $this->assertSame($input, $dateTime->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * 簡易テーブルの範囲外では天文計算にフォールバックして同一年の二十四節気日を取得することを確認する。
     */
    #[DataProvider('solarTermDataProvider')]
    public function test_getSolarTermFallsBackToAstronomicalCalculationOutsideSimpleTable(
        string $methodSuffix,
        string $solarTermMethod
    ): void {
        $dateTime = new DateTime('1599-01-01 01:02:03', new DateTimeZone('Asia/Tokyo'));
        $term = self::astronomicalSolarTerm($solarTermMethod, 1599);

        $result = $this->invokeExecuteMethod($dateTime, 'get' . $methodSuffix, []);

        $this->assertSame(self::expectedDate($term, '01:02:03'), $result->format('Y-m-d H:i:s'));
    }

    /**
     * 簡易テーブルの範囲外では天文計算にフォールバックして次の二十四節気日を取得することを確認する。
     */
    #[DataProvider('solarTermDataProvider')]
    public function test_getNextSolarTermFallsBackToAstronomicalCalculationOutsideSimpleTable(
        string $methodSuffix,
        string $solarTermMethod
    ): void {
        $dateTime = new DateTime('1599-01-01 01:02:03', new DateTimeZone('Asia/Tokyo'));
        $term = self::astronomicalSolarTerm($solarTermMethod, 1599);

        $result = $this->invokeExecuteMethod($dateTime, 'getNext' . $methodSuffix, []);

        $this->assertSame(self::expectedDate($term, '01:02:03'), $result->format('Y-m-d H:i:s'));
    }

    /**
     * 簡易テーブルの範囲外では天文計算にフォールバックして前の二十四節気日を取得することを確認する。
     */
    #[DataProvider('solarTermDataProvider')]
    public function test_getBeforeSolarTermFallsBackToAstronomicalCalculationOutsideSimpleTable(
        string $methodSuffix,
        string $solarTermMethod
    ): void {
        $dateTime = new DateTime('1600-01-01 01:02:03', new DateTimeZone('Asia/Tokyo'));
        $term = self::astronomicalSolarTerm($solarTermMethod, 1599);

        $result = $this->invokeExecuteMethod($dateTime, 'getBefore' . $methodSuffix, []);

        $this->assertSame(self::expectedDate($term, '01:02:03'), $result->format('Y-m-d H:i:s'));
    }

    /**
     * SimpleSolarTerm から指定年の二十四節気日付を取得する。
     */
    private static function simpleSolarTerm(string $method, int $year): SolarTermDate
    {
        return (new SimpleSolarTerm())->{$method}($year);
    }

    /**
     * 天文計算版の SolarTerm から指定年の二十四節気日付を取得する。
     */
    private static function astronomicalSolarTerm(string $method, int $year): SolarTermDate
    {
        return (new SolarTerm())->{$method}($year);
    }

    /**
     * 二十四節気日付を PHP 標準の DateTimeImmutable に変換する。
     */
    private static function toNativeDateTime(SolarTermDate $term): \DateTimeImmutable
    {
        return new \DateTimeImmutable(sprintf('%04d-%02d-%02d', $term->year, $term->month, $term->day));
    }

    /**
     * 二十四節気日付を比較用の日時文字列へ変換する。
     */
    private static function expectedDate(SolarTermDate $term, string $time = '12:34:56'): string
    {
        return sprintf('%04d-%02d-%02d %s', $term->year, $term->month, $term->day, $time);
    }
}
