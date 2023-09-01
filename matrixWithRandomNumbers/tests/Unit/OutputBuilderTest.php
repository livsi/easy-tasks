<?php

declare(strict_types=1);

namespace Matrix\Test\Unit;

use Matrix\OutputBuilder;
use Matrix\RandomUniqueIntGeneratorInterface;
use PHPUnit\Framework\TestCase;

class OutputBuilderTest extends TestCase
{
    public function testGetResult(): void
    {
        $outputBuilder = new OutputBuilder($this->createMock(RandomUniqueIntGeneratorInterface::class), 1, 1, 1);
        $outputBuilder->getResult();
        self::markTestIncomplete('TBD');
    }
}
