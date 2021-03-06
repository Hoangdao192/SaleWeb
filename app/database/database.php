<?php
namespace App\Database;

class Database {
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbName = DB_NAME;

    public $link;
    public $error;

    private static $INSTANCE;

    public static function getInstance() {
        if (!Database::$INSTANCE) {
            Database::$INSTANCE = new Database();
        }
        return Database::$INSTANCE;
    }

    private function __construct()
    {
        $this->connect();
    }

    public function query($query) {
        $result = $this->link->query($query) or 
            die($this->link->error.__LINE__);
        return $result;
    }

    private function connect() {
        $this->link = new \mysqli($this->host, $this->user, $this->pass, $this->dbName);
        if (!$this->link) {
            $this->error = "Connection fail".$this->link->connect_error;
            return false;
        }
    }
}
?>