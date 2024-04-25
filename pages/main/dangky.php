<?php 

    if(isset($_POST['dangky'])){
        $tenkhachhang = $_POST['hovaten'];
        $email =$_POST['email'];
        $sdt=$_POST['sdt'];
        $password=$_POST['password'];
        $diachi=$_POST['diachi'];
        if(!empty($tenkhachhang) && !empty($email) && !empty($sdt) && !empty($password) &&!empty($diachi)){
            $sql="INSERT INTO `khachhang`( `tenkhachhang`, `email`, `dienthoai`, `matkhau`, `diachi`) VALUES('$tenkhachhang','$email','$sdt','$password',' $diachi')";
            $sql_dangky =mysqli_query($con,$sql);
            if($sql_dangky){
                echo '<p style="color.green;padding:15px;font-size:20px;">Đăng ký thành công</p>';
                $_SESSION['dangnhap']= $tenkhachhang;
                $_SESSION['id_khachhang']= mysqli_insert_id($con);
                header("Location: index.php?quanly=giohang");
            }
        }
        else{
            $error = "Bạn phải nhập đầy đủ thông tin";
           echo $error;
        }
    }
    

    

?>
<p style="padding:15px;font-size:20px;">Đăng ký thành viên</p>

<form action="" method="POST">
<table class="bang1" border="1">
    <tr>
        <td>Họ và tên</td>
        <td><input type="text" name="hovaten"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="email"></td>
    </tr>
    <tr>
        <td>SỐ điện thoại</td>
        <td><input type="text" name="sdt"></td>
    </tr>
    <tr>
        <td>Mật khẩu</td>
        <td><input type="text" name="password"></td>
    </tr>
    <tr>
        <td>Địa chỉ</td>
        <td><input type="text" name="diachi"></td>
    </tr>
    <tr>
				
				<td colspan="2"><input type="submit" name="dangky" value="Đăng ký"></a></td>
              
			</tr>
    <tr>
				
				<td colspan="2"><a href="index2.php?quanly=dangnhap">Đăng nhập</a></td>
              
	</tr>
           
  
</table>
</form> 
