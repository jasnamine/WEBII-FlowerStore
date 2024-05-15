<?php
require_once './modules/orders/filter.php';
$pageTitle = "Order";
?>
<?php
include 'inc/header.php';
?>

<div class="app-main__outer">

    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Order
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

            </div>
            <div class="page-title-wrapper">

            </div>
        </div>

        <div class="page-title-wrapper">
            <!-- Thêm nút "Filter" -->

            <button id="filterButton" class="btn btn-primary " style="margin-bottom: 2%;">

                <i class="pe-7s-filter icon-gradient bg-white" style="color: #ffffff"></i>
            </button>

            <!-- Form lọc -->
            <div class="" id="filterForm">
                <form method="post" class="row">
                    <!-- Các trường lọc -->
                    <div class="form-group col-md-2 ">
                        <label for="startDate">From:</label>
                        <input type="date" id="startDate" name="startDate" data-date="" data-date-format="YYYY MM DD"
                            value="<?php echo old('startDate', $old); ?>" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="endDate">To:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" data-date=""
                            value="<?php echo old('endDate', $old); ?>" data-date-format="YYYY MM DD">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Select status</option>
                            <!-- <option value="1">Pending</option>
                            <option value="2">Accepted/Delivering</option>
                            <option value="3">Delivered</option>
                            <option value="4">Canceled</option> -->
                            <?php
                                $statuses = ["1" => "Pending", "2" => "Accepted/Delivering", "3" => "Delivered", "4" => "Canceled"];
                                foreach ($statuses as $key => $value) {
                                    echo '<option value="' . $key . '"' . ($key == old('status', $old) ? ' selected' : '') . '>' . $value . '</option>';
                                }
                            ?>


                        </select>
                    </div>

                    <?php
                    // Danh sách các quận
                    $districts = array(

                        "Quận 1", "Quận 3", "Quận 4", "Quận 5", "Quận 6", "Quận 7", 
                        "Quận 8", "Quận 10", "Quận 11", "Quận 12",
                    );
                    ?>
                    <div class="form-group col-md-2">
                        <label for="district">District:</label>
                        <select id="district" name="district" class="form-control">
                            <option value="">Select district</option>

                            <?php foreach ($districts as $district): ?>
                            <option value="<?php echo $district; ?>"
                                <?php echo ($district == old('district', $old) ? ' selected' : ''); ?>>
                                <?php echo $district; ?></option>
                            <?php endforeach; ?>


                        </select>

                    </div>
                    <div class="form-group col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary ">Apply</button>
                    </div>
                </form>
            </div>

            <!-- <script>
            // Lấy thẻ div chứa form filter
            var filterForm = document.getElementById("filterForm");

            // Lấy nút "Filter"
            var filterButton = document.getElementById("filterButton");

            // Gắn sự kiện click cho nút "Filter"
            filterButton.addEventListener("click", function() {
                // Kiểm tra trạng thái hiện tại của form filter
                if (filterForm.style.display === "none") {
                    // Nếu form đang bị ẩn, hiển thị nó lên
                    filterForm.style.display = "block";
                } else {
                    // Nếu form đang hiển thị, ẩn nó đi
                    filterForm.style.display = "none";
                }
            });
            </script> -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">

                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Search everything"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Search
                                    </button>

                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">District</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($listOrders)):
                                    $count = 0;
                                    foreach ($listOrders as $item):
                                        $count++;
                                ?>

                                <tr>

                                    <td class="text-center text-muted"><?php  echo $item['ID']; ?></td>
                                    <td class="text-center text-muted"><?php  echo $item['Customer']; ?></td>
                                    <td class="text-center text-muted"><?php  echo $item['order_district']; ?></td>
                                    <td class="text-center text-muted"><?php  echo $item['Amount']; ?></td>
                                    <td class="text-center text-muted">
                                        <?php  echo number_format($item['order_total_price'], 0, ',', '.'); ?></td>


                                    <td class="text-center">
                                        <?php 
                                        // Hiển thị nút dựa trên trạng thái của đơn hàng
                                        switch ($item['Status']) {
                                            case 'Pending':
                                                echo '<span style="color: gray;">Pending</span>';
                                                break;
                                            case 'Accepted/Delivering':
                                                echo '<span style="color: green;">Accepted/Delivering</span>';
                                                break;
                                            case 'Delivered':
                                                echo '<span style="color: blue;">Delivered</span>';
                                                break;
                                            case 'Canceled':
                                                echo '<span style="color: red;">Canceled</span>';
                                                break;
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center text-muted"><?php  echo $item['order_date']; ?></td>


                                    <td class="text-center">
                                        <a href="./order-show.php?id=<?php echo $item['ID']; ?>"
                                            class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <script>
                    function formatDateInput(inputId) {
                        // Lấy giá trị ngày từ input
                        var dateString = document.getElementById(inputId).value;
                        // Tạo một đối tượng Date từ chuỗi ngày
                        var date = new Date(dateString);
                        // Lấy ngày, tháng, năm
                        var day = String(date.getDate()).padStart(2, '0');
                        var month = String(date.getMonth() + 1).padStart(2, '0');
                        var year = date.getFullYear();
                        // Chuyển đổi sang định dạng mới (YYYY-MM-DD)
                        var newDateFormat = year + '-' + month + '-' + day;
                        // Gán lại giá trị mới vào input
                        document.getElementById(inputId).value = newDateFormat;
                    }

                    // Gọi hàm formatDateInput khi giá trị trong input thay đổi
                    document.getElementById('startDate').addEventListener('change', function() {
                        formatDateInput('startDate');
                    });

                    document.getElementById('endDate').addEventListener('change', function() {
                        formatDateInput('endDate');
                    });
                    </script>
                    <?php
include 'inc/footer.php';
?>