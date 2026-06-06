<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * MiscSeasonalNode コンポーネントのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * MiscSeasonalNode コンポーネントのテスト
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 * @covers \JapaneseDate\Components\MiscSeasonalNode
 */
class MiscSeasonalNodeTest extends TestCase
{
    use InvokeTrait;
    // =========================================================================
    // ファクトリー・基本テスト
    // =========================================================================
    public static function viewMiscSeasonalNodeProvider(): array
    {
        return [
            '雑節なし'       => [0, ''],
            '節分'           => [1, '節分'],
            '彼岸'           => [2, '彼岸'],
            '社日'           => [3, '社日'],
            '八十八夜'       => [4, '八十八夜'],
            '入梅'           => [5, '入梅'],
            '半夏生'         => [6, '半夏生'],
            '土用'           => [7, '土用'],
            '二百十日'       => [8, '二百十日'],
            '二百二十日'     => [9, '二百二十日'],
            '存在しないキー' => [999, ''],
        ];
    }
    /**
     * factory() がシングルトンを返すことを確認する。
     */
    public function test_factory_returnsSameInstance(): void
    {
        $a = MiscSeasonalNode::factory();
        $b = MiscSeasonalNode::factory();
        $this->assertSame($a, $b);
        $this->assertInstanceOf(MiscSeasonalNode::class, $a);
    }
    // =========================================================================
    // viewMiscSeasonalNode
    // =========================================================================
    public function test_miscSeasonalNodeNamesConstant(): void
    {
        $names = MiscSeasonalNode::MISC_SEASONAL_NODE_NAMES;
        $this->assertSame('', $names[0]);
        $this->assertSame('節分', $names[1]);
        $this->assertSame('彼岸', $names[2]);
        $this->assertSame('社日', $names[3]);
        $this->assertSame('八十八夜', $names[4]);
        $this->assertSame('入梅', $names[5]);
        $this->assertSame('半夏生', $names[6]);
        $this->assertSame('土用', $names[7]);
        $this->assertSame('二百十日', $names[8]);
        $this->assertSame('二百二十日', $names[9]);
    }
    /**
     * @dataProvider viewMiscSeasonalNodeProvider
     * @param int $key
     * @param string $expected
     */
    public function test_viewMiscSeasonalNode($key, $expected): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertSame($expected, $node->viewMiscSeasonalNode($key));
    }
    // =========================================================================
    // 節分テスト (2021-2026) - 出典: 国立天文台 https://eco.mtk.nao.ac.jp/cgi-bin/koyomi/cande/phenomena_s.cgi
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function setsubunProvider(): array
    {
        // 節分 = 立春の前日
        // 2021: 立春2/3 → 節分2/2  (124年ぶりの2月2日)
        // 2022-2024: 立春2/4 → 節分2/3
        // 2025: 立春2/3 → 節分2/2
        // 2026: 立春2/4 → 節分2/3
        return [
            '2021年節分' => [2021, 2, 2],
            '2022年節分' => [2022, 2, 3],
            '2023年節分' => [2023, 2, 3],
            '2024年節分' => [2024, 2, 3],
            '2025年節分' => [2025, 2, 2],
            '2026年節分' => [2026, 2, 3],
        ];
    }
    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @dataProvider setsubunProvider
     */
    public function test_isSetsubun($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isSetsubun($date), "{$year}年{$month}月{$day}日は節分");
    }
    /**
     * @dataProvider setsubunProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_setsubun($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isSetsubun_nonSetsubun(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isSetsubun(DateTime::parse('2026-02-04')));
        $this->assertFalse($node->isSetsubun(DateTime::parse('2026-02-02')));
        $this->assertFalse($node->isSetsubun(DateTime::parse('2026-06-01')));
    }
    // =========================================================================
    // 彼岸 春中日テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function higanSpringCenterProvider(): array
    {
        // 春彼岸中日 = 春分の日
        return [
            '2021年春彼岸中日' => [2021, 3, 20],
            '2022年春彼岸中日' => [2022, 3, 21],
            '2023年春彼岸中日' => [2023, 3, 21],
            '2024年春彼岸中日' => [2024, 3, 20],
            '2025年春彼岸中日' => [2025, 3, 20],
            '2026年春彼岸中日' => [2026, 3, 20],
        ];
    }
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function higanAutumnCenterProvider(): array
    {
        // 秋彼岸中日 = 秋分の日
        return [
            '2021年秋彼岸中日' => [2021, 9, 23],
            '2022年秋彼岸中日' => [2022, 9, 23],
            '2023年秋彼岸中日' => [2023, 9, 23],
            '2024年秋彼岸中日' => [2024, 9, 22],
            '2025年秋彼岸中日' => [2025, 9, 23],
            '2026年秋彼岸中日' => [2026, 9, 23],
        ];
    }
    /**
     * @dataProvider higanSpringCenterProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isHigan_springCenter($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isHigan($date), "{$year}年{$month}月{$day}日は春彼岸中日");
    }
    /**
     * @dataProvider higanAutumnCenterProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isHigan_autumnCenter($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isHigan($date), "{$year}年{$month}月{$day}日は秋彼岸中日");
    }
    public function test_isHigan_outside(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isHigan(DateTime::parse('2026-04-01')));
        $this->assertFalse($node->isHigan(DateTime::parse('2026-06-01')));
    }
    public function test_isHigan_springStart(): void
    {
        $node = MiscSeasonalNode::factory();
        // 2026年春分(3/20)の3日前も彼岸
        $this->assertTrue($node->isHigan(DateTime::parse('2026-03-17')));
    }
    public function test_getMiscSeasonalNodeKey_higan(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HIGAN, $node->getMiscSeasonalNodeKey(DateTime::parse('2026-03-17')));
    }
    // =========================================================================
    // 社日テスト
    // =========================================================================
    public function test_isShanichi_spring(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 14; $d <= 27; $d++) {
            $date = DateTime::parse("2026-03-{$d}");
            if ($node->isShanichi($date)) {
                $found = true;
                $this->assertLessThanOrEqual(5, abs($d - 20), "社日は春分から5日以内: 3月{$d}日");
                break;
            }
        }
        $this->assertTrue($found, '2026年の春社日が3月14日〜27日の範囲で見つかること');
    }
    public function test_isShanichi_autumn(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 18; $d <= 28; $d++) {
            $date = DateTime::parse("2026-09-{$d}");
            if ($node->isShanichi($date)) {
                $found = true;
                $this->assertLessThanOrEqual(5, abs($d - 23), "社日は秋分から5日以内: 9月{$d}日");
                break;
            }
        }
        $this->assertTrue($found, '2026年の秋社日が9月18日〜28日の範囲で見つかること');
    }
    public function test_isShanichi_nonTsuchinoe(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isShanichi(DateTime::parse('2026-03-20')));
    }
    public function test_getMiscSeasonalNodeKey_shanichi(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 14; $d <= 27; $d++) {
            $date = DateTime::parse("2026-03-{$d}");
            if ($node->getMiscSeasonalNodeKey($date) === DateTime::MISC_SEASONAL_NODE_SHANICHI) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, '2026年3月の春社日が getMiscSeasonalNodeKey で検出されること');
    }
    // =========================================================================
    // 八十八夜テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function hachijuhachiyaProvider(): array
    {
        // 八十八夜 = 立春から数えて88日目（立春+87日）
        // 2021: 立春2/3 → 5/1
        // 2022: 立春2/4 → 5/2
        // 2023: 立春2/4 → 5/2
        // 2024: 立春2/4 → 5/1
        // 2025: 立春2/3 → 5/1
        // 2026: 立春2/4 → 5/2
        return [
            '2021年八十八夜' => [2021, 5, 1],
            '2022年八十八夜' => [2022, 5, 2],
            '2023年八十八夜' => [2023, 5, 2],
            '2024年八十八夜' => [2024, 5, 1],
            '2025年八十八夜' => [2025, 5, 1],
            '2026年八十八夜' => [2026, 5, 2],
        ];
    }
    /**
     * @dataProvider hachijuhachiyaProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isHachijuhachiya($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isHachijuhachiya($date), "{$year}年{$month}月{$day}日は八十八夜");
    }
    /**
     * @dataProvider hachijuhachiyaProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_hachijuhachiya($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HACHIJUHACHIYA, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isHachijuhachiya_adjacent(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isHachijuhachiya(DateTime::parse('2026-05-01')));
        $this->assertFalse($node->isHachijuhachiya(DateTime::parse('2026-05-03')));
    }
    // =========================================================================
    // 入梅テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function nyubaiProvider(): array
    {
        // 入梅 = 太陽黄経80° (通常6月10〜12日頃)
        return [
            '2021年入梅' => [2021, 6, 11],
            '2022年入梅' => [2022, 6, 11],
            '2023年入梅' => [2023, 6, 11],
            '2024年入梅' => [2024, 6, 10],
            '2025年入梅' => [2025, 6, 11],
            '2026年入梅' => [2026, 6, 11],
        ];
    }
    /**
     * @dataProvider nyubaiProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isNyubai($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isNyubai($date), "{$year}年{$month}月{$day}日は入梅");
    }
    /**
     * @dataProvider nyubaiProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_nyubai($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NYUBAI, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isNyubai_nonNyubai(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isNyubai(DateTime::parse('2026-08-01')));
    }
    // =========================================================================
    // 半夏生テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function hangeshoProvider(): array
    {
        // 半夏生 = 太陽黄経100° (通常7月1〜3日頃)
        return [
            '2021年半夏生' => [2021, 7, 2],
            '2022年半夏生' => [2022, 7, 2],
            '2023年半夏生' => [2023, 7, 2],
            '2024年半夏生' => [2024, 7, 1],
            '2025年半夏生' => [2025, 7, 1],
            '2026年半夏生' => [2026, 7, 2],
        ];
    }
    /**
     * @dataProvider hangeshoProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isHangesho($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isHangesho($date), "{$year}年{$month}月{$day}日は半夏生");
    }
    /**
     * @dataProvider hangeshoProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_hangesho($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HANGESHO, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isHangesho_nonHangesho(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isHangesho(DateTime::parse('2026-08-01')));
    }
    // =========================================================================
    // 土用（夏）テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function doyoSummerProvider(): array
    {
        // 夏土用入り = 太陽黄経117°に達する日
        // 出典: 国立天文台 https://eco.mtk.nao.ac.jp/cgi-bin/koyomi/cande/phenomena_s.cgi
        return [
            '2021年夏土用入り' => [2021, 7, 19],
            '2022年夏土用入り' => [2022, 7, 20],
            '2023年夏土用入り' => [2023, 7, 20],
            '2024年夏土用入り' => [2024, 7, 19],
            '2025年夏土用入り' => [2025, 7, 19],
            '2026年夏土用入り' => [2026, 7, 20],
        ];
    }
    /**
     * @dataProvider doyoSummerProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isDoyo_summerStart($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isDoyo($date), "{$year}年{$month}月{$day}日は夏土用");
    }
    /**
     * @dataProvider doyoSummerProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_doyo($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_DOYO, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isDoyo_outside(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isDoyo(DateTime::parse('2026-08-10')));
        $this->assertFalse($node->isDoyo(DateTime::parse('2026-09-01')));
    }
    public function test_isDoyo_winterDoyo(): void
    {
        $node = MiscSeasonalNode::factory();
        // 2026年立春=2/4の18日前=1/17が冬土用入り
        $this->assertTrue($node->isDoyo(DateTime::parse('2026-01-20')));
    }
    // =========================================================================
    // 二百十日テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function nihyakutokaProvider(): array
    {
        // 二百十日 = 立春から数えて210日目（立春+209日）
        // 2021: 立春2/3 → 8/31
        // 2022: 立春2/4 → 9/1
        // 2023: 立春2/4 → 9/1
        // 2024: 立春2/4 → 8/31
        // 2025: 立春2/3 → 8/31
        // 2026: 立春2/4 → 9/1
        return [
            '2021年二百十日' => [2021, 8, 31],
            '2022年二百十日' => [2022, 9, 1],
            '2023年二百十日' => [2023, 9, 1],
            '2024年二百十日' => [2024, 8, 31],
            '2025年二百十日' => [2025, 8, 31],
            '2026年二百十日' => [2026, 9, 1],
        ];
    }
    /**
     * @dataProvider nihyakutokaProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isNihyakutoka($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isNihyakutoka($date), "{$year}年{$month}月{$day}日は二百十日");
    }
    /**
     * @dataProvider nihyakutokaProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_nihyakutoka($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NIHYAKUTOKA, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isNihyakutoka_adjacent(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isNihyakutoka(DateTime::parse('2026-08-31')));
        $this->assertFalse($node->isNihyakutoka(DateTime::parse('2026-09-02')));
    }
    // =========================================================================
    // 二百二十日テスト (2021-2026)
    // =========================================================================
    /**
     * @return array<string, array{int, int, int}>
     */
    public static function nihyakunijuunichiProvider(): array
    {
        // 二百二十日 = 立春から数えて220日目（立春+219日）
        // 2021: 立春2/3 → 9/10
        // 2022: 立春2/4 → 9/11
        // 2023: 立春2/4 → 9/11
        // 2024: 立春2/4 → 9/10
        // 2025: 立春2/3 → 9/10
        // 2026: 立春2/4 → 9/11
        return [
            '2021年二百二十日' => [2021, 9, 10],
            '2022年二百二十日' => [2022, 9, 11],
            '2023年二百二十日' => [2023, 9, 11],
            '2024年二百二十日' => [2024, 9, 10],
            '2025年二百二十日' => [2025, 9, 10],
            '2026年二百二十日' => [2026, 9, 11],
        ];
    }
    /**
     * @dataProvider nihyakunijuunichiProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_isNihyakunijuunichi($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertTrue($node->isNihyakunijuunichi($date), "{$year}年{$month}月{$day}日は二百二十日");
    }
    /**
     * @dataProvider nihyakunijuunichiProvider
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function test_getMiscSeasonalNodeKey_nihyakunijuunichi($year, $month, $day): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI, $node->getMiscSeasonalNodeKey($date));
    }
    public function test_isNihyakunijuunichi_adjacent(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isNihyakunijuunichi(DateTime::parse('2026-09-10')));
        $this->assertFalse($node->isNihyakunijuunichi(DateTime::parse('2026-09-12')));
    }
    // =========================================================================
    // 雑節なし（NONE）テスト
    // =========================================================================
    public function test_getMiscSeasonalNodeKey_none(): void
    {
        $node = MiscSeasonalNode::factory();
        $key = $node->getMiscSeasonalNodeKey(DateTime::parse('2026-04-15'));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NONE, $key);
    }
    // =========================================================================
    // resolveSingleSolarTerm フォールバックテスト
    // =========================================================================
    public function test_resolveSingleSolarTerm_fallbackYear(): void
    {
        $node = MiscSeasonalNode::factory();
        $result = $node->isDoyo(DateTime::parse('1500-07-15'));
        $this->assertIsBool($result);
    }
    public function test_resolveSingleSolarTerm_uses_SolarTerm_when_vsop87_enabled(): void
    {
        try {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

            $termDate = $this->invokeExecuteMethod(
                MiscSeasonalNode::factory(),
                'resolveSingleSolarTerm',
                ['rissyun', 2025]
            );

            $this->assertSame(2025, $termDate->year);
            $this->assertSame(DateTime::SOLAR_TERM_RISSYUN, $termDate->solar_term);
            $this->assertSame(2, $termDate->month);
            $this->assertSame(3, $termDate->day);
        } finally {
            Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
            Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
        }
    }
    // =========================================================================
    // DateTime / DateTimeImmutable プロパティ統合テスト
    // =========================================================================
    public function test_datetime_miscSeasonalNodeProperty(): void
    {
        $date = DateTime::parse('2026-02-03');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $date->miscSeasonalNode);
        $this->assertSame('節分', $date->miscSeasonalNodeText);
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $date->misc_seasonal_node);
        $this->assertSame('節分', $date->misc_seasonal_node_text);
    }
    public function test_datetimeImmutable_miscSeasonalNodeProperty(): void
    {
        $date = DateTimeImmutable::parse('2026-02-03');
        $this->assertSame(DateTimeImmutable::MISC_SEASONAL_NODE_SETSUBUN, $date->miscSeasonalNode);
        $this->assertSame('節分', $date->miscSeasonalNodeText);
    }
    public function test_datetime_doyoProperty(): void
    {
        $date = DateTime::parse('2026-07-25');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_DOYO, $date->miscSeasonalNode);
        $this->assertSame('土用', $date->miscSeasonalNodeText);
    }
    public function test_datetime_higanProperty(): void
    {
        $date = DateTime::parse('2026-09-23');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HIGAN, $date->miscSeasonalNode);
        $this->assertSame('彼岸', $date->miscSeasonalNodeText);
    }
    public function test_datetime_noneProperty(): void
    {
        $date = DateTime::parse('2026-04-15');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NONE, $date->miscSeasonalNode);
        $this->assertSame('', $date->miscSeasonalNodeText);
    }
}
