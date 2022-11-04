<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsNumeric.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsGreaterThen.php";

class ContactDeleteController
{
    /**
     * @return ValidatorProcessor
     */
    private function validate(): ValidatorProcessor
    {
        return (new ValidatorProcessor)->process([
            'id' => [
                new Required(),
                new IsNumeric(),
                new IsGreaterThen(0)
            ],
        ]);
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $data = $this->validate();

        if($data->failed()) {
            return ['success' => false, 'errors' => $data->getErrors()];
        }

        $contactModel = new ContactModel();
        $contactModel->setId($data->input('id'));

        try {
            $contactModel->delete();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => $ex->getMessage()];
        }

        return ['success' => true];
    }
}

echo json_encode((new ContactDeleteController)->handle());
