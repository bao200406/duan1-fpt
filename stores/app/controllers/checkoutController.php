<?php
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderDetail.php';
require_once __DIR__ . '/../models/payment.php';

class CheckoutController {

   public function checkout() {
     // Kiểm tra user đã login
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['checkout'] = [
            'fullname' => $_POST['fullname'],
            'phone'    => $_POST['phone'],
            'email'    => $_POST['email'],
            'city'     => $_POST['address_city'],
            'district' => $_POST['district'],
            'ward'     => $_POST['ward']
        ];


        // ===== DEBUG NGAY LẬP TỨC =====
        // echo "<h2>DEBUG: Giỏ hàng từ session</h2>";
        // echo "<pre>";
        // print_r($_SESSION['cart']);
        // echo "</pre>";

        // echo "<h2>DEBUG: Thông tin checkout</h2>";
        // echo "<pre>";
        // print_r($_SESSION['checkout']);
        // echo "</pre>";

        // Dừng script để bạn xem debug, chưa redirect
        // exit;
        // ===== END DEBUG =====

        header("Location: index.php?action=payment");
        exit;
    }

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/payment/checkout.php';
    require __DIR__ . '/../views/layouts/footer.php';
}


    // Step 2: Thanh toán
    public function payment() {
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/payment/payment.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    // Xử lý đặt hàng khi bấm "Thanh toán"
    public function placeOrder() {
        $cart = $_SESSION['cart'] ?? [];
        $checkout = $_SESSION['checkout'] ?? [];
        $payment_method = $_POST['payment_method'] ?? 'other';
         // Lấy user_id từ session
        if(!isset($_SESSION['user'])){
            header("Location: index.php?action=login");
            exit;
        }
        $user_id = $_SESSION['user']['id'];


        if(empty($cart)) {
            echo "Giỏ hàng trống!";
            return;
        }

        // 1. Tạo order
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $orderModel = new Order();
        $order_id = $orderModel->create([
            'order_date' => date('Y-m-d H:i:s'),
            'total' => $total,
            'status' => 'pending',
            'users_id' => $user_id,
            'payment_id' => null
        ]);

        // 2. Tạo order_detail
        $orderDetailModel = new OrderDetail();
        foreach($cart as $item){
            $orderDetailModel->create([
                'order_id' => $order_id,
                'product_variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price']
            ]);
        }

        // 3. Tạo payment
        $paymentModel = new Payment();
        $payment_id = $paymentModel->create([
            'order_id' => $order_id,
            'method' => $payment_method
        ]);

        // 4. Cập nhật payment_id cho orders
        $orderModel->updatePaymentId($order_id, $payment_id);

        // **MỚI**: Cập nhật trạng thái thành completed vì thanh toán giả lập thành công
        $orderModel->updateStatus($order_id, 'completed');

        // 5. Xóa giỏ hàng session
        unset($_SESSION['cart']);

        // 6. Chuyển sang trang xác nhận đơn hàng
        header("Location: index.php?action=orderConfirmation&order_id=$order_id");
        exit;
    }

    // Trang xác nhận đơn hàng
    public function orderConfirmation() {
        $order_id = $_GET['order_id'] ?? 0;

        $orderModel = new Order();
        $order = $orderModel->getOrder($order_id);

        $orderDetailModel = new OrderDetail();
        $details = $orderDetailModel->getByOrderId($order_id);

        $paymentModel = new Payment();
        $payment = $paymentModel->getByOrderId($order_id);

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/payment/order_confirmation.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}
