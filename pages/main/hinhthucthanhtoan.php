
<?php
  if(isset($_SESSION['id_khachhang'])&& (isset($_SESSION['cart']))){
  ?>
  <br>
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step current"> <span><a href="index.php?quanly=hinhthucthanhtoan" >Thanh toán</a><span> </div>
    <div class="step"> <span><a href="index.php?quanly=lichsudonhang" >Lịch sử đơn hàng</a><span> </div>
  </div>
  <?php
  } 
  ?>
   	<form action="pages/main/xulythanhtoan.php" method="POST">
	<div class="row">
    <?php
 	$id_dangky = $_SESSION['id_khachhang'];
 	$sql_get_vanchuyen = mysqli_query($con,"SELECT * FROM shipping WHERE id_dangky='$id_dangky' LIMIT 1");
 	$count = mysqli_num_rows($sql_get_vanchuyen);
 	if($count>0){
 		$row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
 		$name = $row_get_vanchuyen['name'];
 		$phone = $row_get_vanchuyen['phone'];
 		$address = $row_get_vanchuyen['address'];
 		$note = $row_get_vanchuyen['note'];
 	}else{

 		$name = '';
 		$phone = '';
 		$address = '';
 		$note = '';
 	}
 	?>
<div class="thongtinvanchuyenvagiohang">
  		<h1>Thông tin vận chuyển và giỏ hàng</h1>
  		<ul>
  			<li>Họ và tên vận chuyển : <b><?php echo $name ?></b></li>
  			<li>Số điện thoại : <b><?php echo $phone ?></b></li>
  			<li>Địa chỉ : <b><?php echo $address ?></b></li>
  			<li>Ghi chú : <b><?php echo $note ?></b></li>
  		</ul>
</div>
<table class="bang" border="1">
    <tr>
        <th>ID</th>
        <th>Tên SP</th>
        <th>Hình Ảnh</th>
        <th>Số lượng</th>
        <th>Size</th>
        <th>Giá SP</th>
        <th>Thành tiền</th>
    </tr>

    <?php
    
    if(isset($_SESSION['cart'])){
        
        $id=0;
        $tongtien=0;
        $thanhtien=0;
        foreach($_SESSION['cart'] as $cart_item){
            $id++;
            $thanhtien=$cart_item['soluong']*$cart_item['giasp'];
            $tongtien+=$thanhtien;
          
        ?>

    <tr>
        <td><?= $id ?></td>
        <td><?= $cart_item['name'] ?></td>
        <td><img src="./admin<?php echo $cart_item['image'];?>" width="150px" ></td>
        <td>
            <?= $cart_item['soluong'] ?>
        </td>
        <td>
            <?= $cart_item['size'] ?>
        </td>
        <td><?= number_format($cart_item['giasp'],0,',','.').' VNĐ'?></td>
        <td><?= number_format($thanhtien,0,',','.').' VNĐ' ?></td>

    </tr>
    <?php } ?>
    <tr>
      <td colspan="7">
        <p style="color:red;font-size: 25px; font-weight: bold;">Tổng tiền: <?= number_format($tongtien,0,',','.').' VNĐ'?></p>

    </td>
    </tr>  
    <?php
    
    }
      ?>
  
   
</table>
  	<div class="hinhthucthanhtoan">
  		<h4>Phương thức thanh toán</h4>
  		<div class="form-check">
		  <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="tienmat" checked>
		  <label class="form-check-label" for="exampleRadios1">
		    Tiền mặt khi nhận hàng (COD)
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="chuyenkhoan">
		  <label class="form-check-label" for="exampleRadios2">
		    Chuyển khoản ngân hàng
		  </label>
		</div>

        <div class="payment-details">
            <div class="payment-cash">
                <p>Bạn sẽ thanh toán tiền mặt trực tiếp cho nhân viên giao hàng khi nhận sản phẩm.</p>
            </div>
            <div class="payment-bank-transfer" style="display:none;">
                <p><strong>Thông tin chuyển khoản:</strong></p>
                <ul>
                    <li>Ngân hàng: Sacombank - Chi nhánh Gò Vấp</li>
                    <li>Chủ tài khoản: Vo Dang Ky</li>
                    <li>Số tài khoản: <strong>050122494737</strong></li>
                </ul>
                <p><strong>Nội dung chuyển khoản:</strong>  Họ tên + "TOCO"</p>
                <p>Sau khi chuyển khoản thành công, đơn hàng sẽ được xác nhận và giao cho bạn trong thời gian sớm nhất.</p>
                <div class="payment-qr">
                    <p><strong>Quét mã QR để chuyển khoản nhanh:</strong></p>
                    <img src="images/sacombank.jpg" alt="QR chuyển khoản TOCO Menswear">
                </div>
            </div>
        </div>
		
		<input type="submit" value="Thanh toán ngay" name="redirect" class="btn btn-danger">
	</div>	
</form>

