<?php
require_once './modules/users/list.php';
require_once './modules/users/edit.php';
require_once './modules/users/add.php';
$pageTitle = "Flowershop";

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
                        User
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>



                <div class="page-title-actions">
                    <a href="./user-create.php" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Create
                    </a>
                </div>
            </div>
        </div>

        <?php
        if(!empty($mgs)){
            getMsg($mgs, $mgsType);
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">


                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Full Name</th>
                                    <th class="text-center">Email</th>

                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Active</th>
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
                                                    <div class="widget-heading"><?php echo $item['customer_username'];?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $item['customer_email'];?></td>

                                    <td class="text-center">
                                        <a href="./user-show.php?username=<?php echo $item['customer_username'];?>"
                                            class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                        <a href="./user-edit.php?username=<?php echo $item['customer_username'];?>"
                                            data-toggle="tooltip" title="Edit" data-placement="bottom"
                                            class="btn btn-outline-warning border-0 btn-sm">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-edit fa-w-20"></i>
                                            </span>
                                        </a>

                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        // Hiển thị nút dựa trên trạng thái của đơn hàng
                                        switch ($item['customer_status']) {
                                        case '1':
                                        echo '<a href="./ban.php?username='. $item['customer_username'] .'"
                                                onclick="return confirm(\'Do you really want to ban this customer?\')">
                                                <button class="btn btn-hover-shine btn-outline-secondary border-0 btn-sm">Ban</button>
                                              </a>';
                                        break;
                                        case '0':
                                        echo '<a href="./ban.php?username='. $item['customer_username'] .'"
                                                onclick="return confirm(\'Do you really want to unban this customer?\')">
                                                <button class="btn btn-hover-shine btn-outline-secondary border-0 btn-sm">Unban</button>
                                              </a>';
                                        break;
                                        }
                                        ?>
                                    </td>


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
<script type="text/javascript" src="./assets/scripts/handle/main.js"></script>


<?php
include 'inc/footer.php';
?>
</div>