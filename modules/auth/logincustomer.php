<?php
ob_start();
    // require_once ('helpers/format.php');
    // require_once ('lib/database.php');
    // // Kiểm tra xem người dùng đã gửi dữ liệu form chưa
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Lấy thông tin đăng nhập từ form
    //     $username = $_POST["username"];
    //     $password = $_POST["password"];

    //     // Thực hiện kiểm tra thông tin đăng nhập
    //     // Ở đây bạn có thể thêm logic để kiểm tra thông tin với cơ sở dữ liệu
    //     // hoặc kiểm tra với thông tin đã được xác định trước

    //     // Ví dụ đơn giản: nếu username là "admin" và password là "password", chấp nhận đăng nhập
    //     if ($username === "admin" && $password === "password") {
    //         // Đăng nhập thành công, chuyển hướng đến trang chính
    //         header("Location: main.php");
    //         exit();
    //     } else {
    //         // Đăng nhập không thành công, chuyển hướng người dùng đến trang đăng nhập lại với thông báo lỗi
    //         header("Location: login.html?error=1");
    //         exit();
    //     }
    // } else {
    //     // Nếu người dùng truy cập trực tiếp trang này mà không thông qua form, chuyển hướng về trang đăng nhập
    //     header("Location: login.html");
    //     exit();
    // }
?>

<script>
  const login_submit = document.getElementById('login_submit');
  const login_form = document.getElementById('login_form');

  login_submit.addEventListener('click', function(e){
      e.preventDefault();
      var isValid = validationForm();
      if (isValid == true) {
          // alert('Login successfully!');
          login_form.submit();
      }
  })


  // Hàm kiểm tra tên người dùng
  function isValidUsername(username) {
      // Biểu thức chính quy để kiểm tra tên người dùng
      var usernameRegex = /^[a-zA-Z0-9_]{1,32}$/;
      
      // Kiểm tra tên người dùng với regex
      return usernameRegex.test(username);
  }

  function isValidPassword(password) {
      // Biểu thức chính quy để kiểm tra mật khẩu
      var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$^&*+=])[A-Za-z\d@#$^&*+=]{8,20}$/;

      // Kiểm tra mật khẩu với regex
      return passwordRegex.test(password);
  }

  function validationForm() {
      var form_valid = true;
      var errors = [];

      var username = document.forms['login_form']['username'].value;
      var password = document.forms['login_form']['password'].value;

      console.log("username: " + username);
      console.log("password: " + password);

      console.log("Username valid: ", isValidUsername(username)); 
      console.log("Password valid: ", isValidPassword(password));

      // Tất cả các trường input đều trống
      if (username === '' && password === '') {
          alert('All fields are required');
          form_valid = false;
          return form_valid;
      }

      if (username === '') {
          errors.push('Please enter an username!');
          // form_valid = false;
      }
      else if (!(isValidUsername(username))) {
          errors.push('You have entered an invalid username or password!');
          // form_valid = false;
      }

      if (password === '') {
          errors.push('Please enter a password!');
          // form_valid = false;
      }
      else if (!(isValidPassword(password))) {
          errors.push('You have entered an invalid username or password!');
          // form_valid = false;
      }

      if (errors.length > 0) {
          var errors_msg = errors.join('\n');
          alert(errors_msg);
          return form_valid = false;
      }
      else return form_valid = true;

  }

</script>

<?php
require_once('lib/database.php');
require_once('helpers/format.php');
require_once('lib/session.php');
?>

<?php
// // Kiểm tra xem có thông báo lỗi trong session không
// if (isset($_SESSION['error'])) {
//     // Hiển thị thông báo lỗi
//     echo 'alert (' . $_SESSION['error'] . ');';
//     // Xóa thông báo lỗi khỏi session để nó không được hiển thị nữa
//     unset($_SESSION['error']);
// }
?>


<?php
// Kiểm tra xem người dùng đã gửi dữ liệu form chưa
if (isPost()) {
    // Lấy thông tin đăng nhập từ form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // // Mã hóa mật khẩu trước khi so sánh với dữ liệu trong cơ sở dữ liệu
    // $hashed_password = md5($password);

    // Thực hiện truy vấn để kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM customers WHERE customer_username = '$username' AND customer_password = '$password'";
    $data = array(
        'customer_username' => $username,
        'customer_password' => $password,
    );
        // echo $username . ' ' . $password;


    $user = oneRow($sql, $data);

    if ($user) {
        // Đăng nhập thành công, đặt phiên cho người dùng và chuyển hướng đến trang chính
        // echo "Logined successfully!";
        setSession('username', $username);
        header("Location: index.php"); // Chuyển hướng đến trang chính
        ob_end_flush();
        exit();
    } else {
        echo "Error";
        // Đăng nhập không thành công, chuyển hướng người dùng đến trang đăng nhập lại với thông báo lỗi
        // setFlashData('error', 'Invalid username or password');
        header("Location: login.php?error=1");
        ob_end_flush();
        exit();
    }
} 
// else {
//     // Nếu người dùng truy cập trực tiếp trang này mà không thông qua form, chuyển hướng về trang đăng nhập
//     header("Location: ../../login.php");
//     exit();
// }
?>
