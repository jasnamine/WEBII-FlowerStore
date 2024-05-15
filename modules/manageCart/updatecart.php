<?php

// Kiểm tra xem có dữ liệu được gửi từ form POST hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem session 'username' đã tồn tại chưa và có giá trị không
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $username = getSession('username');

        // Lấy thông tin giỏ hàng của khách hàng
        $cart = getCart($username);

        // Kiểm tra xem khách hàng có giỏ hàng không
        if ($cart) {
            // Lấy ID của giỏ hàng để truy vấn chi tiết món hàng
            $orderID = $cart['order_ID'];

            // Lấy chi tiết món hàng trong giỏ hàng
            $cartItems = getCartItems($orderID);

            // Kiểm tra xem có món hàng trong giỏ hàng không
            if ($cartItems) {
                foreach ($cartItems as $item) {
                    $od_ID = $item['od_ID'];
                    $quantity = $_POST['quantity'][$od_ID]; // Lấy số lượng từ form POST

                    // Cập nhật số lượng cho sản phẩm trong giỏ hàng
                    updateCartItemQuantity($od_ID, $quantity);
                }
            }

            // Lấy giá trị tổng số tiền từ trường input ẩn
            $totalPrice = $_POST['total-price'];
            // Cập nhật tổng số tiền trong giỏ hàng
            updateCartTotalPrice($orderID, $totalPrice); 

        }
    }
    else {
        header("Location: login.php");
        ob_end_flush();
        exit;
    }

    // Chuyển hướng người dùng đến trang checkout.php
    header("Location: checkout.php");
    ob_end_flush();
    exit; // Đảm bảo không có mã PHP nào được thực thi sau khi chuyển hướng
}
else {
    // Nếu không có dữ liệu POST, chuyển hướng người dùng đến trang cart.php
    // exit;
}

?>
