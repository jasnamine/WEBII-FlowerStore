<?php
$pageTitle = 'Login';

// session_start();
ob_start();

include 'include/header.php';
?>

<?php
require_once('lib/connect.php');
require_once('config/config.php');
require_once('lib/database.php');
require_once('helpers/format.php');
require_once('lib/session.php');

// // $kq = filter();
// // echo '<pre>';
// // print_r($kq);
// // echo '</pre>';

?>

<?php
$msg_login = 'Invalid username or password! Please try again!';
$msg_banned = 'You have been BANNED. Please contact administrator to solve the problem!';

// // Kiểm tra xem có thông báo lỗi không
// if (isset($_REQUEST['error_login'])) {
//     // Hiển thị thông báo lỗi (incorrect login)
//     echo '<div class="error-message"> Invalid username or password </div>';
// }
?>


        <div id="ErrorModal" class="modal-warning">
          <div class="modal-content">
            <span class="error-close">&times;</span>
            <div class="modal-body">
              <p>
                <?php 
                  if (isset($_REQUEST['error_active'])){
                    // Hiển thị thông báo lỗi (banned)
                    echo $msg_banned; 
                  } 
                  else if (isset($_REQUEST['error_login'])) {
                    // Hiển thị thông báo lỗi (incorrect login)
                    echo $msg_login;
                  }
                ?>
              </p>
            </div>
            <div class="modal-footer">
              <button id="modalOkBtn" class="btn btn-secondary">OK</button>
            </div>
          </div>
        </div>


<?php
  require "modules/auth/logincustomer.php";
?>

<!--Start Banner-->
<section
      class="hero-wrap hero-wrap-2"
      style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
      data-stellar-background-ratio="0.5"
    >
      <div class="overlay"></div>
      <div class="container">
        <div
          class="row no-gutters slider-text align-items-end justify-content-center"
        >
          <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0">
              <span class="mr-2"
                ><a href="index.php"
                  >Home <i class="fa fa-chevron-right"></i></a
              ></span>
              <span>Log in <i class="fa fa-chevron-right"></i></span>
            </p>
            <h2 class="mb-0 bread">Log in</h2>
          </div>
        </div>
      </div>
    </section>
  <!--End banner-->

    <section class="ftco-section">
      <section class="login_part section_padding">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
              <div class="login_part_text text-center">
                <div class="login_part_text_iner">
                  <h2 class="white-text">New to our Shop?</h2>
                  <p class="white-text-p">
                    There are advances being made in science and technology
                    everyday, and a good example of this is the
                  </p>
                  <a href="register.php" class="btn_3">Create an Account</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="login_part_form">
                <div class="login_part_form_iner">
                  <h3>
                    Welcome Back ! <br />
                    Please Sign in now
                  </h3>
                  <!--Start form-->
                  <form
                    class="row contact_form"
                    id="login_form"
                    action=""
                    method="post"
                    novalidate="novalidate"
                  >
                    <div class="col-md-12 form-group p_star">
                      <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        value=""
                        placeholder="Username"
                      />
                    </div>
                    <div class="col-md-12 form-group p_star">
                      <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        value=""
                        placeholder="Password"
                      />
                    </div>
                    <div class="col-md-12 form-group">
                      <button id="login_submit" value="submit" class="btn_3">
                        log in
                      </button>
                      <!-- <a class="lost_pass" href="#">forget password?</a> -->
                    </div>
                  </form>
                  <!--End form-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
    <script src="js/handleJS/login_validation.js"></script>
    <script type="text/javascript"> 
    // JavaScript
    document.addEventListener("DOMContentLoaded", function() {
    // Lấy modal
      var e_modal = document.getElementById('ErrorModal');

      // Lấy nút đóng modal
      var closeButton = document.getElementsByClassName('error-close')[0];

      // Khi người dùng nhấn nút đóng hoặc nút OK
      function closeModal() {
        e_modal.style.display = "none";
        // console.log('OK btn submit');
      }

      // Khi người dùng nhấn nút đóng
      closeButton.onclick = function() {
        closeModal();
      };

      // Khi người dùng nhấn nút OK
      document.getElementById('modalOkBtn').onclick = function() {
        closeModal();
      };

      // Hiển thị model
      <?php if (isset($_REQUEST['error_login']) || isset($_REQUEST['error_active'])): ?>
        e_modal.style.display = "block";
      <?php endif; ?>
	  });
    </script>

    <?php
    include 'include/footer.php';
    ?>