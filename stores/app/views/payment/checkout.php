<div class="container">
    <div class="main-inform">
        <h1 class="header-title">Thanh toán</h1>
    
        <div class="progress-bar">
            <div class="progress-step active">1. Thông tin</div>
            <div class="progress-step">2. Thanh toán</div>
            <div class="progress-line"></div>
        </div>
    
        <div class="checkout-content">
    
            <!-- DANH SÁCH SẢN PHẨM (HIỂN THỊ TỪ SESSION) -->
            <div class="product-list">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="product-item">
                            <img src="/duan1-fpt/stores/public/images/<?= $item['image'] ?>" alt="" class="product-image">
                            <div class="product-details">
                                <p class="product-name"><?= $item['name'] ?></p>
                                <p class="product-color">Màu sắc: <?= $item['color'] ?></p>
                                <p class="product-price">
                                    <?= number_format($item['price']) ?>₫
                                </p>
                            </div>
                            <div class="product-quantity">Số lượng: <?= $item['quantity'] ?></div>
                        </div>
                        <hr class="separator">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Giỏ hàng đang trống</p>
                <?php endif; ?>
            </div>
    
            <!-- GIỮ NGUYÊN PHẦN NÀY -->
            <div class="customer-info-section">
                <h3>Thông tin khách hàng</h3>
    
                <div class="info-row">
                    <div class="info-label">Bao <span class="member-tag">SG-member</span></div>
                    <div class="info-value">0123456789</div>
                </div>
    
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">bao512728@gmail.com</div>
                </div>
    
                <hr>
                <div class="checkbox-row">
                    <input type="checkbox" id="newsletter" name="newsletter">
                    <label for="newsletter">Nhận email thông báo và ưu đãi từ CellphoneS</label>
                </div>
            </div>
    
            <!-- FORM THÔNG TIN NHẬN HÀNG -->
            <div class="shipping-info-section">
                <h3>Thông tin nhận hàng</h3>
    
                <form method="POST" action="index.php?action=payment">
    
                    <input type="text" name="fullname" placeholder="Họ và tên" required>
                    <input type="text" name="phone" placeholder="Số điện thoại" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="address_city" placeholder="Thành phố / Tỉnh" required>
    
                    <div class="select-row">
                        <select name="district" required>
                            <option value="">Quận / Huyện</option>
                            <option value="">Phường 15</option>
                        </select>
    
                        <select name="ward" required>
                            <option value="">Phường / Xã</option>
                            <option value="">Tân bình</option>
                        </select>
                    </div>
    
                    <!-- TỔNG TIỀN -->
                    <div class="total-row">
                        <div class="total-text">Tổng tiền tạm tính:</div>
                        <div class="total-amount">
                            <?php
                                $total = 0;
                                if (!empty($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $item) {
                                        $total += $item['price'] * $item['quantity'];
                                    }
                                }
                                echo number_format($total) . "₫";
                            ?>
                        </div>
                    </div>
    
                    <!-- BUTTON TIẾP TỤC -->
                    <div class="button-row">
                        <button type="submit" class="continue-button">Tiếp tục</button>
                    </div>
    
                </form>
            </div>
    
        </div>
    </div>
</div>
