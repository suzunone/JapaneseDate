<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    // 1. 対象ディレクトリの指定
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])

    // 2. 指定したバージョン（PHP 8.0）で動作するよう、それ以降の構文をダウングレード
    ->withDowngradeSets(
        php80: true
    )

    // 3. composer.jsonにインストールされているPHPUnit（9系）のバージョンに合わせたセットを自動適用
    ->withComposerBased(
        phpunit: true
    );
