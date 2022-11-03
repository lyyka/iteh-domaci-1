<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";

class ContactModel
{
    private ?int $id = null;
    private string $createdAtTimestamp;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     */
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $phone,
    ) { }

    /**
     * @throws Exception
     */
    public function save() : void
    {
        (new ContactModelRepo)->save($this);
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $createdAtTimestamp
     */
    public function setCreatedAtTimestamp(string $createdAtTimestamp): void
    {
        $this->createdAtTimestamp = $createdAtTimestamp;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCreatedAtTimestamp(): string
    {
        return $this->createdAtTimestamp;
    }
}
