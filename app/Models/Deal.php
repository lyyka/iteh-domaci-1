<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";

class Deal extends Model
{
    public function getTableName(): string
    {
        return 'deals';
    }
}
