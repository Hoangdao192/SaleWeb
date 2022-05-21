<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\OrderDetail;

class OrderDetailDAO extends BaseDAO {
    public static $ORDER_DETAIL_TABLE_NAME = "orderdetails";
    public static $COL_ORDER_NUMBER = "orderNumber";
    public static $COL_PRODUCT_ID = "productId";
    public static $COL_QUANTITY_ORDERED = "quantityOrdered";
    public static $COL_PRICE_EACH = "priceEach";
    public static $COL_PRODUCT_SIZE = "productSize";
    public static $COL_PRODUCT_COLOR = "productColor";

    /*Convert mysqli_result to OrderDetail model*/
    public function parseOrderDetail($item /*mysqli_result fetch_assoc item*/) {
        $orderDetail = new OrderDetail();
        $orderDetail->orderNumber = $item[OrderDetailDAO::$COL_ORDER_NUMBER];
        $orderDetail->productId = $item[OrderDetailDAO::$COL_PRODUCT_ID];
        $orderDetail->quantityOrdered = $item[OrderDetailDAO::$COL_QUANTITY_ORDERED];
        $orderDetail->priceEach = $item[OrderDetailDAO::$COL_PRICE_EACH];
        $orderDetail->productSize = $item[OrderDetailDAO::$COL_PRODUCT_SIZE];
        $orderDetail->productColor = $item[OrderDetailDAO::$COL_PRODUCT_COLOR];

        return $orderDetail;
    }

    /*Insert new OrderDetail*/
    public function insert($orderDetail) {
        $query = new Query();
        $contentArray = [];
        $contentArray[OrderDetailDAO::$COL_ORDER_NUMBER] = $orderDetail->orderNumber;
        $contentArray[OrderDetailDAO::$COL_PRODUCT_ID] = $orderDetail->productId;
        $contentArray[OrderDetailDAO::$COL_QUANTITY_ORDERED] = $orderDetail->quantityOrdered;
        $contentArray[OrderDetailDAO::$COL_PRICE_EACH] = $orderDetail->priceEach;
        $contentArray[OrderDetailDAO::$COL_PRODUCT_SIZE] = $orderDetail->productSize;
        $contentArray[OrderDetailDAO::$COL_PRODUCT_COLOR] = $orderDetail->productColor;        

        $query->insert(OrderDetailDAO::$ORDER_DETAIL_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());

        return $result;
    }

    /*Get all OrderDetail by orderNumber (Get all OrderDetail in an Order)*/
    public function getAllFilterByOrderNumber($orderNumber) {
        $query = new Query();
        $query->getAll(OrderDetailDAO::$ORDER_DETAIL_TABLE_NAME)
                ->filterBy(OrderDetailDAO::$COL_ORDER_NUMBER . " = $orderNumber");
        $result = $this->database->query($query->build());
        $orderDetails = [];
        while ($item = $result->fetch_assoc()) {
            $orderDetails[] = $this->parseOrderDetail($item);
        }
        return $orderDetails;
    }

    public function getStatisticByYear($year = 2022) {
        $query = "select month(orderDate) as month, sum(quantityOrdered) as total
                    from orders
                    join orderdetails where orders.orderNumber = orderdetails.orderNumber
                    group by month(orderDate)";
        $result = $this->database->query($query);
        $statistic = [];
        while ($item = $result->fetch_assoc()) {
            $statistic[$item['month']] = $item['total'];
        }
        return json_encode($statistic);
    }

    public function getStatisticByMonth($year = 2022, $month = 1) {
        $query = "select day(orderDate) as day, sum(quantityOrdered) as total
                    from orders
                    join orderdetails on orders.orderNumber = orderdetails.orderNumber
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