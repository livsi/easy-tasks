<?php

declare(strict_types=1);

namespace Matrix\Random;

class RandomizerInsecure implements Randomizer
{
    public function getInt(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    public function shuffleArray(array $array): array
    {
        shuffle($array);

        return $array;
    }
}
