<?php

declare(strict_types=1);

namespace Matrix\Test\Unit\RandomUniqueIntGenerator;

use Matrix\Random\RandomizerInsecure;
use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\Loto;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;
use Matrix\RandomUniqueIntGenerator\Shift;
use Matrix\RandomUniqueIntGenerator\Shuffle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RandomUniqueIntGeneratorFactory::class)]
#[CoversClass(Shift::class)]
#[CoversClass(Shuffle::class)]
#[CoversClass(Loto::class)]
#[UsesClass(RandomizerInsecure::class)]
class RandomUniqueIntGeneratorFactoryTest extends TestCase
{
    public static function instances(): iterable
    {
        yield 'shift' => [Shift::class, GeneratorType::SHIFT];
        yield 'loto' => [Loto::class, GeneratorType::LOTO];
        yield 'shuffle' => [Shuffle::class, GeneratorType::SHUFFLE];
    }

    #[DataProvider('instances')]
    public function testCreateSuccess(): void
    {
        $factory = new RandomUniqueIntGeneratorFactory();
        $instance = $factory->create(GeneratorType::SHIFT, new RandomizerInsecure(), 1, 10);

        self::assertInstanceOf(Shift::class, $instance);
    }

    #[DataProvider('cases')]
    public function testCreateErrored($type, int $min, mixed $max, ?string $expectException): void
    {
        $factory = new RandomUniqueIntGeneratorFactory();
        if ($expectException) {
            $this->expectException($expectException);
        }

        $result = $factory->create($type, new RandomizerInsecure(), $min, $max);
        self::assertTrue(method_exists($result, 'getNumber'));
    }

    public static function cases(): iterable
    {
        foreach (GeneratorType::cases() as $type) {
            yield 'max < min:'.$type->name => [$type, 0, -1, RandomUniqueIntegerGeneratorLogicException::class];
            yield 'out of range int:'.$type->name => [$type, 0, PHP_INT_MAX + 1, \TypeError::class];
            yield 'max range int:'.$type->name => [$type, 0, 1073741823, RandomUniqueIntegerGeneratorLogicException::class];
        }
    }
}
