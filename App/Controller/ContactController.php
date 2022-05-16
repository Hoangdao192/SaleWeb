<?php
namespace App\Controller;

use App\Controller\BaseController;

class ContactController extends BaseController {
    public function showMainPage() {
        $data = ["page" => "Pages/contact"];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views("layout.user",$data);
    }
}
?>