<?php
namespace App\Model;

class User {
    private $userId;
    private $userName;
    private $userPassword;
    private $userType;

    public function __get($propertyName)
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
    }
}