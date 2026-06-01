<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Era バリューオブジェクトのユニットテスト。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace Tests\JapaneseDate\Values;

use ErrorException;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Values\Era;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Era バリューオブジェクトの全メソッド・分岐を検証するテスト。
 *
 * 以下を網羅します:
 * - コンストラクタ: DateTime を渡した場合の startDate / endDate 型
 * - コンストラクタ: DateTimeImmutable を渡した場合の startDate / endDate 型
 * - __get: startDate / endDate をクローンで返すこと
 * - __set: ErrorException をスローすること
 * - __isset: 存在するプロパティで true、存在しないプロパティで false を返すこと
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 * @covers \JapaneseDate\Values\Era
 */
class EraTest extends TestCase
{
    // =========================================================================
    // コンストラクタ
    // =========================================================================
    /**
     * DateTime を渡したとき、公開プロパティが正しく設定されること。
     */
    public function test_construct_sets_public_properties_with_datetime(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->assertSame('大化', $era->name);
        $this->assertSame('タイカ', $era->kana);
        $this->assertSame(DateTime::COURT_MAIN, $era->court);
    }
    /**
     * DateTime を渡したとき、startDate / endDate が DateTime インスタンスであること。
     * @noinspection Annotator
     */
    public function test_construct_creates_datetime_dates_when_datetime_passed(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->assertInstanceOf(DateTime::class, $era->startDate);
        $this->assertInstanceOf(DateTime::class, $era->endDate);
    }
    /**
     * DateTimeImmutable を渡したとき、startDate / endDate が DateTimeImmutable インスタンスであること。
     */
    public function test_construct_creates_datetimeimmutable_dates_when_immutable_passed(): void
    {
        $current = new DateTimeImmutable('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->assertInstanceOf(DateTimeImmutable::class, $era->startDate);
        $this->assertInstanceOf(DateTimeImmutable::class, $era->endDate);
    }
    /**
     * startDate / endDate が指定した日付文字列に対応する値を持つこと。
     */
    public function test_construct_sets_correct_start_and_end_dates(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->assertSame('0645-07-29', $era->startDate->format('Y-m-d'));
        $this->assertSame('0650-03-22', $era->endDate->format('Y-m-d'));
    }
    // =========================================================================
    // __get
    // =========================================================================
    /**
     * __get で取得した startDate はオリジナルとは別のインスタンス（クローン）であること。
     */
    public function test_get_returns_clone_of_startDate(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $first = $era->startDate;
        $second = $era->startDate;

        $this->assertNotSame($first, $second);
        $this->assertSame($first->format('Y-m-d'), $second->format('Y-m-d'));
    }
    /**
     * __get で取得した endDate はオリジナルとは別のインスタンス（クローン）であること。
     */
    public function test_get_returns_clone_of_endDate(): void
    {
        $current = new DateTimeImmutable('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $first = $era->endDate;
        $second = $era->endDate;

        $this->assertNotSame($first, $second);
        $this->assertSame($first->format('Y-m-d'), $second->format('Y-m-d'));
    }
    // =========================================================================
    // __set
    // =========================================================================
    /**
     * readonly プロパティへの書き込みは ErrorException をスローすること。
     */
    public function test_set_throws_error_exception(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->expectException(ErrorException::class);
        /** @noinspection PhpReadonlyPropertyWrittenOutsideDeclarationScopeInspection */
        $era->startDate = new DateTime('2025-01-01');
    }
    // =========================================================================
    // __isset
    // =========================================================================
    /**
     * 存在するプロパティ（startDate）に isset すると true が返ること。
     */
    public function test_isset_returns_true_for_existing_property(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->assertTrue(isset($era->startDate));
        $this->assertTrue(isset($era->endDate));
    }
    /**
     * 存在しないプロパティに isset すると false が返ること。
     */
    public function test_isset_returns_false_for_nonexistent_property(): void
    {
        $current = new DateTime('645-08-01T00:00:00+09:00');
        $era = new Era(
            '大化',
            'タイカ',
            DateTime::COURT_MAIN,
            '645-07-29T00:00:00+09:00',
            '650-03-22T00:00:00+09:00',
            $current
        );

        $this->assertFalse(isset($era->nonExistentProperty));
    }
}
