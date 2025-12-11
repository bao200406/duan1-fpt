<?php
// Bao gồm các Controller
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

$action = $_GET['action'] ?? 'dashboard';

// Tạo instance
$admin = new AdminController();
$categoryController = new CategoryController();
$productController = new ProductController();
$userController = new UserController();

switch($action){
    case 'dashboard':
        $admin->index();
        break;

    // Category
    case 'createCategory':
        $categoryController->create();
        break;
    case 'deleteCategory':
        $categoryController->delete();
        break;
    case 'updateCategory':
        $categoryController->updateCategory();
        break;

    // Product
    case 'addProduct':
        $productController->addProduct();
        break;
    case 'deleteProduct':
        $productController->deleteProduct();
        break;
        
    case 'updateProduct':
        $productController->updateProduct();
    break;
    case 'product':
        $productController->index();
        break;
    case 'showProduct':
        $productController->showProduct(); // Hiển thị chi tiết sản phẩm
        break;

    // User
    case 'addUser':
        $userController->addUser(); // Thêm user
        break;



    default:
        $admin->index();
        break;
}
?>
