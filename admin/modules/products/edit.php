<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

// Đường dẫn lưu trữ ảnh
$target_dir = "../images/";
$uploadOk = 1;

// Lấy dữ liệu từ form
$filterAll = filter();

// Kiểm tra xem có ID sản phẩm được truyền không
if(!empty($filterAll['id'])){
    $productID = $filterAll['id'];

    //echo 'product id: ' . $productID;

    // Kiểm tra xem id có tồn tại trong products không
    $productDetail = oneRow("SELECT products.*,categories.cate_name AS name_cate FROM products JOIN categories ON products.cate_ID = categories.cate_ID WHERE prd_ID = '$productID'");
    if(!empty($productDetail)){
        setFlashData('product-detail', $productDetail);
    }
    else{
        redirect('product.php');
    }
}

if(isPost()){
    $filterAll = filter();
    
    // mảng chứa các lỗi
    $errors = [];

    // validate price
    if(empty($filterAll['price'])){
        $errors['price']['required'] = 'Price is required';
    }
    else{
        if(empty($filterAll['price']) || !is_numeric($filterAll['price']) || $filterAll['price'] < 0 || $filterAll['price'] > 10000000) {
            $errors['price']['invalid'] = 'Price must be between 0 and 10,000,000';
        }   
    }

    // validate name product
    if(empty($filterAll['name'])){
        $errors['name']['required'] = 'Product name is required';
    }


    // validate desc
    if(empty($filterAll['description'])){
        $errors['desc']['required'] = 'Description is required';
    }

    // validate category
    if(empty($filterAll['product_category'])){
        $errors['product_category']['required'] = 'Category is required';
    }

     // Kiểm tra kích thước tệp
    if ($_FILES["image"]["size"] > 2097152) { // 2MB
        // Thêm thông báo lỗi vào mảng $errors nếu kích thước của tệp lớn hơn 4KB
        $errors['image']['size'] = "Image file size is too large. Please choose an image file smaller than 2MB.";
        $uploadOk = 0;
    }

// Tiến hành tải lên nếu tất cả các điều kiện đều hợp lệ
if ($uploadOk == 1) {
    // Kiểm tra xem có file ảnh mới được chọn không
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        // Đảm bảo rằng biến $target_file chứa đường dẫn đến tệp ảnh cần di chuyển
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imgPath = $_FILES['image']['name'];

        // Thực hiện di chuyển file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "the file has been uploaded.";
        } else {
            // Thêm thông báo lỗi vào mảng $errors nếu có lỗi khi upload
            $errors['image']['upload'] = "Sorry, there was an error uploading your file.";
        }
    }
}

    // có lỗi
    if(!empty($errors)){
       setFlashData('msgProE', 'Please check your data again');
       setFlashData('msg_typeProE', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);
        
    }
    // không up ảnh
    else if((!isset($_FILES['image']) || empty($_FILES['image']['name']))){
               $data = [
            'prd_name' => $filterAll['name'],
            
            'prd_price' => $filterAll['price'],
            'prd_description' => $filterAll['description'],
            //'cate_ID' => $filterAll['product_category']
        ];

        $update = update('products', $data, "prd_ID = '$productID'");
         
        if($update){
            setFlashData('msgProE', 'Update successful');
            setFlashData('msg_typeProE', 'success');
            redirect('product-edit.php?id='. $productID);
            
        }
            
    }
    // úp ảnh
    else if(empty($error)){
            $dataUpdate = [
            'prd_name' => $filterAll['name'],
            'prd_img' => $target_file,
            'prd_price' => $filterAll['price'],
            'prd_description' => $filterAll['description'],
            //'cate_ID' => $filterAll['product_category']
        ];

        $updateProduct = update('products', $dataUpdate, "prd_ID = '$productID'");
         
        if($updateProduct){
            setFlashData('msgProE', 'Update successful');
            setFlashData('msg_typeProE', 'success');
            redirect('product-edit.php?id='. $productID);
            
        }
    }

}

$msgProE = getFlashData('msgProE');
$msgTypeProE = getFlashData('msg_typeProE');
$errors = getFlashData('errors');
$old = getFlashData('old');
$productDetail = getFlashData('product-detail');

if(!empty($productDetail)){
    $old = $productDetail;
}

?>