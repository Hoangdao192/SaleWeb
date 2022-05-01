<?php
class Query {
    private $query = "";

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