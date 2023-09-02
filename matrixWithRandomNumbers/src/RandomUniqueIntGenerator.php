<?php

declare(strict_types=1);

namespace Matrix;

interface RandomUniqueIntGenerator
{
    public function getNumber(): iterable;
}
