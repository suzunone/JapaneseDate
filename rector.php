<?php

declare(strict_types=1);

use JapaneseDateRector\PHPUnitAttributeToAnnotationRector;
use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;

// カスタム Rector ルールをロード
require_once __DIR__ . '/tools/Rector/PHPUnitAttributeToAnnotationRector.php';

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

    // 4. PHPUnit 10+ の Attribute を PHPUnit 9 互換のアノテーションに変換
    ->withRules([
        PHPUnitAttributeToAnnotationRector::class,
    ])

    // 5. アノテーションからアトリビュートへの自動変換ルールを除外する
    ->withSkip([
        AnnotationToAttributeRector::class,
        __DIR__ . '/src/Components/ELP2000.php',
    ]);
