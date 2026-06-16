<?php

/**
 * JapaneseDate\Components 名前空間内のファイルシステム関数モック。
 * Cache::fileForever() の mkdir 失敗・realpath 失敗の分岐をテストするために使用する。
 * #[RunInSeparateProcess] テスト内でのみインクルードすること。
 */

namespace JapaneseDate\Components;

/**
 * @param string $path
 * @return bool
 */
function is_dir(string $path): bool
{
    if (isset($GLOBALS['_test_fs_is_dir'])) {
        return (bool) $GLOBALS['_test_fs_is_dir'];
    }

    return \is_dir($path);
}

/**
 * @param string $path
 * @param int $permissions
 * @param bool $recursive
 * @return bool
 */
function mkdir(string $path, int $permissions = 0777, bool $recursive = false): bool
{
    if ($GLOBALS['_test_fs_mkdir_fail'] ?? false) {
        return false;
    }

    return \mkdir($path, $permissions, $recursive);
}

/**
 * @param string $path
 * @return string|false
 */
function realpath(string $path)
{
    if ($GLOBALS['_test_fs_realpath_fail'] ?? false) {
        return false;
    }

    return \realpath($path);
}
