<?php
// require_once "./models/Product.php";
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/ProductVariant.php';

class ProductController {

    // Hàm hiển thị danh sách sản phẩm
    public function index() {
 // Lấy danh sách sản phẩm
            $productModel = new Product();
            $products = $productModel->getAll();
            require __DIR__ . '/../views/layouts/header.php';
            // Load main content
            require __DIR__ . '/../views/product/index.php';
            // Load footer
            require __DIR__ . '/../views/layouts/footer.php';
            
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel = new Product();

            // Lấy dữ liệu từ form
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                'image' => $_POST['image'],
                'brand' => $_POST['brand'],
                'category_id' => $_POST['category_id']
            ];

            // Thêm sản phẩm và lấy product_id vừa tạo
            $product_id = $productModel->create($data);
            if (!$product_id) {
                die("Lỗi: Product không được thêm thành công");
            }
            // --- Phần thêm các biến thể (variant) ---
            if (isset($_POST['variant_color'])) {
                require_once __DIR__ . '/../models/ProductVariant.php';
                $variantModel = new ProductVariant();

                foreach ($_POST['variant_color'] as $index => $color) {
                    // Bỏ qua dòng trống
                    if (empty($color) && empty($_POST['variant_option'][$index])) continue;

                    $variantData = [
                        'product_id' => $product_id,
                        'color' => $color,
                        'options' => $_POST['variant_option'][$index],
                        'quantity' => $_POST['variant_quantity'][$index]
                    ];

                    $variantModel->create($variantData);
                }
            }

            // Sau khi thêm xong, quay về trang danh sách
            header('Location: admin.php?action=product');
            exit;
        }
    }


    public function deleteProduct() {
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // --- Bước 1: Xóa các biến thể liên quan ---
            require_once __DIR__ . '/../models/ProductVariant.php';
            $variantModel = new ProductVariant();
            $variantModel->deleteByProductId($product_id);

            // --- Bước 2: Xóa sản phẩm ---
            $productModel = new Product();
            $productModel->delete($product_id);
        }

        header("Location: admin.php?action=dashboard"); 
        exit;
    }


    public function showProduct() {
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        $productModel = new Product();
        $product = $productModel->find($product_id);

        $variantModel = new ProductVariant();
        $variants = $variantModel->getByProductId($product_id);

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/productDetail/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
    } else {
        header("Location: admin.php?action=product");
        exit;
    }
}


public function updateProduct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $product_id = $_POST['id'];
        $productModel = new Product();

        // Lấy dữ liệu từ form
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $brand = $_POST['brand'];
        $category_id = $_POST['category_id'];

        // Cập nhật sản phẩm
        $updated = $productModel->update($product_id, $name, $price, $description, $image, $brand, $category_id);

        if (!$updated) {
            die("Lỗi: Product không được cập nhật thành công");
        }

        // Quay về trang danh sách sản phẩm
        header('Location: admin.php?action=dashboard');
        exit;
    } else {
        // Nếu không có id hoặc không phải POST, chuyển về danh sách sản phẩm
        header('Location: admin.php?action=dashboard');
        exit;
    }
}




}
?>