document.addEventListener("DOMContentLoaded", function () {
  // ================== SIDEBAR DROPDOWN ==================
  document.querySelectorAll(".menu-item[data-dropdown]").forEach((item) => {
    item.addEventListener("click", () => {
      const target = document.getElementById(item.dataset.dropdown);
      target.classList.toggle("show");
      document.querySelectorAll(".submenu").forEach((sub) => {
        if (sub !== target) sub.classList.remove("show");
      });
    });
  });

  // ================== USER DROPDOWN ==================
  const userMenu = document.getElementById("userMenu");
  const dropdown = document.getElementById("dropdown");
  if (userMenu && dropdown) {
    userMenu.onclick = () => dropdown.classList.toggle("show");
    window.addEventListener("click", (e) => {
      if (!userMenu.contains(e.target)) dropdown.classList.remove("show");
    });
  }

  // ================== SHOW SECTIONS ==================
  const sections = {
    product: document.getElementById("productSection"),
    category: document.getElementById("categorySection"),
    // customer: document.getElementById("customerSection"),
    order: document.getElementById("orderSection"),
    stats: document.getElementById("statsSection"),
    user: document.getElementById("userSection"), // thêm user
  };

  function showSection(section) {
    Object.values(sections).forEach((s) => (s.style.display = "none"));
    if (sections[section]) sections[section].style.display = "block";
  }

  const sectionButtons = [
    { id: "showProduct", name: "product" },
    { id: "showCategory", name: "category" },
    // { id: "showCustomer", name: "customer" },
    { id: "showOrder", name: "order" },
    { id: "showStats", name: "stats" },
    { id: "showUser", name: "user" }, // thêm user
  ];

  sectionButtons.forEach((btn) => {
    const el = document.getElementById(btn.id);
    if (el) el.onclick = () => showSection(btn.name);
  });

  // ================== CATEGORY MODAL ==================
  const addCategoryBtn = document.getElementById("addCategoryBtn");
  const addCategoryModal = document.getElementById("addCategoryModal");
  const closeCategoryModalBtn = document.querySelector(".close-btn");

  if (addCategoryBtn && addCategoryModal && closeCategoryModalBtn) {
    addCategoryBtn.addEventListener(
      "click",
      () => (addCategoryModal.style.display = "flex")
    );
    closeCategoryModalBtn.addEventListener(
      "click",
      () => (addCategoryModal.style.display = "none")
    );
    window.addEventListener("click", (e) => {
      if (e.target === addCategoryModal)
        addCategoryModal.style.display = "none";
    });
  }

  const editCategoryLinks = document.querySelectorAll(".edit-link");
  const editCategoryModal = document.getElementById("editCategoryModal");
  const closeEditCategoryModal = document.getElementById("closeEditModal");

  editCategoryLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("edit_cat_id").value = this.dataset.id;
      document.getElementById("edit_cat_name").value = this.dataset.name;
      document.getElementById("edit_cat_description").value =
        this.dataset.description;
      if (editCategoryModal) editCategoryModal.style.display = "block";
    });
  });

  if (closeEditCategoryModal) {
    closeEditCategoryModal.addEventListener(
      "click",
      () => (editCategoryModal.style.display = "none")
    );
    window.addEventListener("click", (e) => {
      if (e.target === editCategoryModal)
        editCategoryModal.style.display = "none";
    });
  }

  // ================== PRODUCT MODAL ==================
  const btnAddProduct = document.getElementById("addBtn");
  const modalAddProduct = document.querySelector(".modal-add-product");
  const btnCloseAdd = document.querySelector(".btn-close-add");

  if (btnAddProduct && modalAddProduct && btnCloseAdd) {
    btnAddProduct.addEventListener(
      "click",
      () => (modalAddProduct.style.display = "flex")
    );
    btnCloseAdd.addEventListener(
      "click",
      () => (modalAddProduct.style.display = "none")
    );
    window.addEventListener("click", (e) => {
      if (e.target === modalAddProduct) modalAddProduct.style.display = "none";
    });
  }

  const editProductLinks = document.querySelectorAll(".edit-product-link");
  const editProductModal = document.getElementById("editProductModal");
  const closeEditProductModal = document.getElementById(
    "closeEditProductModal"
  );

  editProductLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("edit_product_id").value = this.dataset.id;
      document.getElementById("edit_product_name").value = this.dataset.name;
      document.getElementById("edit_product_price").value = this.dataset.price;
      document.getElementById("edit_product_description").value =
        this.dataset.description;
      document.getElementById("edit_product_image").value = this.dataset.image;
      document.getElementById("edit_product_brand").value = this.dataset.brand;
      document.getElementById("edit_product_category").value =
        this.dataset.category;
      if (editProductModal) editProductModal.style.display = "block";
    });
  });

  if (closeEditProductModal) {
    closeEditProductModal.addEventListener(
      "click",
      () => (editProductModal.style.display = "none")
    );
    window.addEventListener("click", (e) => {
      if (e.target === editProductModal)
        editProductModal.style.display = "none";
    });
  }

  // ================== VARIANT ==================
  const addVariantBtn = document.getElementById("addVariantBtn");
  const variantContainer = document.getElementById("variantContainer");

  if (addVariantBtn && variantContainer) {
    addVariantBtn.addEventListener("click", () => {
      const div = document.createElement("div");
      div.className = "variant-item";
      div.innerHTML = `
        <input type="text" name="variant_color[]" placeholder="Màu sắc">
        <input type="text" name="variant_option[]" placeholder="Tùy chọn (VD: 128GB)">
        <input type="number" name="variant_quantity[]" placeholder="Số lượng">
        <button type="button" class="removeVariantBtn">Xóa</button>
      `;
      variantContainer.appendChild(div);

      div
        .querySelector(".removeVariantBtn")
        .addEventListener("click", () => div.remove());
    });
  }

  // ================== USER MODAL ==================
  const addUserBtn = document.getElementById("addUserBtn");
  const modalAddUser = document.querySelector(".modal-add-user");
  const btnCloseAddUser = document.querySelector(".btn-close-add-user");

  if (addUserBtn && modalAddUser && btnCloseAddUser) {
    addUserBtn.addEventListener("click", () => {
      modalAddUser.style.display = "flex";
    });
    btnCloseAddUser.addEventListener("click", () => {
      modalAddUser.style.display = "none";
    });
    window.addEventListener("click", (e) => {
      if (e.target === modalAddUser) modalAddUser.style.display = "none";
    });
  }
});

const addUserBtn = document.getElementById("addUserBtn");
const addUserModal = document.getElementById("addUserModal");
const closeAddUser = document.getElementById("closeAddUser");

if (addUserBtn && addUserModal && closeAddUser) {
  addUserBtn.addEventListener(
    "click",
    () => (addUserModal.style.display = "flex")
  );
  closeAddUser.addEventListener(
    "click",
    () => (addUserModal.style.display = "none")
  );
  window.addEventListener("click", (e) => {
    if (e.target === addUserModal) addUserModal.style.display = "none";
  });
}

// Sửa user
const editUserLinks = document.querySelectorAll(".edit-user-link");
const editUserModal = document.getElementById("editUserModal");
const closeEditUser = document.getElementById("closeEditUser");

editUserLinks.forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("edit_user_id").value = this.dataset.id;
    document.getElementById("edit_user_name").value = this.dataset.name;
    document.getElementById("edit_user_phone").value = this.dataset.phone;
    document.getElementById("edit_user_address").value = this.dataset.address;
    document.getElementById("edit_user_role").value = this.dataset.role;
    document.getElementById("edit_user_payment").value =
      this.dataset.payment_id ?? "";
    editUserModal.style.display = "flex";
  });
});

if (closeEditUser) {
  closeEditUser.addEventListener(
    "click",
    () => (editUserModal.style.display = "none")
  );
  window.addEventListener("click", (e) => {
    if (e.target === editUserModal) editUserModal.style.display = "none";
  });
}
