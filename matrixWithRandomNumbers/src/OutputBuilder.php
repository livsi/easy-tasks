<?php

declare(strict_types=1);

namespace Matrix;

interface OutputBuilder
{
    public function getResult(): string;
}
