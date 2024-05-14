<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

// Lấy dữ liệu từ form
$filterAll = filter();

// Kiểm tra xem có ID đơn hàng được truyền không
if (!empty($filterAll['id']) && !empty($filterAll['status'])) {
    $orderID = $filterAll['id'];
    $newStatus = $filterAll['status'];

    // Kiểm tra xem ID đơn hàng có tồn tại trong bảng orders không
    $orderExists = countRows("SELECT * FROM orders WHERE order_ID = '$orderID'");
    if ($orderExists > 0) {
        // Lấy trạng thái đơn hàng hiện tại từ cơ sở dữ liệu
        $order = oneRow("SELECT order_status FROM orders WHERE order_ID = '$orderID'");

        // Cập nhật trạng thái đơn hàng theo giá trị mới
        if($order) {
            // Chuẩn bị dữ liệu cập nhật
            $dataUpdate = ['order_status' => $newStatus];
            $updateStatus = update('orders', $dataUpdate, "order_ID = '$orderID'");

            if ($updateStatus) {
                setFlashData('msg', 'Update successful');
            } else {
                setFlashData('msg', 'Update error');
                setFlashData('msg_type', 'danger');
            }
            redirect("order.php");
        }
    } else {
        // ID đơn hàng không tồn tại trong cơ sở dữ liệu
        setFlashData('msg', 'Order not found');
        setFlashData('msg_type', 'danger');
        redirect("order.php");
    }
} else {
    // ID đơn hàng hoặc trạng thái mới không được truyền
    setFlashData('msg', 'Order ID or new status not provided');
    setFlashData('msg_type', 'danger');
    redirect("order.php");
}

// Lấy thông báo từ session (nếu có)
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>