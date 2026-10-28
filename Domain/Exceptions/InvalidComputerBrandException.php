<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerBrandException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The computer brand must not be empty.');
    }
}
