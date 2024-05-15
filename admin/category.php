<?php
require_once './modules/categories/list.php';
$pageTitle = "Category";
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
                        Category
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



                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($listCategories)):
                                    $count = 0;
                                    foreach ($listCategories as $item):
                                        $count++;
                                ?>

                                <tr>
                                    <td class="text-center text-muted"><?php echo $count; ?></td>
                                    <td>
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img style="height: 50px; width:50px;" data-toggle="tooltip"
                                                    title="Image" data-placement="bottom"
                                                    src="<?php echo htmlspecialchars('../' . $item['cate_img_link']); ?>"
                                                    alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $item['cate_name']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $item['cate_desc']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


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