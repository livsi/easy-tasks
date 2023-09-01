<?php

declare(strict_types=1);

use Matrix\OutputBuilder;
use Matrix\RandomUniqueIntGeneratorWithShift;

require __DIR__.'/../vendor/autoload.php';

try {
    echo (new OutputBuilder(
        uniqueRand: new RandomUniqueIntGeneratorWithShift(1, 1000),
        columnsCount: 5,
        rowsCount: 7,
        innerWidth: 4)
    )->getResult();
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}
