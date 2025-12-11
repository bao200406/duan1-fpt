<?php
require_once __DIR__ . '/../../config/database.php';

class Category {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả category
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM categories ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function getAllWithImage() {
    $sql = "
        SELECT 
            c.id AS category_id, 
            c.name AS category_name, 
            MIN(p.image) AS product_image
        FROM categories c
        LEFT JOIN products p ON c.id = p.category_id
        GROUP BY c.id, c.name
        ORDER BY c.id ASC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Thêm category
    public function create($name,$description = null) {
        $stmt = $this->conn->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description); // nếu không có mô tả, sẽ là NULL
        return $stmt->execute();
    }
    // Lấy category theo id
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Sửa category
        public function update($id, $name, $description) {
        $stmt = $this->conn->prepare("UPDATE categories SET name = :name, description = :description WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Xóa category
    public function delete($id) {
            // Xóa danh mục theo id
            $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Kiểm tra xem bảng categories còn dữ liệu không
            $check = $this->conn->query("SELECT COUNT(*) AS total FROM categories")
                            ->fetch(PDO::FETCH_ASSOC);

            // Nếu bảng trống thì reset AUTO_INCREMENT = 1
            if ($check['total'] == 0) {
                $this->conn->exec("ALTER TABLE categories AUTO_INCREMENT = 1");
            }

            return true;
}

}
?>
