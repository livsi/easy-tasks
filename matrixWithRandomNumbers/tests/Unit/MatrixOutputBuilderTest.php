<?php

declare(strict_types=1);

namespace Matrix\Test\Unit;

use Matrix\MatrixOutputBuilder;
use Matrix\RandomUniqueIntGenerator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MatrixOutputBuilder::class)]
class MatrixOutputBuilderTest extends TestCase
{
    public static function casesSuccess(): iterable
    {
        $one2one =
<<<EOF
-----
| 1 |
-----

EOF;

        yield [$one2one, null, [1, 1, 1], 1, 1, 1];

        $one2three =
<<<EOF
-------------------
| 1   | 2   | 3   |
-------------------

EOF;

        yield [$one2three, null,  [1, 2, 3], 3, 1, 3];
        yield [null, \InvalidArgumentException::class, [1, 2, 3], -3, -3, 3];
    }

    #[DataProvider('casesSuccess')]
    public function testGetResultSuccess($expectedResult, $expectedException, $uniqueRandOutput, $columnsCount, $rowsCount, $innerWidth): void
    {
        $uniqueRand = $this->createMock(RandomUniqueIntGenerator::class);
        $uniqueRand->method('getNumber')->willReturn($uniqueRandOutput);
        if ($expectedException) {
            self::expectException($expectedException);
        }
        $outputBuilder = new MatrixOutputBuilder($uniqueRand, $columnsCount, $rowsCount, $innerWidth);
        $actualResult = $outputBuilder->getResult();
        self::assertEquals($expectedResult, $actualResult);
    }
}
