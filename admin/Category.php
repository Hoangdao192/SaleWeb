<?php
    include_once "Database.php";
?>

<?php
class Category {
    public $CATEGORY_TABLE_NAME = 'productcategory';
    public $COLUMN_CATEGORY_ID = 'categoryId';
    public $COLUMN_CATEGORY_NAME = 'categoryName';

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function show_category() {
        $query = "SELECT * FROM $this->CATEGORY_TABLE_NAME ORDER BY $this->COLUMN_CATEGORY_ID";
        $result = $this->database->query($query);
        return $result;
    }

    public function insert_category($categoryName) {
        $query = "INSERT INTO $this->CATEGORY_TABLE_NAME ($this->COLUMN_CATEGORY_NAME) VALUES('$categoryName')";
        $result = $this->database->query($query);
        return $result;
    }

    public function get_category($categoryId) {
        $query = "SELECT * FROM $this->CATEGORY_TABLE_NAME WHERE $this->COLUMN_CATEGORY_ID = $categoryId";
        $result = $this->database->query($query);
        return $result;
    }

    public function update_category($categoryId, $categoryName) {
        $query = 
                "UPDATE $this->CATEGORY_TABLE_NAME 
                SET $this->COLUMN_CATEGORY_NAME = '$categoryName'
                WHERE $this->COLUMN_CATEGORY_ID = $categoryId";
        $result = $this->database->query($query);
        return $result;
    }

    public function delete_category($categoryId) {
        $query = "DELETE FROM $this->CATEGORY_TABLE_NAME WHERE $this->COLUMN_CATEGORY_ID = $categoryId";
        $result = $this->database->query($query);
        return $result;
    }
}
?>