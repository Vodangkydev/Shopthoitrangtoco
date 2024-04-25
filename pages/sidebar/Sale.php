<?php
$link = "http://localhost:8080/index.php?quanly=tintuc"; // Define the link you want to redirect to when "Sale" is clicked
$imageWidth = "300px"; // Set the width of the image
$imageHeight = "420px"; // Set the height of the image
?>
<div class="sidebar" style="text-align: center;">
    <p style="font-weight: bold; font-family: Arial, sans-serif;">
        <a href="<?php echo $link; ?>" style="text-decoration: none; color: inherit;">
            Sale
        </a>
    </p>
    <a href="<?php echo $link; ?>">
        <img src="./images/sale.jpg" alt="Sale Image" width="<?php echo $imageWidth; ?>" height="<?php echo $imageHeight; ?>">
    </a>
</div>
