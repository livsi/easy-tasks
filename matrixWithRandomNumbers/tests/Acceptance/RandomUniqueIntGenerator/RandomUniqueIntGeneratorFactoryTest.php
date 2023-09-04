<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(RandomUniqueIntGeneratorFactory::class)]
class RandomUniqueIntGeneratorFactoryTest extends TestCase
{
    #[DataProvider('invalidProperties')]
    public function testExceptionalCreate($type, int $min, mixed $max, string $expectExc): void
    {
        $factory = new RandomUniqueIntGeneratorFactory();
        $this->expectException($expectExc);
        $factory->create($type, $min, $max);
    }

    public static function invalidProperties(): iterable
    {
        foreach (GeneratorType::cases() as $type) {
            yield 'max < min:'.$type->name => [$type, 0, -1, RandomUniqueIntegerGeneratorLogicException::class];
            yield 'out of range int:'.$type->name => [$type, 0, PHP_INT_MAX + 1, \TypeError::class];
            yield 'max range int:'.$type->name => [$type, 0, 1073741823, RandomUniqueIntegerGeneratorLogicException::class];
        }
    }
}
