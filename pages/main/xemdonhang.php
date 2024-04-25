<h3 style="padding: 5px;">Xem đơn hàng</h3>
<?php
	$code = $_GET['code'];
	$sql_lietke_dh = "SELECT * FROM cart_details,product WHERE cart_details.id_sanpham=product.id AND cart_details.code_cart='".$code."' ORDER BY cart_details.id_cart_details DESC";
	$query_lietke_dh = mysqli_query($con,$sql_lietke_dh);
?>

<table class="bang" border="1">
  <tr>
  	<th>Id</th>
    <th>Mã SP</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Số lượng</th>
    <th>Size</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
    
  
  
  </tr>
  <?php
  $i = 0;
  $tongtien = 0;
  while($row = mysqli_fetch_array($query_lietke_dh)){
  	$i++;
  	$thanhtien = $row['price']*$row['soluong'];
  	$tongtien += $thanhtien ;
  ?>
  <tr>
  	<td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['name'] ?></td>
    <td><img src="./admin<?php echo $row['image'];?>" width="150px" ></td>
    <td><?php echo $row['soluong'] ?></td>
    <td><?php echo $row['size'] ?></td>
    <td><?php echo number_format($row['price'],0,',','.').' VNĐ' ?></td>
    <td><?php echo number_format($thanhtien,0,',','.').' VNĐ' ?></td>
   	
  </tr>
  <?php
  } 
  ?>
  <tr>
  	<td colspan="7">
   		<p style="font-size: 25px;">Tổng tiền : <?php echo number_format($tongtien,0,',','.').' VNĐ' ?></p>
   	</td>
   
  </tr>
 
</table>