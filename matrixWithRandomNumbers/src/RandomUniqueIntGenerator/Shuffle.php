<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator;
use Random\Randomizer;

final class Shuffle implements RandomUniqueIntGenerator
{
    private array $loto;
    private int $itemsCount;

    /**
     * @internal
     */
    public function __construct(
        readonly private int $min,
        readonly private int $max
    ) {
        $this->itemsCount = $this->max - $this->min + 1;

        $this->loto = (new Randomizer())->shuffleArray(range($this->min, $this->max));
    }

    /**
     * @throws \Exception
     */
    public function getNumber(): iterable
    {
        for ($i = 0; $i < $this->itemsCount; ++$i) {
            yield $this->loto[$i];
        }
    }
}
