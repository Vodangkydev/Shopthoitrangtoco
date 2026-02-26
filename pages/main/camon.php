<?php
    $lastPayment = isset($_SESSION['last_payment_method']) ? $_SESSION['last_payment_method'] : '';
    $lastCode    = isset($_SESSION['last_order_code']) ? $_SESSION['last_order_code'] : '';
    $lastTotal   = isset($_SESSION['last_order_total']) ? (int)$_SESSION['last_order_total'] : 0;
?>

<h3 style="padding: 5px;">Cám ơn bạn đã mua hàng, chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất...</h3>
<h3 style="padding: 5px;">Vào <a style="color:red;" href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a> để kiểm tra thông tin, tình trạng đơn hàng.</h3>

<?php if($lastPayment === 'chuyenkhoan'): ?>
    <div class="thongtinvanchuyenvagiohang" style="margin-top:15px;">
        <h1>Hướng dẫn chuyển khoản</h1>
        <?php if($lastCode): ?>
            <p><strong>Mã đơn hàng:</strong> <?= htmlspecialchars($lastCode) ?></p>
        <?php endif; ?>
        <?php if($lastTotal > 0): ?>
            <p><strong>Tổng tiền cần chuyển:</strong> <?= number_format($lastTotal,0,',','.') ?> VNĐ</p>
        <?php endif; ?>
        <ul>
            <li>Ngân hàng: Vietcombank - Chi nhánh Gò Vấp</li>
            <li>Chủ tài khoản: Vo Dang Ky</li>
            <li>Số tài khoản: <strong>050122494737</strong></li>
            <li><strong>Nội dung chuyển khoản:</strong> Số điện thoại + Họ tên + "TOCO"</li>
        </ul>
        <p>Sau khi bạn chuyển khoản thành công, chúng tôi sẽ xác nhận và tiến hành giao hàng.</p>
        <div class="payment-qr">
            <p><strong>Quét mã QR để chuyển khoản nhanh:</strong></p>
            <img src="images/sacombank.jpg" alt="QR chuyển khoản TOCO Menswear">
        </div>
    </div>
<?php endif; ?>

