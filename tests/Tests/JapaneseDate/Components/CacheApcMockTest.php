<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\CacheMode;
use JapaneseDate\Components\Cache;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;

/**
 * グローバル関数のモックを使って Cache::apcForever() の APCu 分岐を検証する。
 * グローバル関数テーブルへの影響を避けるため、各テストは別プロセスで実行する。
 */
#[CoversClass(Cache::class)]
class CacheApcMockTest extends TestCase
{
    /**
     * APCu キャッシュに値がない場合、コールバックの結果を保存して返すことを確認する。
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_apc_forever_cache_miss(): void
    {
        require_once dirname(__DIR__) . '/Support/global_apcu_mock.php';
        $GLOBALS['_test_apcu_store'] = [];
        Cache::setMode(CacheMode::MODE_APC);

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
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_apc_forever_cache_hit(): void
    {
        require_once dirname(__DIR__) . '/Support/global_apcu_mock.php';
        $GLOBALS['_test_apcu_store'] = ['apcu_hit_key' => 'cached_apcu_value'];
        Cache::setMode(CacheMode::MODE_APC);

        $callCount = 0;
        $result = Cache::forever('apcu_hit_key', function () use (&$callCount) {
            $callCount++;

            return 'new_value';
        });

        $this->assertSame('cached_apcu_value', $result);
        $this->assertSame(0, $callCount);
    }

    /**
     * APCu キャッシュに偽値がある場合もヒットとして扱い、コールバックを実行しないことを確認する。
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_apc_forever_cache_hit_with_falsy_value(): void
    {
        require_once dirname(__DIR__) . '/Support/global_apcu_mock.php';
        $GLOBALS['_test_apcu_store'] = [
            'apcu_false_key' => false,
            'apcu_zero_key' => 0,
            'apcu_empty_key' => '',
            'apcu_null_key' => null,
        ];
        Cache::setMode(CacheMode::MODE_APC);

        $callCount = 0;
        $function = function () use (&$callCount) {
            $callCount++;

            return 'new_value';
        };

        $this->assertFalse(Cache::forever('apcu_false_key', $function));
        $this->assertSame(0, Cache::forever('apcu_zero_key', $function));
        $this->assertSame('', Cache::forever('apcu_empty_key', $function));
        $this->assertNull(Cache::forever('apcu_null_key', $function));
        $this->assertSame(0, $callCount);
    }
}
