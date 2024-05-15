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
        $sql = "SELECT prd_status FROM products WHERE prd_ID = '$productID'";
        $product = oneRow($sql);
        // 0 : ẩn và chưa bán
        // 2 : ẩn và đã bán

        // 1: hiện và chưa bán
        // 3 : hiện và đã bán
        if($product){
            if ($product && $product['prd_status'] === '1') {
            $dataUpdate = [
            'prd_status' => '0'
            ];
            
        } 
            elseif($product && $product['prd_status'] === '3'){
            $dataUpdate = [
            'prd_status' => '2'
            ];
           
        } 
         elseif($product && $product['prd_status'] === '0'){
            $dataUpdate = [
            'prd_status' => '1'
            ];
          
        }
        elseif($product && $product['prd_status'] === '2'){
            $dataUpdate = [
            'prd_status' => '3'
            ];
            
        }

        $updateProduct = update('products', $dataUpdate, "prd_ID = '$productID'");
        if($updateProduct){
            setFlashData('msg', 'Update successful');
            redirect("product.php");
            exit();

        }
        else{
        setFlashData('msg', 'Hide error');
        setFlashData('msg_type', 'danger');
        redirect("product.php");
        exit();
        }

        }
        else{
        setFlashData('msg', 'Hide error');
        setFlashData('msg_type', 'danger');
        redirect("product.php");
        exit();
        }
        
    }
    else{
        setFlashData('msg', 'Link not exist');
        setFlashData('msg_type', 'danger');
        redirect("product.php");
        exit();

    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');





    