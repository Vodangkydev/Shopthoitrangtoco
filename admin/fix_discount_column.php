<?php
// Script để thêm cột discount_percent vào bảng product
// Truy cập: http://localhost:8080/admin/fix_discount_column.php

include 'connect_db.php';

// Kiểm tra xem cột đã tồn tại chưa
$checkColumn = mysqli_query($con, "SHOW COLUMNS FROM `product` LIKE 'discount_percent'");

if(mysqli_num_rows($checkColumn) == 0) {
    // Thêm cột nếu chưa có
    $sql = "ALTER TABLE `product` ADD COLUMN `discount_percent` INT DEFAULT 0";
    
    if (mysqli_query($con, $sql)) {
        echo "<h2 style='color: green;'>✓ Thành công! Đã thêm cột discount_percent vào bảng product.</h2>";
        echo "<p>Bạn có thể đóng trang này và quay lại admin để sử dụng tính năng sale.</p>";
    } else {
        echo "<h2 style='color: red;'>✗ Lỗi: " . mysqli_error($con) . "</h2>";
    }
} else {
    echo "<h2 style='color: blue;'>ℹ Cột discount_percent đã tồn tại trong database.</h2>";
    echo "<p>Bạn có thể đóng trang này.</p>";
}

mysqli_close($con);
?>

