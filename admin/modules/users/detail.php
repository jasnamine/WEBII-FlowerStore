<?php
require_once '../lib/database.php';
require_once '../lib/session.php';

// truy vấn vào bảng users
$listUsers = getRaw("SELECT * FROM customers ORDER BY customer_username");
        // echo '<pre>';
        // print_r($listUsers);
        // echo '</pre>';
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>