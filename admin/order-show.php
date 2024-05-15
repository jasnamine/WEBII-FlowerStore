<?php
require_once './modules/orders/detail.php';
$pageTitle = "View order";
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
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">
                        <h2 class="text-center mt-5">Order info</h2>
                        <hr>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-4 text-md-right col-form-label">
                                Customer
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_receiver'])) {
                                        echo $listOrders[0]['order_receiver'];
                                    } else {
                                        echo $listOrders[0]['customer_username'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-4 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_email'])) {
                                        echo $listOrders[0]['order_email'];
                                    } else {
                                        // Display customer email if order email is empty
                                        echo $listOrders[0]['customer_email'];
                                    }
                                    ?>

                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-4 text-md-right col-form-label">Phone</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_phone'])) {
                                        echo $listOrders[0]['order_phone'];
                                    } else {
                                        echo $listOrders[0]['customer_phone'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="company_name" class="col-md-4 text-md-right col-form-label">
                                City
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_city'])) {
                                        echo $listOrders[0]['order_city'];
                                    } else {
                                        echo $listOrders[0]['customer_city'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="street_address" class="col-md-4 text-md-right col-form-label">
                                District</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_district'])) {
                                        echo $listOrders[0]['order_district'];
                                    } else {
                                        echo $listOrders[0]['customer_district'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="town_city" class="col-md-4 text-md-right col-form-label">
                                Address</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_address'])) {
                                        echo $listOrders[0]['order_address'];
                                    } else {
                                        echo $listOrders[0]['customer_address'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="postcode_zip" class="col-md-4 text-md-right col-form-label">
                                Date</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    echo $listOrders[0]['order_date'];
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="payment_type" class="col-md-4 text-md-right col-form-label">Payment
                                method</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    echo $listOrders[0]['order_payment_method'];
                                    ?>

                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="status" class="col-md-4 text-md-right col-form-label">Status</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="mt-2">
                                    <?php
                                    echo $listOrders[0]['Status'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <a href="./order-status.php?id=' . $item['ID'] . '"></a>

                        <?php if($listOrders[0]['Status'] == "Pending" || $listOrders[0]['Status'] == "Accepted/Delivering"):?>
                        <div class=" position-relative row form-group">
                            <label for="status" class="col-md-4 text-md-right col-form-label">Action</label>
                            <div class="col-md-9 col-xl-8">
                                <?php
                                if ($listOrders[0]['Status'] == "Pending") {
                                    echo '<a href="./order-status.php?id=' . $listOrders[0]['order_ID'] . '&status=2"><button style="background-color: green;" class="btn btn-primary btn-sm mr-2">Accept/Delivering</button></a>';
                                    echo '<a href="./order-status.php?id=' . $listOrders[0]['order_ID'] . '&status=4"><button style="backround-gcolor: red;"  class="btn btn-primary btn-sm mr-2">Canceled</button></a>';
                                }

                                if ($listOrders[0]['Status'] == "Accepted/Delivering") {
                                    echo '<a href="./order-status.php?id=' . $listOrders[0]['order_ID'] . '&status=3"><button style="background-color: blue;" class="btn btn-primary btn-sm mr-2">Delivered</button></a>';
                                    echo '<a href="./order-status.php?id=' . $listOrders[0]['order_ID'] . '&status=4"><button style="background-color: red;" class="btn btn-primary btn-sm mr-2">Canceled</button></a>';
                                } else {
                                    echo '';
                                }
                                ?>



                            </div>
                        </div>
                        <?php endif;?>
                    </div>

                    <div class="table-responsive">

                        <!-- <h2 class="text-center">Products list</h2> -->
                        <hr>

                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
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
                                    <td><?php echo $item['od_ID']; ?></td>

                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;" data-toggle="tooltip" title="Image"
                                                            data-placement="bottom"
                                                            src="<?php  echo '../' . $item['od_img']; ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php  echo $item['od_name']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php  echo $item['od_quantity']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php  echo number_format($item['od_price'], 0, ',', '.'); ?></td>

                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>


                        </table>
                    </div>

                    <div class="table-responsive">
                        <hr>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>

                                    <th style="float: right; font-size: 20px; margin-right: 5%;">
                                        <?php  echo 'Order total: ' . ' ' . number_format($listOrders[0]['order_total_price'], 0, ',', '.'); ?>
                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
            <!-- <p style=" display: flex; justify-content: end;"><?php  echo $item['order_total_price']; ?></p> -->

        </div>
    </div>
    <!-- End Main -->

    <?php
include 'inc/footer.php';
?>