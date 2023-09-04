<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator;

final class LotoShuffle implements RandomUniqueIntGenerator
{
    private const MAX_ARRAY_ITEMS = 1073741822;
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
        $this->loto = range($this->min, $this->max);
        shuffle($this->loto);
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
