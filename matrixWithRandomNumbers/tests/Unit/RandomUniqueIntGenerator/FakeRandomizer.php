<?php

declare(strict_types=1);

namespace Matrix\Test\Unit\RandomUniqueIntGenerator;

use Matrix\Random\Randomizer;

class FakeRandomizer implements Randomizer
{
    private int $int;

    public function setInt(int $int): self
    {
        $this->int = $int;

        return $this;
    }

    public function getInt(int $min, int $max): int
    {
        return $this->int;
    }

    public function shuffleArray(array $array): array
    {
        return $array;
    }
}
