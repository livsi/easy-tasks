<?php

declare(strict_types=1);

namespace App;

class OutputBuilder
{
    public function getResult(int $start, int $end, \Closure $formatter): string
    {
        $result = '';
        $currentRowItemsCount = 1;
        foreach (range(start: $start, end: $end) as $number) {
            $outputBuffer[] = $number;
            if (count($outputBuffer) === $currentRowItemsCount) {
                $result .= $formatter($outputBuffer);
                $outputBuffer = [];
                ++$currentRowItemsCount;
            }
        }
        if (!empty($outputBuffer)) {
            $result .= $formatter($outputBuffer);
        }

        return $result;
    }
}
