<?php

require_once __DIR__ . '/../Exceptions/InvalidCategoryException.php';

class CategoryEnum
{
    const DESKTOP = 'DESKTOP';
    const LAPTOP = 'LAPTOP';
    const ALL_IN_ONE = 'ALL-IN-ONE';
    const SERVER = 'SERVER';

    public static function values()
    {
        return array(
            self::DESKTOP,
            self::LAPTOP,
            self::ALL_IN_ONE,
            self::SERVER
        );
    }

    public static function isValid($value)
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid($value)
    {
        if (!self::isValid($value)) {
            throw InvalidCategoryException::becauseValueIsInvalid($value);
        }
    }
}
