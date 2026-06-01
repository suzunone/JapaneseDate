<?php

use Doctum\Doctum;
use Doctum\Parser\Filter\PublicFilter;
use Doctum\Project;
use Doctum\Renderer\Renderer;
use Symfony\Component\Finder\Finder;
use Doctum\Reflection\ClassReflection;
use Doctum\Reflection\MethodReflection;

require __DIR__ . '/doctum-config.php';

// 3. Doctumの設定を返却 (Markdown出力)
$doctum = new Doctum($iterator, [
    'title' => 'Japanese DateTime Document',
    'theme' => 'markdown',
    'template_dirs' => [__DIR__ . '/doctum-theme-markdown'],
    'build_dir' => __DIR__ . '/docs/api',      // 出力先 (Markdown)
    'cache_dir' => __DIR__ . '/works/doctum',  // キャッシュ先 (HTML版と共有)
    'filter' => $filter,
]);
$doctum['renderer'] = static function (Doctum $doctum): JapaneseDateDoctumRenderer {
    return new JapaneseDateDoctumRenderer($doctum['twig'], $doctum['themes'], $doctum['tree'], $doctum['indexer']);
};

return $doctum;
