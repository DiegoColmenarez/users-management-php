<?php

class ComputerAlreadyExistsException extends DomainException
{
    public static function becauseIdAlreadyExists(string $id): self
    {
        return new self('A computer with id ' . $id . ' already exists.');
    }
}
