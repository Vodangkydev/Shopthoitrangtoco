<?php

    if(isset($_POST['timkiem'])){
        $tukhoa=$_POST['tukhoa'];
    }
    else{
        $tukhoa="";
    }
    $sql="SELECT * From product where name like '%$tukhoa%'";
    $result = mysqli_query($con,$sql);


 
 
?>
<h3 style="text-align: center;">Tìm kiếm: <?= $tukhoa ?><h3>
                <ul class="product_list">
                    <?php 
                    while($row = mysqli_fetch_array($result)){
                     
                        ?>
                    <li>
                        <a href="index2.php?quanly=sanpham&id=<?= $row['id'] ?> " > 
                        <img src="/admin/<?= $row['image'] ?>">
                        <p class="name_sp">Tên Sản Phẩm: <?= $row['name'] ?></p>
                        <p class="gia_sp">Giá: <?= $row['price'] ?></p>
                        </a>
                    </li>

                    <?php 
                    }
                    ?>
                </ul>
                <div class="clear"></div>
     
