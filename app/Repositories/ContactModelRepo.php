<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Database/Database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/BaseRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";

class ContactModelRepo extends BaseRepo
{
    /**
     * @param array $row
     * @return ContactModel
     */
    protected function fillModelFromRow(array $row) : ContactModel
    {
        $res = new ContactModel();
        $res->setId($row['id']);
        $res->setFirstName($row['first_name']);
        $res->setLastName($row['last_name']);
        $res->setEmail($row['email']);
        $res->setPhone($row['phone']);
        $res->setCreatedAtTimestamp($row['created_at']);
        $res->setUpdatedAtTimestamp($row['updated_at']);
        return $res;
    }

    /**
     * @param ContactModel $contactModel
     * @return void
     * @throws Exception
     */
    public function save(ContactModel $contactModel) : void
    {
        $this->database->connect();

        $firstName = $contactModel->getFirstName();
        $lastName = $contactModel->getLastName();
        $email = $contactModel->getEmail();
        $phone = $contactModel->getPhone();

        if($id = $contactModel->getId()) {
            $stmt = $this->database->prepare("update contacts set first_name = ?, last_name = ?, email = ?, phone = ? where id = ?");
            $stmt->bind_param("ssssi", $firstName, $lastName, $email, $phone, $id);
            if(!$stmt->execute()) {
                throw new Exception("Failed updating existing contact!");
            }
        } else {
            $stmt = $this->database->prepare("insert into contacts(first_name, last_name, email, phone) values(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName,$lastName, $email, $phone);
            if($stmt->execute()) {
                $contactModel->setId($stmt->insert_id);
            } else {
                throw new Exception("Failed creating new contact!");
            }
        }

        $stmt->close();
        $this->database->disconnect();
    }

    /**
     * @param ContactModel $contactModel
     * @return void
     * @throws Exception
     */
    public function delete(ContactModel $contactModel) : void
    {
        $this->deleteById($contactModel);
    }

    /**
     * @param int $id
     * @return ContactModel|null
     */
    public function getById(int $id) : ?Model
    {
        return $this->fetchResultById(
            'contacts',
            $id
        );
    }

    /**
     * @return array|ContactModel[]
     */
    public function getAll() : array
    {
        return $this->fetchAndFillAllResults(
            "SELECT * FROM contacts order by created_at desc"
        );
    }
}
