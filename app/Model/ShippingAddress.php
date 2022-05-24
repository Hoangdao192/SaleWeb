<?php
namespace App\Model;

class ShippingAddress {
    private $id;
    private $userId;
    private $address;
    private $receiverName;
    private $receiverPhoneNumber;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}
?>