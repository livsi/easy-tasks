<?php

declare(strict_types=1);

use App\OutputBuilder;
use App\SimpleFormatter;

require __DIR__.'/vendor/autoload.php';

echo ltrim((new OutputBuilder())->getResult(1, 100, (new SimpleFormatter())()));
