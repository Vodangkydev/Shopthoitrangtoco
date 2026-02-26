<?php
include 'header.php';
	require('../../carbon/autoload.php');

	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    
	$now = Carbon::now('Asia/Ho_Chi_Minh');
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa sản phẩm") : "Thêm sản phẩm" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    $galleryImages = array();
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (!isset($image) && !empty($_POST['image'])) {
                        $image = $_POST['image'];
                    }
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!empty($_POST['gallery_image'])) {
                        $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                    }
                    if (!isset($error)) {
                        $discount_percent = isset($_POST['discount_percent']) ? (int)$_POST['discount_percent'] : 0;
                        if ($discount_percent < 0) $discount_percent = 0;
                        if ($discount_percent > 100) $discount_percent = 100;
                        
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại sản phẩm
							$danhmuc =$_POST['danhmuc'];
                            // Kiểm tra xem cột discount_percent có tồn tại không
                            $checkColumn = mysqli_query($con, "SHOW COLUMNS FROM `product` LIKE 'discount_percent'");
                            if(mysqli_num_rows($checkColumn) > 0) {
                                $sql = "UPDATE `product` SET `name` = '" . mysqli_real_escape_string($con, $_POST['name']) . "',`id_danhmuc` =  '" . mysqli_real_escape_string($con, $danhmuc) . "',`image` =  '" . mysqli_real_escape_string($con, $image) . "', `price` = " . str_replace('.', '', $_POST['price']) . ", `discount_percent` = " . $discount_percent . ", `content` = '" . mysqli_real_escape_string($con, $_POST['content']) . "', `last_updated` = '".$now."' WHERE `product`.`id` = " . (int)$_GET['id'];
                            } else {
                                $sql = "UPDATE `product` SET `name` = '" . mysqli_real_escape_string($con, $_POST['name']) . "',`id_danhmuc` =  '" . mysqli_real_escape_string($con, $danhmuc) . "',`image` =  '" . mysqli_real_escape_string($con, $image) . "', `price` = " . str_replace('.', '', $_POST['price']) . ", `content` = '" . mysqli_real_escape_string($con, $_POST['content']) . "', `last_updated` = '".$now."' WHERE `product`.`id` = " . (int)$_GET['id'];
                            }
                            $result = mysqli_query($con, $sql);
                        } else { //Thêm sản phẩm
							$danhmuc =$_POST['danhmuc'];
                            // Kiểm tra xem cột discount_percent có tồn tại không
                            $checkColumn = mysqli_query($con, "SHOW COLUMNS FROM `product` LIKE 'discount_percent'");
                            if(mysqli_num_rows($checkColumn) > 0) {
                                $sql = "INSERT INTO `product`(`id`, `id_danhmuc`, `name`, `image`, `price`, `discount_percent`, `content`, `created_time`, `last_updated`) VALUES (NULL, '" . mysqli_real_escape_string($con, $danhmuc) . "','" . mysqli_real_escape_string($con, $_POST['name']) . "','" . mysqli_real_escape_string($con, $image) . "', " . str_replace('.', '', $_POST['price']) . ", " . $discount_percent . ", '" . mysqli_real_escape_string($con, $_POST['content']) . "', '".$now."', '".$now."')";
                            } else {
                                $sql = "INSERT INTO `product`(`id`, `id_danhmuc`, `name`, `image`, `price`, `content`, `created_time`, `last_updated`) VALUES (NULL, '" . mysqli_real_escape_string($con, $danhmuc) . "','" . mysqli_real_escape_string($con, $_POST['name']) . "','" . mysqli_real_escape_string($con, $image) . "', " . str_replace('.', '', $_POST['price']) . ", '" . mysqli_real_escape_string($con, $_POST['content']) . "', '".$now."', '".$now."')";
                            }
                            $result = mysqli_query($con, $sql);
                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Có lỗi xảy ra trong quá trình thực hiện: " . mysqli_error($con);
                        } else { //Nếu thành công
                            if (!empty($galleryImages)) {
                                $product_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
                                $insertValues = "";
                                foreach ($galleryImages as $path) {
                                    if (empty($insertValues)) {
                                        $insertValues = "(NULL, " . $product_id . ", '" . $path . "', '".$now."', '".$now."')";
                                    } else {
                                        $insertValues .= ",(NULL, " . $product_id . ", '" . $path . "', '".$now."', '".$now."')";
                                    }
                                }
                                $result = mysqli_query($con, "INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
                            }
                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "product_listing.php">Quay lại danh sách sản phẩm</a>
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = " . $_GET['id']);
                    $product = $result->fetch_assoc();
                    $gallery = mysqli_query($con, "SELECT * FROM `image_library` WHERE `product_id` = " . $_GET['id']);
                    if (!empty($gallery) && !empty($gallery->num_rows)) {
                        while ($row = mysqli_fetch_array($gallery)) {
                            $product['gallery'][] = array(
                                'id' => $row['id'],
                                'path' => $row['path']
                            );
                        }
                    }
                }
                ?>
                <form id="product-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
					
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="text" name="name" value="<?= (!empty($product) ? $product['name'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
					<div class="wrap-field">
					<label>Tên Danh mục: </label>
					<select name="danhmuc">
					<?php
					$sql_danhmuc = "SELECT * FROM danhmuc ORDER BY thutu DESC";
					$query_danhmuc = mysqli_query($con,$sql_danhmuc);
					$current_danhmuc = !empty($product) && isset($product['id_danhmuc']) ? $product['id_danhmuc'] : '';
					while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
					?>
					<option value="<?php echo $row_danhmuc['thutu'] ?>" <?= ($current_danhmuc == $row_danhmuc['thutu']) ? 'selected' : '' ?>><?php echo $row_danhmuc['tendanhmuc'] ?></option>
					<?php
					} 
					?>
					</select> <br>
					<br>

					<div class="clear-both"></div>
					</div>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" id="product_price" value="<?= (!empty($product) ? number_format($product['price'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="wrap-field">
                        <label>Giảm giá (%): </label>
                        <select name="discount_percent" id="discount_percent" onchange="calculateSalePrice()">
                            <option value="0" <?= (!empty($product) && isset($product['discount_percent']) && $product['discount_percent'] == 0) ? 'selected' : '' ?>>Không giảm giá</option>
                            <?php for($i = 10; $i <= 100; $i += 10) { ?>
                                <option value="<?= $i ?>" <?= (!empty($product) && isset($product['discount_percent']) && $product['discount_percent'] == $i) ? 'selected' : '' ?>><?= $i ?>%</option>
                            <?php } ?>
                        </select>
                        <div id="sale_preview" style="margin-top: 10px; padding: 15px; background: #fff5f5; border: 2px solid #dc3545; border-radius: 4px; display: none;">
                            <div style="color: #dc3545; font-weight: bold; margin-bottom: 8px; font-size: 14px;">Xem trước giá sale:</div>
                            <div style="color: #dc3545; font-size: 20px; font-weight: bold; margin-bottom: 8px;">
                                Giá sale: <span id="sale_price_display"></span>
                            </div>
                            <div style="color: #333; margin-top: 8px; font-size: 14px; padding-top: 8px; border-top: 1px solid #ffcccc;">
                                <span style="color: #dc3545; font-weight: bold; font-size: 16px;">Giảm: <span id="discount_amount"></span></span>
                                <span style="color: #dc3545; font-weight: bold; font-size: 16px; margin-left: 10px;">(<span id="discount_percent_display"></span>)</span>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
					
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
        <?php if (!empty($product['image'])) { ?>
                                <img src="../<?= $product['image'] ?>" /><br/>
                                <input type="hidden" name="image" value="<?= $product['image'] ?>" />
        <?php } ?>
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>	
                    </div>
                    <div class="wrap-field">
                        <label>Thư viện ảnh: </label>
                        <div class="right-wrap-field">
                                <?php if (!empty($product['gallery'])) { ?>
                                <ul>
            <?php foreach ($product['gallery'] as $image) { ?>
                                        <li>
                                            <img src="../<?= $image['path'] ?>" />
											<br><br><br>
                                            <a href="product_delete_thuvienanh.php?id=<?= $image['id'] ?>">Xóa</a>
                                        </li>
                                <?php } ?>
                                </ul>
                            <?php } ?>
                            <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                                <?php foreach ($product['gallery'] as $image) { ?>
                                    <input type="hidden" name="gallery_image[]" value="<?= $image['path'] ?>" />
                                <?php } ?>
        <?php } ?>
                            <input multiple="" type="file" name="gallery[]" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content"><?= (!empty($product) ? $product['content'] : "") ?></textarea>
                        <div class="clear-both"></div>
                    </div>
                </form>
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                    
                    // Tính toán giá sale khi chọn discount
                    function calculateSalePrice() {
                        var priceInput = document.getElementById('product_price');
                        var discountSelect = document.getElementById('discount_percent');
                        var previewDiv = document.getElementById('sale_preview');
                        var salePriceDisplay = document.getElementById('sale_price_display');
                        var discountAmountDisplay = document.getElementById('discount_amount');
                        var discountPercentDisplay = document.getElementById('discount_percent_display');
                        
                        var priceStr = priceInput.value.replace(/\./g, '').replace(/,/g, '');
                        var price = parseFloat(priceStr);
                        var discount = parseInt(discountSelect.value);
                        
                        if (!isNaN(price) && price > 0 && discount > 0) {
                            var salePrice = price * (1 - discount / 100);
                            var discountAmount = price - salePrice;
                            
                            salePriceDisplay.textContent = formatNumber(salePrice) + '₫';
                            discountAmountDisplay.textContent = formatNumber(discountAmount) + '₫';
                            discountPercentDisplay.textContent = discount + '%';
                            previewDiv.style.display = 'block';
                        } else {
                            previewDiv.style.display = 'none';
                        }
                    }
                    
                    function formatNumber(num) {
                        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                    
                    // Tính toán khi thay đổi giá
                    document.getElementById('product_price').addEventListener('input', calculateSalePrice);
                    // Tính toán khi load trang
                    if (document.getElementById('discount_percent').value > 0) {
                        calculateSalePrice();
                    }
                </script>
    <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>
