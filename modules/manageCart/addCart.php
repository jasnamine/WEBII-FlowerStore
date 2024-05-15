<?php


// Kiểm tra xem người dùng đã nhấn nút "Add to Cart" chưa
if (isset($_POST['add_to_cart'])) {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    checkSession('username');
    
    // Lấy username của người dùng từ session
    $username = $_SESSION['username'];
    
    // Lấy prd_ID từ form
    $prd_ID = $_POST['prd_ID'];

    // Lấy số lượng sản phẩm từ form
    $quantity = $_POST['quantity'];

    // Kiểm tra xem khách hàng đã có giỏ hàng chưa
    $cart = getCart($username);

    if (!$cart) {
        // Nếu chưa có giỏ hàng, tạo mới giỏ hàng cho khách hàng
        $username = $_SESSION['username'];
        createNewCart($username);
        $cart = getCart($username);
    }

    // Lấy order_ID từ giỏ hàng
    $orderID = $cart['order_ID'];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    if (checkProductInCart($orderID, $prd_ID)) {
        // Nếu sản phẩm đã có trong giỏ hàng, hiển thị thông báo và không thêm sản phẩm vào giỏ hàng
        // echo "Sản phẩm đã có trong giỏ hàng.";
        header('Location: product-detail.php?prd_ID='.$prd_ID .'&add_error=1');
    } else {
        // Nếu sản phẩm chưa có trong giỏ hàng, thực hiện thêm sản phẩm vào giỏ hàng
        // Thêm sản phẩm vào giỏ hàng (bảng order_details)
        $data = [
            'prd_ID' => $prd_ID,
            'order_ID' => $orderID,
            'od_quantity' => $quantity
        ];

        // Thực hiện truy vấn INSERT
        insert('order_details', $data);

        // Hiển thị thông báo đã thêm sản phẩm vào giỏ hàng
        // echo "Sản phẩm đã được thêm vào giỏ hàng.";
        header('Location: product-detail.php?prd_ID='.$prd_ID .'&add_success=1');
    }

}

// Kiểm tra xem người dùng đã nhấn nút "Buy now" chưa
if (isset($_POST['buy_now'])) {
    // Thực hiện các bước tương tự như khi nhấn nút "Add to Cart"

    // Kiểm tra xem người dùng đã đăng nhập chưa
    checkSession('username');

    // Lấy username của người dùng từ session
    $username = $_SESSION['username'];
    
    // Lấy prd_ID từ form
    $prd_ID = $_POST['prd_ID'];

    // Lấy số lượng sản phẩm từ form
    $quantity = $_POST['quantity'];

    // Kiểm tra xem khách hàng đã có giỏ hàng chưa
    $cart = getCart($username);

    if (!$cart) {
        // Nếu chưa có giỏ hàng, tạo mới giỏ hàng cho khách hàng
        $username = $_SESSION['username'];
        createNewCart($username);
        $cart = getCart($username);
    }

    // Lấy order_ID từ giỏ hàng
    $orderID = $cart['order_ID'];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    if (checkProductInCart($orderID, $prd_ID)) {
        // Nếu sản phẩm đã có trong giỏ hàng, hiển thị thông báo và không thêm sản phẩm vào giỏ hàng
        echo "Sản phẩm đã có trong giỏ hàng.";
    } else {
        // Nếu sản phẩm chưa có trong giỏ hàng, thực hiện thêm sản phẩm vào giỏ hàng
        // Thêm sản phẩm vào giỏ hàng (bảng order_details)
        $data = [
            'prd_ID' => $prd_ID,
            'order_ID' => $orderID,
            'od_quantity' => $quantity
        ];

        // Thực hiện truy vấn INSERT
        insert('order_details', $data);
    }


    // Redirect tới trang cart.php
    header("Location: cart.php");
    exit(); // Dừng chương trình để không thực hiện các lệnh phía dưới
}
?>
