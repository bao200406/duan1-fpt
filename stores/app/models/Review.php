<?php
require_once __DIR__ . '/../../config/database.php';

class Review {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả review theo product_id
    public function getReviewsByProduct($product_id) {
        $sql = "SELECT r.*, u.name
                FROM reviews r
                JOIN users u ON r.users_id = u.id
                WHERE r.product_id = :product_id
                ORDER BY r.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm review
    public function create($data) {
    $sql = "INSERT INTO reviews (product_id, users_id, rating, comment, orders_id)
            VALUES (:product_id, :users_id, :rating, :comment, :orders_id)";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':product_id' => $data['product_id'],
        ':users_id'   => $data['user_id'],
        ':rating'     => $data['rating'],
        ':comment'    => $data['comment'],
        ':orders_id'  => $data['orders_id'] ?? null
    ]);

    return $this->conn->lastInsertId();
}


    // Lấy rating trung bình
    public function getAverageRating($product_id) {
        $sql = "SELECT AVG(rating) AS average_rating
                FROM reviews
                WHERE product_id = :product_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa review theo id
    public function delete($id) {
        $sql = "DELETE FROM reviews WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return true;
    }
}
