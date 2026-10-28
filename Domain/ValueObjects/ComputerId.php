<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidComputerIdException;

final readonly class ComputerId
{
    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = strtolower(trim($value));

        if ($normalizedValue === '') {
            throw InvalidComputerIdException::becauseValueIsEmpty();
        }

        if (!preg_match('/^[0-9a-f]{8}-(?:[0-9a-f]{4}-){3}[0-9a-f]{12}$/', $normalizedValue)) {
            throw InvalidComputerIdException::becauseValueIsInvalid($value);
        }

        $this->value = $normalizedValue;
    }

    public static function generate(): self
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

        return new self($uuid);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ComputerId $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
