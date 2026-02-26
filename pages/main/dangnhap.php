<?php
// Xử lý đăng nhập
$error = '';
$msg = '';
$msgcookie = '';

if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $error = "Bạn phải nhập Email";
    } elseif (empty($password)) {
        $error = "Bạn phải nhập Mật khẩu";
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
                $_SESSION['dangnhap'] = $row['tenkhachhang'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id_khachhang'] = $row['id'];

                // Xử lý ghi nhớ đăng nhập
                if(isset($_POST['ghinho']) && ($_POST['ghinho'])){
                    setcookie("email", $email, time()+(86400*7));
                    setcookie("password", $password, time()+(86400*7));
                }

                // Xóa output buffer và redirect (output buffer được bắt đầu ở index.php)
                if (ob_get_level() > 0) {
                    ob_end_clean();
                }
                header("Location: index.php");
                exit(); // Kết thúc quá trình thực thi sau khi chuyển hướng
            } else {
                $error = "Đăng nhập không thành công. Vui lòng nhập lại";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Lỗi trong quá trình chuẩn bị truy vấn";
        }
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
            <td colspan="2"><a href="index.php?quanly=dangky">Đăng ký</a></td>
        </tr>
        <?php
        if(!empty($error)) {
            echo '<tr><td colspan="2"><p style="color:red;padding:15px;font-size:20px;">' . $error . '</p></td></tr>';
        }
        if(isset($msg)) echo '<tr><td colspan="2">' . $msg . '</td></tr>';
        if(isset($msgcookie)) echo '<tr><td colspan="2">' . $msgcookie . '</td></tr>';
        ?>
    </table>
</form>
