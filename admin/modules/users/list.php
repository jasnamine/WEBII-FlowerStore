<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

// truy vấn vào bảng users
$listUsers = getRaw("SELECT * FROM customers ORDER BY customer_username");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>