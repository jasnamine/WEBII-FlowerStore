<?php
ob_start();
require_once('lib/database.php');
require_once('helpers/format.php');
require_once('lib/session.php');
?>

<?php
// // Kiểm tra xem có thông báo lỗi trong session không
// if (isset($_SESSION['error'])) {
//     // Hiển thị thông báo lỗi
//     echo 'alert (' . $_SESSION['error'] . ');';
//     // Xóa thông báo lỗi khỏi session để nó không được hiển thị nữa
//     unset($_SESSION['error']);
// }
?>


<?php
// Kiểm tra xem người dùng đã gửi dữ liệu form chưa
if (isPost()) {
    // Lấy thông tin đăng nhập từ form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // // Mã hóa mật khẩu trước khi so sánh với dữ liệu trong cơ sở dữ liệu
    $hashed_password = md5($password);

    // Thực hiện truy vấn để kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM customers WHERE customer_username = '$username' AND customer_password = '$hashed_password' " ;
    $data = array(
        'customer_username' => $username,
        'customer_password' => $hashed_password,
    );
        // echo $username . ' ' . $password;


    $user = oneRow($sql, $data);
    
    if ($user){
        if (authenticate_customer($username))
        {
            // Đăng nhập thành công, đặt phiên cho người dùng và chuyển hướng đến trang chính
            // echo "Logined successfully!";
            setSession('username', $username);
            header("Location: index.php"); // Chuyển hướng đến trang chính
            ob_end_flush();
            exit();
        } 
        else {
            // Tài khoản người dùng bị khóa, chuyển hướng đến trang đăng nhập lại với thông báo lỗi
            header("Location: login.php?error_active=1");
            ob_end_flush();
            exit();
        }
    } 
    else {
        // Đăng nhập không thành công, chuyển hướng người dùng đến trang đăng nhập lại với thông báo lỗi
        header("Location: login.php?error_login=1");
        ob_end_flush();
        exit();
    }
} 

?>
