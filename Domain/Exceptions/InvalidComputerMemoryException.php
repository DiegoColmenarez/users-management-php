<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerMemoryException extends InvalidArgumentException
{
    public static function becauseTechnologyIsEmpty(): self
    {
        return new self('The computer memory technology must not be empty.');
    }

    public static function becauseCapacityIsNotPositive(): self
    {
        return new self('The computer memory capacity must be a positive finite value.');
    }
}
