<?php


class OrderDetail {
    private $order_number;
    private $product_id;
    private $quantity_ordered;
    private $price_each;
    private $product_size;
    private $product_color;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}