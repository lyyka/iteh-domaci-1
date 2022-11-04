<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Deal.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsNumeric.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsGreaterThen.php";

class DealDeleteController
{
    private function validate(): ValidatorProcessor
    {
        return (new ValidatorProcessor)->process([
            'id' => [
                new Required(),
                new IsNumeric(),
                new IsGreaterThen(1)
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

        $deal = new Deal();
        $deal->setId($data->input('id'));

        try {
            $deal->delete();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => $ex->getMessage()];
        }

        return ['success' => true];
    }
}

echo json_encode((new DealDeleteController)->handle());
