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
        }

        public function countInCart() {
            return count($_SESSION['cart']);
        }
    }
?>