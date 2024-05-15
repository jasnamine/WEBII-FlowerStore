<?php
    require_once ('helpers/format.php');
    require_once ('lib/database.php');
        
    if (isPost()) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = md5($password);
        if ($username === "" && $email === "" && $password === ""){
            exit("An error occurred");
        }

        // echo $username . ' ' . $email . ' ' . $password;

        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu hay chưa
        $existingUser = oneRow("SELECT customer_username FROM customers WHERE customer_username = '$username'");
        if ($existingUser > 0) {
            // Nếu username đã tồn tại, hiển thị thông báo lỗi hoặc chuyển hướng người dùng về trang đăng nhập
            echo '<div class="msg">
                    <p> This username is already taken, try another one please.</p>
                <div> <br>';
            echo '<a href="javascript:self.history.back()"> <button class="btn"> Go Back </button>';
        } else {
            // Nếu username chưa tồn tại, thêm dữ liệu vào cơ sở dữ liệu
            $dataCustomer = array(
                'customer_username' => $username,
                'customer_password' => $hashed_password,
                'customer_email' => $email,
                'customer_status' => 1,
            );
            $dataOrder = array(
                'customer_username' => $username,
                'order_status' => -1,
            );
            insert('customers', $dataCustomer);
            insert('orders', $dataOrder);

            echo '<div class="msg">
            <p> Registration Successfully!</p>
            <div> <br>';
            echo '<a href="login.php"> <button class="btn"> Login Now </button>';
        }
    }

?>
