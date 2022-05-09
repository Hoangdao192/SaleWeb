<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/database.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/models/User.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SaleWeb_Assignment/app/database/query.php";

class UserTable {
    public static $USER_TABLE_NAME = "users";
    public static $COL_USER_ID = "userId";
    public static $COL_USER_NAME = "userName";
    public static $COL_USER_PASSWORD = "userPassword";
    public static $COL_USER_TYPE = "userType";

    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function parseUser($item /*Cursor fetch_assoc() item*/) {
        $user = new User();
        $user->userId = $item[UserTable::$COL_USER_ID];
        $user->userName = $item[UserTable::$COL_USER_NAME];
        $user->userPassword = $item[UserTable::$COL_USER_PASSWORD];
        $user->userType = $item[UserTable::$COL_USER_TYPE];
        return $user;
    }

    public function getUserById($userId) {
        $query = new Query();
        $query->get_all(UserTable::$USER_TABLE_NAME)
                ->filter_by(UserTable::$COL_USER_ID . " = '" . $userId . "'");
    
        $result = $this->database->query($query->build());
        $item = $result->fetch_assoc();
        
        if ($item == null) {
            return null;
        }
        return $this->parseUser($item);
    }

    public function getUserByUsername($userName) {
        $query = new Query();
        $query->get_all(UserTable::$USER_TABLE_NAME)
                ->filter_by(UserTable::$COL_USER_NAME . " = '" . $userName . "'");
    
        $result = $this->database->query($query->build());
        $item = $result->fetch_assoc();
        
        if ($item == null) {
            return null;
        }
        return $this->parseUser($item);
    }

    public function insertUser($user) {
        $query = new Query();
        $contentArray = [];
        $contentArray[UserTable::$COL_USER_NAME] = $user->userName;
        $contentArray[UserTable::$COL_USER_PASSWORD] = $user->userPassword;
        $contentArray[UserTable::$COL_USER_TYPE] = $user->userType;

        $query->insert(UserTable::$USER_TABLE_NAME, $contentArray);
        $this->database->query($query->build());
    }

    public function lastInsertId() {
        $query = "SELECT MAX(" . UserTable::$COL_USER_ID . ") FROM " . UserTable::$USER_TABLE_NAME;
        $result = $this->database->query($query);
        $column_title = "MAX(" . UserTable::$COL_USER_ID . ")"; 
        return ($result->fetch_assoc())[$column_title];
    }
}