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

        // Lấy dữ liệu từ POST
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $district = $_POST['district'];

        // Thực hiện cập nhật thông tin trong cơ sở dữ liệu
        $dataToUpdate = [
            'customer_fullname' => $fullname,
            'customer_phone' => $phone,
            'customer_email' => $email,
            'customer_address' => $address,
            'customer_city' => $city,
            'customer_district' => $district,
        ];
        $condition = "customer_username = '$username'";
        $success = update('customers', $dataToUpdate, $condition);

        if ($success) {
            header('Location: myaccount.php?update_success=1');
            // echo "Update successful!";
            ob_end_flush();
            // Có thể gửi kết quả về máy khách nếu cần thiết
        } else {
            header('Location: myaccount.php?update_error=1');
            // echo "Update failed!";
            ob_end_flush();
            // Xử lý lỗi nếu cần thiết
        }
    }
}
?>

<?php

?>
