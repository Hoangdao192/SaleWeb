<?php
namespace App\Database\DAO;

use App\Database\Database;
use App\Database\Query;

abstract class BaseDAO {
    protected $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /*Return mysqli_object*/
    // public function getAll($tableName) {
    //     $query = new Query();
    //     $query->getAll($tableName);
    //     return $this->database->query($query->build());
    // }
}
?>