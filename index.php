<?php

require_once('helpers/format.php');
require_once('lib/session.php');

// $session_test = setSession('hi', 'qhuong');
// var_dump($session_test);

// removeSession('hi');
//echo getSession('hi');

// setFlashData('msg', 'cain dat thanh cong');
// echo getFlashData('msg');

// $module = _MODULE;
// $action = _ACTION;
// if(!empty($_GET['module'])){
// 	if(is_string($_GET['module'])){
// 		$module = trim($_GET['module']);
// 	}
// }

// if(!empty($_GET['action'])){
// 	if(is_string($_GET['action'])){
// 		$action = trim($_GET['action']);
// 	}
// }

// $path = 'modules/'. $module .'/'. $action. '.php';

// if(file_exists($path)){
// 	require_once($path);
// }
// else{
// 	require_once('modules/error/404notfound.php');
// }
?>

<?php
include 'include/header.php';
include 'include/banner.php';
include 'include/introduce.php';
?>

      <!--Start categories-->
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

		<section class="ftco-section ftco-no-pb">
			<div class="container">
				<div class="row">
				<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
						<a href="products.php?type%5B%5D=4">
							<div class="img" style="background-image: url(images/GraduationFlowers/SunnyDays.jpg);"></div>
							<h3>Graduation Flower</h3>
						</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
						<a href="products.php?type%5B%5D=1">
							<div class="img" style="background-image: url(images/GrandOpeningFlower/LuckyCharm.jpg);"></div>
							<h3>Grand Opening Flower</h3>
						</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
						<a href="products.php?type%5B%5D=3">
							<div class="img" style="background-image: url(images/ValentineFlower/BrightDay.jpg);"></div>
							<h3>Valentine Flower</h3>
						</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
						<a href="products.php?type%5B%5D=2">
							<div class="img" style="background-image: url(images/WeddingFlower/FirstLove.jpg);"></div>
							<h3>Wedding Flower</h3>
						</a>	
						</div>
					</div>

				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Our Delightful offerings</span>
            <h2>Tastefully Yours</h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-4 d-flex">
						<div class="product ftco-animate">
							<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/GraduationFlowers/Cozy.jpg);">
								<div class="desc">
									<p class="meta-prod d-flex">
										<a href="product-detail.php?prd_ID=TN009" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
									</p>
								</div>
							</div>
							<div class="text text-center">
							<span class="sale">Sale</span>
										<span class="category">Graduation Flowers</span>
										<h2>Cozy</h2>
										<p class="mb-0"><span class="price price-sale">750,000VND</span> <span class="price">580,000VND</span></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/GrandOpeningFlower/GoldenTime.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=TN004" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="seller">Best Seller</span>
										<span class="category">Grand Opening Flowers</span>
										<h2>Golden Time</h2>
										<span class="price">920,000VND</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/WeddingFlower/EnternalLove.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=DC004" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="new">New Arrival</span>
										<span class="category">The Wedding Flowers</span>
										<h2>Enternal Love</h2>
										<span class="price">640,000VND</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/GraduationFlowers/Gracias.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=TN010" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="category">Graduation Flowers</span>
										<h2>Gracias</h2>
										<span class="price">790,000VND</span>
									</div>
								</div>
							</div>

							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/WeddingFlower/FirstLove.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=DC005" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="category">The Wedding Flowers</span>
										<h2>First Love</h2>
										<span class="price">910,000VND</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/GraduationFlowers/MothersDream.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=TN001" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="category">Graduation Flowers</span>
										<h2>Mother's Dream</h2>
										<span class="price">700,000VND</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/ValentineFlower/TrueLove.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=VL004" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="category">Valentine Flowers</span>
										<h2>True Love</h2>
										<span class="price">790,000VND</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/WeddingFlower/OnlyLove.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=DC008" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="category">The Wedding Flowers</span>
										<h2>Only Love</h2>
										<span class="price">730,000VND</span>
									</div>
								</div>
							</div>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(images/GrandOpeningFlower/NewBegining.jpg);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<a href="product-detail.php?prd_ID=KT007" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="category">Grand Opening Flowers</span>
										<h2>New Beginning</h2>
										<span class="price">800,000VND</span>
									</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-4">
						<a href="products.php" class="btn btn-primary d-block">View All Products <span class="fa fa-long-arrow-right"></span></a>
					</div>
				</div>
			</div>
		</section>
		<!--End categories-->

<?php
include 'include/slider.php';
include 'include/footer.php';
?>
  
	