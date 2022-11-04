<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsNumeric.php";

class ContactEditController
{
    private function validate() : ValidatorProcessor
    {
        return (new ValidatorProcessor())->process([
            'id' => [
                new Required(),
                new IsNumeric(),
            ]
        ]);
    }

    public function getContactById() : ?ContactModel
    {
        $data = $this->validate();
        $id = $data->input('id');

        if(!$id) {
            return null;
        }

        $repo = new ContactModelRepo();
        return $repo->getById($id);
    }
}
