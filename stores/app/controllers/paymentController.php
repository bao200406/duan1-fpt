<?php
class paymentController {
    public function index() {
        // Load header
        require __DIR__ . '/../views/layouts/header.php';
        // Load main content
        require __DIR__ . '/../views/payment/payment.php';
        // Load footer
        require __DIR__ . '/../views/layouts/footer.php';
    }
}
?>
