<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $name = $_POST['name'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $userModel->findByName($name);

            if ($user && password_verify($password, $user['password'])) {
                // Tạo session
                $_SESSION['user'] = $user;
                header("Location: index.php"); // Chuyển đến trang chính
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }

        // Load header
        require __DIR__ . '/../views/loginAndRegister/layouts/header.php';
        // Load main content
        require __DIR__ . '/../views/loginAndRegister/login/index.php';
        // Load footer
        require __DIR__ . '/../views/loginAndRegister/layouts/footer.php';
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Kiểm tra trùng tên
            if ($userModel->findByName($name)) {
                $error = "Tên đăng nhập đã tồn tại!";
            } else {
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password, // model sẽ hash
                    'role' => 'user'
                ];

                $userModel->create($data);
                $success = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
            }
        }

        // Load header
        require __DIR__ . '/../views/loginAndRegister/layouts/header.php';
        // Load main content
        require __DIR__ . '/../views/loginAndRegister/register/index.php';
        // Load footer
        require __DIR__ . '/../views/loginAndRegister/layouts/footer.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }

      // ===================== BỔ SUNG CHỨC NĂNG QUÊN MẬT KHẨU =====================

    // Hiển thị form quên mật khẩu

    public function forgotForm() {
    $error = '';
    $success = '';
    $userModel = new User();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            $error = "Mật khẩu không khớp!";
        } else {
            $user = $userModel->findByEmail($email);
            if ($user) {
                $userModel->updatePasswordByEmail($email, $password);
                $success = "Mật khẩu đã được đổi thành công!";
            } else {
                $error = "Email không tồn tại trong hệ thống!";
            }
        }
    }

    require __DIR__ . '/../views/loginAndRegister/auth/forgot_password.php';
}


    // Xử lý gửi email reset mật khẩu
    public function sendReset() {
        $error = '';
        $success = '';
        $userModel = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];
            $user = $userModel->findByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(50));
                $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

                $userModel->saveResetToken($user['id'], $token, $expires);

                $resetLink = "http://localhost/duan1-fpt/stores/public/index.php?controller=auth&action=resetForm&token=$token";


                $subject = "Reset mật khẩu";
                $message = "Click link để đặt lại mật khẩu: $resetLink";
                $headers = "From: no-reply@yourwebsite.com";

                mail($email, $subject, $message, $headers);
                // echo "<p>Link reset (test trên localhost): <a href='$resetLink'>$resetLink</a></p>";
            }

            $success = "Nếu email tồn tại, link reset đã được gửi.";
        }

        require __DIR__ . '/../views/loginAndRegister/auth/forgot_password.php';
    }

    // Hiển thị form đặt lại mật khẩu
    public function resetForm() {
        $token = $_GET['token'] ?? '';
        if (!$token) die("Token không hợp lệ");
        $error = '';
        $success = '';
        require __DIR__ . '/../views/loginAndRegister/auth/reset_password.php';
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword() {
        $error = '';
        $success = '';
        $userModel = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];

            if ($password !== $confirm) {
                $error = "Mật khẩu không khớp!";
            } else {
                $user = $userModel->findByResetToken($token);
                if ($user) {
                    $userModel->updatePasswordWithToken($user['id'], $password);
                    $success = "Mật khẩu đã được đặt lại thành công!";
                } else {
                    $error = "Token không hợp lệ hoặc đã hết hạn.";
                }
            }
        }

        require __DIR__ . '/../views/loginAndRegister/auth/reset_password.php';
    }
}
?>
