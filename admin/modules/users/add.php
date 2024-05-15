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
        if(countRows($sql) > 0){
            $errors['username']['required'] = 'Username already exists';
    }
    }

    // validate fullname
    
    // validate email
    if(empty($filterAll['email'])){
            $errors['email']['required'] = 'Invalid email';
    }

    // validate phone
    if(!empty($filterAll['phone'])){
            if(!isPhone($filterAll['phone'])){
            $errors['phone']['isPhone'] = 'Invalid phone number format';
    }
        
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

    $hashedPassword = md5($filterAll['password']);
    if(empty($errors)){
        $dataInsert = [
            'customer_username' => $filterAll['username'],
            'customer_fullname' => $filterAll['fullname'],
            'customer_email' => $filterAll['email'],
            'customer_phone' => $filterAll['phone'],
            'customer_city' => $filterAll['city'],
            'customer_district' => $filterAll['district'],
            'customer_address' => $filterAll['street_address'],
            'customer_password' => $hashedPassword, 
            'customer_status' => 1
            
        ];

       $insertCustomers = insert('customers', $dataInsert);

       if($insertCustomers){
            setFlashData('mgs', 'Insert successful');
            setFlashData('mgs_type', 'success');
            header('Location: index.php'); 
            exit();
            
        }
        else{
            setFlashData('mgs', 'System error');
            setFlashData('mgs_type', 'danger');
        }
        
    }
    else{
       setFlashData('mgs', 'Please check your data again');
       setFlashData('mgs_type', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);
    }


}

$mgs = getFlashData('mgs');
$mgsType = getFlashData('mgs_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>