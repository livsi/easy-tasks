<?php

declare(strict_types=1);

namespace App\Test\Unit;

use App\SimpleFormatter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(SimpleFormatter::class)]
class SimpleFormatterTest extends TestCase
{
    public static function cases():iterable
    {
        yield 'empty'=>[[], "\n"];
        yield '1 element'=>[[3], "3\n"];
        yield '3 element'=>[[1, 2, 3], "1 2 3\n"];
        yield 'string element'=>[['foo', 'bar'], "foo bar\n"];
    }

    #[DataProvider('cases')]
    public function testFormat(array $input, string $expected)
    {
        $formatter = (new SimpleFormatter())();

        self::assertEquals($expected, $formatter($input));
    }


}
