<?php

declare(strict_types=1);

namespace Matrix;

class RowOutputBuilder implements OutputBuilder
{
    public function __construct(
        readonly private RandomUniqueIntGenerator $uniqueRand,
        readonly private int $itemsCount,
        readonly private string $delimiter
    ) {
        if ($this->itemsCount < 1) {
            throw new \InvalidArgumentException('itemsCount must be >0');
        }
    }

    public function getResult(): string
    {
        $values = [];
        $generator = $this->uniqueRand->getNumber();
        foreach ($generator as $counter => $number) {
            $values[] = $number;
            if ($counter >= $this->itemsCount - 1) {
                break;
            }
        }

        return implode($this->delimiter, $values)."\n";
    }
}
