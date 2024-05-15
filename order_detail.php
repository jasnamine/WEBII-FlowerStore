<?php
$pageTitle = 'Order Details';

ob_start();
include 'include/header.php';
?>

<?php

?>

<?php
// Hàm hiển thị chi tiết món hàng
function displayOrderDetails($orderID) {

	// Lấy chi tiết món hàng trong giỏ hàng
	$orderDetails = getOrderDetails($orderID);

	// Duyệt qua từng món hàng và hiển thị thông tin
	$no = 1;
	foreach ($orderDetails as $item) {
		$item_price = $item["od_price"];

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
				</div>
			</td>
			<td class="price"><?php echo number_format($item_price, 0, ',', '.'); ?> VND</td>
			<td class="quantity">
				<div class="input-group">
					<input disabled type="text" name="quantity[<?php echo $item['od_ID']; ?>]" class="quantity form-control input-number" 
						value="<?php echo $item['od_quantity']; ?>" style="padding-left: 18px">
				</div>
			</td>

			<td class="total"><?php echo number_format($item['od_quantity'] * $item['od_price'], 0, ',', '.'); ?> VND</td>
		</tr>
		<?php
		$no += 1;
	}
		
}
?>

<?php
if(isset($_REQUEST['order_ID']) && (getOrder($_REQUEST['order_ID'],$username))){
	$get_orderID = $_REQUEST['order_ID'];
	$order = getOrder($_REQUEST['order_ID'],$username);
	
?>	
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
					<span>Order <i class="fa fa-chevron-right"></i></span>
				</p>
				<h2 class="mb-0 bread">Order Detail</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
	<form method="post">
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
						</tr>
					</thead>
					<tbody>
						<?php 
						displayOrderDetails($get_orderID); 
						?>
					</tbody>
				</table>
			</div>
		</div>

        <div class="row justify-content-end">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Order:</h3>
                    <hr>
                    <p class="d-flex total-price" id="cart-total">
                        <span>Total</span>
                        <span><?php echo number_format($order['order_total_price'],0,",",".")?> VND</span>
                    </p>
					<p class="d-flex total-price" id="cart-total">
                        <span>Status</span>
                        <span><?php 
						// Hiển thị dựa trên trạng thái của đơn hàng
						switch ($order['order_status']) {
							case 1:
								echo 'Checkout / Pending';
								break;
							case 2:
								echo 'Delivering';
								break;
							case 3:
								echo 'Delivered';
								break;
							case 4:
								echo 'Canceled';
								break;
						}
						?>
						</span>
                    </p>
                </div>
                <p class="text-center">
                    <button type="submit" name="checkout" class="btn btn-primary py-3 px-4">Cancel Order</button>
                </p>
            </div>
        </div>
	</form>
	</div>
</section>
<?php 
} else {
		header('Location: myaccount.php');
	}
?>


<?php 
include 'include/footer.php';
?>