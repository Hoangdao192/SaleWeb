<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\CategoryDAO;
use App\Database\DAO\CustomerDAO;
use App\Database\DAO\OrderDAO;
use App\Database\DAO\OrderDetailDAO;
use App\Database\DAO\ProductTypeDAO;
use App\Database\DAO\ProductDAO;
use App\Database\DAO\ShippingAddressDAO;
use App\Database\DAO\UserDAO;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductType;
use Core\HTML;

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
        $url = HTML::getUrl("admin/addcategory");
        header("Location: $url");
    }

    public function editCategory() {
        $category = new Category();
        $category->id = $_POST[CategoryDAO::$COL_CATEGORY_ID];
        $category->name = $_POST[CategoryDAO::$COL_CATEGORY_NAME];
        $categoryDAO = new CategoryDAO();
        $categoryDAO->updateCategory($category);
        $url = HTML::getUrl("admin/category");
        header("Location: $url");
    }

    public function deleteCategory() {
        $categoryId = intval($_POST['categoryId']);
        $categoryDAO = new CategoryDAO();
        $categoryDAO->deleteCategory($categoryId);
        $url = HTML::getUrl("admin/category");
        header("Location: $url");
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

        $url = HTML::getUrl("admin/addproducttype");
        header("Location: $url");
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
        $url = HTML::getUrl("admin/producttype");
        header("Location: $url");
    }

    public function deleteProductType() {
        $productTypeId = $_POST[ProductTypeDAO::$COL_PRODUCT_TYPE_ID];
        $productTypeDAO = new ProductTypeDAO();
        $productTypeDAO->deleteProductType($productTypeId);

        $url = HTML::getUrl("admin/producttype");
        header("Location: $url");
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

        $url = HTML::getUrl("admin/addproduct");
        header("Location: $url");
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

        $url = HTML::getUrl("admin/product");
        header("Location: $url");
    }

    public function deleteProduct() {
        $productId = $_POST[ProductDAO::$COL_PRODUCT_ID];
        $productDAO = new ProductDAO;
        $productDAO->deleteProduct($productId);

        $url = HTML::getUrl("admin/product");
        header("Location: $url");
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

        $url = HTML::getUrl("admin/order");
        header("Location: $url");
    }

    public function showCustomer() {
        $customerDAO = new CustomerDAO();
        $data = [
            'page' => "Pages/admin/show_customer",
            'customers' => $customerDAO->getAll()
        ];
        $this->views('layout.admin', $data);
    }

    public function deleteCustomer() {
        $userId = $_POST['userId'];
        $userDAO = new UserDAO();
        $userDAO->deleteUser($userId);
    }

    public function getAllCustomer() {
        $customerDAO = new CustomerDAO();
        $customers = $customerDAO->getAll();
        for ($i = 0; $i < sizeof($customers); ++$i) {
            $data = [
                'customer' => $customers[$i],
                'index' => $i
            ];
            $this->views('Pages/admin/customer_item', $data);
        }
    }

    public function customerProfile() {
        $userId = $_POST['userId'];
        $customerDAO = new CustomerDAO();
        $shippingAddressDAO = new ShippingAddressDAO();
        $orderDAO = new OrderDAO();
        $data = [
            'orders' => $orderDAO->getAllFilterByUserId($userId),
            'customer' => $customerDAO->getCustomer($userId),
            'shippingAddressArray' => $shippingAddressDAO->getAllFilterByUserId($userId),
            'page' => 'Pages/admin/user_profile'
        ];
        $this->views('layout.admin', $data);
    }

    public function showAnalytic() {
        $data = [
            'page' => "Pages/admin/analytic"
        ];
        $this->views('layout.admin', $data);
    }
}
?>