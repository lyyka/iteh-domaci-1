<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/SalesPerson.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/BaseRepo.php";

class SalesPeopleRepo extends BaseRepo
{
    /**
     * @param array $row
     * @return SalesPerson
     */
    protected function fillModelFromRow(array $row): Model
    {
        $res = new SalesPerson();
        $res->setId($row['id']);
        $res->setName($row['name']);
        $res->setEmail($row['email']);
        $res->setCreatedAtTimestamp($row['created_at']);
        $res->setUpdatedAtTimestamp($row['updated_at']);
        return $res;
    }

    /**
     * @param int $id
     * @return SalesPerson|null
     * @throws Exception
     */
    public function getById(int $id) : ?Model
    {
        return $this->fetchResultById(
            'sales_people',
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
            "SELECT * FROM sales_people order by name asc"
        );
    }
}
