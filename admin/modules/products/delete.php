<?php
require_once '../lib/database.php';
require_once '../lib/session.php';


require_once '../helpers/format.php';

?>
<?php

// Lấy dữ liệu từ form
$filterAll = filter();

// Kiểm tra xem có ID sản phẩm được truyền không
if(!empty($filterAll['id'])){
    $productID = $filterAll['id'];

    // Kiểm tra xem id có tồn tại trong products không
    $productDetail = countRows("SELECT * FROM products WHERE prd_ID = '$productID'");
    if($productDetail > 0){
        // 5 : đã bán
        $deleteUser = delete('products', "prd_ID = '$productID'");

        if($deleteUser){
        setFlashData('msgK', 'Delete successfully');
        setFlashData('msge_type', 'success');
        redirect("product.php");
        }
        else{
        setFlashData('msgK', 'Link not exist');
        setFlashData('msge_type', 'danger');
        redirect("product.php");
        }
        
    }
    else{
        setFlashData('msgK', 'Link not exist');
        setFlashData('msge_type', 'danger');
        redirect("product.php");

    }
}
$msgK = getFlashData('msgK');
$msgeType = getFlashData('msge_type');





    