<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT IMAGE -->
        <div class="auth-image">
            <img src="/duan1-fpt/stores/public/images/shoes.jpg" alt="Register Image">
        </div>

        <!-- RIGHT FORM -->
        <div class="auth-form-container">
            <h2 class="auth-title">Create Account</h2>
            <p class="auth-subtitle">Đăng ký tài khoản mới</p>

            <?php if(!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>
            <?php if(!empty($success)) echo "<p class='success-msg'>$success</p>"; ?>

            <form method="POST" class="auth-form" action="index.php?action=register">

                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="name" placeholder="Nhập họ và tên" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Nhập email" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Tạo mật khẩu" required>
                </div>

                <button class="btn-primary" type="submit">Tạo tài khoản</button>

                <p class="switch-link">
                    Đã có tài khoản?
                    <a href="index.php?action=login">Đăng nhập ngay</a>
                </p>
            </form>
        </div>

    </div>
</div>
