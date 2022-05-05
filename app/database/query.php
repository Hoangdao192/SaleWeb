<?php
class Query {
    private $query = "";

    public function insert($table_name, $content_array) {
        $this->query = "INSERT INTO $table_name (";
        $i = 0;
        foreach ($content_array as $column_name => $column_value) {
            $this->query = $this->query . $column_name;
            if ($i < sizeof($content_array) - 1) {
                $this->query = $this->query . ", ";
            } else {
                $this->query = $this->query . ") VALUES (";
            }
            ++$i;
        }

        $i = 0;
        foreach ($content_array as $column_name => $column_value) {
            if (gettype($column_value) == "string") {
                $this->query = $this->query . "'" . $column_value . "'";
            } else {
                $this->query = $this->query .  $column_value;
            }
            
            if ($i < sizeof($content_array) - 1) {
                $this->query = $this->query . ", ";
            } else {
                $this->query = $this->query . ")";
            }
            ++$i;
        }
    }

    public function get_all($table_name) {
        $this->query = $this->query . "SELECT * FROM $table_name ";
        return $this;
    }

    public function filter_by($condition) {
        if (str_contains($this->query, 'WHERE')) {
            $this->query = $this->query . "AND $condition ";
        } else {
            $this->query = $this->query . "WHERE $condition ";
        }
        return $this;
    }

    public function order_by($column_name, $type = "ASC") {
        $this->query = $this->query . "ORDER BY $column_name $type";
        return $this;
    }

    public function build() {
        return $this->query;
    }
}
?>