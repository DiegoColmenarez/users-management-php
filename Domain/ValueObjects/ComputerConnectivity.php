<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerConnectivityException;

final readonly class ComputerConnectivity
{
    private int $usbPorts;
    private int $hdmiPorts;

    public function __construct(int $usbPorts, int $hdmiPorts)
    {
        if ($usbPorts < 0) {
            throw InvalidComputerConnectivityException::becauseUsbPortsAreNegative();
        }

        if ($hdmiPorts < 0) {
            throw InvalidComputerConnectivityException::becauseHdmiPortsAreNegative();
        }

        $this->usbPorts = $usbPorts;
        $this->hdmiPorts = $hdmiPorts;
    }

    public function usbPorts(): int
    {
        return $this->usbPorts;
    }

    public function hdmiPorts(): int
    {
        return $this->hdmiPorts;
    }

    public function equals(ComputerConnectivity $other): bool
    {
        return $this->usbPorts === $other->usbPorts()
            && $this->hdmiPorts === $other->hdmiPorts();
    }
}
