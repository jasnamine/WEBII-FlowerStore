<?php
$pageTitle = 'Registration';

require_once('lib/database.php');
require_once('helpers/format.php');

// $data = [
//   'customer_username' => 'hung12222',
//   'customer_email' => 'nvaddd',
// ];
// update('customer', $data, 'ID_customer = :d0001');

// $data = [
//   'customer_username' => 'hoang',
//   'customer_password' => '12345',
// ];

// insert('customers', $data);
//update('customer', $data, "ID_customer = 'd0002'");
//delete('customer', "ID_customer = 'd0002'");

// $kq = getRows('SELECT * FROM customer');

// echo '<pre>';
// print_r($kq);
// echo '</pre>';


?>

<?php
include 'include/header.php';
?>
 <!--Start banner-->

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
                ><a href="index.html"
                  >Home <i class="fa fa-chevron-right"></i></a
              ></span>
              <span>Register <i class="fa fa-chevron-right"></i></span>
            </p>
            <h2 class="mb-0 bread">Register</h2>
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
                  <h2 class="white-text">Welcome Back!</h2>
                  <p class="white-text-p">
                    It's great to see you again. Log in to access your account
                    and explore the latest products.
                  </p>
                  <a href="login.php" class="btn_3">LOG IN</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="login_part_form">
                <div class="login_part_form_iner">
                  <h3>
                    Join Us Now! <br />
                    Create an Account to Get Started
                  </h3>
                  <!--Start form-->
                  <form
                    class="row contact_form"
                    id="register_form"
                    action=""
                    method="POST"
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
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        value=""
                        placeholder="Email (example: Tinle123@gmail.com)"
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
                      <div class="password-requirements">	
                        <button class="toggle-button" id="toggle-button">Show Password Requirements</button>
                        <div class="requirements-content" id="passwordRequirements" style="display: none;">
                          + Minimum of 8 characters
                          <br> 
                          + Maximum of 20 characters
                          <br> 
                          + USE AT LEAST 3 of the following classes:
                          <br> 
                          - Lower case letters(s)
                          <br> 
                          - Upper case letter(s)
                          <br>
                          - Number(s)
                          <br> 
                          - Special Character(s) (@#$^&*+=)
                          <br> 
                          * Note that the % symbol is not allowed!
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 form-group p_star">
                      <input
                        type="password"
                        class="form-control"
                        id="confirm-password"
                        name="confirm-password"
                        value=""
                        placeholder="Confirm password"
                      />
                    </div>
                    <div class="col-md-12 form-group">
                      <button id="register_submit" value="submit" class="btn_3">
                        Sign up
                      </button>
                    </div>
                  </form>
                  <?php
                    require('modules/auth/registercustomer.php');
                  ?>
                  <!--End form-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
    <script src="./js/handleJS/register_validation.js"></script>

<?php
include 'include/footer.php';
?>