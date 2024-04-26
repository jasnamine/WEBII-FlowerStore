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

// Hàm removeSession: Xóa session hoặc key từ session
function removeSession(){
    if(empty($key)){
        session_destroy();
        return true;
    }
    else{
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
            return true;
        }
    }
}

// Hàm setFlashData: Thiết lập dữ liệu flash vào session
function setFlashData($key, $value){
    $key = 'flash_' .$key;
    return setSession($key, $value);
}

// Hàm getFlashData: Lấy dữ liệu flash từ session và xóa nó sau khi lấy
function getFlashData($key){
    $key = 'flash_' .$key;
    $data = getSession($key);
    removeSession($key);
    return $data;

}
?>