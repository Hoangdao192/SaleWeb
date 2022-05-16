<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\ProductType;

class ProductTypeDAO extends BaseDAO {

    public static $PRODUCT_TYPE_TABLE_NAME = 'producttype';
    public static $COL_PRODUCT_TYPE_ID = 'productTypeId';
    public static $COLUMN_CATEGORY_ID = 'categoryId';
    public static $COL_PRODUCT_TYPE_NAME = 'productTypeName';

    /*Convert mysqli_result to ProductType model*/
    public function parseProductType($item /*mysqli_result fetch_assoc item*/) {
        $productType = new ProductType();
        $productType->id = $item[ProductTypeDAO::$COL_PRODUCT_TYPE_ID];
        $productType->categoryId = $item[ProductTypeDAO::$COLUMN_CATEGORY_ID];
        $productType->name = $item[ProductTypeDAO::$COL_PRODUCT_TYPE_NAME];
        return $productType;
    }

    /*Insert new product type to database*/
    public function insertProductType($productType) {
        $contentArray = [];
        $contentArray[ProductTypeDAO::$COLUMN_CATEGORY_ID] = $productType->categoryId;
        $contentArray[ProductTypeDAO::$COL_PRODUCT_TYPE_NAME] = $productType->name;
        $query = new Query();
        $query->insert(ProductTypeDAO::$PRODUCT_TYPE_TABLE_NAME, $contentArray);
        
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get product type by id*/
    public function getProductType($productTypeId) {
        $query = new Query();
        $query->getAll(ProductTypeDAO::$PRODUCT_TYPE_TABLE_NAME)
                ->filterBy(ProductTypeDAO::$COL_PRODUCT_TYPE_ID. " = $productTypeId");
        $result = $this->database->query($query->build());
        return $this->parseProductType($result->fetch_assoc());
    }

    /*Update a product type's information*/
    public function updateProductType($productType) {
        $contentArray = [];
        $contentArray[ProductTypeDAO::$COLUMN_CATEGORY_ID] = $productType->categoryId;
        $contentArray[ProductTypeDAO::$COL_PRODUCT_TYPE_NAME] = $productType->name;
        $query = new Query();
        $query->update(ProductTypeDAO::$PRODUCT_TYPE_TABLE_NAME, $contentArray, 
                        ProductTypeDAO::$COL_PRODUCT_TYPE_ID. " = $productType->id");

        $result = $this->database->query($query->build());
        return $result;
    }

    /*Delete a product type*/
    public function deleteProductType($productTypeId) {
        $query = new Query();
        $query->delete(ProductTypeDAO::$PRODUCT_TYPE_TABLE_NAME, ProductTypeDAO::$COL_PRODUCT_TYPE_ID. " = $productTypeId");
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get all product type*/
    public function getAll() {
        $query = new Query();
        $query->getAll(ProductTypeDAO::$PRODUCT_TYPE_TABLE_NAME)
                ->orderBy(ProductTypeDAO::$COL_PRODUCT_TYPE_ID);

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
        $query->getAll(ProductTypeDAO::$PRODUCT_TYPE_TABLE_NAME)
                ->filterBy(ProductTypeDAO::$COLUMN_CATEGORY_ID. " = $categoryId")
                ->orderBy(ProductTypeDAO::$COL_PRODUCT_TYPE_ID);
        
        $result = $this->database->query($query->build());
        $productTypes = [];
        while ($item = $result->fetch_assoc()) {
            $productTypes[] = $this->parseProductType($item);
        }
        return $productTypes;
    }
}
?>