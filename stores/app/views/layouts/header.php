


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- reset css -->
    <link rel="stylesheet" href="/duan1-fpt/stores/public/css/reset.css" />
    <!-- style css -->
    <link rel="stylesheet" href="/duan1-fpt/stores/public/css/style.css" />
    <link rel="stylesheet" href="/duan1-fpt/stores/public/css/detail.css" />
    <link rel="stylesheet" href="/duan1-fpt/stores/public/css/payment.css" />
    <link rel="stylesheet" href="/duan1-fpt/stores/public/css/history.css" />
    <!-- font style -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
    <!-- font awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body style="height: 10000px">
    <header class="header">
      <div class="header-all">
        <div class="container">
          <div class="header-top">
            <figure>
              <img src="./images/logo.png" alt="" class="header-top__logo" />
            </figure>
            <!-- category -->
            <div class="categories-header">
              <i class="fa-solid fa-bars"></i>
              <span class="categories__span">Danh mục</span>
            </div>
            <!-- search -->
            <div class="search-input">
              <i class="fa-solid fa-magnifying-glass search-input__icon"></i>
              <input type="text" name="" id="" class="search-input__input" />
            </div>

            <!-- box thong tin gio hang -->
            <div class="location">
              <i class="fa-solid fa-location-dot"></i>
              <p class="location__desc">Hệ thống <br />showroom</p>
            </div>
            <a href="?action=cart">
              <div class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <p class="cart__desc">Giỏ hàng</p>
              </div>
            </a>
            <a href="?action=history">
              <div class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <p class="cart__desc">lịch sử đơn hàng</p>
              </div>
            </a>
            <a href="?action=login">
              <div class="user">
                <i class="fa-solid fa-user"></i>
                <p class="user__desc">Thông tin</p>
              </div>
            </a>
          </div>
        </div>
        <div class="background-nav">
          <div class="header-bottom">
            <nav class="nav">
              <ul>
                <li class="lists">
                  <a href="?action=home" class="lists__link">Trang chủ</a>
                  <a href="" class="lists__link">Giới thiệu</a>
                  <a href="?action=product" class="lists__link">Sản phẩm</a>
                  <a href="?action=ProductDetailController" class="lists__link">Tin tức</a>
                  <a href="" class="lists__link">Liên hệ</a>
                  <a href="" class="lists__link">Đặt trước</a>
                  <a href="" class="lists__link">Tra cứu bảo hành</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>