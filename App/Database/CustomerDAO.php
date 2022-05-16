<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\Customer;

class CustomerDAO extends BaseDAO {
    public static $CUSTOMER_TABLE_NAME = "customers";
    public static $COL_USER_ID = "userId";
    public static $COL_CUSTOMER_NAME = "customerName";

    /*Convert mysqli_result to Category model*/
    public function parseCustomer($item /*mysqli_result fetch_assoc item*/) {
        $customer = new Customer();
        $customer->userId = intval($item[CustomerDAO::$COL_USER_ID]);
        $customer->customerName = $item[CustomerDAO::$COL_CUSTOMER_NAME];
        return $customer;
    }

    /*Insert new customer*/
    public function insertCustomer($customer) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CustomerDAO::$COL_USER_ID] = $customer->userId;
        $contentArray[CustomerDAO::$COL_CUSTOMER_NAME] = $customer->customerName;
        $query->insert(CustomerDAO::$CUSTOMER_TABLE_NAME, $contentArray);

        $this->database->query($query->build());
    }

    /*Get customer by id*/
    public function getCustomer($userId) {
        $query = new Query();
        $query->getAll(CustomerDAO::$CUSTOMER_TABLE_NAME)
                ->filterBy(CustomerDAO::$COL_USER_ID . " = $userId");
        $result = $this->database->query($query->build());
        return $this->parseCustomer($result->fetch_assoc());
    }

    public function lastInsertId() {
        $query = "SELECT MAX(" . CustomerDAO::$COL_USER_ID . ") FROM " . CustomerDAO::$CUSTOMER_TABLE_NAME;
        $result = $this->database->query($query);
        $columnTitle = "MAX(" . CustomerDAO::$COL_USER_ID . ")"; 
        return ($result->fetch_assoc())[$columnTitle];
    }
}