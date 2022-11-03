<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsString.php";

class ContactCreateController
{
    private function validate(): ValidatorProcessor
    {
        return (new ValidatorProcessor)->process([
            'first_name' => [
                new Required(),
                new IsString(),
            ],
            'last_name' => [
                new Required(),
                new IsString(),
            ],
            'email' => [
                new Required(),
                new IsString(),
            ],
            'phone' => [
                new Required(),
                new IsString(),
            ],
        ]);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function handle(): array
    {
        $data = $this->validate();

        if($data->failed()) {
            return ['success' => false, 'errors' => $data->getErrors()];
        }

        $contactModel = new ContactModel(
            $data->input('first_name'),
            $data->input('last_name'),
            $data->input('email'),
            $data->input('phone'),
        );

        $contactModel->save();

        return ['success' => true];
    }
}

echo json_encode((new ContactCreateController)->handle());
