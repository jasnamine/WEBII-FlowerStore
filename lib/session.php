<?php
/**
 * Session Class
 **/
class Session {
    // Khởi tạo phiên session
    //vi du: them vao gio hang, thanh toan, dang nhap trang admin thi session luu phien giao dich, moi lan refesh thi van con luu phien giao dich ko lam moi trang
    public static function init() {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    // Thiết lập giá trị cho một biến session
    // set key thanh val, vi du usernam dang nhap la admin thi se xuat ra gia tri la admin
    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    // Lấy giá trị của một biến session
    // get value
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    // Kiểm tra xem người dùng đã đăng nhập hay chưa, nếu chưa thì chuyển hướng đến trang đăng nhập
    // check coi phien lam viec co ton tai hay khong
    // mac dinh la trang dang nhap
    //neu getlogin = false quay lai trang dang nhap
    public static function checkSession() {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("Location: login.php");
        }
    }

    // Kiểm tra xem người dùng đã đăng nhập hay chưa, nếu đã đăng nhập thì chuyển hướng đến trang chính

    public static function checkLogin() {
        self::init();
        if (self::get("login") == true) {
            header("Location: index.php");
        }
    }

    // Hủy phiên session và chuyển hướng đến trang đăng nhập
    // xoa phien lam viec
    public static function destroy() {
        session_destroy();
        header("Location: login.php");
    }
}




?>
