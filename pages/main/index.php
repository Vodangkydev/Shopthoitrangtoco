<?php

    if(isset($_GET['trang'])){
        $page=$_GET['trang'];
    }
    else{
        $page="1";
    }
    if($page==''||$page==1){
        $begin=0;
    }
    else{
        $begin=($page*4)-4;
    }

    $sql="SELECT *From product group by id DESC limit $begin,4";
    $result = mysqli_query($con,$sql);
    $title="Sản Phẩm Mới Nhất";

 
 
?>
<h3 style="text-align: center;"><?= $title ?><h3>
                <ul class="product_list">
                    <?php 
                    while($row = mysqli_fetch_array($result)){
                     
                        ?>
                    <li>
                        <a href="index2.php?quanly=sanpham&id=<?= $row['id'] ?> " > 
                        <img src="/admin/<?= $row['image'] ?>">
                        <p class="name_sp">Tên Sản Phẩm: <?= $row['name'] ?></p>
                        <p class="gia_sp">Giá: <?= number_format($row['price'],0,',','.').' VNĐ'?></p>
                        </a>
                    </li>

                    <?php 
                    }
                    ?>
                </ul>
                <div class="clear"></div>
                <div class="trang">
                <p>Trang hiện tại: <?php echo $page ?></p>
                <?php 
                $sql_trang =mysqli_query($con,"SELECT *FROM product ");
                $row_count= mysqli_num_rows($sql_trang);
                $trang=ceil($row_count/4);
                ?>
                <ul class="list_trang">
                    <?php
                    for($i=1;$i<=$trang;$i++){
                        ?>
                        <li <?php if($i==$page) {echo 'style="background:red"';}  else {echo '';} ?>><a  href="index2.php?trang=<?php echo $i?>"><?php echo $i?></a></li> 
                        <?php if($i%3==0){?><br><br>
                           <?php }?>
                        <?php 
                    }?>
                    
                    
                </ul>
                </div>
                <div class="clear"></div>
