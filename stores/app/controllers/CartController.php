<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/ProductVariant.php';

class CartController {

    private $productModel;
    private $variantModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->variantModel = new ProductVariant();
    }

    // Trang giỏ hàng
    public function index() {
        $cart = $_SESSION['cart'] ?? [];

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/cart/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add() {
                // Lấy quantity từ form, mặc định là 1 nếu không có hoặc không hợp lệ
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            if($quantity < 1) $quantity = 1; // không cho số lượng âm hoặc 0

            // Lấy product_id và variant_id từ form
            $product_id = $_POST['id'] ?? null;
            $variant_id = $_POST['variant_id'] ?? null;

            if (!$product_id || !$variant_id) {
                die("Chưa chọn sản phẩm hoặc biến thể.");
            }

            // Lấy thông tin sản phẩm và biến thể
            $product = $this->productModel->find($product_id);
            $variant = $this->variantModel->find($variant_id);

            if (!$product || !$variant) {
                die("Sản phẩm hoặc biến thể không tồn tại.");
            }

            // Khởi tạo giỏ hàng nếu chưa có
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Tạo key duy nhất cho sản phẩm + biến thể
            $cart_key = $product_id . '_' . $variant_id;

            if (isset($_SESSION['cart'][$cart_key])) {
                // Nếu đã tồn tại → cộng thêm quantity vừa gửi
                $_SESSION['cart'][$cart_key]['quantity'] += $quantity;
            } else {
                // Thêm sản phẩm mới
                $_SESSION['cart'][$cart_key] = [
                    'product_id' => $product['id'],
                    'name'       => $product['name'],
                    'price'      => $product['price'],
                    'image'      => $product['image'] ?? '',
                    'quantity'   => $quantity, // <-- lấy đúng từ form
                    'variant_id' => $variant['id'],
                    'color'      => $variant['color'],
                    'options'    => $variant['options']
                ];
            }

              // ===============================
                // DEBUG: xem quantity và giỏ hàng
                // echo "<h3>Debug giỏ hàng</h3>";
                // echo "Quantity nhận được từ form: $quantity<br>";
                // echo "<pre>";
                // print_r($_SESSION['cart']);
                // echo "</pre>";
                // exit; // Dừng để kiểm tra trước khi redirect
                // ===============================

                // Chuyển về trang giỏ hàng
                header("Location: index.php?action=cart");
                exit;
    }

    public function update() {
    $cart_key = $_POST['cart_key'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;

    if (!$cart_key || !isset($_SESSION['cart'][$cart_key])) {
        echo "Invalid cart key";
        exit;
    }

    $_SESSION['cart'][$cart_key]['quantity'] = max(1, (int)$quantity);

    // TRẢ VỀ JSON CHO JS
    echo json_encode([
        "status" => "success",
        "cart" => $_SESSION['cart']
    ]);
    exit;
}


    // Xóa sản phẩm khỏi giỏ hàng
    public function delete() {
        $cart_key = $_GET['cart_key'] ?? null;
        if ($cart_key && isset($_SESSION['cart'][$cart_key])) {
            unset($_SESSION['cart'][$cart_key]);
        }
        header("Location: index.php?action=cart");
        exit();
    }

    // Xóa toàn bộ giỏ hàng
    public function clear() {
        unset($_SESSION['cart']);
        header("Location: index.php?action=cart");
        exit();
    }
}
