<?php

declare(strict_types=1);

namespace Matrix\Test\Benchmark;

use Matrix\RandomUniqueIntGenerator\GeneratorType;
use Matrix\RandomUniqueIntGenerator\RandomUniqueIntGeneratorFactory;
use PhpBench\Attributes as Bench;

class RandomUniqueIntGeneratorCompareBench
{
    private const REV = 999;
    private const ITER = 100;

    #[Bench\Revs(self::REV)]
    #[Bench\Iterations(self::ITER)]
    #[Bench\RetryThreshold(20.0)]
    public function benchLoto(): void
    {
        $this->run(GeneratorType::LOTO);
    }

    #[Bench\Revs(self::REV)]
    #[Bench\Iterations(self::ITER)]
    #[Bench\RetryThreshold(20.0)]
    public function benchLotoShuffle(): void
    {
        $this->run(GeneratorType::SHUFFLE);
    }

    #[Bench\Revs(self::REV)]
    #[Bench\Iterations(self::ITER)]
    #[Bench\RetryThreshold(20.0)]
    public function benchShift(): void
    {
        $this->run(GeneratorType::SHIFT);
    }

    private function run(GeneratorType $type): void
    {
        (new RandomUniqueIntGeneratorFactory())->create($type, 1, 10000)->getNumber();
    }
}
