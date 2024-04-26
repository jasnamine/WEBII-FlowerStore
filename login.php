<?php
include 'include/header.php';
?>

<?php
// require_once('lib/connect.php');
// require_once('config/config.php');
// require_once('lib/database.php');
// require_once('helpers/format.php');
// // include 'helpers/format.php';

// // $kq = filter();
// // echo '<pre>';
// // print_r($kq);
// // echo '</pre>';
?>
<!--Start Banner-->
<section
      class="hero-wrap hero-wrap-2"
      style="background-image: url('images/bg_2.jpg')"
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
                    action="#"
                    method="post"
                    novalidate="novalidate"
                  >
                    <div class="col-md-12 form-group p_star">
                      <input
                        type="email"
                        class="form-control"
                        id="name"
                        name="name"
                        value=""
                        placeholder="Email"
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
                      <button type="submit" value="submit" class="btn_3">
                        log in
                      </button>
                      <a class="lost_pass" href="#">forget password?</a>
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

    <?php
    include 'include/footer.php';
    ?>