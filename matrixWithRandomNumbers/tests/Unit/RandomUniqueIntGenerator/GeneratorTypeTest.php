<?php

declare(strict_types=1);

namespace Matrix\Test\Unit\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator\GeneratorType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(GeneratorType::class)]
class GeneratorTypeTest extends TestCase
{
    public static function cases()
    {
        yield [GeneratorType::LOTO, null, 'loto'];
        yield [GeneratorType::SHIFT, null, 'shift'];
        yield [null, \InvalidArgumentException::class, 'stolotos'];
    }

    #[DataProvider('cases')]
    public function testTryFromName($expectedResult, $expectedException, $name): void
    {
        $expectedResult ?? self::expectException($expectedException);
        self::assertEquals($expectedResult, GeneratorType::tryFromName($name));
    }
}
