<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";

class ContactModel
{
    private ?int $id = null;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $phone;
    private string $createdAtTimestamp;

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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
}
