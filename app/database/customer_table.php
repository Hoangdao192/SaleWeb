<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/customer.php";

class CustomerTable {
    public static $CUSTOMER_TABLE_NAME = "customers";
    public static $COLUMN_CUSTOMER_NUMBER = "customerNumber";
    public static $COLUMN_CUSTOMER_NAME = "customerName";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function parse_customer($item) {
        $customer = new Customer();
        $customer->id = intval($item[CustomerTable::$COLUMN_CUSTOMER_NUMBER]);
        $customer->name = $item[CustomerTable::$COLUMN_CUSTOMER_NAME];
        return $customer;
    }

    public function last_insert_id() {
        $query = "SELECT MAX(" . CustomerTable::$COLUMN_CUSTOMER_NUMBER . ") FROM " . CustomerTable::$CUSTOMER_TABLE_NAME;
        $result = $this->database->query($query);
        $column_title = "MAX(" . CustomerTable::$COLUMN_CUSTOMER_NUMBER . ")"; 
        return ($result->fetch_assoc())[$column_title];
    }

    public function get_customer($customer_number) {
        $query = new Query();
        $query->get_all(CustomerTable::$CUSTOMER_TABLE_NAME)
                ->filter_by(CustomerTable::$COLUMN_CUSTOMER_NUMBER . " = $customer_number");
        $result = $this->database->query($query->build());
        return $this->parse_customer($result->fetch_assoc());
    }
}