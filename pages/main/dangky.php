<?php 
// Xử lý đăng ký
$error = '';

if(isset($_POST['dangky'])){
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $password = $_POST['password'];
    $diachi = $_POST['diachi'];
    
    if(!empty($tenkhachhang) && !empty($email) && !empty($sdt) && !empty($password) && !empty($diachi)){
        // Sử dụng Prepared Statements để tránh SQL Injection
        $sql = "INSERT INTO `khachhang`(`tenkhachhang`, `email`, `dienthoai`, `matkhau`, `diachi`) VALUES(?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $tenkhachhang, $email, $sdt, $password, $diachi);
            $sql_dangky = mysqli_stmt_execute($stmt);
            
            if($sql_dangky){
                $_SESSION['dangnhap'] = $tenkhachhang;
                $_SESSION['email'] = $email;
                $_SESSION['id_khachhang'] = mysqli_insert_id($con);
                
                // Xóa output buffer và redirect (output buffer được bắt đầu ở index.php)
                if (ob_get_level() > 0) {
                    ob_end_clean();
                }
                header("Location: index.php");
                exit(); // Kết thúc quá trình thực thi sau khi chuyển hướng
            } else {
                $error = "Đăng ký không thành công. Vui lòng thử lại";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Lỗi trong quá trình chuẩn bị truy vấn";
        }
    }
    else{
        $error = "Bạn phải nhập đầy đủ thông tin";
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
        <td>Số điện thoại</td>
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
        <td colspan="2"><input type="submit" name="dangky" value="Đăng ký"></td>
    </tr>
    <tr>
        <td colspan="2"><a href="index.php?quanly=dangnhap">Đăng nhập</a></td>
    </tr>
    <?php
    if(!empty($error)) {
        echo '<tr><td colspan="2"><p style="color:red;padding:15px;font-size:20px;">' . $error . '</p></td></tr>';
    }
    ?>
</table>
</form> 
