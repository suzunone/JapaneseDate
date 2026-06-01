<?php

/** @noinspection PhpDocMissingThrowsInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\JapaneseDate\Traits;

use Closure;
use DateTimeZone;
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
 * @covers \JapaneseDate\Traits\CacheSetting::innerDateTime
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
        DateTime::setCacheMode(Cache::MODE_NONE);
        $this->assertSame(
            Cache::MODE_NONE,
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
            Cache::MODE_FILE,
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
        $closure = static function (string $key, Closure $fn) {
            return $fn();
        };
        DateTime::setCacheClosure($closure);
        $this->assertSame(
            Cache::MODE_ORIGINAL,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
        $this->assertSame(
            $closure,
            $this->invokeGetProperty(Cache::class, 'cache_closure')
        );
    }
    /**
     * 内部用 DateTime インスタンスが同じ入力に対して再利用されることを確認する。
     */
    public function test_innerDateTime(): void
    {
        $dt = new DateTime('2023-01-15', new DateTimeZone('Asia/Tokyo'));

        $result1 = $this->invokeExecuteMethod($dt, 'innerDateTime', ['2023-06-01']);
        $result2 = $this->invokeExecuteMethod($dt, 'innerDateTime', ['2023-06-01']);

        $this->assertInstanceOf(DateTime::class, $result1);
        $this->assertSame('2023-06-01', $result1->format('Y-m-d'));
        $this->assertSame($result1, $result2);
    }
}
