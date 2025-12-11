<?php
class Cart {

    // Lấy giỏ hàng hiện tại
    public static function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    // Thêm sản phẩm hoặc cập nhật số lượng
    public static function addItem($productId, $variantId, $name, $price, $image, $color, $options, $quantity = 1) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $key = $productId . '_' . $variantId;

        if(isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$key] = [
                'product_id' => $productId,
                'variant_id' => $variantId,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'color' => $color,
                'options' => $options,
                'quantity' => $quantity
            ];
        }
    }

    // Cập nhật số lượng sản phẩm
    public static function updateQuantity($key, $quantity) {
        if($quantity < 1) $quantity = 1;
        if(isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] = $quantity;
        }
    }

    // Xóa một sản phẩm
    public static function deleteItem($key) {
        if(isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
    }

    // Xóa toàn bộ giỏ hàng
    public static function clearCart() {
        unset($_SESSION['cart']);
    }

}
