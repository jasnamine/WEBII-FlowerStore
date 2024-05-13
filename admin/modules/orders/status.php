<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

// Lấy dữ liệu từ form
$filterAll = filter();

// Kiểm tra xem có ID đơn hàng được truyền không
if (!empty($filterAll['id'])) {
    $orderID = $filterAll['id'];

    // Kiểm tra xem ID đơn hàng có tồn tại trong bảng orders không
    $orderStatus = getRows("SELECT * FROM orders WHERE order_ID = '$orderID'");
    if ($orderStatus > 0) {
        // Lấy trạng thái đơn hàng từ cơ sở dữ liệu
        $order = oneRaw("SELECT order_status FROM orders WHERE order_ID = '$orderID'");

        // Kiểm tra nếu đơn hàng tồn tại và đang ở trạng thái "Pending"
        if($order){
                if ($order && $order['order_status'] == '1') {
            // Cập nhật trạng thái đơn hàng thành "Delivering"
            $dataUpdate = ['order_status' => '2'];
                 }
            $updateStatus = update('orders', $dataUpdate, "order_ID = '$orderID'");

            if ($updateStatus) {
                setFlashData('msg', 'Update successful');
                redirect("order.php");
            } else {
                setFlashData('msg', 'Update error');
                setFlashData('msg_type', 'danger');
                redirect("order.php");
            }
            
        }
        
    } else {
        // ID đơn hàng không tồn tại trong cơ sở dữ liệu
        setFlashData('msg', 'Order not found');
        setFlashData('msg_type', 'danger');
        redirect("order.php");
    }
} else {
    // ID đơn hàng không được truyền
    setFlashData('msg', 'Order ID not provided');
    setFlashData('msg_type', 'danger');
    redirect("order.php");
}

// Lấy thông báo từ session (nếu có)
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>