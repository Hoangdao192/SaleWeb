<?php
namespace App\Controller;

use Core\HTML;

abstract class BaseController {
    public function isUserExists() {
        return isset($_SESSION['user']);
    }

    public function getUser() {
        if ($this->isUserExists()) {
            return $_SESSION['user'];
        }
        return null;
    }

    public function views($name, $data = []) {
        if (str_contains($name, ".")) {
            $name = str_replace(".", "/", $name);
        }
        include "./App/View/" . $name . ".php";
    }
}
?>