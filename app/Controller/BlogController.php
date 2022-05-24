<?php
namespace App\Controller;

use App\Controller\BaseController;

class BlogController extends BaseController {
    public function showMainPage() {
        $data = ["page" => "Pages/blog"];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views("layout.user",$data);
    }
}
?>