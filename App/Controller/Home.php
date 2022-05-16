<?php
namespace App\Controller;

require_once "./App/Controller/BaseController.php";
use App\Controller\BaseController;
use App\Database\DAO\ProductDAO;

class Home extends BaseController {

    public function show() {
        $productDAO = new ProductDAO();
        $products = $productDAO->getAll();
        $data = ["page" => "Pages/home", "products" => $products];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }

        $this->views("layout.user",$data);
    }
}
?>