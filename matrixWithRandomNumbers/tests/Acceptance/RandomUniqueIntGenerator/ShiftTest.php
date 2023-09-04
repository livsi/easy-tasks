<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator\Shift;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class ShiftTest extends TestCase
{
    #[DataProviderExternal(GeneratorInitializeDataProvider::class, 'invalidProperties')]
    public function testExceptionalOnCreate($min, $max, $expectExc): void
    {
        $this->expectException($expectExc);
        new Shift($min, $max);
    }
}
