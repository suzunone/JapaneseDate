<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Ancient Trait のユニットテスト。
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

namespace Tests\JapaneseDate\Traits;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Maps\HistoricalEraMap;
use JapaneseDate\Traits\Ancient;
use JapaneseDate\Values\Era;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Ancient Trait の各メソッドを直接検証するテスト。
 *
 * protected メソッドは InvokeTrait 経由で呼び出します。
 * public メソッドおよびマジックプロパティは DateTime / DateTimeImmutable インスタンスを通じて検証します。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */
#[CoversTrait(Ancient::class)]
#[CoversMethod(Ancient::class, 'historicalEras')]
class AncientTraitTest extends TestCase
{
    use InvokeTrait;

    /**
     * DateTime::historicalEras() で通常時代の Era[] が返ること。
     */
    public function test_historicalEras_method_returns_era_array_with_datetime(): void
    {
        $dt = new DateTime('645-08-01T00:00:00+09:00');
        $result = $dt->historicalEras();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(Era::class, $result);
        $this->assertSame('大化', $result[0]->name);
    }

    // =========================================================================
    // メソッド呼び出しテスト
    // =========================================================================

    /**
     * DateTimeImmutable::historicalEras() で通常時代の Era[] が返ること。
     */
    public function test_historicalEras_method_returns_era_array_with_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('645-08-01T00:00:00+09:00');
        $result = $dt->historicalEras();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(Era::class, $result);
        $this->assertSame('大化', $result[0]->name);
    }

    /**
     * 大化以前の日付で historicalEras() が空配列を返すこと。
     */
    public function test_historicalEras_method_returns_empty_before_taika(): void
    {
        $dt = new DateTime('500-01-01T00:00:00+09:00');
        $result = $dt->historicalEras();

        $this->assertSame([], $result);
    }

    /**
     * 南北朝時代の日付で historicalEras() が北朝・南朝を含む複数 Era を返すこと。
     */
    public function test_historicalEras_method_returns_multiple_courts_in_nanbokucho(): void
    {
        $dt = new DateTime('1360-06-01T00:00:00+09:00');
        $result = $dt->historicalEras();

        $this->assertGreaterThanOrEqual(2, count($result));
        $courts = array_map(static fn (Era $e) => $e->court, $result);
        $this->assertContains(DateTime::COURT_NORTH, $courts);
        $this->assertContains(DateTime::COURT_SOUTH, $courts);
    }

    /**
     * DateTimeImmutable で南北朝時代の日付を指定すると複数 Era が返ること。
     */
    public function test_historicalEras_method_nanbokucho_with_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('1350-01-01T00:00:00+09:00');
        $result = $dt->historicalEras();

        $this->assertGreaterThanOrEqual(2, count($result));
        $courts = array_map(static fn (Era $e) => $e->court, $result);
        $this->assertContains(DateTime::COURT_NORTH, $courts);
        $this->assertContains(DateTime::COURT_SOUTH, $courts);
    }

    /**
     * $date->historicalEras プロパティ経由で Era[] が返ること（DateTime）。
     */
    public function test_historicalEras_property_access_with_datetime(): void
    {
        $dt = new DateTime('645-08-01T00:00:00+09:00');
        $result = $dt->historicalEras;

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(Era::class, $result);
        $this->assertSame('大化', $result[0]->name);
    }

    // =========================================================================
    // マジックプロパティ経由アクセスのテスト
    // =========================================================================

    /**
     * $date->historicalEras プロパティ経由で Era[] が返ること（DateTimeImmutable）。
     */
    public function test_historicalEras_property_access_with_DateTimeImmutable(): void
    {
        $dt = new DateTimeImmutable('645-08-01T00:00:00+09:00');
        $result = $dt->historicalEras;

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(Era::class, $result);
        $this->assertSame('大化', $result[0]->name);
    }

    /**
     * 大化以前の日付でプロパティ経由アクセスすると空配列が返ること。
     */
    public function test_historicalEras_property_access_returns_empty_before_taika(): void
    {
        $dt = new DateTime('500-01-01T00:00:00+09:00');
        $result = $dt->historicalEras;

        $this->assertSame([], $result);
    }

    /**
     * 南北朝時代にプロパティ経由で北朝・南朝の両方が返ること。
     */
    public function test_historicalEras_property_access_nanbokucho(): void
    {
        $dt = new DateTime('1360-06-01T00:00:00+09:00');
        $result = $dt->historicalEras;

        $this->assertGreaterThanOrEqual(2, count($result));
        $courts = array_map(static fn (Era $e) => $e->court, $result);
        $this->assertContains(DateTime::COURT_NORTH, $courts);
        $this->assertContains(DateTime::COURT_SOUTH, $courts);
    }

    /**
     * $date->historical_eras（スネークケース）で Era[] が返ること。
     */
    public function test_historical_eras_snake_case_property_access(): void
    {
        $dt = new DateTime('645-08-01T00:00:00+09:00');
        $result = $dt->historical_eras;

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(Era::class, $result);
        $this->assertSame('大化', $result[0]->name);
    }

    // =========================================================================
    // スネークケース プロパティ経由アクセスのテスト
    // =========================================================================

    /**
     * $date->historical_eras（スネークケース）で大化以前は空配列が返ること。
     */
    public function test_historical_eras_snake_case_property_returns_empty_before_taika(): void
    {
        $dt = new DateTime('500-01-01T00:00:00+09:00');
        $result = $dt->historical_eras;

        $this->assertSame([], $result);
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        HistoricalEraMap::clearCache();
    }
}
