<?php

use Doctum\Doctum;
use Doctum\Parser\Filter\PublicFilter;
use Symfony\Component\Finder\Finder;
use Doctum\Reflection\MethodReflection;

// 1. ソースコードのパース対象ファイルを定義
$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/src')
    ->path('/^DateTime\.php/')
    ->path('/^DateTimeImmutable\.php/')
    ->path('/^DateTimeInterface\.php/')
    ->path('/^CacheMode\.php/')
    ->path('/^Calendar\.php/')
    ->path('/^Traits/') // Traits/ ディレクトリ以下を丸ごと対象にする
    ->exclude('test'); // ignore指定されていたtestディレクトリを除外

// 2. public のみを出力するフィルターを定義
class NoMagicMethodFilter extends PublicFilter
{
    // メソッドを出力するかどうかを判定する関数をオーバーライド
    public function acceptMethod(MethodReflection $method): bool
    {
        // 親クラス（PublicFilter）の条件（Publicかどうか）を満たし、
        // かつ、メソッド名が「__」で始まらないものだけを許可する
        return parent::acceptMethod($method) && !str_starts_with($method->getName(), '__');
    }
}
$filter = function () {
    return new NoMagicMethodFilter();
};

// 2. Doctumの設定を返却
return new Doctum($iterator, [
    'title'     => 'Japanese DateTime Document',
    'build_dir' => __DIR__ . '/doctum',      // 出力先 (HTML)
    'cache_dir' => __DIR__ . '/works/doctum', // キャッシュ先
    'filter'    => $filter,
]);
