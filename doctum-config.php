<?php

use Doctum\Doctum;
use Doctum\Message;
use Doctum\Parser\Filter\PublicFilter;
use Doctum\Project;
use Doctum\Renderer\Renderer;
use Doctum\Tree;
use Symfony\Component\Finder\Finder;
use Doctum\Reflection\ClassReflection;
use Doctum\Reflection\MethodReflection;

// 1. ソースコードのパース対象ファイルを定義
$srcIterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/src')
    ->path('/^DateTime(Immutable)?\.php/')
    ->path('/^DateTimeInterface\.php/')
    ->path('/^DateInterval\.php/')
    ->path('/^DatePeriod\.php/')
    ->path('/^DateBusiness\.php/')
    ->path('/^CacheMode\.php/')
    ->path('/^Calendar\.php/')

    ->path('/^Values/') // Values/ ディレクトリ以下を丸ごと対象にする
    ->path('/^Exceptions/') // Exceptions/ ディレクトリ以下を丸ごと対象にする
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
    public function acceptClass(ClassReflection $class): bool
    {
        if ($class->getNamespace() === 'JapaneseDate\Traits') {
            $property = new ReflectionProperty(ClassReflection::class, 'projectClass');
            $property->setAccessible(true);
            $property->setValue($class, false);
        }

        return true;
    }

    public function acceptMethod(MethodReflection $method): bool
    {
        return parent::acceptMethod($method) && !str_starts_with($method->getName(), '__');
    }
}
$filter = function () {
    return new NoMagicMethodFilter();
};

if (!class_exists(JapaneseDateDoctumRenderer::class)) {
    class JapaneseDateDoctumRenderer extends Renderer
    {
        /**
         * 指定サブネームスペースのクラス・インターフェース・例外を親ページにも統合して表示する。
         * キー: 親ネームスペース、値: フラット化するサブネームスペースの配列
         */
        private const FLATTEN_SUBNAMESPACES = [
            'JapaneseDate' => ['JapaneseDate\\Exceptions', 'JapaneseDate\\Values'],
        ];

        private const HIDDEN_NAMESPACES = [
            'JapaneseDate\\Traits',
        ];

        private const HIDDEN_GLOBAL_NAMESPACES = [
            'Carbon',
            'JapaneseDate\\Traits',
        ];

        protected function renderNamespaceTemplates(array $namespaces, Project $project, $callback = null): void
        {
            // getTree は private なので Reflection 経由で呼び出す
            $getTree = (new ReflectionMethod(Renderer::class, 'getTree'))->getClosure($this);

            foreach ($namespaces as $namespace) {
                if (self::isHiddenNamespace($namespace)) {
                    continue;
                }

                $namespaceDisplayName = $namespace;
                $namespaceName        = $namespace;
                if ($namespace === '') {
                    $namespaceDisplayName = Tree::getGlobalNamespaceName();
                    $namespaceName        = Tree::getGlobalNamespacePageName();
                }

                if (null !== $callback) {
                    call_user_func($callback, Message::RENDER_PROGRESS, ['Namespace', $namespaceDisplayName, $this->step, $this->steps]);
                }

                $classes    = $project->getNamespaceClasses($namespace);
                $interfaces = $project->getNamespaceInterfaces($namespace);
                $exceptions = $project->getNamespaceExceptions($namespace);

                if (isset(self::FLATTEN_SUBNAMESPACES[$namespace])) {
                    foreach (self::FLATTEN_SUBNAMESPACES[$namespace] as $sub) {
                        $classes    = array_merge($classes, $project->getNamespaceClasses($sub));
                        $interfaces = array_merge($interfaces, $project->getNamespaceInterfaces($sub));
                        $exceptions = array_merge($exceptions, $project->getNamespaceExceptions($sub));
                    }
                    ksort($classes);
                    ksort($interfaces);
                    ksort($exceptions);
                }

                [$classes, $exceptions] = $this->moveDocumentedExceptions($classes, $exceptions);

                $variables = [
                    'namespace'     => $namespace,
                    'subnamespaces' => $this->filterHiddenNamespaces($project->getNamespaceSubNamespaces($namespace)),
                    'functions'     => $project->getNamespaceFunctions($namespace),
                    'classes'       => $classes,
                    'interfaces'    => $interfaces,
                    'exceptions'    => $exceptions,
                    'tree'          => $getTree($project),
                ];

                foreach ($this->theme->getTemplates('namespace') as $template => $target) {
                    $this->save($project, sprintf($target, str_replace('\\', '/', $namespaceName)), $template, $variables);
                }
            }
        }

        protected function renderClassTemplates(array $classes, Project $project, $callback = null)
        {
            parent::renderClassTemplates(array_filter(
                $classes,
                static fn (ClassReflection $class): bool => !self::isHiddenNamespace($class->getNamespace())
            ), $project, $callback);
        }

        protected function getVariablesFromClassReflection(ClassReflection $class, Project $project, $callback = null): array
        {
            $variables = parent::getVariablesFromClassReflection($class, $project, $callback);

            $variables['traits'] = array_values(array_filter(
                $variables['traits'],
                static fn (ClassReflection $trait): bool => !self::isHiddenNamespace($trait->getNamespace())
            ));

            foreach (['properties', 'methods'] as $key) {
                $variables[$key] = $this->replaceTraitMemberOwner($variables[$key], $class);
                $this->disableHiddenHintLinks($variables[$key]);
            }

            foreach (['properties', 'methods', 'constants'] as $key) {
                $variables[$key] = $this->sortJapaneseDateMembersFirst($variables[$key]);
            }

            return $variables;
        }

        protected function save(Project $project, $uri, $template, $variables)
        {
            if (isset($variables['classes'], $variables['exceptions'])) {
                [$variables['classes'], $variables['exceptions']] = $this->moveDocumentedExceptions(
                    $variables['classes'],
                    $variables['exceptions']
                );
            }

            if (in_array($uri, ['index.md', 'classes.md', 'namespaces.md', 'index.html', 'classes.html', 'namespaces.html'], true)) {
                if (isset($variables['classes'])) {
                    $variables['classes'] = array_filter(
                        $variables['classes'],
                        static fn (ClassReflection $class): bool => !self::isHiddenGlobalNamespace($class->getNamespace())
                            && !self::isDocumentedException($class)
                    );
                }

                if (isset($variables['namespaces'])) {
                    $variables['namespaces'] = array_values(array_filter(
                        $variables['namespaces'],
                        static fn (string $namespace): bool => !self::isHiddenGlobalNamespace($namespace)
                    ));
                }
            }

            parent::save($project, $uri, $template, $variables);
            $this->sanitizeGeneratedFile($project, $uri);
        }

        private function replaceTraitMemberOwner(array $members, ClassReflection $class): array
        {
            foreach ($members as $name => $member) {
                if ($member->getClass()->getNamespace() !== 'JapaneseDate\Traits') {
                    continue;
                }

                $members[$name] = clone $member;
                $members[$name]->setClass($class);
            }

            return $members;
        }

        private function moveDocumentedExceptions(array $classes, array $exceptions): array
        {
            foreach ($classes as $name => $class) {
                if (!self::isDocumentedException($class)) {
                    continue;
                }

                unset($classes[$name]);
                $exceptions[$name] = $class;
            }

            ksort($classes);
            ksort($exceptions);

            return [$classes, $exceptions];
        }

        private function disableHiddenHintLinks(array $members): void
        {
            foreach ($members as $member) {
                $hints = $member->getHint();

                if (!$hints) {
                    continue;
                }

                foreach ($hints as $hint) {
                    if (!$hint->isClass() || !self::isHiddenNamespace($hint->getName()->getNamespace())) {
                        continue;
                    }

                    $hint->setName($hint->getName()->getShortName());
                }
            }
        }

        private function sanitizeGeneratedFile(Project $project, string $uri): void
        {
            $file = $project->getBuildDir() . '/' . $uri;
            $content = file_get_contents($file);

            if ($content === false) {
                return;
            }

            $sanitized = str_replace(
                ['\\JapaneseDate\\Traits\\', 'JapaneseDate\\Traits\\'],
                '',
                $content
            );

            if ($sanitized !== $content) {
                file_put_contents($file, $sanitized);
            }
        }

        private function filterHiddenNamespaces(array $namespaces): array
        {
            return array_values(array_filter(
                $namespaces,
                static fn (string $namespace): bool => !self::isHiddenNamespace($namespace)
            ));
        }

        private static function isHiddenNamespace(?string $namespace): bool
        {
            return in_array($namespace, self::HIDDEN_NAMESPACES, true);
        }

        private static function isHiddenGlobalNamespace(?string $namespace): bool
        {
            return in_array($namespace, self::HIDDEN_GLOBAL_NAMESPACES, true);
        }

        private static function isDocumentedException(ClassReflection $class): bool
        {
            return $class->getNamespace() === 'JapaneseDate\\Exceptions';
        }

        private function sortJapaneseDateMembersFirst(array $members): array
        {
            uasort($members, static function ($left, $right): int {
                return self::memberRank($left) <=> self::memberRank($right);
            });

            return $members;
        }

        private static function memberRank($member): int
        {
            $namespace = $member->getClass()->getNamespace();

            if (str_starts_with($namespace, 'JapaneseDate')) {
                return 0;
            }

            if ($namespace === 'Carbon') {
                return 1;
            }

            return 2;
        }
    }
}
