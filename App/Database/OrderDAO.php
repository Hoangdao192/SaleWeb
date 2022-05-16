<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\Order;

class OrderDAO extends BaseDAO {
    public static $ORDER_TABLE_NAME = "orders";
    public static $COL_ORDER_NUMBER = "orderNumber";
    public static $COL_USER_ID = "userId";
    public static $COL_ORDER_DATE = "orderDate";
    public static $COL_ORDER_PRICE = "totalPrice";

    /*Convert mysqli_result to Order model*/
    public function parseOrder($item /*mysqli_result fetch_assoc item*/) {
        $order = new Order();
        $order->orderNumber = intval($item[OrderDAO::$COL_ORDER_NUMBER]);
        $order->userId = intval($item[OrderDAO::$COL_USER_ID]);
        $order->orderDate = $item[OrderDAO::$COL_ORDER_DATE];
        $order->totalPrice = $item[OrderDAO::$COL_ORDER_PRICE];

        return $order;
    }

    /*Insert new order*/
    public function insert($order) {
        $query = new Query();
        $contentArray = [];
        $contentArray[OrderDAO::$COL_USER_ID] = $order->userId;
        $contentArray[OrderDAO::$COL_ORDER_DATE] = $order->orderDate;
        $contentArray[OrderDAO::$COL_ORDER_PRICE] = $order->totalPrice;

        $query->insert(OrderDAO::$ORDER_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());

        return $result;
    }

    /*Delete order by id*/
    public function deleteOrder($orderNumber) {
        $query = new Query();
        $query->delete(OrderDAO::$ORDER_TABLE_NAME, OrderDAO::$COL_ORDER_NUMBER . " = $orderNumber");
        $this->database->query($query->build());
    }

    /*Get all order*/
    public function getAll() {
        $query = new Query();
        $query->getAll(OrderDAO::$ORDER_TABLE_NAME);
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
        $query->getAll(OrderDAO::$ORDER_TABLE_NAME)
                ->filterBy(OrderDAO::$COL_USER_ID . " = " . $userId);

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
        $query->getAll(OrderDAO::$ORDER_TABLE_NAME)
                ->filterBy(OrderDAO::$COL_ORDER_NUMBER . " = $orderNumber");
        $result = $this->database->query($query->build());
        return $this->parseOrder($result->fetch_assoc());
    }

    public function lastInsertId() {
        $query = "SELECT MAX(" . OrderDAO::$COL_ORDER_NUMBER . ") FROM " . OrderDAO::$ORDER_TABLE_NAME;
        $result = $this->database->query($query);
        $columnTitle = "MAX(" . OrderDAO::$COL_ORDER_NUMBER . ")"; 
        return ($result->fetch_assoc())[$columnTitle];
    }
}