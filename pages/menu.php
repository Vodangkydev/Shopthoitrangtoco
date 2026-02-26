<?php
if(isset($_GET['dangxuat'])&&($_GET['dangxuat']==1)){
    unset($_SESSION['dangnhap']);
    unset($_SESSION['id_khachhang']);
}

// Lấy nhanh thông tin profile cho dropdown
$profile_name = '';
$profile_phone = '';
$profile_address = '';

if(isset($_SESSION['id_khachhang'])){
    $id_kh = $_SESSION['id_khachhang'];
    // Ưu tiên lấy từ bảng shipping nếu đã có
    $rs_shipping = mysqli_query($con,"SELECT name, phone, address FROM shipping WHERE id_dangky='$id_kh' LIMIT 1");
    if($rs_shipping && mysqli_num_rows($rs_shipping) > 0){
        $row_ship = mysqli_fetch_array($rs_shipping);
        $profile_name = $row_ship['name'];
        $profile_phone = $row_ship['phone'];
        $profile_address = $row_ship['address'];
    } else {
        // Nếu chưa có shipping thì lấy từ bảng khachhang
        $rs_kh = mysqli_query($con,"SELECT tenkhachhang, dienthoai, diachi FROM khachhang WHERE id='$id_kh' LIMIT 1");
        if($rs_kh && mysqli_num_rows($rs_kh) > 0){
            $row_kh = mysqli_fetch_array($rs_kh);
            $profile_name = $row_kh['tenkhachhang'];
            $profile_phone = $row_kh['dienthoai'];
            $profile_address = $row_kh['diachi'];
        }
    }
}
?>

<div class="menu">
    <div class="menu-container">
        <!-- Logo -->
        <div class="menu-logo">
            <a href="index.php" class="logo-link">
              
                <span class="logo-text">TOCO Menswear</span>
            </a>
        </div>
        
        <!-- Navigation Links -->
        <nav class="menu-nav">
            <ul class="list_menu">
            </ul>
        </nav>
        
        <!-- Right Side Actions -->
        <div class="menu-actions">
            <form action="index.php?quanly=timkiem" method="POST" class="search-form">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." name="tukhoa" class="search-input">
                <button type="submit" class="search-icon-btn" name="timkiem" title="Tìm kiếm">
                    🔍
                </button>
            </form>
            <a href="index.php?quanly=giohang" class="cart-icon" title="Giỏ hàng">
                🛒
                <?php 
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                    echo '<span class="cart-badge">'.count($_SESSION['cart']).'</span>';
                } else {
                    echo '<span class="cart-badge">0</span>';
                }
                ?>
            </a>
            <a href="index.php?quanly=yeuthichdanhsach" class="user-icon wishlist-icon" title="Sản phẩm yêu thích">♡</a>
            <?php if(isset($_SESSION['dangnhap'])){ ?>
                <div class="profile-menu">
                    <div class="user-icon logged-in profile-toggle" title="Tài khoản">👤</div>
                    <span class="profile-name"><?php echo isset($_SESSION['dangnhap']) ? htmlspecialchars($_SESSION['dangnhap']) : 'Tài khoản'; ?></span>
                    <span class="profile-caret">▼</span>
                    <div class="profile-dropdown">
                        <div class="profile-summary">
                            <div class="profile-summary-name">
                                <?php echo htmlspecialchars($profile_name ?: $_SESSION['dangnhap']); ?>
                            </div>
                            <?php if($profile_phone || $profile_address){ ?>
                                <div class="profile-summary-line">
                                    📞 <?php echo htmlspecialchars($profile_phone ?: 'Chưa có SĐT'); ?>
                                </div>
                                <div class="profile-summary-line profile-summary-address">
                                    📍 <?php echo htmlspecialchars($profile_address ?: 'Chưa có địa chỉ'); ?>
                                </div>
                            <?php } else { ?>
                                <div class="profile-summary-line">
                                    Chưa có thông tin nhận hàng
                                </div>
                            <?php } ?>
                            <a href="index.php?quanly=vanchuyen" class="profile-summary-action">
                                Cập nhật thông tin nhận hàng
                            </a>
                        </div>
                        <div class="profile-dropdown-divider"></div>
                        <a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a>
                        <a href="index.php?quanly=doimk">Đổi mật khẩu</a>
                        <a href="index.php?quanly=lienhe">Liên hệ</a>
                        <a href="index.php?dangxuat=1">Đăng xuất</a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="index.php?quanly=dangnhap" class="user-icon" title="Đăng nhập">🔑</a>
            <?php } ?>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const profileMenu = document.querySelector('.profile-menu');
    if(profileMenu){
        const toggle = profileMenu.querySelector('.profile-toggle');
        const caret = profileMenu.querySelector('.profile-caret');
        const nameEl = profileMenu.querySelector('.profile-name');
        const handleToggle = function(e){
            e.stopPropagation();
            profileMenu.classList.toggle('open');
        };
        [toggle, caret, nameEl].forEach(function(el){
            if(el){
                el.addEventListener('click', handleToggle);
            }
        });
        document.addEventListener('click', function(){
            profileMenu.classList.remove('open');
        });
        profileMenu.addEventListener('click', function(e){
            e.stopPropagation();
        });
    }
});
</script>