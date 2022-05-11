<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/OrderDetail.php";

class OrderDetailTable {
    public static $ORDER_DETAIL_TABLE_NAME = "orderdetails";
    public static $COL_ORDER_NUMBER = "orderNumber";
    public static $COL_PRODUCT_ID = "productId";
    public static $COL_QUANTITY_ORDERED = "quantityOrdered";
    public static $COL_PRICE_EACH = "priceEach";
    public static $COL_PRODUCT_SIZE = "productSize";
    public static $COL_PRODUCT_COLOR = "productColor";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    /*Convert mysqli_result to OrderDetail model*/
    public function parseOrderDetail($item /*mysqli_result fetch_assoc item*/) {
        $orderDetail = new OrderDetail();
        $orderDetail->orderNumber = $item[OrderDetailTable::$COL_ORDER_NUMBER];
        $orderDetail->productId = $item[OrderDetailTable::$COL_PRODUCT_ID];
        $orderDetail->quantityOrdered = $item[OrderDetailTable::$COL_QUANTITY_ORDERED];
        $orderDetail->priceEach = $item[OrderDetailTable::$COL_PRICE_EACH];
        $orderDetail->productSize = $item[OrderDetailTable::$COL_PRODUCT_SIZE];
        $orderDetail->productColor = $item[OrderDetailTable::$COL_PRODUCT_COLOR];

        return $orderDetail;
    }

    /*Insert new OrderDetail*/
    public function insert($orderDetail) {
        $query = new Query();
        $contentArray = [];
        $contentArray[OrderDetailTable::$COL_ORDER_NUMBER] = $orderDetail->orderNumber;
        $contentArray[OrderDetailTable::$COL_PRODUCT_ID] = $orderDetail->productId;
        $contentArray[OrderDetailTable::$COL_QUANTITY_ORDERED] = $orderDetail->quantityOrdered;
        $contentArray[OrderDetailTable::$COL_PRICE_EACH] = $orderDetail->priceEach;
        $contentArray[OrderDetailTable::$COL_PRODUCT_SIZE] = $orderDetail->productSize;
        $contentArray[OrderDetailTable::$COL_PRODUCT_COLOR] = $orderDetail->productColor;        

        $query->insert(OrderDetailTable::$ORDER_DETAIL_TABLE_NAME, $contentArray);
        $result = $this->database->query($query->build());

        return $result;
    }

    /*Get all OrderDetail by orderNumber (Get all OrderDetail in an Order)*/
    public function getAllFilterByOrderNumber($orderNumber) {
        $query = new Query();
        $query->getAll(OrderDetailTable::$ORDER_DETAIL_TABLE_NAME)
                ->filterBy(OrderDetailTable::$COL_ORDER_NUMBER . " = $orderNumber");
        $result = $this->database->query($query->build());
        $orderDetails = [];
        while ($item = $result->fetch_assoc()) {
            $orderDetails[] = $this->parseOrderDetail($item);
        }
        return $orderDetails;
    }
}