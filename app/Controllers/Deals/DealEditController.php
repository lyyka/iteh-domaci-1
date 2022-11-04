<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/DealRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Deal.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/SalesPerson.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Product.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsNumeric.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsGreaterThen.php";

class DealEditController
{
    /**
     * @return ValidatorProcessor
     */
    private function validateContactId() : ValidatorProcessor
    {
        return (new ValidatorProcessor())->process([
            'contact_id' => [
                new Required(),
                new IsNumeric(),
                new IsGreaterThen(1),
            ]
        ]);
    }

    /**
     * @return ValidatorProcessor
     */
    private function validate() : ValidatorProcessor
    {
        return (new ValidatorProcessor())->process([
            'id' => [
                new Required(),
                new IsNumeric(),
            ]
        ]);
    }

    /**
     * @return array|Product[]
     * @throws Exception
     */
    public function getProductOptions() : array
    {
        return (new ProductRepo())->getAll();
    }

    /**
     * @return array|SalesPerson[]
     * @throws Exception
     */
    public function getSalesPeopleOptions() : array
    {
        return (new SalesPeopleRepo())->getAll();
    }

    /**
     * @return ContactModel|null
     * @throws Exception
     */
    public function getContactById() : ?ContactModel
    {
        $data = $this->validateContactId();
        $id = $data->input('contact_id');

        if(!$id) {
            return null;
        }

        $repo = new ContactModelRepo();
        return $repo->getById($id);
    }

    /**
     * @return Deal|null
     * @throws Exception
     */
    public function getDealById() : ?Deal
    {
        $data = $this->validate();
        $id = $data->input('id');

        if(!$id) {
            return null;
        }

        $repo = new DealRepo();
        return $repo->getById($id);
    }
}
