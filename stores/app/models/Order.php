<?php
require_once __DIR__ . '/../../config/database.php';

class Order {
    private $conn;
    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả order kèm tên khách hàng
        public function getAllOrders() {
            $stmt = $this->conn->prepare("
                SELECT 
                    orders.*, 
                    users.name AS customer_name
                FROM orders
                JOIN users ON orders.users_id = users.id
                ORDER BY orders.order_date DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    // Thêm order mới
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO orders (order_date, total, status, users_id, payment_id)
            VALUES (:order_date, :total, :status, :users_id, :payment_id)
        ");
        $stmt->execute([
            ':order_date' => $data['order_date'],
            ':total' => $data['total'],
            ':status' => $data['status'] ?? 'pending',
            ':users_id' => $data['users_id'],
            ':payment_id' => $data['payment_id']
        ]);
        return $this->conn->lastInsertId();
    }

    // Cập nhật payment_id
    public function updatePaymentId($order_id, $payment_id) {
        $stmt = $this->conn->prepare("UPDATE orders SET payment_id=:payment_id WHERE id=:id");
        $stmt->execute([':payment_id'=>$payment_id, ':id'=>$order_id]);
    }

    // Lấy order theo id
    public function getOrder($id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id=:id");
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($order_id, $status) {
        $stmt = $this->conn->prepare("
            UPDATE orders 
            SET status = :status 
            WHERE id = :id
        ");
        return $stmt->execute([
            ':status' => $status,
            ':id' => $order_id
        ]);
    }

     // Lấy tất cả đơn hàng của user
        public function getOrdersByUser($user_id) {
            $stmt = $this->conn->prepare("
                SELECT o.*, p.method AS payment_method
                FROM orders o
                LEFT JOIN payment p ON o.payment_id = p.id
                WHERE o.users_id = :user_id
                ORDER BY o.order_date DESC
            ");
            $stmt->execute([':user_id' => $user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }



}
