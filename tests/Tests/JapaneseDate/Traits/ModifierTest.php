<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Modifier Trait の日付移動処理を検証するテスト。
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
 * @since       2018/04/28 11:45 リリースから利用可能
 */

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Traits\Modifier;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Modifier Trait が提供する次の祝日・次の六曜への移動を検証する。
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
#[CoversTrait(Modifier::class)]
#[CoversMethod(Modifier::class, 'nextHoliday')]
#[CoversMethod(Modifier::class, 'nextSixWeek')]
class ModifierTest extends TestCase
{
    /**
     * nextSixWeek() の対象六曜ごとの期待日を返す。
     */
    public static function dataProviderNextSixWeek(): array
    {
        return [
            'equals' => [
                '2020-03-01',
                3,
                '2020-03-01',
            ],
            'lt' => [
                '2020-03-01',
                4,
                '2020-03-02',
            ],
            'gt_zero' => [
                '2020-03-01',
                0,
                '2020-03-04',
            ],
            'gt' => [
                '2020-03-01',
                1,
                '2020-03-05',
            ],
        ];
    }

    /**
     * DateTime では次の祝日へ自身を変更して返すことを確認する。
     *
     */
    public function test_nextHoliday(): void
    {
        $dateTime = new DateTime('2020-03-01');
        $res = $dateTime->nextHoliday();

        $this->assertInstanceOf(DateTime::class, $dateTime);

        $this->assertEquals('春分の日', $res->holiday_text);
        $this->assertEquals('春分の日', $dateTime->holiday_text);
        $this->assertSame($res, $dateTime);
    }

    /**
     * DateTimeImmutable では次の祝日を新しいインスタンスとして返すことを確認する。
     *
     */
    public function test_nextHoliday_immutable(): void
    {
        $dateTimeImmutable = new DateTimeImmutable('2020-03-01');
        $res = $dateTimeImmutable->nextHoliday();

        $this->assertInstanceOf(DateTimeImmutable::class, $dateTimeImmutable);

        $this->assertEquals('春分の日', $res->holiday_text);
        $this->assertEquals('', $dateTimeImmutable->holiday_text);
        $this->assertNotSame($res, $dateTimeImmutable);
    }

    /**
     * DateTime では指定した六曜の日へ自身を変更して返すことを確認する。
     *
     * @param string $start
     * @param int $six_weekday
     * @param string $expected
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[DataProvider('dataProviderNextSixWeek')]
    public function test_nextSixWeek(string $start, int $six_weekday, string $expected): void
    {
        $dateTime = new DateTime($start);
        $this->assertEquals($six_weekday, $dateTime->nextSixWeek($six_weekday)->six_weekday);
        $this->assertEquals($expected, $dateTime->format('Y-m-d'));
    }

    /**
     * DateTimeImmutable では指定した六曜の日を新しいインスタンスとして返すことを確認する。
     *
     * @param string $start
     * @param int $six_weekday
     * @param string $expected
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    #[DataProvider('dataProviderNextSixWeek')]
    public function test_nextSixWeek_immutable(string $start, int $six_weekday, string $expected): void
    {
        $dateTime = new DateTimeImmutable($start);
        $this->assertEquals($six_weekday, $dateTime->nextSixWeek($six_weekday)->six_weekday);
        $this->assertEquals($expected, $dateTime->nextSixWeek($six_weekday)->format('Y-m-d'));
        $this->assertEquals($start, $dateTime->format('Y-m-d'));
    }
}
