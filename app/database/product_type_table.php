<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product_type.php";
?>

<?php
class ProductTypeTable {

    public static $PRODUCT_TYPE_TABLE_NAME = 'producttype';
    public static $COLUMN_PRODUCT_TYPE_ID = 'productTypeId';
    public static $COLUMN_CATEGORY_ID = 'categoryId';
    public static $COLUMN_PRODUCT_TYPE_NAME = 'productTypeName';

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function parse_product_type($item) {
        $product_type = new ProductType();
        $product_type->id = $item[ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID];
        $product_type->category_id = $item[ProductTypeTable::$COLUMN_CATEGORY_ID];
        $product_type->name = $item[ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME];
        return $product_type;
    }

    //  Insert new product type to database
    public function insert_product_type($product_type) {
        $query = "INSERT INTO " . ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME . "(" . ProductTypeTable::$COLUMN_CATEGORY_ID . ", " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME . ") 
                VALUES($product_type->id, '$product_type->name')";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get a single product have this id
    public function get_product_type($productTypeId) {
        $query = "SELECT * FROM " . ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME . " WHERE " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID. " = $productTypeId";
        $result = $this->database->query($query);
        return $this->parse_product_type($result->fetch_assoc());
    }

    //  Update a product's information
    public function update_product_type($product_type) {
        $query = 
                "UPDATE " . ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME . " 
                SET " . ProductTypeTable::$COLUMN_CATEGORY_ID. " = $product_type->category_id, 
                    " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_NAME. " = '$product_type->name'
                WHERE " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID. " = $product_type->id";
        $result = $this->database->query($query);
        return $result;
    }

    //  Delete a product with this id
    public function delete_product_type($product_type_id) {
        $query = "DELETE FROM " . ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME . " WHERE " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID. " = $product_type_id";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get all product type in product type table
    public function get_all() {
        $query = "SELECT * FROM " . ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME . " ORDER BY " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID. "";
        $result = $this->database->query($query);
        $product_types = [];
        while ($item = $result->fetch_assoc()) {
            $product_types[] = $this->parse_product_type($item);
        }
        return $product_types;
    }

    public function get_all_filter_by_category($category_id) {
        $query = "SELECT * FROM " . ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME . " WHERE " . ProductTypeTable::$COLUMN_CATEGORY_ID. " = $category_id ORDER BY " . ProductTypeTable::$COLUMN_PRODUCT_TYPE_ID. "";
        $result = $this->database->query($query);
        $product_types = [];
        while ($item = $result->fetch_assoc()) {
            $product_types[] = $this->parse_product_type($item);
        }
        return $product_types;
    }
}
?>