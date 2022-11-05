<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Deal.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/ValidatorProcessor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/Required.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsString.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsNumeric.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsGreaterThen.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Validators/IsLessThen.php";

class DealCreateController
{
    /**
     * @return ValidatorProcessor
     */
    private function validate(): ValidatorProcessor
    {
        return (new ValidatorProcessor)->process([
            'id' => [
                new IsNumeric(),
                new IsGreaterThen(1),
            ],
            'contact_id' => [
                new Required(),
                new IsNumeric(),
            ],
            'product_id' => [
                new Required(),
                new IsNumeric(),
            ],
            'sales_person_id' => [
                new Required(),
                new IsNumeric(),
            ],
            'deal_value_currency' => [
                new IsString(),
                new IsLessThen(4),
            ],
            'deal_value' => [
                new IsNumeric(),
                new IsGreaterThen(0),
            ],
            'notes' => [
                new IsString(),
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

        if($id = $data->input('id')) {
            $deal->setId($id);
        }

        $dealValueCurrency = $data->input('deal_value_currency');
        $dealValue = $data->input('deal_value');

        $deal->setContactId($data->input('contact_id'));
        $deal->setProductId($data->input('product_id'));
        $deal->setSalesPersonId($data->input('sales_person_id'));
        $deal->setDealValueCurrency($dealValueCurrency ?? null);
        $deal->setDealValue($dealValue ? (float) $dealValue : null);
        $deal->setNotes($data->input('notes'));

        try {
            $deal->save();
        } catch (Exception $ex) {
            return ['success' => false, 'message' => 'Failed while saving!'];
        }

        return ['success' => true];
    }
}

echo json_encode((new DealCreateController)->handle());
