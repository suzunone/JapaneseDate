<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Getter Trait の動的プロパティ取得を検証するテスト。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 */

namespace Test\JapaneseDate\Traits;

use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Getter Trait が提供する日付・暦情報のアクセサを検証する。
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 */
#[CoversTrait(\JapaneseDate\Traits\Getter::class)]
#[CoversMethod(\JapaneseDate\Traits\Getter::class, 'getCalendar')]
#[CoversMethod(\JapaneseDate\Traits\Getter::class, '__get')]
class GetterTest extends TestCase
{
    use InvokeTrait;

    /**
     * 二十四節気の日付プロパティを検証するための期待値を返す。
     */
    public static function solarTermDateGetterDataProvider(): array
    {
        $solarTerms = [
            'syunbun' => ['Syunbun', 'syunbun'],
            'seimei' => ['Seimei', 'seimei'],
            'kokuu' => ['Kokuu', 'kokuu'],
            'rikka' => ['Rikka', 'rikka'],
            'syouman' => ['Syouman', 'syouman'],
            'bousyu' => ['Bousyu', 'bousyu'],
            'geshi' => ['Geshi', 'geshi'],
            'syousyo' => ['Syousyo', 'syousyo'],
            'taisyo' => ['Taisyo', 'taisyo'],
            'rissyuu' => ['Rissyuu', 'rissyuu'],
            'syosyo' => ['Syosyo', 'syosyo'],
            'hakuro' => ['Hakuro', 'hakuro'],
            'syuubun' => ['Syuubun', 'syuubun'],
            'kanro' => ['Kanro', 'kanro'],
            'soukou' => ['Soukou', 'soukou'],
            'rittou' => ['Rittou', 'rittou'],
            'syousetsu' => ['Syousetsu', 'syousetsu'],
            'taisetsu' => ['Taisetsu', 'taisetsu'],
            'touji' => ['Touji', 'touji'],
            'syoukan' => ['Syoukan', 'syoukan'],
            'daikan' => ['Daikan', 'daikan'],
            'rissyun' => ['Rissyun', 'rissyun'],
            'usui' => ['Usui', 'usui'],
            'keichitsu' => ['Keichitsu', 'keichitsu'],
        ];

        $data = [];
        foreach ($solarTerms as $property => [$methodSuffix, $solarTermMethod]) {
            $term2017 = self::simpleSolarTerm($solarTermMethod, 2017);
            $term2018 = self::simpleSolarTerm($solarTermMethod, 2018);

            $data[$property] = [$property, self::expectedDate($term2018)];
            $data['next_' . $property] = ['next_' . $property, self::expectedDate($term2018)];
            $data['next' . $methodSuffix] = ['next' . $methodSuffix, self::expectedDate($term2018)];
            $data['before_' . $property] = ['before_' . $property, self::expectedDate($term2017)];
            $data['before' . $methodSuffix] = ['before' . $methodSuffix, self::expectedDate($term2017)];
        }

        return $data;
    }

    /**
     * グレゴリオ暦の年月日配列を取得できることを確認する。
     */
    public function test_getCalendar_gregorian(): void
    {
        $DateTime = new DateTime('2018-06-15');
        $result = $DateTime->getCalendar();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('year', $result);
        $this->assertArrayHasKey('month', $result);
        $this->assertArrayHasKey('day', $result);
    }

    /**
     * ユリウス暦の年月日配列を取得できることを確認する。
     */
    public function test_getCalendar_julian(): void
    {
        $DateTime = new DateTime('2018-06-15');
        $result = $DateTime->getCalendar(CAL_JULIAN);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('year', $result);
        $this->assertArrayHasKey('month', $result);
        $this->assertArrayHasKey('day', $result);
    }

    /**
     * 二十四節気名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_solar_term_text(): void
    {
        $DateTime = new DateTime('2018-04-05');
        $this->assertSame('清明', $DateTime->solar_term_text);
        $this->assertSame('清明', $DateTime->solarTermText);
    }

    /**
     * 二十四節気コードをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_solar_term(): void
    {
        $DateTime = new DateTime('2018-04-05');
        $this->assertSame(1, $DateTime->solar_term);
        $this->assertSame(1, $DateTime->solarTerm);
    }

    /**
     * 二十四節気当日かどうかをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_is_solar_term(): void
    {
        $DateTime = new DateTime('2018-04-05');
        $this->assertTrue($DateTime->is_solar_term);
        $this->assertTrue($DateTime->isSolarTerm);
    }

    /**
     * 二十四節気の日付プロパティが期待する日時を返すことを確認する。
     */
    #[DataProvider('solarTermDateGetterDataProvider')]
    public function test_get_solar_term_date_property(string $property, string $expected): void
    {
        $DateTime = new DateTime('2018-01-01 12:34:56');

        $this->assertSame($expected, $DateTime->{$property}->format('Y-m-d H:i:s'));
    }

    /**
     * 元号名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_era_name_text(): void
    {
        $DateTime = new DateTime('2019-05-01');
        $this->assertSame('令和', $DateTime->era_name_text);
        $this->assertSame('令和', $DateTime->eraNameText);
    }

    /**
     * 元号コードをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_era_name(): void
    {
        $DateTime = new DateTime('2019-05-01');
        $this->assertSame(DateTime::ERA_REIWA, $DateTime->era_name);
        $this->assertSame(DateTime::ERA_REIWA, $DateTime->eraName);
    }

    /**
     * 元号年をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_era_year(): void
    {
        $DateTime = new DateTime('2019-05-01');
        $this->assertSame(1, $DateTime->era_year);
        $this->assertSame(1, $DateTime->eraYear);
    }

    /**
     * 干支名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_oriental_zodiac_text(): void
    {
        $DateTime = new DateTime('2016-05-21');
        $this->assertSame('申', $DateTime->oriental_zodiac_text);
        $this->assertSame('申', $DateTime->orientalZodiacText);
    }

    /**
     * 干支コードをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_oriental_zodiac(): void
    {
        $DateTime = new DateTime('2019-05-21');
        $this->assertSame(0, $DateTime->oriental_zodiac);
        $this->assertSame(0, $DateTime->orientalZodiac);
    }

    /**
     * 六曜名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_six_weekday_text(): void
    {
        $DateTime = new DateTime('2018-03-01');
        $this->assertSame('友引', $DateTime->six_weekday_text);
        $this->assertSame('友引', $DateTime->sixWeekdayText);
    }

    /**
     * 六曜コードをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_six_weekday(): void
    {
        $DateTime = new DateTime('2018-03-01');
        $this->assertSame(3, $DateTime->six_weekday);
        $this->assertSame(3, $DateTime->sixWeekday);
    }

    /**
     * 曜日名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_weekday_text(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertSame('月', $DateTime->weekday_text);
        $this->assertSame('月', $DateTime->weekdayText);
    }

    /**
     * 和風月名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_month_text(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertSame('睦月', $DateTime->month_text);
        $this->assertSame('睦月', $DateTime->monthText);
    }

    /**
     * 祝日名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_holiday_text(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertSame('元旦', $DateTime->holiday_text);
        $this->assertSame('元旦', $DateTime->holidayText);
    }

    /**
     * 祝日コードを取得できることを確認する。
     */
    public function test_get_holiday(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertSame(DateTime::NEW_YEAR_S_DAY, $DateTime->holiday);
    }

    /**
     * 祝日かどうかをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_is_holiday(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertTrue($DateTime->is_holiday);
        $this->assertTrue($DateTime->isHoliday);

        $DateTime = new DateTime('2018-01-04');
        $this->assertFalse($DateTime->is_holiday);
        $this->assertFalse($DateTime->isHoliday);
    }

    /**
     * 旧暦月名をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_lunar_month_text(): void
    {
        $DateTime = new DateTime('2018-03-01');
        $this->assertSame('睦月', $DateTime->lunar_month_text);
        $this->assertSame('睦月', $DateTime->lunarMonthText);
    }

    /**
     * 旧暦月をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_lunar_month(): void
    {
        $DateTime = new DateTime('2018-03-01');
        $this->assertSame('1', $DateTime->lunar_month);
        $this->assertSame('1', $DateTime->lunarMonth);
    }

    /**
     * 旧暦年をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_lunar_year(): void
    {
        $DateTime = new DateTime('2018-03-01');
        $this->assertSame('2018', $DateTime->lunar_year);
        $this->assertSame('2018', $DateTime->lunarYear);
    }

    /**
     * 旧暦日をスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_lunar_day(): void
    {
        $DateTime = new DateTime('2018-03-01');
        $this->assertSame('14', $DateTime->lunar_day);
        $this->assertSame('14', $DateTime->lunarDay);
    }

    /**
     * 閏月かどうかをスネークケースとキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_is_leap_month(): void
    {
        $DateTime = new DateTime('2017-06-24');
        $this->assertTrue($DateTime->is_leap_month);
        $this->assertTrue($DateTime->isLeapMonth);

        $DateTime = new DateTime('2018-01-01');
        $this->assertFalse($DateTime->is_leap_month);
        $this->assertFalse($DateTime->isLeapMonth);
    }

    /**
     * Getter Trait で扱わないプロパティは親クラスの取得処理へ委譲されることを確認する。
     */
    public function test_get_parent_fallback(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertSame(1, $DateTime->dayOfYear);
    }

    /**
     * 月齢をキャメルケースのプロパティで取得できることを確認する。
     */
    public function test_get_moonAge(): void
    {
        $DateTime = new DateTime('2018-01-01');
        $this->assertSame(13.47782236803323, $DateTime->moonAge);

    }

    /**
     * SimpleSolarTerm から指定年の二十四節気日付を取得する。
     */
    private static function simpleSolarTerm(string $method, int $year): SolarTermDate
    {
        return (new SimpleSolarTerm())->{$method}($year);
    }

    /**
     * 二十四節気日付を比較用の日時文字列へ変換する。
     */
    private static function expectedDate(SolarTermDate $term): string
    {
        return sprintf('%04d-%02d-%02d 12:34:56', $term->year, $term->month, $term->day);
    }
}
