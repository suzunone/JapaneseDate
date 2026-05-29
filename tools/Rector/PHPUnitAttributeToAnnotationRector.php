<?php

declare(strict_types=1);

namespace JapaneseDateRector;

use PhpParser\Node;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * PHPUnit 10+ の PHP Attribute を PHPUnit 9 互換のアノテーションに変換するカスタム Rector ルール
 */
final class PHPUnitAttributeToAnnotationRector extends AbstractRector
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly DocBlockUpdater $docBlockUpdater,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Convert PHPUnit 10+ attributes to PHPUnit 9 compatible docblock annotations',
            [
                new CodeSample(
                    '#[DataProvider(\'dataProvider\')]' . "\n" . 'public function test(): void {}',
                    '/** @dataProvider dataProvider */' . "\n" . 'public function test(): void {}'
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class, ClassMethod::class];
    }

    /**
     * @param Class_|ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        $changed = false;
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);

        foreach ($node->attrGroups as $groupKey => $attrGroup) {
            foreach ($attrGroup->attrs as $attrKey => $attribute) {
                $annotation = $this->convertAttributeToAnnotation($attribute);
                if ($annotation === null) {
                    continue;
                }

                [$tag, $value] = $annotation;
                $phpDocInfo->addPhpDocTagNode(
                    new PhpDocTagNode('@' . $tag, new GenericTagValueNode($value))
                );
                $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

                unset($attrGroup->attrs[$attrKey]);
                $changed = true;
            }

            if ($attrGroup->attrs === []) {
                unset($node->attrGroups[$groupKey]);
            }
        }

        return $changed ? $node : null;
    }

    /**
     * @return array{string, string}|null
     */
    private function convertAttributeToAnnotation(Attribute $attribute): ?array
    {
        $attributeMap = [
            'PHPUnit\\Framework\\Attributes\\DataProvider'       => fn () => ['dataProvider', $this->extractStringArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\Depends'            => fn () => ['depends', $this->extractStringArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\DependsExternal'    => fn () => ['depends', $this->extractStringArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\RunInSeparateProcess' => fn () => ['runInSeparateProcess', ''],
            'PHPUnit\\Framework\\Attributes\\CodeCoverageIgnore' => fn () => ['codeCoverageIgnore', ''],
            'PHPUnit\\Framework\\Attributes\\PreserveGlobalState' => fn () => ['preserveGlobalState', $this->extractBoolArg($attribute, 0) ? 'enabled' : 'disabled'],
            'PHPUnit\\Framework\\Attributes\\CoversClass'        => fn () => ['covers', $this->extractClassArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\CoversTrait'        => fn () => ['covers', $this->extractClassArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\CoversMethod'       => fn () => ['covers', $this->extractClassArg($attribute, 0) . '::' . $this->extractStringArg($attribute, 1)],
            'PHPUnit\\Framework\\Attributes\\UsesClass'          => fn () => ['uses', $this->extractClassArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\UsesTrait'          => fn () => ['uses', $this->extractClassArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\Group'              => fn () => ['group', $this->extractStringArg($attribute, 0)],
            'PHPUnit\\Framework\\Attributes\\Large'              => fn () => ['large', ''],
            'PHPUnit\\Framework\\Attributes\\Medium'             => fn () => ['medium', ''],
            'PHPUnit\\Framework\\Attributes\\Small'              => fn () => ['small', ''],
            'PHPUnit\\Framework\\Attributes\\Test'               => fn () => ['test', ''],
            'PHPUnit\\Framework\\Attributes\\Before'             => fn () => ['before', ''],
            'PHPUnit\\Framework\\Attributes\\After'              => fn () => ['after', ''],
            'PHPUnit\\Framework\\Attributes\\BeforeClass'        => fn () => ['beforeClass', ''],
            'PHPUnit\\Framework\\Attributes\\AfterClass'         => fn () => ['afterClass', ''],
            'PHPUnit\\Framework\\Attributes\\DoesNotPerformAssertions' => fn () => ['doesNotPerformAssertions', ''],
            'PHPUnit\\Framework\\Attributes\\RunTestsInSeparateProcesses' => fn () => ['runTestsInSeparateProcesses', ''],
            'PHPUnit\\Framework\\Attributes\\CoversNothing'      => fn () => ['coversNothing', ''],
        ];

        foreach ($attributeMap as $fqcn => $factory) {
            if ($this->isName($attribute->name, $fqcn)) {
                return $factory();
            }
        }

        return null;
    }

    private function extractStringArg(Attribute $attribute, int $index): string
    {
        $arg = $attribute->args[$index] ?? null;
        if ($arg === null) {
            return '';
        }

        if ($arg->value instanceof String_) {
            return $arg->value->value;
        }

        return '';
    }

    private function extractBoolArg(Attribute $attribute, int $index): bool
    {
        $arg = $attribute->args[$index] ?? null;
        if ($arg === null) {
            return true;
        }

        if ($arg->value instanceof ConstFetch) {
            return strtolower($arg->value->name->toString()) !== 'false';
        }

        return true;
    }

    private function extractClassArg(Attribute $attribute, int $index): string
    {
        $arg = $attribute->args[$index] ?? null;
        if ($arg === null) {
            return '';
        }

        $value = $arg->value;
        if (! $value instanceof ClassConstFetch) {
            return '';
        }

        if (! $value->name instanceof Identifier || $value->name->toString() !== 'class') {
            return '';
        }

        $class = $value->class;
        if (! $class instanceof Name) {
            return '';
        }

        $className = $class->toString();

        if ($class instanceof FullyQualified) {
            return '\\' . $className;
        }

        return $className;
    }
}
