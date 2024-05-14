<?php 
require_once './modules/users/add.php';
$pageTitle = "Create user";

?>
<?php include 'inc/header.php' ?>
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

        <?php
        if(!empty($mgs)){
            echo getMsg($mgs, $mgsType);
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post">

                            <div class="position-relative row form-group">
                                <label for="username" class="col-md-3 text-md-right col-form-label">User name</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="username" id="username" placeholder="User name" type="text"
                                        class="form-control" value="<?php echo old('username', $old); ?>">

                                    <?php echo form_error('username', '<span class="error">', '</span>', $errors); ?>

                                </div>
                            </div>

                            <div class=" position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Full
                                    name</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="fullname" id="fullname" placeholder="Full name" type="text"
                                        class="form-control" value="<?php echo old('fullname', $old); ?>">

                                    <?php echo form_error('fullname', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="email" id="email" placeholder="Email" type="email" class="form-control"
                                        value="<?php echo old('email', $old); ?>">

                                    <?php echo form_error('email', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="phone" id="phone" placeholder="Phone" type="tel" class="form-control"
                                        value="<?php echo old('phone', $old); ?>">

                                    <?php echo form_error('phone', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <!-- City and District Dropdowns -->
                            <div class="position-relative row form-group">
                                <label for="city" class="col-md-3 text-md-right col-form-label">City</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select City</option>
                                        <option value="Hanoi">Hà Nội</option>
                                        <option value="TPHCM">TPHCM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group" id="districtGroup" style="display: none;">
                                <label for="district" class="col-md-3 text-md-right col-form-label">District</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="district" id="district" class="form-control"></select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                    Street Address
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="street_address" id="street_address" placeholder="Street Address"
                                        type="text" class="form-control" value="">
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="password" class="col-md-3 text-md-right col-form-label">Password</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password" id="password" placeholder="Password" type="password"
                                        class="form-control" value="">

                                    <?php echo form_error('password', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="password_confirm" class="col-md-3 text-md-right col-form-label">Confirm
                                    Password</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="password_confirm" id="password_confirm" placeholder="Confirm Password"
                                        type="password" class="form-control" value="">

                                    <?php echo form_error('password_confirm', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <!-- <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Cancel</span>
                                    </a> -->

                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
</div>

<?php include 'inc/footer.php' ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#city').change(function() {
        var city = $(this).val();
        var districts = [];
        $('#district').empty();

        if (city === 'Hanoi') {
            districts = ['Select district',
                'Ba Đình', 'Cầu Giấy', 'Đống Đa',
                'Hai Bà Trưng', 'Hoàn Kiếm', 'Thanh Xuân',
                'Hoàng Mai', 'Long Biên', 'Hà Đông', 'Tây Hồ',
                'Nam Từ Liêm', 'Bắc Từ Liêm'
            ];
        } else if (city === 'TPHCM') {
            districts = ['Select district',
                'Quận 1', 'Quận 3', 'Quận 4', 'Quận 5',
                'Quận 6', 'Quận 7', 'Quận 8',
                'Quận 10', 'Quận 11', 'Quận 12',
                'Quận Bình Tân', 'Quận Bình Thạnh',
                'Quận Gò Vấp',
                'Quận Phú Nhuận', 'Quận Tân Bình',
                'Quận Tân Phú', 'Huyện Bình Chánh',
                'Huyện Cần Giờ', 'Huyện Củ Chi',
                'Huyện Hóc Môn', 'Huyện Nhà Bè'
            ];
        }

        if (districts.length > 0) {
            $('#districtGroup').show();
            $.each(districts, function(i, district) {
                $('#district').append($('<option>').text(
                    district).attr('value',
                    district));
            });
        } else {
            $('#districtGroup').hide();
        }
    });
});
</script>