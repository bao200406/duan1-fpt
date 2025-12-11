<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT IMAGE -->
        <div class="auth-image">
            <img src="/duan1-fpt/stores/public/images/shoes.jpg" alt="Reset Password Image">
        </div>

        <!-- RIGHT FORM -->
        <div class="auth-form-container">
            <h2 class="auth-title">Đặt Lại Mật Khẩu</h2>
            <p class="auth-subtitle">Nhập mật khẩu mới của bạn</p>

            <?php if(!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>
            <?php if(!empty($success)) echo "<p class='success-msg'>$success</p>"; ?>

            <form method="POST" class="auth-form" action="index.php?controller=auth&action=resetPassword">
                <!-- token ẩn -->
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu mới" required>
                </div>

                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                </div>

                <button class="btn-primary" type="submit">Đặt lại mật khẩu</button>

                <p class="switch-link">
                    Nhớ mật khẩu?
                    <a href="index.php?controller=auth&action=login">Đăng nhập ngay</a>
                </p>
            </form>
        </div>

    </div>
</div>
