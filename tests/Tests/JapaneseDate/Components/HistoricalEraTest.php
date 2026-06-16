<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * HistoricalEra コンポーネントのユニットテスト。
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

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\HistoricalEra;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Maps\HistoricalEraMap;
use JapaneseDate\Maps\Map;
use JapaneseDate\Values\Era;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * HistoricalEra コンポーネントのユニットテスト。
 *
 * 以下のケースを網羅します:
 * - 通常時代（元号が1つ）の正常取得
 * - 南北朝時代（北朝・南朝の並存）での複数元号取得
 * - 大化以前（元号なし）での空配列返却
 * - DateTime・DateTimeImmutable 双方での動作検証
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 * @covers \JapaneseDate\Components\HistoricalEra
 * @covers \JapaneseDate\Maps\Map
 * @covers \JapaneseDate\Maps\HistoricalEraMap
 */
class HistoricalEraTest extends TestCase
{
    use InvokeTrait;
    /**
     * 大化（645年）の日付を指定すると Era 1件が返ること。
     */
    public function test_findByDate_returns_single_era_for_normal_period(): void
    {
        $dt = new DateTime('645-08-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Era::class, $result[0]);
        $this->assertSame('大化', $result[0]->name);
        $this->assertSame('タイカ', $result[0]->kana);
        $this->assertSame(DateTime::COURT_MAIN, $result[0]->court);
    }
    // =========================================================================
    // 通常時代のテスト
    // =========================================================================
    /**
     * DateTimeImmutable でも同様に動作すること。
     */
    public function test_findByDate_works_with_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('645-08-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Era::class, $result[0]);
        $this->assertSame('大化', $result[0]->name);
    }
    /**
     * 令和（2020年）の日付を指定すると Era 1件が返ること。
     */
    public function test_findByDate_returns_reiwa_era(): void
    {
        $dt = new DateTime('2020-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertCount(1, $result);
        $this->assertSame('令和', $result[0]->name);
        $this->assertSame('レイワ', $result[0]->kana);
        $this->assertSame(DateTime::COURT_MAIN, $result[0]->court);
    }
    /**
     * 2099年12月31日以降も令和の元号情報が欠落しないこと。
     */
    public function test_findByDate_returns_reiwa_after_temporary_end_boundary(): void
    {
        $dt = new DateTime('2100-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertCount(1, $result);
        $this->assertSame('令和', $result[0]->name);
    }
    /**
     * 南北朝時代（1350年）の日付を指定すると北朝・南朝の2件が返ること。
     */
    public function test_findByDate_returns_both_courts_during_nanbokucho(): void
    {
        $dt = new DateTime('1350-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertGreaterThanOrEqual(2, count($result));

        $courts = array_map(static fn (Era $e) => $e->court, $result);
        $this->assertContains(DateTime::COURT_NORTH, $courts, '北朝の元号が含まれること');
        $this->assertContains(DateTime::COURT_SOUTH, $courts, '南朝の元号が含まれること');
    }
    // =========================================================================
    // 南北朝時代のテスト
    // =========================================================================
    /**
     * 南北朝時代に返される各 Era が正しい識別子を持つこと。
     */
    public function test_findByDate_nanbokucho_era_court_identifiers_are_correct(): void
    {
        $dt = new DateTime('1360-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        foreach ($result as $era) {
            $this->assertContains(
                $era->court,
                [DateTime::COURT_MAIN, DateTime::COURT_NORTH, DateTime::COURT_SOUTH],
                '不正な court 識別子: ' . $era->court
            );
        }
    }
    /**
     * DateTimeImmutable で南北朝時代を指定しても複数 Era が返ること。
     */
    public function test_findByDate_nanbokucho_with_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('1350-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertGreaterThanOrEqual(2, count($result));
        $courts = array_map(static fn (Era $e) => $e->court, $result);
        $this->assertContains(DateTime::COURT_NORTH, $courts);
        $this->assertContains(DateTime::COURT_SOUTH, $courts);
    }
    /**
     * 大化以前（600年）を指定すると空配列が返ること。
     */
    public function test_findByDate_returns_empty_array_before_taika(): void
    {
        $dt = new DateTime('600-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertSame([], $result);
    }
    // =========================================================================
    // 元号が存在しない期間のテスト
    // =========================================================================
    /**
     * DateTimeImmutable で大化以前を指定しても空配列が返ること。
     */
    public function test_findByDate_returns_empty_array_before_taika_with_immutable(): void
    {
        $dt = new DateTimeImmutable('600-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertSame([], $result);
    }
    /**
     * 白雉と大宝の間の空白期間（655年〜701年）を指定すると空配列が返ること。
     */
    public function test_findByDate_returns_empty_array_during_gap_period(): void
    {
        $dt = new DateTime('660-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertSame([], $result);
    }
    /**
     * DateTime を渡した場合、Era の startDate / endDate も DateTime インスタンスであること。
     */
    public function test_era_dates_are_datetime_when_datetime_passed(): void
    {
        // 大宝元号（701-05-03〜704-06-16）の期間内
        $dt = new DateTime('702-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertNotEmpty($result);
        $startDate = $result[0]->startDate;
        $this->assertInstanceOf(DateTime::class, $startDate);
    }
    // =========================================================================
    // Era バリューオブジェクトの型検証
    // =========================================================================
    /**
     * DateTimeImmutable を渡した場合、Era の startDate / endDate も DateTimeImmutable であること。
     */
    public function test_era_dates_are_DateTimeImmutable_when_immutable_passed(): void
    {
        // 大宝元号（701-05-03〜704-06-16）の期間内
        $dt = new DateTimeImmutable('702-01-01T00:00:00+09:00');
        $component = new HistoricalEra();
        $result = $component->findByDate($dt);

        $this->assertNotEmpty($result);
        $startDate = $result[0]->startDate;
        $this->assertInstanceOf(DateTimeImmutable::class, $startDate);
    }
    /**
     * @return void
     */
    protected function tearDown(): void
    {
        HistoricalEraMap::clearCache();
    }
}
