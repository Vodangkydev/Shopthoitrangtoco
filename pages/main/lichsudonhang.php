<h3 style="padding: 5px;">Lịch sử đơn hàng</h3>
<?php

	$id_khachhang = $_SESSION['id_khachhang'];
	$sql_lietke_dh = "SELECT * FROM cart,khachhang WHERE cart.id_khachhang=khachhang.id AND cart.id_khachhang='$id_khachhang' ORDER BY cart.id_cart DESC";
	$query_lietke_dh = mysqli_query($con,$sql_lietke_dh);
?>
<table class="bang" border="1" >
  <tr>
  	<th>Id</th>
    <th>Mã đơn hàng</th>
    <th>Tên khách hàng</th>
    <th>Địa chỉ</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Tình trạng</th>
    <th>Ngày đặt</th>
  	<th>Quản lý</th>
  	<th>Hình thức thanh toán</th>
  </tr>
  <?php
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_dh)){
  	$i++;
  ?>
  <tr>
  	<td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tenkhachhang'] ?></td>
    <td><?php echo $row['diachi'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['dienthoai'] ?></td>

    <td>
    <?php
       if($row['cart_status']==1){
     
        echo '<span style="font-size:15px ;color:blue";> Đơn Hàng Mới</span>';
    	}elseif($row['cart_status']==2){
    		echo '<span style="font-size:15px ;color:#32c711";> Đang Chuẩn Bị</span>';
    	}
        elseif($row['cart_status']==3){
            echo '<span style="font-size:15px ;color:Green";> Đang Giao</span>';
        }else{
            echo '<span style="font-size:15px ;color:red";> Hoàn Thành</span>';
        }
    	?>
    </td>
    <td><?php echo $row['cart_date'] ?></td>
   	<td>
   		<a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a> 
   	</td>
   	<td>
   		<?php 
        if($row['cart_payment']=='tienmat'){
     
            echo '<span style="font-size:17px ;color:blue";> Tiền Mặt</span>';
            }elseif($row['cart_payment']=='chuyenkhoan'){
                echo '<span style="font-size:17px ;color:#32c711";> Chuyển Khoản</span>';
            }
   		?>
   		</td>
  </tr>
  <?php
  } 
  ?>
 
</table>
