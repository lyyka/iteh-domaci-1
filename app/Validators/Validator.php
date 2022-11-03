<?php

interface Validator
{
    public function isValid(mixed $value): bool;

    public function getFailureMessage(string $fieldName) : string;
}
