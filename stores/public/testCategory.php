<?php
require_once __DIR__ . '/../app/controllers/CategoryController.php';

// Tạo instance
$categoryController = new CategoryController();

// Thêm danh mục thử
$categoryController->create('Điện thoại');
$categoryController->create('ao thun');
?>