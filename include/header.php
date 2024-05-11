<?php
session_start();

require_once 'lib/session.php';
require_once 'lib/database.php';

// $username = 'customer';
// setSession('username', $username);
// Kiểm tra xem session 'username' đã tồn tại chưa và có giá trị không
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) 
// if (checkSession('username'))
{
    $username = getSession('username');
    // Nếu đã đăng nhập, hiển thị thông báo
    // if (!authenticate_customer($username)) {
    //     // Tài khoản người dùng bị khóa, chuyển hướng đến trang đăng nhập lại với thông báo lỗi
    //     removeSession('username');
    //     header("Location: login.php?error_active=1");
    //     ob_end_flush();
    //     exit();
    // }
    // echo "Chào mừng $username";
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flower Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/error-popup.css">
</head>

<body>
  	<div class="wrap">
		<div class="container">
		
			<!--Header-->
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<p class="mb-0 phone pl-md-2">
						<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a> 
						<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
					</p>
				</div>
				<div class="col-md-6 d-flex justify-content-md-end">
					<div class="social-media mr-4">
						<p class="mb-0 d-flex">
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
						</p>
					</div>
					<div class="reg">
						<p class="mb-0">
							<?php if (isset($_SESSION['username'])) { ?>
								<a href="myaccount.php" class="mr-2">
									<i class="fa fa-user-circle"></i>
								</a>
								<?php } else { ?>
								<a href="register.php" class="mr-2">Sign Up</a>
								<a href="login.php" class="mr-2">Log In</a>
							<?php } ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
    
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">

		<a class="navbar-brand" href="index.php">Flower <span>store</span></a>
			<div class="order-lg-last btn-group">
				<form action="products.php" method="get">
					<div class="input-group">
						<input type="text" name="search" placeholder="Search..">
						<span class="input-group-btn">
							<button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		<?php if(isset($_SESSION['username'])): ?>
			<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="flaticon-shopping-bag"></span>
				<div class="d-flex justify-content-center align-items-center"><small>3</small></div>
			</a>
		<?php endif; ?>

		<div class="dropdown-menu dropdown-menu-right">
			<div class="dropdown-item d-flex align-items-start" href="#">
				<div class="img" style="background-image: url(images/prod-1.jpg);"></div>
				<div class="text pl-3">
					<h4>Bacardi 151</h4>
					<p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">Quantity: 01</span></p>
				</div>
			</div>
			<div class="dropdown-item d-flex align-items-start" href="#">
				<div class="img" style="background-image: url(images/prod-2.jpg);"></div>
				<div class="text pl-3">
					<h4>Jim Beam Kentucky Straight</h4>
					<p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">Quantity: 02</span></p>
				</div>
			</div>
			<div class="dropdown-item d-flex align-items-start" href="#">
				<div class="img" style="background-image: url(images/prod-3.jpg);"></div>
				<div class="text pl-3">
					<h4>Citadelle</h4>
					<p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">Quantity: 01</span></p>
				</div>
			</div>
			<a class="dropdown-item text-center btn-link d-block w-100" href="cart.php">
				View All
				<span class="ion-ios-arrow-round-forward"></span>
			</a>
		</div>
		</div>
		
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link " href="products.php">Products</a>
                        <!-- <div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item" href="product.html">Products</a>
							<a class="dropdown-item" href="product-single.html">Single Product</a>
							<a class="dropdown-item" href="cart.html">Cart</a>
							<a class="dropdown-item" href="checkout.html">Checkout</a>
						</div> -->
            		</li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
				</ul>
			</div>
	</div>
</nav>

		<!-- <div id="sessionExpiredModal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<div class="modal-body">
					<p>Your Session has been expired.</p>
				</div>
				<div class="modal-footer">
					<button id="modalCloseBtn" class="btn btn-secondary">OK</button>
				</div>
			</div>
		</div> -->
<!-- END nav -->
<!--End header-->

