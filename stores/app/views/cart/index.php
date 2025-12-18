<main class="main">
    <h1>Giỏ hàng của bạn</h1>

    <div class="container">

        <div class="cart-all">
            <!-- LEFT SIDE -->
            <div class="cart-left">

                <?php if (empty($cart)): ?>
                    <p>Giỏ hàng trống!</p>
                <?php else: ?>
                    <form action="index.php?action=cart_update" method="POST" style="display:grid; row-gap: 10px">
                        <?php 
                        $total = 0;
                        foreach ($cart as $cart_key => $item):
                            $itemTotal = $item['price'] * $item['quantity'];
                            $total += $itemTotal;
                        ?>
                            <div class="cart-item">

                                <img src="/duan1-fpt/stores/public/images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="100">

                                <div class="info">
                                    <div class="name"><?= $item['name'] ?></div>
                                    <?php if(isset($item['color'])): ?>
                                        <div class="color">Màu: <?= $item['color'] ?></div>
                                    <?php endif; ?>

                                    <div class="price-row">
                                        <div class="new-price" id="price-<?= $cart_key ?>" data-price="<?= $item['price'] ?>"><?= number_format($item['price'], 0, ',', '.') ?>đ</div>
                                        <?php if(isset($item['old'])): ?>
                                            <div class="old-price"><?= number_format($item['old'], 0, ',', '.') ?>đ</div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="quantity">
                                        <label for="qty">Số lượng:</label>
                                        <button type="button" onclick="changeCartQty('<?= $cart_key ?>', -1)">−</button>
                                        <span id="qty-display-<?= $cart_key ?>"><?= $item['quantity'] ?></span>
                                        <button type="button" onclick="changeCartQty('<?= $cart_key ?>', 1)">+</button>

                                        <input type="hidden" name="quantities[<?= $cart_key ?>]" id="input-qty-<?= $cart_key ?>" value="<?= $item['quantity'] ?>">
                                    </div>

                                </div>

                                <div class="delete">
                                    <a href="index.php?action=cart_delete&cart_key=<?= $cart_key ?>">Xóa</a>
                                </div>

                            </div>

                            <div class="item-total" id="item-total-<?= $cart_key ?>" data-price="<?= $item['price'] ?>" data-total="<?= $itemTotal ?>">
                                Tổng: <?= number_format($itemTotal, 0, ',', '.') ?>đ
                            </div>
                        <?php endforeach; ?>

                        <div class="cart-actions">

                            <!-- <button type="submit">Cập nhật giỏ hàng</button>
                            <a href="index.php?action=cart_clear" class="clear-cart-btn">Xóa toàn bộ giỏ hàng</a> -->
                            <a href="index.php?action=checkout" class="checkout-btn">Thanh toán</a>
                        </div>
                    </form>
                <?php endif; ?>


            </div>

            <!-- RIGHT SIDE -->
            <div class="cart-right">
                <div class="promo-box">
                    <div class="promo-title">Khuyến mãi hấp dẫn</div>
                    <ul class="promo-list">
                        <li>Đặc quyền trợ giá lên đến 3 triệu khi thu cũ lên đời iPhone</li>
                        <li>Trả góp 0% lãi suất, tối đa 12 tháng</li>
                        <li>Giảm ngay 5% tối đa 500k mua Apple Watch/Airpods</li>
                    </ul>
                </div>

                <div class="summary-box">
                    <div class="summary-title">THÔNG TIN ĐƠN HÀNG</div>

                    <div class="summary-content">

                        <div class="promo-code-section" style="margin-bottom: 20px;">
                            <form action="index.php?action=apply_voucher" method="POST" style="display: flex; gap: 5px;">
                                <input type="text" name="voucher_code" placeholder="Nhập mã giảm giá" 
                                    style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex-grow: 1;">
                                <button type="submit" style="padding: 8px 15px; cursor: pointer; background: #0094f7; color: #fff; border: none; border-radius: 4px;">
                                    Áp dụng
                                </button>
                            </form>
                            
                            <?php if (isset($_SESSION['voucher'])): ?>
                                <div style="margin-top: 10px; color: green; font-size: 0.9em;">
                                    Đã áp dụng mã: <strong><?= $_SESSION['voucher']['code'] ?></strong> 
                                    (-<?= number_format($_SESSION['voucher']['discount'], 0, ',', '.') ?>đ)
                                    <a href="index.php?action=remove_voucher" style="color: red; text-decoration: none; margin-left: 10px;">[Xóa]</a>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_voucher'): ?>
                                <div style="margin-top: 10px; color: red; font-size: 0.9em;">Mã giảm giá không hợp lệ!</div>
                            <?php endif; ?>
                        </div>

                    <div class="summary-content">
                        <?php 
                            // Lấy số tiền giảm giá từ session, nếu không có thì bằng 0
                            $discount = isset($_SESSION['voucher']) ? $_SESSION['voucher']['discount'] : 0;
                            $grandTotal = $total - $discount;
                            if ($grandTotal < 0) $grandTotal = 0; // Đảm bảo tiền không âm
                        ?>

                        <div class="summary-details" style="margin-bottom: 15px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span>Tạm tính:</span>
                                <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                            </div>

                            <?php if ($discount > 0): ?>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px; color: red;">
                                    <span>Giảm giá:</span>
                                    <span>-<?= number_format($discount, 0, ',', '.') ?>đ</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="summary-total" style="border-top: 1px solid #eee; padding-top: 10px; font-weight: bold; font-size: 1.2em;">
                            Tổng thanh toán: <span id="cart-total" style="color: #d70018;"><?= number_format($grandTotal, 0, ',', '.') ?></span>đ
                        </div>

                        </div>

                        <p class="thongtindesc" style="margin-bottom: 20px;">Phí vận chuyển sẽ được tính ở trang thanh toán</p>
                        <p class="thongtindesc" style="margin-bottom: 10px;">Bạn cũng có thể nhập mã giảm giá ở trang thanh toán</p>

                        <hr>

                        <div class="invoice">
                            <input type="checkbox" /> Xuất hóa đơn
                        </div>

                        <form action="index.php?action=checkout" method="POST" style="display:inline;">
                            <button type="submit" class="checkout-btn">Đặt hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>
