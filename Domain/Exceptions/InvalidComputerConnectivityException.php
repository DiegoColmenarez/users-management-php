<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use InvalidArgumentException;

final class InvalidComputerConnectivityException extends InvalidArgumentException
{
    public static function becauseUsbPortsAreNegative(): self
    {
        return new self('The number of USB ports must not be negative.');
    }

    public static function becauseHdmiPortsAreNegative(): self
    {
        return new self('The number of HDMI ports must not be negative.');
    }
}
