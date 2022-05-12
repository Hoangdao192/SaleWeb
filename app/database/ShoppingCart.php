<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/ProductTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/views/product_big.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CustomerTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Order.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/OrderDetailTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/UserTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/CartTable.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/OrderDetail.php";

class ShopingCart {
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    function updateDatabase() {
        $cartJSON = json_encode($_SESSION['cart']);
        $cartTable = new CartTable();
        $user = json_decode($_SESSION['user']);

        $cart = new Cart();
        $cart->userId = $user->userId;
        $cart->cart = $cartJSON;

        if ($cartTable->getCart($user->userId) != null) {
            $cartTable->update($cart);
        } else {
            $cartTable->insert($cart);
        }
    }

    function loadFromDatabase() {
        $user = json_decode($_SESSION['user']);
        $cartTable = new CartTable();
        $cart = $cartTable->getCart($user->userId);
        if ($cart != null) {
            $_SESSION['cart'] = json_decode($cart->cart);
        } else {
            $_SESSION['cart'] = [];
        }
    }

    /*Get all product in cart and show in HTML*/
    function loadCart() {
        if (isset($_SESSION['user'])) {
            $this->loadFromDatabase();
        }

        $products = $_SESSION['cart'];
        $productTable = new ProductTable;
        for ($i = 0; $i < sizeof($products); ++$i) {
            $productId = $products[$i][0];
            $product = $productTable->getProduct($productId);
            product_cart($product, $products[$i]);
        }
    }

    /*Delete product in cart*/
    function deleteItem($index) {
        $products = $_SESSION['cart'];
        array_splice($products, $index, 1);
        $_SESSION['cart'] = $products;
        if (isset($_SESSION['user'])) {
            $this->updateDatabase();
        }
    }

    /*Return number of item in cart*/
    function countItem() {
        $products = $_SESSION['cart'];
        return sizeof($products);
    }

    /*Create new order*/
    function createOrder() {
        if (sizeof($_SESSION['cart']) == 0) return;
        $userPhoneNumber = $_GET["phone"];

        $userId = -1;
        if (isset($_SESSION['user'])) {
            $user = json_decode($_SESSION['user']);
            $userId = $user->userId;
        } else {
            echo "not";
            /*Create guest account*/
            $userTable = new UserTable();
            $userName = "guest" . $userPhoneNumber;

            /*Check if user is not exists*/
            if ($userTable->getUserByUsername($userName) == null) {
                $user = new User();
                $user->userName = $userName;
                $user->userPassword = "guest";
                $user->userType = "customer";
                $userTable->insertUser($user);
    
                $customerTable = new CustomerTable();
                $customer = new Customer();
                $customer->userId = $userTable->lastInsertId();
                $customer->customerName = "Guest";
                $customerTable->insertCustomer($customer);
                $userId = $customer->userId;
            } else {
                $user = $userTable->getUserByUsername($userName);
                $userId = $user->userId;
            }
        }

        $newOrder = new Order();
        $newOrder->userId = $userId;
        $newOrder->orderDate = date("Y-m-d");
        $newOrder->totalPrice = $this->getTotalPrice();

        $orderTable = new OrderTable();
        $orderTable->insert($newOrder);

        $orderNumber = $orderTable->lastInsertId();
        //  Add order detail
        $products = $_SESSION['cart'];
        $productTable = new ProductTable;
        $orderDetailTable = new OrderDetailTable();
        for ($i = 0; $i < sizeof($products); ++$i) {
            $productId = $products[$i][0];
            $product = $productTable->getProduct($productId);

            $newOrderDetail = new OrderDetail();
            $newOrderDetail->orderNumber = $orderNumber;
            $newOrderDetail->productId = $products[$i][0];
            $newOrderDetail->productSize = $products[$i][1];
            $newOrderDetail->productColor = $products[$i][2];
            $newOrderDetail->quantityOrdered = $products[$i][3];
            $newOrderDetail->priceEach = $product->price;
            $orderDetailTable->insert($newOrderDetail);
        }
        $_SESSION['cart'] = [];
    }

    /*Add item to cart*/
    public function addToCart($productId, $productSize, $productColor, $productQuantity) {
        $product = [$productId, $productSize, $productColor, intval($productQuantity)];
        $all_products = $_SESSION['cart'];
        $exist = false;
        for ($i = 0; $i < sizeof($all_products); ++$i) {
            if ($productId === $all_products[$i][0] && $productSize === $all_products[$i][1]
                && $productColor === $all_products[$i][2]) {
                    $_SESSION['cart'][$i][3] = intval($_SESSION['cart'][$i][3]) + intval($productQuantity);
                    $exist = true;
                    break;
                }
        }
        if (!$exist) {
            $_SESSION['cart'][] = $product;
        }

        if (isset($_SESSION['user'])) {
            $this->updateDatabase();
        }
    }

    public function countInCart() {
        return count($_SESSION['cart']);
    }

    function getTotalPrice() {
        $products = $_SESSION['cart'];
        $productTable = new ProductTable;
        $totalPrice = 0;
        for ($i = 0; $i < sizeof($products); ++$i) {
            $productId = $products[$i][0];
            $product = $productTable->getProduct($productId);
            $totalPrice += intval($product->price) * intval($products[$i][3]);
        }
        return $totalPrice;
    }
}

$cart = new ShopingCart();
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    /*Delete item*/
    if ($action == 'delete') {
        $cart->deleteItem($_GET['index']);
    }

    /*Create new order*/
    else if ($action == 'order') {
        $cart->createOrder();
    }

    /*Load items in cart*/
    else if ($action == 'load') {
        $cart->loadCart();
    } 

    /*Add new item to cart*/
    else if ($action == 'add') {
        $productId = $_POST['productId'];
        $productSize = $_POST['productSize'];
        $productColor = $_POST['productColor'];
        $productQuantity = $_POST['productQuantity'];
        $cart->addToCart($productId, $productSize, $productColor, $productQuantity);
        echo $cart->countInCart();
        exit();
    } 
    
    /*Return number of item*/
    else if ($action == 'count') {
        echo $cart->countInCart();
        exit();
    }
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];
    /*Add new product to cart*/
    if ($action == 'add') {
        $productId = $_POST['productId'];
        $productSize = $_POST['productSize'];
        $productColor = $_POST['productColor'];
        $productQuantity = $_POST['productQuantity'];
        $cart->addToCart($productId, $productSize, $productColor, $productQuantity);
        echo $cart->countInCart();
        exit();
    } 

    /*Create new order*/
    else if ($action == "order") {
        $cart->createOrder();
    }
}
