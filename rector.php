<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\Rector\Class_\AttributeValueResolver;
use Rector\DowngradePhp80\Rector\Class_\DowngradeAttributeToAnnotationRector;

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
    )

    // 4. アノテーションからアトリビュートへの自動変換ルールを除外する
    ->withSkip([
        // PHP 8.0標準のアノテーション→アトリビュート変換を停止
        AnnotationToAttributeRector::class,
        AttributeValueResolver::class,
        DowngradeAttributeToAnnotationRector::class,

    ]);