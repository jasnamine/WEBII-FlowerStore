<?php 
require_once './modules/users/edit.php';
require_once '../helpers/format.php';
$pageTitle = "Edit user";

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
        if(!empty($msgE)){
            getMsg($msgE, $msgEType);
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" action="user-edit.php">

                            <div class="position-relative row form-group">
                                <label for="username" class="col-md-3 text-md-right col-form-label">User name</label>
                                <div class="col-md-9 col-xl-8">

                                    <input disabled name="username" id="username" placeholder="User name" type="text"
                                        class="form-control" value="<?php echo old('customer_username', $old); ?>">

                                    <?php echo form_error('username', '<span class="error">', '</span>', $errors); ?>

                                </div>
                            </div>

                            <div class=" position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Fullname</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="fullname" id="fullname" placeholder="Full name" type="text"
                                        class="form-control" value="<?php echo old('customer_fullname', $old); ?>">

                                    <?php echo form_error('fullname', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="email" id="email" placeholder="Email" type="email" class="form-control"
                                        value="<?php echo old('customer_email', $old); ?>">

                                    <?php echo form_error('email', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="phone" id="phone" placeholder="Phone" type="tel" class="form-control"
                                        value="<?php echo old('customer_phone', $old); ?>">

                                    <?php echo form_error('phone', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="city" class="col-md-3 text-md-right col-form-label">City</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select city</option>
                                        <?php
                                        $cities = ['Hanoi' => 'Hà Nội', 'TPHCM' => 'TPHCM'];
                                        foreach ($cities as $key => $value) {
                                            echo '<option value="' . $key . '"' . ($old['customer_city'] == $key ? ' selected' : '') . '>' . $value . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group" id="districtGroup"
                                style="<?= (empty($old['customer_district']) ? 'display: none;' : 'display: flex;'); ?>">
                                <label for="district" class="col-md-3 text-md-right col-form-label">District</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="district" id="district" class="form-control">
                                        <?php if (!empty($old['customer_district'])): ?>
                                        <option value="<?= $old['customer_district']; ?>">
                                            <?= $old['customer_district']; ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="street_address" class="col-md-3 text-md-right col-form-label">Street
                                    Address</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="street_address" id="street_address" placeholder="Street Address"
                                        type="text" class="form-control"
                                        value="<?php echo old('customer_address', $old); ?>">
                                </div>
                            </div>



                            <input type="hidden" name="username" value="<?php echo $usernameID ?>">

                            <div class=" position-relative row form-group mb-1">
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

<script src="assets/scripts/jquery-3.2.2.min.js"></script>

<script>
$(document).ready(function() {
    // Dictionary of districts based upon city selection
    var districts = {
        'Hanoi': ['Ba Đình', 'Cầu Giấy', 'Đống Đa', 'Hai Bà Trưng', 'Hoàn Kiếm', 'Thanh Xuân', 'Hoàng Mai',
            'Long Biên', 'Hà Đông', 'Tây Hồ', 'Nam Từ Liêm', 'Bắc Từ Liêm'
        ],
        'TPHCM': ['Quận 1', 'Quận 3', 'Quận 4', 'Quận 5', 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 10',
            'Quận 11', 'Quận 12', 'Quận Bình Tân', 'Quận Bình Thạnh', 'Quận Gò Vấp', 'Quận Phú Nhuận',
            'Quận Tân Bình', 'Quận Tân Phú', 'Huyện Bình Chánh', 'Huyện Cần Giờ', 'Huyện Củ Chi',
            'Huyện Hóc Môn', 'Huyện Nhà Bè'
        ]
    };

    function updateDistricts(city) {
        // Clear the current district dropdown options
        $('#district').empty();

        // Populate the district dropdown based on the selected city
        if (districts[city]) {
            districts[city].forEach(function(district) {
                $('#district').append($('<option>', {
                    value: district,
                    text: district
                }));
            });
            // Show the district dropdown group
            $('#districtGroup').show();
        } else {
            // Hide the district dropdown group if no districts are available
            $('#districtGroup').hide();
        }
    }

    // City dropdown change event
    $('#city').change(function() {
        updateDistricts($(this).val());
    });

    // Initialize districts and set the default if available on document ready
    var initialCity = $('#city').val();
    if (initialCity) {
        updateDistricts(initialCity);
        // Set previously selected district if it exists
        $('#district').val('<?php echo $old['customer_district'] ?? ""; ?>');
    }
});
</script>