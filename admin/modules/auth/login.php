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
        
            // Nếu admin active, tiếp tục đăng nhập
            setSession('adminlogin', true);
            setSession('username', $userQuery['admin_username']);
            header('Location: index.php');
            exit();
        
    }
    else {
                // Nếu mật khẩu sai, thông báo lỗi cho người dùng
                setFlashData('msg', 'Incorrect password.');
                setFlashData('msg_type', 'danger');
            }

        }
        else{
            setFlashData('msg', 'User name does not exist.');
            setFlashData('msg_type', 'danger');
        
        }

    }
    else{
        setFlashData('msg', 'Please enter your username and password.');
        setFlashData('msg_type', 'danger');
        redirect('login.php');
    }

}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>