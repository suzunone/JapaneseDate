<?php

namespace Tests\JapaneseDate\Support;

use RuntimeException;

/**
 * PHPUnit のプロセス分離実行数を制限するための補助クラス。
 */
class ProcessLimiter
{
    /**
     * 取得中のロックファイルハンドル。
     *
     * @var resource|null
     */
    private static $lockHandle = null;

    /**
     * PHPUnit の isolated test 実行時だけプロセス数制限を有効にする。
     */
    public static function installForPhpUnitIsolation(): void
    {
        // PHPUnit のプロセス分離で実行されていない場合は制限を行わない
        if (!function_exists('__phpunit_run_isolated_test')) {
            return;
        }

        $limit = self::processLimit();

        // 0 以下を指定した場合は明示的に制限を無効化する
        if ($limit < 1) {
            return;
        }

        self::acquire($limit);

        // テストプロセス終了時にロックを解放する
        register_shutdown_function(static function (): void {
            self::release();
        });
    }

    /**
     * 環境変数から同時実行できるプロセス数を取得する。
     */
    private static function processLimit(): int
    {
        $limit = getenv('JAPANESE_DATE_TEST_PROCESS_LIMIT');

        // 未指定または不正な値の場合は 1 プロセスに制限する
        if ($limit === false || $limit === '') {
            return 1;
        }

        if (!is_numeric($limit)) {
            return 1;
        }

        return max(0, (int) $limit);
    }

    /**
     * 利用可能なロックスロットを取得できるまで待機する。
     */
    private static function acquire(int $limit): void
    {
        $lockDir = sys_get_temp_dir() . '/japanese_date_phpunit_process_limiter';

        // 一時ディレクトリ配下にロックファイル置き場を作成する
        if (!is_dir($lockDir) && !mkdir($lockDir, 0777, true) && !is_dir($lockDir)) {
            throw new RuntimeException(sprintf('Cannot create process limiter lock directory: %s', $lockDir));
        }

        while (true) {
            // slot-0 から順に試し、空いているロックを取得できたプロセスだけ先へ進む
            for ($slot = 0; $slot < $limit; $slot++) {
                $handle = fopen($lockDir . '/slot-' . $slot . '.lock', 'c');

                if ($handle === false) {
                    continue;
                }

                if (flock($handle, LOCK_EX | LOCK_NB)) {
                    self::$lockHandle = $handle;

                    return;
                }

                // 取得できなかったスロットのハンドルは保持しない
                fclose($handle);
            }

            // すべてのスロットが使用中の場合は短時間待って再試行する
            usleep(50000);
        }
    }

    /**
     * 取得済みのロックを解放する。
     */
    private static function release(): void
    {
        if (self::$lockHandle === null) {
            return;
        }

        flock(self::$lockHandle, LOCK_UN);
        fclose(self::$lockHandle);
        self::$lockHandle = null;
    }
}
