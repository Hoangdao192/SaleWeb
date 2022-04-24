<?php
    include_once "Database.php";
?>

<?php
class ProductType {

    public $PRODUCT_TYPE_TABLE_NAME = 'producttype';
    public $COLUMN_PRODUCT_TYPE_ID = 'productTypeId';
    public $COLUMN_CATEGORY_ID = 'categoryId';
    public $COLUMN_PRODUCT_TYPE_NAME = 'productTypeName';

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    //  Get all product type in product type table
    public function show_product_type() {
        $query = "SELECT * FROM $this->PRODUCT_TYPE_TABLE_NAME ORDER BY $this->COLUMN_PRODUCT_TYPE_ID";
        $result = $this->database->query($query);
        return $result;
    }

    public function show_product_type_by_category($categoryId) {
        $query = "SELECT * FROM $this->PRODUCT_TYPE_TABLE_NAME WHERE $this->COLUMN_CATEGORY_ID = $categoryId ORDER BY $this->COLUMN_PRODUCT_TYPE_ID";
        $result = $this->database->query($query);
        return $result;
    }

    //  Insert new product type to database
    public function insert_product_type($productTypeId, $productTypeName) {
        $query = "INSERT INTO $this->PRODUCT_TYPE_TABLE_NAME ($this->COLUMN_CATEGORY_ID, $this->COLUMN_PRODUCT_TYPE_NAME) 
                VALUES($productTypeId, '$productTypeName')";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get a single product have this id
    public function get_product_type($productTypeId) {
        $query = "SELECT * FROM $this->PRODUCT_TYPE_TABLE_NAME WHERE $this->COLUMN_PRODUCT_TYPE_ID = $productTypeId";
        $result = $this->database->query($query);
        return $result;
    }

    //  Update a product's information
    public function update_product_type($productTypeId, $categoryId, $productTypeName) {
        $query = 
                "UPDATE $this->PRODUCT_TYPE_TABLE_NAME 
                SET $this->COLUMN_CATEGORY_ID = $categoryId, 
                    $this->COLUMN_PRODUCT_TYPE_NAME = '$productTypeName'
                WHERE $this->COLUMN_PRODUCT_TYPE_ID = $productTypeId";
        $result = $this->database->query($query);
        return $result;
    }

    //  Delete a product with this id
    public function delete_product_type($productTypeId) {
        $query = "DELETE FROM $this->PRODUCT_TYPE_TABLE_NAME WHERE $this->COLUMN_PRODUCT_TYPE_ID = $productTypeId";
        $result = $this->database->query($query);
        return $result;
    }
}
?>