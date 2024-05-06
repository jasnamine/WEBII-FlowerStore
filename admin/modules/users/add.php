<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

if(isPost()){
    $filterAll = filter();
    
    // mảng chứa các lỗi
    $errors = [];

    // validate  username
    if(empty($filterAll['username'])){
        $errors['username']['required'] = 'bắt buộc nhập username';
    }else{
        $username = $filterAll['username'];
        $sql = "SELECT customer_username FROM customers WHERE customer_username = '$username'";
        if(getRows($sql) > 0){
            $errors['username']['required'] = 'user đã tồn tại';
    }
    }

    // validate fullname để trống

    // validate email
    if(empty($filterAll['email'])){
        $errors['email']['required'] = 'bắt buộc nhập email';
    }
    else{
        $email = $filterAll['email'];
        $sql = "SELECT customer_username FROM customers WHERE customer_email = '$email'";
        if(getRows($sql) > 0){
            $errors['email']['required'] = 'email đã tồn tại';
    }
    }

    // validate phone
    if(empty($filterAll['phone'])){
        $errors['phone']['required'] = 'bắt buộc nhập sđt';
    }
    else{
        if(!isPhone($filterAll['phone'])){
            $errors['phone']['isPhone'] = 'sđt sai định dạng';
    }
    
    }

    // để trống validate city, district, address

    // validate password
    if(empty($filterAll['password'])){
        $errors['password']['required'] = 'bắt buộc nhập pw';
    }

    // validate confirm password
    if(empty($filterAll['password_confirm'])){
        $errors['password_confirm']['required'] = 'bắt buộc nhập pw';
    }else{
        if($filterAll['password'] != $filterAll['password_confirm']){
        $errors['password_confirm']['match'] = 'sai pw';
    }
        
    }

    if(empty($errors)){
        $dataInsert = [
            'customer_username' => $filterAll['username'],
            'customer_fullname' => $filterAll['fullname'],
            'customer_email' => $filterAll['email'],
            'customer_phone' => $filterAll['phone'],
            'customer_city' => $filterAll['city'],
            'customer_district' => $filterAll['district'],
            'customer_address' => $filterAll['street_address'],
            'customer_password' => password_hash($filterAll['password'], PASSWORD_DEFAULT )
            
        ];

       $insertCustomers = insert('customers', $dataInsert);
        
       setFlashData('msg', 'Thêm thành công');
       setFlashData('msg_type', 'success');
       redirect('index.php');
        
    }
    else{
       setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu');
       setFlashData('msg_type', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);
       //redirect('user-create.php');
    }


}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// echo '<pre>';
// print_r( $errors);
// echo '</pre>';






    

?>