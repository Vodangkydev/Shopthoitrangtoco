<?php
// Xác định trang hiện tại
if(isset($_GET['quanly'])){
    $tam = $_GET['quanly'];
} else{
    $tam = "";
}

// Những trang không cần sidebar, cho phép maincontent full màn hình
$pages_khong_sidebar = [
    'giohang',
    'vanchuyen',
    'thanhtoan',
    'hinhthucthanhtoan',
    'camon',
    'lichsudonhang',
    'xemdonhang',
    'dangnhap'
];

$main_class = in_array($tam, $pages_khong_sidebar) ? 'no-sidebar' : '';
?>

<div id="main" class="<?php echo $main_class; ?>">
           <?php
           // Chỉ hiển thị sidebar trên những trang không nằm trong danh sách $pages_khong_sidebar
           if(!in_array($tam, $pages_khong_sidebar)){
               include "./pages/sidebar/sidebar.php";
           }
           ?>
            <div class="maincontent">
            <?php
           if($tam=='danhmucsanpham'){
            include "main/danhmuc.php";
           }else if($tam=='giohang'){
            include "main/giohang.php";
           } 
           else if($tam=='lienhe'){
            include "main/lienhe.php";
           }else if($tam=='sanpham'){
            include "main/sanpham.php";
           }
           else if($tam=='dangky'){
            include "main/dangky.php";
           }
           else if($tam=='dangnhap'){
            include "main/dangnhap.php";
           }
           else if($tam=='timkiem'){
            include "main/timkiem.php";
           }
           else if($tam=='thanhtoan'){
            include "main/thanhtoan.php";
           }
           else if($tam=='vanchuyen'){
            include "main/vanchuyen.php";
           }
           else if($tam=='hinhthucthanhtoan'){
            include "main/hinhthucthanhtoan.php";
           }
           else if($tam=='camon'){
            include "main/camon.php";
           }
           else if($tam=='lichsudonhang'){
            include "main/lichsudonhang.php";
           }
        elseif($tam=='xemdonhang'){
            include("main/xemdonhang.php");
        }
        elseif($tam=='doimk'){
            include("main/doimk.php");
        }
        elseif($tam=='tintuc'){
            include("main/tintuc.php");
        }
        elseif($tam=='tintuc'){
            include("main/tintuc.php");
        }
elseif($tam=='yeuthich'){
    include("main/yeuthich.php");
}
elseif($tam=='yeuthichdanhsach'){
    include("main/yeuthichdanhsach.php");
}
           
           
           else{
            include 'main/index.php';
           }
           ?>
            </div>
        </div>