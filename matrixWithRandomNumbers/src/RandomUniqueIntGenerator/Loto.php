<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\OutputLogicException;
use Matrix\RandomUniqueIntGenerator;
use Random\RandomException;

final class Loto implements RandomUniqueIntGenerator
{
    private array $loto;
    private int $itemsCount;

    public function __construct(readonly private int $start, readonly private int $end)
    {
        $this->loto = range($this->start, $this->end);
        $this->itemsCount = $this->end - $this->start +1;
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
            $current = random_int(0, count($this->loto) - 1);

            $number = $this->loto[$current];
            unset($this->loto[$current]);
            $this->loto = array_values($this->loto);
            yield $number;
        }
    }
}
