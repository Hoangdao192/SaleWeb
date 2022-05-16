<?php
namespace Core;

use App\Controller\Home;

class Route {
    private $url = "home/";
    private $params = ["Home", "show"]; /*user input url params*/
    private $routes = [];

    public function __construct()
    {
        $this->urlProcess();
    }

    /*Standardlize url and get user input params*/
    private function urlProcess() {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $this->params = explode("/", filter_var(trim($url, "/")));
            $arr = explode("/", filter_var(trim($url, "/"))); 
            $this->url = "";
            for ($i = 0; $i < sizeof($arr); ++$i) {
                $this->url .= $arr[$i] . "/";
            }
        }
    }

    /*Add new route*/
    public function add($route, $params) {
        $arr = explode("/", filter_var(trim($route, "/")));
        $route = "";
        for ($i = 0; $i < sizeof($arr); ++$i) {
            $route .= $arr[$i] . "/";
        }

        $this->routes[$route] = $params;
    }

    public function get($url /*key*/) {
        if (isset($routes[$url])) {
            return $routes[$url];
        }
        return null;
    }

    /*Check if $route match with user input url*/
    public function match($route) {
        if (str_contains($this->url, $route) && strpos($this->url, $route) == 0) {
            return true;
        }
        return false;
    }

    public function dispatch() {
        foreach ($this->routes as $route => $params) {
            if ($this->match($route)) {
                $arr = explode("/", filter_var(trim($route, "/")));
                for ($i = 0; $i < sizeof($arr); ++$i) {
                    array_splice($this->params, 0, 1);
                }

                $controller = "App\\Controller\\" . $params["controller"];
                call_user_func_array([new $controller, $params["action"]], $this->params);
                return;
            }
        }
    }

    public function convert($route) {
        $arr = explode("/", filter_var(trim($route, "/")));
        $route = "";
        for ($i = 0; $i < sizeof($arr); ++$i) {
            $route .= $arr[$i] . "/";
        }
        return $route;
    }

    public function getUrl() {
        return $this->url;
    }

    public static function openPostRequest($url, $params = []) {
    ?>
        <form id="open_post_request" action="<?php echo $url?>" method="post">
        <?php
            foreach ($params as $key => $value) {
            ?>
                <input type="text" style="display: none;" name="<?php echo $key?>" value="<?php echo $value?>">
            <?php
            }
        ?>
        </form>
        <script>
            document.getElementById("open_post_request").submit();
        </script>
    <?php
    }
}
?>