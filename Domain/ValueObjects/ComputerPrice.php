<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerPriceException;
use RuntimeException;

final readonly class ComputerPrice
{
    private string $value;

    public function __construct(string $value)
    {
        self::ensureBcMathIsAvailable();

        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidComputerPriceException::becauseValueIsEmpty();
        }

        if (!preg_match('/^\d{1,10}(?:\.\d{1,2})?$/', $normalizedValue)) {
            throw InvalidComputerPriceException::becauseValueIsInvalid($value);
        }

        $normalizedValue = bcadd($normalizedValue, '0', 2);

        if (bccomp($normalizedValue, '9999999999.99', 2) > 0) {
            throw InvalidComputerPriceException::becauseValueIsOutOfRange($value);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ComputerPrice $other): bool
    {
        self::ensureBcMathIsAvailable();

        return bccomp($this->value, $other->value(), 2) === 0;
    }

    private static function ensureBcMathIsAvailable(): void
    {
        if (!extension_loaded('bcmath')) {
            throw new RuntimeException('The BCMath extension is required to use ComputerPrice.');
        }
    }
}
