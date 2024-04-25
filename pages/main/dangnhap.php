
<?php

if (isset($_POST['dangnhap'])&&($_POST['dangnhap'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(($email=="tocomenswear")&&($password="123")){
        echo"Đăng nhập thành công";
    }else{
       echo "Vui lòng đăng nhập";
    }
    if(isset($_POST['ghinho'])&&($_POST['ghinho'])){
        setcookie("email",$email,time()+(86400*7));
        setcookie("password",$password,time()+(86400*7));
        $msgcookie="Đã ghi nhận cookie!";
    }
}
// Thực hiện kết nối đến cơ sở dữ liệu
// Ví dụ:
// $con = mysqli_connect("tên_máy_chủ", "tên_người_dùng", "mật_khẩu", "tên_cơ_sở_dữ_liệu");
// Hãy thay đổi thông tin kết nối phù hợp với cấu hình của bạn

// Kiểm tra nút đăng nhập được nhấn
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $error = "Bạn phải nhập Email";
        echo $error;
    } elseif (empty($password)) {
        $error = "Bạn phải nhập Mật khẩu";
        echo $error;
    } else {
        // Sử dụng Prepared Statements để tránh SQL Injection
        $sql = "SELECT * FROM `khachhang` WHERE email=? AND matkhau=?";
        $stmt = mysqli_prepare($con, $sql);
        
        // Kiểm tra xem có lỗi khi chuẩn bị truy vấn không
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            // Đếm số hàng trả về từ truy vấn
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                echo '<p style="color:green">Đăng nhập thành công</p>';
                $_SESSION['dangnhap'] = $row['tenkhachhang'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id_khachhang'] = $row['id'];

                echo $_SESSION['dangnhap'];

                header("Location: index2.php?quanly=giohang");
                exit(); // Kết thúc quá trình thực thi sau khi chuyển hướng
            } else {
                echo '<p style="color:red;padding:15px;font-size:20px;">Đăng nhập không thành công.Vui lòng nhập lại</p>';
            }
        } else {
            echo "Lỗi trong quá trình chuẩn bị truy vấn";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!-- Form đăng nhập -->
<p style="padding:15px;font-size:20px;">Đăng nhập thành viên</p>
<form action="" method="POST">
    <table class="bang1" border="1">
        <tr>
            <td>Tài khoản</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Mật khẩu</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="checkbox" name="ghinho">Ghi nhớ tài khoản?</td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="dangnhap" value="Đăng Nhập"></td>
        </tr>
        <tr>
            <td colspan="2"><a href="index2.php?quanly=dangky">Đăng ký</a></td>
        </tr>
        <?php
        if(isset($msg)) echo $msg;
        if(isset($msgcookie)) echo $msgcookie;
        ?>
    </table>
</form>
