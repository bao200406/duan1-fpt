<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Quản lý sản phẩm & danh mục</title>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/duan1-fpt/stores/public/css/admin.css" />
  </head>
  
  <body>
    <!-- SIDEBAR -->
    <div class="sidebar">
      <h2>🛍️ Admin Panel</h2>
      <div class="menu-item active">
        <i class="ri-dashboard-line"></i> Dashboard
      </div>

      <div class="menu-item" data-dropdown="spMenu">
        <span><i class="ri-shopping-bag-line"></i> Sản phẩm</span
        ><i class="ri-arrow-down-s-line"></i>
      </div>
      <div class="submenu" id="spMenu">
        <a href="#" id="showProduct">Danh sách sản phẩm</a>
        <a href="#" id="addProductMenu">Thêm sản phẩm</a>
      </div>

      <div class="menu-item" data-dropdown="dmMenu">
        <span><i class="ri-price-tag-3-line"></i> Danh mục</span
        ><i class="ri-arrow-down-s-line"></i>
      </div>
      <div class="submenu" id="dmMenu">
        <a href="#" id="showCategory">Danh sách danh mục</a>
        <a href="#" id="addCategoryMenu">Thêm danh mục</a>
      </div>


      

       
      

      <!-- ✅ THÊM 3 MỤC MỚI -->
      <div class="menu-item" id="showUser">
        <i class="ri-user-line"></i> Quản lí users
      </div>
      

      <div class="menu-item" id="showOrder">
        <i class="ri-file-list-3-line"></i> Đơn hàng
      </div>

      <div class="menu-item" id="showStats">
        <i class="ri-bar-chart-2-line"></i> Thống kê
      </div>
      <!-- ✅ HẾT PHẦN THÊM -->
    </div>



