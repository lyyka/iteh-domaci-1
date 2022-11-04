<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Validator.php";

class ValidatorProcessor
{
    // Hold only validated data
    private array $data = [];

    // Hold errors for fields
    private array $errors = [];

    /**
     * @param string $fieldName
     * @param mixed|null $default
     * @return mixed
     */
    public function input(string $fieldName, mixed $default = null) : mixed
    {
        return $this->data[$fieldName] ?? $default;
    }

    /**
     * @return array
     */
    public function getErrors() : array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function failed() : bool
    {
        return count($this->errors) > 0;
    }

    /**
     * @param string $fieldName
     * @return mixed
     */
    private function getValueForFieldName(string $fieldName) : mixed
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $_POST[$fieldName] ?? null;
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $_GET[$fieldName] ?? null;
        }

        return null;
    }

    /**
     * Validate all passed fields.
     * $data should contain field names as keys and an array of Validator as value
     *
     * Only completely valid fields get injected into $data to be gathered through input()
     *
     * @param array $data
     * @return $this
     */
    public function process(array $data) : static
    {
        $this->data = [];

        /**
         * @var string $fieldName
         * @var Validator $validator
         */
        foreach ($data as $fieldName => $validators) {
            $value = $this->getValueForFieldName($fieldName);

            $allValid = true;

            foreach ($validators as $validator) {
                if(!$validator->isValid($value)) {
                    $allValid = false;
                    $this->errors[$fieldName] = $validator->getFailureMessage($fieldName);
                    break;
                }
            }

            if($allValid) {
                $this->data[$fieldName] = $value;
            }
        }

        return $this;
    }
}
