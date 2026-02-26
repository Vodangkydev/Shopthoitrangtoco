<?php
// Hiển thị danh sách yêu thích
$wishlist = isset($_SESSION['wishlist']) && is_array($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];
$wishlistIds = array_filter(array_map('intval', $wishlist));
$products = [];

if(count($wishlistIds) > 0){
    $idsStr = implode(',', $wishlistIds);
    $productsQuery = mysqli_query($con, "SELECT * FROM product WHERE id IN ($idsStr) ORDER BY FIELD(id, $idsStr)");
    while($row = mysqli_fetch_assoc($productsQuery)){
        $products[] = $row;
    }
}
?>

<div class="page-header">
    <div>
        <h2>Sản phẩm yêu thích</h2>
        <p class="product-count">Tổng <?= count($products); ?> sản phẩm</p>
    </div>
</div>

<?php if(count($products) === 0){ ?>
    <p>Bạn chưa lưu sản phẩm yêu thích nào.</p>
<?php } else { ?>
    <div class="products-container">
        <ul class="product_list">
            <?php foreach($products as $row){
                // reuse renderer from index page if available
                if(function_exists('renderProductCard')){
                    renderProductCard($row, false, $wishlist);
                } else {
                    ?>
                    <?php
                    $discount = isset($row['discount_percent']) ? (int)$row['discount_percent'] : 0;
                    $sale_price = 0;
                    if($discount > 0 && $discount <= 100) {
                        $sale_price = $row['price'] * (1 - $discount / 100);
                    }
                    ?>
                    <li class="product-card">
                        <a href="index.php?quanly=sanpham&id=<?= $row['id'] ?>" class="product-link">
                            <div class="product-image-wrapper">
                                <?php if($discount > 0){ ?>
                                    <span class="discount-badge">-<?= $discount ?>%</span>
                                <?php } ?>
                                <img src="admin/<?= $row['image'] ?>" alt="<?= $row['name'] ?>" class="product-image">
                            </div>
                            <div class="product-info">
                                <h3 class="name_sp"><?= $row['name'] ?></h3>
                                <div class="price-wrapper">
                                    <?php if($discount > 0 && $sale_price > 0){ ?>
                                        <span class="gia_sp"><?= number_format($sale_price,0,',','.').'₫'?></span>
                                        <span class="gia_old"><?= number_format($row['price'],0,',','.').'₫'?></span>
                                    <?php } else { ?>
                                        <span class="gia_sp"><?= number_format($row['price'],0,',','.').'₫'?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php
                }
            } ?>
        </ul>
    </div>
<?php } ?>


