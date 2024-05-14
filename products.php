<?php
$pageTitle = 'All Products';

include 'include/header.php';
?>

<?php
// // Phân trang
// $products_per_page = 6;
// $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
// $offset = ($current_page - 1) * $products_per_page;

// // Tính toán số lượng trang
// if (isset($_GET['type']) && !empty($_GET['type'])) {
//     $selectedTypes = $_GET['type'];
//     $selectedTypes = is_array($selectedTypes) ? $selectedTypes : [$selectedTypes];
//     $total_products = countRows("SELECT COUNT(*) AS total FROM products WHERE cate_ID IN (" . implode(',', array_fill(0, count($selectedTypes), '?')) . ")", $selectedTypes);
// } else {
//     $total_products = countRows("SELECT COUNT(*) AS total FROM products");
// }

// $total_pages = ceil($total_products / $products_per_page);

?>


<?php
// Số sản phẩm muốn hiển thị trên mỗi trang
$productsPerPage = 6;

// Xác định trang hiện tại
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tìm kiếm sản phẩm
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = $_GET['search'];
    $totalProducts = getTotalProducts($search_query);
    $start = ($current_page - 1) * $productsPerPage;
    $products = searchProducts($search_query, $start, $productsPerPage);
} else { // Lọc sản phẩm theo phân loại
    if (isset($_GET['type']) && !empty($_GET['type'])) {
        $selectedTypes = $_GET['type'];
        $totalProducts = getTotalProducts('', $selectedTypes);
        $start = ($current_page - 1) * $productsPerPage;
        $products = filterProductsByType($selectedTypes, $start, $productsPerPage);
    } else { // Hiển thị tất cả sản phẩm
        $totalProducts = getTotalProducts();
        $start = ($current_page - 1) * $productsPerPage;
        $products = getRow("SELECT prd_ID, prd_name, prd_img, prd_price FROM products LIMIT $start, $productsPerPage");
    }
}

// Tính toán số trang
$totalPages = ceil($totalProducts / $productsPerPage);
?>

<?php
function displayProduct($row) {
    echo '<div class="col-md-4 d-flex">';
    echo '<div class="product ftco-animate">';
    echo '<div class="img d-flex align-items-center justify-content-center" style="background-image: url(' . $row["prd_img"] . ');">';
    echo '<div class="prd_desc">';
    echo '<p class="meta-prod d-flex">';
    echo '<a href="product-detail.php?prd_ID=' . $row["prd_ID"] . '" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>';
    echo '</p>';
    echo '</div>';
    echo '</div>';
    echo '<div class="text text-center">';
    echo '<h2>' . $row["prd_name"] . '</h2>';
    echo '<span class="name">' . number_format($row["prd_price"], 0, ',', '.') . ' VND</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>


<section class="hero-wrap hero-wrap-2" 
    style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Products <i class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">Products</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
                <div class="row mb-4">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h4 class="product-select">Select Types of Products</h4>
                        <form method="get">
                            <?php
                            // Lấy các loại sản phẩm được chọn từ URL
                            $selectedTypes = isset($_GET['type']) ? $_GET['type'] : [];
                            foreach ($selectedTypes as $type) {
                                echo '<input type="hidden" name="type[]" value="' . htmlspecialchars($type) . '">';
                            }
                            ?>
                            <!-- Dropdown để chọn loại sản phẩm -->
                            <select name="type[]" class="selectpicker" multiple onchange="updateQueryString()">
                                <option value="1" <?php if (in_array('1', $selectedTypes)) echo 'selected'; ?>>Grand Opening Flowers</option>
                                <option value="2" <?php if (in_array('2', $selectedTypes)) echo 'selected'; ?>>Wedding Flowers</option>
                                <option value="3" <?php if (in_array('3', $selectedTypes)) echo 'selected'; ?>>Valentine Flowers</option>
                                <option value="4" <?php if (in_array('4', $selectedTypes)) echo 'selected'; ?>>Graduation Flowers</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <?php
                    // Tìm kiếm sản phẩm
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        if (!empty($products)) {
                            foreach ($products as $row) {
                                displayProduct($row);
                            }
                        } else {
                            echo "Không tìm thấy sản phẩm nào phù hợp.";
                        }
                    } else { // Hiển thị sản phẩm theo loại hoa
                        if (isset($_GET['type']) && !empty($_GET['type'])) {
                            if (!empty($products)) {
                                foreach ($products as $row) {
                                    displayProduct($row);
                                }
                            } else {
                                echo "Không có sản phẩm nào trong loại này.";
                            }
                        } else { // Hiển thị tất cả sản phẩm
                            // Hiển thị sản phẩm
                            if (!empty($products)) {
                                foreach ($products as $product) {
                                    displayProduct($product);
                                }
                            } else {
                                echo "Không có sản phẩm nào.";
                            }
                        }
                    }
                    ?>
                </div>
                <!-- Phân trang -->
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                        <?php
                        // Tạo các nút phân trang
                        // Nút "Start"
                        if ($totalPages < 2) {
                            echo '<li><a href="products.php?page=1">&lt;&lt;</a></li>';
                        }

                        // Nút "Prev"
                        if ($current_page > 1) {
                            $prev_page = $current_page - 1;
                            echo '<li><a href="products.php?page=' . $prev_page . '">&lt;</a></li>';
                        }

                        // Các nút trang
                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($i == $current_page) {
                                echo '<li class="active"><span>' . $i . '</span></li>';
                            } else {
                                echo '<li><a href="products.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                        }

                        // Nút "Next"
                        if ($current_page < $totalPages) {
                            $next_page = $current_page + 1;
                            echo '<li><a href="products.php?page=' . $next_page . '">&gt;</a></li>';
                        }
                        
                        // Nút "End"
                        echo '<li><a href="products.php?page=' . $totalPages . '">&gt;&gt;</a></li>';

                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End phân trang -->
                
            </div>

            <!--Sidebar-->
            <div class="col-md-3">
                <!--Filter by type-->
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Product Types</h3>
                        <ul class="p-0">
                            <?php
                            $result = getRow("SELECT * FROM categories");
                            if (!empty($result)) {
                                foreach ($result as $row) {
                                    $type_link = '';
                                    if (isset($_GET['type']) && in_array($row["cate_ID"], $_GET['type'])) {
                                        $type_link = '?page=1&type[]=';
                                        foreach ($_GET['type'] as $type) {
                                            $type_link .= $type . '&type[]=';
                                        }
                                        $type_link = rtrim($type_link, '&type[]');
                                    } else {
                                        $type_link = '?page=1&type[]=' . $row["cate_ID"];
                                    }
                                    echo '<li><a href="' . $type_link . '">' . $row["cate_name"] . ' <span class="fa fa-chevron-right"></span></a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- End filter by type -->

                <!--Filter by price-->
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3 class="mt-4 mb-2">Filter by Price</h3>
                        <form class="row" method="get">
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control-price" name="minPrice" id="minPrice" placeholder="From" min="0" max="100000000">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control-price" name="maxPrice" id="maxPrice" placeholder="To" min="0" max="100000000">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--End filter by price-->
            </div>
            <!--End sidebar-->
        </div>
</section>

<script>
    function updateQueryString() {
        // Xóa các tham số GET cũ
        var url = window.location.href.split("?")[0];
        // Lấy các giá trị mới từ dropdown
        var selectedValues = [];
        var select = document.querySelector('select[name="type[]"]');
        var options = select && select.options;
        var opt;

        for (var i = 0, len = options.length; i < len; i++) {
            opt = options[i];

            if (opt.selected) {
                selectedValues.push(opt.value);
            }
        }

        if (selectedValues.length > 0) {
            // Thêm các giá trị mới vào URL
            url += "?type[]=" + selectedValues.join("&type[]=");
        }

        // Cập nhật URL
        window.location.href = url;
    }
</script>

<?php
include 'include/footer.php';
?>
