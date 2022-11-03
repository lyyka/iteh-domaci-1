<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Validator.php";

class Required implements Validator
{
    public function isValid(mixed $value): bool
    {
        return !empty($value);
    }

    public function getFailureMessage(string $fieldName): string
    {
        return "Field $fieldName is required.";
    }
}
