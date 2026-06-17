<?php

/**
 * ファイルシステム関数のモックを用いた Cache::fileForever() 異常系テスト。
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Cache;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * JapaneseDate\Components 名前空間の is_dir / mkdir / realpath をモックし、
 * fileForever() が RuntimeException をスローする 2 つの分岐を検証する。
 */
#[CoversClass(Cache::class)]
class CacheFsMockTest extends TestCase
{
    /**
     * mkdir が失敗した場合に RuntimeException をスローすることを確認する。
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_fileForever_throws_when_mkdir_fails(): void
    {
        require_once __DIR__ . '/cache_fs_mock.php';

        $GLOBALS['_test_fs_is_dir'] = false;
        $GLOBALS['_test_fs_mkdir_fail'] = true;

        Cache::setCacheFilePath('/nonexistent/cache/path');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('キャッシュディレクトリを作成できません');
        Cache::forever('key', static fn () => 'value');
    }

    /**
     * realpath が false を返した場合に RuntimeException をスローすることを確認する。
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_fileForever_throws_when_realpath_fails(): void
    {
        require_once __DIR__ . '/cache_fs_mock.php';

        $GLOBALS['_test_fs_is_dir'] = true;
        $GLOBALS['_test_fs_realpath_fail'] = true;

        Cache::setCacheFilePath('/nonexistent/cache/path');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('キャッシュディレクトリを解決できません');
        Cache::forever('key', static fn () => 'value');
    }
}
