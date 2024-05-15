<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';
require_once 'lib/connect.php';


// truy vấn vào bảng users
$listUsers = getRow("SELECT customer_username, customer_email, customer_status FROM customers");
        // echo '<pre>';
        // print_r($listUsers);
        // echo '</pre>';
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>