<?php
require_once '../lib/database.php';
require_once '../lib/session.php';

// truy vấn vào bảng users
$listCategories = getRow("SELECT cate_ID, cate_name, cate_img_link, cate_desc FROM categories ORDER BY cate_ID");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>