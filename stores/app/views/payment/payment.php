<div class="checkout-container">
    <h1 class="main-title">Thanh toán</h1>
    
    <div class="step-progress">
        <div class="step active">1. Thông tin</div>
        <div class="step active current">2. Thanh toán</div>
    </div>

    <div class="checkout-box">

        <!-- MÃ GIẢM GIÁ -->
        <div class="promo-code-section">
            <input type="text" placeholder="Nhập mã giảm giá" class="promo-input">
            <button class="apply-button">Áp dụng</button>
        </div>

        <!-- ORDER SUMMARY -->
        <div class="order-summary">
            <div class="summary-item">
                <span class="label">Số lượng sản phẩm</span>
                <span class="value">
                    <?php
                        $quantity = 0;
                        if(!empty($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $item){
                                $quantity += $item['quantity'];
                            }
                        }
                        echo $quantity;
                    ?>
                </span>
            </div>
            <div class="summary-item">
                <span class="label">Tổng tiền hàng</span>
                <span class="value">
                    <?php
                        $total = 0;
                        if(!empty($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $item){
                                $total += $item['price'] * $item['quantity'];
                            }
                        }
                        echo number_format($total) . "đ";
                    ?>
                </span>
            </div>
            <div class="summary-item shipping">
                <span class="label">Phí vận chuyển</span>
                <span class="value free">Miễn phí</span>
            </div>
            <div class="summary-item total">
                <span class="label">Tổng tiền</span>
                <span class="value">
                    <?= number_format($total) ?>đ
                </span>
            </div>
        </div>

        <!-- PAYMENT METHOD FORM -->
        <form method="POST" action="index.php?action=placeOrder">

            <div class="payment-method-section">
                <h3>Phương thức thanh toán</h3>
                <div class="method-list">
                    <label class="method-option">
                        <input type="radio" name="payment_method" value="momo" checked>
                        <span class="radio-custom"></span>
                        <img src="unnamed.png" alt="MoMo" class="payment-logo">
                        <span class="method-text">VÍ MOMO hoặc chuyển khoản</span>
                    </label>
                    
                    <label class="method-option">
                        <input type="radio" name="payment_method" value="vnpay">
                        <span class="radio-custom"></span>
                        <img src="vnpay-logo-vinadesign-25-12-57-55.jpg" alt="VNPay" class="payment-logo">
                        <span class="method-text">VÍ MOMO hoặc chuyển khoản</span>
                    </label>
                    
                    <label class="method-option">
                        <input type="radio" name="payment_method" value="other">
                        <span class="radio-custom"></span>
                        <img src="istockphoto-1093719722-612x612.jpg" alt="Other" class="payment-logo">
                        <span class="method-text">VÍ MOMO hoặc chuyển khoản</span>
                    </label>
                </div>
            </div>

            <!-- THÔNG TIN NHẬN HÀNG GIỮ NGUYÊN CỨNG -->
            <div class="shipping-info-section">
                <h3>Thông tin nhận hàng</h3>
                <div class="info-list">
                    <div class="info-item">
                        <span class="label">Khách hàng</span>
                        <span class="value right">Bao <span class="member-tag">SG-member</span></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Số điện thoại</span>
                        <span class="value">0123456789</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Email</span>
                        <span class="value">0123456789</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Nhận hàng tại</span>
                        <span class="value address">139 Trần Não, P. Bình An, Quận 2, TP. HCM</span>
                    </div>
                </div>
            </div>

            <!-- FOOTER SUMMARY & BUTTON -->
            <div class="footer-summary">
                <div class="temp-total-row"> 
                    <span class="temp-total-label">Tổng tiền tạm tính:</span>
                    <span class="temp-total-value"><?= number_format($total) ?>đ</span> 
                </div>

                <button type="submit" class="pay-button">Thanh toán</button>
            </div>

        </form>

    </div>
</div>
