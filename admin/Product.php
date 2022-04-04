<?php
    include_once "Database.php";
    include_once "ProductType.php"
?>

<?php
class Product {

    public $PRODUCT_TABLE_NAME = "product";
    public $COLUMN_CATEGORY_ID = "categoryId";
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

    public function show_product_limit($offset, $limit) {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME ORDER BY $this->COLUMN_PRODUCT_ID LIMIT $offset, $limit";
        $result = $this->database->query($query);
        return $result;
    }

    public function show_new_product_limit($offset, $limit) {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME ORDER BY $this->COLUMN_PRODUCT_ID DESC LIMIT $offset, $limit";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get all product have category id equal $categoryId
    public function show_product_by_category($categoryId) {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME WHERE $this->COLUMN_CATEGORY_ID = $categoryId
                ORDER BY $this->COLUMN_PRODUCT_ID";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get all product have product type id equal
    public function show_product_by_type($productTypeId) {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME WHERE $this->COLUMN_PRODUCT_TYPE_ID = $productTypeId
                ORDER BY $this->COLUMN_PRODUCT_ID";
        $result = $this->database->query($query);
        return $result;
    }

    //  Insert new product to database
    public function insert_product($productTypeId, $productName, $productColor, $productPrice) {

        $productType = new ProductType;
        $thisProductType = $productType->get_product_type($productTypeId);
        $showProductType = $thisProductType->fetch_assoc();
        $categoryId = $showProductType['categoryId'];

        $imagePath = $_FILES['productImage']['name'];
        $query = "INSERT INTO $this->PRODUCT_TABLE_NAME (
                $this->COLUMN_PRODUCT_TYPE_ID, 
                $this->COLUMN_PRODUCT_NAME, 
                $this->COLUMN_PRODUCT_COLOR, 
                $this->COLUMN_PRODUCT_PRICE, 
                $this->COLUMN_PRODUCT_IMAGE_PATH, 
                categoryId)
        VALUES($productTypeId, '$productName', '$productColor', $productPrice, '$imagePath', $categoryId);";
        $result = $this->database->query($query);
        $lastId = $this->database->link->insert_id;
        move_uploaded_file($_FILES['productImage']['tmp_name'], "database/".$lastId);

        //  Change image file's name to productId so it easy to find and cannot be replaced
        $query = 
        "UPDATE $this->PRODUCT_TABLE_NAME 
        SET $this->COLUMN_PRODUCT_IMAGE_PATH = '$lastId' 
        WHERE $this->COLUMN_PRODUCT_ID = $lastId";
        $this->database->query($query);

        return $result;
    }

    //  Get a single product have this id
    public function get_product($productId) {
        $query = "SELECT * FROM $this->PRODUCT_TABLE_NAME WHERE $this->COLUMN_PRODUCT_ID = $productId";
        $result = $this->database->query($query);
        return $result;
    }

    //  Update a product's information
    public function update_product($productId, $productTypeId, $productName, $productColor, $productPrice) {
        $productType = new ProductType;
        $thisProductType = $productType->get_product_type($productTypeId);
        $showProductType = $thisProductType->fetch_assoc();
        $categoryId = $showProductType['categoryId'];

        $imagePath = $_FILES['productImage']['name'];
        move_uploaded_file($_FILES['productImage']['tmp_name'], "database/".$productId);
        $query = 
                "UPDATE $this->PRODUCT_TABLE_NAME 
                SET $this->COLUMN_PRODUCT_TYPE_ID = $productTypeId, 
                    $this->COLUMN_PRODUCT_NAME = '$productName',
                    $this->COLUMN_PRODUCT_COLOR = '$productColor',
                    $this->COLUMN_PRODUCT_PRICE = $productPrice,
                    $this->COLUMN_PRODUCT_IMAGE_PATH = '$imagePath',
                    categoryId = $categoryId
                WHERE $this->COLUMN_PRODUCT_ID = $productId";
        $result = $this->database->query($query);

        //  Change image file's name to productId so it easy to find and cannot be replaced
        $query = 
        "UPDATE $this->PRODUCT_TABLE_NAME 
        SET $this->COLUMN_PRODUCT_IMAGE_PATH = '$productId' 
        WHERE $this->COLUMN_PRODUCT_ID = $productId";
        $this->database->query($query);

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