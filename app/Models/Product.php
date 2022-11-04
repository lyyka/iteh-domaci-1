<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";

class Product extends Model
{
    private string $productName;

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
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $name
     */
    public function setProductName(string $name): void
    {
        $this->productName = $name;
    }
}
