<?php
$pageTitle = 'Cart';

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
require_once 'modules/manageCart/updatecart.php';
?>

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
							<input type="text" name="quantity[<?php echo $item['od_ID']; ?>]" class="quantity form-control input-number" 
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
							<button type="button" class="close close-btn" onclick="confirmDelete(<?php echo $item['od_ID'] . ',' . $item['order_ID']; ?>)">
								<span aria-hidden="true"><i class="fa fa-close"></i></span>
							</button>
						</td>
				</tr>
				<?php
				$no += 1;
			}
		} else {
			// Nếu giỏ hàng trống
			echo "<tr><td colspan='7' style='text-align: center;'>Your cart is empty</td></tr>";
		}
	} else {
		// Nếu không có giỏ hàng
		echo "<tr><td colspan='7' style='text-align: center;'>You do not have cart</td></tr>";
	}
}
?>

		<div id="ErrorModal" class="modal-warning">
          <div class="modal-content">
            <span class="msg-close">&times;</span>
            <div class="modal-body">
              <p>
                <?php 
                  $delmsg_success = 'Item has been deleted';
				  $delmsg_error = 'Something went wrong';
				  if (isset($_REQUEST['delete_success'])) {
					echo $delmsg_success;
				  }
				  else if (isset($_REQUEST['delete_error'])) {
					echo $delmsg_error;
				  }
                ?>
              </p>
            </div>
            <div class="modal-footer">
              <button id="modalOkBtn" class="btn btn-secondary">OK</button>
            </div>
          </div>
        </div>



<section class="hero-wrap hero-wrap-2" 
	style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
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
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row">
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
					<!-- Thêm trường input ẩn để lưu giá trị tổng số tiền của giỏ hàng -->
					<input type="hidden" id="total-price" name="total-price" value="">
                    <p class="d-flex total-price" id="cart-total">
						<?php
							// echo $totalPrice;
						?>
                        <span>Total</span>
                        <span>0 VND</span> <!-- Giá trị mặc định -->
                    </p>
                </div>
                <p class="text-center">
                    <button type="submit" name="checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
                </p>
            </div>
        </div>
    </form>
	</div>
</section>

<script src="js/handleJS/cart.js"></script>
<script type="text/javascript"> 
    // JavaScript
    document.addEventListener("DOMContentLoaded", function() {
    // Lấy modal
      var e_modal = document.getElementById('ErrorModal');

      // Lấy nút đóng modal
      var closeButton = document.getElementsByClassName('msg-close')[0];

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
include 'include/footer.php'
?>