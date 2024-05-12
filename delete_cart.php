<?php
session_start();
ob_start();

require_once './lib/database.php'; // Import thư viện kết nối CSDL

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra xem order_ID có được gửi lên không
if (isset($_REQUEST['order_ID']) && isset($_REQUEST['od_ID'])) {
    $order_ID = $_GET['order_ID'];
    $od_ID = $_GET['od_ID'];

    // Xóa sản phẩm khỏi bảng order_details
    $condition = 'order_ID=' . $order_ID . " AND " . 'od_ID=' . $od_ID;
    $result = delete('order_details', $condition);

    if ($result) {
        // Chuyển hướng lại đến trang cart sau khi xóa thành công
        header("Location: cart.php?delete_success=1");
        exit();
    } else {
        header("Location: cart.php?delete_error=1");
    }
} else {
    // Nếu order_ID không được gửi lên, chuyển hướng lại đến trang cart
    header("Location: cart.php?no_results=1");
    exit();
}
?>
