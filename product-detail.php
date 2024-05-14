<?php
$pageTitle = 'View Product';

ob_start();
include 'include/header.php';
?>

<?php
require_once 'modules/manageCart/addCart.php';

if (isset($_GET['prd_ID'])) {
    $prd_ID = $_GET['prd_ID'];

    // Truy vấn database để lấy thông tin sản phẩm dựa trên prd_ID
    $sql = "SELECT * FROM products WHERE prd_ID = '$prd_ID'";
    $product = oneRow($sql);

    if ($product) {
        $product_detail = json_decode($product['prd_detail'], true);
		$error_msg = "Product has already in your cart!";
		$success_msg = "Product has been added!";
        ?>

		<div id="ErrorModal" class="modal-warning">
          <div class="modal-content">
            <span class="error-close">&times;</span>
            <div class="modal-body">
              <p>
                <?php 
                  if (isset($_REQUEST['add_error'])){
                    // Hiển thị thông báo lỗi (can not add to cart)
                    echo $error_msg; 
                  } 
                  else if (isset($_REQUEST['add_success'])){ 
                    // Hiển thị thông báo thành công (added successfully)
                    echo $success_msg;
                  }
                ?>
              </p>
            </div>
            <div class="modal-footer">
              <button id="modalOkBtn" class="btn btn-secondary">OK</button>
            </div>
          </div>
        </div>

		<!-- Mã HTML để hiển thị thông tin chi tiết sản phẩm -->
		<!--Start banner-->
		<section class="hero-wrap hero-wrap-2" 
			style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
			data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-end justify-content-center">
					<div class="col-md-9 ftco-animate mb-5 text-center">
						<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
										class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i
										class="fa fa-chevron-right"></i></a></span> <span>Products Single <i
									class="fa fa-chevron-right"></i></span></p>
						<h2 class="mb-0 bread">Product's detail</h2>
					</div>
				</div>
			</div>
		</section>
		<!--End banner-->

		<section class="ftco-section">
		<form method="post">
            <input type="hidden" name="prd_ID" value="<?php echo $prd_ID; ?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 mb-5 ftco-animate">
						<a href="<?php echo $product['prd_img']; ?>" class="image-popup prod-img-bg">
						<img src="<?php echo $product['prd_img']; ?>" class="img-fluid" 
							 alt="<?php echo $product['prd_name']; ?>">
						</a>
					</div>
					<div class="col-lg-6 product-details pl-md-5 ftco-animate">
						<h3><?php echo $product['prd_name']; ?></h3>
						<p><span>Designed With: </span></p>
                		<?php
                        echo "<ul>";
                        foreach ($product_detail as $key => $value) {
                            echo "<li><strong>$key:</strong> $value</li>";
                        }
                        echo "</ul>";
                        ?>
						<p class="price" style="font-size: 18px;">
							<span class="price-value">
								<?php echo '<span class="name">' . number_format($product["prd_price"],0,",",".") . ' VND</span>'; ?>
							</span>
						</p>

						<div class="row mt-4">
							<div class="input-group col-md-6 d-flex mb-3">
								<span class="input-group-btn mr-2">
									<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
										<i class="fa fa-minus"></i>
									</button>
								</span>
								<input type="text" id="quantity" name="quantity" class="quantity form-control input-number"
									value="1" min="1" max="100" style="color: #b7472a;">
								<span class="input-group-btn ml-2">
									<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
										<i class="fa fa-plus"></i>
									</button>
								</span>
							</div>
							<div class="w-100"></div>
						</div>
						<p>
							<button type="submit" name="add_to_cart" class="btn btn-primary px-5 mr-2">Add to Cart</button>
                            <button type="submit" name="buy_now" class="btn btn-primary px-5">Buy now</button>
						</p>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-md-12 nav-link-wrap">
						<div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist"
							aria-orientation="vertical">
							<a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill"
								href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>
						</div>
					</div>
					<div class="col-md-12 tab-wrap">
						<div class="tab-content bg-light" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
								aria-labelledby="v-pills-1-tab">
								<div class="p-4">
									<h3 class="mb-4"><?php echo $product['prd_name']; ?></h3>
									<p><?php echo $product['prd_description']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>	
		</section>
		<script type="text/javascript"> 
		// JavaScript
		document.addEventListener("DOMContentLoaded", function() {
			// Lấy modal
			var e_modal = document.getElementById('ErrorModal');

			// Lấy nút đóng modal
			var closeButton = document.getElementsByClassName('error-close')[0];

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
    } else {
        // Hiển thị thông báo nếu không tìm thấy sản phẩm
        // echo "Không tìm thấy thông tin sản phẩm.";
		header("Location: index.php");
    }
} else {
    // Hiển thị thông báo nếu không có prd_ID trên URL
    // echo "Không có thông tin sản phẩm.";
	header("Location: index.php");
}
?>

<?php
include 'include/footer.php';
?>