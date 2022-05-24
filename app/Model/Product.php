<?php
namespace App\Model;

class Product {
    private $id;
    private $categoryId;
    private $typeId;
    private $name;
    private $color;
    private $price;
    private $imagePath;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}