<?php
namespace App\Model;

class ProductType {
    private $id;
    private $categoryId;
    private $name;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}