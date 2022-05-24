<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\Category;

class CategoryDAO extends BaseDAO {
    public static $CATEGORY_TABLE_NAME = 'productcategory';
    public static $COL_CATEGORY_ID = 'categoryId';
    public static $COL_CATEGORY_NAME = 'categoryName';

    /*Convert mysqli_result to Category model*/
    public function parseCategory($item /*mysqli_result fetch_assoc item*/) {
        $category = new Category();
        $category->id = $item[CategoryDAO::$COL_CATEGORY_ID];
        $category->name = $item[CategoryDAO::$COL_CATEGORY_NAME];
        return $category;
    }

    /*Get all Category*/
    public function getAll() {
        $query = new Query();
        $query->getAll(CategoryDAO::$CATEGORY_TABLE_NAME)
                ->orderBy(CategoryDAO::$COL_CATEGORY_ID);
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
        $contentArray[CategoryDAO::$COL_CATEGORY_NAME] = $category->name;
        $query->insert(CategoryDAO::$CATEGORY_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Get category by id*/
    public function getCategory($categoryId) {
        $query = new Query();
        $query->getAll(CategoryDAO::$CATEGORY_TABLE_NAME)
                ->filterBy(CategoryDAO::$COL_CATEGORY_ID . " = $categoryId");
        $result = $this->database->query($query->build());
        return $this->parseCategory($result->fetch_assoc());
    }

    /*Update category*/
    public function updateCategory($category) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CategoryDAO::$COL_CATEGORY_NAME] = $category->name;
        $query->update(CategoryDAO::$CATEGORY_TABLE_NAME, $contentArray, CategoryDAO::$COL_CATEGORY_ID . " = $category->id");
        $result = $this->database->query($query->build());
        return $result;
    }

    /*Delete category*/
    public function deleteCategory($categoryId) {
        $query = new Query();
        $query->delete(CategoryDAO::$CATEGORY_TABLE_NAME, CategoryDAO::$COL_CATEGORY_ID . " = $categoryId");
        $result = $this->database->query($query->build());
        return $result;
    }
}
?>