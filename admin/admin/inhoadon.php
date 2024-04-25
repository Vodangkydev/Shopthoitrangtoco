<!DOCTYPE html>
<html>
    <head>
        <title>In hoá đơn </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_style1.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
        <link rel="icon" href="https://vuainnhanh.com/wp-content/uploads/2023/02/logo-van-lang-896x1024-1.png">
    </head>
    <body>
        <?php
        session_start();
        if (!empty($_SESSION['current_user'])) {
            include '../connect_db.php';
            $code_cart =$_GET['id'];
            $orders = mysqli_query($con, " SELECT * FROM cart,khachhang WHERE cart.id_khachhang=khachhang.id AND code_cart ='".$code_cart."'" );
            $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
            $sql_lietke_dh = "SELECT * FROM cart_details,product WHERE cart_details.id_sanpham=product.id AND cart_details.code_cart='".$code_cart."' ORDER BY cart_details.id_cart_details DESC";
            $query_lietke_dh = mysqli_query($con,$sql_lietke_dh);
        }
        ?>
        <div id="order-detail-wrapper">
            <div id="order-detail">
                <h1>Chi tiết đơn hàng</h1>
                <label>Người nhận: </label><span> <?= $orders[0]['tenkhachhang'] ?></span><br/>
                <label>Điện thoại: </label><span> <?= $orders[0]['dienthoai'] ?></span><br/>
                <label>Địa chỉ người nhận: </label><span> <?= $orders[0]['diachi'] ?></span><br/>
                <label>Thanh Toán: </label><span> <?php 
                 if($orders[0]['cart_payment']=='tienmat'){
     
            echo '<span> Tiền Mặt</span>';
            }elseif($row['cart_payment']=='chuyenkhoan'){
                echo '<span > Chuyển Khoản</span>';
            }
   		?></span><br/>
                <hr/>
                <h3>Danh sách sản phẩm</h3>
                <ul>
                    <?php
                 
                    $i = 0;
                    $tongtien=0;
                    $tongsoluong=0;
                    while($row = mysqli_fetch_array($query_lietke_dh)){

                      $i++;
                      $tongsoluong +=$row['soluong'];
                      $thanhtien = $row['price']*$row['soluong'];
					  $size=$row['size'];
                      $tongtien += $thanhtien ;
                    
                        ?>
                        <li>
                            <span class="item-name">Tên sản phẩm: <?= $row['name'] ?></span>
                            <span class="item-quantity"> - SL: <?= $row['soluong'] ?> sản phẩm</span>
							 <span class="item-quantity"> - <?= $row['size'] ?> </span>
                        </li>
                        <?php
                      
                      
                    }
                    ?>
                </ul>
                <hr/>
                <label>Tổng SL:</label> <?= $tongsoluong?> - <label>Tổng tiền:</label> <?= number_format($tongtien, 0, ",", ".") ?> đ
                <a href="donhang_listing.php">Done!</a>
            </div>
        </div>
        
    </body>
</html>