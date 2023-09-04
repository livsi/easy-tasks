<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator;

final class Loto implements RandomUniqueIntGenerator
{
    private const MAX_ARRAY_ITEMS = 1073741822;
    private array $loto;
    private int $itemsCount;

    /**
     * @throws RandomUniqueIntegerGeneratorLogicException
     *
     * @internal
     */
    public function __construct(
        readonly private int $min,
        readonly private int $max
    ) {
        $this->loto = range($this->min, $this->max);
        $this->itemsCount = $this->max - $this->min + 1;
    }

    /**
     * @throws \Exception
     */
    public function getNumber(): iterable
    {
        for ($i = 0; $i < $this->itemsCount; ++$i) {
            $current = random_int(0, count($this->loto) - 1);

            $number = $this->loto[$current];
            unset($this->loto[$current]);
            $this->loto = array_values($this->loto);
            yield $number;
        }
    }
}
