<?php 
$pageTitle = "View user";
include 'inc/header.php';
require_once './modules/users/detail.php';

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
                        User
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


                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">
                                Name
                            </label>
                            <div class="col-md-9 col-xl-8">

                                <p><?php echo $listUsers['customer_username'];?></p>

                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $listUsers['customer_email'];?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="fullname" class="col-md-3 text-md-right col-form-label">
                                Full name
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $listUsers['customer_fullname'];?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">Country</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $listUsers['customer_phone'];?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="city" class="col-md-3 text-md-right col-form-label">
                                City</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $listUsers['customer_city'];?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="district" class="col-md-3 text-md-right col-form-label">
                                District</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $listUsers['customer_district'];?></p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="street-address" class="col-md-3 text-md-right col-form-label">
                                Street Address</label>
                            <div class="col-md-9 col-xl-8">
                                <p><?php echo $listUsers['customer_address'];?></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
</div>

<?php
include 'inc/footer.php';
?>