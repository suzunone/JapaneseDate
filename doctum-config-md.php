<?php

use Doctum\Doctum;
use Doctum\Parser\Filter\PublicFilter;
use Symfony\Component\Finder\Finder;
use Doctum\Reflection\MethodReflection;

// 1. ソースコードのパース対象ファイルを定義
$srcIterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/src')
    ->path('/^DateTime(Immutable)?\.php/')
    ->path('/^DateInterval\.php/')
    ->path('/^DatePeriod\.php/')
    ->path('/^DateTimeInterface\.php/')
    ->path('/^CacheMode\.php/')
    ->path('/^Calendar\.php/')
    ->path('/^DateBusiness\.php/')
    ->path('/^Exceptions/')

    ->path('/^Traits/') // Traits/ ディレクトリ以下を丸ごと対象にする
    ->exclude('test'); // ignore指定されていたtestディレクトリを除外

$carbonIterator = Finder::create()
    ->files()
    ->name('/^Carbon(Immutable|Interval|Period)?\.php$/')
    ->in(__DIR__ . '/vendor/nesbot/carbon/src/Carbon');

$iterator = new AppendIterator();
$iterator->append($srcIterator->getIterator());
$iterator->append($carbonIterator->getIterator());

// 2. public のみを出力するフィルターを定義
class NoMagicMethodFilter extends PublicFilter
{
    public function acceptMethod(MethodReflection $method): bool
    {
        return parent::acceptMethod($method) && !str_starts_with($method->getName(), '__');
    }
}
$filter = function () {
    return new NoMagicMethodFilter();
};

// 3. Doctumの設定を返却 (Markdown出力)
return new Doctum($iterator, [
    'title'         => 'Japanese DateTime Document',
    'theme'         => 'markdown',
    'template_dirs' => [__DIR__ . '/doctum-theme-markdown'],
    'build_dir'     => __DIR__ . '/docs/api',      // 出力先 (Markdown)
    'cache_dir'     => __DIR__ . '/works/doctum',  // キャッシュ先 (HTML版と共有)
    'filter'        => $filter,
]);
