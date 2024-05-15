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
		
		// Truy vấn số lượng sản phẩm trong giỏ hàng của người dùng
		$cart = getCart($username);
		if($cart) {
			// Lấy số lượng sản phẩm trong giỏ hàng
			$cartItems = getCartItems($cart['order_ID']);
			$totalItems = count($cartItems);
		} else {
			$totalItems = 0;
		}
	} 

	?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title><?php echo $pageTitle?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/x-icon" href="images/favicon.ico">
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
		<link rel="stylesheet" href="css/mystyle.css">
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
									<a href="myaccount.php" class="mr-2" style="text-transform: none !important;">
										<i class="fa fa-user-circle"></i>
										<?php echo $username?>
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
		
	<!-- START nav -->
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">

			<a class="navbar-brand" href="index.php">Flower <span>store</span></a>
			<div class="order-lg-last btn-group">
				<form action="products.php" method="get">
					<div class="input-group">
						<input type="text" name="search" placeholder="Search.." style="color:#ffd700">
						<span class="input-group-btn">
							<button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			
				<?php if(isset($_SESSION['username'])): ?>
					<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="flaticon-shopping-bag"></span>
						<?php
						// Hiển thị số lượng sản phẩm
						if($totalItems > 0) {
							echo '<div class="d-flex justify-content-center align-items-center"><small>' . $totalItems . '</small></div>';
						}
						?>
					</a>
				<?php endif; ?>

					<div class="dropdown-menu dropdown-menu-right">
					<div class="cart-items-container">
					<?php if ($cart) {
						foreach($cartItems as $item) {
							echo '<div class="dropdown-item d-flex align-items-start" style= "background: white" onpointerenter="this.setAttribute(\'style\', \' background: #f0f0f0; cursor: pointer;\')" onpointerleave="this.setAttribute(\'style\', \'background: white\')" onclick="window.location=\'product-detail.php?prd_ID=' . $item['prd_ID'] . '\';">';
							echo '<div class="img" style="background-image: url(' . $item['od_img'] . ');"></div>';
							echo '<div class="text pl-3">';
							echo '<h4>' . $item['od_name'] . '</h4>';
							echo '<p class="mb-0"><span class="price">' . number_format($item['od_price'], 0, ',', '.') . ' VND </span><span class="quantity ml-3">Quantity: ' . $item['od_quantity'] . '</span></p>';
							echo '</div>';
							echo '</div>';
						}
					}
					?>
					</div>
						<a class="dropdown-item text-center btn-link d-block w-100" style="background: white" 
						onpointerenter="this.setAttribute(\'style\', \' background: #f0f0f0\')" onpointerleave="this.setAttribute(\'style\', \'background: white\')" href="cart.php">
						<?php
							if ($cart && $totalItems > 0) {
								echo 'View All';
							}
							else {
								echo 'No items on cart';
							}
						?>
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
						<li class="nav-item dropdown active"><a class="nav-link " href="products.php">Products</a></li>
					</ul>
				</div>
		</div>
	</nav>

	<!-- END nav -->
	<!--End header-->

