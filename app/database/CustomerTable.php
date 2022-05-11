<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/Database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/Customer.php";

class CustomerTable {
    public static $CUSTOMER_TABLE_NAME = "customers";
    public static $COL_USER_ID = "userId";
    public static $COL_CUSTOMER_NAME = "customerName";

    private $database;

    public function __construct() {
        $this->database = new Database;
    }

    /*Convert mysqli_result to Category model*/
    public function parseCustomer($item /*mysqli_result fetch_assoc item*/) {
        $customer = new Customer();
        $customer->userId = intval($item[CustomerTable::$COL_USER_ID]);
        $customer->customerName = $item[CustomerTable::$COL_CUSTOMER_NAME];
        return $customer;
    }

    /*Insert new customer*/
    public function insertCustomer($customer) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CustomerTable::$COL_USER_ID] = $customer->userId;
        $contentArray[CustomerTable::$COL_CUSTOMER_NAME] = $customer->customerName;
        $query->insert(CustomerTable::$CUSTOMER_TABLE_NAME, $contentArray);

        $this->database->query($query->build());
    }

    /*Get customer by id*/
    public function getCustomer($userId) {
        $query = new Query();
        $query->getAll(CustomerTable::$CUSTOMER_TABLE_NAME)
                ->filterBy(CustomerTable::$COL_USER_ID . " = $userId");
        $result = $this->database->query($query->build());
        return $this->parseCustomer($result->fetch_assoc());
    }

    public function lastInsertId() {
        $query = "SELECT MAX(" . CustomerTable::$COL_USER_ID . ") FROM " . CustomerTable::$CUSTOMER_TABLE_NAME;
        $result = $this->database->query($query);
        $columnTitle = "MAX(" . CustomerTable::$COL_USER_ID . ")"; 
        return ($result->fetch_assoc())[$columnTitle];
    }
}