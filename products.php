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

// Tính toán offset
$offset = ($current_page - 1) * $products_per_page;

// Tính toán số lượng trang
if ((isset($_GET['type']) && !empty($_GET['type'])) || (isset($_GET['search']) && !empty($_GET['search'])) || (isset($_GET['minPrice']) && isset($_GET['maxPrice']))) {
    // Kiểm tra nếu có loại sản phẩm được chọn, từ khóa tìm kiếm hoặc giá được nhập
    if (isset($_GET['type']) && !empty($_GET['type'])) {
        // Đếm số lượng sản phẩm theo loại đã chọn
        $selectedTypes = $_GET['type'];
        $selectedTypes = is_array($selectedTypes) ? $selectedTypes : [$selectedTypes];
        
        $placeholders = implode(',', array_fill(0, count($selectedTypes), '?'));
        $total_products_sql = "SELECT COUNT(*) AS total FROM products WHERE cate_ID IN ($placeholders) AND prd_status = 1 OR prd_status = 3";
        $stmt = $conn->prepare($total_products_sql);
        $stmt->bind_param(str_repeat('i', count($selectedTypes)), ...$selectedTypes);
        $stmt->execute();
        $total_products_result = $stmt->get_result();
    } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
        // Đếm số lượng sản phẩm theo từ khóa tìm kiếm
        $search_query = $_GET['search'];
        $search_query = "%$search_query%";
        $total_products_sql = "SELECT COUNT(*) AS total FROM products WHERE prd_name LIKE ? AND prd_status = 1 OR prd_status = 3";
        $stmt = $conn->prepare($total_products_sql);
        $stmt->bind_param("s", $search_query);
        $stmt->execute();
        $total_products_result = $stmt->get_result();
    } elseif (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
        // Đếm số lượng sản phẩm theo khoảng giá
        $minPrice = $_GET['minPrice'];
        $maxPrice = $_GET['maxPrice'];
        $total_products_sql = "SELECT COUNT(*) AS total FROM products WHERE prd_price BETWEEN ? AND ? AND prd_status = 1 OR prd_status = 3";
        $stmt = $conn->prepare($total_products_sql);
        $stmt->bind_param("ii", $minPrice, $maxPrice);
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

// Xử lý dữ liệu khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selectedTypes = isset($_GET['type']) ? $_GET['type'] : [];
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : 0;
    $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : PHP_INT_MAX;

    // Tạo câu truy vấn dựa trên dữ liệu nhập từ form
    $sql = "SELECT prd_ID, prd_name, prd_img, prd_price, cate_ID FROM products WHERE 1=1";

    $sql .= " AND (prd_status = 1 OR prd_status = 3)";
    if (!empty($selectedTypes)) {
        $sql .= " AND cate_ID IN (" . implode(',', array_fill(0, count($selectedTypes), '?')) . ')';
    }

    if (!empty($searchQuery)) {
        $sql .= " AND prd_name LIKE ?";
    }

    if (!empty($minPrice)) {
        $sql .= " AND prd_price >= ?";
    }

    if (!empty($maxPrice)) {
        $sql .= " AND prd_price <= ?";
    }

    // Thêm LIMIT và OFFSET vào câu truy vấn
    $sql .= " LIMIT ? OFFSET ?";

    // Chuẩn bị và thực thi câu truy vấn
    $stmt = $conn->prepare($sql);

    // Bind các tham số (nếu cần)
    $bind_params = [];
    $bind_types = '';

    if (!empty($selectedTypes)) {
        $bind_params = array_merge($bind_params, $selectedTypes);
        $bind_types .= str_repeat('i', count($selectedTypes));
    }

    if (!empty($searchQuery)) {
        $search_query = "%$searchQuery%";
        $bind_params[] = $search_query;
        $bind_types .= 's';
    }

    if (!empty($minPrice)) {
        $bind_params[] = $minPrice;
        $bind_types .= 'i';
    }

    if (!empty($maxPrice)) {
        $bind_params[] = $maxPrice;
        $bind_types .= 'i';
    }

    // Thêm tham số LIMIT và OFFSET
    $bind_params[] = $products_per_page;
    $bind_params[] = $offset;
    $bind_types .= 'ii';

    // Bind parameters
    if (!empty($bind_params)) {
        $stmt->bind_param($bind_types, ...$bind_params);
    }

    // Thực thi câu truy vấn
    $stmt->execute();
    $result = $stmt->get_result();
}

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
        default:
            return 'Unknown';
            break;
    }
}

// Hiển thị tiêu đề banner
?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/fl_1.jpg'); background-color: #0005; background-blend-mode: darken;"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Products <i class="fa fa-chevron-right"></i></span></p>
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
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-4 d-flex">';
                            echo '<div class="product ftco-animate">';
                            echo '<a href="product-detail.php?prd_ID=' . $row["prd_ID"] . '">';
                            echo '<div class="img d-flex align-items-center justify-content-center" style="background-image: url(' . $row["prd_img"] . ');">';
                            echo '<div class="prd_desc">';
                            echo '<p class="meta-prod d-flex">';
                            // echo '<a href="product-detail.php?prd_ID=' . $row["prd_ID"] . '" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>';
                            echo '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '<div class="text text-center">';
                            echo '<span class="category">' . changeCateName($row["cate_ID"]). '</span>';
                            echo '<h2>' . $row["prd_name"] . '</h2>';
                            echo '<span class="name">' . number_format($row["prd_price"],0,",",".") . ' VND</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Product not found.";
                    }
                    ?>
                </div>
                <!-- Phân trang -->
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <?php
                        if ($total_pages > 1) {
                            if ($current_page > 1) {
                                echo "<li><a href='?page=".($current_page - 1).(isset($_GET['type']) ? '&type[]=' . implode('&type[]=', $selectedTypes) : '').(isset($_GET['search']) ? '&search=' . $_GET['search'] : '').(isset($_GET['minPrice']) ? '&minPrice=' . $_GET['minPrice'] : '').(isset($_GET['maxPrice']) ? '&maxPrice=' . $_GET['maxPrice'] : '')."'>«</a></li>";
                            } else {
                                echo "<li class='disabled'><span>«</span></li>";
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $current_page) {
                                    echo "<li class='active'><span>$i</span></li>";
                                } else {
                                    echo "<li><a href='?page=$i".(isset($_GET['type']) ? '&type[]=' . implode('&type[]=', $selectedTypes) : '').(isset($_GET['search']) ? '&search=' . $_GET['search'] : '').(isset($_GET['minPrice']) ? '&minPrice=' . $_GET['minPrice'] : '').(isset($_GET['maxPrice']) ? '&maxPrice=' . $_GET['maxPrice'] : '')."'>$i</a></li>";
                                }
                            }

                            if ($current_page < $total_pages) {
                                echo "<li><a href='?page=".($current_page + 1).(isset($_GET['type']) ? '&type[]=' . implode('&type[]=', $selectedTypes) : '').(isset($_GET['search']) ? '&search=' . $_GET['search'] : '').(isset($_GET['minPrice']) ? '&minPrice=' . $_GET['minPrice'] : '').(isset($_GET['maxPrice']) ? '&maxPrice=' . $_GET['maxPrice'] : '')."'>»</a></li>";
                            } else {
                                echo "<li class='disabled'><span>»</span></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Kết thúc phân trang -->
            </div>

            <!--Sidebar-->
        <div class="col-md-3">
            <form id="sidebar-form" action="" method="get">
                <!-- Chọn loại sản phẩm -->
                <div class="form-group">
                    <label for="type"><h3>Product Type</h3></label>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" name="type[]" id="type'.$row["cate_ID"].'" value="'.$row["cate_ID"].'"';
                            if (isset($_GET['type']) && in_array($row["cate_ID"], $_GET['type'])) {
                                echo ' checked';
                            }
                            echo '>';
                            echo '<label class="form-check-label" for="type'.$row["cate_ID"].'">'.$row["cate_name"].'</label>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>

                <!-- Tìm kiếm theo tên -->
                <div class="form-group">
                    <label for="search"><h3>Search by Name</h3></label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Enter product name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>

                <!-- Lọc theo giá -->
                <div class="form-group">
                    <h3>Filter Price</h3>
                    <div class="row">
                        <div class="col">
                            <input type="number" name="minPrice" id="minPrice" min="0" max="10000000" class="form-control" placeholder="From" value="<?php echo isset($_GET['minPrice']) ? $_GET['minPrice'] : ''; ?>">
                        </div>
                        <div class="col">
                            <input type="number" name="maxPrice" id="maxPrice" min="0" max="10000000" class="form-control" placeholder="To" value="<?php echo isset($_GET['maxPrice']) ? $_GET['maxPrice'] : ''; ?>">
                        </div>
                    </div>
                </div>

                <!-- Nút Apply -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </form>
        </div>
        <!--End sidebar-->

        </div>
</section>

<?php
include 'include/footer.php';
?>