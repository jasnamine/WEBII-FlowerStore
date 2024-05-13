<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';


$filterAll = filter();

if(!empty($filterAll['id'])){
    $productID = $filterAll['id'];

    //echo "Username ID: $usernameID";

    // kiểm tra xem username có tồn tại trong customers không
    $productDetail = oneRow("SELECT products.*,categories.cate_name AS name_cate FROM products JOIN categories ON products.cate_ID = categories.cate_ID WHERE prd_ID = '$productID'");
    if(!empty($productDetail)){
        setFlashData('product-detail', $productDetail);
        
    }
    else{
        redirect('product.php');
    }
}

?>