<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['bin', 'database', 'fix'])
    ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'trim_array_spaces' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_whitespace_in_blank_line' => true,
        'no_useless_return' => true,
        'no_unused_imports' => true,
        'phpdoc_trim' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag' => true,
        'line_ending' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setLineEnding("\r\n")
    ->setFinder($finder);
