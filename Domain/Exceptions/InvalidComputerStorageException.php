<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerStorageException extends InvalidArgumentException
{
    public static function becauseTechnologyIsEmpty(): self
    {
        return new self('The computer storage technology must not be empty.');
    }

    public static function becauseCapacityIsNotPositive(): self
    {
        return new self('The computer storage capacity must be a positive finite value.');
    }
}
