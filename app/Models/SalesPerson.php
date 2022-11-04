<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";

class SalesPerson extends Model
{
    private string $name;
    private string $email;

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'sales_people';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
}
