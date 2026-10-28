<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerStorageException;

final readonly class ComputerStorage
{
    private string $storageTechnology;
    private float $storageCapacity;

    public function __construct(string $storageTechnology, float $storageCapacity)
    {
        $normalizedTechnology = trim($storageTechnology);

        if ($normalizedTechnology === '') {
            throw InvalidComputerStorageException::becauseTechnologyIsEmpty();
        }

        if (!is_finite($storageCapacity) || $storageCapacity <= 0) {
            throw InvalidComputerStorageException::becauseCapacityIsNotPositive();
        }

        $this->storageTechnology = $normalizedTechnology;
        $this->storageCapacity = $storageCapacity;
    }

    public function storageTechnology(): string
    {
        return $this->storageTechnology;
    }

    public function storageCapacity(): float
    {
        return $this->storageCapacity;
    }

    public function equals(ComputerStorage $other): bool
    {
        return $this->storageTechnology === $other->storageTechnology()
            && abs($this->storageCapacity - $other->storageCapacity()) < PHP_FLOAT_EPSILON;
    }
}
