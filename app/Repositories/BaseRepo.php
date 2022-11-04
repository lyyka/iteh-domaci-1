<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";

abstract class BaseRepo
{
    protected Database $database;

    abstract protected function fillModelFromRow(array $row) : ContactModel;

    public function __construct()
    {
        $this->database = new Database();
    }

    protected function deleteById(Model $model) : void
    {
        $id = $model->getId();

        if(!$id) throw new Exception("Cannot update contact without its ID!");

        $this->database->connect();

        $stmt = $this->database->prepare("delete from {$model->getTableName()} where id = ?");

        $stmt->bind_param('i', $id);

        if($stmt->execute()) {
            $model->setId(null);
        }

        $stmt->close();
        $this->database->disconnect();
    }

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
     * @return array
     */
    protected function fetchAndFillAllResults(string $query) : array
    {
        $this->database->connect();

        $stmt = $this->database->prepare($query);

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
