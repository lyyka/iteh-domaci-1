<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";

class Product extends Model
{
    private string $name;

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'products';
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
}
