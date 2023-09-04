#!/usr/bin/env php
<?php

declare(strict_types=1);

use Matrix\OutputBuilder;
use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;

require __DIR__.'/../vendor/autoload.php';

const HELP = <<<EOF
Matrix generator unique random number 

params: command START_RND_INT END_RND_INT COLUMNS_COUNT ROWS_COUNT INNER_WIDTH

EOF;
if ('help' === $argv[1]) {
    echo HELP;
    exit(0);
}

$generator = $argv[1] ?: 'LOTO';
$min = (int) $argv[2] ?: 1;
$max = (int) $argv[3] ?: 1000;
$columns = (int) $argv[4] ?: 5;
$rows = (int) $argv[5] ?: 7;
$innerWidth = (int) $argv[6] ?: 4;

try {
    echo (new OutputBuilder(
        uniqueRand: ( new RandomUniqueIntGeneratorFactory())->create(GeneratorType::tryFromName(strtolower($generator)), $min, $max),
        columnsCount: $columns,
        rowsCount: $rows,
        innerWidth: $innerWidth)
    )->getResult();
} catch (Exception $e) {
    echo 'ERROR!: '.$e->getMessage()."\n".HELP;

    exit(1);
}
