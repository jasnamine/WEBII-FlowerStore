	<?php
	ob_start();
	include 'include/header.php';
	?>


	<?php

	// echo isset($_SESSION['username']) ? "Chào mừng " . $_SESSION['username'] : "Không có người dùng";

	// Kiểm tra xem session 'username' đã tồn tại chưa và có giá trị không
	if (isset($_SESSION['username']) && !empty($_SESSION['username'])) 
	// if (checkSession('username'))
	{
		$username = getSession('username');
		// Nếu đã đăng nhập, hiển thị thông báo
		if (!authenticate_customer($username)) {
			// Tài khoản người dùng bị khóa, chuyển hướng đến trang đăng nhập lại với thông báo lỗi
			header("Location: login.php?error_active=1");
			removeSession('username');
			ob_end_flush();
			exit();
		}
	} 
	else {
		// Nếu chưa đăng nhập, chạy trang login
		// Chuyển hướng người dùng đến trang login.php
		header("Location: login.php");
		exit; // Đảm bảo không có mã PHP nào được thực thi sau khi chuyển hướng
	}
	?>



	<?php
	// Hàm truy vấn giỏ hàng của một khách hàng
	function getCart($username) {
		$sql = "SELECT * FROM orders WHERE customer_username = '$username' AND order_status = -1";
		return oneRow($sql);
	}

	// Hàm truy vấn chi tiết sản phẩm trong giỏ hàng
	function getCartItems($orderID) {
		$sql = "SELECT * FROM order_details WHERE order_ID = $orderID";
		return getRow($sql);
	}

	?>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate mb-5 text-center">
					<p class="breadcrumbs mb-0">
						<span class="mr-2">
							<a href="index.php">Home <i class="fa fa-chevron-right"></i></a>
						</span>
						<span>Cart <i class="fa fa-chevron-right"></i></span>
					</p>
					<h2 class="mb-0 bread">My Cart</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<?php

				// Hàm hiển thị chi tiết món hàng
				function displayCartItems($username) {
					// Lấy thông tin giỏ hàng của khách hàng
					$cart = getCart($username);

					// Kiểm tra xem khách hàng có giỏ hàng không
					if ($cart) {
						// Lấy ID của giỏ hàng để truy vấn chi tiết món hàng
						$orderID = $cart['order_ID'];

						// Lấy chi tiết món hàng trong giỏ hàng
						$cartItems = getCartItems($orderID);

						// Kiểm tra xem có món hàng trong giỏ hàng không
						if ($cartItems) {
							// Duyệt qua từng món hàng và hiển thị thông tin
							$no = 1;
							foreach ($cartItems as $item) {
								$item_price = $item["od_price"];
		
								// Định dạng số với dấu phân cách là dấu "."
								$formatted_price = number_format($item_price, 0, ',', '.');
								?>
								<tr class="alert" role="alert">
									<td>
										<label class="checkbox-wrap checkbox-primary">
											<a href="product-detail.php?<?php echo 'prd_ID=' . $item['prd_ID']?>"><?php echo $no?> </a>
										</label>
									</td>
									<td>
										<div class="img" style="background-image: url(<?php echo $item['od_img']; ?>);"></div>
									</td>
									<td>
										<div class="email">
											<span><?php echo $item['od_name']; ?></span>
											<!-- Thêm mô tả sản phẩm nếu cần -->
										</div>
									</td>
									<td class="price"><?php echo $formatted_price; ?> VND</td>
									<td class="quantity">
										<div class="input-group">
											<div class="input-group-prepend">
												<button class="btn btn-outline-secondary" type="button"
													onclick="decreaseQuantity(this)">-</button>
											</div>
											<input type="text" name="quantity" class="quantity form-control input-number"
												value="<?php echo $item['od_quantity']; ?>" min="1" max="100">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button"
													onclick="increaseQuantity(this)">+</button>
											</div>
										</div>
									</td>

									<td class="total">
										<?php echo number_format($item['od_quantity'] * $item['od_price'], 0, ',', '.'); ?>
										VND</td>
									<td>
										<button type="button" class="close" onclick="confirmDelete(<?php echo $item['prd_ID']; ?>)">
											<span aria-hidden="true"><i class="fa fa-close"></i></span>
										</button>
									</td>
								</tr>
								<?php
								$no += 1;
							}
						} else {
							// Nếu giỏ hàng trống
							echo "<tr><td colspan='7' style='text-align: center;'>Giỏ hàng của bạn đang trống.</td></tr>";
						}
					} else {
						// Nếu không có giỏ hàng
						echo "<tr><td colspan='7' style='text-align: center;'>Bạn chưa có giỏ hàng.</td></tr>";
					}
				}
				?>
				<!-- Sử dụng hàm để hiển thị chi tiết món hàng trong bảng -->
				<div class="table-wrap">
					<table class="table">
						<thead class="thead-primary">
							<tr>
								<th>No</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<!-- Gọi hàm để hiển thị chi tiết món hàng -->
							<?php displayCartItems($username); ?>
						</tbody>
					</table>
				</div>

			</div>
			<div class="row justify-content-end">
				<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Cart Totals</h3>
						<hr>
						<p class="d-flex total-price" id="cart-total">
							<span>Total</span>
							<span>$0.00</span> <!-- Giá trị mặc định -->
						</p>
					</div>
					<p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
					</p>
				</div>
			</div>
		</div>
	</section>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			updateCartTotal();

			// Lắng nghe sự kiện khi có số lượng thay đổi
			document.querySelectorAll('.quantity input').forEach(function(input) {
				input.addEventListener('change', function() {
					updateTotal(this); // Gọi hàm cập nhật giá trị cho sản phẩm đang thay đổi
				});
			});
		})

		// Hàm cập nhật giá trị tổng tiền cho từng sản phẩm
		function updateTotal(input) {
			var quantity = parseInt(input.value);
			var price = parseFloat(input.closest('tr').querySelector('.price').innerText.replace(/\D/g,
			'')); // Lấy giá trị giá sản phẩm và loại bỏ ký tự không phải là số
			var total = quantity * price;

			// Hiển thị giá trị tổng tiền với định dạng và đơn vị tiền tệ
			input.closest('tr').querySelector('.total').innerText = numberWithCommas(total) + ' VND';
			updateCartTotal();
		}

		// Hàm thêm dấu phân cách phần ngàn
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

		// Hàm cập nhật tổng giá trị của giỏ hàng
		function updateCartTotal() {
			var total = 0;
			document.querySelectorAll('.total').forEach(function(item) {
				var price = parseFloat(item.innerText.replace(/\D/g, ''));
				total += price;
			});

			// Cập nhật giá trị vào phần tổng của mục giỏ hàng
			document.getElementById('cart-total').querySelector('span:last-child').innerText = numberWithCommas(total) + ' VND';
		}

		// Hàm tăng giá trị quantity khi bấm nút "+"
		function increaseQuantity(button) {
			var input = button.parentElement.previousElementSibling;
			var currentValue = parseInt(input.value);
			input.value = currentValue + 1;
			updateTotal(input);
		}

		// Hàm giảm giá trị quantity khi bấm nút "-"
		function decreaseQuantity(button) {
			var input = button.parentElement.nextElementSibling;
			var currentValue = parseInt(input.value);
			if (currentValue > 1) {
				input.value = currentValue - 1;
				updateTotal(input);
			}
		}
	</script>

	<?php
	include 'include/footer.php'
	?>