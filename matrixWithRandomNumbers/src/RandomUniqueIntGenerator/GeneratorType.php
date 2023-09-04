<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

use \InvalidArgumentException;

enum GeneratorType: string
{
    case LOTO = Loto::class;
    case LOTO_SHUFFLE = LotoShuffle::class;
    case SHIFT = Shift::class;

    public static function tryFromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if (strtolower($case->name) === $name){
                return  $case;
            }
        }

        throw new InvalidArgumentException("Name $name not exist");
    }
}
