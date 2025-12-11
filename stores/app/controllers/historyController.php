<?php
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderDetail.php';

class historyController {
    public function index() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $user_id = $_SESSION['user']['id'];

    $orderModel = new Order();
    $orders = $orderModel->getOrdersByUser($user_id);

    $orderDetailModel = new OrderDetail();

    // Load view
    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/history/index.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

}
?>
