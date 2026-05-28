<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor');

$rules = [
    '@PSR12' => true,

    'single_quote' => true,
    'single_line_comment_style' => [
        'comment_types' => ['hash'],
    ],
    'lowercase_cast' => true,

    'no_blank_lines_after_class_opening' => true,
    'no_blank_lines_after_phpdoc' => true,
    'new_with_braces' => true,
    // 'single_blank_line_before_namespace' => true,

    'no_empty_statement' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            'break',
            'continue',
            'return',
            'throw',
            'use',
            'parenthesis_brace_block',
            'square_brace_block',
            'curly_brace_block',
        ],
    ],
    'declare_equal_normalize' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],

    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => [
            '=>' => 'align',
        ],
    ],

    'no_leading_namespace_whitespace' => true,
    'ternary_to_null_coalescing' => true,
    'unary_operator_spaces' => true,
    'cast_spaces' => true,
    'ternary_operator_spaces' => true,
    'trim_array_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    'function_typehint_space' => true,
    'object_operator_without_whitespace' => true,
    'braces' => [
        'allow_single_line_closure' => false,
        'position_after_anonymous_constructs' => 'same',
        'position_after_control_structures' => 'same',
        'position_after_functions_and_oop_constructs' => 'next',
    ],
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'continue',
            'declare',
            'return',
            'throw',
            'try',
        ],
    ],
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'one',
            'method' => 'one',
            'property' => 'one',
            'trait_import' => 'one',
            'case' => 'one', // PHP 8.1+ の enum の場合
        ],
    ],
    'blank_line_after_namespace' => true,
    'blank_line_between_import_groups' => true,
];

return (new PhpCsFixer\Config())
    ->setRules($rules)
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');