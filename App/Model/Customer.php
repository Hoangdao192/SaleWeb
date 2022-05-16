<?php
namespace App\Model;

class Customer {
    private $userId;
    private $customerName;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}