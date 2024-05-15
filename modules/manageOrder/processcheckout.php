<?php
ob_start();
require_once('lib/database.php');
require_once('helpers/format.php');
require_once('lib/session.php');
?>

<?php
// Kiểm tra xem người dùng đã gửi dữ liệu form chưa
if (isPost()) {
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        // Lấy thông tin người dùng từ session
        $username = getSession('username');
        
        // Lấy thông tin giỏ hàng của khách hàng
        $cart = getCart($username);


        // Lấy dữ liệu từ POST
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $paymentMethod = $_POST['optradio'];
        $date = date('Y-m-d');
        $orderStatus = 1;
        
        // Kiểm tra giỏ hàng có tồn tại không
        if (!empty($cart)) {
            // Cập nhật thông tin địa chỉ và phương thức thanh toán vào bảng orders
            $orderID = $cart['order_ID'];
            $updateOrderData = [
                'order_receiver' => $fullname,
                'order_phone' => $phone,
                'order_email' => $email,
                'order_address' => $address,
                'order_city' => $city,
                'order_district' => $district,
                'order_payment_method' => $paymentMethod,
                'order_status' => $orderStatus,
                'order_date' => $date
            ];
            $updateOrderCondition = "order_ID = '$orderID'";
            // Thực hiện cập nhật
            update('orders', $updateOrderData, $updateOrderCondition);

            // Redirect hoặc thực hiện bất kỳ hành động nào tiếp theo ở đây, ví dụ như hiển thị thông báo thành công
            // header('Location: success.php');
            // exit;
            // echo $paymentMethod;
            // echo '<br>';
            echo "Checkout thành công!";
            header("Location:order_detail.php?order_ID=$orderID");
        } else {
            // Xử lý khi giỏ hàng trống
            echo "Giỏ hàng trống!";
        }

    }
}
?>