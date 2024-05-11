<?php
require_once '../lib/database.php';
require_once '../lib/session.php';

// truy vấn vào bảng users
$listProducts = getRaw("SELECT products.*,categories.cate_name AS name_cate FROM products JOIN categories ON products.cate_ID = categories.cate_ID ORDER BY prd_ID");


$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>