<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Deal.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/BaseRepo.php";

class DealRepo extends BaseRepo
{
    /**
     * @param array $row
     * @return Deal
     */
    protected function fillModelFromRow(array $row) : Model
    {
        $res = new Deal();
        $res->setId($row['id']);
        $res->setContactId($row['contact_id']);
        $res->setProductId($row['product_id']);
        $res->setSalesPersonId($row['sales_person_id']);
        $res->setDealValue($row['deal_value']);
        $res->setDealValueCurrency($row['deal_value_currency']);
        $res->setNotes($row['notes']);
        $res->setCreatedAtTimestamp($row['created_at']);
        $res->setUpdatedAtTimestamp($row['updated_at']);
        return $res;
    }

    /**
     * @param Deal $deal
     * @return void
     * @throws Exception
     */
    public function save(Deal $deal) : void
    {
        $this->database->connect();

        $contactId = $deal->getContactId();
        $productId = $deal->getProductId();
        $salesPersonId = $deal->getSalesPersonId();
        $dealValue = $deal->getDealValue();
        $dealValueCurrency = $deal->getDealValueCurrency();
        $notes = $deal->getNotes();

        if($id = $deal->getId()) {
            $stmt = $this->database->prepare("update deals set contact_id = ?, product_id = ?, sales_person_id = ?, 
                 deal_value = ?, deal_value_currency = ?, notes = ? where id = ?");
            $stmt->bind_param("iiidssi", $contactId, $productId, $salesPersonId, $dealValue, $dealValueCurrency, $notes, $id);
            if(!$stmt->execute()) {
                throw new Exception("Failed updating existing deal!");
            }
        } else {
            $stmt = $this->database->prepare("insert into deals(contact_id, product_id, sales_person_id, 
                  deal_value, deal_value_currency, notes) values(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiidss", $contactId, $productId, $salesPersonId, $dealValue, $dealValueCurrency, $notes);
            if($stmt->execute()) {
                $deal->setId($stmt->insert_id);
            } else {
                throw new Exception("Failed creating new deal! $stmt->error");
            }
        }

        $stmt->close();
        $this->database->disconnect();
    }

    /**
     * @param int $id
     * @return Deal|null
     * @throws Exception
     */
    public function getById(int $id) : ?Model
    {
        return $this->fetchResultById(
            'deals',
            $id
        );
    }

    /**
     * @return array|Deal[]
     * @throws Exception
     */
    public function getForContact(ContactModel $contactModel) : array
    {
        return $this->fetchAndFillAllResults(
            "SELECT * FROM deals 
         where contact_id = ?
         order by created_at desc",
            "i",
            [$contactModel->getId()]
        );
    }
}
