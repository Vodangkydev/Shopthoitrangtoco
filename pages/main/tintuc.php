<h3 style="text-align: center;text-transform: uppercase;">Sale sản phẩm</h3>
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
if($_GET['id']==0){
    $sql="SELECT *From product limit $begin,4" ;
    $result = mysqli_query($con,$sql);
    $title="Tất cả sản phẩm";
    $tatcasanpham=0;
}
else{
    $tatcasanpham=1;
    $sql="SELECT *From product where  product.id_danhmuc='$_GET[id]' order by product.id_danhmuc desc " ;
    $result = mysqli_query($con,$sql);
    $sql1="SELECT *From danhmuc where thutu ='$_GET[id]' limit 1" ;
    $result1 = mysqli_query($con,$sql1);
    $rowtitle =mysqli_fetch_array($result1);
    $title= $rowtitle['tendanhmuc'] ;
}
?>
<ul class="product_list">
    <?php 
    $discount = 0.2; // Giảm giá 20%
    while($row = mysqli_fetch_array($result)){
        $price = $row['price'] * (1 - $discount); // Giảm giá theo tỷ lệ
        ?>
        <li>
            <a href="index2.php?quanly=sanpham&id=<?= $row['id'] ?> " > 
                <img src="/admin/<?= $row['image'] ?>">
                <p class="name_sp">Tất cả sản phẩm:<br> <?= $row['name'] ?></p>
				<p class="gia_sp">Đã sale: <?= number_format($price,0,',','.').' VNĐ' ?> </p>
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
    if($tatcasanpham==0){
        $sql_trang =mysqli_query($con,"SELECT *FROM product ");
    }
    else{
        $sql_trang =mysqli_query($con,"SELECT *FROM product where id_danhmuc=".$_GET['id']."");
    }
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
        }
        ?>
    </ul>
</div>
<div class="clear"></div>
