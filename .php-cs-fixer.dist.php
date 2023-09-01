<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->exclude('**vendor')
    ->in(__DIR__."/numbersLadder")
    ->in(__DIR__."/matrixWithRandomNumbers")
;

$config = new PhpCsFixer\Config;

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PHP80Migration:risky' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder);