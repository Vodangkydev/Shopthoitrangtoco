<?php

    $sql="SELECT *From product where id='$_GET[id]'" ;
    $result = mysqli_query($con,$sql);

    $sql_anh = mysqli_query($con,"SELECT * FROM image_library where product_id='$_GET[id]'");



?>


    <?php 
    while($row = mysqli_fetch_array($result)){
    ?>
<form method="POST" action="pages/main/themgiohang.php?idsanpham=<?= $row['id'] ?>">  
<div>
<div class="chitiet_sanpham">   
    <p class="name_sp">Tên Sản Phẩm: <?= $row['name'] ?></p>
    <p class="gia_sp">Giá: <?=  number_format($row['price'],0,',','.').' VNĐ' ?></p>
    <p class="themvaogiohang"><input class="inputgiohang" name="themgiohang" type="submit" value="Thêm giỏ hàng"></p>
    <p class="noi_dung">Nội Dung: <?= $row['content']?></p>
    <p class="name_sp">Chi tiết hình ảnh:</p>
    </div>  
    <div class="clear">               
<div class="hinhanh_sanpham">                
    <img  src="/admin/<?= $row['image'] ?>">
    
</div>   

    <?php 
    while(  $row1=  mysqli_fetch_array($sql_anh)){
    ?>
    <div class="anh_chitiet">
 <img  src="/admin/<?= $row1['path'] ?>"> 
    </div>
    
<?php 
    }
    ?> 
   
    
</from> 
<?php 
    }
    ?>


