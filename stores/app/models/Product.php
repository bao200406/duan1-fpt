<?php
require_once __DIR__ . '/../../config/database.php';
class Product {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả sản phẩm
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm theo id
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm theo category_id
    public function getByCategory($category_id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, price, description, image, brand, category_id) 
            VALUES (:name, :price, :description, :image, :brand, :category_id)");
        $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':image' => $data['image'],
            ':brand' => $data['brand'],
            ':category_id' => $data['category_id']
        ]);
        return $this->conn->lastInsertId(); // <--- cực kỳ quan trọng
    }
    // Xóa product
        public function delete($id) {
            // Xóa sản phẩm theo id
            $stmt = $this->conn->prepare("DELETE FROM products WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Kiểm tra xem bảng products còn dữ liệu không
            $check = $this->conn->query("SELECT COUNT(*) AS total FROM products")
                                ->fetch(PDO::FETCH_ASSOC);

            // Nếu bảng trống thì reset AUTO_INCREMENT = 1
            if ($check['total'] == 0) {
                $this->conn->exec("ALTER TABLE products AUTO_INCREMENT = 1");
            }

            return true;
        }

        // Sửa sản phẩm theo id
        public function update($id, $name, $price, $description, $image, $brand, $category_id) {
            $stmt = $this->conn->prepare("
                UPDATE products 
                SET name = :name, 
                    price = :price, 
                    description = :description, 
                    image = :image, 
                    brand = :brand, 
                    category_id = :category_id 
                WHERE id = :id
            ");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':brand', $brand);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':id', $id);

            return $stmt->execute(); // trả về true nếu thành công, false nếu thất bại
        }


}
