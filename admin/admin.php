<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
$pageTitle = "Admin";

// truy vấn vào bảng admins
$listUsers = getRow("SELECT * FROM admins ORDER BY admin_username");

?>
<?php
include 'inc/header.php'
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
                        Admin
                        <div class="page-title-subheading">
                            View and manage.
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">


                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Username</th>
                                    <th class="text-center">Email</th>

                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Full name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        if(!empty($listUsers)):
                          $count = 0;
                          foreach($listUsers as $item):
                          $count++;
                        
                        ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $count; ?></td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" data-toggle="tooltip"
                                                            title="Image" data-placement="bottom"
                                                            src="assets/images/_default-user.png" alt="" />
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $item['admin_username'];?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $item['admin_email'];?></td>
                                    <td class="text-center"><?php echo $item['admin_phone'];?></td>
                                    <td class="text-center"><?php echo $item['admin_fullname'];?></td>

                                </tr>
                                <?php
                        endforeach;
                        endif;
                        ?>
                            </tbody>
                        </table>
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
</div>