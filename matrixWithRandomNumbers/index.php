<?php

declare(strict_types=1);

use Matrix\OutputBuilder;
use Matrix\RandomUniqueIntGeneratorWithShift;

require __DIR__.'/../vendor/autoload.php';

try {
    echo (new OutputBuilder(new RandomUniqueIntGeneratorWithShift(1, 1000)))->getResult(5, 7, 4);
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}
