<style>
    .order-wrapper {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 5px 18px rgba(0,0,0,0.12);
    font-family: "Segoe UI", sans-serif;
}

.order-title {
    color: #2f9e44;
    text-align: center;
    margin-bottom: 25px;
    font-size: 28px;
}

.section-title {
    margin-top: 25px;
    font-size: 22px;
    border-left: 4px solid #2f9e44;
    padding-left: 10px;
    color: #333;
}

.order-info {
    font-size: 16px;
    margin: 6px 0;
    color: #444;
}

.order-table {
    width: 100%;
    border-collapse: collapse;
    background: #f7f7f7;
    margin-top: 15px;
    border-radius: 8px;
    overflow: hidden;
}

.order-table thead {
    background: #2f9e44;
    color: #fff;
}

.order-table th,
.order-table td {
    padding: 12px;
    font-size: 15px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

.order-table tbody tr:hover {
    background: #ececec;
}

.back-home-btn {
    display: inline-block;
    margin-top: 25px;
    padding: 12px 20px;
    background: #2f9e44;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    transition: 0.25s;
}

.back-home-btn:hover {
    background: #237732;
}

</style>


<div class="order-wrapper">
    <h1 class="order-title">Đơn hàng của bạn đã được đặt thành công!</h1>

    <h3 class="section-title">Thông tin đơn hàng</h3>
    <p class="order-info">Mã đơn hàng: #<?= $order['id'] ?></p>
    <p class="order-info">Ngày đặt hàng: <?= $order['order_date'] ?></p>
    <p class="order-info">Tổng tiền: <?= number_format($order['total']) ?>₫</p>
    <p class="order-info">Phương thức thanh toán: <?= $payment['method'] ?></p>

    <h3 class="section-title">Chi tiết sản phẩm</h3>
    <table class="order-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Biến thể</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($details as $item): ?>
            <tr>
                <td><?= $item['product_name'] ?></td>
                <td>
                    Màu: <?= $item['color'] ?>,
                    Tùy chọn: <?= $item['options'] ?>
                </td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['unit_price']) ?>₫</td>
                <td><?= number_format($item['unit_price'] * $item['quantity']) ?>₫</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="back-home-btn">Quay về trang chủ</a>
</div>
