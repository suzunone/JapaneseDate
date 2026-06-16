<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Factory Trait の DateTime / DateTimeImmutable 生成処理を検証するテスト。
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

namespace Tests\JapaneseDate\Traits;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use DateTimeImmutable as NativeDateTimeImmutable;
use DateTimeZone;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Exceptions\NativeDateTimeException;
use JapaneseDate\Traits\Factory;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Factory Trait が対応する入力型ごとの生成結果を検証する。
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
#[CoversTrait(Factory::class)]
#[CoversMethod(Factory::class, 'factory')]
#[CoversMethod(Factory::class, 'createFromFormat')]
class FactoryTest extends TestCase
{
    use InvokeTrait;

    // -----------------------------------------------------------------------
    // DataProvider
    // -----------------------------------------------------------------------

    /**
     * factory の基本入力パターンを供給するプロバイダ。
     */
    public static function factoryInputProvider(): array
    {
        $intTimestamp = mktime(12, 34, 56, 3, 20, 2024);
        $intTimestampWithTimezone = mktime(12, 0, 0, 6, 15, 2023);
        $digitStringTimestamp = mktime(0, 0, 0, 1, 1, 2024);
        $digitStringWithTimezone = mktime(0, 0, 0, 7, 7, 2023);
        $parseableDigitString = '20240615';
        $rows = [
            'null' => [null, null, null, null, null, null],
            'null / timezone' => [null, new DateTimeZone('Asia/Tokyo'), null, 'Asia/Tokyo', null, null],
            '日時文字列' => ['2024-03-20 12:34:56', null, '2024-03-20 12:34:56', null, null, null],
            '日時文字列 / timezone' => [
                '2024-03-20 12:34:56',
                new DateTimeZone('Asia/Tokyo'),
                '2024-03-20 12:34:56',
                'Asia/Tokyo',
                null,
                null,
            ],
            '整数 UNIX タイムスタンプ' => [$intTimestamp, null, null, null, $intTimestamp, null],
            '整数 UNIX タイムスタンプ / timezone' => [
                $intTimestampWithTimezone,
                new DateTimeZone('Asia/Tokyo'),
                null,
                'Asia/Tokyo',
                $intTimestampWithTimezone,
                null,
            ],
            '数字文字列 UNIX タイムスタンプ' => [
                (string) $digitStringTimestamp,
                null,
                null,
                null,
                $digitStringTimestamp,
                null,
            ],
            '数字文字列 UNIX タイムスタンプ / timezone' => [
                (string) $digitStringWithTimezone,
                new DateTimeZone('Asia/Tokyo'),
                (new NativeDateTimeImmutable('@' . $digitStringWithTimezone))
                    ->setTimezone(new DateTimeZone('Asia/Tokyo'))
                    ->format('Y-m-d H:i:s'),
                'Asia/Tokyo',
                null,
                null,
            ],
            '8桁の数字文字列 UNIX タイムスタンプ' => [
                $parseableDigitString,
                null,
                null,
                null,
                (int) $parseableDigitString,
                null,
            ],
        ];

        foreach (self::floatUnixTimestampProvider() as $label => [$timestamp, $expectedMicro]) {
            $rows["float UNIX タイムスタンプ / $label"] = [
                $timestamp,
                null,
                null,
                null,
                (int) $timestamp,
                $expectedMicro,
            ];
            $rows["float UNIX タイムスタンプ / timezone / $label"] = [
                $timestamp,
                new DateTimeZone('America/New_York'),
                null,
                'America/New_York',
                (int) $timestamp,
                $expectedMicro,
            ];
        }

        return self::withTargetClasses($rows);
    }

    /**
     * float タイムスタンプとその期待マイクロ秒値を供給するプロバイダ。
     */
    public static function floatUnixTimestampProvider(): array
    {
        return [
            'float型小数点以下あり' => [1710936896.750123, 750123],
            '文字列型小数点以下あり' => ['1710936896.750123', 750123],
            'float型小数点以下なし' => [1710936896.0000, 0],
            '文字列型小数点以下なし' => ['1710936896.0000', 0],
        ];
    }

    /**
     * 対象クラスとテストデータを組み合わせる。
     */
    private static function withTargetClasses(array $rows): array
    {
        $combined = [];
        foreach (self::targetClassProvider() as $className => [$class]) {
            foreach ($rows as $label => $row) {
                $combined["$className / $label"] = array_merge([$class], $row);
            }
        }

        return $combined;
    }

    /**
     * DateTime / DateTimeImmutable の両クラスを供給するプロバイダ。
     */
    public static function targetClassProvider(): array
    {
        return [
            'DateTime' => [DateTime::class],
            'DateTimeImmutable' => [DateTimeImmutable::class],
        ];
    }

    /**
     * DateTimeInterface 入力のパターンを供給するプロバイダ。
     */
    public static function dateTimeInterfaceInputProvider(): array
    {
        $rows = [
            'native DateTimeImmutable' => [
                static fn (string $class): NativeDateTimeImmutable => new NativeDateTimeImmutable(
                    '2024-05-15 10:20:30.123456',
                    new DateTimeZone('UTC')
                ),
                null,
                '2024-05-15 10:20:30',
                'UTC',
                123456,
            ],
            'native DateTimeImmutable / timezone inherited' => [
                static fn (string $class): NativeDateTimeImmutable => new NativeDateTimeImmutable(
                    '2024-05-15 10:20:30.654321',
                    new DateTimeZone('Asia/Tokyo')
                ),
                null,
                '2024-05-15 10:20:30',
                'Asia/Tokyo',
                654321,
            ],
            'native DateTimeImmutable / timezone override' => [
                static fn (string $class): NativeDateTimeImmutable => new NativeDateTimeImmutable(
                    '2024-05-15 10:20:30',
                    new DateTimeZone('UTC')
                ),
                new DateTimeZone('Asia/Tokyo'),
                '2024-05-15 10:20:30',
                'Asia/Tokyo',
                0,
            ],
            'same JapaneseDate class object' => [
                static fn (string $class): object => new $class('2024-08-01 08:00:00', new DateTimeZone('Asia/Tokyo')),
                null,
                '2024-08-01 08:00:00',
                'Asia/Tokyo',
                0,
            ],
        ];

        return self::withTargetClasses($rows);
    }

    /**
     * DateTime と DateTimeImmutable の相互入力パターンを供給するプロバイダ。
     */
    public static function crossClassInputProvider(): array
    {
        return [
            'DateTimeImmutable から DateTime' => [
                DateTime::class,
                new DateTimeImmutable('2024-11-03 09:00:00', new DateTimeZone('Asia/Tokyo')),
            ],
            'DateTime から DateTimeImmutable' => [
                DateTimeImmutable::class,
                new DateTime('2024-11-03 09:00:00', new DateTimeZone('Asia/Tokyo')),
            ],
        ];
    }

    /**
     * 和暦・JIS元号形式の文字列入力パターンを供給するプロバイダ。
     */
    public static function japaneseDateStringProvider(): array
    {
        return self::withTargetClasses([
            '元号漢字表記（令和）' => ['令和7年5月1日', null, '2025-05-01 00:00:00', 'UTC'],
            '元号漢字表記（令和） / timezone' => [
                '令和7年5月1日',
                new DateTimeZone('UTC'),
                '2025-05-01 00:00:00',
                'UTC',
            ],
            '元号漢字表記（昭和） / 時刻付き' => [
                '昭和64年1月7日 12時34分56秒',
                null,
                '1989-01-07 12:34:56',
                'UTC',
            ],
            '西暦日本語表記' => ['2026年5月1日 12時34分', null, '2026-05-01 12:34:00', 'UTC'],
            'JIS元号アルファベット（令和）' => ['R7-05-01', null, '2025-05-01 00:00:00', 'UTC'],
            'JIS元号アルファベット（平成）' => ['H1/01/08', null, '1989-01-08 00:00:00', 'UTC'],
        ]);
    }

    /**
     * 境界値と特殊な入力のパターンを供給するプロバイダ。
     */
    public static function boundaryInputProvider(): array
    {
        $base = mktime(0, 0, 0, 6, 1, 2024);
        $negativeTimestamp = mktime(0, 0, 0, 1, 1, 1960);

        return [
            'float の小数部分' => [(float) $base + 0.999000, $base, 999000],
            'UNIX タイムスタンプ 0' => [0, 0, null],
            '負の UNIX タイムスタンプ' => [$negativeTimestamp, $negativeTimestamp, null],
            '負の float UNIX タイムスタンプの小数部分' => [-100.5, -101, 500000],
        ];
    }

    /**
     * DateTime / DateTimeImmutable を供給するプロバイダ（createFromFormat 用）。
     */
    public static function createFromFormatProvider(): array
    {
        return [
            'DateTime / 基本フォーマット' => [
                DateTime::class,
                'Y-m-d H:i:s',
                '2015-01-01 00:00:00',
                '2015-01-01 00:00:00',
                null,
            ],
            'DateTimeImmutable / 基本フォーマット' => [
                DateTimeImmutable::class,
                'Y-m-d H:i:s',
                '2015-01-01 00:00:00',
                '2015-01-01 00:00:00',
                null,
            ],
            'DateTime / 日付のみフォーマット' => [
                DateTime::class,
                'Y-m-d',
                '2026-05-03',
                '2026-05-03',
                null,
            ],
            'DateTime / タイムゾーン指定' => [
                DateTime::class,
                'Y-m-d H:i:s',
                '2025-03-21 09:00:00',
                '2025-03-21 09:00:00',
                'Asia/Tokyo',
            ],
            'DateTimeImmutable / タイムゾーン指定' => [
                DateTimeImmutable::class,
                'Y-m-d H:i:s',
                '2025-03-21 09:00:00',
                '2025-03-21 09:00:00',
                'Asia/Tokyo',
            ],
        ];
    }

    /**
     * テストデータを供給するデータプロバイダ（期待値をISO形式で定義）
     */
    public static function jisDateProvider(): array
    {
        return [
            // --- 西暦パターン ---
            '西暦標準形式' => [
                '2026-05-31 22:35:45',
                '2026-05-31T22:35:45.000000+09:00'
            ],
            '西暦標準形式（マイクロ秒付き）' => [
                '2026-05-31 22:35:45.123456',
                '2026-05-31T22:35:45.123456+09:00'
            ],
            '西暦日本語表記（秒なし）' => [
                '2026年05月31日 22時35分',
                '2026-05-31T22:35:00.000000+09:00'
            ],
            '西暦日本語表記（年月日のみ）' => [
                '2026年5月31日',
                '2026-05-31T00:00:00.000000+09:00'
            ],

            // --- 和暦（漢字）パターン ---
            '和暦日本語表記（フル）' => [
                '令和8年5月31日 22時35分45秒',
                '2026-05-31T22:35:45.000000+09:00'
            ],
            '和暦日本語表記（ミリ秒付き）' => [
                '令和8年5月31日 22時35分45秒.999',
                '2026-05-31T22:35:45.999000+09:00'
            ],
            '和暦日本語表記（年月日のみ）' => [
                '令和8年05月31日',
                '2026-05-31T00:00:00.000000+09:00'
            ],
            '平成の過去日付' => [
                '平成28年10月25日',
                '2016-10-25T00:00:00.000000+09:00'
            ],

            // --- 和暦（JIS記号）パターン ---
            'JIS元号アルファベット（ハイフン区切り）' => [
                'R08-05-31',
                '2026-05-31T00:00:00.000000+09:00'
            ],
            'JIS元号アルファベット（スラッシュ区切り）' => [
                'R08/05/31',
                '2026-05-31T00:00:00.000000+09:00'
            ],
            'JIS元号アルファベット（小文字）' => [
                'r08-05-31',
                '2026-05-31T00:00:00.000000+09:00'
            ],
            'JIS元号アルファベット（過去・平成）' => [
                'H28/10/25',
                '2016-10-25T00:00:00.000000+09:00'
            ],

            // --- エラー判定パターン ---
            'パース不可能な不正文字列' => [
                'invalid-date-string',
                null
            ],
            '存在しない日付' => [
                '令和8年02月30日',
                null
            ],
        ];
    }

    /**
     * 基本入力から各クラスのインスタンスを生成できることを確認する。
     *
     * @param class-string $class
     * @param mixed $input
     * @param \DateTimeZone|null $timezone
     * @param string|null $expectedDateTime
     * @param string|null $expectedTimezone
     * @param int|null $expectedTimestamp
     * @param int|null $expectedMicrosecond
     */
    #[DataProvider('factoryInputProvider')]
    public function test_factory_creates_expected_result(
        string $class,
        mixed $input,
        ?DateTimeZone $timezone,
        ?string $expectedDateTime,
        ?string $expectedTimezone,
        ?int $expectedTimestamp,
        ?int $expectedMicrosecond
    ): void {
        $result = $input === null && $timezone === null
            ? $class::factory()
            : $class::factory($input, $timezone);

        $this->assertInstanceOf($class, $result);
        if ($expectedDateTime !== null) {
            $this->assertSame($expectedDateTime, $result->format('Y-m-d H:i:s'));
        }
        if ($expectedTimezone !== null) {
            $this->assertSame($expectedTimezone, $result->getTimezone()->getName());
        }
        if ($expectedTimestamp !== null) {
            $this->assertSame($expectedTimestamp, $result->getTimestamp());
        }
        if ($expectedMicrosecond !== null) {
            $this->assertSame($expectedMicrosecond, $result->microsecond);
        }
    }

    /**
     * DateTimeInterface から各クラスのインスタンスを生成できることを確認する。
     *
     * @param class-string $class
     * @param callable $sourceFactory
     * @param \DateTimeZone|null $timezone
     * @param string $expectedDateTime
     * @param string $expectedTimezone
     * @param int $expectedMicrosecond
     */
    #[DataProvider('dateTimeInterfaceInputProvider')]
    public function test_factory_DateTimeInterface(
        string $class,
        callable $sourceFactory,
        ?DateTimeZone $timezone,
        string $expectedDateTime,
        string $expectedTimezone,
        int $expectedMicrosecond
    ): void {
        $result = $class::factory($sourceFactory($class), $timezone);
        $this->assertInstanceOf($class, $result);
        $this->assertSame($expectedDateTime, $result->format('Y-m-d H:i:s'));
        $this->assertSame($expectedTimezone, $result->getTimezone()->getName());
        $this->assertSame($expectedMicrosecond, $result->microsecond);
    }

    /**
     * DateTime と DateTimeImmutable を相互に入力して生成できることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('crossClassInputProvider')]
    public function test_factory_accepts_other_JapaneseDate_class(string $class, object $source): void
    {
        $result = $class::factory($source);
        $this->assertInstanceOf($class, $result);
        $this->assertSame('2024-11-03 09:00:00', $result->format('Y-m-d H:i:s'));
    }

    /**
     * 和暦・JIS元号形式の文字列から各クラスのインスタンスを生成できることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('japaneseDateStringProvider')]
    public function test_factory_japanese_date_string(
        string $class,
        string $input,
        ?DateTimeZone $timezone,
        string $expectedDateTime,
        string $expectedTimezone
    ): void {
        $result = $class::factory($input, $timezone);
        $this->assertInstanceOf($class, $result);
        $this->assertSame($expectedDateTime, $result->format('Y-m-d H:i:s'));
        $this->assertSame($expectedTimezone, $result->getTimezone()->getName());
    }

    // -----------------------------------------------------------------------
    // createFromFormat のテスト
    // -----------------------------------------------------------------------

    /**
     * {@link \JapaneseDate\Traits\Factory::parseJisDate} が null を返す不正な和暦文字列は new static() にフォールバックすることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('targetClassProvider')]
    public function test_factory_invalid_japanese_string_falls_through_to_new_static(string $class): void
    {
        $this->expectException(NativeDateTimeException::class);
        $class::factory('令和7年2月30日');
    }

    /**
     * 境界値と特殊な入力を生成できることを確認する。
     */
    #[DataProvider('boundaryInputProvider')]
    public function test_factory_boundary_inputs(mixed $input, int $expectedTimestamp, ?int $expectedMicrosecond): void
    {
        $result = DateTime::factory($input);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($expectedTimestamp, $result->getTimestamp());
        if ($expectedMicrosecond !== null) {
            $this->assertSame($expectedMicrosecond, $result->microsecond);
        }
    }

    /**
     * int と float の Unix タイムスタンプ入力が同じデフォルトタイムゾーンで表示されることを確認する。
     */
    public function test_factory_int_and_float_timestamp_use_same_default_timezone(): void
    {
        $defaultTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Tokyo');

        try {
            $int = DateTime::factory(1_000_000_000);
            $float = DateTime::factory(1_000_000_000.0);

            $this->assertSame($int->format('Y-m-d H:i:s P'), $float->format('Y-m-d H:i:s P'));
            $this->assertSame('Asia/Tokyo', $int->getTimezone()->getName());
            $this->assertSame('Asia/Tokyo', $float->getTimezone()->getName());
        } finally {
            date_default_timezone_set($defaultTimezone);
        }
    }

    /**
     * 数字文字列の Unix タイムスタンプが int 入力と同じ瞬間として生成されることを確認する。
     */
    public function test_factory_digit_string_timestamp_matches_int_timestamp(): void
    {
        $defaultTimezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Tokyo');

        try {
            $int = DateTime::factory(1_000_000_000);
            $string = DateTime::factory('1000000000');

            $this->assertSame($int->getTimestamp(), $string->getTimestamp());
            $this->assertSame($int->format('Y-m-d H:i:s P'), $string->format('Y-m-d H:i:s P'));
        } finally {
            date_default_timezone_set($defaultTimezone);
        }
    }

    /**
     * createFromFormat が正しいクラスのインスタンスを返すことを確認する。
     *
     * @param class-string $class
     * @param string $format
     * @param string $time
     * @param string $expectedDateTime
     * @param string|null $timezone
     * @throws \DateInvalidTimeZoneException
     */
    #[DataProvider('createFromFormatProvider')]
    public function test_createFromFormat_returns_correct_class(
        string $class,
        string $format,
        string $time,
        string $expectedDateTime,
        ?string $timezone
    ): void {
        $tz = $timezone !== null ? new DateTimeZone($timezone) : null;
        $result = $tz !== null
            ? $class::createFromFormat($format, $time, $tz)
            : $class::createFromFormat($format, $time);

        $this->assertInstanceOf($class, $result);
        // フォーマットに時刻が含まれない場合は日付部分のみ比較
        $compareFormat = str_contains($format, 'H') ? 'Y-m-d H:i:s' : 'Y-m-d';
        $this->assertSame($expectedDateTime, $result->format($compareFormat));
        if ($timezone !== null) {
            $this->assertSame($timezone, $result->getTimezone()->getName());
        }
    }

    /**
     * createFromFormat で生成したインスタンスの JapaneseDate コンポーネントが初期化済みであることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('targetClassProvider')]
    public function test_createFromFormat_initializes_components(string $class): void
    {
        $result = $class::createFromFormat('Y-m-d H:i:s', '2015-01-01 00:00:00');

        $this->assertNotNull($result);
        // JapaneseDate 固有プロパティが取得できることでコンポーネント初期化を確認
        $this->assertSame('元旦', $result->holiday_text);
        $this->assertSame(1, $result->holiday);
        $this->assertTrue($result->is_holiday);
        $this->assertSame('平成', $result->era_name_text);
        $this->assertSame(27, $result->era_year);
    }

    /**
     * createFromFormat で生成したインスタンスの toArray() が timezone 以外の全キーを含むことを確認する。
     * DateTime のみ検証（DateTimeImmutable は MiscSeasonalNode の型制約により別途対応）。
     */
    public function test_createFromFormat_toArray_contains_japanese_keys(): void
    {
        $class = DateTime::class;
        $result = $class::createFromFormat('Y-m-d H:i:s', '2026-05-03 00:00:00');

        $this->assertNotNull($result);
        $arr = $result->toArray();

        $expectedKeys = [
            'solar_seasonal_festival', 'solar_seasonal_festival_name', 'solar_seasonal_festival_alias',
            'lunar_seasonal_festival', 'lunar_seasonal_festival_name', 'lunar_seasonal_festival_alias',
            'misc_seasonal_node', 'misc_seasonal_node_text',
            'solar_term', 'solar_term_text', 'is_solar_term',
            'era_name_text', 'era_name', 'era_year',
            'oriental_zodiac_text', 'oriental_zodiac',
            'heavenly_stem_text', 'heavenly_stem',
            'six_weekday_text', 'six_weekday',
            'weekday_text', 'month_text',
            'holiday_text', 'holiday', 'is_holiday',
            'lunar_month_text', 'lunar_month', 'lunar_year', 'lunar_day', 'is_leap_month',
            'moon_age', 'moon_phase_angle', 'moon_phase', 'moon_phase_text',
        ];

        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $arr, "toArray() に '$key' キーが存在しません。");
        }

        // 祝日（憲法記念日）の検証
        $this->assertSame('憲法記念日', $arr['holiday_text']);
        $this->assertTrue($arr['is_holiday']);
    }

    // -----------------------------------------------------------------------
    // {@link \JapaneseDate\Traits\Factory::parseJisDate}  のテスト
    // -----------------------------------------------------------------------

    /**
     * createFromFormat に不正な文字列を渡した場合、strict mode により例外がスローされることを確認する。
     *
     * @param class-string $class
     */
    #[DataProvider('targetClassProvider')]
    public function test_createFromFormat_throws_on_invalid_input(string $class): void
    {
        $this->expectException(InvalidFormatException::class);
        $class::createFromFormat('Y-m-d', 'invalid-date');
    }

    /**
     * JIS日時のパーステスト（ISO形式で比較）
     */
    #[DataProvider('jisDateProvider')]
    public function testParseJisDateWithMicrotime(string $input, ?string $expectedIso): void
    {
        $resultTimestamp = $this->invokeExecuteMethod(DateTime::class, 'parseJisDate', [$input, new DateTimeZone('Asia/Tokyo')]);

        if ($expectedIso === null) {
            $this->assertNull($resultTimestamp);

            return;
        }

        $this->assertNotNull($resultTimestamp, 'パース結果が null になりました。');

        $date = Carbon::createFromTimestamp($resultTimestamp, new DateTimeZone('Asia/Tokyo'));
        $actualIso = $date->format('Y-m-d\TH:i:s.uP');
        $this->assertSame($expectedIso, $actualIso);
    }

    /**
     * 和暦・日本語日付パースが PHP のデフォルトタイムゾーンを使用することを確認する。
     */
    public function test_parseJisDate_uses_default_timezone(): void
    {
        $defaultTimezone = date_default_timezone_get();
        date_default_timezone_set('America/New_York');

        try {
            $timestamp = $this->invokeExecuteMethod(DateTime::class, 'parseJisDate', ['令和7年5月1日 12時34分56秒']);
            $date = Carbon::createFromTimestamp($timestamp, new DateTimeZone('America/New_York'));

            $this->assertSame('2025-05-01T12:34:56.000000-04:00', $date->format('Y-m-d\TH:i:s.uP'));
        } finally {
            date_default_timezone_set($defaultTimezone);
        }
    }

    /**
     * float タイムスタンプのマイクロ秒部が 1,000,000 に丸められた場合、秒を繰り上げてマイクロ秒を 0 にすることを確認する。
     *
     * 0.9999999 → round(0.9999999 × 1_000_000) = round(999999.9) = 1_000_000 ≥ 1_000_000
     * → $seconds++ = 1、$micro = 0
     * (1.9999995 は 1.9999995−1 の浮動小数点誤差で 0 をまたがないため不適)
     */
    public function test_newFromTimestamp_microsecond_overflow_increments_second(): void
    {
        $result = DateTime::factory(0.9999999);

        $this->assertSame(1, $result->getTimestamp());
        $this->assertSame(0, $result->microsecond);
    }
}
