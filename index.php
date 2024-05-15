<?php
$pageTitle = 'Flower Store';
require_once('helpers/format.php');
require_once('./lib/connect.php');

include 'include/header.php';
include 'include/banner.php';
include 'include/introduce.php';

// Query để lấy danh mục sản phẩm
$categories = getRow("SELECT * FROM categories");

?>

<!--Start categories-->
<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row">
            <?php foreach ($categories as $category) : ?>
                <div class="col-lg-3 col-md-3 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <a href="products.php?type%5B%5D=<?php echo $category['cate_ID']; ?>">
                            <div class="img" style="background-image: url(<?php echo $category['cate_img_link']; ?>);"></div>
                            <h3><?php echo $category['cate_name']; ?></h3>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End categories -->

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Our Delightful offerings</span>
                <h2>Tastefully Yours</h2>
            </div>
        </div>
        <div class="row">
            <?php
            // Query để lấy sản phẩm
            $products = getRow("SELECT p.prd_ID, p.prd_name, p.prd_img, p.prd_price, p.cate_ID, c.cate_name FROM products p JOIN categories c ON p.cate_ID = c.cate_ID ORDER BY p.cate_ID LIMIT 36");

            $grouped_products = [];
            foreach ($products as $product) {
                $grouped_products[$product['cate_ID']][] = $product;
            }

            // Hiển thị sản phẩm
            foreach ($grouped_products as $category_products) {
                $counter = 0;
                foreach ($category_products as $product) :
                    ?>
                    <div class="col-md-4 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center" style="background-image: url(<?php echo $product['prd_img']; ?>);">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="product-detail.php?prd_ID=<?php echo $product['prd_ID']; ?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                <span class="category"><?php echo $product['cate_name']; ?></span>
                                <h2><?php echo $product['prd_name']; ?></h2>
                                <?php if ($product['prd_price'] > 0) : ?>
                                    <span class="price"><?php echo number_format($product['prd_price'], 0, ",", ".") . " VND"; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $counter++;
                    // Hiển thị 3 sản phẩm cuối cùng của loại sản phẩm hiện tại
                    if ($counter == 3 && $product === end($category_products)) {
                        break;
                    }
                    // Hiển thị 2 sản phẩm đầu tiên của mỗi loại sản phẩm
                    if ($counter == 3) {
                        break;
                    }
                endforeach;
            }
            ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="products.php" class="btn btn-primary d-block">View All Products <span class="fa fa-long-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>
<!--End categories-->

<?php
include 'include/slider.php';
include 'include/footer.php';
?>
