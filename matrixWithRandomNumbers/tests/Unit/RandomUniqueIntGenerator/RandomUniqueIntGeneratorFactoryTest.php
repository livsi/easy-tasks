<?php

declare(strict_types=1);

namespace Matrix\Test\Unit\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(RandomUniqueIntGeneratorFactory::class)]
class RandomUniqueIntGeneratorFactoryTest extends TestCase
{
    #[DataProvider('cases')]
    public function testCreate($type, int $min, mixed $max, ?string $expectException): void
    {
        $factory = new RandomUniqueIntGeneratorFactory();
        if ($expectException) {
            $this->expectException($expectException);
        }

        $result = $factory->create($type, $min, $max);
        self::assertTrue(method_exists($result, 'getNumber'));
    }

    public static function cases(): iterable
    {
        foreach (GeneratorType::cases() as $type) {
            yield 'max < min:'.$type->name => [$type, 0, -1, RandomUniqueIntegerGeneratorLogicException::class];
            yield 'out of range int:'.$type->name => [$type, 0, PHP_INT_MAX + 1, \TypeError::class];
            yield 'max range int:'.$type->name => [$type, 0, 1073741823, RandomUniqueIntegerGeneratorLogicException::class];
            yield 'normal:'.$type->name => [$type, 0, 10, null];
        }
    }
}
