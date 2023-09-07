<?php

declare(strict_types=1);

namespace Matrix\Test\Unit\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator\Loto;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Loto::class)]
class LotoTest extends TestCase
{
    public function testGetNumber(): void
    {
        $randomizer = new FakeRandomizer();
        $randomizer->setInt(1);
        $loto = new Loto($randomizer, 0, 10);

        $result = [];
        foreach ($loto->getNumber() as $num => $item) {
            $result[] = $item;
            if ($num >= 4) {
                break;
            }
        }
        self::assertEquals([1, 2, 3, 4, 5], $result);
    }
}
