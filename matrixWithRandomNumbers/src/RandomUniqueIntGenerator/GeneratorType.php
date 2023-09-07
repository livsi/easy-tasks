<?php

declare(strict_types=1);

namespace Matrix\RandomUniqueIntGenerator;

enum GeneratorType: string
{
    case LOTO = Loto::class;
    case SHUFFLE = Shuffle::class;
    case SHIFT = Shift::class;

    public static function tryFromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if (strtolower($case->name) === $name) {
                return $case;
            }
        }

        throw new \InvalidArgumentException("Name $name not exist");
    }
}
