<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\ShippingAddressDAO;
use App\Model\ShippingAddress;

class DeliveryController extends BaseController {
    public function addShippingAddress() {
        if (isset($_SESSION['user'])) {
            $user = json_decode($_SESSION['user']);
            $shippingAddress = new ShippingAddress();
            $shippingAddress->userId = $user->userId;
            $shippingAddress->receiverName = $_POST['receiverName'];
            $shippingAddress->receiverPhoneNumber = $_POST['receiverPhoneNumber'];
            $shippingAddress->address = $_POST['address'];
            $shippingAddressDAO = new ShippingAddressDAO();
            $shippingAddressDAO->insert($shippingAddress);
        } else {
            $response = [
                "status" => "fail",
                "message" => "Đăng nhập để thực hiện tác vụ này"
            ];
            echo json_encode($response);
        }
    }

    public function showAllShippingAddress() {
        $shippingAddressDAO = new ShippingAddressDAO();
        $allShippingAddress = $shippingAddressDAO->getAll();
        for ($i = 0; $i < sizeof($allShippingAddress); ++$i) {
            $this->views('address_item', [
                'shippingAddress' => $allShippingAddress[$i]
            ]);
        }
    }
}
?>