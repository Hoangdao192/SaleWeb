<?php
namespace App\Controller;

use App\Controller\BaseController;

class PaymentController extends BaseController {
    public function showMainPage() {
        $data = [
            'page' => 'Pages/method-payments'
        ];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views('layout.user', $data);
    }

    public function ATMPayment() {
        $data = [
            'page' => 'Pages/method-payments-ATM'
        ];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views('layout.user', $data);
    }

    public function creditCardPayment() {
        $data = [
            'page' => 'Pages/method-payments-visa'
        ];
        if ($this->isUserExists()) {
            $data['user'] = $this->getUser();
        }
        $this->views('layout.user', $data);
    }


}
?>