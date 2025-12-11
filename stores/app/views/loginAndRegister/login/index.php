<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT IMAGE -->
        <div class="auth-image">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Login Image">
        </div>

        <!-- RIGHT FORM -->
        <div class="auth-form-container">
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Đăng nhập để tiếp tục</p>

            <?php if(!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>

            <form method="POST" class="auth-form" action="index.php?controller=auth&action=login">

                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="text" name="name" placeholder="Nhập tên đăng nhập" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <button class="btn-primary" type="submit">Đăng Nhập</button>

                <p class="switch-link">
                    Chưa có tài khoản?
                    <a href="index.php?controller=auth&action=register">Đăng ký ngay</a>
                    <a href="index.php?controller=auth&action=forgotForm">Quên mật khẩu</a>
                </p>
            </form>
        </div>

    </div>
</div>
