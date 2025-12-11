<?php
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/Product.php';
class ProductDetailController {
     public function index() {
    // Lấy id sản phẩm từ URL
    $productId = $_GET['id'] ?? null;
    if (!$productId) {
        echo "Không tìm thấy sản phẩm";
        return;
    }

    // Lấy dữ liệu sản phẩm
    $productModel = new Product();
    $product = $productModel->find($productId);
    if (!$product) {
        echo "Sản phẩm không tồn tại";
        return;
    }

    // Lấy variants nếu có
    $variantModel = new ProductVariant();
    $variants = $variantModel->getByProductId($productId);

    // Lấy danh sách review
    $reviewModel = new Review();
    $reviews = $reviewModel->getReviewsByProduct($productId);

    // Load view (header + content + footer)
    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/productDetail/index.php';
    require __DIR__ . '/../views/layouts/footer.php';

    // Debug nếu muốn
    // echo '<pre>';
    // print_r($product);
    // print_r($variants);
    // print_r($reviews);
    // echo '</pre>';
    // exit;
}



    public function addReview() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $productId = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    // LẤY ID USER ĐÚNG CÁCH
    $userId = $_SESSION['user']['id'];

    $reviewModel = new Review();
    // Gửi đúng dạng mảng theo model
        $reviewModel->create([
            'product_id' => $productId,
            'user_id'    => $userId,
            'rating'     => $rating,
            'comment'    => $comment,
            'orders_id'  => null
        ]);

     // Redirect về trang chi tiết sản phẩm kèm id
    header("Location: index.php?action=ProductDetailController&id=" . $productId);
    exit;
}

}
?>
