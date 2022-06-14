<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('vendor')
    ->notPath('bootstrap')
    ->notPath('storage')
    ->name('*.php')
    ->notName('*.blade.php')
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true
        // 'array_syntax' => ['syntax' => 'short'],
        // 'ordered_imports' => ['sort_algorithm' => 'alpha'],
        // 'no_unused_imports' => true,
        // 'space_after_semicolon' => false,
    ])
    ->setFinder($finder);
