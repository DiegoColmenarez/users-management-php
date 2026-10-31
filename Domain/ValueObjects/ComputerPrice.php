<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerPriceException;

final readonly class ComputerPrice
{
    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidComputerPriceException::becauseValueIsEmpty();
        }

        if (!preg_match('/^\d{1,10}(?:\.\d{1,2})?$/', $normalizedValue)) {
            throw InvalidComputerPriceException::becauseValueIsInvalid($value);
        }

        [$integerPart, $fractionalPart] = array_pad(explode('.', $normalizedValue, 2), 2, '');
        $integerPart = ltrim($integerPart, '0');
        $integerPart = $integerPart === '' ? '0' : $integerPart;
        $fractionalPart = str_pad($fractionalPart, 2, '0');

        $this->value = $integerPart . '.' . $fractionalPart;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ComputerPrice $other): bool
    {
        return $this->value === $other->value();
    }
}
