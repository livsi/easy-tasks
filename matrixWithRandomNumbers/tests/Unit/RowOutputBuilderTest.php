<?php

declare(strict_types=1);

namespace Matrix\Test\Unit;

use Matrix\RandomUniqueIntGenerator;
use Matrix\RowOutputBuilder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(RowOutputBuilder::class)]
class RowOutputBuilderTest extends TestCase
{
    public static function cases(): iterable
    {
        yield 'five 1 without delimiter' => ['11111'."\n", [1, 1, 1, 1, 1], 5, ''];
        yield 'five 1..5 range with space delimeter' => ['1 2 3 4 5'."\n", range(1, 5), 5, ' '];
        yield 'six 1..6 range with emoji delimeter' => ['1🤣2🤣3🤣4🤣5🤣6'."\n", range(1, 6), 6, '🤣'];
    }

    public static function casesErrored(): iterable
    {
        yield 'out of range itemsCount' => [\TypeError::class, ['a', 'b'], PHP_INT_MAX + 1, ''];
        yield 'itemsCount' => [\InvalidArgumentException::class, ['a', 'b'], -1, ''];
    }

    #[DataProvider('cases')]
    public function testGetResultSuccess($expectedResult, $uniqueRandOutput, $itemsCount, $delimiter): void
    {
        $uniqueRand = $this->createMock(RandomUniqueIntGenerator::class);
        $uniqueRand->method('getNumber')->willReturn($uniqueRandOutput);
        $builder = new RowOutputBuilder($uniqueRand, $itemsCount, $delimiter);

        self::assertEquals($expectedResult, $builder->getResult());
    }

    #[DataProvider('casesErrored')]
    public function testGetResultErrored($expectedException, $uniqueRandOutput, $itemsCount, $delimiter): void
    {
        $uniqueRand = $this->createMock(RandomUniqueIntGenerator::class);
        $uniqueRand->method('getNumber')->willReturn($uniqueRandOutput);
        self::expectException($expectedException);
        $builder = new RowOutputBuilder($uniqueRand, $itemsCount, $delimiter);
    }
}
