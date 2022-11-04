<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Validator.php";

class IsString implements Validator
{
    public function isValid(mixed $value): bool
    {
        return empty($value) || is_string($value);
    }

    public function getFailureMessage(string $fieldName): string
    {
        return "Field $fieldName must be a string.";
    }
}
