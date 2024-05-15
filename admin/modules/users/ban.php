<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

?>
<?php

// Lấy dữ liệu từ form
$filterAll = filter();

// Kiểm tra xem có username được truyền không
if(!empty($filterAll['username'])){
    $userID = $filterAll['username'];
    // Kiểm tra xem username có tồn tại trong products không
    $username = countRows("SELECT * FROM customers WHERE customer_username = '$userID'");
    if($username > 0){
        
        $sql = "SELECT customer_status FROM customers WHERE customer_username = '$userID'";
        $user = oneRow($sql);

        if($user){
            if ($user['customer_status'] == '1') {
            $dataUpdate = ['customer_status' => '0'];
            }        
            elseif($user['customer_status'] == '0'){
            $dataUpdate = ['customer_status' => '1'];
            }
        $updateStatus = update('customers', $dataUpdate, "customer_username = '$userID'");

        if($updateStatus){

            redirect("index.php"); 
        }
        else{
        redirect("index.php");
        }      
           
        }
        
    }
    else{
        setFlashData('msg', 'Link not exist');
        setFlashData('msg_type', 'danger');
        redirect("index.php");

    }
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');





    