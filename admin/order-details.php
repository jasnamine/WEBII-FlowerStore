<?php
require_once './modules/statistical/order-details.php';
$pageTitle = "View order";
include 'inc/header.php';
?>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Orders
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($groupedOrderDetails)): ?>
        <?php foreach ($groupedOrderDetails as $username => $orders): ?>
        <?php foreach ($orders as $orderID => $orderDetails): ?> <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">
                        <h2 class="text-center mt-5">Order info</h2>
                        <hr>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Full name</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_receiver']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_email']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_phone']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="company_name" class="col-md-3 text-md-right col-form-label">City</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_city']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="street_address" class="col-md-3 text-md-right col-form-label">District</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_district']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="town_city" class="col-md-3 text-md-right col-form-label">Address</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_address']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">Date</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_date']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="payment_type" class="col-md-3 text-md-right col-form-label">Payment
                                method</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $orderDetails[0]['order_payment_method']; ?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="status" class="col-md-3 text-md-right col-form-label">Status</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="badge badge-dark mt-2"><?php echo $orderDetails[0]['Status']; ?></div>
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
                                <?php foreach ($orderDetails as $detail): ?>
                                <tr>
                                    <td><?php echo $detail['od_ID']; ?></td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;" data-toggle="tooltip" title="Image"
                                                            data-placement="bottom"
                                                            src="<?php echo '../' . $detail['od_img']; ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $detail['od_name']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $detail['od_quantity']; ?></td>
                                    <td class="text-center">
                                        <?php echo number_format($detail['od_price'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <hr>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>

                                    <th style="float: right; font-size: 20px; margin-right: 5%;">
                                        <?php echo 'Order total: ' . number_format($orderDetails[0]['order_total_price'], 0, ',', '.'); ?>


                                    </th>
                                </tr>
                            </thead>

                        </table>
                    </div>



                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>