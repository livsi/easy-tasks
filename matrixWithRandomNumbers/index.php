#!/usr/bin/env php
<?php

declare(strict_types=1);

use Matrix\MatrixOutputBuilder;
use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;
use Matrix\RowOutputBuilder;

require __DIR__.'/../vendor/autoload.php';

const HELP = <<<EOF

Matrix generator unique random number 

params: algorithm output start_random_int max_random_int matrix_columns_count matrix_rows_count [cell_inner_width]

-------------------------------------------------------------------------------
algorithm(s): [loto | shuffle | shift], default: shuffle
output(s): [matrix | row]
min_random_int: integer
max_random_int: integer, >= min_random_int

for "matrix" output:
    matrix_columns_count: integer
    matrix_rows_count: integer
    cell_inner_width: integer, >=length(mix_random_int) && >=length(max_random_int)

for "row" output:
    items_count: integer
    delimiter: string, default " "
-------------------------------------------------------------------------------

EOF;
if ('help' === $argv[1]) {
    echo HELP;
    exit(0);
}
$generator = strtolower($argv[1] ?? 'LOTO');
$output = strtolower($argv[2] ?? 'matrix');
$min = (int) ($argv[3] ?? 1);
$max = (int) ($argv[4] ?? 1000);

$uniqueRand = ( new RandomUniqueIntGeneratorFactory())->create(GeneratorType::tryFromName($generator), $min, $max);

try {
    switch ($output) {
        case 'matrix':
            $columns = (int) ($argv[5] ?? 5);
            $rows = (int) ($argv[6] ?? 7);

            $defaultInnerWidth = max(strlen((string) $max), strlen((string) $min)) - 1;
            $innerWidth = (int) ($argv[7] ?? $defaultInnerWidth);
            if ($innerWidth < $defaultInnerWidth) {
                echo 'Incorrect param cell_inner_width, mast be more than '.$defaultInnerWidth."\n";
                exit(1);
            }
            echo (new MatrixOutputBuilder(
                uniqueRand: $uniqueRand,
                columnsCount: $columns,
                rowsCount: $rows,
                innerWidth: $innerWidth
            )
            )->getResult();
            break;
        case 'row':
            $itemsCount = (int) ($argv[5] ?? 5);
            $delimiter = $argv[6] ?? ' ';
            echo (new RowOutputBuilder($uniqueRand, $itemsCount, $delimiter))->getResult();
            break;
        default:
            echo 'OutputType '.$output." is not exist\n";
            exit(1);
    }
} catch (Exception $e) {
    echo 'ERROR!: '.$e->getMessage()."\n".HELP;

    exit(1);
}
