<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

// Lấy dữ liệu từ form
$filterAll = filter();

// Kiểm tra xem có ID đơn hàng và trạng thái mới được truyền không
if (!empty($filterAll['id']) && !empty($filterAll['status'])) {
    $orderID = $filterAll['id'];
    $newStatus = $filterAll['status'];

    // Kiểm tra xem ID đơn hàng có tồn tại trong bảng orders không
    $orderExists = countRows("SELECT * FROM orders WHERE order_ID = '$orderID'");
    if ($orderExists > 0) {
        // Lấy trạng thái đơn hàng hiện tại từ cơ sở dữ liệu
        $order = oneRow("SELECT o.order_status FROM orders o WHERE o.order_ID = '$orderID'");

        // Cập nhật trạng thái đơn hàng và trạng thái sản phẩm theo giá trị mới
        if ($order) {
            // Cập nhật trạng thái đơn hàng
            $dataUpdate = ['order_status' => $newStatus];
            $updateStatus = update('orders', $dataUpdate, "order_ID = '$orderID'");

            if ($updateStatus) {
                // Kiểm tra và cập nhật trạng thái sản phẩm nếu có tham số prd_status
                if (isset($filterAll['prd_status']) && $filterAll['prd_status'] == 3) {
                    // Lấy tất cả sản phẩm liên quan đến đơn hàng
                    $products = getRow("SELECT prd_ID FROM order_details WHERE order_ID = '$orderID'");

                    $allUpdated = true;
                    foreach ($products as $product) {
                        $prdID = $product['prd_ID'];
                        $updatePrdStatus = update('products', ['prd_status' => 3], "prd_ID = '$prdID'");
                        if (!$updatePrdStatus) {
                            $allUpdated = false;
                        }
                    }

                    if ($allUpdated) {
                        setFlashData('msg', 'Order and product status update successful');
                    } else {
                        setFlashData('msg', 'Order update successful, but some product status updates failed');
                        setFlashData('msg_type', 'warning');
                    }
                } else {
                    setFlashData('msg', 'Order update successful');
                }
            } else {
                setFlashData('msg', 'Order update error');
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