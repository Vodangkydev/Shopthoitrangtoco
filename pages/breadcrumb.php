<?php
$current_page = "Trang chủ";
if(isset($_GET['quanly'])){
    $quanly = $_GET['quanly'];
    switch($quanly){
        case 'danhmucsanpham':
            $current_page = "Cửa Hàng";
            break;
        case 'giohang':
            $current_page = "Giỏ Hàng";
            break;
        case 'sanpham':
            $current_page = "Chi tiết sản phẩm";
            break;
        case 'dangnhap':
            $current_page = "Đăng nhập";
            break;
        case 'dangky':
            $current_page = "Đăng ký";
            break;
        case 'lienhe':
            $current_page = "Liên hệ";
            break;
        case 'lichsudonhang':
            $current_page = "Lịch sử đơn hàng";
            break;
        default:
            $current_page = "Trang chủ";
    }
}
?>
<div class="breadcrumb">
    <div class="breadcrumb-container">
        <a href="index.php">Trang chủ</a>
        <span class="separator">/</span>
        <span class="current"><?php echo $current_page; ?></span>
    </div>
</div>

