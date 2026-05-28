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

namespace Test\JapaneseDate\Traits;

use DateTimeImmutable as NativeDateTimeImmutable;
use DateTimeZone;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
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
#[CoversClass(\JapaneseDate\Traits\Factory::class)]
class FactoryTest extends TestCase
{
    use InvokeTrait;

    // -----------------------------------------------------------------------
    // DateTime::factory() のテスト
    // -----------------------------------------------------------------------

    /**
     * null から DateTime を生成できることを確認する。
     */
    public function test_factory_null_returns_DateTime(): void
    {
        $result = DateTime::factory();
        $this->assertInstanceOf(DateTime::class, $result);
    }

    /**
     * null とタイムゾーンから DateTime を生成できることを確認する。
     */
    public function test_factory_null_with_timezone_returns_DateTime(): void
    {
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTime::factory(null, $tz);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * 日時文字列から DateTime を生成できることを確認する。
     */
    public function test_factory_string_returns_correct_date_for_DateTime(): void
    {
        $result = DateTime::factory('2024-03-20 12:34:56');
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('2024-03-20 12:34:56', $result->format('Y-m-d H:i:s'));
    }

    /**
     * 日時文字列とタイムゾーンから DateTime を生成できることを確認する。
     */
    public function test_factory_string_with_timezone_for_DateTime(): void
    {
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTime::factory('2024-03-20 12:34:56', $tz);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('2024-03-20 12:34:56', $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * 整数の UNIX タイムスタンプから DateTime を生成できることを確認する。
     */
    public function test_factory_int_unix_timestamp_for_DateTime(): void
    {
        $timestamp = mktime(12, 34, 56, 3, 20, 2024);
        $result = DateTime::factory($timestamp);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
    }

    /**
     * 整数の UNIX タイムスタンプとタイムゾーンから DateTime を生成できることを確認する。
     */
    public function test_factory_int_with_timezone_for_DateTime(): void
    {
        $timestamp = mktime(12, 0, 0, 6, 15, 2023);
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTime::factory($timestamp, $tz);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * float の UNIX タイムスタンプから DateTime を生成できることを確認する。
     */
    public function test_factory_float_unix_timestamp_for_DateTime(): void
    {
        $timestamp = 1710936896.75;
        $result = DateTime::factory($timestamp);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame((int) $timestamp, $result->getTimestamp());
    }

    /**
     * float の UNIX タイムスタンプとタイムゾーンから DateTime を生成できることを確認する。
     */
    public function test_factory_float_with_timezone_for_DateTime(): void
    {
        $timestamp = 1710936896.5;
        $tz = new DateTimeZone('America/New_York');
        $result = DateTime::factory($timestamp, $tz);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame((int) $timestamp, $result->getTimestamp());
        $this->assertSame('America/New_York', $result->getTimezone()->getName());
    }

    /**
     * 数字文字列を UNIX タイムスタンプとして扱って DateTime を生成できることを確認する。
     */
    public function test_factory_digit_string_treated_as_timestamp_for_DateTime(): void
    {
        $timestamp = mktime(0, 0, 0, 1, 1, 2024);
        $result = DateTime::factory((string) $timestamp);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
    }

    /**
     * 数字文字列とタイムゾーンから DateTime を生成できることを確認する。
     */
    public function test_factory_digit_string_with_timezone_for_DateTime(): void
    {
        // 数字文字列はデフォルトタイムゾーンで date() 変換後、指定タイムゾーンで解釈される
        $timestamp = mktime(0, 0, 0, 7, 7, 2023);
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTime::factory((string) $timestamp, $tz);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame(date('Y-m-d H:i:s', $timestamp), $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTimeInterface から DateTime を生成できることを確認する。
     */
    public function test_factory_DateTimeInterface_for_DateTime(): void
    {
        $native = new NativeDateTimeImmutable('2024-05-15 10:20:30', new DateTimeZone('UTC'));
        $result = DateTime::factory($native);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('2024-05-15 10:20:30', $result->format('Y-m-d H:i:s'));
        $this->assertSame('UTC', $result->getTimezone()->getName());
    }

    /**
     * タイムゾーン指定がない場合、DateTimeInterface のタイムゾーンを引き継ぐことを確認する。
     */
    public function test_factory_DateTimeInterface_inherits_timezone_when_no_tz_given_for_DateTime(): void
    {
        $tz = new DateTimeZone('Asia/Tokyo');
        $native = new NativeDateTimeImmutable('2024-05-15 10:20:30', $tz);
        $result = DateTime::factory($native);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
        $this->assertSame('2024-05-15 10:20:30', $result->format('Y-m-d H:i:s'));
    }

    /**
     * DateTimeInterface のタイムゾーンを指定タイムゾーンで上書きできることを確認する。
     */
    public function test_factory_DateTimeInterface_with_timezone_override_for_DateTime(): void
    {
        $sourceTz = new DateTimeZone('UTC');
        $native = new NativeDateTimeImmutable('2024-05-15 10:20:30', $sourceTz);
        $targetTz = new DateTimeZone('Asia/Tokyo');
        $result = DateTime::factory($native, $targetTz);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * JapaneseDate の DateTime オブジェクトから DateTime を生成できることを確認する。
     */
    public function test_factory_JapaneseDate_DateTime_object_for_DateTime(): void
    {
        $source = new DateTime('2024-08-01 08:00:00', new DateTimeZone('Asia/Tokyo'));
        $result = DateTime::factory($source);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('2024-08-01 08:00:00', $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    // -----------------------------------------------------------------------
    // DateTimeImmutable::factory() のテスト
    // -----------------------------------------------------------------------

    /**
     * null から DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_null_returns_DateTimeImmutable(): void
    {
        $result = DateTimeImmutable::factory();
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
    }

    /**
     * null とタイムゾーンから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_null_with_timezone_returns_DateTimeImmutable(): void
    {
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTimeImmutable::factory(null, $tz);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * 日時文字列から DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_string_returns_correct_date_for_DateTimeImmutable(): void
    {
        $result = DateTimeImmutable::factory('2024-03-20 12:34:56');
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('2024-03-20 12:34:56', $result->format('Y-m-d H:i:s'));
    }

    /**
     * 日時文字列とタイムゾーンから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_string_with_timezone_for_DateTimeImmutable(): void
    {
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTimeImmutable::factory('2024-03-20 12:34:56', $tz);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('2024-03-20 12:34:56', $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * 整数の UNIX タイムスタンプから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_int_unix_timestamp_for_DateTimeImmutable(): void
    {
        $timestamp = mktime(12, 34, 56, 3, 20, 2024);
        $result = DateTimeImmutable::factory($timestamp);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
    }

    /**
     * 整数の UNIX タイムスタンプとタイムゾーンから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_int_with_timezone_for_DateTimeImmutable(): void
    {
        $timestamp = mktime(12, 0, 0, 6, 15, 2023);
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTimeImmutable::factory($timestamp, $tz);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * float の UNIX タイムスタンプから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_float_unix_timestamp_for_DateTimeImmutable(): void
    {
        $timestamp = 1710936896.75;
        $result = DateTimeImmutable::factory($timestamp);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame((int) $timestamp, $result->getTimestamp());
    }

    /**
     * float の UNIX タイムスタンプとタイムゾーンから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_float_with_timezone_for_DateTimeImmutable(): void
    {
        $timestamp = 1710936896.5;
        $tz = new DateTimeZone('America/New_York');
        $result = DateTimeImmutable::factory($timestamp, $tz);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame((int) $timestamp, $result->getTimestamp());
        $this->assertSame('America/New_York', $result->getTimezone()->getName());
    }

    /**
     * 数字文字列を UNIX タイムスタンプとして扱って DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_digit_string_treated_as_timestamp_for_DateTimeImmutable(): void
    {
        $timestamp = mktime(0, 0, 0, 1, 1, 2024);
        $result = DateTimeImmutable::factory((string) $timestamp);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
    }

    /**
     * 数字文字列とタイムゾーンから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_digit_string_with_timezone_for_DateTimeImmutable(): void
    {
        // 数字文字列はデフォルトタイムゾーンで date() 変換後、指定タイムゾーンで解釈される
        $timestamp = mktime(0, 0, 0, 7, 7, 2023);
        $tz = new DateTimeZone('Asia/Tokyo');
        $result = DateTimeImmutable::factory((string) $timestamp, $tz);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame(date('Y-m-d H:i:s', $timestamp), $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * DateTimeInterface から DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_DateTimeInterface_for_DateTimeImmutable(): void
    {
        $native = new NativeDateTimeImmutable('2024-05-15 10:20:30', new DateTimeZone('UTC'));
        $result = DateTimeImmutable::factory($native);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('2024-05-15 10:20:30', $result->format('Y-m-d H:i:s'));
        $this->assertSame('UTC', $result->getTimezone()->getName());
    }

    /**
     * タイムゾーン指定がない場合、DateTimeInterface のタイムゾーンを引き継ぐことを確認する。
     */
    public function test_factory_DateTimeInterface_inherits_timezone_when_no_tz_given_for_DateTimeImmutable(): void
    {
        $tz = new DateTimeZone('Asia/Tokyo');
        $native = new NativeDateTimeImmutable('2024-05-15 10:20:30', $tz);
        $result = DateTimeImmutable::factory($native);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
        $this->assertSame('2024-05-15 10:20:30', $result->format('Y-m-d H:i:s'));
    }

    /**
     * DateTimeInterface のタイムゾーンを指定タイムゾーンで上書きできることを確認する。
     */
    public function test_factory_DateTimeInterface_with_timezone_override_for_DateTimeImmutable(): void
    {
        $sourceTz = new DateTimeZone('UTC');
        $native = new NativeDateTimeImmutable('2024-05-15 10:20:30', $sourceTz);
        $targetTz = new DateTimeZone('Asia/Tokyo');
        $result = DateTimeImmutable::factory($native, $targetTz);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    /**
     * JapaneseDate の DateTimeImmutable オブジェクトから DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_JapaneseDate_DateTimeImmutable_object_for_DateTimeImmutable(): void
    {
        $source = new DateTimeImmutable('2024-08-01 08:00:00', new DateTimeZone('Asia/Tokyo'));
        $result = DateTimeImmutable::factory($source);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('2024-08-01 08:00:00', $result->format('Y-m-d H:i:s'));
        $this->assertSame('Asia/Tokyo', $result->getTimezone()->getName());
    }

    // -----------------------------------------------------------------------
    // DateTime と DateTimeImmutable を相互に入力した場合のテスト
    // -----------------------------------------------------------------------

    /**
     * DateTimeImmutable 入力から DateTime を生成できることを確認する。
     */
    public function test_factory_DateTime_from_DateTimeImmutable_input(): void
    {
        $source = new DateTimeImmutable('2024-11-03 09:00:00', new DateTimeZone('Asia/Tokyo'));
        $result = DateTime::factory($source);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame('2024-11-03 09:00:00', $result->format('Y-m-d H:i:s'));
    }

    /**
     * DateTime 入力から DateTimeImmutable を生成できることを確認する。
     */
    public function test_factory_DateTimeImmutable_from_DateTime_input(): void
    {
        $source = new DateTime('2024-11-03 09:00:00', new DateTimeZone('Asia/Tokyo'));
        $result = DateTimeImmutable::factory($source);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('2024-11-03 09:00:00', $result->format('Y-m-d H:i:s'));
    }

    // -----------------------------------------------------------------------
    // 境界値と特殊な入力のテスト
    // -----------------------------------------------------------------------

    /**
     * "20240101" のような YYYYMMDD 形式の数字文字列は ctype_digit() = true かつ
     * strtotime() が int を返す。これにより Factory 内の `$date_time = $check_time;`
     * ブランチ（strtotime 成功パス）がカバーされる。
     */
    public function test_factory_digit_string_parseable_by_strtotime_for_DateTime(): void
    {
        $digitStr = '20240615';
        $result = DateTime::factory($digitStr);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame(date('Y-m-d H:i:s', strtotime($digitStr)), $result->format('Y-m-d H:i:s'));
    }

    /**
     * DateTimeImmutable でも、strtotime() で解釈できる数字文字列を日付として扱うことを確認する。
     */
    public function test_factory_digit_string_parseable_by_strtotime_for_DateTimeImmutable(): void
    {
        $digitStr = '20240615';
        $result = DateTimeImmutable::factory($digitStr);
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame(date('Y-m-d H:i:s', strtotime($digitStr)), $result->format('Y-m-d H:i:s'));
    }

    /**
     * float の小数部分が UNIX タイムスタンプとして切り捨てられることを確認する。
     */
    public function test_factory_float_fractional_part_is_truncated(): void
    {
        // float の小数部分は UNIX タイムスタンプとして (int) にキャストされる。
        $base = mktime(0, 0, 0, 6, 1, 2024);
        $result = DateTime::factory((float) $base + 0.999);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($base, $result->getTimestamp());
    }

    /**
     * UNIX タイムスタンプ 0 を指定できることを確認する。
     */
    public function test_factory_zero_int_timestamp(): void
    {
        $result = DateTime::factory(0);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame(0, $result->getTimestamp());
    }

    /**
     * 1970年以前の負の UNIX タイムスタンプを指定できることを確認する。
     */
    public function test_factory_negative_int_timestamp(): void
    {
        // 1970年以前の UNIX タイムスタンプ。
        $timestamp = mktime(0, 0, 0, 1, 1, 1960);
        $result = DateTime::factory($timestamp);
        $this->assertInstanceOf(DateTime::class, $result);
        $this->assertSame($timestamp, $result->getTimestamp());
    }
}
