<?php
require_once './modules/categories/list.php';

?>
<?php
require_once '../lib/session.php';
checkSession('adminlogin');

?>

<?php
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
  destroy();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $pageTitle; ?></title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description"
        content="This is an example dashboard (CodeLean) created using build-in elements and components." />

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link CSS của Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="./main.css" rel="stylesheet" />
    <link href="./my_style.css" rel="stylesheet" />
    <link href="../css/info.css" rel="stylesheet" />
    <style>
    .popup {
        position: absolute;
        top: 50px;
        /* Điều chỉnh khoảng cách từ top của trang */
        left: 50%;
        /* Đảm bảo modal được căn giữa trang */
        transform: translateX(-50%);
        z-index: 9999;
        /* Đảm bảo modal hiển thị trên cùng */
        /* Thêm các thuộc tính CSS khác cần thiết */
    }
    </style>


</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <!-- <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search" />
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/_default-user.png"
                                                alt="" />
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header mt-0 mb-0">
                                                <div class="dropdown-menu-header-inner ">
                                                    <div class="menu-header-image opacity-2"></div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    <img width="42" class="rounded-circle"
                                                                        src="assets/images/_default-user.png" alt="" />
                                                                </div>
                                                                <div style="color: #333;" class="widget-content-left">
                                                                    <div class="widget-heading">
                                                                        Admin


                                                                    </div>
                                                                    <div class="widget-subheading opacity-8">
                                                                        A short profile description
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">


                                                                    <button
                                                                        class="btn-pill btn-shadow btn-shine btn btn-focus">
                                                                        <a style='text-decoration: none; color: #fff;'
                                                                            href="?action=logout"> Logout</a>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <!-- <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div> -->
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Menu</li>

                            <li class="mm-active">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-plugin"></i>Applications
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'admin.php') echo 'class="mm-active"'; ?>
                                            href="./admin.php">
                                            <i class="metismenu-icon"></i>Admin
                                        </a>
                                    </li>
                                    <li>
                                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="mm-active"'; ?>
                                            href="./index.php">
                                            <i class="metismenu-icon"></i>Customer
                                        </a>
                                    </li>

                                    <li>
                                        <a href="./category.php">
                                            <i class="metismenu-icon"></i>Category
                                        </a>
                                    </li>

                                    <li>
                                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'product.php') echo 'class="mm-active"'; ?>
                                            href="./product.php">
                                            <i class="metismenu-icon"></i>Product
                                        </a>
                                    </li>

                                    <li>
                                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'order.php') echo 'class="mm-active"'; ?>
                                            href="./order.php">
                                            <i class="metismenu-icon"></i>Order
                                        </a>
                                    </li>





                                    <li>
                                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'statistical.php') echo 'class="mm-active"'; ?>
                                            href="./statistical.php">
                                            <i class="metismenu-icon"></i>Statistical
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded",
                    function() {
                        // Lưu trữ dropdown của product
                        var productDropdown = document.querySelector(
                            '.app-sidebar .mm-dropdown');

                        // Lắng nghe sự kiện click trên menu
                        var menuItems = document.querySelectorAll(
                            '.app-sidebar .vertical-nav-menu li');
                        menuItems.forEach(function(item) {
                            item.addEventListener('click',
                                function() {
                                    // Lấy tiêu đề của menu item được click
                                    var menuItemTitle = this
                                        .querySelector('a')
                                        .innerText.trim();

                                    // Kiểm tra nếu menu item được click là "Product"
                                    if (menuItemTitle ===
                                        'Product') {
                                        // Loại bỏ lớp mm-active khỏi tất cả các menu items
                                        menuItems.forEach(
                                            function(
                                                innerItem
                                            ) {
                                                innerItem
                                                    .classList
                                                    .remove(
                                                        'mm-active'
                                                    );
                                            });

                                        // Thêm lớp mm-active cho menu item được chọn
                                        this.classList.add(
                                            'mm-active');
                                    } else {
                                        // Ẩn dropdown của product khi click vào các menu item khác ngoại trừ Product
                                        productDropdown
                                            .classList
                                            .remove(
                                                'mm-show');
                                        productDropdown
                                            .lastElementChild
                                            .classList
                                            .remove(
                                                'mm-show');
                                    }
                                });
                        });
                    });
            </script>