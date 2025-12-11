<?php
require_once __DIR__ . '/../models/Order.php';

class OrderController {

    // Thanh toán thành công → cập nhật trạng thái đơn hàng
    public function paymentSuccess($orderId) {
        $orderModel = new Order();
        $orderModel->updateStatus($orderId, 'completed'); // cập nhật status

        // Quay về lịch sử đơn hàng để user thấy
        header("Location: index.php?action=history");
        exit();
    }

    // (Tùy chọn) Lấy danh sách đơn hàng của user
    // public function history($userId) {
    //     $orderModel = new Order();
    //     $orders = $orderModel->getOrdersByUser($userId); 
    //     require __DIR__ . '/../views/user/history.php';
    // }
}
