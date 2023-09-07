<?php

declare(strict_types=1);

namespace Matrix\Test\Benchmark;

use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;
use PhpBench\Attributes as Bench;

class RandomUniqueIntGeneratorCompareBench
{
    private const REV = [100, 500, 1000];
    private const ITER = 10;

    #[Bench\Revs(self::REV)]
    #[Bench\Iterations(self::ITER)]
    public function benchLoto(): void
    {
        $this->run(GeneratorType::LOTO);
    }

    #[Bench\Revs(self::REV)]
    #[Bench\Iterations(self::ITER)]
    public function benchShuffle(): void
    {
        $this->run(GeneratorType::SHUFFLE);
    }

    #[Bench\Revs(self::REV)]
    #[Bench\Iterations(self::ITER)]
    public function benchShift(): void
    {
        $this->run(GeneratorType::SHIFT);
    }

    private function run(GeneratorType $type): void
    {
        (new RandomUniqueIntGeneratorFactory())->create($type, 1, 10000)->getNumber();
    }
}
