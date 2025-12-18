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
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        if($quantity < 1) $quantity = 1;

        $product_id = $_POST['id'] ?? null;
        $variant_id = $_POST['variant_id'] ?? null;

        if (!$product_id || !$variant_id) {
            die("Chưa chọn sản phẩm hoặc biến thể.");
        }

        $product = $this->productModel->find($product_id);
        $variant = $this->variantModel->find($variant_id);

        if (!$product || !$variant) {
            die("Sản phẩm hoặc biến thể không tồn tại.");
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cart_key = $product_id . '_' . $variant_id;

        if (isset($_SESSION['cart'][$cart_key])) {
            $_SESSION['cart'][$cart_key]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$cart_key] = [
                'product_id' => $product['id'],
                'name'       => $product['name'],
                'price'      => $product['price'],
                'image'      => $product['image'] ?? '',
                'quantity'   => $quantity,
                'variant_id' => $variant['id'],
                'color'      => $variant['color'],
                'options'    => $variant['options']
            ];
        }

        header("Location: index.php?action=cart");
        exit;
    }

    public function update() {
        $cart_key = $_POST['cart_key'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;

        if (!$cart_key || !isset($_SESSION['cart'][$cart_key])) {
            echo json_encode(["status" => "error", "message" => "Invalid cart key"]);
            exit;
        }

        $_SESSION['cart'][$cart_key]['quantity'] = max(1, (int)$quantity);

        echo json_encode([
            "status" => "success",
            "cart" => $_SESSION['cart']
        ]);
        exit;
    }

    // Áp dụng mã giảm giá
    public function apply_voucher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $voucher_code = trim($_POST['voucher_code'] ?? '');

            if (empty($voucher_code)) {
                header("Location: index.php?action=cart&error=empty_code");
                exit;
            }

            $valid_vouchers = [
                'GIAM500' => 500000,
                'IPHONE100' => 1000000
            ];

            if (isset($valid_vouchers[$voucher_code])) {
                $_SESSION['voucher'] = [
                    'code' => $voucher_code,
                    'discount' => $valid_vouchers[$voucher_code]
                ];
                header("Location: index.php?action=cart&success=voucher_applied");
            } else {
                header("Location: index.php?action=cart&error=invalid_code");
            }
            exit;
        }
    }

    // Xóa mã giảm giá
    public function remove_voucher() {
        if (isset($_SESSION['voucher'])) {
            unset($_SESSION['voucher']);
        }
        header("Location: index.php?action=cart&success=voucher_removed");
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
        if (isset($_SESSION['voucher'])) unset($_SESSION['voucher']); // Xóa luôn voucher khi xóa giỏ hàng
        header("Location: index.php?action=cart");
        exit();
    }
} // Kết thúc Class CartController - Chỉ có duy nhất 1 dấu đóng ngoặc ở cuối file
