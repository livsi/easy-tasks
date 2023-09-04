<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use Matrix\RandomUniqueIntegerGeneratorLogicException;
use Matrix\RandomUniqueIntGenerator;

class RandomUniqueIntGeneratorFactory
{
    private const MAX_ARRAY_ITEMS = 1073741822;

    /**
     * @throws RandomUniqueIntegerGeneratorLogicException
     */
    public function create(GeneratorType $type, int $min, int $max): RandomUniqueIntGenerator
    {
        $itemsCount = $max - $min + 1;
        if ($itemsCount < 1) {
            throw new RandomUniqueIntegerGeneratorLogicException('max can be more than min, an ValueError will be thrown in range func.');
        }
        if ($itemsCount > self::MAX_ARRAY_ITEMS) {
            throw new RandomUniqueIntegerGeneratorLogicException('max count of array items'.self::MAX_ARRAY_ITEMS.', an ValueError will be thrown in range func');
        }
        $class = $type->value;

        return new $class($min, $max);
    }
}
