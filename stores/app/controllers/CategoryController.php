<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function indexCategory() {
    // Lấy danh sách danh mục từ model
    $categories = $this->categoryModel->getAll();

    // Gửi dữ liệu sang View
    // include __DIR__ . '/../views/admin/category_list.php';
}


    // Hàm thêm danh mục từ form POST
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            if (!empty($name)) {
                $result = $this->categoryModel->create($name,$description);

                if ($result) {
                    // Thêm xong redirect về danh sách để tránh submit lại form
                    echo "Them thanh cong";
                    header("Location: admin.php?action=dashboard");
                    exit;
                } else {
                    echo "❌ Thêm danh mục thất bại!";
                }
            } else {
                echo "❌ Tên danh mục không được để trống!";
            }
        }
    }
    public function delete() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $productModel = new Product();
        $products = $productModel->getByCategory($id);

        if (!empty($products)) {
            // Nếu còn sản phẩm liên quan → thông báo và không xóa
            echo "<script>
                    alert('Không thể xóa danh mục vì còn sản phẩm liên quan!');
                    window.location='admin.php?action=dashboard';
                  </script>";
            exit;
        }

        // Nếu không còn sản phẩm → xóa danh mục
        $this->categoryModel->delete($id);

        // Quay lại dashboard
        header("Location: admin.php?action=dashboard");
        exit;
    }
}

    

        public function updateCategory() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $categoryModel = new Category();
        $categoryModel->update($id, $name, $description);

        header("Location: admin.php?action=dashboard");
        exit;
    }




}
?>
