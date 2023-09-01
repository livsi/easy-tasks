<?php

declare(strict_types=1);

namespace Matrix;

class OutputLogicException extends \Exception
{
    protected $message = 'The number of requested numbers must be greater than or equal to the number of numbers in the randomized interval';
}
