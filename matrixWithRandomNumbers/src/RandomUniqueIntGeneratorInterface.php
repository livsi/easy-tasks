<?php

declare(strict_types=1);

namespace Matrix;

interface RandomUniqueIntGeneratorInterface
{
    public function getNumber(int $itemsCount): iterable;
}
