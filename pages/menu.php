<?php
if(isset($_GET['dangxuat'])&&($_GET['dangxuat']==1)){
    unset($_SESSION['dangnhap']);
}
?>

<div class="menu">
            <ul class="list_menu">
                <li>
                <a href="index.php" class="logo-link">
                 <img src="../images/logo.png" alt="" class="logo-img">
                </a>
                </li>
                <li>
                    <a href="index2.php?quanly=danhmucsanpham&id=0">Cửa Hàng</a>
                </li>
                
                <li>
                    <a href="index2.php?quanly=giohang">Giỏ Hàng</a>
                </li>
               
                <?php
                if(isset($_SESSION['dangnhap'])){
                    ?>
                    <li>
                    <a href="index2.php?quanly=lichsudonhang">Lịch sử đơn hàng</a>
                    </li>
                    <li>
                    <a href="index2.php?dangxuat=1">Đăng xuất</a>
                    </li>
                    <li>
                    <a href="index2.php?quanly=doimk">Đổi mật khẩu</a>
                    </li>
                
                <?php
                }else{
                ?>
                    <li><a href="index2.php?quanly=dangnhap">Đăng nhập</a></li>
               <?php 
            }?>

             <li>
                    <a href="index2.php?quanly=lienhe">About</a>
                </li>
                <li>
                    <a href="index2.php?quanly=tintuc">sale</a>
                </li>
            </ul>
            
            
                   <p class="larger-font">
                    <form action="index.php?quanly=timkiem" method="POST">
                    <input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
                    <input type="submit" class="timkiem" name="timkiem" value="Tìm kiếm">
                    </form>
                </p>
                
        </div>
        