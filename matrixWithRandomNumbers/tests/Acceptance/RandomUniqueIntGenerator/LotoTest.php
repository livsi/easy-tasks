<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator\Loto;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertLessThanOrEqual;

#[CoversClass(Loto::class)]
final class LotoTest extends TestCase
{
    public function testSuccessGetNumber(): void
    {
        $start = 1;
        $end = 10000;
        $loto = new Loto($start, $end);
        foreach ($loto->getNumber() as $number) {
            assertGreaterThanOrEqual($start, $number);
            assertLessThanOrEqual($end, $number);
        }
    }

    #[DataProvider('invalidProperties')]
    public function testExceptionalOnCreateLoto($min, $max, $expectExc): void
    {
        $this->expectException($expectExc);
        new Loto($min, $max);
    }

    public static function invalidProperties(): iterable
    {
        yield 'max < min' => [0, -1, RandomUniqueIntegerGeneratorLogicException::class];
        yield 'out of range int' => [0, PHP_INT_MAX + 1, \TypeError::class];
        yield 'max range int' => [0, 1073741823, RandomUniqueIntegerGeneratorLogicException::class];
    }
}
