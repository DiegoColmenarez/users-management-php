<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerBrandException;

final readonly class ComputerBrand
{
    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidComputerBrandException::becauseValueIsEmpty();
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ComputerBrand $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
