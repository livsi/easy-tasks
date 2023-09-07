<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\Random\RandomizerInsecure;
use Matrix\RandomUniqueIntGenerator\Shuffle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertLessThanOrEqual;

#[CoversClass(Shuffle::class)]
#[UsesClass(RandomizerInsecure::class)]
#[IgnoreClassForCodeCoverage(RandomizerInsecure::class)]
class ShuffleTest extends TestCase
{
    public function testSuccessGetNumber(): void
    {
        $start = 1;
        $end = 1000;
        $loto = new Shuffle(new RandomizerInsecure(), $start, $end);
        foreach ($loto->getNumber() as $number) {
            assertGreaterThanOrEqual($start, $number);
            assertLessThanOrEqual($end, $number);
        }
    }
}
