<?php

require_once '../lib/database.php';

require_once '../lib/session.php';
// Gọi hàm checkLogin để kiểm tra trạng thái đăng nhập
checkLogin();

require_once '../helpers/format.php';

?>

<?php

if(isPost()){
    $filterAll = filter();
    if(!empty(trim($filterAll['username'])) && !empty(trim($filterAll['password']))){
        // check login
        // lấy ra username và pw ng dùng nhập vào
        $username = $filterAll['username'];
        $password = $filterAll['password'];

        // truy vấn thông tin users theo username
        $userQuery = oneRow("SELECT admin_password FROM admins WHERE admin_username = '$username'");

        if(!empty($userQuery)){
            $passwordHash = $userQuery['admin_password'];

        if (password_verify($password, $passwordHash)) {
        if (authenticate_admin($username)) {
            // Nếu admin active, tiếp tục đăng nhập
            setSession('adminlogin', true);
            setSession('username', $userQuery['admin_username']);
            header('Location: index.php');
            exit();
        } else {
            // Nếu admin không active, chuyển hướng về trang đăng nhập
            setFlashData('msg', "Tài khoản của bạn không được phép truy cập.");
            setFlashData('msg_type', 'danger');
            header("Location: login.php");
            exit();
        }
    }
    else {
                // Nếu mật khẩu sai, thông báo lỗi cho người dùng
                setFlashData('msg', 'Mật khẩu không chính xác.');
                setFlashData('msg_type', 'danger');
            }

        }
        else{
            setFlashData('msg', 'User name không tồn tại.');
            setFlashData('msg_type', 'danger');
        
        }
        //redirect('login.php');
        // echo '<pre>';
        // print_r($userQuery);
        // echo '</pre>';
    }
    else{
        setFlashData('msg', 'Nhập lại username và mật khẩu.');
        setFlashData('msg_type', 'danger');
        redirect('login.php');
    }



}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>