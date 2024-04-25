<?php
    $sql = "SELECT * FROM lienhe WHERE id = 1";
    $result = mysqli_query($con, $sql);
    $lienhe = $result->fetch_assoc();
?>

<div class="lienhe">
    <h1>About</h1>
    <?php echo $lienhe['noidunglienhe']?>

    <!-- Adding an image with adjusted size -->
    <img src="./images/banner/anh1.jpg" alt="Description of the image" width="1200" height="400">
    
    <!-- Adding a paragraph with font size set to 24 -->
    <p style="font-size: 24px;">
        <br> <b>Tocomenswear</b> </br> khích lệ mỗi người thể hiện phong cách riêng qua những sản phẩm thời trang sáng tạo, đầy năng động và phản ánh giá trị của thế hệ mới.

        Với sự chú trọng đến chi tiết và nghệ thuật, Tocomenswearcam kết mang đến trải nghiệm tốt nhất, từ chất lượng sản phẩm đến hình ảnh và bao bì.

        Là thương hiệu thời trang đường phố hàng đầu, Tocomenswear là điểm đến yêu thích của giới trẻ Việt Nam, luôn khẳng định phong cách và cá tính của mỗi cá nhân.
    </p>
    <img src="./images/banner/anh2.jpg" alt="Description of the image" width="1200" height="400">

</div>
