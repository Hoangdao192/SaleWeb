<?php
namespace Core;

class HTML {
    public static function getRootUrl() {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $arr = explode("/", filter_var(trim($requestUrl, "/"))); 
        $domain = $arr[0];
        $url = "http://localhost/" . $domain;
        return $url;
    }

    public static function style($cssFileName) {
        return HTML::getRootUrl() . "/public/css/$cssFileName";
    }

    public static function script($javascriptFileName) {
        return HTML::getRootUrl() . "/public/javascript/$javascriptFileName";
    }

    public static function image($imageFileName) {
        return HTML::getRootUrl() . "/public/images/$imageFileName";
    }
}
?>