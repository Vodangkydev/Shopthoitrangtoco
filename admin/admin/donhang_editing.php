<?php
include 'header.php';
	require('../../carbon/autoload.php');

	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $code_cart =$_GET['id'];
  
	$now = Carbon::now('Asia/Ho_Chi_Minh');
if (!empty($_SESSION['current_user'])) {
    if(isset($_POST['submit'])) {
        $tinhtrang = $_POST['tinhtrang'];
        $sql_tinhtrang="UPDATE cart SET cart_status='".$tinhtrang."' WHERE code_cart ='".$code_cart."'";
        $result=mysqli_query($con,$sql_tinhtrang);
    }
   
    


    $sql_lietke_thongtinkh = "SELECT * FROM cart,khachhang WHERE cart.id_khachhang=khachhang.id AND code_cart ='".$code_cart."'";
	$query_lietke_thongtinkh= mysqli_query($con,$sql_lietke_thongtinkh);

    $sql_lietke_dh = "SELECT * FROM cart_details,product WHERE cart_details.id_sanpham=product.id AND cart_details.code_cart='".$code_cart."' ORDER BY cart_details.id_cart_details DESC";
	$query_lietke_dh = mysqli_query($con,$sql_lietke_dh);
  
    mysqli_close($con);
}?>
   
   <div class="main-content">
        <h1>Cập nhập sản phẩm</h1>
        <div id="content-box">
            <style>
        table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

tr:hover {background-color: #f5f5f5;}

/* CSS để thêm hiệu ứng khi hover vào các ô */
td:hover {
  background-color: #e6e6e6;
  transition: background-color 0.3s ease-in-out;

}
.title{
    background-color: #f2f2f2;
  text-align: center;
}
<style>
.select-wrapper {
  position: relative;
  display: inline-block;
}

.select-wrapper select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 10px;
  font-size: 16px;
  width: 200px;
  border-radius: 5px;
}

.select-wrapper::after {
  content: '\25BC';
  font-size: 12px;
  color: #666;
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
}
.submit-btn {

  display: inline-block;
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  font-size: 25px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.submit-btn:hover {
  background-color: #45a049;
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
}

.submit-btn:active {
  transform: translateY(2px);
}

</style>

</style>
</head>
<body>

<table>
    <tr>
        <th class="title"colspan="4">Thông tin khách hàng</th>
</tr>
  <tr>
    <th>Tên KH</th>
    <th>Email</th>
    <th>SĐT</th>
    <th>Địa chỉ</th>
  </tr>
  <?php			
 $row = mysqli_fetch_array($query_lietke_thongtinkh);
$cart_status= $row['cart_status'] ;		
  ?>
  <tr>
    <td><?= $row['tenkhachhang'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['dienthoai'] ?></td>
    <td><?= $row['diachi'] ?></td>


  </tr>
     
  <div class="clear-both"></div>    

</table>  
<table style="width:100%" border="1" style="border-collapse: collapse;">
<tr>
        <th class="title"colspan="7">Thông tin sản phẩm</th>
</tr>
  <tr>
  	<th>Id</th>
    <th>Mã SP</th>
    <th>Tên sản phẩm</th>
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
    <td><?php echo $row['soluong'] ?></td>
    <td><?php echo $row['size'] ?></td>
    <td><?php echo number_format($row['price'],0,',','.').'vnđ' ?></td>
    <td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
    
   	
  </tr>
  <?php
  } 
  ?>
  <tr>
  	<td colspan="7">
   		<p>Tổng tiền : <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p>
   	</td>
   
  </tr>
  <form method="POST" action="">
  <tr>

  	<td colspan="7">
       <?php
       if($cart_status==1){
     
        echo '<span style="font-size:25px">Tình trạng đơn hàng:</span><span style="font-size:20px ;color:red";> Đơn Hàng Mới</span>';
    	}elseif($cart_status==2){
    		echo '<span style="font-size:25px">Tình trạng đơn hàng:</span><span style="font-size:20px ;color:red";> Đang Chuẩn Bị</span>';
    	}
        elseif($cart_status==3){
            echo '<span style="font-size:25px">Tình trạng đơn hàng:</span><span style="font-size:20px ;color:red";> Đang Giao</span>';
        }else{
            echo '<span style="font-size:25px">Tình trạng đơn hàng:</span><span style="font-size:20px ;color:red";> Hoàn Thành</span>';
        }
    	?></p>
       <div class="select-wrapper"> 
      <select name="tinhtrang">
  <option value="1">Đơn Hàng Mới</option>
  <option value="2">Đang Chuẩn Bị</option>
  <option value="3">Đang Giao</option>
  <option value="4">Hoàn Thành</option>
</select>
    </div>
<br>
<input class="submit-btn" type="submit" name="submit" value="Cập nhập sản phẩm" />
<p><a href="inhoadon.php?id=<?php echo $code_cart?> ">IN HOÁ ĐƠN</a></p>
   	</td>
   
  </tr>

  </form>

 
</table> 

        </div>
    </div>

    <?php

include './footer.php';
?>
