<?php
require_once './modules/orders/detail.php';
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
                            <label for="name" class="col-md-3 text-md-right col-form-label">
                                Customer
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['oder_new-receiver'])) {
                                        echo $listOrders[0]['oder_new-receiver'];
                                    } else {
                                        echo $listOrders[0]['customer_username'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_new-email'])) {
                                        echo $listOrders[0]['order_new-email'];
                                    } else {
                                        // Display customer email if order email is empty
                                        echo $listOrders[0]['customer_email'];
                                    }
                                    ?>

                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    if (!empty($listOrders[0]['order_new-phone'])) {
                                        echo $listOrders[0]['order_new-phone'];
                                    } else {
                                        echo $listOrders[0]['customer_phone'];
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="company_name" class="col-md-3 text-md-right col-form-label">
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
                            <label for="street_address" class="col-md-3 text-md-right col-form-label">
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
                            <label for="town_city" class="col-md-3 text-md-right col-form-label">
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
                            <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">
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
                            <label for="payment_type" class="col-md-3 text-md-right col-form-label">Payment
                                method</label>
                            <div class="col-md-9 col-xl-8">
                                <p>
                                    <?php
                                    echo $listOrders[0]['order_payment-method'];
                                    ?>

                                </p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="status" class="col-md-3 text-md-right col-form-label">Status</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="badge badge-dark mt-2">
                                    <?php
                                    echo $listOrders[0]['Status'];
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Description</label>
                            <div class="col-md-9 col-xl-8">
                                <p>description</p>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <h2 class="text-center">Products list</h2>
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
                                                            src="<?php  echo $item['prd_img']; ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php  echo $item['prd_name']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php  echo $item['od_quantity']; ?>
                                    </td>
                                    <td class="text-center"><?php  echo $item['Total_Product']; ?></td>

                                </tr>

                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

    <?php
include 'inc/footer.php';
?>