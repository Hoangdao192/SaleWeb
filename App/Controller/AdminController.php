<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\CategoryDAO;
use App\Database\DAO\CustomerDAO;
use App\Database\DAO\OrderDAO;
use App\Database\DAO\OrderDetailDAO;
use App\Database\DAO\ProductTypeDAO;
use App\Database\DAO\ProductDAO;
use App\Database\DAO\UserDAO;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductType;

class AdminController extends BaseController {
    public function showErrorPage() {
        $this->views("layout.404");
    }

    public function showHomePage() {
        $this->views("layout.admin");
    }

    public function showCategoryPage() {
        $categoryDAO = new CategoryDAO();
        $data = [
            'page' => "Pages/admin/show_category",
            'categories' => $categoryDAO->getAll()
        ];
        $this->views("layout.admin", $data);
    }

    public function showAddCategoryPage() {
        $data = [
            'page' => "Pages/admin/add_category",
        ];
        $this->views("layout.admin", $data);
    }

    public function showEditCategoryPage() {
        $categoryId = intval($_POST['categoryId']);
        $categoryDAO = new CategoryDAO();
        $category = $categoryDAO->getCategory($categoryId);
        $data = [
            'page' => "Pages/admin/edit_category",
            'category' => $category
        ];
        $this->views("layout.admin", $data);
    }

    public function addCategory() {
        $categoryDAO = new CategoryDAO;
        $category = new Category;
        $category->name = $_POST[CategoryDAO::$COL_CATEGORY_NAME];
        $categoryDAO->insertCategory($category);
        header("Location: http://localhost/saleweb/admin/addcategory");
    }

    public function editCategory() {
        $category = new Category();
        $category->id = $_POST[CategoryDAO::$COL_CATEGORY_ID];
        $category->name = $_POST[CategoryDAO::$COL_CATEGORY_NAME];
        $categoryDAO = new CategoryDAO();
        $categoryDAO->updateCategory($category);
        header('Location: http://localhost/saleweb/admin/category');
    }

    public function deleteCategory() {
        $categoryId = intval($_POST['categoryId']);
        $categoryDAO = new CategoryDAO();
        $categoryDAO->deleteCategory($categoryId);
        header('Location: http://localhost/saleweb/admin/category');
    }

    public function showAddProductTypePage() {
        $categoryDAO = new CategoryDAO;
        $data = [
            'categories' => $categoryDAO->getAll(),
            'page' => "Pages/admin/add_product_type"
        ];
        $this->views("layout.admin", $data);
    }

    public function showEditProductTypePage() {
        $productTypeId = $_POST[ProductTypeDAO::$COL_PRODUCT_TYPE_ID];
        $productTypeDAO = new ProductTypeDAO;
        $categoryDAO = new CategoryDAO;
        $data = [
            'categories' => $categoryDAO->getAll(),
            'page' => "Pages/admin/edit_product_type",
            'productType' => $productTypeDAO->getProductType($productTypeId)
        ];
        $this->views("layout.admin", $data);
    }

    public function showProductTypePage() {
        $productTypeDAO = new ProductTypeDAO();
        $data = [
            'page' => "Pages/admin/show_product_type",
            'producttypes' => $productTypeDAO->getAll(),
            'categoryDAO' => new CategoryDAO
        ];
        $this->views("layout.admin", $data);
    }

    public function addProductType() {
        $categoryId = $_POST[CategoryDAO::$COL_CATEGORY_ID];
        $productTypeName = $_POST[ProductTypeDAO::$COL_PRODUCT_TYPE_NAME];
        $productType = new ProductType;
        $productType->categoryId = $categoryId;
        $productType->name = $productTypeName;

        $productTypeDAO = new ProductTypeDAO();
        $productTypeDAO->insertProductType($productType);

        header("Location: http://localhost/saleweb/admin/addproducttype");
    }

    public function editProductType() {
        $productTypeId = $_POST[ProductTypeDAO::$COL_PRODUCT_TYPE_ID];
        $categoryId = $_POST[CategoryDAO::$COL_CATEGORY_ID];
        $product_type_name = $_POST[ProductTypeDAO::$COL_PRODUCT_TYPE_NAME];

        $productType = new ProductType;
        $productType->id = $productTypeId;
        $productType->categoryId = $categoryId;
        $productType->name = $product_type_name;

        $productTypeDAO = new ProductTypeDAO();
        $productTypeDAO->updateProductType($productType);
        header("Location: http://localhost/saleweb/admin/producttype");
    }

    public function deleteProductType() {
        $productTypeId = $_POST[ProductTypeDAO::$COL_PRODUCT_TYPE_ID];
        $productTypeDAO = new ProductTypeDAO();
        $productTypeDAO->deleteProductType($productTypeId);
        header("Location: http://localhost/saleweb/admin/producttype");
    }

    public function showProductPage() {
        $productDAO = new ProductDAO;
        $data = [
            'products' => $productDAO->getAll(),
            'page' => "Pages/admin/show_product",
            'productTypeDAO' => new ProductTypeDAO,
            'categoryDAO' => new CategoryDAO
        ];
        $this->views("layout.admin", $data);
    }

    public function showAddProductPage() {
        $categoryDAO = new CategoryDAO;
        $productTypeDAO = new ProductTypeDAO;
        $data = [
            'categories' => $categoryDAO->getAll(),
            'productTypes' => $productTypeDAO->getAll(),
            'categoryDAO' => new CategoryDAO,
            'page' => "Pages/admin/add_product"
        ];
        $this->views("layout.admin", $data);
    }

    public function showEditProductPage() {
        $productId = $_POST[ProductDAO::$COL_PRODUCT_ID];
        $productDAO = new ProductDAO;
        $productTypeDAO = new ProductTypeDAO;
        $data = [
            'product' => $productDAO->getProduct($productId),
            'productTypes' => $productTypeDAO->getAll(),
            'page' => "Pages/admin/edit_product"
        ];
        $this->views("layout.admin", $data);
    }

    public function addProduct() {
        $productDAO = new ProductDAO;
        $productTypeDAO = new ProductTypeDAO;

        $product = new Product();
        $product->typeId = $_POST[ProductDAO::$COL_PRODUCT_TYPE_ID];
        $product->categoryId = $productTypeDAO->getProductType($product->typeId)->categoryId;
        $product->name = $_POST[ProductDAO::$COL_PRODUCT_NAME];
        $product->color = $_POST[ProductDAO::$COL_PRODUCT_COLOR];
        $product->price = $_POST[ProductDAO::$COL_PRODUCT_PRICE];

        $productDAO->insertProduct($product, $_FILES);

        header('Location: http://localhost/saleweb/admin/addproduct');
    }

    public function editProduct() {
        $productId = $_POST[ProductDAO::$COL_PRODUCT_ID];
        $productTypeDAO = new ProductTypeDAO;
        $product = new Product();
        $product->id = $productId;
        $product->typeId = $_POST[ProductDAO::$COL_PRODUCT_TYPE_ID];
        $product->categoryId = $productTypeDAO->getProductType($product->typeId)->categoryId;
        $product->name = $_POST[ProductDAO::$COL_PRODUCT_NAME];
        $product->color = $_POST[ProductDAO::$COL_PRODUCT_COLOR];
        $product->price = $_POST[ProductDAO::$COL_PRODUCT_PRICE];

        $productDAO = new ProductDAO;
        $productDAO->updateProduct($product, $_FILES);
        header('Location: http://localhost/saleweb/admin/product');
    }

    public function deleteProduct() {
        $productId = $_POST[ProductDAO::$COL_PRODUCT_ID];
        $productDAO = new ProductDAO;
        $productDAO->deleteProduct($productId);
        header('Location: http://localhost/saleweb/admin/product');
    }

    public function showOrderPage() {
        $orderDAO = new OrderDAO();
        $data = [
            'page' => 'Pages/admin/show_order',
            'orders' => $orderDAO->getAll(),
            'userDAO' => new UserDAO,
            'customerDAO' => new CustomerDAO
        ];
        $this->views('layout.admin', $data);
    }

    public function showOrderDetail() {
        $orderNumber = $_POST['orderNumber'];

        $orderDAO = new OrderDAO();
        $order = $orderDAO->getOrder($orderNumber);

        $orderDetailDAO = new OrderDetailDAO();
        $orderDetails = $orderDetailDAO->getAllFilterByOrderNumber($orderNumber);

        $customerDAO = new CustomerDAO();
        $customer = $customerDAO->getCustomer($order->userId);

        $data = [
            'page' => "Pages/admin/show_order_detail",
            'order' => $order,
            'orderDetails' => $orderDetails,
            'customer' => $customer,
            'productDAO' => new ProductDAO
        ];
        $this->views('layout.admin', $data);
    }

    public function deleteOrder() {
        $orderNumber = $_POST['orderNumber'];
        $orderDAO = new OrderDAO();
        $orderDAO->deleteOrder($orderNumber);
        header('Location: http://localhost/saleweb/admin/order');
    }
}
?>