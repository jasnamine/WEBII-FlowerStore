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
        $errors['username']['required'] = 'Username is required';
    }else{
        $username = $filterAll['username'];
        $sql = "SELECT customer_username FROM customers WHERE customer_username = '$username'";
        if(getRows($sql) > 0){
            $errors['username']['required'] = 'Username already exists';
    }
    }

    // validate fullname, email để trống

    // validate phone
    if(!isPhone($filterAll['phone'])){
            $errors['phone']['isPhone'] = 'Invalid phone number format';
    }
    
    // để trống validate city, district, address

    // validate password
    if(empty($filterAll['password'])){
        $errors['password']['required'] = 'Password is required';
    }

    // validate confirm password
    if(empty($filterAll['password_confirm'])){
        $errors['password_confirm']['required'] = 'Password confirmation is required';
    }else{
        if($filterAll['password'] != $filterAll['password_confirm']){
        $errors['password_confirm']['match'] = 'Passwords do not match';
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

       if($insertCustomers){
            setFlashData('msg', 'Insert successful');
            setFlashData('msg_type', 'success');
            header('Location: index.php'); 
            exit();
            
        }
        else{
            setFlashData('msg', 'System error');
            setFlashData('msg_type', 'danger');
        }
        
    }
    else{
       setFlashData('msg', 'Please check your data again');
       setFlashData('msg_type', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);
    }


}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>