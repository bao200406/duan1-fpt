<?php
require_once __DIR__ . '/../../config/database.php';

class ProductVariant {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
    $stmt = $this->conn->query("SELECT * FROM productvariants");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy một biến thể theo id
public function find($id) {
    $stmt = $this->conn->prepare("SELECT * FROM productvariants WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Thêm biến thể
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO productvariants (product_id, color, options, quantity)
            VALUES (:product_id, :color, :options, :quantity)
        ");
        return $stmt->execute([
            ':product_id' => $data['product_id'],
            ':color' => $data['color'],
            ':options' => $data['options'],
            ':quantity' => $data['quantity']
        ]);
    }

    // Xóa tất cả biến thể của một sản phẩm
    public function deleteByProductId($product_id) {
        $stmt = $this->conn->prepare("DELETE FROM productvariants WHERE product_id = :product_id");
        return $stmt->execute([':product_id' => $product_id]);
    }

    // Lấy tất cả biến thể của một sản phẩm
    public function getByProductId($product_id) {
        $stmt = $this->conn->prepare("SELECT * FROM productvariants WHERE product_id = :product_id");
        $stmt->execute([':product_id' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>
