<?php
    $sql = "SELECT * FROM lienhe WHERE id = 1";
    $result = mysqli_query($con, $sql);
    $lienhe = $result->fetch_assoc();
?>

<section class="contact-hero">
    <div class="contact-hero__text">
        <p class="eyebrow">Liên hệ</p>
        <h1>Kết nối với Tocomenswear</h1>
        <p class="subtext">
            Chúng tôi sẵn sàng hỗ trợ về sản phẩm, đơn hàng và hợp tác. Hãy chọn kênh liên lạc phù hợp, đội ngũ sẽ phản hồi trong giờ làm việc.
        </p>
        <div class="contact-actions">
            <a class="primary-btn" href="tel:123456789">Gọi 123456789</a>
            <a class="ghost-btn" href="vodangky.dev@gmail.com">Gửi email</a>
        </div>
    </div>
    <div class="contact-hero__image">
        <img src="./images/banner/anh1.jpg" alt="Showroom Tocomenswear">
    </div>
</section>

<section class="contact-grid">
    <div class="contact-card">
        <h3>Địa chỉ</h3>
        <p>Gò Vấp, TP. Hồ Chí Minh</p>
        <p>Giờ làm việc: 8:30 - 21:00 (T2 - CN)</p>
    </div>
    <div class="contact-card">
        <h3>Điện thoại</h3>
        <p><a href="tel:0123456789">0123456789</a></p>
        <p><a href="tel:098888888">098888888</a></p>
    </div>
    <div class="contact-card">
        <h3>Email</h3>
        <p><a href="mailto:vodangky.dev@gmail.com">vodangky.dev@gmail.com</a></p>
        <p><a href="mailto:vodangky.dev@gmail.com">vodangky.dev@gmail.com</a></p>
    </div>
</section>

<section class="contact-about">
    <div class="about-copy">
        <?php echo $lienhe['noidunglienhe']?>
        <p class="lead">
            Tocomenswear khích lệ phong cách riêng qua những thiết kế hiện đại, chú trọng trải nghiệm từ chất lượng sản phẩm đến dịch vụ giao hàng và hỗ trợ khách hàng.
        </p>
    </div>
    <div class="about-image">
        <img src="./images/banner/anh2.jpg" alt="Bộ sưu tập Tocomenswear">
    </div>
</section>

<section class="contact-map">
    <div class="map-card">
        <h3>Đường đi đến cửa hàng</h3>
        <p>Địa chỉ: Quận Gò Vấp, TP. Hồ Chí Minh</p>
        <div class="map-embed">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0283277799055!2d106.679112!3d10.8084803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175293d8f0b0fd7%3A0x8f5ad9d1d2a2b6e0!2zMjUgTMOqIFbEg24gTMOqIFbEg24sIFBoxrDhu51uZyA3LCBRdeG6rW4gR8OyIFbDoXAsIFRwLiBI4buTIENow60gTWluaA!5e0!3m2!1svi!2svi!4v1734379200000"
                width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
