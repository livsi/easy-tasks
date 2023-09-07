<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\Random\RandomizerInsecure;
use Matrix\RandomUniqueIntGenerator\Loto;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use PHPUnit\Metadata\IgnoreClassForCodeCoverage;

use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertLessThanOrEqual;

#[CoversClass(Loto::class)]
#[UsesClass(RandomizerInsecure::class)]
#[IgnoreClassForCodeCoverage(1, RandomizerInsecure::class)]
final class LotoTest extends TestCase
{
    public function testSuccessGetNumber(): void
    {
        $start = 1;
        $end = 1000;
        $loto = new Loto(new RandomizerInsecure(), $start, $end);
        foreach ($loto->getNumber() as $number) {
            assertGreaterThanOrEqual($start, $number);
            assertLessThanOrEqual($end, $number);
        }
    }
}
