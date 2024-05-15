<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';
require_once 'lib/connect.php';

$filterAll = filter();

if(!empty($filterAll['username'])){
    $usernameID = $filterAll['username'];

    //echo "Username ID: $usernameID";

    // kiểm tra xem username có tồn tại trong customers không
    $userDetail = oneRow("SELECT customer_username, customer_fullname, customer_email, customer_phone,
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
    
    if(empty($errors)){
        
        $dataUpdate = [
            //'customer_username' => $filterAll['username'],
            'customer_fullname' => $filterAll['fullname'],
            'customer_email' => $filterAll['email'],
            'customer_phone' => $filterAll['phone'],
            'customer_city' => $filterAll['city'],
            'customer_district' => $filterAll['district'],
            'customer_address' => $filterAll['street_address']
            
        ];
         
        $updateCustomers = update('customers', $dataUpdate, "customer_username = '$usernameID'" );

        if($updateCustomers){
            setFlashData('msgE', 'Update successful');
            setFlashData('msgE_type', 'success');
            header('Location: user-edit.php?username='. $usernameID); 
            exit();
            
        }
        else{
            setFlashData('msgE', 'System error');
            setFlashData('msgE_type', 'danger');
        }
           
    }
    else{
       setFlashData('msgE', 'Please check your data again');
       setFlashData('msgE_type', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);

    }
 
}

$msgE = getFlashData('msgE');
$msgEType = getFlashData('msgE_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetail = getFlashData('user-detail');

if(!empty($userDetail)){
    $old = $userDetail;
}



?>