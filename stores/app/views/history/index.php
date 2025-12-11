<!-- USER INFO -->
<div class="user-info-box">
    <div class="avatar">
        <img src="hinh/images.png" alt=""width="80" height="80">
    </div>

    <div class="user-details">
        <b>User</b> <br>
        0123456789 • SG-member
        <div class="user-stat-box">
            <div>0 đơn hàng</div>
            <div>0 tích lũy</div>
            <div>Cập nhật lại sau 01/01/2026</div>
        </div>
    </div>
</div>

<!-- TAB MENU -->
<div class="tab-menu">
    <div>🛍 Hạng thành viên</div>
    <div>🎟 Mã giảm giá</div>
    <div>📄 Lịch sử mua hàng</div>
    <div>📦 Sổ địa chỉ</div>
</div>

<!-- MAIN CONTENT -->

    <div class="container">
    
       <div class="order-history-flex">
            <!-- LEFT SIDEBAR -->
            <div class="left-sidebar">
                <div>📄 Lịch sử mua hàng</div>
                <div>🔍 Tra cứu bảo hành</div>
                <div>⭐ Ưu đãi</div>
                <div>📁 Thông tin tài khoản</div>
                <div>⚙ Chính sách bảo hành</div>
                <div>❓ Điều khoản sử dụng</div>
            </div>
        
            <!-- RIGHT CONTENT -->
            <div class="right-content">
        
                <div class="tab-filter">
                    <div>Tất cả | Chờ xác nhận | Đã xác nhận | Đang vận chuyển | Đã hủy</div>
                    <div>📅 01/12/2020 → 13/11/2025</div>
                </div>
        
               <!-- ĐƠN HÀNG -->
                    <?php foreach($orders as $order): ?>
                    <div class="order-box">
                        <div class="order-title"><?= ucfirst($order['status']) ?></div>

                        Ngày xác nhận: <?= date('d/m/Y', strtotime($order['order_date'])) ?>

                        <div class="order-line"></div>

                        <?php 
                        $orderDetails = $orderDetailModel->getByOrderId($order['id']);
                        foreach($orderDetails as $item):
                        ?>
                        <div class="order-product">
                            <div class="product-img">
                                <img src="/duan1-fpt/stores/public/images/<?= $item['product_image'] ?? 'default.png' ?>" alt="<?= $item['product_name'] ?>" width="135px" height="130px">
                            </div>
                            <div style="display: grid;">
                                <b><?= $item['product_name'] ?></b>
                                <b>Màu: <?= $item['color'] ?> <?= $item['options'] ?></b>
                                <b>Số lượng: <?= $item['quantity'] ?></b>
                                <b>Người nhận: <?= $_SESSION['user']['name'] ?></b>
                                <b><?= ucfirst($order['payment_method'] ?? 'Chuyển khoản') ?></b>
                            </div>
                        </div>
                        <hr>
                        <?php endforeach; ?>

                        <p>Thành tiền: <?= number_format($order['total'],0,',','.') ?> ₫</p> 
                        <button class="reorder-btn">Mua lại</button>
                        <button class="btn-outline" type="button" aria-label="Đánh giá">Đánh giá</button>
                    </div>
                    <?php endforeach; ?>

            </div>
       </div>
    </div>
