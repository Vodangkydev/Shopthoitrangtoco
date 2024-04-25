<div id="main">
           <?php
           include "./pages/sidebar/sale.php"
           ?>
            <div class="maincontent">
            <?php
           if(isset($_GET['quanly'])){
            $tam =$_GET['quanly'];
           }
           else{
            $tam="";
           }
           if($tam=='dangnhap'){
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
        elseif($tam=='lienhe'){
            include("main/lienhe.php");
        }
        elseif($tam=='dahnhmucsale'){
            include("main/danhmucsale.php");
        }
           
           
           else{
            include 'main/index.php';
           }
           ?>
            </div>
        </div>