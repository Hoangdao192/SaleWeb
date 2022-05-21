<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Database\DAO\OrderDAO;
use App\Database\DAO\OrderDetailDAO;

class AdminAnalyticController extends BaseController {
    public function showStatisticByYear() {
        $year = $_POST['year'];
        $orderDAO = new OrderDAO;
        echo $orderDAO->getStatisticByYear($year);
    }

    public function showProductStastiticByYear() {
        $year = $_POST['year'];
        $orderDetailDAO = new OrderDetailDAO();
        echo $orderDetailDAO->getStatisticByYear($year);
    }

    public function showStatisticByMonth() {
        $year = $_POST['year'];
        $month = $_POST['month'];
        $orderDAO = new OrderDAO();
        echo $orderDAO->getStastiticByMonth($year, $month);
    }

    public function showProductStatisticByMonth() {
        $year = $_POST['year'];
        $month = $_POST['month'];
        $orderDetailDAO = new OrderDetailDAO();
        echo $orderDetailDAO->getStatisticByMonth($year, $month);
    }
}
?>