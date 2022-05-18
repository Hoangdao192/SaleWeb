<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\ProductDAO;
use App\Database\DAO\CartDAO;
use App\Database\DAO\OrderDAO;
use App\Database\DAO\OrderDetailDAO;
use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderDetail;

class ShopingCart extends BaseController {

    public function __construct(){
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if ($this->isUserExists()) {
            $this->loadFromDatabase();
        }
    }

    public function showMainPage() {
        $data = ["page" => "Pages/cart", "cartSize" => $this->getNumberOfItem()];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views("layout.user",$data);
    }

    public function showDeliveryPage() {
        $data = ['page' => 'Pages/delivery', 'totalPurchase' => $this->getTotalPrice()];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views("layout.user", $data);
    }

    public function showCompleteOrder() {
        $this->createOrder();
        $data = ['page' => 'Pages/complete-order', 'totalPurchase' => $this->getTotalPrice()];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views("layout.user", $data);
    }

    function updateDatabase() {
        $cartJSON = json_encode($_SESSION['cart']);
        $cartDAO = new CartDAO();
        $user = json_decode($_SESSION['user']);

        $cart = new Cart();
        $cart->userId = $user->userId;
        $cart->cart = $cartJSON;

        if ($cartDAO->getCart($user->userId) != null) {
            $cartDAO->update($cart);
        } else {
            $cartDAO->insert($cart);
        }
    }

    function loadFromDatabase() {
        $user = json_decode($_SESSION['user']);
        $cartDAO = new cartDAO();
        $cart = $cartDAO->getCart($user->userId);
        if ($cart != null) {
            $_SESSION['cart'] = json_decode($cart->cart);
        } else {
            $_SESSION['cart'] = [];
        }
    }

    public function loadCart() {
        if ($this->isUserExists()) {
            $this->loadFromDatabase();
        }

        $products = $_SESSION['cart'];
        $productDAO = new ProductDAO();
        for ($i = 0; $i < sizeof($products); ++$i) {
            $productId = $products[$i][0];
            $product = $productDAO->getProduct($productId);
            $this->views("Product.product_cart_item", ["product" => $product, "orderInfor" => $products[$i]]);
        }
    }

    private function getNumberOfItem() {
        $products = [];
        if (isset($_SESSION['cart'])) {
            $products = $_SESSION['cart'];
        }
        return sizeof($products);
    }

    public function countItemInCart() {
        echo $this->getNumberOfItem();
    }

    public function addToCart() {
        $productId = intval($_POST['productId']);
        $productSize = $_POST['productSize'];
        $productColor = $_POST['productColor'];
        $productQuantity = intval($_POST['productQuantity']);

        $product = [$productId, $productSize, $productColor, $productQuantity];
        $allItems = $_SESSION['cart'];
        $exist = false;
        for ($i = 0; $i < sizeof($allItems); ++$i) {
            if ($productId === $allItems[$i][0] && $productSize === $allItems[$i][1]
                && $productColor === $allItems[$i][2]) {
                    $_SESSION['cart'][$i][3] = intval($_SESSION['cart'][$i][3]) + $productQuantity;
                    $exist = true;
                    break;
                }
        }
        if (!$exist) {
            $_SESSION['cart'][] = $product;
        }

        if ($this->isUserExists()) {
            $this->updateDatabase();
        }

        $response = [
            "status" => "success",
            "numberOfItem" => $this->getNumberOfItem()
        ];
        echo json_encode($response);
    }

    public function deleteItem() {
        $index = $_POST["itemIndex"];
        $products = $_SESSION['cart'];
        array_splice($products, $index, 1);
        $_SESSION['cart'] = $products;
        if ($this->isUserExists()) {
            $this->updateDatabase();
        }
    }

    function getTotalPrice() {
        $products = $_SESSION['cart'];
        $productDAO = new ProductDAO;
        $totalPrice = 0;
        for ($i = 0; $i < sizeof($products); ++$i) {
            $productId = $products[$i][0];
            $product = $productDAO->getProduct($productId);
            $totalPrice += intval($product->price) * intval($products[$i][3]);
        }
        return $totalPrice;
    }

    function createOrder() {
        if (sizeof($_SESSION['cart']) == 0) return;
        echo "YES";

        $userId = -1;
        if (isset($_SESSION['user'])) {
            $user = json_decode($_SESSION['user']);
            $userId = $user->userId;
        }

        $newOrder = new Order();
        $newOrder->userId = $userId;
        $newOrder->orderDate = date("Y-m-d");
        $newOrder->totalPrice = $this->getTotalPrice();

        $orderDAO = new OrderDAO();
        $orderDAO->insert($newOrder);

        $orderNumber = $orderDAO->lastInsertId();
        //  Add order detail
        $products = $_SESSION['cart'];
        $productDAO = new ProductDAO;
        $orderDetailDAO = new OrderDetailDAO();
        for ($i = 0; $i < sizeof($products); ++$i) {
            $productId = $products[$i][0];
            $product = $productDAO->getProduct($productId);

            $newOrderDetail = new OrderDetail();
            $newOrderDetail->orderNumber = $orderNumber;
            $newOrderDetail->productId = $products[$i][0];
            $newOrderDetail->productSize = $products[$i][1];
            $newOrderDetail->productColor = $products[$i][2];
            $newOrderDetail->quantityOrdered = $products[$i][3];
            $newOrderDetail->priceEach = $product->price;
            $orderDetailDAO->insert($newOrderDetail);
        }
        $_SESSION['cart'] = [];
        $this->updateDatabase();
    }
}
?>