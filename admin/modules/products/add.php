<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

$target_dir = "../images/";
$uploadOk = 1;


$filterAll = filter();


    // Check if upload is successful and proceed if uploadOk is still 1
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-btn'])) {
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
    }else{
        $name = $filterAll['name'];
        $sql = "SELECT prd_name FROM products WHERE prd_name = '$name'";
        if(countRows($sql) > 0){
            $errors['username']['required'] = 'Product';
    }
    }


    // validate desc
    if(empty($filterAll['description'])){
        $errors['desc']['required'] = 'Description is required';
    }

    // validate category
    if(empty($filterAll['product_category'])){
        $errors['product_category']['required'] = 'Category is required';
    }


    // validate img
    if (!isset($_FILES['image']) || empty($_FILES['image']['name'])) {
    // Thêm thông báo lỗi vào mảng $errors nếu không có tệp ảnh được chọn
    $errors['image']['required'] = "Please select an image file.";
    $uploadOk = 0;
    }

    // Check if file already exists
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && file_exists($target_file)) {
        // Thêm thông báo lỗi vào mảng $errors nếu tệp đã tồn tại
        $errors['image']['exists'] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 2097152) { // 2MB
        // Thêm thông báo lỗi vào mảng $errors nếu kích thước của tệp lớn hơn 4KB
        $errors['image']['size'] = "Image file size is too large. Please choose an image file smaller than 2MB.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (isset($_FILES['image']) && !empty($_FILES['image']['name']) &&  !in_array($imageFileType, $allowedFormats)) {
        // Thêm thông báo lỗi vào mảng $errors nếu định dạng của tệp không được phép
        $errors['image']['format'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // // Proceed with upload if all checks pass
    // if ($uploadOk == 1) {
    //     $imgPath = $_FILES['image']['name'];
    //     echo $imgPath;
        

    //     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    //         echo "the file has been uploaded.";
    //     } else {
    //         // Thêm thông báo lỗi vào mảng $errors nếu có lỗi khi upload
    //         $errors['image']['upload'] = "Sorry, there was an error uploading your file.";
    //     }
    // }

    // if (empty($errors)) {
    //     // Proceed with upload if all checks pass
    //     if ($uploadOk == 1) {
    //         if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    //             $imgPath = $_FILES['image']['name'];
    //         } else {
    //             $errors['image']['upload'] = "Sorry, there was an error uploading your file.";
    //         }
            
    //     }

    //     if (empty($errors)) {
    //         $dataInsert = [
    //             'prd_name' => $filterAll['name'],
    //             'prd_img' => $target_file,
    //             'prd_size' => $filterAll['size'],
    //             'prd_price' => $filterAll['price'],
    //             'prd_desc' => $filterAll['description'],
    //             'cate_ID' => $filterAll['product_category']
    //         ];

    //         $insertProducts = insert('products', $dataInsert);

    //         setFlashData('msgA', 'Insert successfully!');
    //         setFlashData('msgA_type', 'success');
    //         header("Location: product.php");
    //         exit();
    //     }
    // }

    if (empty($errors)) {
        // Kiểm tra và xử lý ảnh
        if (!empty($_FILES['image']['name'])) {
            // Đường dẫn tệp ảnh trên máy chủ
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            
            // Kiểm tra và cắt chuỗi "../" khỏi đường dẫn ảnh
            $target_file = str_replace('../', '', $target_file);
            
            // Di chuyển và lưu tệp ảnh vào thư mục images
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Lưu đường dẫn tệp ảnh vào cơ sở dữ liệu
                $imgPath = $target_file;

                // Tiếp tục với các xử lý khác như lưu dữ liệu vào cơ sở dữ liệu
                // Ví dụ:
                $dataInsert = [
                    'prd_name' => $filterAll['name'],
                    'prd_img' => $imgPath, // Đường dẫn ảnh đã được cắt chuỗi
                    'prd_price' => $filterAll['price'],
                    'prd_description' => $filterAll['description'],
                    'cate_ID' => $filterAll['product_category'],
                    'prd_status' => 1
                ];

                // Thực hiện việc chèn dữ liệu vào cơ sở dữ liệu
                $insertProducts = insert('products', $dataInsert);

                // Đặt thông báo flash và chuyển hướng
                setFlashData('msgA', 'Insert successfully!');
                setFlashData('msgA_type', 'success');
                header("Location: product.php");
                exit();
            } else {
                // Nếu di chuyển tệp không thành công, thêm lỗi vào mảng $errors
                $errors['image']['upload'] = "Sorry, there was an error uploading your file.";
            }
        }
    }


    else{

       setFlashData('msgA', 'Please check your data again');
       setFlashData('msgA_type', 'danger');
       setFlashData('errors', $errors);
       setFlashData('old', $filterAll);
    }


    }

$msgA = getFlashData('msgA');
$msgAType = getFlashData('msgA_type');
$errors = getFlashData('errors');
$old = getFlashData('old');



?>