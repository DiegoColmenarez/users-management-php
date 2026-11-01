<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerDisplayException extends InvalidArgumentException
{
    public static function becauseBrandIsEmpty(): self
    {
        return new self('The computer monitor brand must not be empty.');
    }

    public static function becauseScreenSizeIsNotPositive(): self
    {
        return new self('The computer screen size must be a positive finite value.');
    }
}
