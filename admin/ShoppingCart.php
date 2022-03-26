<?php
    include_once "Database.php";

    class ShopingCart {
        private $database;
        public $SHOPPING_CART_TABLE_NAME = "shoppingcart";
        public $PRODUCT_TABLE_NAME = "product";
        public $COLUMN_PRODUCT_ID = "productId";

        public function __construct()
        {
            $this->database = new Database;
        }

        //  Get all product in shopping cart table
        public function show_product() {
            $query = 
                    "SELECT * FROM $this->SHOPPING_CART_TABLE_NAME 
                    INNER JOIN $this->PRODUCT_TABLE_NAME
                    ON $this->SHOPPING_CART_TABLE_NAME.$this->COLUMN_PRODUCT_ID = $this->PRODUCT_TABLE_NAME.$this->COLUMN_PRODUCT_ID
                    ORDER BY $this->PRODUCT_TABLE_NAME.$this->COLUMN_PRODUCT_ID";
            $result = $this->database->query($query);
            return $result;
        }

        //  Insert new product to shopping cart
        public function insert_product($productId) {
            //  Xác định xem sản phẩm đã có trong giỏ hàng hay chưa
            $firstQuery = "SELECT * FROM $this->SHOPPING_CART_TABLE_NAME
                        WHERE $this->COLUMN_PRODUCT_ID = $productId";
            $findResult = $this->database->query($firstQuery);
            if (mysqli_num_rows($findResult) > 0) return $findResult;

            $query = "INSERT INTO $this->SHOPPING_CART_TABLE_NAME
                    VALUES($productId);";
            $result = $this->database->query($query);
            return $result;
        }

        //  Delete a product from shopping cả
        public function delete_product($productId) {
            $query = "DELETE FROM $this->SHOPPING_CART_TABLE_NAME WHERE $this->COLUMN_PRODUCT_ID = $productId";
            $result = $this->database->query($query);
            return $result;
        }
    }
?>