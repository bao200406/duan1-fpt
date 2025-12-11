    <!-- MAIN -->
    <div class="main">
      <header>
        <h1>Trang quản trị</h1>
        <div class="user" id="userMenu">
          <img src="https://i.pravatar.cc/100" alt="" />
          <span>Admin <i class="ri-arrow-down-s-line"></i></span>
        </div>
        <div class="dropdown-menu" id="dropdown">
          <a href="#"><i class="ri-user-line"></i> Hồ sơ</a>
          <a href="#"><i class="ri-settings-3-line"></i> Cài đặt</a>
          <a href="#"><i class="ri-logout-circle-line"></i> Đăng xuất</a>
        </div>
      </header>

      <section class="dashboard">
        <!-- KHU VỰC SẢN PHẨM -->
        <div class="table-container" id="productSection">
          <div class="table-header">
            <h2>Danh sách sản phẩm</h2>
            <div>
              <input
                type="text"
                id="searchProduct"
                placeholder="Tìm sản phẩm..."
              />
              <button id="addBtn">+ Thêm sản phẩm</button>
            </div>
          </div>
          <table>
            <thead>
              <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Giá</th>
              <th>Mô tả</th>
              <th>Hình</th>
              <th>Thương hiệu</th>
              <th>Danh mục</th>
              <th>Hành động</th>
              </tr>
            </thead>
            <tbody id="productTable">
                    <?php if (!empty($products) && is_array($products)): ?>
                    <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= number_format($p['price'],0,',','.') ?>đ</td>
                        <td><?= htmlspecialchars($p['description']) ?></td>
                        <td>
                            <img src="/duan1-fpt/stores/public/images/<?= htmlspecialchars($p['image']) ?>" 
                                alt="<?= htmlspecialchars($p['name']) ?>" 
                                style="width:50px; height:auto;">
                        </td>
                        <td><?= htmlspecialchars($p['brand']) ?></td>
                        <td><?= $p['category_id'] ?></td>
                        <td>
                            <a href="#" 
                              class="edit-product-link" 
                              data-id="<?= $p['id'] ?>"
                              data-name="<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>"
                              data-price="<?= $p['price'] ?>"
                              data-description="<?= htmlspecialchars($p['description'], ENT_QUOTES) ?>"
                              data-image="<?= htmlspecialchars($p['image'], ENT_QUOTES) ?>"
                              data-brand="<?= htmlspecialchars($p['brand'], ENT_QUOTES) ?>"
                              data-category="<?= $p['category_id'] ?>"
                              style="color:blue;">Sửa</a> 
                            

                            <a href="admin.php?action=deleteProduct&id=<?= $p['id'] ?>" 
                              style="color:red;" 
                              onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8">Chưa có sản phẩm nào</td></tr>
                <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Modal Thêm sản phẩm -->
          <div class="modal-add-product" style="display:none;">
            <div class="modal-content-add">
              <span class="btn-close-add">&times;</span>
              <h3>Thêm sản phẩm</h3>

              <form class="form-add-product" action="/duan1-fpt/stores/public/admin.php?action=addProduct" method="POST">

                <input type="text" name="name" placeholder="Tên sản phẩm" required><br>
                <input type="number" step="0.01" name="price" placeholder="Giá" required><br>
                <textarea name="description" placeholder="Mô tả"></textarea><br>
                <input type="text" name="image" placeholder="Ảnh (URL hoặc tên file)"><br>
                <input type="text" name="brand" placeholder="Thương hiệu"><br>
                <input type="number" name="category_id" placeholder="ID danh mục"><br>

                <hr>

                <h4>Biến thể sản phẩm</h4>
                <div id="variantContainer">

                  <!-- Biến thể mặc định -->
                  <div class="variant-item">
                    <input type="text" name="variant_color[]" placeholder="Màu sắc">
                    <input type="text" name="variant_option[]" placeholder="Tùy chọn (VD: 128GB)">
                    <input type="number" name="variant_quantity[]" placeholder="Số lượng">
                  </div>

                </div>

                <button type="button" id="addVariantBtn">+ Thêm biến thể</button>
                <br><br>

                <button type="submit">Lưu sản phẩm</button>
              </form>
            </div>
          </div>

        <!-- Popup sửa sản phẩm -->
          <div id="editProductModal" style="display:none;">
            <div class="modal-content">
              <span class="close-btn" id="closeEditProductModal">&times;</span>
              <h3>Sửa sản phẩm</h3>
              <form id="editProductForm" action="admin.php?action=updateProduct" method="POST">
                <input type="hidden" name="id" id="edit_product_id">
                <input type="text" name="name" id="edit_product_name" placeholder="Tên sản phẩm" required><br>
                <input type="number" step="0.01" name="price" id="edit_product_price" placeholder="Giá" required><br>
                <textarea name="description" id="edit_product_description" placeholder="Mô tả"></textarea><br>
                <input type="text" name="image" id="edit_product_image" placeholder="Ảnh (URL hoặc tên file)"><br>
                <input type="text" name="brand" id="edit_product_brand" placeholder="Thương hiệu"><br>
                <input type="number" name="category_id" id="edit_product_category" placeholder="ID danh mục"><br>
                <button type="submit">Cập nhật sản phẩm</button>
              </form>
            </div>
          </div>



        
        
        
          <!-- KHU VỰC DANH MỤC -->
          <div class="table-container" id="categorySection" style="display: none">
            <div class="table-header">
              <h2>Danh sách danh mục</h2>
              <div>
                <input
                  type="text"
                  id="searchCategory"
                  placeholder="Tìm danh mục..."
                />
                <button id="addCategoryBtn">+ Thêm danh mục</button>
              
              </div>
            </div>
            
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên danh mục</th>
                  <th>Mô tả</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody id="categoryTable">
                <?php 
                      // Kiểm tra biến $categories trước khi lặp
                      if (!empty($categories) && is_array($categories)):
                          foreach($categories as $cat): 
                      ?>
                        <tr>
                            <td><?= htmlspecialchars($cat['id']) ?></td>
                            <td><?= htmlspecialchars($cat['name']) ?></td>
                            <td><?= htmlspecialchars($cat['description'] ?? '') ?></td>
                            <td>
                                <a href="#" 
                                  class="edit-link" 
                                  data-id="<?= $cat['id'] ?>" 
                                  data-name="<?= htmlspecialchars($cat['name'], ENT_QUOTES) ?>" 
                                  data-description="<?= htmlspecialchars($cat['description'] ?? '', ENT_QUOTES) ?>" 
                                  style="color:yellow;">
                                    Sửa
                                </a>
                                <!-- <a href="admin.php?action=deleteCategory&id=<?= $cat['id'] ?>" style="color:red;" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a> -->
                            </td>
                        </tr>
                      <?php 
                          endforeach; 
                      else: 
                      ?>
                        <tr><td colspan="4">Chưa có danh mục nào</td></tr>
                      <?php endif; ?>
              </tbody>
            </table>
          </div>
           <!-- Popup form thêm danh mục -->
          <div id="addCategoryModal">
            <div class="modal-content">
              <span class="close-btn">&times;</span>
              <h3>Thêm danh mục</h3>
              <form id="addCategoryForm" action="/duan1-fpt/stores/public/admin.php?action=createCategory" method="POST">
                <input type="text" name="name" placeholder="Tên danh mục" required>
                <input type="text" name="description" placeholder="mô tả" required>
                <button type="submit">Lưu</button>
              </form>
            </div>
          </div>
           <!-- Popup form sửa danh mục -->
          <div id="editCategoryModal" style="display:none;">
                  <div class="modal-content">
                      <span class="close-btn" id="closeEditModal">&times;</span>
                      <h3>Sửa danh mục</h3>
                      <form id="editCategoryForm" action="/duan1-fpt/stores/public/admin.php?action=updateCategory" method="POST">
                          <input type="hidden" name="id" id="edit_cat_id">
                          <input type="text" name="name" id="edit_cat_name" placeholder="Tên danh mục" required>
                          <input type="text" name="description" id="edit_cat_description" placeholder="Mô tả" required>
                          <button type="submit">Cập nhật</button>
                      </form>
                  </div>
          </div>

                      

        


       <!-- ✅ KHU VỰC USERS -->
        <div class="table-container" id="userSection" style="display: none">
          <div class="table-header">
            <h2>Danh sách Users</h2>
            <input
              type="text"
              id="searchUser"
              placeholder="Tìm user..."
            />
            <button id="addUserBtn">+ Thêm User</button>
          </div>
          <table id="usersTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody id="userTableBody">
              <?php 
                      // Kiểm tra biến $categories trước khi lặp
                      if (!empty($users) && is_array($users)):
                          foreach($users as $user): 
                      ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td>
                                <a href="#" 
                                  class="edit-link" 
                                  data-id="<?= $user['id'] ?>" 
                                  data-name="<?= htmlspecialchars($user['name'], ENT_QUOTES) ?>" 
                                  data-description="<?= htmlspecialchars($user['description'] ?? '', ENT_QUOTES) ?>" 
                                  style="color:yellow;">
                                    Sửa
                                </a>
                                <!-- <a href="admin.php?action=deleteCategory&id=<?= $cat['id'] ?>" style="color:red;" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a> -->
                            </td>
                        </tr>
                      <?php 
                          endforeach; 
                      else: 
                      ?>
                        <tr><td colspan="4">Chưa có danh mục nào</td></tr>
                      <?php endif; ?>
            </tbody>
          </table>
        </div>


        <!-- Popup form thêm user -->
        <div id="addUserModal" style="display:none; background-color: #fff">
            <div class="modal-content">
                <span class="close-btn" id="closeAddUser">&times;</span>
                <h3>Thêm User</h3>
                <form id="addUserForm" action="/duan1-fpt/stores/public/admin.php?action=addUser" method="POST">
                    <input type="text" name="name" placeholder="Họ tên" required>
                    <input type="password" name="password" placeholder="Mật khẩu" required>
                    <input type="text" name="phone" placeholder="Số điện thoại" required>
                    <input type="text" name="address" placeholder="Địa chỉ" required>
                    <select name="role" required>
                        <option value="">Chọn vai trò</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <input type="text" name="payment_id" placeholder="Payment ID (nếu có)">
                    <button type="submit">Lưu</button>
                </form>
            </div>
        </div>

        <!-- ✅ KHU VỰC ĐƠN HÀNG -->
        <div class="table-container" id="orderSection" style="display: none">
          <div class="table-header">
            <h2>Danh sách đơn hàng</h2>
            <input type="text" id="searchOrder" placeholder="Tìm đơn hàng..." />
          </div>
          <table>
            <thead>
              <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody id="orderTable">
              <?php 
                      // Kiểm tra biến $categories trước khi lặp
                      if (!empty($orders) && is_array($orders)):
                          foreach($orders as $order): 
                      ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= htmlspecialchars($order['order_date'] ?? '') ?></td>
                             <td><?=  number_format($order['total']) ?></td>
                             <td>
                                <?php
                                switch($order['status']){
                                    case 'pending': echo 'Đang xử lý'; break;
                                    case 'completed': echo 'Hoàn thành'; break;
                                    case 'canceled': echo 'Đã hủy'; break;
                                    default: echo $order['status']; break;
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#" 
                                  class="edit-link" 
                                  data-id="<?= $order['id'] ?>" 
                                  data-name="<?= htmlspecialchars($order['users_id'], ENT_QUOTES) ?>" 
                                  style="color:yellow;">
                                    Sửa
                                </a>
                                <!-- <a href="admin.php?action=deleteCategory&id=<?= $order['id'] ?>" style="color:red;" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a> -->
                            </td>
                        </tr>
                      <?php 
                          endforeach; 
                      else: 
                      ?>
                        <tr><td colspan="4">Chưa có danh mục nào</td></tr>
                      <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- ✅ KHU VỰC THỐNG KÊ -->
        <div class="stats-section" id="statsSection" style="display: none">
          <h2>📊 Thống kê tổng hợp</h2>
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-icon">🛒</div>
              <div class="stat-info">
                <h3>Tổng sản phẩm được đặt</h3>
                <p id="totalProducts">0</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">💰</div>
              <div class="stat-info">
                <h3>Doanh thu</h3>
                <p id="totalRevenue">0 VNĐ</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">📦</div>
              <div class="stat-info">
                <h3>Hàng tồn kho</h3>
                <p id="totalStock">0</p>
              </div>
            </div>
          </div>
          <div class="bieudo">
            <!-- Biểu đồ trực quan -->
            <h2>📈 Biểu đồ</h2>
            <canvas id="revenueChart" width="400" height="200"></canvas>
            <!-- <canvas
              id="categoryChart"
              width="400"
              height="200"
              style="margin-top: 20px"
            ></canvas> -->
          </div>
        </div>

        <!-- ✅ HẾT PHẦN THÊM -->
      </section>
    </div>

    <!-- MODAL SẢN PHẨM -->
    <div class="modal" id="modalProduct">
      <div class="modal-content">
        <h3>Thêm sản phẩm</h3>
        <input type="text" id="ten" placeholder="Tên sản phẩm" />
        <input type="number" id="gia" placeholder="Giá (VNĐ)" />
        <input type="file" id="hinh" accept="image/*" />
        <button id="saveBtn">Lưu sản phẩm</button>
      </div>
    </div>

    <!-- MODAL DANH MỤC -->
    <div class="modal" id="modalCategory">
      <div class="modal-content">
        <h3>Thêm danh mục</h3>
        <input type="text" id="tenLoai" placeholder="Tên danh mục" />
        <input type="text" id="mota" placeholder="Mô tả danh mục" />
        <button id="saveCategoryBtn">Lưu danh mục</button>
      </div>
    </div>