<?php
    $sql="SELECT * FROM product where id='$_GET[id]'" ;
    $result = mysqli_query($con,$sql);
    $sql_anh = mysqli_query($con,"SELECT * FROM image_library where product_id='$_GET[id]'");
    
    // Lấy tất cả hình ảnh
    $images = array();
    while($row_img = mysqli_fetch_array($sql_anh)){
        $images[] = $row_img['path'];
    }
?>

<div class="product-detail-container">
    <?php 
    while($row = mysqli_fetch_array($result)){
        $discount = isset($row['discount_percent']) ? (int)$row['discount_percent'] : 0;
        $sale_price = 0;
        if($discount > 0 && $discount <= 100) {
            $sale_price = $row['price'] * (1 - $discount / 100);
        }
        $final_price = $sale_price > 0 ? $sale_price : $row['price'];
    ?>
    
    <div class="product-detail-wrapper">
        <!-- Left Column: Product Images -->
        <div class="product-images-section">
            <div class="product-thumbnails">
                <?php 
                // Thumbnail chính
                if(!empty($row['image'])){ ?>
                    <div class="thumbnail-item active" data-image="admin/<?= $row['image'] ?>">
                        <img src="admin/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                    </div>
                <?php }
                // Thumbnails từ image_library
                foreach($images as $img_path){ ?>
                    <div class="thumbnail-item" data-image="admin/<?= $img_path ?>">
                        <img src="admin/<?= $img_path ?>" alt="<?= $row['name'] ?>">
                    </div>
                <?php } ?>
            </div>
            <div class="product-main-image">
                <img id="main-product-image" src="admin/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
            </div>
        </div>

        <!-- Right Column: Product Information -->
        <div class="product-info-section">
            <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?= $row['id'] ?>" id="product-form">
                <h1 class="product-name"><?= $row['name'] ?></h1>
                
                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Mã sản phẩm:</span>
                        <span class="meta-value"><?= isset($row['code']) ? $row['code'] : 'SP'.str_pad($row['id'], 6, '0', STR_PAD_LEFT) ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Tình trạng:</span>
                        <span class="meta-value in-stock">Còn hàng</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Thương hiệu:</span>
                        <span class="meta-value"><?= isset($row['brand']) ? $row['brand'] : 'TOCO Menswear' ?></span>
                    </div>
                </div>

                <div class="product-pricing">
                    <?php if($discount > 0 && $sale_price > 0){ ?>
                        <div class="price-current"><?= number_format($sale_price,0,',','.').'₫' ?></div>
                        <div class="price-old-wrapper">
                            <span class="price-old"><?= number_format($row['price'],0,',','.').'₫' ?></span>
                            <span class="discount-badge">-<?= $discount ?>%</span>
                        </div>
                    <?php } else { ?>
                        <div class="price-current"><?= number_format($row['price'],0,',','.').'₫' ?></div>
                    <?php } ?>
                </div>

                <div class="product-options">
                    <div class="option-group">
                        <label class="option-label">Kích thước:</label>
                        <div class="size-selector">
                            <input type="radio" name="size" id="sizeS" value="Size S" checked>
                            <label for="sizeS" class="size-btn">S</label>
                            
                            <input type="radio" name="size" id="sizeM" value="Size M">
                            <label for="sizeM" class="size-btn">M</label>
                            
                            <input type="radio" name="size" id="sizeL" value="Size L">
                            <label for="sizeL" class="size-btn">L</label>
                            
                            <input type="radio" name="size" id="sizeXL" value="Size XL">
                            <label for="sizeXL" class="size-btn">XL</label>
                        </div>
                    </div>

                    <div class="option-group">
                        <label class="option-label">Màu sắc:</label>
                        <div class="color-selector">
                            <div class="color-item active" style="background-color: #<?= isset($row['color']) ? $row['color'] : 'FF6B6B' ?>"></div>
                        </div>
                    </div>

                    <div class="option-group">
                        <label class="option-label">Số lượng:</label>
                        <div class="quantity-selector">
                            <button type="button" class="qty-btn minus" onclick="changeQuantity(-1)">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" readonly>
                            <button type="button" class="qty-btn plus" onclick="changeQuantity(1)">+</button>
                        </div>
                    </div>
                </div>

                <div class="product-actions">
                    <button type="submit" name="themgiohang" class="btn-add-cart">THÊM VÀO GIỎ</button>
                    <?php if(isset($_SESSION['dangnhap'])) { ?>
                        <!-- Mua ngay: thêm sản phẩm này vào giỏ và chuyển thẳng đến bước vận chuyển -->
                        <button type="submit" name="muangay" class="btn-buy-now">MUA NGAY</button>
                    <?php } else { ?>
                        <!-- Chưa đăng nhập thì yêu cầu đăng nhập trước khi mua ngay -->
                        <a href="index.php?quanly=dangnhap" class="btn-buy-now">MUA NGAY</a>
                    <?php } ?>
                </div>

                <div class="product-share">
                    <span class="share-label">Chia sẻ:</span>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" class="share-btn facebook" title="Facebook">📘</a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" class="share-btn twitter" title="Twitter">🐦</a>
                        <a href="https://pinterest.com/pin/create/button/?url=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" class="share-btn pinterest" title="Pinterest">📌</a>
                        <button type="button" class="share-btn link" onclick="copyLink()" title="Sao chép link">🔗</button>
                    </div>
                </div>

                <?php if(!empty($row['content'])){ ?>
                <div class="product-description">
                    <h3>Mô tả sản phẩm</h3>
                    <div class="description-content">
                        <?= nl2br(htmlspecialchars($row['content'])) ?>
                    </div>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>

    <?php } ?>
</div>

<script>
// Thay đổi hình ảnh chính khi click thumbnail
document.querySelectorAll('.thumbnail-item').forEach(function(thumb){
    thumb.addEventListener('click', function(){
        document.querySelectorAll('.thumbnail-item').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        const imgSrc = this.getAttribute('data-image');
        document.getElementById('main-product-image').src = imgSrc;
    });
});

// Chọn size
document.querySelectorAll('input[name="size"]').forEach(function(radio){
    radio.addEventListener('change', function(){
        document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelector('label[for="' + this.id + '"]').classList.add('active');
    });
});

// Set size mặc định
document.querySelector('label[for="sizeM"]').classList.add('active');

// Thay đổi số lượng
function changeQuantity(delta){
    const qtyInput = document.getElementById('quantity');
    let currentQty = parseInt(qtyInput.value);
    let newQty = currentQty + delta;
    if(newQty < 1) newQty = 1;
    if(newQty > 10) newQty = 10;
    qtyInput.value = newQty;
}

function copyLink(){
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(function(){
        alert('Đã sao chép link!');
    });
}

document.getElementById('product-form').addEventListener('submit', function(e){
    const qty = document.getElementById('quantity').value;
    const size = document.querySelector('input[name="size"]:checked').value;
    // Thêm hidden inputs để gửi quantity và size
    const qtyInput = document.createElement('input');
    qtyInput.type = 'hidden';
    qtyInput.name = 'quantity';
    qtyInput.value = qty;
    this.appendChild(qtyInput);
    
    const sizeInput = document.createElement('input');
    sizeInput.type = 'hidden';
    sizeInput.name = 'selected_size';
    sizeInput.value = size;
    this.appendChild(sizeInput);
});
</script>
