<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/DealRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Deal.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsNumeric.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsGreaterThen.php";

class ContactEditController
{
    /**
     * @return ValidatorProcessor
     */
    private function validate() : ValidatorProcessor
    {
        return (new ValidatorProcessor())->process([
            'id' => [
                new Required(),
                new IsNumeric(),
                new IsGreaterThen(1)
            ]
        ]);
    }

    /**
     * @param ContactModel $model
     * @return array|Deal[]
     * @throws Exception
     */
    public function getDealsForContact(ContactModel $model) : array
    {
        return (new DealRepo)->getForContact($model);
    }

    /**
     * @return ContactModel|null
     * @throws Exception
     */
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
