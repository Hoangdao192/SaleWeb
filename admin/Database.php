<?php
    include_once "DatabaseConfig.php";

    class Database {
        public $host = DB_HOST;
        public $user = DB_USER;
        public $pass = DB_PASS;
        public $dbName = DB_NAME;

        public $link;
        public $error;

        public function __construct()
        {
            $this->connect();
        }

        public function query($query) {
            $result = $this->link->query($query) or 
                die($this->link->error.__LINE__);
            return $result;
        }

        private function connect() {
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbName);
            if (!$this->link) {
                $this->error = "Connection fail".$this->link->connect_error;
                return false;
            }
        }

        public function select($query) {
            $result = $this->link->query($query) or 
                die($this->link->error.__LINE__);
            if($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }

        public function insert($query) {
            $insert_row = $this->link->query($query) or
                die($this->link->error.__LINE__);
            if ($insert_row) {
                return $insert_row;
            } else {
                return false;
            }
        }

        public function update($query) {
            $update_row = $this->link->query($query) or
                die($this->link->error.__LINE__);
            if ($update_row) {
                return $update_row;
            } else {
                return false;
            }
        }

        public function delete($query) {
            $delete_row = $this->link->query($query) or
                die($this->link->error.__LINE__);
            if ($delete_row) {
                return $delete_row;
            } else {
                return false;
            }
        }
    }
?>