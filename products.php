<?php
include 'include/header.php';
?>
<!--Start banner-->
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/fl_1.jpg');" data-stellar-background-ratio="0.5">
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
<!--End banner-->

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row mb-4">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h4 class="product-select">Select Types of Products</h4>
                        <form action="" method="get">
                            <?php
                            $selectedTypes = isset($_GET['type']) ? $_GET['type'] : [];
                            foreach ($selectedTypes as $type) {
                                echo '<input type="hidden" name="type[]" value="' . htmlspecialchars($type) . '">';
                            }
                            ?>
                            <select name="type[]" class="selectpicker" multiple onchange="this.form.submit()">
                                <option value="1" <?php if(isset($_GET['type']) && in_array('1', $_GET['type'])) echo 'selected'; ?>>Grand Opening Flowers</option>
                                <option value="2" <?php if(isset($_GET['type']) && in_array('2', $_GET['type'])) echo 'selected'; ?>>Wedding Flowers</option>
                                <option value="3" <?php if(isset($_GET['type']) && in_array('3', $_GET['type'])) echo 'selected'; ?>>Valentine Flowers</option>
                                <option value="4" <?php if(isset($_GET['type']) && in_array('4', $_GET['type'])) echo 'selected'; ?>>Graduation Flowers</option>
                            </select>
                        </form>
                    </div>
                </div>

				
                <div class="row">
                <?php

                // Kiểm tra xem đã có dữ liệu tìm kiếm từ ô search chưa
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search_query = $_GET['search'];

                    // Câu truy vấn SQL để tìm kiếm dữ liệu theo tên sản phẩm
                    $sql = "SELECT prd_ID, prd_name, prd_img, prd_price FROM products WHERE prd_name LIKE ?";
                    $search_query = "%$search_query%";
                    $result = getRow($sql, [$search_query]);

                    // Hiển thị kết quả tìm kiếm
                    if ($result) {
                        foreach ($result as $row) {
                            displayProduct($row);
                        }
                    } else {
                        echo "Không tìm thấy sản phẩm nào phù hợp.";
                    }
                }

                // Kiểm tra xem đã chọn loại hoa nào từ form chưa
                if (isset($_GET['type']) && !empty($_GET['type'])) {
                    $selectedTypes = $_GET['type'];
                    $selectedTypes = is_array($selectedTypes) ? $selectedTypes : [$selectedTypes];

                    // Tạo chuỗi dấu hỏi cho số lượng giá trị trong mảng $selectedTypes
                    $placeholders = implode(',', array_fill(0, count($selectedTypes), '?'));

                    // Tạo câu truy vấn dựa trên chuỗi dấu hỏi đã tạo
                    $sql = "SELECT prd_ID, prd_name, prd_img, prd_price FROM products WHERE cate_ID IN ($placeholders)";

                    // Thực hiện truy vấn SQL
                    $result = getRow($sql, $selectedTypes);

                    // Hiển thị kết quả truy vấn
                    if ($result) {
                        foreach ($result as $row) {
                            displayProduct($row);
                        }
                    } else {
                        echo "Không có sản phẩm nào trong loại này.";
                    }

                    // Truy vấn theo giá cả
                    if (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
                        $minPrice = intval($_GET['minPrice']);
                        $maxPrice = intval($_GET['maxPrice']);

                        // Câu truy vấn SQL để lấy sản phẩm theo giá cả
                        $sql = "SELECT prd_ID, prd_name, prd_img, prd_price FROM products WHERE CAST(prd_price AS UNSIGNED) >= ? AND CAST(prd_price AS UNSIGNED) <= ?";
                        $result = getRow($sql, [$minPrice, $maxPrice]);

                        // Hiển thị kết quả truy vấn
                        if ($result) {
                            foreach ($result as $row) {
                                displayProduct($row);
                            }
                        } else {
                            echo "Không có sản phẩm nào trong khoảng giá này.";
                        }
                    }
                }

                
                // Hàm hiển thị sản phẩm
                function displayProduct($row) {
                    $prd_price = $row["prd_price"];
    
                    // Định dạng số với dấu phân cách là dấu "."
                    $formatted_price = number_format($prd_price, 0, ',', '.');
                    echo '<div class="col-md-4 d-flex">';
                    echo '<div class="product ftco-animate">';
                    echo '<div class="img d-flex align-items-center justify-content-center" style="background-image: url(' . $row["prd_img"] . ');">';
                    echo '<div class="prd_desc">';
                    echo '<p class="meta-prod d-flex">';
                    echo '<a href="#" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag"></span></a>';
                    echo '<a href="#" class="d-flex align-items-center justify-content-center"><span class="flaticon-heart"></span></a>';
                    echo '<a href="#" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>';
                    echo '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="text text-center">';
                    echo '<h2>' . $row["prd_name"] . '</h2>';
                    echo '<span class="name">' . $formatted_price . ' VND' .'</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                </div>
                <!--Start page number-->
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                <li><a href="#">&lt;</a></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End page number-->
            </div>
            <!--End products-->

            <!--Start-->
            <div class="col-md-3">
                <div class="sidebar-box ftco-animate">
                    <!--Start filter by type-->
                    <div class="categories">
                        <h3>Product Types</h3>
                        <ul class="p-0">
                        <?php
                        // Lấy loại hoa từ cơ sở dữ liệu
                        $sql = "SELECT * FROM categories";
                        $result = getRow($sql);

                        if ($result) {
                            foreach ($result as $row) {
                                echo '<li><a href="?type[]=' . $row["cate_ID"] . '">' . $row["cate_name"] . ' <span class="fa fa-chevron-right"></span></a></li>';
                            }
                        }
                        ?>
                        </ul>
                    </div>
                    <!--End filter by type-->

                    <!--Start filter by price-->
                    <div class="categories">
                        <h3  class="mt-4 mb-2">Filter by Price</h3>
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
                    <!--End filter by price-->

                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'include/footer.php';
?>