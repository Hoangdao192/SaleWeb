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
    public static $COL_SHIPPING_ADDRESS_ID = "shippingAddressId";

    /*Convert mysqli_result to Order model*/
    public function parseOrder($item /*mysqli_result fetch_assoc item*/) {
        $order = new Order();
        $order->orderNumber = intval($item[OrderDAO::$COL_ORDER_NUMBER]);
        $order->userId = intval($item[OrderDAO::$COL_USER_ID]);
        $order->orderDate = $item[OrderDAO::$COL_ORDER_DATE];
        $order->totalPrice = $item[OrderDAO::$COL_ORDER_PRICE];
        $order->shippingAddressId = $item[OrderDAO::$COL_SHIPPING_ADDRESS_ID];

        return $order;
    }

    /*Insert new order*/
    public function insert($order) {
        $query = new Query();
        $contentArray = [];
        $contentArray[OrderDAO::$COL_USER_ID] = $order->userId;
        $contentArray[OrderDAO::$COL_ORDER_DATE] = $order->orderDate;
        $contentArray[OrderDAO::$COL_ORDER_PRICE] = $order->totalPrice;
        $contentArray[OrderDAO::$COL_SHIPPING_ADDRESS_ID] = $order->shippingAddressId;

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

    public function getStatisticByYear($year = 2022) {
        $query = "SELECT MONTH(" . OrderDAO::$COL_ORDER_DATE . ") AS month, COUNT(*) AS numberOfSale FROM " . OrderDAO::$ORDER_TABLE_NAME
                . " WHERE YEAR(" . OrderDAO::$COL_ORDER_DATE . ") = $year" 
                . " GROUP BY MONTH(" . OrderDAO::$COL_ORDER_DATE . ") ORDER BY MONTH(". OrderDAO::$COL_ORDER_DATE . ") ASC";
        $result = $this->database->query($query);
        $statistic = [];
        while ($item = $result->fetch_assoc()) {
            $statistic[$item['month']] = $item['numberOfSale'];
        }
        return json_encode($statistic);
    }

    public function getStastiticByMonth($year = 2022, $month = 1) {
        $query = "select day(orderDate) as day, count(*) as total
                from orders
                where month(orderDate) = $month and year(orderDate) = $year
                group by day(orderDate)";
                $result = $this->database->query($query);
        $statistic = [];
        while ($item = $result->fetch_assoc()) {
            $statistic[$item['day']] = $item['total'];
        }
        return json_encode($statistic);
    }
}