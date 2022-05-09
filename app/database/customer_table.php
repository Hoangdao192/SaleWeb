<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/customer.php";

class CustomerTable {
    public static $CUSTOMER_TABLE_NAME = "customers";
    public static $COL_USER_ID = "userId";
    public static $COLUMN_CUSTOMER_NAME = "customerName";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function parse_customer($item) {
        $customer = new Customer();
        $customer->userId = intval($item[CustomerTable::$COL_USER_ID]);
        $customer->customerName = $item[CustomerTable::$COLUMN_CUSTOMER_NAME];
        return $customer;
    }

    public function last_insert_id() {
        $query = "SELECT MAX(" . CustomerTable::$COL_USER_ID . ") FROM " . CustomerTable::$CUSTOMER_TABLE_NAME;
        $result = $this->database->query($query);
        $column_title = "MAX(" . CustomerTable::$COL_USER_ID . ")"; 
        return ($result->fetch_assoc())[$column_title];
    }

    public function insertCustomer($customer) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CustomerTable::$COL_USER_ID] = $customer->userId;
        $contentArray[CustomerTable::$COLUMN_CUSTOMER_NAME] = $customer->customerName;
        $query->insert(CustomerTable::$CUSTOMER_TABLE_NAME, $contentArray);

        $this->database->query($query->build());
    }

    public function get_customer($userId) {
        $query = new Query();
        $query->get_all(CustomerTable::$CUSTOMER_TABLE_NAME)
                ->filter_by(CustomerTable::$COL_USER_ID . " = $userId");
        $result = $this->database->query($query->build());
        return $this->parse_customer($result->fetch_assoc());
    }
}