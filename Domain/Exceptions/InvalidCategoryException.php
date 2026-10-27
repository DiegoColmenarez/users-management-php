<?php

class InvalidCategoryException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid($category)
    {
        return new self('The computer category is invalid: ' . $category);
    }
}
