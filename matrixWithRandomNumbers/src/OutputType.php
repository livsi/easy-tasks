<?php

declare(strict_types=1);

namespace Matrix;

enum OutputType: string
{
    case matrix = MatrixOutputBuilder::class;
    case row = RowOutputBuilder::class;
}
