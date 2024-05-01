<?php
    // require_once ('helpers/format.php');
    // require_once ('lib/database.php');
    
    // if (isset($_POST['submit'])) {
    //     $username = $_POST['username'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

        
    //     if (getRow("SELECT customer_username FROM customers WHERE customer_username = '$username'") != 0) {
    //         echo '<div class="msg">
    //                 <p> This username is already taken, try another one please.</p>
    //               <div> <br>';
    //         echo '<a href="javascript:self.history.back()"> <button class="btn"> Go back </button>';
    //     }
    //     else {
    //         $data = array(
    //             'customer_username' => $username,
    //             'customer_password' => $password,
    //             'customer_email' => $email,
    //         );
    //         insert('customers', $data);

    //         echo '<div class="msg">
    //         <p> Registration Successfully!</p>
    //         <div> <br>';
    //         echo '<a href="login.php"> <button class="btn"> Login Now </button>';
    //     }
    // }
?>

<?php
    require_once ('helpers/format.php');
    require_once ('lib/database.php');
        
    if (isPost()) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

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
            $data = array(
                'customer_username' => $username,
                'customer_password' => $password,
                'customer_email' => $email,
            );
            insert('customers', $data);

            echo '<div class="msg">
            <p> Registration Successfully!</p>
            <div> <br>';
            echo '<a href="login.php"> <button class="btn"> Login Now </button>';
        }
    }

?>

<?php
// require_once('lib/connect.php'); // Kết nối đến cơ sở dữ liệu
// require_once('helpers/format.php'); // Import các hàm định dạng dữ liệu

// // Kiểm tra xem dữ liệu đã được gửi từ form chưa
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Lấy dữ liệu từ form
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Kiểm tra và xử lý dữ liệu (ví dụ: kiểm tra tính hợp lệ của email, mật khẩu, v.v.)
//     // Nếu dữ liệu không hợp lệ, bạn có thể trả về thông báo lỗi hoặc redirect người dùng trở lại trang register với thông báo lỗi
//     // Nếu dữ liệu hợp lệ, tiếp tục thực hiện insert vào cơ sở dữ liệu
//     // Ví dụ: kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa

//     // Thực hiện câu lệnh SQL để insert dữ liệu vào bảng customers (ví dụ)
//     $sql = "INSERT INTO customers (customer_username, customer_email, customer_password) VALUES ('$username', '$email', '$password')";

//     // Thực hiện truy vấn
//     if ($conn->query($sql) === TRUE) {
//         // Insert thành công, có thể hiển thị thông báo hoặc redirect người dùng đến trang khác
//         echo "Registration successful!";
//     } else {
//         // Nếu có lỗi trong quá trình insert, có thể hiển thị thông báo lỗi
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }

//     // Đóng kết nối đến cơ sở dữ liệu
//     $conn->close();
// }
?>
