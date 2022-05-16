<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\Product;
use App\Model\ProductType;
use Core\HTML;

class ProductDAO extends BaseDAO {

    public static $PRODUCT_TABLE_NAME = "product";
    public static $COL_CATEGORY_ID = "categoryId";
    public static $COL_PRODUCT_ID = "productId";
    public static $COL_PRODUCT_TYPE_ID = "productTypeId";
    public static $COL_PRODUCT_NAME = "productName";
    public static $COL_PRODUCT_COLOR = "productColor";
    public static $COL_PRODUCT_PRICE = "productPrice";
    public static $COL_PRODUCT_IMAGE_PATH = "productImagePath";

    /*Convert mysqli_result to Product model*/
    public function parseProduct($item /*mysqli_result fetch_assoc item*/) {
        $product = new Product();
        $product->id = $item[ProductDAO::$COL_PRODUCT_ID];
        $product->categoryId = $item[ProductDAO::$COL_CATEGORY_ID];
        $product->typeId = $item[ProductDAO::$COL_PRODUCT_TYPE_ID];
        $product->name = $item[ProductDAO::$COL_PRODUCT_NAME];

        $color = $item[ProductDAO::$COL_PRODUCT_COLOR];
        $splitRegex = "/,/";
        $colorArray = preg_split($splitRegex, $color);

        $product->color = $colorArray;
        $product->price = $item[ProductDAO::$COL_PRODUCT_PRICE];
        $product->imagePath = $item[ProductDAO::$COL_PRODUCT_IMAGE_PATH];
        return $product;
    }

    /*Insert new product to database*/
    public function insertProduct($product) {
        $product_type = new ProductType;
       
        $imagePath = $_FILES['productImagePath']['name'];
        $contentArray = [];
        $contentArray[ProductDAO::$COL_PRODUCT_TYPE_ID] = $product->typeId;
        $contentArray[ProductDAO::$COL_PRODUCT_NAME] = $product->name;
        $contentArray[ProductDAO::$COL_PRODUCT_COLOR] = $product->color;
        $contentArray[ProductDAO::$COL_PRODUCT_PRICE] = $product->price;
        $contentArray[ProductDAO::$COL_PRODUCT_IMAGE_PATH] = $imagePath;
        $contentArray[ProductDAO::$COL_CATEGORY_ID] = $product->categoryId;

        $query = new Query();
        $query->insert(ProductDAO::$PRODUCT_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());

        $lastId = $this->database->link->insert_id;

        move_uploaded_file($_FILES['productImagePath']['tmp_name'], "./public/images/database/".$lastId);

        //  Change image file's name to productId so it easy to find and cannot be replaced
        unset($query);
        unset($contentArray);
        $query = new Query();
        $contentArray = [];
        $contentArray[ProductDAO::$COL_PRODUCT_IMAGE_PATH] = $lastId;
        $query->update(ProductDAO::$PRODUCT_TABLE_NAME, $contentArray, ProductDAO::$COL_PRODUCT_ID. " = $lastId");
        
        $this->database->query($query->build());

        return $result;
    }

    /*Update a product's information*/
    public function updateProduct($product) {
        $imagePath = $_FILES['productImagePath']['name'];
        move_uploaded_file($_FILES['productImagePath']['tmp_name'], "./public/images/database/".$product->id);

        $query = new Query();
        $contentArray = [];
        $contentArray[ProductDAO::$COL_PRODUCT_TYPE_ID] = $product->typeId;
        $contentArray[ProductDAO::$COL_PRODUCT_NAME] = $product->name;
        $contentArray[ProductDAO::$COL_PRODUCT_COLOR] = $product->color;
        $contentArray[ProductDAO::$COL_PRODUCT_PRICE] = $product->price;
        $contentArray[ProductDAO::$COL_PRODUCT_IMAGE_PATH] = $imagePath;
        $contentArray[ProductDAO::$COL_CATEGORY_ID] = $product->categoryId;
        $query->update(ProductDAO::$PRODUCT_TABLE_NAME, $contentArray, ProductDAO::$COL_PRODUCT_ID. " = $product->id");

        $result = $this->database->query($query->build());

        unset($query);
        unset($contentArray);
        //  Change image file's name to productId so it easy to find and cannot be replaced
        $contentArray = [];
        $contentArray[ProductDAO::$COL_PRODUCT_IMAGE_PATH] = strval($product->id);
        $query = new Query();
        $query->update(ProductDAO::$PRODUCT_TABLE_NAME, $contentArray, ProductDAO::$COL_PRODUCT_ID. " = $product->id");
        $this->database->query($query->build());

        return $result;
    }

    /*Delete a product with this id*/
    public function deleteProduct($productId) {
        $query = new Query();
        $query->delete(ProductDAO::$PRODUCT_TABLE_NAME, ProductDAO::$COL_PRODUCT_ID. " = $productId");
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get a single product have this id*/
    public function getProduct($productId) {
        $query = new Query();
        $query->getAll(ProductDAO::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductDAO::$COL_PRODUCT_ID. " = $productId");
        
        $result = $this->database->query($query->build());
        return $this->parseProduct($result->fetch_assoc());
    }

    /*Get all product in product table*/
    public function getAll() {
        $query = new Query();
        $query->getAll(ProductDAO::$PRODUCT_TABLE_NAME)->orderBy(ProductDAO::$COL_PRODUCT_ID);

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
        $query->getAll(ProductDAO::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductDAO::$COL_PRODUCT_TYPE_ID . " = $typeId")
                ->orderBy(ProductDAO::$COL_PRODUCT_ID);

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
        $query->getAll(ProductDAO::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductDAO::$COL_CATEGORY_ID . " = $categoryId")
                ->orderBy(ProductDAO::$COL_PRODUCT_ID);

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
        $query->getAll(ProductDAO::$PRODUCT_TABLE_NAME)
                ->filterBy(ProductDAO::$COL_CATEGORY_ID . " = $categoryId")
                ->filterBy(ProductDAO::$COL_PRODUCT_NAME . " LIKE '$targetName%' ");
        if ($productTypeId != -1) {
            $query->filterBy(ProductDAO::$COL_PRODUCT_TYPE_ID . " = $productTypeId");
        }
        $query->orderBy(ProductDAO::$COL_PRODUCT_ID);

        $result = $this->database->query($query->build());
        $products = [];
        while ($item = $result->fetch_assoc()) {
            $products[] = $this->parseProduct($item);
        }
        return $products;
    }
}
?>