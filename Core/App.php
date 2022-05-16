<?php
namespace Core;

class App {
    private $params = [];

    public function __construct($_params)
    {
        $this->params = $_params;
    }
}
?>