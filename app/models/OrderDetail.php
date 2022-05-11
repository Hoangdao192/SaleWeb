<?php


class OrderDetail {
    private $orderNumber;
    private $productId;
    private $quantityOrdered;
    private $priceEach;
    private $productSize;
    private $productColor;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}