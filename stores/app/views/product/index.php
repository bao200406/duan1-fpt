<main class="main">
      <div class="container">
        <div class="content">
          <!-- Thanh Breadcrumb -->
          <div class="header-bar">
            <div class="breadcrumb">
              <i class="fa-solid fa-house"></i>
              <a href="#" class="breadcrumb-item">Trang chủ</a> /
              <a href="#" class="breadcrumb-item">điện thoại</a> /
              <span>Iphone</span>
            </div>
          </div>
          <div class="banner">
            <img class="banner__logo" src="/duan1-fpt/stores/public/images/2.png" alt="" />
            <img class="banner__logo" src="/duan1-fpt/stores/public/images/1.png" alt="" />
          </div>
          <div class="sub-nav">
            <h1 class="main-title">Iphone</h1>
            <div class="series-list">
              <a href="#" class="series-button">Iphone 17 series</a>
              <a href="#" class="series-button">Iphone air</a>
              <a href="#" class="series-button">Iphone 16 series</a>
              <a href="#" class="series-button">Iphone 15 series</a>
              <a href="#" class="series-button">Iphone 14 series</a>
              <a href="#" class="series-button">Iphone 13 series</a>
              <a href="#" class="series-button">Iphone 12 series</a>
              <a href="#" class="series-button">Iphone 11 series</a>
            </div>
            <h1 class="main-title">Chọn theo tiêu chí</h1>
          </div>
          <div class="filter-sort-bar">
            <div class="filter-button">
              <span class="filter-icon">Bộ lọc</span>
            </div>
            <div class="filter-sapxep">
              <span class="sort-label">Xếp theo:</span>
              <a href="#" class="sort-option">A - Z</a>
              <a href="#" class="sort-option">Z - A</a>
              <a href="#" class="sort-option active">Giá cao đến thấp</a>
              <a href="#" class="sort-option">Giá thấp đến cao</a>
            </div>
          </div>
        </div>
        <div class="main-products">
            <?php foreach($products as $product): ?>
                <!-- item 1 -->
                <div class="here-product">
                  <div class="giamgiatragop">
                    <p class="giamgiatragop__tragop">Trả góp 0%</p>
                    <div class="phangiamgia">
                      <!-- icon -->
                      <i class="fa-solid fa-arrow-down"></i>
                      <p class="phangiamgia__desc">12%</p>
                    </div>
                  </div>
                  <!-- hinh anh san pham -->
                  <figure>
                    <img
                      src="/duan1-fpt/stores/public/images/<?= htmlspecialchars($product['image']) ?>"
                      alt="<?= htmlspecialchars($product['name']) ?>"
                      class="here-product__img"
                    />
                  </figure>
                  <div class="information">
                    <p class="information__desc"><?= htmlspecialchars($product['name']) ?> | Chính <br />hãng</p>
                    <p class="information__desc">
                      <?= number_format($product['price'], 0, ',', '.') ?>đ
                      <span class="information__span">31.990.000đ</span> <!-- giữ nguyên giá cũ bên cạnh nếu muốn -->
                    </p>
                    <p class="information__giamgia">SGmember giảm đến 300.000đ</p>
                    <p class="information__tragop">
                      Trả góp 0% - 0đ phụ thu - kỳ <br />hạn đến 12 tháng
                    </p>
                  <a href="index.php?action=ProductDetailController&id=<?= $product['id'] ?>">Xem chi tiết</a>

                    <div class="yeuthichdanhgia">
                      <div class="yeuthichdanhgia__star">
                        <i class="fa-solid fa-star"></i>
                        <p class="yeuthichdanhgia__desc">5</p>
                      </div>
                      <!-- like -->
                      <div class="yeuthichdanhgia__like">
                        <i class="fa-regular fa-heart"></i>
                        <p class="yeuthichdanhgia__desc">yêu thích</p>
                      </div>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>

        </div>

        
      </div>
    </main>