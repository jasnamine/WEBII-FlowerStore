<?php

// Hàm set thời gian
function formatDate($date) {
    return date('F j, Y, g:i a', strtotime($date));
}

// Shorten text for SEO-friendly titles
function textShorten($text, $limit = 400) {
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.".....";
    return $text;
}

// Validate form input
function validation($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// hàm check get
function isGet(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    return false;
}

// hàm check post
function isPost(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    return false;
}

// hàm filter
function filter(){
    $filterArr = [];
    if(isGet()){
       
        if(!empty($_GET)){
            foreach($_GET as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }
                else{
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

    }

    if(isPost()){
       
        if(!empty($_POST)){
            foreach($_POST as $key => $value){
                $key = strip_tags($key);
                if(is_array($value)){
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }
                else{
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

    }
    return $filterArr;
    
}

// hàm check email
function isEmail($email){
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;

}

// hàm check số nguyên
function isNumberInt($number){
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}

// hàm check số thực
function isNumberFloat($number){
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

// hàm check sđt
function isPhone($phone){
    $checkZero = false;

    // Điều kiện 1: kiểm tra số đầu tiên có phải số 0 không
    if($phone[0] === '0'){
        $checkZero = true;
        $phone = substr($phone,1);
    }

    // Điều kiện 2: đằng sau nó có 9 số
    $checkNumber = false;
    if(isNumberInt($phone) && (strlen($phone) == 9)){
        $checkNumber = true;
    }

    if($checkZero && $checkNumber){
        return true;
    }

    return false;

}  
//Thông báo lỗi
function getMsg($msg, $type = 'danger') {
    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
    echo $msg;
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>';
    echo '</div>';
}

// // Hàm chuyển hướng
// function redirect($path='') {
//     header("Location: $path");
//     exit();
// }
function redirect($url){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    header('Location: ' . $url);
    exit();
}


// Hàm thông báo error cho form
function form_error($fileName, $beforeHtml='', $afterHtml='', $errors){
    return (!empty($errors[$fileName])) ? '<span class="error">'.reset($errors[$fileName]).'</span>' : null;
    
}

// Hàm lưu lại dữ liệu cũ
function old($fileName, $oldData, $default = null){
    return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
}

// function old($field, $oldData, $default = '') {
//   return isset($oldData[$field]) ? $oldData[$field] : $default;
// }



?>