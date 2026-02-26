<?php
$perPage = 10;
$page = isset($_GET['trang']) ? max(1, (int)$_GET['trang']) : 1;
$offset = ($page - 1) * $perPage;
$danhmucId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$tatcasanpham = ($danhmucId === 0) ? 0 : 1;

// Lấy tên danh mục
if($tatcasanpham === 0){
    $title = "Tất cả sản phẩm";
} else {
    $sql1 = "SELECT * FROM danhmuc WHERE thutu = '$danhmucId' LIMIT 1";
    $result1 = mysqli_query($con,$sql1);
    $rowtitle = mysqli_fetch_array($result1);
    $title = isset($rowtitle['tendanhmuc']) ? $rowtitle['tendanhmuc'] : 'Danh mục';
}

// Đếm tổng sản phẩm
if($tatcasanpham === 0){
    $totalRes = mysqli_query($con,"SELECT COUNT(*) as total FROM product");
} else {
    $totalRes = mysqli_query($con,"SELECT COUNT(*) as total FROM product WHERE id_danhmuc = $danhmucId");
}
$totalRow = mysqli_fetch_assoc($totalRes);
$totalProducts = (int)$totalRow['total'];
$totalPages = max(1, ceil($totalProducts / $perPage));
if($page > $totalPages){
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}

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
        $orderBy = "CASE WHEN discount_percent > 0 THEN price * (1 - discount_percent / 100) ELSE price END ASC";
        break;
    case 'sale_high':
        $orderBy = "CASE WHEN discount_percent > 0 THEN price * (1 - discount_percent / 100) ELSE price END DESC";
        break;
    default:
        $orderBy = "id DESC";
}

// Lấy sản phẩm theo trang
if($tatcasanpham === 0){
    $sql = "SELECT * FROM product ORDER BY $orderBy LIMIT $perPage OFFSET $offset";
} else {
    $sql = "SELECT * FROM product WHERE id_danhmuc = $danhmucId ORDER BY $orderBy LIMIT $perPage OFFSET $offset";
}
$result = mysqli_query($con,$sql);

// Wishlist
$wishlist = isset($_SESSION['wishlist']) && is_array($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];

// Reuse renderer nếu đã có, nếu chưa thì định nghĩa
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

<div class="page-header" id="category">
    <div>
        <h2>Sản phẩm: <?= $title ?></h2>
        <p class="product-count">Tổng <?= $totalProducts; ?> sản phẩm</p>
    </div>
    <div style="display: flex; align-items: center; gap: 10px;">
        <label for="sort_filter" style="font-weight: bold;">Sắp xếp theo:</label>
        <select id="sort_filter" name="sort" onchange="window.location.href='index.php?quanly=danhmucsanpham&id=<?= $danhmucId ?>&trang=1&sort=' + this.value + '#category'" style="padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
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
        <?php while($row = mysqli_fetch_array($result)){ renderProductCard($row, false, $wishlist); } ?>
    </ul>
</div>

<?php if($totalPages > 1){ ?>
<div class="trang">
    <p>Trang hiện tại: <?= $page ?></p>
    <ul class="list_trang">
        <?php if($page > 1){ ?>
            <li><a href="index.php?quanly=danhmucsanpham&id=<?= $danhmucId ?>&trang=<?= $page - 1 ?>&sort=<?= $sortBy ?>#category">«</a></li>
        <?php } ?>
        <?php for($i = 1; $i <= $totalPages; $i++){ ?>
            <li <?php if($i==$page){echo 'style="background:red"';} ?>><a href="index.php?quanly=danhmucsanpham&id=<?= $danhmucId ?>&trang=<?= $i ?>&sort=<?= $sortBy ?>#category"><?= $i ?></a></li>
        <?php } ?>
        <?php if($page < $totalPages){ ?>
            <li><a href="index.php?quanly=danhmucsanpham&id=<?= $danhmucId ?>&trang=<?= $page + 1 ?>&sort=<?= $sortBy ?>#category">»</a></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>

<div class="clear"></div>