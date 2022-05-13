<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Category.php";

class CategoryTable {
    public static $CATEGORY_TABLE_NAME = 'productcategory';
    public static $COL_CATEGORY_ID = 'categoryId';
    public static $COL_CATEGORY_NAME = 'categoryName';

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    /*Convert mysqli_result to Category model*/
    public function parseCategory($item /*mysqli_result fetch_assoc item*/) {
        $category = new Category();
        $category->id = $item[CategoryTable::$COL_CATEGORY_ID];
        $category->name = $item[CategoryTable::$COL_CATEGORY_NAME];
        return $category;
    }

    /*Get all Category*/
    public function getAll() {
        $query = new Query();
        $query->getAll(CategoryTable::$CATEGORY_TABLE_NAME)
                ->orderBy(CategoryTable::$COL_CATEGORY_ID);
        $result = $this->database->query($query->build());
        $categories = [];
        while ($item = $result->fetch_assoc()) {
            $categories[] = $this->parseCategory($item);
        }
        return $categories;
    }

    /*Insert new Category*/
    public function insertCategory($category) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CategoryTable::$COL_CATEGORY_NAME] = $category->name;
        $query->insert(CategoryTable::$CATEGORY_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get category by id*/
    public function getCategory($categoryId) {
        $query = new Query();
        $query->getAll(CategoryTable::$CATEGORY_TABLE_NAME)
                ->filterBy(CategoryTable::$COL_CATEGORY_ID . " = $categoryId");
        $result = $this->database->query($query->build());
        return $this->parseCategory($result->fetch_assoc());
    }

    /*Update category*/
    public function updateCategory($category) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CategoryTable::$COL_CATEGORY_NAME] = $category->name;
        $query->update(CategoryTable::$CATEGORY_TABLE_NAME, $contentArray, CategoryTable::$COL_CATEGORY_ID . " = $category->id");
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Delete category*/
    public function deleteCategory($categoryId) {
        $query = new Query();
        $query->delete(CategoryTable::$CATEGORY_TABLE_NAME, CategoryTable::$COL_CATEGORY_ID . " = $categoryId");
        $result = $this->database->query($query->build());
        return $result;
    }
}
?>