<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Traits;

use Closure;
use JapaneseDate\CacheMode;
use JapaneseDate\Components\Cache;
use JapaneseDate\DateTime;
use JapaneseDate\Traits\CacheSetting;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * CacheSetting Trait 経由で Cache コンポーネントの設定を変更できることを検証する。
 * @covers \JapaneseDate\Traits\CacheSetting
 * @covers \JapaneseDate\Traits\CacheSetting::setCacheMode
 * @covers \JapaneseDate\Traits\CacheSetting::setCacheFilePath
 * @covers \JapaneseDate\Traits\CacheSetting::setCacheClosure
 */
class CacheSettingTest extends TestCase
{
    use InvokeTrait;
    /**
     * DateTime 経由でキャッシュモードを変更できることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setCacheMode(): void
    {
        DateTime::setCacheMode(CacheMode::MODE_NONE);
        $this->assertSame(
            CacheMode::MODE_NONE,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
    }
    /**
     * DateTime 経由でファイルキャッシュの保存先を設定できることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setCacheFilePath(): void
    {
        $path = '/tmp/test_cache_setting';
        DateTime::setCacheFilePath($path);
        $this->assertSame(
            CacheMode::MODE_FILE,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
        $this->assertSame(
            $path,
            $this->invokeGetProperty(Cache::class, 'cache_file_path')
        );
    }
    /**
     * DateTime 経由で独自キャッシュ用クロージャを設定できることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setCacheClosure(): void
    {
        $closure = static function (string $key, Closure $fn): mixed {
            return $fn();
        };
        DateTime::setCacheClosure($closure);
        $this->assertSame(
            CacheMode::MODE_ORIGINAL,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
        $this->assertSame(
            $closure,
            $this->invokeGetProperty(Cache::class, 'cache_closure')
        );
    }
}
