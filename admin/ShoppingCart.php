<?php
    include_once "../app/database/database.php";

    class ShopingCart {
        private $database;
        public $SHOPPING_CART_TABLE_NAME = "shoppingcart";
        public $PRODUCT_TABLE_NAME = "product";
        public $COLUMN_PRODUCT_ID = "productId";

        public function __construct()
        {
            $this->database = new Database;
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
        }

        public function addToCart($productId, $productSize, $productColor) {
            $product = [$productId, $productSize, $productColor];
            $_SESSION['cart'][] = $product;
        }

        public function countInCart() {
            return count($_SESSION['cart']);
        }
    }
?>