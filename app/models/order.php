<?php
class Order {
    public $order_number;
    public $userId;
    public $order_date;
    private $total_price;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}