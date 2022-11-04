<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Database/Database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";

class ContactModelRepo
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
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
            $stmt->bind_param("issss", $id, $firstName, $lastName, $email, $phone);
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
        $id = $contactModel->getId();

        if(!$id) throw new Exception("Cannot update contact without its ID!");

        $this->database->connect();

        $stmt = $this->database->prepare("delete from contacts where id = ?");

        $stmt->bind_param('i', $id);

        if($stmt->execute()) {
            $contactModel->setId(null);
        }

        $stmt->close();
        $this->database->disconnect();
    }

    /**
     * @return array|ContactModel[]
     */
    public function getAll() : array
    {
        $this->database->connect();

        $stmt = $this->database->prepare("SELECT * FROM contacts order by created_at desc");

        $res = [];

        if($stmt->execute()) {
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                $model = new ContactModel();
                $model->setId($row['id']);
                $model->setFirstName($row['first_name']);
                $model->setLastName($row['last_name']);
                $model->setEmail($row['email']);
                $model->setPhone($row['phone']);
                $model->setCreatedAtTimestamp($row['created_at']);

                $res[] = $model;
            }
        }

        $stmt->close();

        $this->database->disconnect();

        return $res;
    }
}
