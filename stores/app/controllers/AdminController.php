<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Order.php';

class AdminController {
    public $conn; // Kết nối database

    // Constructor tự động kết nối database
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Hiển thị dashboard admin
    public function index() {
        // Bạn có thể query dữ liệu ở đây nếu cần
        // ví dụ: $categories = $this->getCategories(); // Kiểm tra kết nối
         // Lấy danh sách sản phẩm
        $productModel = new Product();
        $products = $productModel->getAll();

        $orderModel = new Order();
        $orders =  $orderModel->getAllOrders();

        // Lấy danh sách danh mục
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $userModel = new User();
        $users = $userModel->getAll();

        $message = '';
        if($this->conn) {
            $message = '✅ Kết nối database thành công!';
        } else {
            $message = '❌ Kết nối database thất bại!';
        }

        // Hiển thị thông báo ở trên cùng
        echo "<div style='width: 100%;  color: black; text-align: center; padding: 10px; position: fixed; top: 0; left: 0; z-index: 9999;'>
                $message
            </div>";

            // Hiển thị layout
            require __DIR__ . '/../views/admin/layouts/header.php';
            require __DIR__ . '/../views/admin/dashboard.php';
            require __DIR__ . '/../views/admin/layouts/footer.php';
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus() {
        if (!isset($_POST['id']) || !isset($_POST['status'])) {
            die("Thiếu dữ liệu cập nhật trạng thái");
        }

        $order_id = $_POST['id'];
        $status = $_POST['status'];

        $orderModel = new Order();
        $orderModel->updateStatus($order_id, $status);

        // Sau khi đổi trạng thái quay lại trang admin
        header("Location: index.php?action=admin");
        exit();
    }


}
?>
