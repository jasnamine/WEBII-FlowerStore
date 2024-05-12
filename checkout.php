<?php
ob_start();
include 'include/header.php';

checkSession('username');
ob_end_flush();
?>

<?php
// Lấy thông tin người dùng từ cơ sở dữ liệu
$query = "SELECT * FROM customers WHERE customer_username = '$username'";
$data = array('customer_username' => $username);
$user = oneRow($query, $data);

// Gán thông tin người dùng vào các biến
$usernameValue = $user['customer_username'];
$fullnameValue = $user['customer_fullname'];
$phoneValue = $user['customer_phone'];
$emailValue = $user['customer_email'];
$addressValue = $user['customer_address'];
$districtValue = $user['customer_district'];
$cityValue = $user['customer_city'];

?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Checkout <i
                            class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">Checkout</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">
                <!--Start form-->
                <form action="#" class="billing-form">
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Firt Name</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input name="fullname" id="fullname" type="text" class="form-control" placeholder="" value="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="" class="form-control">
                                        <option value="">France</option>
                                        <option value="">Italy</option>
                                        <option value="">Philippines</option>
                                        <option value="">South Korea</option>
                                        <option value="">Hongkong</option>
                                        <option value="">Japan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="distrcit">District</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="" class="form-control">
                                        <option value="">France</option>
                                        <option value="">Italy</option>
                                        <option value="">Philippines</option>
                                        <option value="">South Korea</option>
                                        <option value="">Hongkong</option>
                                        <option value="">Japan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Street Address</label>
                                <input type="text" class="form-control" placeholder="House number and street name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    placeholder="Appartment, suite, unit etc: (optional)">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Town / City</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Postcode / ZIP *</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email Address</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <label class="mr-3"><input type="radio" name="optradio"> Get information from your account? </label>
                                    <label><input type="radio" name="optradio"> Ship to different address?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End form -->

                <div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Cart Total</h3>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span><?php echo number_format($cart['order_total-price'], 0, ',', '.');?> VND</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Payment Method</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Direct Bank
                                            Tranfer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="" class="mr-2"> I have read and accept the
                                            terms and conditions</label>
                                    </div>
                                </div>
                            </div>
                            <p><a href="#" class="btn btn-primary py-3 px-4">Place an order</a></p>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>

<?php
include 'include/footer.php'
?>