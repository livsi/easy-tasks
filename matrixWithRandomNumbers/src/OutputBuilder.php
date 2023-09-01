<?php

declare(strict_types=1);

namespace Matrix;

readonly class OutputBuilder
{
    public function __construct(private RandomUniqueIntGeneratorInterface $uniqueRand)
    {
    }

    /**
     * @throws \Exception
     */
    public function getResult(int $columnsCount, int $rowsCount, int $innerWidth): string
    {
        $currColumn = 0;
        $currRow = 0;
        $result = '';
        $generator = $this->uniqueRand->getNumber($columnsCount * $rowsCount);
        foreach ($generator as $number) {
            if (($currColumn % $columnsCount) === 0) {
                ++$currRow;
                if ($currRow > $rowsCount) {
                    break;
                }
                $result .= $this->rowDelimiter($columnsCount, $innerWidth, 0 === $currColumn);
            }
            $result .= str_pad('| '.$number, $innerWidth + 3);

            ++$currColumn;
        }

        $result .= $this->rowDelimiter($columnsCount, $innerWidth);

        return $result;
    }

    public function rowDelimiter(int $width, int $innerWidth, bool $isFirstLine = false): string
    {
        return ($isFirstLine ? '' : "|\n").str_pad('', $width * ($innerWidth + 3) + 1, '-')."\n";
    }
}
