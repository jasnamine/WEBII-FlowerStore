<?php
require_once './modules/products/list.php';
require_once './modules/products/add.php';
require_once './modules/products/delete.php';
require_once './modules/products/hide.php';
$pageTitle = "Product";



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
                        Product
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./product-create.php" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Create
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <?php
        if(!empty($msgA) ){
            getMsg($msgA, $msgAType);
        }
        ?>
                    <?php
        if(!empty($msgK) ){
            getMsg($msgK, $msgeType);
        }
        ?>

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
                                    <th class="text-center">No</th>
                                    <th class="text-center">ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>

                                    <th class="text-center">Price</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center"></th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (!empty($listProducts)):
                                    $count = 0;
                                    foreach ($listProducts as $item):
                                        $count++;
                                ?>

                                <tr>
                                    <td class=" text-center text-muted"><?php echo $count; ?></td>
                                    <td class="text-center text-muted"><?php echo $item['prd_ID']; ?></td>
                                    <td>
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img style="height: 50px; width: 50px;" data-toggle="tooltip"
                                                    title="Image" data-placement="bottom"
                                                    src="<?php echo htmlspecialchars('../' . $item['prd_img']); ?>"
                                                    alt="">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $item['prd_name']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $item['name_cate']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="text-center">
                                        <?php echo number_format($item['prd_price'], 0, ',', '.'); ?></td>
                                    <td class="text-center"><?php echo $item['prd_status']; ?></td>
                                    <td class="text-center">
                                        <a href="./product-show.php?id=<?php echo $item['prd_ID']?>"
                                            class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                        <a href="./product-edit.php?id=<?php echo $item['prd_ID']; ?>"
                                            data-toggle="tooltip" title="Edit" data-placement="bottom"
                                            class="btn btn-outline-warning border-0 btn-sm">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-edit fa-w-20"></i>
                                            </span>
                                        </a>

                                        <!-- <a href="product-hide.php?id=<?php echo $item['prd_ID']; ?>">
                                            <button class="btn btn-outline-danger" type="button"
                                                onclick="toggleVisibility(this.querySelector('.eyeIcon'))">
                                                <i class="eyeIcon fa fa-eye fa-w-20"></i>
                                            </button>
                                        </a> -->

                                        <a href="product-hide.php?id=<?php echo $item['prd_ID']; ?>"
                                            class="toggleVisibility" data-id="<?php echo $item['prd_ID']; ?>"
                                            data-status="<?php echo $item['prd_status']; ?>">
                                            <button class="btn btn-outline-danger" type="button">
                                                <i id="eyeIcon<?php echo $item['prd_ID']; ?>"
                                                    class="eyeIcon fa <?php echo $item['prd_status'] == '0' || $item['prd_status'] == '2' ? 'fa-eye-slash' : 'fa-eye'; ?> fa-w-20"></i>
                                            </button>
                                        </a>







                                    </td>
                                    <td>
                                        <?php if ($item['prd_status'] == 0 || $item['prd_status'] == 1 ): ?>
                                        <a href="product-delete.php?id=<?php echo $item['prd_ID']; ?>">
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                type="submit" data-toggle="tooltip" title="Delete"
                                                data-placement="bottom"
                                                onclick="return confirm('Do you really want to delete this item?')">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-trash fa-w-20"></i>
                                                </span>
                                            </button>
                                        </a>
                                        <?php else: ?>
                                        <a href="#" class="empty-link"></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <script>
                    function toggleVisibility(eyeIcon) {
                        if (eyeIcon.classList.contains('fa-eye')) {
                            if (confirm('Do you really want to hide this item?')) {
                                eyeIcon.classList.remove('fa-eye');
                                eyeIcon.classList.add('fa-eye-slash');
                                // Thực hiện hành động ẩn ở đây
                                console.log('Item hidden');
                            }
                        } else {
                            if (confirm('Do you really want to show this item?')) {
                                eyeIcon.classList.remove('fa-eye-slash');
                                eyeIcon.classList.add('fa-eye');
                                // Thực hiện hành động hiện ở đây
                                console.log('Item shown');
                            }
                        }
                    }
                    </script> -->

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Lưu trạng thái của sản phẩm trong biến JavaScript
                        var productStatus = {};
                        document.querySelectorAll('.toggleVisibility').forEach(function(link) {
                            var id = link.dataset.id;
                            var status = link.dataset.status;
                            productStatus[id] = status;
                            link.addEventListener('click', function(event) {
                                event
                                    .preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>
                                var confirmationMessage = productStatus[id] == '0' ||
                                    productStatus[id] == '2' ?
                                    'Do you really want to show this item?' :
                                    'Do you really want to hide this item?';

                                if (confirm(confirmationMessage)) {
                                    // Cập nhật trạng thái của sản phẩm sau mỗi lần click
                                    productStatus[id] = productStatus[id] == '0' ||
                                        productStatus[id] == '2' ? '1' : '0';
                                    // Thay đổi class của con mắt
                                    var eyeIcon = document.getElementById('eyeIcon' + id);
                                    eyeIcon.classList.toggle('fa-eye');
                                    eyeIcon.classList.toggle('fa-eye-slash');
                                    // Thực hiện redirect
                                    window.location.href = link.href;
                                }
                            });
                        });
                    });
                    </script>




                    <?php
include 'inc/footer.php';
?>