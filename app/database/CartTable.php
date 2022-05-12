<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Cart.php";

class CartTable {
    public static $CART_TABLE_NAME = "shopingcart";
    public static $COL_USER_ID = "userId";
    public static $COL_USER_CART = "cart";

    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function parseCart($item) {
        $cart = new Cart();
        $cart->userId = $item[CartTable::$COL_USER_ID];
        $cart->cart = $item[CartTable::$COL_USER_CART];
        return $cart;
    }

    public function getCart($userId) {
        $query = new Query();
        $query->getAll(CartTable::$CART_TABLE_NAME)
                ->filterBy(CartTable::$COL_USER_ID . " = $userId");
        $result = $this->database->query($query->build());
        $item = $result->fetch_assoc();
        if ($item == null) return null;
        return $this->parseCart($item);
    }

    public function insert($cart) {
        $contentArray = [];
        $contentArray[CartTable::$COL_USER_ID] = $cart->userId;
        $contentArray[CartTable::$COL_USER_CART] = $cart->cart;

        $query = new Query();
        $query->insert(CartTable::$CART_TABLE_NAME, $contentArray);
        $this->database->query($query->build());
    }

    public function update($cart) {
        $contentArray = [];
        $contentArray[CartTable::$COL_USER_ID] = $cart->userId;
        $contentArray[CartTable::$COL_USER_CART] = $cart->cart;

        $query = new Query();
        $query->update(CartTable::$CART_TABLE_NAME, $contentArray, CartTable::$COL_USER_ID . " = $cart->userId");
        $this->database->query($query->build());
    }
}
