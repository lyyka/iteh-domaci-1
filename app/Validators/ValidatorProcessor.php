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
            $value = $_POST[$fieldName];

            foreach ($validators as $validator) {
                if($validator->isValid($value)) {
                    $this->data[$fieldName] = $value;
                } else {
                    $this->errors[$fieldName] = $validator->getFailureMessage($fieldName);
                }
            }
        }

        return $this;
    }
}
