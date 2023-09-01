<?php

declare(strict_types=1);

namespace Matrix;

use Random\RandomException;

class RandomUniqueIntGeneratorWithShift implements RandomUniqueIntGeneratorInterface
{
    private array $alreadyUsedNumbers = [];

    private int $loop = 0;

    private readonly int $itemsCount;

    public function __construct(readonly private int $start, readonly private int $end)
    {
        $this->itemsCount = count(range($this->start, $this->end));
    }

    /**
     * @throws OutputLogicException
     * @throws RandomException
     * @throws \ValueError
     */
    public function getNumber(int $itemsCount): iterable
    {
        if ($this->itemsCount < $itemsCount) {
            throw new OutputLogicException();
        }
        for ($i = 0; $i < $this->itemsCount; ++$i) {
            $current = random_int($this->start, $this->end);
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
        if ($next > $this->end && $this->loop < 2) {
            $next = $this->start;
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
