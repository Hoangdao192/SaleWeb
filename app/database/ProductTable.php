<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Product.php";
?>

<?php
class ProductTable {

    public static $PRODUCT_TABLE_NAME = "product";
    public static $COL_CATEGORY_ID = "categoryId";
    public static $COL_PRODUCT_ID = "productId";
    public static $COL_PRODUCT_TYPE_ID = "productTypeId";
    public static $COL_PRODUCT_NAME = "productName";
    public static $COL_PRODUCT_COLOR = "productColor";
    public static $COL_PRODUCT_PRICE = "productPrice";
    public static $COL_PRODUCT_IMAGE_PATH = "productImagePath";

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    /*Convert mysqli_result to Product model*/
    public function parseProduct($item /*mysqli_result fetch_assoc item*/) {
        $product = new Product();
        $product->id = $item[ProductTable::$COL_PRODUCT_ID];
        $product->categoryId = $item[ProductTable::$COL_CATEGORY_ID];
        $product->typeId = $item[ProductTable::$COL_PRODUCT_TYPE_ID];
        $product->name = $item[ProductTable::$COL_PRODUCT_NAME];

        $color = $item[ProductTable::$COL_PRODUCT_COLOR];
        $splitRegex = "/,/";
        $colorArray = preg_split($splitRegex, $color);

        $product->color = $colorArray;
        $product->price = $item[ProductTable::$COL_PRODUCT_PRICE];
        $product->imagePath = $item[ProductTable::$COL_PRODUCT_IMAGE_PATH];
        return $product;
    }

    /*Insert new product to database*/
    public function insertProduct($product) {
        $product_type = new ProductType;
       
        $imagePath = $_FILES['productImagePath']['name'];
        $contentArray = [];
        $contentArray[ProductTable::$COL_PRODUCT_TYPE_ID] = $product->typeId;
        $contentArray[ProductTable::$COL_PRODUCT_NAME] = $product->name;
        $contentArray[ProductTable::$COL_PRODUCT_COLOR] = $product->color;
        $contentArray[ProductTable::$COL_PRODUCT_PRICE] = $product->price;
        $contentArray[ProductTable::$COL_PRODUCT_IMAGE_PATH] = $imagePath;
        $contentArray[ProductTable::$COL_CATEGORY_ID] = $product->categoryId;

        $query = new Query();
        $query->insert(ProductTable::$PRODUCT_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());

        $lastId = $this->database->link->insert_id;

        move_uploaded_file($_FILES['productImagePath']['tmp_name'], "database/".$lastId);

        //  Change image file's name to productId so it easy to find and cannot be replaced
        unset($query);
        unset($contentArray);
        $query = new Query();
        $contentArray = [];
        $contentArray[ProductTable::$COL_PRODUCT_IMAGE_PATH] = $lastId;
        $query->update(ProductTable::$PRODUCT_TABLE_NAME, $contentArray, ProductTable::$COL_PRODUCT_ID. " = $lastId");
        
        $this->database->query($query->build());

        return $result;
    }

    /*Update a product's information*/
    public function updateProduct($product) {
        $imagePath = $_FILES['productImagePath']['name'];
        move_uploaded_file($_FILES['productImagePath']['tmp_name'], "database/".$product->id);

        $query = new Query();
        $contentArray = [];
        $contentArray[ProductTable::$COL_PRODUCT_TYPE_ID] = $product->typeId;
        $contentArray[ProductTable::$COL_PRODUCT_NAME] = $product->name;
        $contentArray[ProductTable::$COL_PRODUCT_COLOR] = $product->color;
        $contentArray[ProductTable::$COL_PRODUCT_PRICE] = $product->price;
        $contentArray[ProductTable::$COL_PRODUCT_IMAGE_PATH] = $imagePath;
        $contentArray[ProductTable::$COL_CATEGORY_ID] = $product->categoryId;
        $query->update(ProductTable::$PRODUCT_TABLE_NAME, $contentArray, ProductTable::$COL_PRODUCT_ID. " = $product->id");

        $result = $this->database->query($query->build());

        unset($query);
        unset($contentArray);
        //  Change image file's name to productId so it easy to find and cannot be replaced
        $contentArray = [];
        $contentArray[ProductTable::$COL_PRODUCT_IMAGE_PATH] = strval($product->id);
        $query = new Query();
        $query->update(ProductTable::$PRODUCT_TABLE_NAME, $contentArray, ProductTable::$COL_PRODUCT_ID. " = $product->id");
        $this->database->query($query->build());

        return $result;
    }

    /*Delete a product with this id*/
    public function deleteProduct($productId) {
        $query = new Query();
        $query->delete(ProductTable::$PRODUCT_TABLE_NAME, ProductTable::$COL_PRODUCT_ID. " = $productId");
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get a single product have this id*/
    public function getProduct($productId) {
        $query = new Query();
        $query->getAll(ProductTable::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductTable::$COL_PRODUCT_ID. " = $productId");
        
        $result = $this->database->query($query->build());
        return $this->parseProduct($result->fetch_assoc());
    }

    /*Get all product in product table*/
    public function getAll() {
        $query = new Query();
        $query->getAll(ProductTable::$PRODUCT_TABLE_NAME)->orderBy(ProductTable::$COL_PRODUCT_ID);

        $result = $this->database->query($query->build());
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parseProduct($item);
        }
        return $products;
    }

     /*Get all product have product type id equal*/
     public function getAllFilterByType($typeId) {
        $query = new Query();
        $query->getAll(ProductTable::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductTable::$COL_PRODUCT_TYPE_ID . " = $typeId")
                ->orderBy(ProductTable::$COL_PRODUCT_ID);

        $result = $this->database->query($query->build());
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parseProduct($item);
        }
        return $products;
    }

    /*Get all product by category id*/
    public function getAllFilterByCategory($categoryId) {
        $query = new Query();
        $query->getAll(ProductTable::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductTable::$COL_CATEGORY_ID . " = $categoryId")
                ->orderBy(ProductTable::$COL_PRODUCT_ID);

        $result = $this->database->query($query->build());
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parseProduct($item);
        }
        return $products;
    }

    /*Get all product filter by name, type id, category id*/
    public function getAllFilterByName($targetName, $productTypeId, $categoryId) {        
        $query = new Query();
        $query->getAll(ProductTable::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductTable::$COL_CATEGORY_ID . " = $categoryId")
                ->filterBy(ProductTable::$COL_PRODUCT_NAME . " LIKE '$targetName%' ");
        if ($productTypeId != -1) {
            $query->filterBy(ProductTable::$COL_PRODUCT_TYPE_ID . " = $productTypeId");
        }
        $query->orderBy(ProductTable::$COL_PRODUCT_ID);

        $result = $this->database->query($query->build());
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parseProduct($item);
        }
        return $products;
    }
}
?>