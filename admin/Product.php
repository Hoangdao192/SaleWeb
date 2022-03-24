<?php
    include_once "Database.php";
?>

<?php
class Product {

    public $PRODUCT_TABLE_NAME = "product";
    public $COLUMN_PRODUCT_ID = "productId";
    public $COLUMN_PRODUCT_TYPE_ID = "productTypeId";
    public $COLUMN_PRODUCT_NAME = "productName";
    public $COLUMN_PRODUCT_COLOR = "productColor";
    public $COLUMN_PRODUCT_PRICE = "productPrice";
    public $COLUMN_PRODUCT_IMAGE_PATH = "productImagePath";

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    //  Get all product in product table
    public function show_product() {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME ORDER BY $this->COLUMN_PRODUCT_ID";
        $result = $this->database->query($query);
        return $result;
    }

    //  Insert new product to database
    public function insert_product($productTypeId, $productName, $productColor, $productPrice, $productImagePath) {
        $query = "INSERT INTO $this->PRODUCT_TABLE_NAME (
                $this->COLUMN_PRODUCT_TYPE_ID, 
                $this->COLUMN_PRODUCT_NAME, 
                $this->COLUMN_PRODUCT_COLOR, 
                $this->COLUMN_PRODUCT_PRICE, 
                $this->COLUMN_PRODUCT_IMAGE_PATH)
        VALUES($productTypeId, '$productName', '$productColor', $productPrice, '$productImagePath')";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get a single product have this id
    public function get_product($productId) {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME WHERE $this->COLUMN_PRODUCT_ID = $productId";
        $result = $this->database->query($query);
        return $result;
    }

    //  Update a product's information
    public function update_product($productId, $productTypeId, $productName, $productColor, $productPrice, $productImagePath) {
        $query = 
                "UPDATE $this->PRODUCT_TABLE_NAME 
                SET $this->COLUMN_PRODUCT_TYPE_ID = $productTypeId, 
                    $this->COLUMN_PRODUCT_NAME = '$productName',
                    $this->COLUMN_PRODUCT_COLOR = '$productColor',
                    $this->COLUMN_PRODUCT_PRICE = $productPrice,
                    $this->COLUMN_PRODUCT_IMAGE_PATH = '$productImagePath' 
                WHERE $this->COLUMN_PRODUCT_ID = $productId";
        $result = $this->database->query($query);
        return $result;
    }

    //  Delete a product with this id
    public function delete_product($productId) {
        $query = "DELETE FROM $this->PRODUCT_TABLE_NAME WHERE $this->COLUMN_PRODUCT_ID = $productId";
        $result = $this->database->query($query);
        return $result;
    }
}
?>