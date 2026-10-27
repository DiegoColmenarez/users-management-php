<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerPriceException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The computer price must not be empty.');
    }

    public static function becauseValueIsInvalid(string $value): self
    {
        return new self('The computer price is invalid: ' . $value);
    }

    public static function becauseValueIsOutOfRange(string $value): self
    {
        return new self('The computer price exceeds DECIMAL(12,2): ' . $value);
    }
}
