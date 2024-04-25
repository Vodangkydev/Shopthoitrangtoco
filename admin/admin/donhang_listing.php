<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($con, "SELECT * FROM cart,khachhang WHERE cart.id_khachhang=khachhang.id  ORDER BY cart.id_cart DESC");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $sql_lietke_dh = "SELECT * FROM cart,khachhang WHERE cart.id_khachhang=khachhang.id  ORDER BY cart.id_cart DESC";
	$query_lietke_dh= mysqli_query($con,$sql_lietke_dh);
    mysqli_close($con);
    ?>
    <div class="main-content">
        <h1>Danh sách đơn hàng</h1>
        <div class="product-items">
            <div class="buttons">
                <a href="./product_listing.php">Sản Phẩm</a>
            </div>
			<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  padding: 8px;
  text-align: center;
}

th {
  background-color: #f2f2f2;
}
</style>
</head>
<body>

<table>
  <tr>
    <th>ID</th>
    <th>Mã ĐH</th>
    <th>Tên khách</th>
    <th>Hình thức TT</th>
    <th>Tình trạng</th>
    <th>Ngày tạo</th>
	<th>Ngày tạo</th>
  </tr>
  <?php
				$i=0;
                while ($row = mysqli_fetch_array($query_lietke_dh)) {
					$i++;
                    ?>
  <tr>
    <td><?= $i ?></td>
    <td><?= $row['code_cart'] ?></td>
    <td><?= $row['tenkhachhang'] ?></td>
    <td><?php 
        if($row['cart_payment']=='tienmat'){
     
            echo '<span style="font-size:20px ;color:blue";> Tiền Mặt</span>';
            }elseif($row['cart_payment']=='chuyenkhoan'){
                echo '<span style="font-size:20px ;color:#32c711";> Chuyển Khoản</span>';
            }
   		?></td>
    <td>  <?php
       if($row['cart_status']==1){
     
        echo '<span style="font-size:20px ;color:blue";> Đơn Hàng Mới</span>';
    	}elseif($row['cart_status']==2){
    		echo '<span style="font-size:20px ;color:#32c711";> Đang Chuẩn Bị</span>';
    	}
        elseif($row['cart_status']==3){
            echo '<span style="font-size:20px ;color:yellow";> Đang Giao</span>';
        }else{
            echo '<span style="font-size:20px ;color:red";> Hoàn Thành</span>';
        }
    	?></td>
  
    <td><?= $row['cart_date'] ?></td>
	  <td><a href="./donhang_editing.php?id=<?= $row['code_cart'] ?>">Xem</a></td>
  </tr>
     <?php } ?>
  <div class="clear-both"></div>

</table>    

            <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php
}
include './footer.php';
?>