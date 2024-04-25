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
                if (isset($_POST['thutu']) && !empty($_POST['thutu']) && isset($_POST['tendanhmuc']) && !empty($_POST['tendanhmuc'])) {
                    if (empty($_POST['thutu'])) {
                        $error = "Bạn phải nhập thứ tự Danh mục";
                    } elseif (empty($_POST['tendanhmuc'])) {
                        $error = "Bạn phải nhập tên Danh mục";
                    
                    }
                    
                   
                    
                    
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại sản phẩm
                            $result = mysqli_query($con, "UPDATE `danhmuc` SET `tendanhmuc` = '" . $_POST['tendanhmuc'] . "', `thutu` = '" . $_POST['thutu'] . "', `last_updated` = '".$now."' WHERE `danhmuc`.`id` = " . $_GET['id']);
                        } else { //Thêm sản phẩm
                            $result = mysqli_query($con, "INSERT INTO `danhmuc` (`id`, `tendanhmuc`, `thutu`, `created_time`, `last_updated`) VALUES (NULL, '" . $_POST['tendanhmuc'] . "','" . $_POST['thutu'] . "', '".$now."', '".$now."');");
                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                            
                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "danhmuc_listing.php">Quay lại danh sách sản phẩm</a>
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($con, "SELECT * FROM `danhmuc` WHERE `id` = " . $_GET['id']);
                    $product = $result->fetch_assoc();
                   
                }
                ?>
                <form id="product-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Thứ tự: </label>
                        <input type="text" name="thutu" value="<?= (!empty($product) ? $product['thutu'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Tên danh mục: </label>
                        <input type="text" name="tendanhmuc" value="<?= (!empty($product) ? $product['tendanhmuc'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
           
                   
                </form>
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
    <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>