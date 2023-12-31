<?php

declare(strict_types=1);

namespace Matrix;

final class MatrixOutputBuilder implements OutputBuilder
{
    public function __construct(
        readonly private RandomUniqueIntGenerator $uniqueRand,
        readonly private int $columnsCount,
        readonly private int $rowsCount,
        readonly private int $innerWidth
    ) {
        if ($this->columnsCount < 1 || $this->rowsCount < 1) {
            throw new \InvalidArgumentException('rows and columns must be > 0');
        }
    }

    /**
     * @throws \Exception
     */
    public function getResult(): string
    {
        $currColumn = 0;
        $currRow = 0;
        $result = '';
        $generator = $this->uniqueRand->getNumber();
        foreach ($generator as $number) {
            if (($currColumn % $this->columnsCount) === 0) {
                ++$currRow;
                if ($currRow > $this->rowsCount) {
                    break;
                }
                $result .= $this->rowDelimiter($this->columnsCount, 0 === $currColumn);
            }
            $result .= $this->formatCell($number, $this->innerWidth);

            ++$currColumn;
        }

        $result .= $this->rowDelimiter($this->columnsCount);

        return $result;
    }

    private function rowDelimiter(int $width, bool $isFirstLine = false): string
    {
        return ($isFirstLine ? '' : "|\n").str_pad('', $width * ($this->innerWidth + 3) + 1, '-')."\n";
    }

    private function formatCell($number): string
    {
        return str_pad('| '.$number, $this->innerWidth + 3);
    }
}
