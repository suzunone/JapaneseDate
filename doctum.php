<?php


use Doctum\Doctum;
use Doctum\Parser\Filter\PublicFilter;
use Doctum\Project;
use Doctum\Renderer\Renderer;
use Symfony\Component\Finder\Finder;
use Doctum\Reflection\ClassReflection;
use Doctum\Reflection\MethodReflection;

require __DIR__ . '/doctum-config.php';

// 2. Doctumの設定を返却
$doctum = new Doctum($iterator, [
    'title' => 'Japanese DateTime Document',
    'build_dir' => __DIR__ . '/doctum',      // 出力先 (HTML)
    'cache_dir' => __DIR__ . '/works/doctum', // キャッシュ先
    'filter' => $filter,
]);
$doctum['renderer'] = static function (Doctum $doctum): JapaneseDateDoctumRenderer {
    return new JapaneseDateDoctumRenderer($doctum['twig'], $doctum['themes'], $doctum['tree'], $doctum['indexer']);
};

return $doctum;
