<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator\Loto;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertLessThanOrEqual;

#[CoversClass(Loto::class)]
final class LotoTest extends TestCase
{
    public function testSuccessGetNumber(): void
    {
        $start = 1;
        $end = 10000;
        $loto = new Loto($start, $end);
        foreach ($loto->getNumber() as $number) {
            assertGreaterThanOrEqual($start, $number);
            assertLessThanOrEqual($end, $number);
        }
    }
}
