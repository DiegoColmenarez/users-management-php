<?php

class InvalidComputerIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The computer id must not be empty.');
    }

    public static function becauseValueIsInvalid(string $id): self
    {
        return new self('The computer id is not a valid UUID: ' . $id);
    }
}
