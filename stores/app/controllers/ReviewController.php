<?php
require_once __DIR__ . '/../models/Review.php';

class ReviewController {

    private $reviewModel;

    public function __construct() {
        $this->reviewModel = new Review();
    }

    // Xử lý form gửi review
    public function store() {

        // Chưa đăng nhập thì không cho bình luận
        if (!isset($_SESSION['users_id'])) {
           header("Location: index.php?action=login");
            exit();
        }

        $data = [
            'product_id' => $_POST['product_id'],
            'users_id'    => $_SESSION['users_id'],
            'rating'     => $_POST['rating'],
            'comment'    => $_POST['comment']
        ];

        $this->reviewModel->create($data);

        // quay về trang sản phẩm
        header("Location: index.php?action=product");
        exit();
    }
}
