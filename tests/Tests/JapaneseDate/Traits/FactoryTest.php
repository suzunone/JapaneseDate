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
 * @covers \JapaneseDate\Traits\Factory
 * @covers \JapaneseDate\Traits\Factory::factory
 */
class FactoryTest extends TestCase
{
    use InvokeTrait;
    // -----------------------------------------------------------------------
    // DataProvider
    // -----------------------------------------------------------------------
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
                date('Y-m-d H:i:s', $digitStringWithTimezone),
                'Asia/Tokyo',
                null,
                null,
            ],
            'strtotime 可能な数字文字列' => [
                $parseableDigitString,
                null,
                date('Y-m-d H:i:s', strtotime($parseableDigitString)),
                null,
                null,
                null,
            ],
        ];

        foreach (self::floatUnixTimestampProvider() as $label => [$timestamp, $expectedMicro]) {
            $rows["float UNIX タイムスタンプ / {$label}"] = [
                $timestamp,
                null,
                null,
                null,
                (int) $timestamp,
                $expectedMicro,
            ];
            $rows["float UNIX タイムスタンプ / timezone / {$label}"] = [
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
            '元号漢字表記（令和）' => ['令和7年5月1日', null, '2025-05-01 00:00:00', 'Asia/Tokyo'],
            '元号漢字表記（令和） / timezone' => [
                '令和7年5月1日',
                new DateTimeZone('UTC'),
                '2025-04-30 15:00:00',
                'UTC',
            ],
            '元号漢字表記（昭和） / 時刻付き' => [
                '昭和64年1月7日 12時34分56秒',
                null,
                '1989-01-07 12:34:56',
                'Asia/Tokyo',
            ],
            '西暦日本語表記' => ['2026年5月1日 12時34分', null, '2026-05-01 12:34:00', 'Asia/Tokyo'],
            'JIS元号アルファベット（令和）' => ['R7-05-01', null, '2025-05-01 00:00:00', 'Asia/Tokyo'],
            'JIS元号アルファベット（平成）' => ['H1/01/08', null, '1989-01-08 00:00:00', 'Asia/Tokyo'],
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
                $combined["{$className} / {$label}"] = array_merge([$class], $row);
            }
        }

        return $combined;
    }
    /**
     * 基本入力から各クラスのインスタンスを生成できることを確認する。
     *
     * @param class-string $class
     * @param mixed $input
     * @dataProvider factoryInputProvider
     */
    public function test_factory_creates_expected_result(string $class, mixed $input, ?DateTimeZone $timezone, ?string $expectedDateTime, ?string $expectedTimezone, ?int $expectedTimestamp, ?int $expectedMicrosecond): void
    {
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
     * @dataProvider dateTimeInterfaceInputProvider
     */
    public function test_factory_DateTimeInterface(string $class, callable $sourceFactory, ?DateTimeZone $timezone, string $expectedDateTime, string $expectedTimezone, int $expectedMicrosecond): void
    {
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
     * @dataProvider crossClassInputProvider
     */
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
     * @dataProvider japaneseDateStringProvider
     */
    public function test_factory_japanese_date_string(string $class, string $input, ?DateTimeZone $timezone, string $expectedDateTime, string $expectedTimezone): void
    {
        $result = $class::factory($input, $timezone);
        $this->assertInstanceOf($class, $result);
        $this->assertSame($expectedDateTime, $result->format('Y-m-d H:i:s'));
        $this->assertSame($expectedTimezone, $result->getTimezone()->getName());
    }
    /**
     * parseJisDate が null を返す不正な和暦文字列は new static() にフォールバックすることを確認する。
     *
     * @param class-string $class
     * @dataProvider targetClassProvider
     */
    public function test_factory_invalid_japanese_string_falls_through_to_new_static(string $class): void
    {
        $this->expectException(NativeDateTimeException::class);
        $class::factory('令和7年2月30日');
    }
    /**
     * 境界値と特殊な入力を生成できることを確認する。
     * @dataProvider boundaryInputProvider
     */
    public function test_factory_boundary_inputs(mixed $input, int $expectedTimestamp, ?int $expectedMicrosecond): void
    {
        $result = DateTime::factory($input);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($expectedTimestamp, $result->getTimestamp());
        if ($expectedMicrosecond !== null) {
            $this->assertSame($expectedMicrosecond, $result->microsecond);
        }
    }
    // -----------------------------------------------------------------------
    // parseJisDate のテスト
    // -----------------------------------------------------------------------
    /**
     * JIS日時のパーステスト（ISO形式で比較）
     * @dataProvider jisDateProvider
     */
    public function testParseJisDateWithMicrotime(string $input, ?string $expectedIso): void
    {
        $resultTimestamp = $this->invokeExecuteMethod(DateTime::class, 'parseJisDate', [$input]);
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
}
