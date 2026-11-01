<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerProcessorException extends InvalidArgumentException
{
    public static function becauseBrandIsEmpty(): self
    {
        return new self('The computer processor brand must not be empty.');
    }

    public static function becauseSpeedIsNotPositive(): self
    {
        return new self('The computer processor speed must be a positive finite value.');
    }
}
