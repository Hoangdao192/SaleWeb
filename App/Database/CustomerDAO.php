<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\Customer;

class CustomerDAO extends BaseDAO {
    public static $CUSTOMER_TABLE_NAME = "customers";
    public static $COL_USER_ID = "userId";
    public static $COL_CUSTOMER_NAME = "customerName";
    public static $COL_AGE = "age";
    public static $COL_EMAIL = "email";
    public static $COL_GENDER = "gender";
    public static $COL_PHONE_NUMBER = "phoneNumber";
    public static $COL_ADDRESS = "address";
    public static $COL_DATE_OF_BIRTH = "dateOfBirth";

    /*Convert mysqli_result to Category model*/
    public function parseCustomer($item /*mysqli_result fetch_assoc item*/) {
        $customer = new Customer();
        $customer->userId = intval($item[CustomerDAO::$COL_USER_ID]);
        $customer->customerName = $item[CustomerDAO::$COL_CUSTOMER_NAME];
        $customer->age = $item[CustomerDAO::$COL_AGE];
        $customer->email = $item[CustomerDAO::$COL_EMAIL];
        $customer->gender = $item[CustomerDAO::$COL_GENDER];
        $customer->phoneNumber = $item[CustomerDAO::$COL_PHONE_NUMBER];
        $customer->address = $item[CustomerDAO::$COL_ADDRESS];
        $customer->dateOfBirth = $item[CustomerDAO::$COL_DATE_OF_BIRTH];
        return $customer;
    }

    /*Insert new customer*/
    public function insertCustomer($customer) {
        $query = new Query();
        $contentArray = [];
        $contentArray[CustomerDAO::$COL_USER_ID] = $customer->userId;
        $contentArray[CustomerDAO::$COL_CUSTOMER_NAME] = $customer->customerName;
        $contentArray[CustomerDAO::$COL_AGE] = $customer->age;
        $contentArray[CustomerDAO::$COL_ADDRESS] = $customer->address;
        $contentArray[CustomerDAO::$COL_DATE_OF_BIRTH] = $customer->dateOfBirth;
        $contentArray[CustomerDAO::$COL_GENDER] = $customer->gender;
        $contentArray[CustomerDAO::$COL_EMAIL] = $customer->email;
        $contentArray[CustomerDAO::$COL_PHONE_NUMBER] = $customer->phoneNumber;
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