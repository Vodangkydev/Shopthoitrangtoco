<?php
	if(isset($_POST['doimatkhau'])){
		$taikhoan = $_SESSION['email'];
     
		$matkhau_cu = ($_POST['password_cu']);
		$matkhau_moi = ($_POST['password_moi']);
		$sql = "SELECT * FROM khachhang WHERE email='".$taikhoan."' AND matkhau='".$matkhau_cu."' LIMIT 1";
		$row = mysqli_query($con,$sql);
		$count = mysqli_num_rows($row);
		if($count>0){
			$sql_update = mysqli_query($con,"UPDATE khachhang SET matkhau='".$matkhau_moi."'");
			echo '<p style="color:green;padding:7px;">Mật khẩu đã được thay đổi.</p>';

        
		}else{
			echo '<p style="color:red;padding:7px;">Tài khoản hoặc Mật khẩu cũ không đúng,vui lòng nhập lại.</p>';
            
		}
	} 
?>
<form action="" autocomplete="off" method="POST">
		<table class="bang1" border="1" style="text-align: center;border-collapse: collapse;">
			<tr>
				<td colspan="2"><h3>Đổi mật khẩu</h3></td>
			</tr>
			<tr>
				<td>Tài khoản</td>
				<td><?php echo $_SESSION['email']?></td>
			</tr>
			<tr>
				<td>Mật khẩu cũ</td>
				<td><input type="password" name="password_cu"></td>
			</tr>
			<tr>
				<td>Mật khẩu mới</td>
				<td><input type="password" name="password_moi"></td>
			</tr>
			<tr>
				
				<td colspan="2"><input type="submit" name="doimatkhau" value="Đổi mật khẩu"></td>
              
			</tr>
			<li>
                    <a href="index.php?dangxuat=1">Đăng xuất</a>
                    </li>
	</table>
	</form>
	