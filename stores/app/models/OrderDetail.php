<?php
require_once __DIR__ . '/../../config/database.php';

class OrderDetail {
    private $conn;
    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

       // Thêm chi tiết đơn hàng
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO orderdetails (order_id, product_variant_id, quantity, unit_price)
            VALUES (:order_id, :product_variant_id, :quantity, :unit_price)
        ");
        $stmt->execute([
            ':order_id' => $data['order_id'],
            ':product_variant_id' => $data['product_variant_id'],
            ':quantity' => $data['quantity'],
            ':unit_price' => $data['unit_price']
        ]);
    }

    public function getByOrderId($order_id) {
    $stmt = $this->conn->prepare("
        SELECT od.*, pv.color, pv.options, p.name AS product_name, p.image AS product_image 
        FROM orderdetails od
        JOIN productvariants pv ON od.product_variant_id = pv.id
        JOIN products p ON pv.product_id = p.id
        WHERE od.order_id = :order_id
    ");
    $stmt->execute([':order_id' => $order_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
