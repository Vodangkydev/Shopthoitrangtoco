<?php
  if(isset($_SESSION['id_khachhang'])){
  ?>
  <br>
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step current"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step"> <span><a href="index.php?quanly=hinhthucthanhtoan" >Thanh toán</a><span> </div>
    <div class="step"> <span><a href="index.php?quanly=lichsudonhang" >Lịch sử đơn hàng</a><span> </div>
  </div>
  <?php
  } 
  ?>

 <?php
 	if(isset($_POST['themvanchuyen'])) {
 		$name = $_POST['name'];
 		$phone = $_POST['phone'];
 		$address = $_POST['address'];
 		$note = $_POST['note'];
 		$id_dangky = $_SESSION['id_khachhang'];
 		$sql_them_vanchuyen = mysqli_query($con,"INSERT INTO shipping(name,phone,address,note,id_dangky) VALUES('$name','$phone','$address','$note','$id_dangky')");
 		if($sql_them_vanchuyen){
 			// Đồng bộ lại thông tin profile (bảng khachhang)
 			mysqli_query($con,"UPDATE khachhang SET tenkhachhang='$name', dienthoai='$phone', diachi='$address' WHERE id='$id_dangky'");
 			echo '<script>alert(\"Thêm vận chuyển thành công\")</script>';
 		}
 	}elseif(isset($_POST['capnhatvanchuyen'])){
 		$name = $_POST['name'];
 		$phone = $_POST['phone'];
 		$address = $_POST['address'];
 		$note = $_POST['note'];
 		$id_dangky = $_SESSION['id_khachhang'];
 		$sql_update_vanchuyen = mysqli_query($con,"UPDATE shipping SET name='$name',phone='$phone',address='$address',note='$note',id_dangky='$id_dangky' WHERE id_dangky='$id_dangky'");
 		if($sql_update_vanchuyen){
 			// Đồng bộ lại thông tin profile (bảng khachhang)
 			mysqli_query($con,"UPDATE khachhang SET tenkhachhang='$name', dienthoai='$phone', diachi='$address' WHERE id='$id_dangky'");
 			echo '<script>alert(\"Cập nhật vận chuyển thành công\")</script>';
 		}
 	}
 ?>
 <div class="row">
 	<?php
 	$id_dangky = $_SESSION['id_khachhang'];
 	$sql_get_vanchuyen = mysqli_query($con,"SELECT * FROM shipping WHERE id_dangky='$id_dangky' LIMIT 1");
 	$count = mysqli_num_rows($sql_get_vanchuyen);
 	if($count>0){
 		// Đã có thông tin giao hàng, sử dụng dữ liệu từ bảng shipping
 		$row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
 		$name = $row_get_vanchuyen['name'];
 		$phone = $row_get_vanchuyen['phone'];
 		$address = $row_get_vanchuyen['address'];
 		$note = $row_get_vanchuyen['note'];
 	}else{
 		// Chưa có shipping: lấy sẵn thông tin từ profile (bảng khachhang)
 		$sql_get_profile = mysqli_query($con,"SELECT tenkhachhang, dienthoai, diachi FROM khachhang WHERE id='$id_dangky' LIMIT 1");
 		if(mysqli_num_rows($sql_get_profile) > 0){
 			$row_profile = mysqli_fetch_array($sql_get_profile);
 			$name = $row_profile['tenkhachhang'];
 			$phone = $row_profile['dienthoai'];
 			$address = $row_profile['diachi'];
 		}else{
 			$name = '';
 			$phone = '';
 			$address = '';
 		}
 		$note = '';
 	}
 	?>
 	<div class="vanchuyen">
     <h1>Thông tin nhận hàng</h1>
	 <form action="" autocomplete="off" method="POST">
	  <div class="form-group">
	    <label for="email">Họ và tên</label>
	    <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="..." >
	  </div>
		<div class="form-group">
	    <label for="email">Phone</label>
	    <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>"  placeholder="...">
	  </div>
	  <div class="form-group">
	    <label for="email">Địa chỉ</label>
	    <input type="text" name="address" class="form-control" value="<?php echo $address ?>"  placeholder="...">
	  </div>
	  <div class="form-group">
	    <label for="email">Ghi chú</label>
	    <input type="text" name="note" class="form-control" value="<?php echo $note ?>"  placeholder="..." >
	  </div>
      <?php
	  // Nếu chưa có bản ghi shipping -> lưu mới, ngược lại cho phép cập nhật
	  if($count == 0) {
	  ?>
	  <button type="submit" name="themvanchuyen" class="btn btn-primary">Lưu thông tin giao hàng</button><br><br>
	  <?php
	  } else {
	  ?>
	  <button type="submit" name="capnhatvanchuyen" class="btn btn-success">Cập nhật thông tin giao hàng</button><br><br>
	  <?php
	  } 
	  ?>
      </form>
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
        <p style="color:red;font-size: 30px; font-weight: bold;">Tổng tiền: <?= number_format($tongtien,0,',','.').' VNĐ' ?></p>
        <p class="chinhsua" ><a href="pages/main/themgiohang.php?xoatatca=1">Xoá tất cả</a></p>
        <?php
        if(isset($_SESSION['dangnhap'])){
            ?>
            <p class="chinhsua"><a  href="index.php?quanly=hinhthucthanhtoan">Hình thức thanh toán</a></p>
       <?php 
       }else{
        ?>
        <p><a class="chinhsua"  href="index.php?quanly=dangnhap">Đăng nhập Đặt hàng</a></p>
       
       <?php }?>
        

       
    </td>
      </tr> 
    <?php
    
    }else{
      ?>
      <tr>
      <td colspan="7"><p>Hiện tại không có gì trong giỏ hàng</p></td>
      </tr>  
   <?php } ?>
   
</table>