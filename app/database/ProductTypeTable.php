<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/ProductType.php";
?>

<?php
class ProductTypeTable {

    public static $PRODUCT_TYPE_TABLE_NAME = 'producttype';
    public static $COL_PRODUCT_TYPE_ID = 'productTypeId';
    public static $COLUMN_CATEGORY_ID = 'categoryId';
    public static $COL_PRODUCT_TYPE_NAME = 'productTypeName';

    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    /*Convert mysqli_result to ProductType model*/
    public function parseProductType($item /*mysqli_result fetch_assoc item*/) {
        $productType = new ProductType();
        $productType->id = $item[ProductTypeTable::$COL_PRODUCT_TYPE_ID];
        $productType->categoryId = $item[ProductTypeTable::$COLUMN_CATEGORY_ID];
        $productType->name = $item[ProductTypeTable::$COL_PRODUCT_TYPE_NAME];
        return $productType;
    }

    /*Insert new product type to database*/
    public function insertProductType($productType) {
        $contentArray = [];
        $contentArray[ProductTypeTable::$COLUMN_CATEGORY_ID] = $productType->categoryId;
        $contentArray[ProductTypeTable::$COL_PRODUCT_TYPE_NAME] = $productType->name;
        $query = new Query();
        $query->insert(ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME, $contentArray);
        
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get product type by id*/
    public function getProductType($productTypeId) {
        $query = new Query();
        $query->getAll(ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME)
                ->filterBy(ProductTypeTable::$COL_PRODUCT_TYPE_ID. " = $productTypeId");
        $result = $this->database->query($query->build());
        return $this->parseProductType($result->fetch_assoc());
    }

    /*Update a product type's information*/
    public function updateProductType($productType) {
        $contentArray = [];
        $contentArray[ProductTypeTable::$COLUMN_CATEGORY_ID] = $productType->categoryId;
        $contentArray[ProductTypeTable::$COL_PRODUCT_TYPE_NAME] = $productType->name;
        $query = new Query();
        $query->update(ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME, $contentArray, 
                        ProductTypeTable::$COL_PRODUCT_TYPE_ID. " = $productType->id");

        $result = $this->database->query($query->build());
        return $result;
    }

    /*Delete a product type*/
    public function deleteProductType($productTypeId) {
        $query = new Query();
        $query->delete(ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME, ProductTypeTable::$COL_PRODUCT_TYPE_ID. " = $productTypeId");
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get all product type*/
    public function getAll() {
        $query = new Query();
        $query->getAll(ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME)
                ->orderBy(ProductTypeTable::$COL_PRODUCT_TYPE_ID);

        $result = $this->database->query($query->build());
        $productTypes = [];
        while ($item = $result->fetch_assoc()) {
            $productTypes[] = $this->parseProductType($item);
        }
        return $productTypes;
    }

    /*Get all product type by category id*/
    public function getAllFilterByCategory($categoryId) {
        $query = new Query();
        $query->getAll(ProductTypeTable::$PRODUCT_TYPE_TABLE_NAME)
                ->filterBy(ProductTypeTable::$COLUMN_CATEGORY_ID. " = $categoryId")
                ->orderBy(ProductTypeTable::$COL_PRODUCT_TYPE_ID);
        
        $result = $this->database->query($query->build());
        $productTypes = [];
        while ($item = $result->fetch_assoc()) {
            $productTypes[] = $this->parseProductType($item);
        }
        return $productTypes;
    }
}
?>