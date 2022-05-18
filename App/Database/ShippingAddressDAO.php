<?php
namespace App\Database\DAO;

use App\Database\DAO\BaseDAO;
use App\Model\ShippingAddress;
use App\Database\Query;

class ShippingAddressDAO extends BaseDAO {
    public static $TABLE_NAME = "shippingaddress";
    public static $COL_ID ="id";
    public static $COL_USER_ID = "userId";
    public static $COL_ADDRESS = "address";
    public static $COL_RECEIVER_NAME = "receiverName";
    public static $COL_RECEIVER_PHONE_NUMBER = "receiverPhoneNumber";

    public function parseShippingAddress($item) {
        $shoppingAddress = new ShippingAddress();
        $shoppingAddress->id = $item[ShippingAddressDAO::$COL_ID];
        $shoppingAddress->userId = $item[ShippingAddressDAO::$COL_USER_ID];
        $shoppingAddress->address = $item[ShippingAddressDAO::$COL_ADDRESS];
        $shoppingAddress->receiverName = $item[ShippingAddressDAO::$COL_RECEIVER_NAME];
        $shoppingAddress->receiverPhoneNumber = $item[ShippingAddressDAO::$COL_RECEIVER_PHONE_NUMBER];
        return $shoppingAddress;
    }

    public function getAll() {
        $query = new Query();
        $query->getAll(ShippingAddressDAO::$TABLE_NAME);
        $result = $this->database->query($query->build());

        $shoppingAddressArray = [];
        while ($item = $result->fetch_assoc()) {
            $shoppingAddressArray[] = $this->parseShippingAddress($item);
        }
        return $shoppingAddressArray;
    }

    public function getAllFilterByUserId($userId) {
        $query = new Query();
        $query->getAll(ShippingAddressDAO::$TABLE_NAME)
                ->filterBy(ShippingAddressDAO::$COL_USER_ID . " = $userId");
        $result = $this->database->query($query->build());
        return $this->parseShippingAddress($result->fetch_assoc());
    }

    public function insert($shippingAddress) {
        $contentArray = [];
        $contentArray[ShippingAddressDAO::$COL_USER_ID] = $shippingAddress->userId;
        $contentArray[ShippingAddressDAO::$COL_ADDRESS] = $shippingAddress->address;
        $contentArray[ShippingAddressDAO::$COL_RECEIVER_NAME] = $shippingAddress->receiverName;
        $contentArray[ShippingAddressDAO::$COL_RECEIVER_PHONE_NUMBER] = $shippingAddress->receiverPhoneNumber;
        $query = new Query();
        $query->insert(ShippingAddressDAO::$TABLE_NAME, $contentArray);
        $this->database->query($query->build());
    }
}
?>