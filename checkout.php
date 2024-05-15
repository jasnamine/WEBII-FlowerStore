<?php
$pageTitle = 'Checkout';

ob_start();
include 'include/header.php';

checkSession('username');

?>

<?php
require_once 'modules/manageOrder/processcheckout.php';
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

<?php
    if ($cart && $totalItems >0) {
?>

<section class="hero-wrap hero-wrap-2"
    style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
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
			<!--Start form-->
			<form method="post" class="billing-form" id="checkout_form" name="checkout_form">
            	<div class="col-xl-10 ftco-animate">
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input id="fullname" name="fullname" type="text" class="form-control" placeholder="example: Andrew Lee" value="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="example: 0123-456-789 (10 digits)" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="example: andrew@mail.com" value="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Street Address</label>
                                <input id="address" name="address" type="text" class="form-control"
                                    placeholder="House number and street name (example: 18 Hai Ba Trung)" value="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <div class="select-wrap">
                                    <!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div> -->
                                    <select id="city" name="city" class="form-control">
                                        <option value="">Choose City</option>
                                        <?php
											$cities = ['Hà Nội' => 'Hà Nội', 'TPHCM' => 'TPHCM'];
											foreach ($cities as $key => $value) {
												echo '<option value="' . $key . '"' . ($cityValue == $key ? ' selected' : '') . '>' . $value . '</option>';
											}
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="district_container">
                            <div class="form-group">
                                <label for="district">District</label>
                                <div class="select-wrap">
                                    <!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div> -->
                                    <select id="district" name="district" class="form-control">
                                        <!-- <option value="">Choose District</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <label class="mr-3"><input type="radio" name="optradio" value="customer_opt"> Ship
                                        to yourself? </label>
                                    <label><input type="radio" name="optradio" value="new_opt"> Ship to different
                                        address?</label>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Cart Total</h3>
                            <hr>
                            <?php
							foreach($cartItems as $item) {
								echo '<p class="d-flex">';
								echo '<span class="mr-3">' . $item['od_name'] . '</span>';
								echo '<span class="ml-1">' . number_format($item['od_price'], 0, ',', '.') .  ' VND</span>';
								echo '<span>Qty:' . $item['od_quantity'] . '</span>';
								echo '</p>';
							}
							?>
                            <hr>
                            <p class="d-flex total-price">
								<span>Total</span>
                                <span><?php echo number_format($cart['order_total_price'], 0, ',', '.');?> VND</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-detail p-3 p-md-4">
							<h3 class="billing-heading mb-4">Payment Method</h3>
                            <hr>
                            <div class="form-group">
								<div class="col-md-12">
									<div class="radio">
										<label><input type="radio" name="optradio" class="mr-2" value="cod"> Cash (COD)
									</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
								<div class="col-md-12">
									<div class="radio">
										<label><input type="radio" name="optradio" class="mr-2" value="bank"> Bank Tranfer</label>
                                    </div>
                                </div>
                            </div>
                            <p><button id="checkout_submit" type="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                        </div>
                    </div>
                </div>
            </div>
		</form>
		<!-- End form -->
			
        </div>
    </div>
</section>
<?php
}
else {
    header('Location: cart.php');
    ob_end_flush();
}
?>
<script src="js/jquery.min.js"></script>
<script src="js/handleJS/checkout_validation.js"></script>

<?php
include 'include/footer.php'
?>

<script>
	// // Load thông tin khách hàng khi trang được tải
	$(document).ready(function() {
		// Lấy giá trị thành phố và quận huyện từ PHP và gán trực tiếp vào các trường input/select
		$('#city').val("").trigger('change');
		$('#district').val("");

		// // Ban đầu ẩn ô "district" nếu ô "city" không có giá trị
		// if ($('#city').val() === '') {
		//     $('#district_container').hide();
		// }
		// console.log('document Loading...');

		// var customerOpt = $('input[name="optradio"]:checked').val();
		// console.log('Customer option:' + customerOpt);
	});

	// Khi người dùng chọn "Ship to yourself?"
	$('input[name="optradio"][value="customer_opt"]').change(function() {

		// Gán giá trị từ biến user vào các trường dữ liệu tương ứng
		$('#fullname').val("<?php echo $fullnameValue; ?>");
		$('#phone').val("<?php echo $phoneValue; ?>");
		$('#email').val("<?php echo $emailValue; ?>");
		$('#address').val("<?php echo $addressValue; ?>");
		$('#city').val("<?php echo $cityValue; ?>").trigger('change');
		$('#district').val("<?php echo $districtValue; ?>");
	});

	// Khi người dùng chọn "Ship to different address"
	$('input[name="optradio"][value="new_opt"]').change(function() {
		// Xóa toàn bộ dữ liệu trên các trường dữ liệu
		$('#fullname').val("");
		$('#phone').val("");
		$('#email').val("");
		$('#address').val("");
		$('#city').val("").trigger('change');
		$('#district').empty();
	});

	// JavaScript jquery để show hoặc hide district tương ứng với city đã chọn
	$('#city').change(function() {
		var city = $(this).val();
		var districtContainer = $('#district_container');
		var districtSelect = $('#district');

		console.log('city: ' + city);

		// Clear previous options
		districtSelect.empty();

		if (city === "") {
			// If no city is selected, hide district container
			districtContainer.hide();
		} else {
			// Populate district options based on the selected city
			districtContainer.show();
			if (city === "TPHCM") {
				// Populate districts for Ho Chi Minh City
				var districts = ['Quận 1', 'Quận 3', 'Quận 4', 'Quận 5', 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 10',
					'Quận 11', 'Quận 12', 'Quận Bình Tân', 'Quận Bình Thạnh', 'Quận Gò Vấp', 'Quận Phú Nhuận',
					'Quận Tân Bình', 'Quận Tân Phú', 'Huyện Bình Chánh', 'Huyện Cần Giờ', 'Huyện Củ Chi',
					'Huyện Hóc Môn', 'Huyện Nhà Bè'
				]; // Districts for HCMC
				$.each(districts, function(index, district) {
					districtSelect.append($('<option>', {
						value: district,
						text: district
					}));
				});
			} else if (city === "Hà Nội") {
				// Populate districts for Hanoi
				var districts = ['Ba Đình', 'Cầu Giấy', 'Đống Đa', 'Hai Bà Trưng', 'Hoàn Kiếm', 'Thanh Xuân',
					'Hoàng Mai', 'Long Biên', 'Hà Đông', 'Tây Hồ', 'Nam Từ Liêm', 'Bắc Từ Liêm'
				]; // Districts for Hanoi
				$.each(districts, function(index, district) {
					districtSelect.append($('<option>', {
						value: district,
						text: district
					}));
				});
			}
		}
	});
	// $('#district').change(function() {
	// 	var district = $(this).val();
	// 	console.log('district:' + district);
	// });
</script>