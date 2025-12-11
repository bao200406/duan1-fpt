<?php
require_once __DIR__ . '/../../config/database.php';

class Payment {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Thêm payment
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO payment (order_id, method)
            VALUES (:order_id, :method)
        ");
        $stmt->execute([
            ':order_id' => $data['order_id'],
            ':method' => $data['method']
        ]);
        return $this->conn->lastInsertId();
    }

    // Lấy payment theo order_id
    public function getByOrderId($order_id) {
        $stmt = $this->conn->prepare("SELECT * FROM payment WHERE order_id=:order_id");
        $stmt->execute([':order_id'=>$order_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
