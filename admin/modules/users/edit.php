<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';


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

if(isPost()){
    $filterAll = filter();
    
    // mảng chứa các lỗi
    $errors = [];

    // validate  username
    //if(empty($filterAll['username'])){
        //$errors['username']['required'] = 'bắt buộc nhập username';
    // }else{
    //     $username = $filterAll['username'];
    //     $sql = "SELECT customer_username FROM customers WHERE customer_username = '$username'";
    //     if(getRows($sql) > 0){
    //         $errors['username']['required'] = 'user đã tồn tại';
    // }
    //}

    // validate fullname để trống

    // validate email
    // if(empty($filterAll['email'])){
    //     $errors['email']['required'] = 'bắt buộc nhập email';
    // }
    // else{
    //     $email = $filterAll['email'];
    //     $sql = "SELECT customer_username FROM customers WHERE customer_email = '$email'";
    //     if(getRows($sql) > 0){
    //         $errors['email']['required'] = 'email đã tồn tại';
    // }
    

    // validate phone
    //if(empty($filterAll['phone'])){
        //$errors['phone']['required'] = 'bắt buộc nhập sđt';
    //}
    //else{
        if(!isPhone($filterAll['phone'])){
            $errors['phone']['isPhone'] = 'sđt sai định dạng';
        }
    
    //}

    // để trống validate city, district, address, pw
        // validate confirm password
    //if(empty($filterAll['password_confirm'])){
        //$errors['password_confirm']['required'] = 'bắt buộc nhập pw';
    //}else{
        if($filterAll['password'] != $filterAll['password_confirm']){
        $errors['password_confirm']['match'] = 'sai pw';
    }
    //}

    

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

        //$condition = "customer_username = '$username'";
         
        $updateCustomers = update('customers', $dataUpdate, "customer_username = '$usernameID'" );

        if($updateCustomers){
            setFlashData('msg', 'Sửa thành công');
            setFlashData('msg_type', 'success');
            //setFlashData('old', $updateCustomers);
            header('Location: user-edit.php?username='. $usernameID); 
            exit();
            
        }
        else{
            setFlashData('msg', 'Hệ thống đang lỗi');
            setFlashData('msg_type', 'danger');
        }
           
    }
    else{
       setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu');
       setFlashData('msg_type', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);
       
       
       //redirect('user-create.php');
    }
    //redirect('user-edit.php');  
    
    
     

}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetail = getFlashData('user-detail');
//$newUserDetail = getFlashData('new-user-detail');

// if (isset($userDetail)) {
//     echo '<pre>';
//     print_r($userDetail);
//     echo '</pre>';
// } else {
//     echo "User detail is not set!";
// }

if(!empty($userDetail)){
    $old = $userDetail;
}








?>