<?php
require_once './modules/statistical/filter.php';
// require_once './modules/statistical/list.php';
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
                        Statistical
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
                            class="form-control">

                    </div>

                    <div class="form-group col-md-2">
                        <label for="endDate">To:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" data-date=""
                            data-date-format="YYYY MM DD">
                    </div>

                    <div class="form-group col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary ">Apply</button>
                    </div>
                </form>
            </div>

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
                                    <th class="text-center">ORDER NO</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Total</th>
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

                                    <td class="text-center text-muted"><?php  echo $count ; ?></td>
                                    <td class="text-center text-muted"><?php  echo $item['Customer']; ?></td>
                                    <th class="text-center"><?php echo $item['Total']; ?></th>


                                    <td class="text-center">
                                        <a href="./order-details.php?username=<?php echo $item['Customer']; ?>"
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