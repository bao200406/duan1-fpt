<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả user
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm user theo id
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByName($name) {
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Thêm user mới
    // public function create($data) {
    //     $stmt = $this->conn->prepare("INSERT INTO users (name, password, phone, address, role) VALUES (:name, :password, :phone, :address, :role)");
    //     return $stmt->execute([
    //         ':name' => $data['name'],
    //         ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
    //         ':phone' => $data['phone'] ?? null,
    //         ':address' => $data['address'] ?? null,
    //         ':role' => $data['role']
    //     ]);
    // }

     // Thêm user mới
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO users (name, email, password, phone, address, role) 
            VALUES (:name, :email, :password, :phone, :address, :role)
        ");
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],  // thêm dòng này
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':phone' => $data['phone'] ?? null,
            ':address' => $data['address'] ?? null,
            ':role' => $data['role']
        ]);
    }

    // Cập nhật user
    public function update($id, $data) {
        $sql = "UPDATE users SET name=:name, phone=:phone, address=:address, role=:role";
        if (!empty($data['password'])) {
            $sql .= ", password=:password";
        }
        $sql .= " WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        $params = [
            ':name' => $data['name'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':role' => $data['role'],
            ':id' => $id
        ];
        if (!empty($data['password'])) {
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $stmt->execute($params);
    }

    // Xóa user
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=:id");
        return $stmt->execute([':id' => $id]);
    }

      public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

       // ===================== THÊM CHỨC NĂNG QUÊN MẬT KHẨU =====================

    // Lưu token reset mật khẩu và thời gian hết hạn
    public function saveResetToken($userId, $token, $expires) {
        $stmt = $this->conn->prepare("UPDATE users SET reset_token=:token, reset_expires=:expires WHERE id=:id");
        return $stmt->execute([
            ':token' => $token,
            ':expires' => $expires,
            ':id' => $userId
        ]);
    }

    // Tìm user theo token reset mật khẩu (chỉ token còn hiệu lực)
    public function findByResetToken($token) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE reset_token=:token AND reset_expires > NOW()");
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật mật khẩu mới và xóa token
    public function updatePasswordWithToken($userId, $newPassword) {
        $stmt = $this->conn->prepare("UPDATE users SET password=:password, reset_token=NULL, reset_expires=NULL WHERE id=:id");
        return $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_DEFAULT),
            ':id' => $userId
        ]);
    }


    public function updatePasswordByEmail($email, $newPassword) {
    $stmt = $this->conn->prepare("UPDATE users SET password=:password WHERE email=:email");
    return $stmt->execute([
        ':password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ':email' => $email
    ]);
}

}
?>
