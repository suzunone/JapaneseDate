<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Cache;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;

/**
 * グローバル関数のモックを使って Cache::apcForever() の APCu 分岐を検証する。
 * グローバル関数テーブルへの影響を避けるため、各テストは別プロセスで実行する。
 * @covers \JapaneseDate\Components\Cache
 */
class CacheApcMockTest extends TestCase
{
    /**
     * APCu キャッシュに値がない場合、コールバックの結果を保存して返すことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_apc_forever_cache_miss(): void
    {
        require_once __DIR__ . '/global_apcu_mock.php';
        $GLOBALS['_test_apcu_store'] = [];
        Cache::setMode(Cache::MODE_APC);
        $callCount = 0;
        $result = Cache::forever('apcu_miss_key', function () use (&$callCount) {
            $callCount++;

            return 'computed_value';
        });
        $this->assertSame('computed_value', $result);
        $this->assertSame(1, $callCount);
        $this->assertSame('computed_value', $GLOBALS['_test_apcu_store']['apcu_miss_key']);
    }
    /**
     * APCu キャッシュに値がある場合、保存済みの値を返してコールバックを実行しないことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_apc_forever_cache_hit(): void
    {
        require_once __DIR__ . '/global_apcu_mock.php';
        $GLOBALS['_test_apcu_store'] = ['apcu_hit_key' => 'cached_apcu_value'];
        Cache::setMode(Cache::MODE_APC);
        $callCount = 0;
        $result = Cache::forever('apcu_hit_key', function () use (&$callCount) {
            $callCount++;

            return 'new_value';
        });
        $this->assertSame('cached_apcu_value', $result);
        $this->assertSame(0, $callCount);
    }
}
