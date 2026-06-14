<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Components\Traits;

use JapaneseDate\Components\Traits\OneTimeCacheTrait;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 *
 */
/**
 *
 * @covers \JapaneseDate\Components\Traits\OneTimeCacheTrait
 */
class OneTimeCacheTraitTest extends TestCase
{
    use InvokeTrait;
    /**
     * キャッシュに値がない場合、クロージャを実行して結果を返すことを確認する。
     */
    public function test_cache_miss_executes_closure(): void
    {
        $instance = $this->makeInstance();
        $callCount = 0;

        $result = $this->invokeExecuteMethod($instance, 'oneTimeCache', [
            'test_key',
            function () use (&$callCount): string {
                $callCount++;

                return 'cached_value';
            },
        ]);

        $this->assertSame('cached_value', $result);
        $this->assertSame(1, $callCount);
    }
    /**
     * OneTimeCacheTrait を組み込んだ無名クラスのインスタンスを作成する。
     */
    private function makeInstance(): object
    {
        return new class () {
            use OneTimeCacheTrait;
        };
    }
    /**
     * キャッシュに値がある場合、クロージャを再実行せず保存済みの値を返すことを確認する。
     */
    public function test_cache_hit_returns_cached_value_without_calling_closure_again(): void
    {
        $instance = $this->makeInstance();
        $callCount = 0;
        $closure = function () use (&$callCount): string {
            $callCount++;

            return 'cached_value';
        };

        $this->invokeExecuteMethod($instance, 'oneTimeCache', ['test_key', $closure]);
        $result = $this->invokeExecuteMethod($instance, 'oneTimeCache', ['test_key', $closure]);

        $this->assertSame('cached_value', $result);
        $this->assertSame(1, $callCount);
    }
    /**
     * 異なるキーの値がそれぞれ独立してキャッシュされることを確認する。
     */
    public function test_different_keys_are_cached_independently(): void
    {
        $instance = $this->makeInstance();

        $result1 = $this->invokeExecuteMethod($instance, 'oneTimeCache', ['key_a', fn () => 'value_a']);
        $result2 = $this->invokeExecuteMethod($instance, 'oneTimeCache', ['key_b', fn () => 'value_b']);

        $this->assertSame('value_a', $result1);
        $this->assertSame('value_b', $result2);
    }
    /**
     * null をキャッシュした場合でも、2回目以降に再計算されないことを確認する。
     */
    public function test_cached_value_null_is_not_recalculated(): void
    {
        $instance = $this->makeInstance();
        $callCount = 0;
        $closure = function () use (&$callCount) {
            $callCount++;

            return null;
        };

        $result = $this->invokeExecuteMethod($instance, 'oneTimeCache', ['null_key', $closure]);
        $this->assertNull($result);

        $result2 = $this->invokeExecuteMethod($instance, 'oneTimeCache', ['null_key', $closure]);
        $this->assertNull($result2);
        $this->assertSame(1, $callCount);
    }
}
