<?php
namespace App\Database;

class Query {
    private $query = "";

    /*Generate INSERT INTO query*/
    public function insert($tableName, $contentArray /*[key] = value*/) {
        $this->query = "INSERT INTO $tableName (";
        $i = 0;
        foreach ($contentArray as $columnName => $columnValue) {
            $this->query = $this->query . $columnName;
            if ($i < sizeof($contentArray) - 1) {
                $this->query = $this->query . ", ";
            } else {
                $this->query = $this->query . ") VALUES (";
            }
            ++$i;
        }

        $i = 0;
        foreach ($contentArray as $columnName => $columnValue) {
            if (gettype($columnValue) == "string") {
                $this->query = $this->query . "'" . $columnValue . "'";
            } else {
                $this->query = $this->query .  $columnValue;
            }
            
            if ($i < sizeof($contentArray) - 1) {
                $this->query = $this->query . ", ";
            } else {
                $this->query = $this->query . ")";
            }
            ++$i;
        }
    }

    /*Generate UPDATE query*/
    public function update($tableName, $contentArray, $condition = null) {
        $this->query = "";
        $this->query .= "UPDATE " . $tableName . " SET ";

        $i = 0;
        foreach ($contentArray as $columnName => $columnValue) {
            $this->query .= $columnName . " = ";
            if (gettype($columnValue) == "string") {
                $this->query = $this->query . "'" . $columnValue . "'";
            } else {
                $this->query = $this->query .  $columnValue;
            }
            if ($i < sizeof($contentArray) - 1  ) {
                $this->query .= ", ";
            }
            ++$i;
        }

        $this->query .= " ";
        if ($condition != null) {
            $this->filterBy($condition);
        }
    }

    /*Generate SELECT query*/
    public function getAll($tableName) {
        $this->query = $this->query . "SELECT * FROM $tableName ";
        return $this;
    }

    /*Generate DELETE query*/
    public function delete($tableName, $condition) {
        $this->query = "DELETE FROM " . $tableName . " ";
        $this->filterBy($condition);
    }

    /*Generate WHERE query*/
    public function filterBy($condition) {
        if (str_contains($this->query, 'WHERE')) {
            $this->query = $this->query . "AND $condition ";
        } else {
            $this->query = $this->query . "WHERE $condition ";
        }
        return $this;
    }

    /*Generate ORDER BY query*/
    public function orderBy($columnName, $type = "ASC") {
        $this->query = $this->query . "ORDER BY $columnName $type";
        return $this;
    }

    /*Return query*/
    public function build() {
        return $this->query;
    }
}
?>