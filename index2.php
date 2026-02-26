
<?php
// Giữ liên kết cũ nhưng chuyển hướng về trang chính hợp nhất
$query = $_SERVER['QUERY_STRING'] ?? '';
$target = 'index.php' . ($query ? '?' . $query : '');
header("Location: $target", true, 301);
exit;