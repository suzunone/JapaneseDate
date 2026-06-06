<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * SeventyTwoKouCalculator コンポーネントのテスト
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

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\SeventyTwoKouCalculator;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * SeventyTwoKouCalculator コンポーネントのユニットテスト。
 *
 * コンポーネントを単独でテストし、すべての public / private メソッドの
 * 命令カバレッジ（C0）100% を達成することを目標とします。
 * private メソッドのテストには InvokeTrait を使用します。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 * @covers \JapaneseDate\Components\SeventyTwoKouCalculator
 */
class SeventyTwoKouCalculatorTest extends TestCase
{
    use InvokeTrait;
    // =========================================================================
    // ヘルパー
    // =========================================================================
    /**
     * @return array<string, array{0: string, 1: int}>
     */
    public static function provideKouNumbers(): array
    {
        return [
            '立春初候' => ['2025-02-04', 1],
            '立春次候' => ['2025-02-09', 2],
            '立春末候' => ['2025-02-14', 3],
            '夏至初候' => ['2025-06-21', 28],
            '冬至初候' => ['2025-12-22', 64],
            '小寒初候' => ['2026-01-06', 67],
            '大寒初候' => ['2026-01-20', 70],
            '大寒末候' => ['2026-01-30', 72],
        ];
    }
    // =========================================================================
    // factory() — シングルトン分岐のテスト
    // =========================================================================
    /**
     * @return array<string, array{0: int, 1: string, 2: string, 3: string}>
     */
    public static function provideKouAttributes(): array
    {
        return [
            'kou=1' => [1, '東風凍を解く', 'はるかぜ こおりをとく', '初候'],
            'kou=2' => [2, 'うぐいす鳴く', 'うぐいす なく', '次候'],
            'kou=3' => [3, '魚氷を上る', 'うお こおりをいずる', '末候'],
            'kou=28' => [28, '乃東枯る', 'なつかれくさ かるる', '初候'],
            'kou=64' => [64, '乃東生ず', 'なつかれくさ しょうず', '初候'],
            'kou=72' => [72, '鶏始めてとやにつく', 'にわとり はじめてとやにつく', '末候'],
        ];
    }
    /**
     * factory() を初回呼び出すと新しいインスタンスが生成されることを確認する。
     * （static::$instance === null の分岐）
     */
    public function test_factory_creates_instance_when_null(): void
    {
        $this->resetSingleton();

        $calc = SeventyTwoKouCalculator::factory();

        $this->assertInstanceOf(SeventyTwoKouCalculator::class, $calc);

        $this->resetSingleton();
    }
    // =========================================================================
    // getKouNumber() — public
    // =========================================================================
    /**
     * static::$instance を null にリセットして factory() の初期化パスを通れるようにする。
     * InvokeTrait の invokeSetProperty を使用してクラス名を渡す。
     * ReflectionProperty::setValue は static プロパティに対してオブジェクト引数を無視するため、
     * インスタンス経由での設定でも正しく static 値がリセットされる。
     * テスト後も必ず null に戻して他テストへの副作用を防ぐ。
     */
    private function resetSingleton(): void
    {
        $this->invokeSetProperty(SeventyTwoKouCalculator::class, 'instance', null);
    }
    /**
     * factory() を2回呼び出すと同一インスタンスが返ることを確認する。
     * （static::$instance !== null の分岐）
     */
    public function test_factory_returns_same_instance_on_second_call(): void
    {
        $this->resetSingleton();

        $first = SeventyTwoKouCalculator::factory();
        $second = SeventyTwoKouCalculator::factory();

        $this->assertSame($first, $second);

        $this->resetSingleton();
    }
    /**
     * getKouNumber() が DateTime に対して正しい候番号を返すことを確認する。
     * @dataProvider provideKouNumbers
     */
    public function test_getKouNumber_with_DateTime(string $dateStr, int $expectedKou): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTime($dateStr);
        $this->assertSame($expectedKou, $calc->getKouNumber($dt));
    }
    // =========================================================================
    // getKouText() / getKouReading() / getKouType() — public
    // =========================================================================
    /**
     * getKouNumber() が DateTimeImmutable に対しても正しい候番号を返すことを確認する。
     * @dataProvider provideKouNumbers
     */
    public function test_getKouNumber_with_DateTimeImmutable(string $dateStr, int $expectedKou): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable($dateStr);
        $this->assertSame($expectedKou, $calc->getKouNumber($dt));
    }
    /**
     * getKouText() が正しい名称を返すことを確認する。
     * @dataProvider provideKouAttributes
     */
    public function test_getKouText(int $kouNumber, string $expectedText, string $_, string $__): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $this->assertSame($expectedText, $calc->getKouText($kouNumber));
    }
    /**
     * getKouReading() が正しい読みを返すことを確認する。
     * @dataProvider provideKouAttributes
     */
    public function test_getKouReading(int $kouNumber, string $_, string $expectedReading, string $__): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $this->assertSame($expectedReading, $calc->getKouReading($kouNumber));
    }
    /**
     * getKouType() が正しい候種別を返すことを確認する。
     * @dataProvider provideKouAttributes
     */
    public function test_getKouType(int $kouNumber, string $_, string $__, string $expectedType): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $this->assertSame($expectedType, $calc->getKouType($kouNumber));
    }
    /**
     * getKouText() / getKouReading() に無効な候番号（0 や 73）を渡すと空文字列が返ることを確認する。
     */
    public function test_getKouText_and_reading_for_invalid_kou_returns_empty(): void
    {
        $calc = SeventyTwoKouCalculator::factory();

        $this->assertSame('', $calc->getKouText(0));
        $this->assertSame('', $calc->getKouText(73));
        $this->assertSame('', $calc->getKouReading(0));
        $this->assertSame('', $calc->getKouReading(73));
    }
    // =========================================================================
    // getNextKouStartTimestamp() — public: kouType < 2 と kouType == 2 の両分岐
    // =========================================================================
    /**
     * 初候（kouType=0）から次候開始タイムスタンプを取得できることを確認する。
     */
    public function test_getNextKouStartTimestamp_from_shokou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-04'); // 立春初候

        $ts = $calc->getNextKouStartTimestamp($dt);
        $date = date('Y-m-d', $ts);

        $this->assertSame('2025-02-08', $date, '次候開始日は2月8日');
    }
    /**
     * 次候（kouType=1）から末候開始タイムスタンプを取得できることを確認する。
     */
    public function test_getNextKouStartTimestamp_from_jikou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-09'); // 立春次候

        $ts = $calc->getNextKouStartTimestamp($dt);
        $kou = $calc->getKouNumber(new DateTimeImmutable(date('Y-m-d', $ts)));

        $this->assertSame(3, $kou, '末候に移動する');
    }
    /**
     * 末候（kouType=2）から次節気の初候開始タイムスタンプを取得できることを確認する。
     */
    public function test_getNextKouStartTimestamp_from_makkou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-14'); // 立春末候

        $ts = $calc->getNextKouStartTimestamp($dt);
        $kou = $calc->getKouNumber(new DateTimeImmutable(date('Y-m-d', $ts)));

        $this->assertSame(4, $kou, '次節気（雨水）の初候へ移動する');
    }
    // =========================================================================
    // getPreviousKouStartTimestamp() — public: kouType > 0 と kouType == 0 の両分岐
    // =========================================================================
    /**
     * 次候（kouType=1）から初候開始タイムスタンプを取得できることを確認する。
     */
    public function test_getPreviousKouStartTimestamp_from_jikou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-09'); // 立春次候

        $ts = $calc->getPreviousKouStartTimestamp($dt);
        $date = date('Y-m-d', $ts);

        $this->assertSame('2025-02-03', $date, '前候（初候）開始日は2月3日');
    }
    /**
     * 初候（kouType=0）から前節気の末候開始タイムスタンプを取得できることを確認する。
     */
    public function test_getPreviousKouStartTimestamp_from_shokou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-04'); // 立春初候

        $ts = $calc->getPreviousKouStartTimestamp($dt);
        $kou = $calc->getKouNumber(new DateTimeImmutable(date('Y-m-d', $ts)));

        $this->assertSame(72, $kou, '前節気（大寒）の末候へ移動する');
    }
    // =========================================================================
    // findKouIndexAndType() — public: 3つの分岐（初候・次候・末候）
    // =========================================================================
    /**
     * 節気開始日（初候）の findKouIndexAndType が kouType=0 を返すことを確認する。
     */
    public function test_findKouIndexAndType_returns_shokou_on_term_start(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-04'); // 立春初候

        [$kouIndex, $kouType] = $calc->findKouIndexAndType($dt);

        $this->assertSame(0, $kouIndex, '立春は kouIndex=0');
        $this->assertSame(0, $kouType, '節気初日は初候');
    }
    /**
     * 次候期間内の日付で findKouIndexAndType が kouType=1 を返すことを確認する。
     */
    public function test_findKouIndexAndType_returns_jikou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-09'); // 立春次候

        [, $kouType] = $calc->findKouIndexAndType($dt);

        $this->assertSame(1, $kouType, '次候期間内は kouType=1');
    }
    /**
     * 末候期間内の日付で findKouIndexAndType が kouType=2 を返すことを確認する。
     */
    public function test_findKouIndexAndType_returns_makkou(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-14'); // 立春末候

        [, $kouType] = $calc->findKouIndexAndType($dt);

        $this->assertSame(2, $kouType, '末候期間内は kouType=2');
    }
    // =========================================================================
    // private メソッドのテスト（InvokeTrait 使用）
    // =========================================================================
    /**
     * normalizeDayTs() が指定年月日を 0:00:00 の Unix タイムスタンプに変換することを確認する。
     */
    public function test_normalizeDayTs(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $ts = $this->invokeExecuteMethod($calc, 'normalizeDayTs', [2025, 2, 4]);

        $this->assertSame('2025-02-04', date('Y-m-d', $ts));
        $this->assertSame('00:00:00', date('H:i:s', $ts));
    }
    /**
     * calcKouBoundaries() が日単位の境界タイムスタンプを正しく計算することを確認する。
     * 15日間の期間の場合: 初候=day0, 次候=day5, 末候=day10。
     */
    public function test_calcKouBoundaries_divides_period_into_thirds(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $startTs = mktime(0, 0, 0, 2, 4, 2025);
        $endTs = mktime(0, 0, 0, 2, 19, 2025); // 15日後

        [$b0, $b1, $b2] = $this->invokeExecuteMethod($calc, 'calcKouBoundaries', [$startTs, $endTs]);

        $this->assertSame($startTs, $b0, '初候は節気開始日');
        $this->assertSame('2025-02-09', date('Y-m-d', $b1), '次候は5日後');
        $this->assertSame('2025-02-14', date('Y-m-d', $b2), '末候は10日後');
    }
    /**
     * collectSortedTerms() が72エントリ×3年分(216)のタイムスタンプ昇順リストを返すことを確認する。
     */
    public function test_collectSortedTerms_returns_sorted_list(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $terms = $this->invokeExecuteMethod($calc, 'collectSortedTerms', [2025]);

        // 3年分 × 24節気 = 72エントリ
        $this->assertCount(72, $terms);

        // タイムスタンプが昇順であることを確認
        $prev = PHP_INT_MIN;
        foreach ($terms as $term) {
            $this->assertGreaterThanOrEqual($prev, $term['ts'], '昇順に並んでいるはず');
            $this->assertArrayHasKey('kou_index', $term);
            $this->assertGreaterThanOrEqual(0, $term['kou_index']);
            $this->assertLessThanOrEqual(23, $term['kou_index']);
            $prev = $term['ts'];
        }
    }
    /**
     * getSolarTermTimestamp() が同じ引数で2回目以降はキャッシュを返すことを確認する。
     */
    public function test_getSolarTermTimestamp_caches_result(): void
    {
        $calc = SeventyTwoKouCalculator::factory();

        $ts1 = $this->invokeExecuteMethod($calc, 'getSolarTermTimestamp', [DateTime::SOLAR_TERM_RISSYUN, 2025]);
        $ts2 = $this->invokeExecuteMethod($calc, 'getSolarTermTimestamp', [DateTime::SOLAR_TERM_RISSYUN, 2025]);

        $this->assertSame($ts1, $ts2, '2回目はキャッシュから返る');
        $this->assertSame('2025-02-03', date('Y-m-d', $ts1), '立春2025は2月3日');
    }
    /**
     * fetchSolarTermDate() が SimpleSolarTerm で正常に節気日付を取得できることを確認する。
     * （SimpleSolarTerm 成功パス）
     */
    public function test_fetchSolarTermDate_uses_SimpleSolarTerm_for_supported_year(): void
    {
        $calc = SeventyTwoKouCalculator::factory();

        $stDate = $this->invokeExecuteMethod($calc, 'fetchSolarTermDate', [DateTime::SOLAR_TERM_RISSYUN, 2025]);

        $this->assertSame(2025, $stDate->year);
        $this->assertSame(2, $stDate->month);
        $this->assertSame(3, $stDate->day);
    }
    /**
     * fetchSolarTermDate() が SimpleSolarTerm 対象外の年（1500年）で
     * SolarTerm（天文計算）へフォールバックすることを確認する。
     * （catchブランチのカバレッジ）
     */
    public function test_fetchSolarTermDate_falls_back_to_SolarTerm_for_unsupported_year(): void
    {
        $calc = SeventyTwoKouCalculator::factory();

        // SimpleSolarTerm は 1600〜2399 年のみ対応。1500年は SolarTermException を投げる。
        $stDate = $this->invokeExecuteMethod($calc, 'fetchSolarTermDate', [DateTime::SOLAR_TERM_RISSYUN, 1500]);

        $this->assertSame(1500, $stDate->year, 'SolarTerm フォールバックで1500年の立春が取得できる');
        $this->assertSame(2, $stDate->month, '月が正しい');
        $this->assertGreaterThanOrEqual(1, $stDate->day, '日が正の値');
    }
    /**
     * VSOP87 モードでは SimpleSolarTerm を使わず SolarTerm 経由で節気日付を取得することを確認する。
     */
    public function test_fetchSolarTermDate_uses_SolarTerm_when_vsop87_enabled(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            $stDate = $this->invokeExecuteMethod(
                SeventyTwoKouCalculator::factory(),
                'fetchSolarTermDate',
                [DateTime::SOLAR_TERM_RISSYUN, 2025]
            );

            $this->assertSame(2025, $stDate->year);
            $this->assertSame(DateTime::SOLAR_TERM_RISSYUN, $stDate->solar_term);
            $this->assertSame(2, $stDate->month);
            $this->assertSame(3, $stDate->day);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }

    /**
     * findPreviousSolarTermInfo() が前の節気の情報を正しく返すことを確認する。
     * 立春（kouIndex=0）の前は大寒（kouIndex=23）。
     */
    public function test_findPreviousSolarTermInfo_returns_correct_previous_term(): void
    {
        $calc = SeventyTwoKouCalculator::factory();
        $dt = new DateTimeImmutable('2025-02-04'); // 立春初候

        [$prevKouIndex, $prevTermTs, $prevNextTermTs] =
            $this->invokeExecuteMethod($calc, 'findPreviousSolarTermInfo', [$dt, 0]);

        $this->assertSame(23, $prevKouIndex, '立春の前は大寒（kouIndex=23）');
        $this->assertSame('2025-01', date('Y-m', $prevTermTs), '大寒は2025年1月');
        $this->assertGreaterThan($prevTermTs, $prevNextTermTs, '前次タイムスタンプは開始より大きい');
    }
}
