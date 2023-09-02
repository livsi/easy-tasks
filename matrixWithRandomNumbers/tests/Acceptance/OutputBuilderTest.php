<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance;

use Matrix\OutputBuilder;
use Matrix\RandomUniqueIntGenerator;
use PHPUnit\Framework\TestCase;

class OutputBuilderTest extends TestCase
{
    public function testGetResult(): void
    {
        $outputBuilder = new OutputBuilder($this->createMock(RandomUniqueIntGenerator::class), 1, 1, 1);
        $outputBuilder->getResult();
        self::markTestIncomplete('TBD');
    }
}
