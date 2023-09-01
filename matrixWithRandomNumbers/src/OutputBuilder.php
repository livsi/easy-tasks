<?php

declare(strict_types=1);

namespace Matrix;

readonly class OutputBuilder
{
    public function __construct(
        private RandomUniqueIntGeneratorInterface $uniqueRand,
        private int $columnsCount,
        private int $rowsCount,
        private int $innerWidth
    ) {
    }

    /**
     * @throws \Exception
     */
    public function getResult(): string
    {
        $currColumn = 0;
        $currRow = 0;
        $result = '';
        $generator = $this->uniqueRand->getNumber($this->columnsCount * $this->rowsCount);
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
