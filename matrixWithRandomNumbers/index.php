#!/usr/bin/env php
<?php

declare(strict_types=1);

use Matrix\OutputBuilder;
use Matrix\RandomUniqueIntGenerator\LotoShuffle;

require __DIR__.'/../vendor/autoload.php';

const HELP = <<<EOF
Matrix generator unique random number 

params: command START_RND_INT END_RND_INT COLUMNS_COUNT ROWS_COUNT INNER_WIDTH

EOF;
if ('help' === $argv[1]) {
    echo HELP;
    exit(0);
}

$start = (int) $argv[1] ?: 1;
$end = (int) $argv[2] ?: 1000;
$columns = (int) $argv[3] ?: 5;
$rows = (int) $argv[4] ?: 7;
$innerWidth = (int) $argv[5] ?: 4;

try {
    echo (new OutputBuilder(
        uniqueRand: new LotoShuffle($start, $end),
        columnsCount: $columns,
        rowsCount: $rows,
        innerWidth: $innerWidth)
    )->getResult();
} catch (Exception $e) {
    echo 'ERROR!: '.$e->getMessage()."\n".HELP;

    exit(1);
}
