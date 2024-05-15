<?php
$pageTitle = 'My Account';

ob_start();
include 'include/header.php';
?>

<?php
require_once 'lib/session.php';
require_once 'lib/database.php';
require_once 'helpers/format.php';
?>

<?php
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
// Xử lí cập nhật thông tin customer
require "modules/auth/updatecustomer.php";

$update_success_msg = "Update information successfully!";
$update_error_msg = "There was an error updating!";
?>

<?php
    //Xử lí logout
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        destroySession();
        ob_end_flush();
    }
?>

<?php

    // Hàm hiển thị danh sách hóa đơn
    function displayOrders($username) {
    // Lấy danh sách hóa đơn của người dùng
    $orders = getAllOrders($username);

    // Kiểm tra nếu có hóa đơn
    if ($orders) {
        $no=1;
        foreach ($orders as $order) {
            $orderDate = date("d/m/Y", strtotime($order['order_date']));
            $orderTotal = number_format($order['order_total_price'], 0, ',', '.');
            switch ($order['order_status']) {
                case 1:
                    $orderStatus = 'Checkout / Pending';
                    break;
                case 2:
                    $orderStatus = 'Delivering';
                    break;
                case 3:
                    $orderStatus = 'Delivered';
                    break;
                case 4:
                    $orderStatus =  'Canceled';
                    break;
            }
            // Hiển thị thông tin của từng hóa đơn trong bảng
            echo "<tr>";
            echo "<td><a href='order_detail.php?order_ID={$order['order_ID']}'>$no</a></td>";
            echo "<td>{$orderDate}</td>";
            echo "<td>{$orderTotal} VND</td>";
            echo "<td>{$orderStatus}</td>";
            echo "</tr>";
            $no+= 1;
        }
    } else {
        // Hiển thị thông báo nếu không có hóa đơn
        echo "<tr><td colspan='4'>No orders found</td></tr>";
    }
}
?>

<div id="ErrorModal" class="modal-warning">
    <div class="modal-content">
        <span class="error-close">&times;</span>
        <div class="modal-body">
            <p>
                <?php 
                  if (isset($_REQUEST['update_success'])){
                    // Hiển thị thông báo cập nhật thông tin thành công
                    echo $update_success_msg; 
                  } 
                  else if (isset($_REQUEST['update_error'])) {
                    // Hiển thị thông báo lỗi
                    echo $update_error_msg;
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
                    <span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span>My account <i class="fa fa-chevron-right"></i></span>
                </p>
                <h2 class="mb-0 bread">My account</h2>
            </div>
        </div>
    </div>
</section>

<!-- My Account Start -->
<div class="my-account">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-nav" data-toggle="pill" href="#account-tab" role="tab" aria-selected="true">Account Details</a>
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab">Orders</a>
                    <a class="nav-link" href="?action=logout">Logout</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                        <div class="table-responsive" id="OrderTable">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Product</th> -->
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php displayOrders($username); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Cần bao gồm thư viện jQuery trước khi sử dụng -->
                    <script src="js/jquery.min.js"></script>

                    <div class="tab-pane fade show active" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                        <h4>Account Details</h4>
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
                        <!-- Start Form -->
                        <form id="update_form" name="update_form" action="" method="POST" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="username" name="username" class="input-account" type="text"
                                        placeholder="Username" value="<?php echo $usernameValue?>" disabled />
                                </div>
                                <div class="col-md-6">
                                    <input id="fullname" name="fullname" class="input-account" type="text"
                                        placeholder="Full Name" value="<?php echo $fullnameValue?>" />
                                </div>
                                <div class="col-md-6">
                                    <input id="email" name="email" class="input-account" type="text" placeholder="Email"
                                        value="<?php echo $emailValue?>" />
                                </div>
                                <div class="col-md-6">
                                    <input id="phone" name="phone" class="input-account" type="text" placeholder="Phone"
                                        value="<?php echo $phoneValue?>" />
                                </div>
                                <div class="col-md-12">
                                    <input id="address" name="address" class="input-account" type="text"
                                        placeholder="Address" value="<?php echo $addressValue?>" />
                                </div>
                                <div class="col-md-6">
                                    <select id="city" name="city" class="input-account">
                                        <option value="">Choose City</option>
                                        <?php
                                            $cities = ['Hà Nội' => 'Hà Nội', 'TPHCM' => 'TPHCM'];
                                            foreach ($cities as $key => $value) {
                                                echo '<option value="' . $key . '"' . ($cityValue == $key ? ' selected' : '') . '>' . $value . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6" id="district_container"
                                    style="<?= (empty($districtValue) ? 'display: none;' : 'display: flex;'); ?>">
                                    <select id="district" name="district" class="input-account">
                                        <?php if (!empty($districtValue)): ?>
                                        <option value="<?= $districtValue; ?>">
                                            <?= $districtValue; ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <!-- Sử dụng method GET để truyền dữ liệu -->
                                <button id="update_submit" class="button-account" value="submit">Update Account</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                    <?php 
                                // if (isset($_REQUEST['update_success']) || isset($_REQUEST['update_error'])) {
                                //     echo $cityValue;
                                //     echo '<br>';
                                //     echo $districtValue;
                                //     echo '<br>';
                                // }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/handleJS/update_validation.js"></script>
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
    <?php if (isset($_REQUEST['update_success']) || isset($_REQUEST['update_error'])): ?>
    e_modal.style.display = "block";
    <?php endif; ?>
});
</script>
<script>
// Load thông tin khách hàng khi trang được tải
$(document).ready(function() {
    // Lấy giá trị thành phố và quận huyện từ PHP và gán trực tiếp vào các trường input/select
    $('#city').val("<?php echo $cityValue; ?>").trigger('change');
    $('#district').val("<?php echo $districtValue; ?>");
});

// JavaScript jquery để show hoặc hide district tương ứng với city đã chọn
$('#city').change(function() {
    var city = $(this).val();
    var districtContainer = $('#district_container');
    var districtSelect = $('#district');

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
                'Hoàng Mai',
                'Long Biên', 'Hà Đông', 'Tây Hồ', 'Nam Từ Liêm', 'Bắc Từ Liêm'
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
</script>
<!-- My Account End -->

<?php
include 'include/footer.php';
?>