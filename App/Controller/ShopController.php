<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\CategoryDAO;
use App\Database\DAO\ProductDAO;
use App\Database\DAO\ProductTypeDAO;

class ShopController extends BaseController {
    public function showMainPage($variableName = "", $variableValue = -1) {
        $categoryDAO = new CategoryDAO();
        $categories = $categoryDAO->getAll();

        $categoryId = $categories[0]->id;
        if ($variableValue != -1) {
            $categoryId = intval($variableValue);
        }

        if (isset($_POST['categoryId'])) {
            $categoryId = intval($_POST['categoryId']);
        }

        $productTypeDAO = new ProductTypeDAO();
        $productTypes = $productTypeDAO->getAllFilterByCategory($categoryId);

        $data = [
            "page" => "Pages/shop",
            "categoryId" => $categoryId,
            "categories" => $categories,
            "productTypes" => $productTypes
        ];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }

        $this->views('layout.user', $data);
    }

    public function getProductTypeByCategory() {
        $categoryId = intval($_POST['categoryId']);
        $productTypeDAO = new ProductTypeDAO();
        $productTypes = $productTypeDAO->getAllFilterByCategory(intval($categoryId));
        echo json_encode($productTypes);
    }

    public function showProductByCategory() {
        $categoryId = intval($_POST['categoryId']);
        $productDAO = new ProductDAO();
        $products = $productDAO->getAllFilterByCategory($categoryId);
        for ($i = 0; $i < sizeof($products); ++$i) {
            $this->views("Product.product_thumbnail", [
                "product" => $products[$i]
            ]);
        }
    }

    public function showProductByType() {
        $typeId = intval($_POST['productTypeId']);
        $productDAO = new ProductDAO();
        $products = $productDAO->getAllFilterByType($typeId);
        for ($i = 0; $i < sizeof($products); ++$i) {
            $this->views("Product.product_thumbnail", [
                "product" => $products[$i]
            ]);
        }
    }
}
?>