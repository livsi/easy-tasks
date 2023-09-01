<?php

declare(strict_types=1);

namespace App;

use Closure;

class SimpleFormatter
{
    public function __construct(
        private readonly string $separator = " ",
        private readonly string $linefeed = "\n"
    )
    {
    }

    public function __invoke(): Closure
    {
        return function(array $items){
            return ltrim(implode($this->separator, $items)) . $this->linefeed;
        };
    }
}
