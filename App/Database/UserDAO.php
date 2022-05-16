<?php
namespace App\Database\DAO;

use App\Database\Query;
use App\Database\DAO\BaseDAO;

use App\Model\User;

class UserDAO extends BaseDAO {
    public static $USER_TABLE_NAME = "users";
    public static $COL_USER_ID = "userId";
    public static $COL_USER_NAME = "userName";
    public static $COL_USER_PASSWORD = "userPassword";
    public static $COL_USER_TYPE = "userType";

    /*Convert mysqli_result to User model*/
    public function parseUser($item /*mysqli_result fetch_assoc item*/) {
        $user = new User();
        $user->userId = $item[UserDAO::$COL_USER_ID];
        $user->userName = $item[UserDAO::$COL_USER_NAME];
        $user->userPassword = $item[UserDAO::$COL_USER_PASSWORD];
        $user->userType = $item[UserDAO::$COL_USER_TYPE];
        return $user;
    }

    /*Get user by id*/
    public function getUserById($userId) {
        $query = new Query();
        $query->getAll(UserDAO::$USER_TABLE_NAME)
                ->filterBy(UserDAO::$COL_USER_ID . " = '" . $userId . "'");
    
        $result = $this->database->query($query->build());
        $item = $result->fetch_assoc();
        
        if ($item == null) {
            return null;
        }
        return $this->parseUser($item);
    }

    /*Get user by username*/
    public function getUserByUsername($userName) {
        $query = new Query();
        $query->getAll(UserDAO::$USER_TABLE_NAME)
                ->filterBy(UserDAO::$COL_USER_NAME . " = '" . $userName . "'");
    
        $result = $this->database->query($query->build());
        $item = $result->fetch_assoc();
        
        if ($item == null) {
            return null;
        }
        return $this->parseUser($item);
    }

    /*Insert new user*/
    public function insertUser($user) {
        $query = new Query();
        $contentArray = [];
        $contentArray[UserDAO::$COL_USER_NAME] = $user->userName;
        $contentArray[UserDAO::$COL_USER_PASSWORD] = $user->userPassword;
        $contentArray[UserDAO::$COL_USER_TYPE] = $user->userType;

        $query->insert(UserDAO::$USER_TABLE_NAME, $contentArray);
        $this->database->query($query->build());
    }

    public function lastInsertId() {
        $query = "SELECT MAX(" . UserDAO::$COL_USER_ID . ") FROM " . UserDAO::$USER_TABLE_NAME;
        $result = $this->database->query($query);
        $column_title = "MAX(" . UserDAO::$COL_USER_ID . ")"; 
        return ($result->fetch_assoc())[$column_title];
    }
}