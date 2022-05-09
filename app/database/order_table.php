<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/order.php";

class OrderTable {
    public static $ORDER_TABLE_NAME = "orders";
    public static $COLUMN_ORDER_NUMBER = "orderNumber";
    public static $COL_USER_ID = "userId";
    public static $COLUMN_ORDER_DATE = "orderDate";
    public static $COLUMN_ORDER_PRICE = "totalPrice";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function parse_order($item) {
        $order = new Order();
        $order->order_number = intval($item[OrderTable::$COLUMN_ORDER_NUMBER]);
        $order->userId = intval($item[OrderTable::$COL_USER_ID]);
        $order->order_date = $item[OrderTable::$COLUMN_ORDER_DATE];
        $order->total_price = $item[OrderTable::$COLUMN_ORDER_PRICE];

        return $order;
    }

    public function insert($order) {
        $query = new Query();
        $content_array = [];
        $content_array[OrderTable::$COL_USER_ID] = $order->userId;
        $content_array[OrderTable::$COLUMN_ORDER_DATE] = $order->order_date;
        $content_array[OrderTable::$COLUMN_ORDER_PRICE] = $order->total_price;

        $query->insert(OrderTable::$ORDER_TABLE_NAME, $content_array);
        $result = $this->database->query($query->build());

        return $result;
    }

    public function get_all() {
        $query = new Query();
        $query->get_all(OrderTable::$ORDER_TABLE_NAME);
        $result = $this->database->query($query->build());

        $orders = [];
        while ($item = $result->fetch_assoc()) {
            $orders[] = $this->parse_order($item);
        }

        return $orders;
    }

    public function getAllFilterByUserId($userId) {
        $query = new Query();
        $query->get_all(OrderTable::$ORDER_TABLE_NAME)
                ->filter_by(OrderTable::$COL_USER_ID . " = " . $userId);

        $result = $this->database->query($query->build());

        $orders = [];
        while ($item = $result->fetch_assoc()) {
            $orders[] = $this->parse_order($item);
        }

        return $orders;
    }

    public function last_insert_id() {
        $query = "SELECT MAX(" . OrderTable::$COLUMN_ORDER_NUMBER . ") FROM " . OrderTable::$ORDER_TABLE_NAME;
        $result = $this->database->query($query);
        $column_title = "MAX(" . OrderTable::$COLUMN_ORDER_NUMBER . ")"; 
        return ($result->fetch_assoc())[$column_title];
    }

    public function get_order($order_number) {
        $query = new Query();
        $query->get_all(OrderTable::$ORDER_TABLE_NAME)
                ->filter_by(OrderTable::$COLUMN_ORDER_NUMBER . " = $order_number");
        $result = $this->database->query($query->build());
        return $this->parse_order($result->fetch_assoc());
    }
}