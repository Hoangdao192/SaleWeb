<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
    include_once "app/models/category.php";
?>

<?php
class CategoryTable {
    public static $CATEGORY_TABLE_NAME = 'productcategory';
    public static $COLUMN_CATEGORY_ID = 'categoryId';
    public static $COLUMN_CATEGORY_NAME = 'categoryName';

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function parse_category($item) {
        $category = new Category();
        $category->id = $item[CategoryTable::$COLUMN_CATEGORY_ID];
        $category->name = $item[CategoryTable::$COLUMN_CATEGORY_NAME];
        return $category;
    }

    public function get_all() {
        $query = "SELECT * FROM " . CategoryTable::$CATEGORY_TABLE_NAME . " ORDER BY " . CategoryTable::$COLUMN_CATEGORY_ID;
        $result = $this->database->query($query);
        $categories = [];
        while ($item = $result->fetch_assoc()) {
            $categories[] = $this->parse_category($item);
        }
        return $categories;
    }

    public function insert_category($category) {
        $query = "INSERT INTO " . CategoryTable::$CATEGORY_TABLE_NAME . " (" . CategoryTable::$COLUMN_CATEGORY_NAME . ") VALUES('$category->name')";
        $result = $this->database->query($query);
        return $result;
    }

    public function get_category($category_id) {
        $query = "SELECT * FROM " . CategoryTable::$CATEGORY_TABLE_NAME . " WHERE " . CategoryTable::$COLUMN_CATEGORY_ID . " = $category_id";
        $result = $this->database->query($query);
        return $this->parse_category($result->fetch_assoc());
    }

    public function update_category($category) {
        $query = 
                "UPDATE " . CategoryTable::$CATEGORY_TABLE_NAME . " 
                SET " . CategoryTable::$COLUMN_CATEGORY_NAME . " = '$category->name'
                WHERE " . CategoryTable::$COLUMN_CATEGORY_ID . " = $category->id";
        $result = $this->database->query($query);
        return $result;
    }

    public function delete_category($category_id) {
        $query = "DELETE FROM " . CategoryTable::$CATEGORY_TABLE_NAME . " WHERE " . CategoryTable::$COLUMN_CATEGORY_ID . " = $category_id";
        $result = $this->database->query($query);
        return $result;
    }
}
?>