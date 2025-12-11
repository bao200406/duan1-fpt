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
                        <div class="summary-total">
                            Tổng tiền: <span id="cart-total"><?= number_format($total, 0, ',', '.') ?></span>đ
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