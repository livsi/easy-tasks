<?php

declare(strict_types=1);

namespace Matrix\Random;

interface Randomizer
{
    public function getInt(int $min, int $max): int;

    public function shuffleArray(array $array): array;
}
