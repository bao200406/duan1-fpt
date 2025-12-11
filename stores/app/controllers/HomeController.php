<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';
class HomeController {
    public function index() {
        // Load header
        $categoryModel = new Category();
        $categorys = $categoryModel->getAllWithImage();
        $productModel = new Product();
        $products = $productModel->getByCategory(1);
        require __DIR__ . '/../views/layouts/header.php';
        // Load main content
        require __DIR__ . '/../views/home/index.php';
        // Load footer
        require __DIR__ . '/../views/layouts/footer.php';
    }
}
?>
