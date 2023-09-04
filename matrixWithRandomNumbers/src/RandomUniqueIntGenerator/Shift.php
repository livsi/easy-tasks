<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator;

final class Shift implements RandomUniqueIntGenerator
{
    private array $alreadyUsedNumbers = [];

    private int $loop = 0;

    private readonly int $itemsCount;

    /**
     * @internal
     */
    public function __construct(readonly private int $min, readonly private int $max)
    {
        $this->itemsCount = $this->max - $this->min + 1;
    }

    /**
     * @throws RandomUniqueIntegerGeneratorLogicException
     * @throws \ValueError
     */
    public function getNumber(): iterable
    {
        for ($i = 0; $i < $this->itemsCount; ++$i) {
            $current = rand($this->min, $this->max);
            if (in_array($current, $this->alreadyUsedNumbers, true)) {
                $current = $this->shiftToNext($current);
            } else {
                $this->alreadyUsedNumbers[] = $current;
            }
            yield $current;
        }
    }

    private function shiftToNext(int $current): ?int
    {
        $next = $current + 1;
        if ($next > $this->max && $this->loop < 2) {
            $next = $this->min;
            ++$this->loop;
        }
        if (2 === $this->loop) {
            return null;
        }

        if (in_array($next, $this->alreadyUsedNumbers, true)) {
            return $this->shiftToNext($next);
        } else {
            $this->alreadyUsedNumbers[] = $next;
            $this->loop = 0;

            return $next;
        }
    }
}
