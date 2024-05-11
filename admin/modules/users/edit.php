<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';


$filterAll = filter();

if(!empty($filterAll['username'])){
    $usernameID = $filterAll['username'];

    //echo "Username ID: $usernameID";

    // kiểm tra xem username có tồn tại trong customers không
    $userDetail = oneRaw("SELECT customer_username, customer_fullname, customer_email, customer_phone,
                                 customer_city, customer_district, customer_address, customer_password
                        FROM customers WHERE customer_username = '$usernameID'");
    if(!empty($userDetail)){
        setFlashData('user-detail', $userDetail);
        
    }
    else{
        redirect('index.php');
    }
}

if (isPost()){
    $filterAll = filter();
    
    // mảng chứa các lỗi
    $errors = [];

        if(!isPhone($filterAll['phone'])){
            $errors['phone']['isPhone'] = 'Invalid phone number format';
        }
    
        if($filterAll['password'] != $filterAll['password_confirm']){
        $errors['password_confirm']['match'] = 'Password does not match';
    }

    if(empty($errors)){
        
        $dataUpdate = [
            'customer_username' => $filterAll['username'],
            'customer_fullname' => $filterAll['fullname'],
            'customer_email' => $filterAll['email'],
            'customer_phone' => $filterAll['phone'],
            'customer_city' => $filterAll['city'],
            'customer_district' => $filterAll['district'],
            'customer_address' => $filterAll['street_address']
            
        ];

        if(!empty($filterAll['password'])){
            $dataUpdate['customer_password'] = password_hash($filterAll['password'], PASSWORD_DEFAULT);
        }
         
        $updateCustomers = update('customers', $dataUpdate, "customer_username = '$usernameID'" );

        if($updateCustomers){
            setFlashData('msg', 'Update successful');
            setFlashData('msg_type', 'success');
            header('Location: user-edit.php?username='. $usernameID); 
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
$userDetail = getFlashData('user-detail');

if(!empty($userDetail)){
    $old = $userDetail;
}








?>