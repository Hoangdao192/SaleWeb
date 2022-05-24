<?php
namespace App\Model;

class Customer {
    private $userId;
    private $customerName = "";
    private $age = 0;
    private $email = "";
    private $gender = "";
    private $phoneNumber = "";
    private $address = "";
    private $dateOfBirth = "0-0-0";

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}