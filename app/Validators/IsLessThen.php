<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Validator.php";

class IsLessThen implements Validator
{
    public function __construct(
        private float|int $lt,
    ) { }

    public function isValid(mixed $value): bool
    {
        if (empty($value)) return true;

        if (is_numeric($value)) return $value <= $this->lt;

        if (is_string($value)) return strlen($value) <= $this->lt;

        return true;
    }

    public function getFailureMessage(string $fieldName): string
    {
        return "Field $fieldName must be less then $this->lt.";
    }
}
