<?php

class ComputerNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self('The computer with id ' . $id . ' was not found.');
    }
}
