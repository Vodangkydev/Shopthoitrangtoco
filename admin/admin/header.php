<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý sản phẩm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_styl.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
        <link rel="icon" href="https://vuainnhanh.com/wp-content/uploads/2023/02/logo-van-lang-896x1024-1.png">
    </head>
    <body>
        <?php
        session_start();
        include '../connect_db.php';
        include '../function.php';
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        Xin chào, <span>Tocomenswear</span>
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../images/home1.png" />
                        <a href="../index.php">Trang chủ</a>
                        <img height="24" src="../images/logout.png" />
                        <a href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading">Admin Menu</div>
                        <div class="menu-items">
                            <ul>
                                <li><a href="danhmuc_listing.php">Doanh Mục</a></li>
                                <li><a href="lienhe.php">About</a></li>
                                <li><a href="product_listing.php">Sản phẩm</a></li>
                                <li><a href="donhang_listing.php">Đơn hàng</a></li>
                                <li><a href="slideshow.php">slide</a></li>

                            </ul>
                        </div>
                    </div>
                <?php } ?>