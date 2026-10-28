<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerProcessorException;

final readonly class ComputerProcessor
{
    private string $cpuBrand;
    private float $cpuSpeed;

    public function __construct(string $cpuBrand, float $cpuSpeed)
    {
        $normalizedBrand = trim($cpuBrand);

        if ($normalizedBrand === '') {
            throw InvalidComputerProcessorException::becauseBrandIsEmpty();
        }

        if (!is_finite($cpuSpeed) || $cpuSpeed <= 0) {
            throw InvalidComputerProcessorException::becauseSpeedIsNotPositive();
        }

        $this->cpuBrand = $normalizedBrand;
        $this->cpuSpeed = $cpuSpeed;
    }

    public function cpuBrand(): string
    {
        return $this->cpuBrand;
    }

    public function cpuSpeed(): float
    {
        return $this->cpuSpeed;
    }

    public function equals(ComputerProcessor $other): bool
    {
        return $this->cpuBrand === $other->cpuBrand()
            && abs($this->cpuSpeed - $other->cpuSpeed()) < PHP_FLOAT_EPSILON;
    }
}
