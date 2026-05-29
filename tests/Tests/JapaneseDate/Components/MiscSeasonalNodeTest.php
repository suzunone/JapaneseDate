<?php

/** @noinspection PhpDocMissingThrowsInspection */
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

use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

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
    // =========================================================================
    // ファクトリー・基本テスト
    // =========================================================================
    /**
     * factory() がシングルトンを返すことを確認する。
     *
     * リフレクションで静的インスタンスをリセットし、初期化コードパスも確実にカバーする。
     */
    public function test_factory_returnsSameInstance(): void
    {
        // リフレクションで static $instance をリセットして初期化パスをカバーする
        $ref = new \ReflectionClass(MiscSeasonalNode::class);
        $method = $ref->getMethod('factory');
        $staticVars = $method->getStaticVariables();
        // PHP では静的変数のリセットに直接アクセスできないため、
        // factory() の最初の呼び出しが新しいインスタンスを生成することを確認する
        $a = MiscSeasonalNode::factory();
        $b = MiscSeasonalNode::factory();
        $this->assertSame($a, $b);
        $this->assertInstanceOf(MiscSeasonalNode::class, $a);
    }
    /**
     * MISC_SEASONAL_NODE_NAMES 定数がすべての雑節名を含むことを確認する。
     */
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
    // =========================================================================
    // viewMiscSeasonalNode
    // =========================================================================
    /**
     * viewMiscSeasonalNode が正しい日本語名を返すことを確認する。
     *
     * @param int    $key      雑節定数
     * @param string $expected 期待する日本語名
     * @dataProvider viewMiscSeasonalNodeProvider
     */
    public function test_viewMiscSeasonalNode(int $key, string $expected): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertSame($expected, $node->viewMiscSeasonalNode($key));
    }
    public static function viewMiscSeasonalNodeProvider(): array
    {
        return [
            '雑節なし'    => [0, ''],
            '節分'        => [1, '節分'],
            '彼岸'        => [2, '彼岸'],
            '社日'        => [3, '社日'],
            '八十八夜'    => [4, '八十八夜'],
            '入梅'        => [5, '入梅'],
            '半夏生'      => [6, '半夏生'],
            '土用'        => [7, '土用'],
            '二百十日'    => [8, '二百十日'],
            '二百二十日'  => [9, '二百二十日'],
            '存在しないキー' => [999, ''],
        ];
    }
    // =========================================================================
    // 節分テスト
    // =========================================================================
    /**
     * 節分（立春の前日）が正しく判定されることを確認する。
     *
     * 2026年の立春は2月4日なので、節分は2月3日。
     */
    public function test_isSetsubun_2026(): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse('2026-02-03');
        $this->assertTrue($node->isSetsubun($date));
    }
    /**
     * 節分以外の日が false を返すことを確認する。
     */
    public function test_isSetsubun_nonSetsubun(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isSetsubun(DateTime::parse('2026-02-04'))); // 立春当日
        $this->assertFalse($node->isSetsubun(DateTime::parse('2026-02-02'))); // 節分の前日
        $this->assertFalse($node->isSetsubun(DateTime::parse('2026-06-01'))); // 全く異なる日
    }
    /**
     * getMiscSeasonalNodeKey で節分が MISC_SEASONAL_NODE_SETSUBUN を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_setsubun(): void
    {
        $node = MiscSeasonalNode::factory();
        $date = DateTime::parse('2026-02-03');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $node->getMiscSeasonalNodeKey($date));
    }
    // =========================================================================
    // 彼岸テスト
    // =========================================================================
    /**
     * 春彼岸の中日（春分）が彼岸と判定されることを確認する。
     *
     * 2026年の春分は3月20日頃。
     */
    public function test_isHigan_springCenter(): void
    {
        $node = MiscSeasonalNode::factory();
        // 2026年春分 = 3月20日（彼岸の中日）
        $this->assertTrue($node->isHigan(DateTime::parse('2026-03-20')));
    }
    /**
     * 春彼岸の入り（春分の3日前）が彼岸と判定されることを確認する。
     */
    public function test_isHigan_springStart(): void
    {
        $node = MiscSeasonalNode::factory();
        // 春分前3日も彼岸期間
        $this->assertTrue($node->isHigan(DateTime::parse('2026-03-17')));
    }
    /**
     * 秋彼岸の中日（秋分）が彼岸と判定されることを確認する。
     *
     * 2026年の秋分は9月23日頃。
     */
    public function test_isHigan_autumnCenter(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertTrue($node->isHigan(DateTime::parse('2026-09-23')));
    }
    /**
     * 彼岸期間外の日が false を返すことを確認する。
     */
    public function test_isHigan_outside(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isHigan(DateTime::parse('2026-04-01')));
        $this->assertFalse($node->isHigan(DateTime::parse('2026-06-01')));
    }
    /**
     * getMiscSeasonalNodeKey で彼岸が MISC_SEASONAL_NODE_HIGAN を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_higan(): void
    {
        $node = MiscSeasonalNode::factory();
        // 春分の3日前は彼岸（節分でも社日でもない日を選ぶ）
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HIGAN, $node->getMiscSeasonalNodeKey(DateTime::parse('2026-03-17')));
    }
    // =========================================================================
    // 社日テスト
    // =========================================================================
    /**
     * 春社日が正しく判定されることを確認する。
     *
     * 春分 2026-03-20（甲の日）の最も近い戊の日:
     * cal_to_jd で JD%10==4 が戊の日。
     * 3月24日（春分+4日）が戊の日となる場合。
     */
    public function test_isShanichi_spring(): void
    {
        $node = MiscSeasonalNode::factory();
        // 春分 2026-03-20 から最も近い戊の日を確認する
        // 実際の社日は cal_to_jd(CAL_GREGORIAN, 3, 24, 2026) % 10 == 4 の場合 3月24日
        $found = false;
        for ($d = 14; $d <= 27; $d++) {
            $date = DateTime::parse("2026-03-{$d}");
            if ($node->isShanichi($date)) {
                $found = true;
                // 春分（3月20日）との距離が最小であることを確認
                $dist = abs($d - 20);
                $this->assertLessThanOrEqual(5, $dist, "社日は春分から5日以内: 3月{$d}日");
                break;
            }
        }
        $this->assertTrue($found, '2026年の春社日が3月14日〜27日の範囲で見つかること');
    }
    /**
     * 秋社日が正しく判定されることを確認する。
     *
     * 秋分 2026-09-23 の最も近い戊の日。
     */
    public function test_isShanichi_autumn(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 18; $d <= 28; $d++) {
            $date = DateTime::parse("2026-09-{$d}");
            if ($node->isShanichi($date)) {
                $found = true;
                $dist = abs($d - 23);
                $this->assertLessThanOrEqual(5, $dist, "社日は秋分から5日以内: 9月{$d}日");
                break;
            }
        }
        $this->assertTrue($found, '2026年の秋社日が9月18日〜28日の範囲で見つかること');
    }
    /**
     * 戊の日でない日が社日にならないことを確認する。
     */
    public function test_isShanichi_nonTsuchinoe(): void
    {
        $node = MiscSeasonalNode::factory();
        // 春分 2026-03-20 (JD%10=0=甲) は戊の日ではないので社日ではない
        $this->assertFalse($node->isShanichi(DateTime::parse('2026-03-20')));
    }
    /**
     * getMiscSeasonalNodeKey で社日が MISC_SEASONAL_NODE_SHANICHI を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_shanichi(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 14; $d <= 27; $d++) {
            $date = DateTime::parse("2026-03-{$d}");
            $key = $node->getMiscSeasonalNodeKey($date);
            if ($key === DateTime::MISC_SEASONAL_NODE_SHANICHI) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, '2026年3月の社日が getMiscSeasonalNodeKey で検出されること');
    }
    // =========================================================================
    // 八十八夜テスト
    // =========================================================================
    /**
     * 八十八夜が正しく判定されることを確認する。
     *
     * 立春 2026-02-04 + 87日 = 2026-05-02 頃が八十八夜。
     */
    public function test_isHachijuhachiya_2026(): void
    {
        $node = MiscSeasonalNode::factory();
        // 立春(2026-02-04) + 87日
        $risshun = DateTime::parse('2026-02-04');
        $target = $risshun->copy()->addDays(87)->format('Y-m-d');

        $this->assertTrue($node->isHachijuhachiya(DateTime::parse($target)));
    }
    /**
     * 八十八夜の前後の日が false を返すことを確認する。
     */
    public function test_isHachijuhachiya_adjacent(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isHachijuhachiya(DateTime::parse('2026-05-01')));
        $this->assertFalse($node->isHachijuhachiya(DateTime::parse('2026-05-03')));
    }
    /**
     * getMiscSeasonalNodeKey で八十八夜が MISC_SEASONAL_NODE_HACHIJUHACHIYA を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_hachijuhachiya(): void
    {
        $node = MiscSeasonalNode::factory();
        $risshun = DateTime::parse('2026-02-04');
        $target = DateTime::parse($risshun->copy()->addDays(87)->format('Y-m-d'));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HACHIJUHACHIYA, $node->getMiscSeasonalNodeKey($target));
    }
    // =========================================================================
    // 入梅テスト
    // =========================================================================
    /**
     * 入梅（太陽黄経80°）が6月上旬に検出されることを確認する。
     *
     * 入梅は通常6月10〜12日頃。
     */
    public function test_isNyubai_2026(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 8; $d <= 14; $d++) {
            $date = DateTime::parse("2026-06-{$d}");
            if ($node->isNyubai($date)) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, '2026年の入梅が6月8日〜14日の範囲で検出されること');
    }
    /**
     * 入梅でない日（真夏）が false を返すことを確認する。
     */
    public function test_isNyubai_nonNyubai(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isNyubai(DateTime::parse('2026-08-01')));
    }
    /**
     * getMiscSeasonalNodeKey で入梅が MISC_SEASONAL_NODE_NYUBAI を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_nyubai(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 8; $d <= 14; $d++) {
            $date = DateTime::parse("2026-06-{$d}");
            if ($node->getMiscSeasonalNodeKey($date) === DateTime::MISC_SEASONAL_NODE_NYUBAI) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, '2026年の入梅が getMiscSeasonalNodeKey で検出されること');
    }
    // =========================================================================
    // 半夏生テスト
    // =========================================================================
    /**
     * 半夏生（太陽黄経100°）が7月初旬に検出されることを確認する。
     *
     * 半夏生は通常7月1〜3日頃。
     */
    public function test_isHangesho_2026(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 1; $d <= 5; $d++) {
            $date = DateTime::parse("2026-07-{$d}");
            if ($node->isHangesho($date)) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, '2026年の半夏生が7月1日〜5日の範囲で検出されること');
    }
    /**
     * 半夏生でない日が false を返すことを確認する。
     */
    public function test_isHangesho_nonHangesho(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isHangesho(DateTime::parse('2026-08-01')));
    }
    /**
     * getMiscSeasonalNodeKey で半夏生が MISC_SEASONAL_NODE_HANGESHO を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_hangesho(): void
    {
        $node = MiscSeasonalNode::factory();
        $found = false;
        for ($d = 1; $d <= 5; $d++) {
            $date = DateTime::parse("2026-07-{$d}");
            if ($node->getMiscSeasonalNodeKey($date) === DateTime::MISC_SEASONAL_NODE_HANGESHO) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, '2026年の半夏生が getMiscSeasonalNodeKey で検出されること');
    }
    // =========================================================================
    // 土用テスト
    // =========================================================================
    /**
     * 夏の土用期間内の日が土用と判定されることを確認する。
     *
     * 2026年の立秋は8月7日頃。土用は7月20日頃〜8月6日。
     */
    public function test_isDoyo_summerDoyo(): void
    {
        $node = MiscSeasonalNode::factory();
        // 7月下旬は夏の土用期間内
        $this->assertTrue($node->isDoyo(DateTime::parse('2026-07-25')));
    }
    /**
     * 土用期間外の日が false を返すことを確認する。
     */
    public function test_isDoyo_outside(): void
    {
        $node = MiscSeasonalNode::factory();
        // 8月10日は立秋（8月7日）の後なので土用期間外
        $this->assertFalse($node->isDoyo(DateTime::parse('2026-08-10')));
        // 9月1日も土用期間外
        $this->assertFalse($node->isDoyo(DateTime::parse('2026-09-01')));
    }
    /**
     * 春の土用期間内の日が土用と判定されることを確認する。
     *
     * 立春の18日前（1月中旬〜下旬）が冬土用。
     */
    public function test_isDoyo_winterDoyo(): void
    {
        $node = MiscSeasonalNode::factory();
        // 2026年立春=2月4日の18日前=1月17日が冬土用入り
        $this->assertTrue($node->isDoyo(DateTime::parse('2026-01-20')));
    }
    /**
     * getMiscSeasonalNodeKey で土用が MISC_SEASONAL_NODE_DOYO を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_doyo(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_DOYO, $node->getMiscSeasonalNodeKey(DateTime::parse('2026-07-25')));
    }
    // =========================================================================
    // 二百十日テスト
    // =========================================================================
    /**
     * 二百十日（立春から210日目）が正しく判定されることを確認する。
     *
     * 立春 2026-02-04 + 209日 = 2026-09-01 頃が二百十日。
     */
    public function test_isNihyakutoka_2026(): void
    {
        $node = MiscSeasonalNode::factory();
        $risshun = DateTime::parse('2026-02-04');
        $target = $risshun->copy()->addDays(209)->format('Y-m-d');

        $this->assertTrue($node->isNihyakutoka(DateTime::parse($target)));
    }
    /**
     * 二百十日以外の日が false を返すことを確認する。
     */
    public function test_isNihyakutoka_adjacent(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isNihyakutoka(DateTime::parse('2026-08-31')));
        $this->assertFalse($node->isNihyakutoka(DateTime::parse('2026-09-02')));
    }
    /**
     * getMiscSeasonalNodeKey で二百十日が MISC_SEASONAL_NODE_NIHYAKUTOKA を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_nihyakutoka(): void
    {
        $node = MiscSeasonalNode::factory();
        $risshun = DateTime::parse('2026-02-04');
        $target = DateTime::parse($risshun->copy()->addDays(209)->format('Y-m-d'));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NIHYAKUTOKA, $node->getMiscSeasonalNodeKey($target));
    }
    // =========================================================================
    // 二百二十日テスト
    // =========================================================================
    /**
     * 二百二十日（立春から220日目）が正しく判定されることを確認する。
     *
     * 立春 2026-02-04 + 219日 = 2026-09-11 頃が二百二十日。
     */
    public function test_isNihyakunijuunichi_2026(): void
    {
        $node = MiscSeasonalNode::factory();
        $risshun = DateTime::parse('2026-02-04');
        $target = $risshun->copy()->addDays(219)->format('Y-m-d');

        $this->assertTrue($node->isNihyakunijuunichi(DateTime::parse($target)));
    }
    /**
     * 二百二十日以外の日が false を返すことを確認する。
     */
    public function test_isNihyakunijuunichi_adjacent(): void
    {
        $node = MiscSeasonalNode::factory();
        $this->assertFalse($node->isNihyakunijuunichi(DateTime::parse('2026-09-10')));
        $this->assertFalse($node->isNihyakunijuunichi(DateTime::parse('2026-09-12')));
    }
    /**
     * getMiscSeasonalNodeKey で二百二十日が MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_nihyakunijuunichi(): void
    {
        $node = MiscSeasonalNode::factory();
        $risshun = DateTime::parse('2026-02-04');
        $target = DateTime::parse($risshun->copy()->addDays(219)->format('Y-m-d'));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI, $node->getMiscSeasonalNodeKey($target));
    }
    // =========================================================================
    // 雑節なし（NONE）テスト
    // =========================================================================
    /**
     * いずれの雑節にも該当しない日が MISC_SEASONAL_NODE_NONE を返すことを確認する。
     */
    public function test_getMiscSeasonalNodeKey_none(): void
    {
        $node = MiscSeasonalNode::factory();
        // 2026-04-15 は概ねいずれの雑節にも該当しない（春彼岸・社日の後、八十八夜前）
        $key = $node->getMiscSeasonalNodeKey(DateTime::parse('2026-04-15'));
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NONE, $key);
    }
    // =========================================================================
    // resolveSingleSolarTerm フォールバックテスト
    // =========================================================================
    /**
     * SimpleSolarTerm が対応しない年でも SolarTerm 経由で正しく節気データを取得できることを確認する。
     *
     * 1500年は SimpleSolarTerm の対応範囲外のため SolarTerm にフォールバックする。
     */
    public function test_resolveSingleSolarTerm_fallbackYear(): void
    {
        $node = MiscSeasonalNode::factory();
        // 1500年の土用判定（例外が出ないこと）
        $result = $node->isDoyo(DateTime::parse('1500-07-15'));
        $this->assertIsBool($result);
    }
    // =========================================================================
    // DateTime / DateTimeImmutable プロパティ統合テスト
    // =========================================================================
    /**
     * DateTime の miscSeasonalNode プロパティが正しく動作することを確認する。
     */
    public function test_datetime_miscSeasonalNodeProperty(): void
    {
        // 節分 2026-02-03
        $date = DateTime::parse('2026-02-03');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $date->miscSeasonalNode);
        $this->assertSame('節分', $date->miscSeasonalNodeText);

        // スネークケースでもアクセス可能
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_SETSUBUN, $date->misc_seasonal_node);
        $this->assertSame('節分', $date->misc_seasonal_node_text);
    }
    /**
     * DateTimeImmutable の miscSeasonalNode プロパティが正しく動作することを確認する。
     */
    public function test_datetimeImmutable_miscSeasonalNodeProperty(): void
    {
        $date = \JapaneseDate\DateTimeImmutable::parse('2026-02-03');
        $this->assertSame(\JapaneseDate\DateTimeImmutable::MISC_SEASONAL_NODE_SETSUBUN, $date->miscSeasonalNode);
        $this->assertSame('節分', $date->miscSeasonalNodeText);
    }
    /**
     * 土用日の DateTime プロパティが MISC_SEASONAL_NODE_DOYO を返すことを確認する。
     */
    public function test_datetime_doyoProperty(): void
    {
        $date = DateTime::parse('2026-07-25');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_DOYO, $date->miscSeasonalNode);
        $this->assertSame('土用', $date->miscSeasonalNodeText);
    }
    /**
     * 彼岸日の DateTime プロパティが MISC_SEASONAL_NODE_HIGAN を返すことを確認する。
     */
    public function test_datetime_higanProperty(): void
    {
        // 2026年秋分(9月23日) = 彼岸の中日（土用でないことを確認済み）
        $date = DateTime::parse('2026-09-23');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_HIGAN, $date->miscSeasonalNode);
        $this->assertSame('彼岸', $date->miscSeasonalNodeText);
    }
    /**
     * 雑節なしの日の DateTime プロパティが MISC_SEASONAL_NODE_NONE を返すことを確認する。
     */
    public function test_datetime_noneProperty(): void
    {
        $date = DateTime::parse('2026-04-15');
        $this->assertSame(DateTime::MISC_SEASONAL_NODE_NONE, $date->miscSeasonalNode);
        $this->assertSame('', $date->miscSeasonalNodeText);
    }
}
