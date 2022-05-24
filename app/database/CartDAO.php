<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\Cart;

class CartDAO extends BaseDAO {
    public static $CART_TABLE_NAME = "shopingcart";
    public static $COL_USER_ID = "userId";
    public static $COL_USER_CART = "cart";

    public function parseCart($item) {
        $cart = new Cart();
        $cart->userId = $item[CartDAO::$COL_USER_ID];
        $cart->cart = $item[CartDAO::$COL_USER_CART];
        return $cart;
    }

    public function getCart($userId) {
        $query = new Query();
        $query->getAll(CartDAO::$CART_TABLE_NAME)
                ->filterBy(CartDAO::$COL_USER_ID . " = $userId");
        $result = $this->database->query($query->build());
        $item = $result->fetch_assoc();
        if ($item == null) return null;
        return $this->parseCart($item);
    }

    public function insert($cart) {
        $contentArray = [];
        $contentArray[CartDAO::$COL_USER_ID] = $cart->userId;
        $contentArray[CartDAO::$COL_USER_CART] = $cart->cart;

        $query = new Query();
        $query->insert(CartDAO::$CART_TABLE_NAME, $contentArray);
        $this->database->query($query->build());
    }

    public function update($cart) {
        $contentArray = [];
        $contentArray[CartDAO::$COL_USER_ID] = $cart->userId;
        $contentArray[CartDAO::$COL_USER_CART] = $cart->cart;

        $query = new Query();
        $query->update(CartDAO::$CART_TABLE_NAME, $contentArray, CartDAO::$COL_USER_ID . " = $cart->userId");
        $this->database->query($query->build());
    }
}
