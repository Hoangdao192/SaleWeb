<?php
namespace App;

class View {
    public static function render($name, $data = []) {
        if (str_contains($name, ".")) {
            $name = str_replace(".", "/", $name);
        }
        include "./App/View/" . $name . ".php";
    }
}
?>