<?php

// Hàm setSession: Thiết lập giá trị cho session
function setSession($key, $value){
    return $_SESSION[$key] = $value;
}

// Hàm getSession: Lấy giá trị từ session
function getSession($key=''){
    if(empty($key)){
        return $_SESSION;
    }
    else{
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }
}

//Hàm removeSession: Xóa session hoặc key từ session
// function removeSession(){
//     if(empty($key)){
//         session_destroy();
//         return true;
//     }
//     else{
//         if(isset($_SESSION[$key])){
//             unset($_SESSION[$key]);
//             return true;
//         }
//     }
// }

// hàm hủy session
function removeSession($key = '') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($key)) {
        session_destroy();
        return true;
    } else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }
    return false;
}

// Hàm hủy session quay trở lại trang login
function destroySession() {
    session_destroy();
    header('Location: login.php');
}

// Hàm setFlashData: Thiết lập dữ liệu flash vào session
// function setFlashData($key, $value){
//         if (session_status() == PHP_SESSION_NONE) {
//     session_start();}
//     $key = 'flash_' .$key;
//     return setSession($key, $value);
// }

// Hàm getFlashData: Lấy dữ liệu flash từ session và xóa nó sau khi lấy
// function getFlashData($key){
//         if (session_status() == PHP_SESSION_NONE) {
//     session_start();
//         }
//     $key = 'flash_' .$key;
//     $data = getSession($key);
//     removeSession($key);
//     return $data;

// }

// function getFlashData($key){
//     if (session_status() === PHP_SESSION_NONE) {
//         session_start();
//     }
//     $key = 'flash_' . $key;
//     if (isset($_SESSION[$key])) {
//         $value = $_SESSION[$key];
//         unset($_SESSION[$key]);
//         return $value;
//     }
//     return null;
// }


// function setFlashData($key, $value) {
//     if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
//     $_SESSION[$key] = $value;
// }

// function getFlashData($key) {
//     if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
//     if(isset($_SESSION[$key])) {
//         $value = $_SESSION[$key];
//         unset($_SESSION[$key]); // Make sure to unset if it's only meant to be used once
//         return $value;
//     }
//     return null;
// }

function setFlashData($key, $value) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION[$key] = $value;
}

function getFlashData($key) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $value = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    unset($_SESSION[$key]); // Xóa sau khi truy xuất để không hiển thị lại
    return $value;
}


// hàm hủy session quay trở lại trang login
function destroy(){
    session_destroy();
    header("Location: login.php"); 
}

// hàm check session
function checkSession($key) {
    //session_start();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION[$key])) {
        destroy();
        exit(); 
    }
}


// Hàm kiểm tra đăng nhập
function checkLogin() {
    // Khởi động session
    session_start();

    // Kiểm tra nếu session 'login' có tồn tại và có giá trị true
    if (isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] === true) {
        // Nếu đã đăng nhập, chuyển hướng đến trang index.php
        header("Location: index.php");
        exit();
    }
}

// hàm kiểm tra active
function authenticate_admin($username) {

        $sql = "SELECT active FROM admins WHERE admin_username = '$username'";
        $admin = oneRow($sql);

        if ($admin && $admin['active'] === 1) {
            return true; // Trả về true nếu admin active
        } else {
            return false; // Trả về false nếu admin không active
        }
 
}












?>