<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Cache コンポーネントの基本動作を検証するテスト。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2018/05/08 19:14 リリースから利用可能
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\CacheMode;
use JapaneseDate\Components\Cache;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * Cache クラスのモード設定と forever() のキャッシュ動作を検証する。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 * @covers \JapaneseDate\Components\Cache
 */
class CacheTest extends TestCase
{
    use InvokeTrait;
    /**
     * キャッシュモードを指定した値へ変更できることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setMode(): void
    {
        $this->assertEquals(
            CacheMode::MODE_AUTO,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
        Cache::setMode(CacheMode::MODE_APC);
        $this->assertEquals(
            CacheMode::MODE_APC,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
    }
    /**
     * 独自キャッシュ用クロージャを設定すると ORIGINAL モードへ切り替わることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setCacheClosure(): void
    {
        $closure = static function () {
        };
        Cache::setCacheClosure($closure);
        $this->assertEquals(
            CacheMode::MODE_ORIGINAL,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
        $this->assertSame(
            $closure,
            $this->invokeGetProperty(Cache::class, 'cache_closure')
        );
    }
    /**
     * ファイルキャッシュ用の保存先を設定すると FILE モードへ切り替わることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_setCacheFilePath(): void
    {
        $file = __DIR__ . '/example_text.txt';
        Cache::setCacheFilePath($file);
        $this->assertEquals(
            CacheMode::MODE_FILE,
            $this->invokeGetProperty(Cache::class, 'mode')
        );
        $this->assertSame(
            $file,
            $this->invokeGetProperty(Cache::class, 'cache_file_path')
        );
    }
    /**
     * NONE モードではキャッシュせず、呼び出しごとにコールバックを実行することを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_none(): void
    {
        Cache::setMode(CacheMode::MODE_NONE);
        $callCount = 0;
        $fn = function () use (&$callCount) {
            $callCount++;

            return 'value';
        };
        Cache::forever('key', $fn);
        Cache::forever('key', $fn);
        $this->assertSame(2, $callCount);
    }
    /**
     * 標準のメモリキャッシュで、同じキーの2回目以降は保存済みの値を返すことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_cache_hit(): void
    {
        $callCount = 0;
        $fn = function () use (&$callCount) {
            $callCount++;

            return 'cached';
        };
        $r1 = Cache::forever('hit_key', $fn);
        $r2 = Cache::forever('hit_key', $fn);
        $this->assertSame('cached', $r1);
        $this->assertSame('cached', $r2);
        $this->assertSame(1, $callCount);
    }
    /**
     * メモリキャッシュが null を保存済みの値として扱うことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_cache_hit_with_null_value(): void
    {
        Cache::setCacheClosure(static function (string $key, $fn) {
            unset($key);

            return $fn();
        });
        $callCount = 0;
        $fn = function () use (&$callCount) {
            $callCount++;

            return null;
        };
        $this->assertNull(Cache::forever('null_key', $fn));
        $this->assertNull(Cache::forever('null_key', $fn));
        $this->assertSame(1, $callCount);
    }
    /**
     * ORIGINAL モードでは設定済みの独自キャッシュ用クロージャを使うことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_original(): void
    {
        Cache::setCacheClosure(static function (string $key, $fn) {
            unset($fn);

            return 'original_' . $key;
        });
        $result = Cache::forever('my_key', static function () {
            return 'ignored';
        });
        $this->assertSame('original_my_key', $result);
    }
    /**
     * AUTO モードでも独自キャッシュ用クロージャがある場合はそれを優先することを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_auto_with_closure(): void
    {
        Cache::setCacheClosure(static function (string $key, $fn) {
            unset($fn);

            return 'auto_closure_' . $key;
        });
        Cache::setMode(CacheMode::MODE_AUTO);
        $result = Cache::forever('auto_key', static function () {
            return 'ignored';
        });
        $this->assertSame('auto_closure_auto_key', $result);
    }
    /**
     * APCu を利用できない環境の APC モードでは、コールバックの値をそのまま返すことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_apc_without_apcu(): void
    {
        Cache::setMode(CacheMode::MODE_APC);
        $result = Cache::forever('apc_key', static function () {
            return 'apc_value';
        });
        $this->assertSame('apc_value', $result);
    }
    /**
     * ファイルキャッシュに値がない場合、コールバックの結果を保存して返すことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_file_cache_miss(): void
    {
        $dir = sys_get_temp_dir() . '/jpdate_test_' . uniqid('', true);
        mkdir($dir, 0755, true);
        try {
            Cache::setCacheFilePath($dir);

            $result = Cache::forever('file_key', static function () {
                return ['data' => 'value'];
            });

            $this->assertSame(['data' => 'value'], $result);
            $this->assertFileExists($dir . DIRECTORY_SEPARATOR . sha1('file_key'));
        } finally {
            array_map('unlink', glob($dir . '/*') ?: []);
            rmdir($dir);
        }
    }
    /**
     * ファイルキャッシュの保存先ディレクトリが未作成でも、そのディレクトリ配下に保存されることを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_file_creates_missing_directory(): void
    {
        $dir = sys_get_temp_dir() . '/jpdate_test_' . uniqid('', true);
        try {
            Cache::setCacheFilePath($dir);

            $result = Cache::forever('missing_dir_file_key', static function () {
                return 'file_value';
            });

            $this->assertSame('file_value', $result);
            $this->assertDirectoryExists($dir);
            $this->assertFileExists($dir . DIRECTORY_SEPARATOR . sha1('missing_dir_file_key'));
        } finally {
            if (is_dir($dir)) {
                array_map('unlink', glob($dir . '/*') ?: []);
                rmdir($dir);
            }
        }
    }
    /**
     * ファイルキャッシュに値がある場合、保存済みの値を返してコールバックを実行しないことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_file_cache_hit(): void
    {
        $dir = sys_get_temp_dir() . '/jpdate_test_' . uniqid('', true);
        mkdir($dir, 0755, true);
        try {
            $cacheFile = $dir . DIRECTORY_SEPARATOR . sha1('file_hit_key');
            file_put_contents($cacheFile, serialize('file_hit_value'));

            Cache::setCacheFilePath($dir);
            $callCount = 0;
            $result = Cache::forever('file_hit_key', function () use (&$callCount) {
                $callCount++;

                return 'should_not_be_returned';
            });

            $this->assertSame('file_hit_value', $result);
            $this->assertSame(0, $callCount);
        } finally {
            array_map('unlink', glob($dir . '/*') ?: []);
            rmdir($dir);
        }
    }
    /**
     * AUTO モードでファイルキャッシュの保存先がある場合、ファイルキャッシュを利用することを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_auto_with_file_path(): void
    {
        $dir = sys_get_temp_dir() . '/jpdate_test_' . uniqid('', true);
        mkdir($dir, 0755, true);
        try {
            Cache::setCacheFilePath($dir);
            Cache::setMode(CacheMode::MODE_AUTO);

            $result = Cache::forever('auto_file_key', static function () {
                return 'auto_file_value';
            });

            $this->assertSame('auto_file_value', $result);
        } finally {
            array_map('unlink', glob($dir . '/*') ?: []);
            rmdir($dir);
        }
    }
    /**
     * AUTO モードで利用できるキャッシュ先がない場合、コールバックの値を返すことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_forever_mode_auto_fallback(): void
    {
        $callCount = 0;
        $result = Cache::forever('fallback_key', function () use (&$callCount) {
            $callCount++;

            return 'fallback_value';
        });
        $this->assertSame('fallback_value', $result);
        $this->assertSame(1, $callCount);
    }
    /**
     * cache_file_path が null の場合、fileForever はコールバックをそのまま実行して返すことを確認する。
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_fileForever_with_null_cache_path_calls_function_directly(): void
    {
        $this->invokeSetProperty(Cache::class, 'cache_file_path', null);
        $result = $this->invokeExecuteMethod(Cache::class, 'fileForever', ['key', static function () {
            return 'direct_value';
        }]);
        $this->assertSame('direct_value', $result);
    }
}
