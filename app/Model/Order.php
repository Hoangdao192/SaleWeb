<?php
namespace App\Model;

class Order {
    public $orderNumber;
    public $userId;
    public $orderDate;
    private $totalPrice;
    private $shippingAddressId;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}