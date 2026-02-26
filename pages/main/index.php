<?php
// Hiển thị sản phẩm mới nhất (5 sp) và toàn bộ sản phẩm trên cùng một trang
$latestProducts = mysqli_query($con, "SELECT * FROM product ORDER BY id DESC LIMIT 5");

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
$saleProducts = mysqli_query($con, "SELECT * FROM product WHERE discount_percent > 0 ORDER BY discount_percent DESC, id DESC LIMIT $salePerPage OFFSET $saleOffset");

// Pagination for all products
$perPage = 10;
$totalProductsRes = mysqli_query($con, "SELECT COUNT(*) as total FROM product");
$totalProductsRow = mysqli_fetch_assoc($totalProductsRes);
$totalProducts = (int)$totalProductsRow['total'];
$totalPages = max(1, ceil($totalProducts / $perPage));
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
if($currentPage > $totalPages){
    $currentPage = $totalPages;
}
$offset = ($currentPage - 1) * $perPage;

// Bộ lọc sắp xếp giá
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$orderBy = "id DESC"; // Mặc định
switch($sortBy) {
    case 'price_low':
        $orderBy = "price ASC";
        break;
    case 'price_high':
        $orderBy = "price DESC";
        break;
    case 'sale_low':
        // Sắp xếp theo giá sale thấp nhất (cần tính toán)
        $orderBy = "CASE WHEN discount_percent > 0 THEN price * (1 - discount_percent / 100) ELSE price END ASC";
        break;
    case 'sale_high':
        // Sắp xếp theo giá sale cao nhất
        $orderBy = "CASE WHEN discount_percent > 0 THEN price * (1 - discount_percent / 100) ELSE price END DESC";
        break;
    default:
        $orderBy = "id DESC";
}

$allProducts = mysqli_query($con, "SELECT * FROM product ORDER BY $orderBy LIMIT $perPage OFFSET $offset");

$wishlist = isset($_SESSION['wishlist']) && is_array($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];

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
                <?php if($isNew){ ?>
                    <span class="new-badge">Mới</span>
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
?>

<div class="page-header">
    <div>
        <h2>Sản phẩm mới</h2>
        <p class="product-count">Hiển thị <?= mysqli_num_rows($latestProducts); ?> sản phẩm</p>
    </div>
    <a class="more-link" href="#all-products">Xem tất cả</a>
</div>
<div class="products-container">
    <ul class="product_list">
        <?php while($row = mysqli_fetch_array($latestProducts)){ renderProductCard($row, true, $wishlist); } ?>
    </ul>
</div>

<?php if($saleTotalProducts > 0) { ?>
<div id="sale-products" class="page-header" style="margin-top:40px;">
    <div>
        <h2>Sản phẩm khuyến mãi</h2>
        <p class="product-count">Tổng <?= $saleTotalProducts; ?> sản phẩm đang giảm giá</p>
    </div>
    <?php if($saleTotalPages > 1) { ?>
        <a class="more-link" href="index.php?quanly=tintuc">Xem tất cả</a>
    <?php } ?>
</div>
<div class="products-container">
    <ul class="product_list">
        <?php 
        // Reset result pointer và fetch lại
        $saleProducts = mysqli_query($con, "SELECT * FROM product WHERE discount_percent > 0 ORDER BY discount_percent DESC, id DESC LIMIT $salePerPage OFFSET $saleOffset");
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
            <li><a href="index.php?sale_page=<?= $saleCurrentPage - 1 ?>#sale-products">«</a></li>
        <?php } ?>
        <?php for($i = 1; $i <= $saleTotalPages; $i++){ ?>
            <li style="<?= $i == $saleCurrentPage ? 'background:red;' : '' ?>"><a href="index.php?sale_page=<?= $i ?>#sale-products"><?= $i ?></a></li>
        <?php } ?>
        <?php if($saleCurrentPage < $saleTotalPages){ ?>
            <li><a href="index.php?sale_page=<?= $saleCurrentPage + 1 ?>#sale-products">»</a></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>
<?php } ?>

<div id="all-products" class="page-header" style="margin-top:40px;">
    <div>
        <h2>Tất cả sản phẩm</h2>
        <p class="product-count">Tổng <?= $totalProducts; ?> sản phẩm</p>
    </div>
    <div style="display: flex; align-items: center; gap: 10px;">
        <label for="sort_filter" style="font-weight: bold;">Sắp xếp theo:</label>
        <select id="sort_filter" name="sort" onchange="window.location.href='index.php?sort=' + this.value + '&page=1#all-products'" style="padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            <option value="newest" <?= $sortBy == 'newest' ? 'selected' : '' ?>>Mới nhất</option>
            <option value="price_low" <?= $sortBy == 'price_low' ? 'selected' : '' ?>>Giá thấp nhất</option>
            <option value="price_high" <?= $sortBy == 'price_high' ? 'selected' : '' ?>>Giá cao nhất</option>
            <option value="sale_low" <?= $sortBy == 'sale_low' ? 'selected' : '' ?>>Giá sale thấp nhất</option>
            <option value="sale_high" <?= $sortBy == 'sale_high' ? 'selected' : '' ?>>Giá sale cao nhất</option>
        </select>
    </div>
</div>
<div class="products-container">
    <ul class="product_list">
        <?php while($row = mysqli_fetch_array($allProducts)){ renderProductCard($row, false, $wishlist); } ?>
    </ul>
</div>

<?php if($totalPages > 1){ ?>
<div class="trang">
    <p>Trang hiện tại: <?= $currentPage ?></p>
    <ul class="list_trang">
        <?php if($currentPage > 1){ ?>
            <li><a href="index.php?page=<?= $currentPage - 1 ?>&sort=<?= $sortBy ?>#all-products">«</a></li>
        <?php } ?>
        <?php for($i = 1; $i <= $totalPages; $i++){ ?>
            <li style="<?= $i == $currentPage ? 'background:red;' : '' ?>"><a href="index.php?page=<?= $i ?>&sort=<?= $sortBy ?>#all-products"><?= $i ?></a></li>
        <?php } ?>
        <?php if($currentPage < $totalPages){ ?>
            <li><a href="index.php?page=<?= $currentPage + 1 ?>&sort=<?= $sortBy ?>#all-products">»</a></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>

<div class="clear"></div>
