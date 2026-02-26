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
                        $discount = isset($row['discount_percent']) ? (int)$row['discount_percent'] : 0;
                        $sale_price = 0;
                        if($discount > 0 && $discount <= 100) {
                            $sale_price = $row['price'] * (1 - $discount / 100);
                        }
                        ?>
                    <li>
                        <a href="index.php?quanly=sanpham&id=<?= $row['id'] ?> " >
                        <img src="admin/<?= $row['image'] ?>">
                        <p class="name_sp">Tên Sản Phẩm: <?= $row['name'] ?></p>
                        <?php if($discount > 0 && $sale_price > 0){ ?>
                            <p class="gia_sp">Giá: <span style="color: red;"><?= number_format($sale_price,0,',','.').'₫' ?></span> 
                            <span style="text-decoration: line-through; color: #999;"><?= number_format($row['price'],0,',','.').'₫' ?></span>
                            <span style="background: red; color: white; padding: 2px 6px; margin-left: 5px; border-radius: 3px;">-<?= $discount ?>%</span></p>
                        <?php } else { ?>
                            <p class="gia_sp">Giá: <?= number_format($row['price'],0,',','.').'₫' ?></p>
                        <?php } ?>
                        </a>
                    </li>

                    <?php 
                    }
                    ?>
                </ul>
                <div class="clear"></div>
     
