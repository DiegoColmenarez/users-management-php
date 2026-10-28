<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerDisplayException;

final readonly class ComputerDisplay
{
    private string $monitorBrand;
    private float $screenSizeInches;

    public function __construct(string $monitorBrand, float $screenSizeInches)
    {
        $normalizedBrand = trim($monitorBrand);

        if ($normalizedBrand === '') {
            throw InvalidComputerDisplayException::becauseBrandIsEmpty();
        }

        if (!is_finite($screenSizeInches) || $screenSizeInches <= 0) {
            throw InvalidComputerDisplayException::becauseScreenSizeIsNotPositive();
        }

        $this->monitorBrand = $normalizedBrand;
        $this->screenSizeInches = $screenSizeInches;
    }

    public function monitorBrand(): string
    {
        return $this->monitorBrand;
    }

    public function screenSizeInches(): float
    {
        return $this->screenSizeInches;
    }

    public function equals(ComputerDisplay $other): bool
    {
        return $this->monitorBrand === $other->monitorBrand()
            && abs($this->screenSizeInches - $other->screenSizeInches()) < PHP_FLOAT_EPSILON;
    }
}
