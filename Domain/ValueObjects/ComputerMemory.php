<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerMemoryException;

final readonly class ComputerMemory
{
    private string $ramTechnology;
    private float $ramCapacity;

    public function __construct(string $ramTechnology, float $ramCapacity)
    {
        $normalizedTechnology = trim($ramTechnology);

        if ($normalizedTechnology === '') {
            throw InvalidComputerMemoryException::becauseTechnologyIsEmpty();
        }

        if (!is_finite($ramCapacity) || $ramCapacity <= 0) {
            throw InvalidComputerMemoryException::becauseCapacityIsNotPositive();
        }

        $this->ramTechnology = $normalizedTechnology;
        $this->ramCapacity = $ramCapacity;
    }

    public function ramTechnology(): string
    {
        return $this->ramTechnology;
    }

    public function ramCapacity(): float
    {
        return $this->ramCapacity;
    }

    public function equals(ComputerMemory $other): bool
    {
        return $this->ramTechnology === $other->ramTechnology()
            && abs($this->ramCapacity - $other->ramCapacity()) < PHP_FLOAT_EPSILON;
    }
}
