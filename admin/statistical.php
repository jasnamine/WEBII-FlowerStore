<?php
require_once './modules/statistical/filter.php';
//require_once './modules/statistical/list.php';
$pageTitle = "Statistical";

?><?php
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
                            View and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-title-wrapper">
            <!-- Thêm nút "Filter" -->


            <!-- Form lọc -->
            <div class="" id="filterForm">
                <form method="post" class="row">
                    <!-- Các trường lọc -->
                    <div class="form-group col-md-2">
                        <label for="startDate">From:</label>
                        <input type="date" id="startDate" name="startDate" data-date="" data-date-format="YYYY MM DD"
                            value="<?php echo old('startDate', $old); ?>" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="endDate">To:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" data-date=""
                            value="<?php echo old('endDate', $old); ?>" data-date-format="YYYY MM DD">
                    </div>

                    <div class="form-group col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">


                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($listOrders)): ?>
                                <?php $count = 0; ?>
                                <?php foreach ($listOrders as $item): ?>
                                <?php $count++; ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $count; ?></td>
                                    <td class="text-center text-muted"><?php echo $item['customer_username']; ?></td>
                                    <td class="text-center text-muted"><?php echo $item['customer_email']; ?></td>
                                    <td class="text-center text-muted"><?php echo $item['customer_phone']; ?></td>
                                    <td class="text-center"><?php echo number_format($item['Total'], 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="./order-details.php?username=<?php echo $item['customer_username']; ?>&startDate=<?php echo urlencode(old('startDate', $old)); ?>&endDate=<?php echo urlencode(old('endDate', $old)); ?>"
                                            class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php include 'inc/footer.php'; ?>