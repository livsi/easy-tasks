<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;

class GeneratorInitializeDataProvider
{
    public static function invalidProperties(): iterable
    {
        yield 'max < min' => [0, -1, RandomUniqueIntegerGeneratorLogicException::class];
        yield 'out of range int' => [0, PHP_INT_MAX + 1, \TypeError::class];
    }

    public static function outRange(): iterable
    {
        yield 'max range int' => [0, 1073741823, RandomUniqueIntegerGeneratorLogicException::class];
    }
}
