<?php
include 'header.php';
	require('../../carbon/autoload.php');

	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    
	$now = Carbon::now('Asia/Ho_Chi_Minh');
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Thông tin liên hệ</h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'add') {
                
                    
                    
                   
                    
                    if(isset($_POST['content']) && !empty($_POST['content'])){
                        if ($_GET['action'] == 'add' ) { //Cập nhật lại sản phẩm
						
                            $result = mysqli_query($con, "UPDATE `lienhe` SET `noidunglienhe` = '" . $_POST['content'] . "' WHERE id =1");
                        }
                        
                    }
					else{
						$error="Vui lòng kiểm tra lại";
					}
               
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "lienhe.php">Quay lại </a>
                </div>
                <?php
            } else {
				 $result = mysqli_query($con, "SELECT * FROM `lienhe` WHERE `id` = 1");
				 $lienhe = $result->fetch_assoc();
                
                ?>
                <form id="product-form" method="POST" action= "?action=add"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
					
				
                  
                   
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content"><?= (!empty($lienhe) ? $lienhe['noidunglienhe'] : "") ?></textarea>
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
