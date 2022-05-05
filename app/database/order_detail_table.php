<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/query.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/order_detail.php";

class OrderDetailTable {
    public static $ORDER_DETAIL_TABLE_NAME = "orderdetails";
    public static $COLUMN_ORDER_NUMBER = "orderNumber";
    public static $COLUMN_PRODUCT_ID = "productId";
    public static $COLUMN_QUANTITY_ORDERED = "quantityOrdered";
    public static $COLUMN_PRICE_EACH = "priceEach";
    public static $COLUMN_PRODUCT_SIZE = "productSize";
    public static $COLUMN_PRODUCT_COLOR = "productColor";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function parse_order_detail($item) {
        $order_detail = new OrderDetail();
        $order_detail->order_number = $item[OrderDetailTable::$COLUMN_ORDER_NUMBER];
        $order_detail->product_id = $item[OrderDetailTable::$COLUMN_PRODUCT_ID];
        $order_detail->quantity_ordered = $item[OrderDetailTable::$COLUMN_QUANTITY_ORDERED];
        $order_detail->price_each = $item[OrderDetailTable::$COLUMN_PRICE_EACH];
        $order_detail->product_size = $item[OrderDetailTable::$COLUMN_PRODUCT_SIZE];
        $order_detail->product_color = $item[OrderDetailTable::$COLUMN_PRODUCT_COLOR];

        return $order_detail;
    }

    public function insert($order_detail) {
        $query = new Query();
        $content_array = [];
        $content_array[OrderDetailTable::$COLUMN_ORDER_NUMBER] = $order_detail->order_number;
        $content_array[OrderDetailTable::$COLUMN_PRODUCT_ID] = $order_detail->product_id;
        $content_array[OrderDetailTable::$COLUMN_QUANTITY_ORDERED] = $order_detail->quantity_ordered;
        $content_array[OrderDetailTable::$COLUMN_PRICE_EACH] = $order_detail->price_each;
        $content_array[OrderDetailTable::$COLUMN_PRODUCT_SIZE] = $order_detail->product_size;
        $content_array[OrderDetailTable::$COLUMN_PRODUCT_COLOR] = $order_detail->product_color;        

        $query->insert(OrderDetailTable::$ORDER_DETAIL_TABLE_NAME, $content_array);
        $result = $this->database->query($query->build());

        return $result;
    }

    public function get_all_filter_by_order_number($order_number) {
        $query = new Query();
        $query->get_all(OrderDetailTable::$ORDER_DETAIL_TABLE_NAME)
                ->filter_by(OrderDetailTable::$COLUMN_ORDER_NUMBER . " = $order_number");
        $result = $this->database->query($query->build());
        $order_details = [];
        while ($item = $result->fetch_assoc()) {
            $order_details[] = $this->parse_order_detail($item);
        }
        return $order_details;
    }
}