<?php
class Product {
    private $id;
    private $category_id;
    private $type_id;
    private $name;
    private $color;
    private $price;
    private $image_path;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}