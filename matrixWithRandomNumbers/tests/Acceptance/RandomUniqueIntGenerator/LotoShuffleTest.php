<?php

declare(strict_types=1);

namespace Matrix\Test\Acceptance\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntGenerator\LotoShuffle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertLessThanOrEqual;

#[CoversClass(LotoShuffle::class)]
class LotoShuffleTest extends TestCase
{
    public function testSuccessGetNumber(): void
    {
        $start = 1;
        $end = 10000;
        $loto = new LotoShuffle($start, $end);
        foreach ($loto->getNumber() as $number) {
            assertGreaterThanOrEqual($start, $number);
            assertLessThanOrEqual($end, $number);
        }
    }

    #[DataProviderExternal(GeneratorInitializeDataProvider::class, 'invalidProperties')]
    #[DataProviderExternal(GeneratorInitializeDataProvider::class, 'outRange')]
    public function testExceptionalOnCreate($min, $max, $expectExc): void
    {
        $this->expectException($expectExc);
        new LotoShuffle($min, $max);
    }
}
