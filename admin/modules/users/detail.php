<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';


$filterAll = filter();

if(!empty($filterAll['username'])){
    $usernameID = $filterAll['username'];

    //echo "Username ID: $usernameID";

    // kiểm tra xem username có tồn tại trong customers không
    $listUsers = oneRow("SELECT customer_username, customer_fullname, customer_email, customer_phone,
                                 customer_city, customer_district, customer_address, customer_password
                        FROM customers WHERE customer_username = '$usernameID'");
    if(!empty($listUsers)){
        setFlashData('user-detail', $listUsers);
        
    }
    else{
        redirect('index.php');
    }
}

?>