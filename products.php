<?php
$pageTitle = 'All Products';

include 'include/header.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flowershop";

// Thực hiện kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Phân trang
$products_per_page = 6;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $products_per_page;

// Tính toán số lượng trang
if ((isset($_GET['type']) && !empty($_GET['type'])) || (isset($_GET['search']) && !empty($_GET['search']))) {
    // Kiểm tra nếu có loại sản phẩm được chọn hoặc có từ khóa tìm kiếm
    if (isset($_GET['type']) && !empty($_GET['type'])) {
        $selectedTypes = $_GET['type'];
        $selectedTypes = is_array($selectedTypes) ? $selectedTypes : [$selectedTypes];

        // Đếm số lượng sản phẩm theo loại đã chọn
        $placeholders = implode(',', array_fill(0, count($selectedTypes), '?'));
        $total_products_sql = "SELECT COUNT(*) AS total FROM products WHERE cate_ID IN ($placeholders)";
        $stmt = $conn->prepare($total_products_sql);
        $stmt->bind_param(str_repeat('i', count($selectedTypes)), ...$selectedTypes);
        $stmt->execute();
        $total_products_result = $stmt->get_result();
    } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
        // Đếm số lượng sản phẩm theo từ khóa tìm kiếm
        $search_query = $_GET['search'];
        $search_query = "%$search_query%";
        $total_products_sql = "SELECT COUNT(*) AS total FROM products WHERE prd_name LIKE ?";
        $stmt = $conn->prepare($total_products_sql);
        $stmt->bind_param("s", $search_query);
        $stmt->execute();
        $total_products_result = $stmt->get_result();
    }
} else {
    // Đếm số lượng sản phẩm tổng cộng
    $total_products_sql = "SELECT COUNT(*) AS total FROM products";
    $total_products_result = $conn->query($total_products_sql);
}

$total_products_row = $total_products_result->fetch_assoc();
$total_products = $total_products_row['total'];

$total_pages = ceil($total_products / $products_per_page);


function changeCateName($cate_ID) {
    switch ($cate_ID) {
        case 1:
            return 'Grand Opening Flower';
            break;
        case 2:
            return 'Wedding Flower';
            break;
        case 3:
            return 'Valetine Flower';
            break;
        case 4:
            return 'Graduation Flower';
            break;
    }
}

// Hiển thị tiêu đề banner
?>
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

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row mb-4">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h4 class="product-select">Select Types of Products</h4>
                        <form action="" method="get">
                            <?php
                            // Lấy các loại sản phẩm được chọn từ URL
                            $selectedTypes = isset($_GET['type']) ? $_GET['type'] : [];
                            ?>
                            <!-- Dropdown để chọn loại sản phẩm -->
                            <select name="type[]" class="selectpicker" multiple onchange="this.form.submit()">
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
                        $search_query = $_GET['search'];
                        $search_query = "%$search_query%";
                        $sql = "SELECT prd_ID, prd_name, prd_img, prd_price, cate_ID FROM products WHERE prd_name LIKE ? LIMIT $products_per_page OFFSET $offset";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $search_query);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
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
                                echo '<span class="category">' . changeCateName($row["cate_ID"]). '</span>';
                                echo '<h2>' . $row["prd_name"] . '</h2>';
                                echo '<span class="name">' . number_format($row["prd_price"],0,",",".") . ' VND</span>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "Không tìm thấy sản phẩm nào phù hợp.";
                        }
                    } else { // Hiển thị sản phẩm theo loại hoa
                        if (isset($_GET['type']) && !empty($_GET['type'])) {
                            $selectedTypes = $_GET['type'];
                            $selectedTypes = is_array($selectedTypes) ? $selectedTypes : [$selectedTypes];
                            $placeholders = implode(',', array_fill(0, count($selectedTypes), '?'));
                            $sql = "SELECT prd_ID, prd_name, prd_img, prd_price, cate_ID FROM products WHERE cate_ID IN ($placeholders) LIMIT $products_per_page OFFSET $offset";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param(str_repeat('i', count($selectedTypes)), ...$selectedTypes);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
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
                                    echo '<span class="category">' . changeCateName($row["cate_ID"]). '</span>';
                                    echo '<h2>' . $row["prd_name"] . '</h2>';
                                    echo '<span class="name">' . number_format($row["prd_price"],0,",",".") . ' VND</span>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "Không có sản phẩm nào trong loại này.";
                            }
                        } else { // Hiển thị tất cả sản phẩm
                            $sql = "SELECT prd_ID, prd_name, prd_img, prd_price, cate_ID FROM products LIMIT $products_per_page OFFSET $offset";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
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
                                    echo '<span class="category">' . changeCateName($row["cate_ID"]). '</span>';
                                    echo '<h2>' . $row["prd_name"] . '</h2>';
                                    echo '<span class="name">' . number_format($row["prd_price"],0,",",".") . ' VND</span>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
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
                                if ($current_page > 1) {
                                    echo "<li><a href='?page=".($current_page - 1).(isset($_GET['type']) ? '&type[]=' . implode('&type[]=', $selectedTypes) : '').(isset($_GET['search']) ? '&search=' . $_GET['search'] : '')."'>«</a></li>";
                                } else {
                                    echo "<li class='disabled'><span>«</span></li>";
                                }

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $current_page) {
                                        echo "<li class='active'><span>$i</span></li>";
                                    } else {
                                        echo "<li><a href='?page=$i".(isset($_GET['type']) ? '&type[]=' . implode('&type[]=', $selectedTypes) : '').(isset($_GET['search']) ? '&search=' . $_GET['search'] : '')."'>$i</a></li>";
                                    }
                                }

                                if ($current_page < $total_pages) {
                                    echo "<li><a href='?page=".($current_page + 1).(isset($_GET['type']) ? '&type[]=' . implode('&type[]=', $selectedTypes) : '').(isset($_GET['search']) ? '&search=' . $_GET['search'] : '')."'>»</a></li>";
                                } else {
                                    echo "<li class='disabled'><span>»</span></li>";
                                }
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
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
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

<?php
include 'include/footer.php';
?>