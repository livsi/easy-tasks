<?php

declare(strict_types=1);

namespace Matrix\Test\Unit\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator\Shift;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Shift::class)]
class ShiftTest extends TestCase
{
    public function testGetNumber(): void
    {
        $randomizer = new FakeRandomizer();
        $randomizer->setInt(1);
        $shift = new Shift($randomizer, 0, 10);

        $result = [];
        foreach ($shift->getNumber() as $num => $item) {
            $randomizer->setInt($num % 2);
            $result[] = $item;
            if ($num >= 4) {
                break;
            }
        }
        self::assertEquals([1, 0, 2, 3, 4], $result);
    }
}
