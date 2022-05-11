<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Order.php";

class OrderTable {
    public static $ORDER_TABLE_NAME = "orders";
    public static $COL_ORDER_NUMBER = "orderNumber";
    public static $COL_USER_ID = "userId";
    public static $COL_ORDER_DATE = "orderDate";
    public static $COL_ORDER_PRICE = "totalPrice";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    /*Convert mysqli_result to Order model*/
    public function parseOrder($item /*mysqli_result fetch_assoc item*/) {
        $order = new Order();
        $order->orderNumber = intval($item[OrderTable::$COL_ORDER_NUMBER]);
        $order->userId = intval($item[OrderTable::$COL_USER_ID]);
        $order->orderDate = $item[OrderTable::$COL_ORDER_DATE];
        $order->totalPrice = $item[OrderTable::$COL_ORDER_PRICE];

        return $order;
    }

    /*Insert new order*/
    public function insert($order) {
        $query = new Query();
        $contentArray = [];
        $contentArray[OrderTable::$COL_USER_ID] = $order->userId;
        $contentArray[OrderTable::$COL_ORDER_DATE] = $order->orderDate;
        $contentArray[OrderTable::$COL_ORDER_PRICE] = $order->totalPrice;

        $query->insert(OrderTable::$ORDER_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());

        return $result;
    }

    /*Delete order by id*/
    public function delete($orderNumber) {
        $query = new Query();
        $query->delete(OrderTable::$ORDER_TABLE_NAME, OrderTable::$COL_ORDER_NUMBER . " = $orderNumber");
        $this->database->query($query->build());
    }

    /*Get all order*/
    public function getAll() {
        $query = new Query();
        $query->getAll(OrderTable::$ORDER_TABLE_NAME);
        $result = $this->database->query($query->build());

        $orders = [];
        while ($item = $result->fetch_assoc()) {
            $orders[] = $this->parseOrder($item);
        }

        return $orders;
    }

    /*Get all order by userId*/
    public function getAllFilterByUserId($userId) {
        $query = new Query();
        $query->getAll(OrderTable::$ORDER_TABLE_NAME)
                ->filterBy(OrderTable::$COL_USER_ID . " = " . $userId);

        $result = $this->database->query($query->build());

        $orders = [];
        while ($item = $result->fetch_assoc()) {
            $orders[] = $this->parseOrder($item);
        }

        return $orders;
    }

    /*Get order by orderNumber*/
    public function getOrder($orderNumber) {
        $query = new Query();
        $query->getAll(OrderTable::$ORDER_TABLE_NAME)
                ->filterBy(OrderTable::$COL_ORDER_NUMBER . " = $orderNumber");
        $result = $this->database->query($query->build());
        return $this->parseOrder($result->fetch_assoc());
    }

    public function lastInsertId() {
        $query = "SELECT MAX(" . OrderTable::$COL_ORDER_NUMBER . ") FROM " . OrderTable::$ORDER_TABLE_NAME;
        $result = $this->database->query($query);
        $columnTitle = "MAX(" . OrderTable::$COL_ORDER_NUMBER . ")"; 
        return ($result->fetch_assoc())[$columnTitle];
    }
}