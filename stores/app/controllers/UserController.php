<?php
require_once __DIR__ . '/../models/User.php';

class UserController {


public function addUser() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userModel = new User();

        // Kiểm tra trùng tên
        if ($userModel->findByName($_POST['name'])) {
            $_SESSION['error'] = "Tên đăng nhập đã tồn tại!";
            header("Location: admin.php?action=user_add");
            exit;
        }

        $data = [
            'name' => $_POST['name'],
            'password' => $_POST['password'], // model sẽ hash
            'phone' => $_POST['phone'] ?? null,
            'address' => $_POST['address'] ?? null,
            'role' => $_POST['role'] ?? 'user',
            'payment_id' => $_POST['payment_id'] ?? null
        ];

        $userModel->create($data);
        $_SESSION['success'] = "Thêm user thành công!";
        header("Location: admin.php?action=user");
        exit;
    }
}


    public function editUser() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userModel = new User();
        $id = $_POST['id'];
        $data = [
            'name' => $_POST['name'],
            'password' => $_POST['password'] ?? '', // để trống nếu không đổi
            'phone' => $_POST['phone'] ?? null,
            'address' => $_POST['address'] ?? null,
            'role' => $_POST['role'] ?? 'user',
            'payment_id' => $_POST['payment_id'] ?? null
        ];

        $userModel->update($id, $data);
        $_SESSION['success'] = "Cập nhật user thành công!";
        header("Location: admin.php?action=user");
        exit;
    }
}


    // Xóa user
    public function deleteUser() {
        if (isset($_GET['id'])) {
            $userModel = new User();
            $userModel->delete($_GET['id']);
        }
        header("Location: admin.php?action=user");
        exit;
    }
}
?>
