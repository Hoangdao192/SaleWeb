<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/product.php";
?>

<?php
class ProductTable {

    public static $PRODUCT_TABLE_NAME = "product";
    public static $COLUMN_CATEGORY_ID = "categoryId";
    public static $COLUMN_PRODUCT_ID = "productId";
    public static $COLUMN_PRODUCT_TYPE_ID = "productTypeId";
    public static $COLUMN_PRODUCT_NAME = "productName";
    public static $COLUMN_PRODUCT_COLOR = "productColor";
    public static $COLUMN_PRODUCT_PRICE = "productPrice";
    public static $COLUMN_PRODUCT_IMAGE_PATH = "productImagePath";

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function parse_product($item) {
        $product = new Product();
        $product->id = $item[ProductTable::$COLUMN_PRODUCT_ID];
        $product->category_id = $item[ProductTable::$COLUMN_CATEGORY_ID];
        $product->type_id = $item[ProductTable::$COLUMN_PRODUCT_TYPE_ID];
        $product->name = $item[ProductTable::$COLUMN_PRODUCT_NAME];

        $color = $item[ProductTable::$COLUMN_PRODUCT_COLOR];
        $splitRegex = "/,/";
        $color_array = preg_split($splitRegex, $color);

        $product->color = $color_array;
        $product->price = $item[ProductTable::$COLUMN_PRODUCT_PRICE];
        $product->image_path = $item[ProductTable::$COLUMN_PRODUCT_IMAGE_PATH];
        return $product;
    }

    //  Insert new product to database
    public function insert_product($product) {
        $product_type = new ProductType;
       
        $imagePath = $_FILES['productImagePath']['name'];
        $query = "INSERT INTO " . ProductTable::$PRODUCT_TABLE_NAME . " (
                " . ProductTable::$COLUMN_PRODUCT_TYPE_ID. ", 
                " . ProductTable::$COLUMN_PRODUCT_NAME. ", 
                " . ProductTable::$COLUMN_PRODUCT_COLOR. ", 
                " . ProductTable::$COLUMN_PRODUCT_PRICE. ", 
                " . ProductTable::$COLUMN_PRODUCT_IMAGE_PATH. ", 
                " . ProductTable::$COLUMN_CATEGORY_ID. ")
        VALUES($product->type_id, '$product->name', '$product->color', $product->price, '$imagePath', $product->category_id);";
        $result = $this->database->query($query);

        $lastId = $this->database->link->insert_id;

        move_uploaded_file($_FILES['productImagePath']['tmp_name'], "database/".$lastId);

        //  Change image file's name to productId so it easy to find and cannot be replaced
        $query = "UPDATE " . ProductTable::$PRODUCT_TABLE_NAME . " 
                    SET " . ProductTable::$COLUMN_PRODUCT_IMAGE_PATH. " = '$lastId' 
                    WHERE " . ProductTable::$COLUMN_PRODUCT_ID. " = $lastId";
        $this->database->query($query);

        return $result;
    }

    //  Update a product's information
    public function update_product($product) {
        $imagePath = $_FILES['productImagePath']['name'];
        move_uploaded_file($_FILES['productImagePath']['tmp_name'], "database/".$product->id);
        $query = 
                "UPDATE " . ProductTable::$PRODUCT_TABLE_NAME . " 
                SET " . ProductTable::$COLUMN_PRODUCT_TYPE_ID. " = $product->type_id, 
                    " . ProductTable::$COLUMN_PRODUCT_NAME. " = '$product->name',
                    " . ProductTable::$COLUMN_PRODUCT_COLOR. " = '$product->color',
                    " . ProductTable::$COLUMN_PRODUCT_PRICE. " = $product->price,
                    " . ProductTable::$COLUMN_PRODUCT_IMAGE_PATH. " = '$imagePath',
                    " . ProductTable::$COLUMN_CATEGORY_ID. " = $product->category_id
                WHERE " . ProductTable::$COLUMN_PRODUCT_ID. " = $product->id";
        $result = $this->database->query($query);

        //  Change image file's name to productId so it easy to find and cannot be replaced
        $query = "UPDATE " . ProductTable::$PRODUCT_TABLE_NAME . " 
                    SET " . ProductTable::$COLUMN_PRODUCT_IMAGE_PATH. " = '$product->id' 
                    WHERE " . ProductTable::$COLUMN_PRODUCT_ID. " = $product->id";
        $this->database->query($query);

        return $result;
    }

    //  Delete a product with this id
    public function delete_product($product_id) {
        $query = "DELETE FROM " . ProductTable::$PRODUCT_TABLE_NAME . " WHERE " . ProductTable::$COLUMN_PRODUCT_ID. " = $product_id";
        $result = $this->database->query($query);
        return $result;
    }

    //  Get a single product have this id
    public function get_product($product_id) {
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . " WHERE " . ProductTable::$COLUMN_PRODUCT_ID. " = $product_id";
        $result = $this->database->query($query);
        return $this->parse_product($result->fetch_assoc());
    }

    //  Get all product in product table
    public function get_all() {
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . " ORDER BY " . ProductTable::$COLUMN_PRODUCT_ID;
        $result = $this->database->query($query);
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parse_product($item);
        }
        return $products;
    }

     //  Get all product have product type id equal
     public function get_all_filter_by_type($type_id) {
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . " 
                    WHERE " . ProductTable::$COLUMN_PRODUCT_TYPE_ID. " = $type_id
                    ORDER BY " . ProductTable::$COLUMN_PRODUCT_ID. "";
        $result = $this->database->query($query);
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parse_product($item);
        }
        return $products;
    }

    //  Get all product have category id equal $categoryId
    public function get_all_filter_by_category($category_id) {
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . " WHERE " . ProductTable::$COLUMN_CATEGORY_ID . " = $category_id
                ORDER BY " . ProductTable::$COLUMN_PRODUCT_ID;
        $result = $this->database->query($query);
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parse_product($item);
        }
        return $products;
    }

    public function get_all_filter_by_name($target_name, $product_type_id, $category_id) {
        $find_by_type = "";
        if ($product_type_id != -1) {
            $find_by_type = " AND " . ProductTable::$COLUMN_PRODUCT_TYPE_ID . " = $product_type_id";
        }
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . 
                    " WHERE " . ProductTable::$COLUMN_CATEGORY_ID . " = $category_id " .
                        " AND " . ProductTable::$COLUMN_PRODUCT_NAME . " LIKE '$target_name%' " .
                        $find_by_type .
                    " ORDER BY " . ProductTable::$COLUMN_PRODUCT_ID;
        $result = $this->database->query($query);
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parse_product($item);
        }
        return $products;
    }

    public function show_product_limit($offset, $limit) {
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . " ORDER BY " . ProductTable::$COLUMN_CATEGORY_ID . " LIMIT $offset, $limit";
        $result = $this->database->query($query);
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parse_product($item);
        }
        return $products;
    }

    public function show_new_product_limit($offset, $limit) {
        $query = "SELECT * FROM " . ProductTable::$PRODUCT_TABLE_NAME . " ORDER BY " . ProductTable::$COLUMN_CATEGORY_ID . " DESC LIMIT $offset, $limit";
        $result = $this->database->query($query);
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parse_product($item);
        }
        return $products;
    }
}
?>