<?php
session_start(); 
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CartController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/ProductDetailController.php';
require_once __DIR__ . '/../app/controllers/checkoutController.php';
require_once __DIR__ . '/../app/controllers/paymentController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/historyController.php';
require_once __DIR__ . '/../app/controllers/OrderController.php';
require_once __DIR__ . '/../config/database.php';
$db = new Database();
$conn = $db->getConnection();

// if ($conn) {
//     echo "✅ Kết nối database thành công!";
// } else {
//     echo "❌ Kết nối thất bại!";
// }

// Lấy action từ URL, mặc định là home
$action = $_GET['action'] ?? 'home';

switch($action){
    case 'home':
        (new HomeController())->index();
        break;
    case 'ProductDetailController':
        (new ProductDetailController())->index();
        break;
    case 'product':
        (new ProductController())->index();
        break;
    case 'cart':
        (new CartController())->index();
        break;
    case 'cart_add':
        (new CartController())->add();
        break;
    case 'cart_update':
        (new CartController())->update();
        break;
    case 'cart_delete':
        (new CartController())->delete();
        break;
    case 'cart_clear':
        (new CartController())->clear();
        break;
    case 'admin':
        (new AdminController())->index();
    break;
    // case 'checkout':
    //     (new checkoutController())->index();
    // break;
    // case 'payment':
    //     (new paymentController())->index();
    // break;

    case 'checkout':           // Step 1
    (new CheckoutController())->checkout();
    break;

    case 'payment':            // Step 2
        (new CheckoutController())->payment();
    break;

    case 'placeOrder':         // Xử lý đặt hàng
        (new CheckoutController())->placeOrder();
    break;

    case 'orderConfirmation':  // Xác nhận đơn hàng
        (new CheckoutController())->orderConfirmation();
    break;
    case 'login':
        (new AuthController())->login();
    break;
    case 'register':
        (new AuthController())->register();
    break;
    case 'history':            
        (new historyController())->index();
    break;
    case 'cart_update':
   (new CartController())->update();
    break;

    case 'productDetailController':
    (new ProductDetailController())->index();
    break;

    case 'add_review':
    (new ProductDetailController())->addReview();
    break;


    case 'paymentSuccess':
    $orderId = $_GET['order_id'] ?? null;
    if($orderId){
        $controller = new OrderController();
        $controller->paymentSuccess($orderId);
    } else {
        echo "Thiếu order_id";
    }
    break;

    case 'forgotForm':          // Hiển thị form quên mật khẩu
    (new AuthController())->forgotForm();
    break;

    case 'sendReset':           // Xử lý gửi email reset mật khẩu
        (new AuthController())->sendReset();
    break;

    case 'resetForm':           // Hiển thị form đặt lại mật khẩu
        (new AuthController())->resetForm();
    break;

    case 'resetPassword':       // Xử lý đặt lại mật khẩu
        (new AuthController())->resetPassword();
    break;

    case 'forgotForm':
    (new AuthController())->forgotForm();
    break;
    case 'apply_voucher':
        (new CartController())->apply_voucher();
        break;
    case 'remove_voucher':
        (new CartController())->remove_voucher();
        break;

    default:
        echo "Page not found";

}
