<?php

declare(strict_types=1);

namespace App;

class SimpleFormatter
{
    public function __construct(
        private readonly string $separator = ' ',
        private readonly string $linefeed = "\n"
    ) {
    }

    public function __invoke(): \Closure
    {
        return fn (array $items) => ltrim(implode($this->separator, $items)).$this->linefeed;
    }
}
