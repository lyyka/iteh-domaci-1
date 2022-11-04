<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";

class ContactModel extends Model
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $phone;
    private string $createdAtTimestamp;
    private string $updatedAtTimestamp;

    /**
     * @throws Exception
     */
    public function save() : void
    {
        (new ContactModelRepo)->save($this);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function delete() : void
    {
        (new ContactModelRepo)->delete($this);
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'contacts';
    }

    /**
     * @return string
     */
    public function getFullName() : string
    {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getCreatedAtTimestamp(): string
    {
        return $this->createdAtTimestamp;
    }

    /**
     * @param string $createdAtTimestamp
     */
    public function setCreatedAtTimestamp(string $createdAtTimestamp): void
    {
        $this->createdAtTimestamp = $createdAtTimestamp;
    }

    /**
     * @return string
     */
    public function getUpdatedAtTimestamp(): string
    {
        return $this->updatedAtTimestamp;
    }

    /**
     * @param string $updatedAtTimestamp
     * @return ContactModel
     */
    public function setUpdatedAtTimestamp(string $updatedAtTimestamp): ContactModel
    {
        $this->updatedAtTimestamp = $updatedAtTimestamp;
        return $this;
    }
}
