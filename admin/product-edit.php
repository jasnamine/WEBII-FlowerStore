<?php 
require_once './modules/products/edit.php';
require_once './modules/categories/list.php';
$pageTitle = "Edit product";
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
            </div>
        </div>

        <?php
        if(!empty($msgProE)){
            getMsg($msgProE, $msgTypeProE);
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="position-relative row form-group">
                                <label for="product_category"
                                    class="col-md-3 text-md-right col-form-label">Category</label>
                                <div class="col-md-9 col-xl-8">
                                    <select name="product_category" class="form-control">


                                        <?php
                                    foreach ($listCategories as $item) {
                                        if ($item['cate_ID'] == old('cate_ID', $old)) {
                                            // Output the selected option
                                            echo '<option value="' . $item['cate_ID'] . '" selected>' . $item['cate_name'] . '</option>';
                                        }
                                    }
                                    ?>

                                    </select>
                                    <?php echo form_error('product_category', '<span class="error">', '</span>', $errors); ?>
                                </div>

                            </div>

                            <div class="position-relative row form-group">
                                <label for="" class="col-md-3 text-md-right col-form-label">Images</label>
                                <div class="col-md-9 col-xl-8">
                                    <ul class="text-nowrap" id="images">

                                        <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">

                                            <button type="submit"
                                                onclick="return confirm('Do you really want to delete this item?')"
                                                class="btn btn-sm btn-outline-danger border-0 position-absolute">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <div style="width: 100%; max-height: 220px; overflow: hidden;">
                                                <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                    data-toggle="tooltip" title="Click to add image"
                                                    data-placement="bottom"
                                                    src="<?php echo '../' . old('prd_img', $old); ?>" alt="Add Image">

                                                <input name="image" type="file" onchange="changeImg(this);"
                                                    style="display: none;" accept="image/x-png,image/gif,image/jpeg"
                                                    class="image form-control-file">

                                            </div>
                                            <?php echo form_error('image', '<span class="error">', '</span>', $errors); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="name" id="name" placeholder="Name" type="text" name="name"
                                        value="<?php echo old('prd_name', $old); ?>" class="form-control" value="">
                                    <?php echo form_error('name', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>



                            <div class="position-relative row form-group">
                                <label for="price" class="col-md-3 text-md-right col-form-label">Price</label>
                                <div class="col-md-9 col-xl-8">
                                    <input name="price" id="price" placeholder="Price" type="text" class="form-control"
                                        value="<?php echo old('prd_price', $old); ?>">
                                    <?php echo form_error('price', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>




                            <div class="position-relative row form-group">
                                <label for="description"
                                    class="col-md-3 text-md-right col-form-label">Description</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea class="form-control" name="description" id="description" value=""
                                        placeholder="Description"><?php echo old('prd_description', $old); ?> 

                                    </textarea>
                                    <?php echo form_error('desc', '<span class="error">', '</span>', $errors); ?>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $productID ?>">

                            <div class=" position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <!-- <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Cancel</span>
                                    </a> -->

                                    <button type="submit" name="submit-btn"
                                        class="btn-shadow btn-hover-shine btn btn-primary">
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

    <?php
                include 'inc/footer.php';
                 ?>