<?php

declare(strict_types=1);

namespace Matrix\Random;

class RandomizerSecure implements Randomizer
{
    public function getInt(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    /**
     * Does not generate cryptographically secure values
     * in php < 8.2 not exist other variants of this functionality.
     */
    public function shuffleArray(array $array): array
    {
        shuffle($array);

        return $array;
    }
}
