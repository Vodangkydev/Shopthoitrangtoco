
<?php
if(isset($_SESSION['dangnhap'])){
  

?>
<?php  
    if(isset($_SESSION['cart'])){

        }

?>
<?php
  if(isset($_SESSION['id_khachhang'])){
  
    ?>
    <br>
    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">
    <div class="step current"> <span> <a href="index.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step"> <span><a href="index.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step"> <span><a href="index.php?quanly=hinhthucthanhtoan" >Thanh toán</a><span> </div>
    <div class="step"> <span><a href="index.php?quanly=lichsudonhang" >Lịch sử đơn hàng</a><span> </div>
    </div>
    
    <?php
  echo '<h1>Xin chào '.'<span style="color:red">'.$_SESSION['dangnhap'].'</span>    <br></h1>';
} } else{
  echo '<h1>Xin chào <span style="color:red">Vui Lòng Đăng Nhập Để Đặt Hàng</span>    <br></h1>';
}
?>

    <table class="bang" border="1">
    <tr>
        <th>ID</th>
        <th>Tên SP</th>
        <th>Hình Ảnh</th>
        <th>Số lượng</th>
        <th>Size</th>
        <th>Giá SP</th>
        <th>Thành tiền</th>
        <th>Quản lí</th>
    </tr>

    <?php
    
    if(isset($_SESSION['cart'])){
        
        $id=0;
        $tongtien=0;
        $thanhtien=0;
        foreach($_SESSION['cart'] as $cart_item){
            $id++;
            $thanhtien=$cart_item['soluong']*$cart_item['giasp'];
            $tongtien+=$thanhtien;
            
        ?>

    <tr>
        <td><?= $id ?></td>
        <td><?= $cart_item['name'] ?></td>
        <td><img src="./admin<?php echo $cart_item['image'];?>" width="150px" ></td>
        <td>
            <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id']?>">Thêm </a>
            <?= $cart_item['soluong'] ?>
            <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id']?>">Trừ </a>
        </td>
        <td>
        <?= $cart_item['size'] ?><br>
        <p>Chọn Size:
            <a href="pages/main/themgiohang.php?sizeM=<?php echo $cart_item['id']?>">M</a>
            <a href="pages/main/themgiohang.php?sizeL=<?php echo $cart_item['id']?>">L</a>
            <a href="pages/main/themgiohang.php?sizeXL=<?php echo $cart_item['id']?>">XL</a></p>
        </td>
        <td><?= number_format($cart_item['giasp'],0,',','.').' VNĐ'?></td>
        <td><?=number_format($thanhtien,0,',','.').' VNĐ' ?></td>
        <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id']?>">Xoá</td>

    </tr>
    <?php } ?>
    <tr>
      <td colspan="8">
        <p style="color:red;font-size: 25px; font-weight: bold;">Tổng tiền: <?=  number_format($tongtien,0,',','.').' VNĐ' ?></p>
        <p><a class="chinhsua" href="pages/main/themgiohang.php?xoatatca=1">Xoá tất cả</p>
        <?php
        if(isset($_SESSION['dangnhap'])){
            ?>
            <p><a class="chinhsua" href="index.php?quanly=vanchuyen">Đặt hàng</a></p>
       <?php 
       }else{
        ?>
        <p><a class="chinhsua" href="index.php?quanly=dangnhap">Đăng nhập Đặt hàng</a></p>
       
       <?php }?>
        

       
    </td>
      </tr> 
    <?php
    
    }else{
      ?>
      <tr>
      <td colspan="8"><p>Hiện tại không có gì trong giỏ hàng</p></td>
      </tr>  
   <?php } ?>
   
</table>