<?php
// Sản phẩm khuyến mãi với pagination (5 sản phẩm/trang)
$salePerPage = 5;
$saleTotalRes = mysqli_query($con, "SELECT COUNT(*) as total FROM product WHERE discount_percent > 0");
$saleTotalRow = mysqli_fetch_assoc($saleTotalRes);
$saleTotalProducts = (int)$saleTotalRow['total'];
$saleTotalPages = max(1, ceil($saleTotalProducts / $salePerPage));
$saleCurrentPage = isset($_GET['sale_page']) ? max(1, (int)$_GET['sale_page']) : 1;
if($saleCurrentPage > $saleTotalPages){
    $saleCurrentPage = $saleTotalPages;
}
$saleOffset = ($saleCurrentPage - 1) * $salePerPage;

// Bộ lọc sắp xếp giá cho sản phẩm sale
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'discount';
$orderBy = "discount_percent DESC, id DESC"; // Mặc định
switch($sortBy) {
    case 'price_low':
        $orderBy = "price ASC";
        break;
    case 'price_high':
        $orderBy = "price DESC";
        break;
    case 'sale_low':
        $orderBy = "price * (1 - discount_percent / 100) ASC";
        break;
    case 'sale_high':
        $orderBy = "price * (1 - discount_percent / 100) DESC";
        break;
    default:
        $orderBy = "discount_percent DESC, id DESC";
}

$saleProducts = mysqli_query($con, "SELECT * FROM product WHERE discount_percent > 0 ORDER BY $orderBy LIMIT $salePerPage OFFSET $saleOffset");

$wishlist = isset($_SESSION['wishlist']) && is_array($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];

// Reuse renderProductCard nếu có
if(!function_exists('renderProductCard')){
    function renderProductCard($row, $isNew = false, $wishlist = []) {
        $discount = isset($row['discount_percent']) ? (int)$row['discount_percent'] : 0;
        $sale_price = 0;
        if($discount > 0 && $discount <= 100) {
            $sale_price = $row['price'] * (1 - $discount / 100);
        }
        $isFavorited = in_array($row['id'], $wishlist);
        ?>
        <li class="product-card">
            <button 
                type="button"
                class="wishlist-toggle <?= $isFavorited ? 'active' : '' ?>" 
                title="<?= $isFavorited ? 'Bỏ yêu thích' : 'Thêm yêu thích' ?>"
                data-product-id="<?= $row['id'] ?>"
                aria-label="Yêu thích"
            >
                <?= $isFavorited ? '♥' : '♡' ?>
            </button>
            <a href="index.php?quanly=sanpham&id=<?= $row['id'] ?>" class="product-link">
                <div class="product-image-wrapper">
                    <?php if($discount > 0){ ?>
                        <span class="discount-badge">-<?= $discount ?>%</span>
                    <?php } ?>
                    <img src="admin/<?= $row['image'] ?>" alt="<?= $row['name'] ?>" class="product-image">
                    <div class="product-overlay">
                        <button type="button" class="quick-view-btn" onclick="event.preventDefault(); window.location.href='index.php?quanly=sanpham&id=<?= $row['id'] ?>'">
                            Xem nhanh
                        </button>
                    </div>
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
}
?>
<div class="page-header">
    <div>
        <h2>Sản phẩm khuyến mãi</h2>
        <p class="product-count">Tổng <?= $saleTotalProducts; ?> sản phẩm đang giảm giá</p>
    </div>
    <div style="display: flex; align-items: center; gap: 10px;">
        <label for="sort_filter" style="font-weight: bold;">Sắp xếp theo:</label>
        <select id="sort_filter" name="sort" onchange="window.location.href='index.php?quanly=tintuc&sale_page=1&sort=' + this.value" style="padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            <option value="discount" <?= $sortBy == 'discount' ? 'selected' : '' ?>>% Giảm giá cao nhất</option>
            <option value="sale_low" <?= $sortBy == 'sale_low' ? 'selected' : '' ?>>Giá sale thấp nhất</option>
            <option value="sale_high" <?= $sortBy == 'sale_high' ? 'selected' : '' ?>>Giá sale cao nhất</option>
            <option value="price_low" <?= $sortBy == 'price_low' ? 'selected' : '' ?>>Giá gốc thấp nhất</option>
            <option value="price_high" <?= $sortBy == 'price_high' ? 'selected' : '' ?>>Giá gốc cao nhất</option>
        </select>
    </div>
</div>
<?php if($saleTotalProducts > 0) { ?>
<div class="products-container">
    <ul class="product_list">
        <?php 
        while($row = mysqli_fetch_array($saleProducts)){
            renderProductCard($row, false, $wishlist);
        }
        ?>
    </ul>
</div>
<?php if($saleTotalPages > 1){ ?>
<div class="trang">
    <p>Trang hiện tại: <?= $saleCurrentPage ?></p>
    <ul class="list_trang">
        <?php if($saleCurrentPage > 1){ ?>
            <li><a href="index.php?quanly=tintuc&sale_page=<?= $saleCurrentPage - 1 ?>&sort=<?= $sortBy ?>">«</a></li>
        <?php } ?>
        <?php for($i = 1; $i <= $saleTotalPages; $i++){ ?>
            <li style="<?= $i == $saleCurrentPage ? 'background:red;' : '' ?>"><a href="index.php?quanly=tintuc&sale_page=<?= $i ?>&sort=<?= $sortBy ?>"><?= $i ?></a></li>
        <?php } ?>
        <?php if($saleCurrentPage < $saleTotalPages){ ?>
            <li><a href="index.php?quanly=tintuc&sale_page=<?= $saleCurrentPage + 1 ?>&sort=<?= $sortBy ?>">»</a></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>
<?php } else { ?>
    <p style="text-align: center; padding: 20px;">Hiện tại không có sản phẩm nào đang khuyến mãi.</p>
<?php } ?>
<div class="clear"></div>
