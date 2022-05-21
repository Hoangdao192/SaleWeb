<?php
namespace Core;

class HTML {
    public static function getRootUrl() {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $arr = explode("/", filter_var(trim($requestUrl, "/"))); 
        $domain = $arr[0];
        if ($domain != 'saleweb') $domain = 'saleweb';

        $protocol = "http://";
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        }

        // $url = $protocol . $_SERVER['SERVER_NAME'] . "/" . $domain;
        $url = $protocol . $_SERVER['SERVER_NAME'] . "/saleweb";
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

    public static function getUrl($route) {
        return HTML::getRootUrl() . "/" . $route;
    }
}
?>