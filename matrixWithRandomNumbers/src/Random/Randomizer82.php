<?php

declare(strict_types=1);

namespace Matrix\Random;

use Random\Engine\Mt19937;
use Random\Randomizer as RandomizerPhp82;

class Randomizer82 implements Randomizer
{
    private RandomizerPhp82 $randomizer;

    public function __construct()
    {
        $this->randomizer = new RandomizerPhp82(new Mt19937());
    }

    public function getInt(int $min, int $max): int
    {
        return $this->randomizer->getInt($min, $max);
    }

    public function shuffleArray(array $array): array
    {
        return $this->randomizer->shuffleArray($array);
    }
}
