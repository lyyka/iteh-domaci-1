<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Database/Database.php";

abstract class BaseRepo
{
    protected Database $database;

    /**
     * @param array $row
     * @return Model
     */
    abstract protected function fillModelFromRow(array $row) : Model;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * @param Model $model
     * @return void
     * @throws Exception
     */
    public function delete(Model $model) : void
    {
        $id = $model->getId();

        if(!$id) throw new Exception("Cannot update model without its ID!");

        $this->database->connect();

        $stmt = $this->database->prepare("delete from {$model->getTableName()} where id = ?");

        $stmt->bind_param('i', $id);

        if($stmt->execute()) {
            $model->setId(null);
        }

        $stmt->close();
        $this->database->disconnect();
    }

    /**
     * @param string $table
     * @param int $id
     * @return Model|null
     * @throws Exception
     */
    protected function fetchResultById(string $table, int $id) : ?Model
    {
        $this->database->connect();

        $stmt = $this->database->prepare("SELECT * FROM $table where id = ?");

        $stmt->bind_param("i", $id);

        $res = null;

        if($stmt->execute()) {
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                $res = $this->fillModelFromRow($row);
            }
        }

        $stmt->close();

        $this->database->disconnect();

        return $res;
    }

    /**
     * @param string $query
     * @param string|null $bindString
     * @param array $bindValues
     * @return array
     * @throws Exception
     */
    protected function fetchAndFillAllResults(string $query, string $bindString = null, array $bindValues = []) : array
    {
        $this->database->connect();

        $stmt = $this->database->prepare($query);

        if($bindString && count($bindValues) === strlen($bindString)) {
            $stmt->bind_param($bindString, ...$bindValues);
        }

        $res = [];

        if($stmt->execute()) {
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                $res[] = $this->fillModelFromRow($row);
            }
        }

        $stmt->close();

        $this->database->disconnect();

        return $res;
    }
}
