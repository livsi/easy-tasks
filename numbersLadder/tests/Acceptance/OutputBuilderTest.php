<?php

declare(strict_types=1);

namespace App\Test\Acceptance;

use App\OutputBuilder;
use App\SimpleFormatter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(OutputBuilder::class)]
#[UsesClass(SimpleFormatter::class)]
class OutputBuilderTest extends TestCase
{
    public static function cases(): iterable
    {
        yield '1 item' => [1, 1, "1\n"];
        yield '3 items' => [1, 3, "1\n2 3\n"];
        yield '7 items' => [1, 7, "1\n2 3\n4 5 6\n7\n"];
        yield '3 items in reverse order' => [3, 1, "3\n2 1\n"];
    }

    #[DataProvider('cases')]
    public function testGetResult(int $start, int $end, $expected): void
    {
        self::assertEquals($expected, (new OutputBuilder())->getResult($start, $end, (new SimpleFormatter())()));
    }
}
