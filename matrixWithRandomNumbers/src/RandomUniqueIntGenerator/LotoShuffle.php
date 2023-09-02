<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator;

final class LotoShuffle implements RandomUniqueIntGenerator
{
    private const MAX_ARRAY_ITEMS = 1073741822;
    private array $loto;
    private int $itemsCount;

    /**
     * @throws RandomUniqueIntegerGeneratorLogicException
     */
    public function __construct(
        readonly private int $min,
        readonly private int $max
    ) {
        $this->itemsCount = $this->max - $this->min + 1;
        if ($this->itemsCount < 1) {
            throw new RandomUniqueIntegerGeneratorLogicException('max can be more than min, an ValueError will be thrown in range func.');
        }
        if ($this->itemsCount > self::MAX_ARRAY_ITEMS) {
            throw new RandomUniqueIntegerGeneratorLogicException('max count of array items'.self::MAX_ARRAY_ITEMS.', an ValueError will be thrown in range func');
        }

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
