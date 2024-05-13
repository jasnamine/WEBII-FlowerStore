<?php
include 'include/header.php'
?>
    <?php
	// Kiểm tra xem prd_ID có được gửi từ trang trước không
	if (isset($_GET['prd_ID'])) {
		$prd_ID = $_GET['prd_ID'];

		// Kết nối CSDL
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "flowershop";
		$conn = new mysqli($servername, $username, $password, $database);

		// Kiểm tra kết nối
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Truy vấn database để lấy thông tin sản phẩm dựa trên prd_ID
		$sql = "SELECT * FROM products WHERE prd_ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $prd_ID);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$product_detail = json_decode($row['prd_detail'], true);
			// Hiển thị thông tin chi tiết của sản phẩm
			?>
			<!-- Mã HTML để hiển thị thông tin chi tiết sản phẩm -->
			<!--Start banner-->
			<section class="hero-wrap hero-wrap-2" style="background-image: url('images/fl_1.jpg');" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text align-items-end justify-content-center">
						<div class="col-md-9 ftco-animate mb-5 text-center">
							<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i class="fa fa-chevron-right"></i></a></span> <span>Products Single <i class="fa fa-chevron-right"></i></span></p>
							<h2 class="mb-0 bread">Product's detail</h2>
						</div>
					</div>
				</div>
			</section>
			<!--End banner-->

			<section class="ftco-section">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 mb-5 ftco-animate">
							<a href="<?php echo $row['prd_img']; ?>" class="image-popup prod-img-bg"><img src="<?php echo $row['prd_img']; ?>" class="img-fluid" alt="<?php echo $row['prd_name']; ?>"></a>
						</div>
						<div class="col-lg-6 product-details pl-md-5 ftco-animate">
							<h3><?php echo $row['prd_name']; ?></h3>
							<p><span>Designed With: </span></p>
							
							<?php
							echo "<ul>";
							foreach ($product_detail as $key => $value) {
								echo "<li><strong>$key:</strong> $value</li>";
							}
							echo "</ul>";
							?>
							<p class="price" style="font-size: 18px;"><span class="price-value"><?php echo '<span class="name">' . number_format($row["prd_price"]) . ' VND</span>'; ?></span></p>
							
							<div class="row mt-4">
								<div class="input-group col-md-6 d-flex mb-3">
									<span class="input-group-btn mr-2">
										<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
										<i class="fa fa-minus"></i>
										</button>
									</span>
									<input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100" style="color: #b7472a;">
									<span class="input-group-btn ml-2">
										<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
											<i class="fa fa-plus"></i>
										</button>
									</span>
								</div>
								<div class="w-100"></div>
								</div>
							<p><a href="cart.php" class="btn btn-primary py-3 px-5 mr-2">Add to Cart</a><a href="cart.php" class="btn btn-primary py-3 px-5">Buy now</a></p>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-md-12 nav-link-wrap">
							<div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>
							</div>
						</div>
						<div class="col-md-12 tab-wrap">
							<div class="tab-content bg-light" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
									<div class="p-4">
										<h3 class="mb-4"><?php echo $row['prd_name']; ?></h3>
										<p><?php echo $row['prd_description']; ?></p>
									</div>
								</div>
								</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		} else {
			// Hiển thị thông báo nếu không tìm thấy sản phẩm
			echo "Không tìm thấy thông tin sản phẩm.";
		}
	} else {
		// Hiển thị thông báo nếu không có prd_ID trên URL
		echo "Không có thông tin sản phẩm.";
	}
	$stmt->close();
?>

<?php
include 'include/footer.php'
?>