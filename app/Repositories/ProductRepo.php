<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Product.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/BaseRepo.php";

class ProductRepo extends BaseRepo
{
    /**
     * @param array $row
     * @return Product
     */
    protected function fillModelFromRow(array $row): Model
    {
        $res = new Product();
        $res->setId($row['id']);
        $res->setProductName($row['product_name']);
        $res->setCreatedAtTimestamp($row['created_at']);
        $res->setUpdatedAtTimestamp($row['updated_at']);
        return $res;
    }

    /**
     * @param int $id
     * @return Product|null
     * @throws Exception
     */
    public function getById(int $id) : ?Model
    {
        return $this->fetchResultById(
            'products',
            $id
        );
    }

    /**
     * @return array|Product[]
     * @throws Exception
     */
    public function getAll() : array
    {
        return $this->fetchAndFillAllResults(
            "SELECT * FROM products order by product_name asc"
        );
    }
}
