<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setRules([
        // Base ruleset - PER Coding Style 2.0 (latest PHP-FIG standard)
        '@PER-CS2.0' => true,
        '@PER-CS2.0:risky' => true,

        // Strict types
        'declare_strict_types' => true,
        'strict_param' => true,

        // Import rules
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => false,
            'import_functions' => false,
        ],
        'no_unused_imports' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],

        // Array rules
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters', 'match'],
        ],

        // Phpdoc rules
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_order' => true,
        'phpdoc_separation' => true,
        'phpdoc_summary' => true,
        'phpdoc_trim' => true,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
        'no_superfluous_phpdoc_tags' => [
            'allow_mixed' => true,
            'remove_inheritdoc' => true,
        ],

        // Class rules
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'one',
                'method' => 'one',
                'property' => 'one',
            ],
        ],
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'case',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method_public',
                'method_protected',
                'method_private',
            ],
        ],
        'self_accessor' => true,

        // Function rules
        'void_return' => true,
        'native_function_invocation' => [
            'include' => ['@compiler_optimized'],
            'scope' => 'namespaced',
            'strict' => true,
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],

        // Operator rules
        'concat_space' => ['spacing' => 'one'],
        'operator_linebreak' => [
            'only_booleans' => true,
            'position' => 'beginning',
        ],

        // Control structure rules
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],

        // Whitespace rules
        'blank_line_before_statement' => [
            'statements' => [
                'return',
                'throw',
                'try',
            ],
        ],
        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'throw',
                'use',
            ],
        ],

        // Comment rules
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],

        // Misc
        'no_useless_else' => true,
        'no_useless_return' => true,
        'simplified_if_return' => true,
        'simplified_null_return' => true,
    ])
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
