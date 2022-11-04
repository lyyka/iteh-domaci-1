<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Validator.php";

class IsGreaterThen implements Validator
{
    public function __construct(
        private float|int $gt,
    ) { }

    public function isValid(mixed $value): bool
    {
        if (empty($value)) return true;

        if (is_numeric($value)) return $value >= $this->gt;

        if (is_string($value)) return strlen($value) >= $this->gt;

        return true;
    }

    public function getFailureMessage(string $fieldName): string
    {
        return "Field $fieldName must be greater then $this->gt.";
    }
}
