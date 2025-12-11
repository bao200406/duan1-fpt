 <main class="main">
       <div class="container">
        <section class="product-main" aria-label="Thông tin sản phẩm chính">
                <div class="product-images">
                    <img src="/duan1-fpt/stores/public/images/iphone_air-3_2 (1) 1.png" alt="iPhone Air 256GB màu xanh dương" class="main-img"/>
                    <div class="thumbs" role="list">
                    <img src="/duan1-fpt/stores/public/images/iphone_air-3_2 (1) 1.png" alt="iPhone Air xanh dương" role="listitem"/>
                    <img src="/duan1-fpt/stores/public/images/iphone_air-3_2 (1) 1.png" alt="iPhone Air màu đen" role="listitem"/>
                    <img src="/duan1-fpt/stores/public/images/iphone_air-3_2 (1) 1.png" alt="iPhone Air màu vàng" role="listitem"/>
                    </div>
                </div>
            <form method="POST" action="index.php?action=cart_add" style="display:inline;" id="cartForm">
                <div class="product-info">
                    <h1 class="product-title"><?= $product['name'] ?></h1>

                    <div class="product-subtitle">
                        <div style="margin-top: 8px; font-size: 1.6rem;">Mã: đang cập nhật</div>
                        <div style="margin-top: 8px; font-size: 1.6rem;">
                            Thương hiệu: <?= $product['brand'] ?> | Tình trạng: Còn hàng
                        </div>
                        <br>
                        <hr>
                    </div>

                    <div class="product-price">
                        <?= number_format($product['price'], 0, ',', '.') ?> <span style="font-weight:normal;">đ</span>
                    </div>

                    <div class="quantity">
                        <label for="qty">Số lượng:</label>
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                        <span id="qty"><?= $variants[0]['quantity'] ?></span>
                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                        <!-- Input ẩn để gửi quantity lên backend -->
                        <input type="hidden" name="quantity" id="input-qty" value="<?= $variants[0]['quantity'] ?>">
                    </div>

                    <ul class="features" aria-label="Thông tin sản phẩm">
                        <?php if (!empty($product['description'])): ?>
                            <li><?= $product['description'] ?></li>
                        <?php else: ?>
                            <li>Chưa có mô tả chi tiết</li>
                        <?php endif; ?>
                    </ul>

                    <div class="color-selection">
                        Màu sắc:
                        <?php if (!empty($variants)): ?>
                            <strong style="font-size: 1.6rem;"><?= $variants[0]['color'] ?></strong>
                        <?php else: ?>
                            <strong style="font-size: 1.6rem;">Đang cập nhật</strong>
                        <?php endif; ?>
                        <div class="color-dots" role="radiogroup" aria-label="Chọn màu">
                            <?php foreach ($variants as $index => $v): ?>
                                <span 
                                    tabindex="<?= $index === 0 ? '0' : '-1' ?>" 
                                    role="radio" 
                                    aria-checked="<?= $index === 0 ? 'true' : 'false' ?>" 
                                    class="color-dot <?= 'color-' . strtolower($v['color']) ?> <?= $index === 0 ? 'active' : '' ?>" 
                                    aria-label="<?= $v['color'] ?>"
                                    data-color="<?= $v['color'] ?>"
                                ></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="themgiohangvamuangay">
                        <button class="btn-buy" type="button">Mua ngay</button>

                        <!-- Thêm vào giỏ hàng -->
                        <!-- ID sản phẩm -->
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">

                        

                        <!-- Màu sắc -->
                        <input type="hidden" name="color" id="form-color" value="<?= !empty($variants) ? $variants[0]['color'] : 'Đang cập nhật' ?>">

                        <!-- ID biến thể -->
                        <input type="hidden" name="variant_id" value="<?= !empty($variants) ? $variants[0]['id'] : 0 ?>">

                        <!-- Nút thêm vào giỏ -->
                        <button type="submit" class="btn-cart" aria-label="Thêm vào giỏ hàng">🛒</button>
                    </div>
                </div>
            </form>

    
                <aside>
                    <div class="special-offers" aria-label="Ưu đãi đặc biệt">
                    <b><i class="fa-solid fa-gift"></i>  Ưu đãi đặc biệt</b>
                    <ul>
                        <li>Giảm 250.000đ khi mua kèm gói bảo hành VIP 12 tháng 1 Đổi 1.</li>
                        <li>Giảm trực tiếp 40%, tối đa 600.000 VNĐ khi mở thẻ TP Bank EVO.</li>
                        <li>Thu cũ đổi mới: Thu giá cao trả góp đến 95%.</li>
                        <li>Tăng cường lực.</li>
                    </ul>
                    </div>
                    <div class="action-buttons">
                        <button aria-label="Thêm vào yêu thích">
                        ♡ Thêm vào yêu thích
                        </button>
                        <button aria-label="Thêm vào so sánh">
                        ≡ Thêm vào so sánh
                        </button>
                    </div>
                </aside>
        </section>
    
        <section class="related-products" aria-label="Sản phẩm liên quan">
                <h3>Sản phẩm liên quan</h3>
                <div class="related-list">
                    <!-- Lặp nhiều lần sản phẩm liên quan -->
                    <article class="related-item" tabindex="0" aria-label="iPhone Air 256GB Chính hãng - 31.190.000đ">
                    <div class="related-discount">Sơmember giảm đến 300.000đ</div>
                    <div class="related-tag">Trả góp 0%</div>
                    <img src="hinh/iphone_air-3_2.webp" alt="iPhone Air 256GB màu xanh dương" />
                    <div class="related-content">
                        <div class="related-name">iPhone Air 256GB Chính hãng</div>
                        <div class="related-price">
                        31.190.000đ <del>31.990.000đ</del>
                        </div>
                        <div class="related-info">
                        <div class="stars" aria-label="5 sao">★ ★ ★ ★ ★</div>
                        <div class="wishlist" aria-label="Yêu thích sản phẩm">♡ Yêu thích</div>
                        </div>
                    </div>
                    </article>
                    <article class="related-item" tabindex="0" aria-label="iPhone Air 256GB Chính hãng - 31.190.000đ">
                    <div class="related-discount">Sơmember giảm đến 300.000đ</div>
                    <div class="related-tag">Trả góp 0%</div>
                    <img src="hinh/iphone_air-3_2.webp" alt="iPhone Air 256GB màu xanh dương" />
                    <div class="related-content">
                        <div class="related-name">iPhone Air 256GB Chính hãng</div>
                        <div class="related-price">
                        31.190.000đ <del>31.990.000đ</del>
                        </div>
                        <div class="related-info">
                        <div class="stars" aria-label="5 sao">★ ★ ★ ★ ★</div>
                        <div class="wishlist" aria-label="Yêu thích sản phẩm">♡ Yêu thích</div>
                        </div>
                    </div>
                    </article>
                    <article class="related-item" tabindex="0" aria-label="iPhone Air 256GB Chính hãng - 31.190.000đ">
                    <div class="related-discount">Sơmember giảm đến 300.000đ</div>
                    <div class="related-tag">Trả góp 0%</div>
                    <img src="hinh/iphone_air-3_2.webp" alt="iPhone Air 256GB màu xanh dương" />
                    <div class="related-content">
                        <div class="related-name">iPhone Air 256GB Chính hãng</div>
                        <div class="related-price">
                        31.190.000đ <del>31.990.000đ</del>
                        </div>
                        <div class="related-info">
                        <div class="stars" aria-label="5 sao">★ ★ ★ ★ ★</div>
                        <div class="wishlist" aria-label="Yêu thích sản phẩm">♡ Yêu thích</div>
                        </div>
                    </div>
                    </article>
                    <!-- Thêm các sản phẩm tương tự nếu cần -->
                </div>
                <!-- Phần tiếp nối đặt bên trong <main> hoặc trong phần container chính -->
    
    
            <div class="product-details">
            <!-- Thông tin sản phẩm -->
            <section class="product-info-text" aria-label="Thông tin sản phẩm">
                <h2>Thông tin sản phẩm</h2>
                <p>
                Như dự đoán, Apple trong năm 2022 đã không còn giữ thế thượng phong iPhone Mini mà thay vào đó là phiên bản iPhone Air hoàn toàn mới.
                Máy sử dụng thiết kế thân hình dài tựa giống như iPhone 14 và kích thước màn hình lớn 7.8 inch như iPhone 14 Pro Max.
                Đặc biệt máy có thêm khả năng tái tạo chuẩn chuẩn màu P3 với độ sâu cực kỳ ấn tượng, đặc biệt được trang bị chip trên iPhone Air.
                Máy đi kèm màn hình 6,7 inch độ sáng lớn, độ phân giải 2778 x 1284 pixels, sử dụng tấm nền OLED Super Retina XDR với độ sáng tối đa rất cao, bộ xử lý mạnh mẽ.
                iPhone Air được ra mắt tại sự kiện Far Out ngày 7/9 với 3 tùy chọn dung lượng: 128GB, 256GB và 512GB.
                </p>
    
                <img src="/duan1-fpt/stores/public/images/banner-ip.jpg" alt="Ảnh sản phẩm iPhone Air các màu">
    
                <p>
                Các điểm nổi bật của iPhone Air:
                </p>
                <ul>
                <li>Màn hình OLED 6.7 inch, độ phân giải 2778 x 1284 pixels, hỗ trợ tần số quét 120Hz.</li>
                <li>Thiết kế tinh tế với nhiều màu sắc đa dạng (Midnight, Starlight, Blue, Purple, Product Red).</li>
                <li>Camera khả năng quang học vượt trội với cảm biến 48MP, khả năng zoom 3x.</li>
                <li>Chipset Apple A16 Bionic mạnh mẽ, hiệu năng cực kỳ tốt.</li>
                <li>Pin sử dụng lâu dài cùng các công nghệ mới hỗ trợ sạc nhanh và sạc không dây.</li>
                </ul>
    
                <p>
                Máy có zoom quang học 2x và zoom kỹ thuật số lên đến 15x, cùng nhiều chế độ chụp chuyên nghiệp HDR, chân dung Portrait Lighting, Panorama, TrueDepth 12MP hỗ trợ lấy nét tự động (AF) và ổn định hình ảnh.
                Cấu hình máy thuộc hàng đầu thị trường, phù hợp cho cả nhu cầu công việc lẫn giải trí.
                </p>
            </section>
    
            <!-- Thông số kỹ thuật -->
            <div class="spec-card">
                    <div class="spec-title">Thông số kỹ thuật</div>
    
                    <!-- Màn hình -->
                    <div class="section">
                        <h3>Màn hình</h3>
    
                        <div class="row">
                            <div class="label">Công nghệ màn hình</div>
                            <div class="value">Super AMOLED</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Độ phân giải</div>
                            <div class="value">1.5K (1280 × 2772 pixels)</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Màn hình rộng</div>
                            <div class="value">6.83" - tần số quét 120Hz</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Độ sáng tối đa</div>
                            <div class="value">3200 nits</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Mặt kính cảm ứng</div>
                            <div class="value">Kính cường lực Corning Gorilla Glass 7i</div>
                        </div>
                    </div>
    
                    <!-- Camera sau -->
                    <div class="section">
                        <h3>Camera sau</h3>
    
                        <div class="row">
                            <div class="label">Độ phân giải</div>
                            <div class="value">Chính 50MP + Phụ 50MP, 12MP</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Quay phim</div>
                            <div class="value">FullHD 1080p@120fps, 4K 2160p@60fps</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Đèn flash</div>
                            <div class="value">Có</div>
                        </div>
    
                        <div class="full">
                            <strong>Tính năng:</strong>
                            Xóa phông, Tự động lấy nét (AF), Time Lapse, Slow Motion, HDR, Góc siêu rộng, AI Camera
                        </div>
                    </div>
    
                    <!-- Camera trước -->
                    <div class="section">
                        <h3>Camera trước</h3>
    
                        <div class="row">
                            <div class="label">Độ phân giải</div>
                            <div class="value">32MP</div>
                        </div>
    
                        <div class="full">
                            <strong>Tính năng:</strong> Xóa phông, Làm đẹp, Bộ lọc màu
                        </div>
                    </div>
    
                    <!-- CPU -->
                    <div class="section">
                        <h3>Hệ điều hành & CPU</h3>
    
                        <div class="row">
                            <div class="label">Hệ điều hành</div>
                            <div class="value">iOS 18</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Chip xử lý (CPU)</div>
                            <div class="value">Chip A19 Pro (modem C1X), N1</div>
                        </div>
    
                        <div class="row">
                            <div class="label">Chip đồ họa (GPU)</div>
                            <div class="value">GPU 5 lõi với Neural Accelerator</div>
                        </div>
                    </div>
    
                </div>
    
            </div>
        </section>
            <!-- Đánh giá người dùng -->
           <!-- Đánh giá người dùng -->
<section class="user-reviews" aria-label="Đánh giá của người dùng">
    <h2>Đánh giá của người dùng về <?= $product['name'] ?></h2>
    

    <div class="rating-summary" aria-label="Tổng điểm đánh giá">
        <div class="rating-left">
            <span class="rating-left__number">4.9/5</span>
            <div class="rating-left__star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <p class="rating-left__desc">348 lượt đánh giá</p>
            <button class="rating-summary__btn">Viết đánh giá</button>
            <!-- <form action="index.php?action=add_review" method="POST" class="filter-rating" aria-label="Lọc đánh giá theo số sao">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                <label><input type="radio" name="filter" value="all" checked /> Tất cả</label>
                <label><input type="radio" name="filter" value="5" /> 5 sao</label>
                <label><input type="radio" name="filter" value="4" /> 4 sao</label>
                <label><input type="radio" name="filter" value="3" /> 3 sao</label>
                <label><input type="radio" name="filter" value="2" /> 2 sao</label>
                <label><input type="radio" name="filter" value="1" /> 1 sao</label>

                <br><br>

                <label>Đánh giá của bạn:</label>
                <select name="rating" required>
                    <option value="5">5 sao</option>
                    <option value="4">4 sao</option>
                    <option value="3">3 sao</option>
                    <option value="2">2 sao</option>
                    <option value="1">1 sao</option>
                </select>

                <textarea name="comment" placeholder="Nhập đánh giá..." required></textarea>

                <button type="submit">Gửi đánh giá</button>
            </form> -->
        </div>
        <div class="rating-right">
            <!-- item 1 -->
            <div class="rating-alone">
                5<i class="fa-solid fa-star"></i>
                <div class="rating-alone__border"></div>
                <span class="rating-alone__desc">312 đánh giá</span>
            </div>
            <!-- item 1 -->
            <div class="rating-alone">
                4<i class="fa-solid fa-star"></i>
                <div class="rating-alone__border"></div>
                <span class="rating-alone__desc">312 đánh giá</span>
            </div>
            <!-- item 1 -->
            <div class="rating-alone">
                3<i class="fa-solid fa-star"></i>
                <div class="rating-alone__border"></div>
                <span class="rating-alone__desc">312 đánh giá</span>
            </div>
        </div>

        <form action="index.php?action=add_review" method="POST" class="popup-rating" style="display: none;">
            <div class="popup-top">
                <h2 class="popup-top__desc">Đánh giá & nhận xét</h2>
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="popup-mid">
                <img src="" alt="anh san pham" class="popup-mid__image">
                <h3 class="popup-mid__title">Điện thoại iPhone 16 Pro Max 256GB</h3>
            </div>
            <div class="rating-star-include-popup-mid-2">
                <label class="rating-star-include-popup-mid-2__star">
                    <input type="radio" name="rating" value="1" required>
                    <i class="fa-solid fa-star"></i>
                    <p class="rating-star-include-popup-mid-2__desc">Rất tệ</p>
                </label>
                <label class="rating-star-include-popup-mid-2__star">
                    <input type="radio" name="rating" value="2">
                    <i class="fa-solid fa-star"></i>
                    <p class="rating-star-include-popup-mid-2__desc">Tệ</p>
                </label>
                <label class="rating-star-include-popup-mid-2__star">
                    <input type="radio" name="rating" value="3">
                    <i class="fa-solid fa-star"></i>
                    <p class="rating-star-include-popup-mid-2__desc">Bình thường</p>
                </label>
                <label class="rating-star-include-popup-mid-2__star">
                    <input type="radio" name="rating" value="4">
                    <i class="fa-solid fa-star"></i>
                    <p class="rating-star-include-popup-mid-2__desc">Tốt</p>
                </label>
                <label class="rating-star-include-popup-mid-2__star">
                    <input type="radio" name="rating" value="5">
                    <i class="fa-solid fa-star"></i>
                    <p class="rating-star-include-popup-mid-2__desc">Rất tốt</p>
                </label>
            </div>

            <!-- Trường ẩn để gửi product_id -->
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

            <textarea name="comment" placeholder="Nhập đánh giá..." required></textarea>
            <button type="submit" class="rating-summary__btn">Viết đánh giá</button>
        </form>






       
    </div>
 
   

    <!-- Form gửi đánh giá -->
    <!-- <form action="index.php?action=add_review" method="POST" class="filter-rating" aria-label="Lọc đánh giá theo số sao">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

        <label><input type="radio" name="filter" value="all" checked /> Tất cả</label>
        <label><input type="radio" name="filter" value="5" /> 5 sao</label>
        <label><input type="radio" name="filter" value="4" /> 4 sao</label>
        <label><input type="radio" name="filter" value="3" /> 3 sao</label>
        <label><input type="radio" name="filter" value="2" /> 2 sao</label>
        <label><input type="radio" name="filter" value="1" /> 1 sao</label>

        <br><br>

        <label>Đánh giá của bạn:</label>
        <select name="rating" required>
            <option value="5">5 sao</option>
            <option value="4">4 sao</option>
            <option value="3">3 sao</option>
            <option value="2">2 sao</option>
            <option value="1">1 sao</option>
        </select>

        <textarea name="comment" placeholder="Nhập đánh giá..." required></textarea>

        <button type="submit">Gửi đánh giá</button>
    </form> -->

    <div class="review-list">

        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $r): ?>
                <article class="review" tabindex="0" aria-label="Đánh giá người dùng">
                    <div class="review-header">Người dùng #<?= $r['name'] ?></div>

                    <div class="review-stars" aria-hidden="true">
                        <?= str_repeat("★", $r['rating']) ?>
                    </div>
                    <div class="review-text"><?= htmlspecialchars($r['comment']) ?></div>
                    <button class="reply-link">Phản hồi</button>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Chưa có đánh giá nào.</p>
        <?php endif; ?>

    </div>
</section>


        <!-- BÌNH LUẬN SẢN PHẨM (GIỮ NGUYÊN 100%) -->
        <!-- <section class="comment-section" aria-label="Bình luận về sản phẩm">
            <h3 class="comment-title">Bình luận</h3>

            <form class="comment-form" aria-label="Form gửi bình luận">
                <div class="comment-textarea">
                    <textarea placeholder="Nhập bình luận" aria-label="Nhập bình luận"></textarea>
                </div>
                <div class="comment-inputs">
                    <input type="text" placeholder="Nhập họ tên" aria-label="Nhập họ tên" />
                    <input type="tel" placeholder="Nhập số điện thoại" aria-label="Nhập số điện thoại" />
                    <button type="submit" class="btn-comment" aria-label="Gửi bình luận">Bình luận</button>
                </div>
            </form>

            <ul class="comment-list" role="list">
                <li class="comment-item">
                    <div class="comment-header">
                        <div class="comment-avatar" aria-hidden="true"></div>
                        <div class="comment-author">Nguyễn Văn A</div>
                        <div class="comment-date">07/07/2025 12:04:13</div>
                    </div>
                    <div class="comment-content">Máy mình 13prm 128 thì bù bao nhiêu vậy Shop</div>
                    <div class="comment-reply">
                        <button class="reply-button" type="button" aria-label="Phản hồi bình luận của Nguyễn Văn A">
                            <svg class="reply-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                                <path d="M9 10l-4 4 4 4" />
                                <path d="M5 14h12a4 4 0 0 0 0-8H9" />
                            </svg>
                            Phản hồi
                        </button>
                    </div>
                </li>

                <li class="comment-item">
                    <div class="comment-header">
                        <div class="comment-avatar" aria-hidden="true"></div>
                        <div class="comment-author">Nguyễn Văn A</div>
                        <div class="comment-date">07/07/2025 12:04:13</div>
                    </div>
                    <div class="comment-content">Máy mình 13prm 128 thì bù bao nhiêu vậy Shop</div>
                    <div class="comment-reply">
                        <button class="reply-button" type="button" aria-label="Phản hồi bình luận của Nguyễn Văn A">
                            <svg class="reply-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                                <path d="M9 10l-4 4 4 4" />
                                <path d="M5 14h12a4 4 0 0 0 0-8H9" />
                            </svg>
                            Phản hồi
                        </button>
                    </div>
                </li>
            </ul>
        </section> -->

       </div>
  </main>