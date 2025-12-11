<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT IMAGE -->
        <div class="auth-image">
            <img src="/duan1-fpt/stores/public/images/shoes.jpg" alt="Forgot Password Image">
        </div>

        <!-- RIGHT FORM -->
        <div class="auth-form-container">
            <h2 class="auth-title">Đặt Lại Mật Khẩu</h2>
            <p class="auth-subtitle">Nhập email và mật khẩu mới</p>

            <?php if(!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>
            <?php if(!empty($success)) echo "<p class='success-msg'>$success</p>"; ?>

            <form method="POST" class="auth-form" action="index.php?controller=auth&action=forgotForm">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Nhập email của bạn" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu mới" required>
                </div>

                <div class="form-group">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required>
                </div>

                <button class="btn-primary" type="submit">Đổi mật khẩu</button>

                <p class="switch-link">
                    Nhớ mật khẩu?
                    <a href="index.php?controller=auth&action=login">Đăng nhập ngay</a>
                </p>
            </form>
        </div>

    </div>
</div>
