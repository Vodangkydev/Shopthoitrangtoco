
<?php
session_start();
include "../../connect_db.php";
//xoá tất cả trong giỏ hàng
if(isset($_GET['xoatatca']) && ($_GET['xoatatca']==1)){
    unset($_SESSION['cart']);
    header("Location: ../../index.php?quanly=giohang");
    exit();
}

//xoá 1 sản phẩm được chọn
if(isset($_SESSION['cart']) && isset($_GET['xoa'])){
    $id = $_GET['xoa'];
    $product = array();

    foreach($_SESSION['cart'] as $cart_item){
        // Giữ lại tất cả sản phẩm KHÔNG trùng id cần xoá
        if($cart_item['id'] != $id){
            $product[] = array(
                'id'      => $cart_item['id'],
                'name'    => $cart_item['name'],
                'image'   => $cart_item['image'],
                'soluong' => $cart_item['soluong'],
                'size'    => $cart_item['size'],
                'giasp'   => $cart_item['giasp']
            );
        }
    }

    // Nếu sau khi xoá còn sản phẩm thì cập nhật lại giỏ,
    // còn nếu không thì huỷ luôn session giỏ hàng
    if(!empty($product)){
        $_SESSION['cart'] = $product;
    }else{
        unset($_SESSION['cart']);
    }

    header("Location: ../../index.php?quanly=giohang");
    exit();
}
//thêm 1 số lượng sản phẩm
if(isset($_SESSION['cart']) && (isset($_GET['cong']))){
    $id=$_GET['cong'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
          
        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
        $_SESSION['cart']=$product;
        
    }else{
            
            if($cart_item['soluong']<10){
                $tangsoluong=$cart_item['soluong']+1;
                $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
            }else{
                $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
            }
        }
        $_SESSION['cart']=$product;
        
    }
    header("Location: ../../index.php?quanly=giohang");

}
//xoá 1 số lượng sản phẩm
if(isset($_SESSION['cart']) && (isset($_GET['tru']))){
    $id=$_GET['tru'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
          
        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
        $_SESSION['cart']=$product;
        
    }else{
            
            if($cart_item['soluong']>1){
                $tangsoluong=$cart_item['soluong']-1;
                $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
            }else{
                $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
            }
        }
        $_SESSION['cart']=$product;
        
    }
    header("Location: ../../index.php?quanly=giohang");

}
//chọn size
if(isset($_SESSION['cart']) && (isset($_GET['sizeL']))){
    $id=$_GET['sizeL'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
          
        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
        $_SESSION['cart']=$product;
        
        }else{
            $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>'Size L','giasp'=>$cart_item['giasp']);
           
        }
        $_SESSION['cart']=$product;
        
    }
    header("Location: ../../index.php?quanly=giohang");

}
//chọn size
if(isset($_SESSION['cart']) && (isset($_GET['sizeM']))){
    $id=$_GET['sizeM'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
          
        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
        $_SESSION['cart']=$product;
        
        }else{
            $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>'Size M','giasp'=>$cart_item['giasp']);
           
        }
        $_SESSION['cart']=$product;
        
    }
    header("Location: ../../index.php?quanly=giohang");

}
//chọn size
if(isset($_SESSION['cart']) && (isset($_GET['sizeXL']))){
    $id=$_GET['sizeXL'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
          
        $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
        $_SESSION['cart']=$product;
        
        }else{
            $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>'Size XL','giasp'=>$cart_item['giasp']);
           
        }
        $_SESSION['cart']=$product;
        
    }
    header("Location: ../../index.php?quanly=giohang");

}


//thêm sản phẩm vào giỏ hàng / Mua ngay
if(isset($_POST['themgiohang']) || isset($_POST['muangay'])){
  $id = $_GET['idsanpham'];
  $soluong = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
  $selected_size = isset($_POST['selected_size']) ? $_POST['selected_size'] : 'Size M';
  
  // Validate số lượng
  if($soluong < 1) $soluong = 1;
  if($soluong > 10) $soluong = 10;
  
  $sql = "SELECT * FROM product where id='$id' limit 1";
  $query = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($query);
  if($row){
      // Tính giá sale nếu có discount
      $discount = isset($row['discount_percent']) ? (int)$row['discount_percent'] : 0;
      $final_price = $row['price'];
      if($discount > 0 && $discount <= 100) {
          $final_price = $row['price'] * (1 - $discount / 100);
      }
      
      $new_product = array(array(
          'id'=>$row['id'],
          'name'=>$row['name'],
          'image'=>$row['image'],
          'soluong'=>$soluong,
          'size'=>$selected_size,
          'giasp'=>$final_price
      ));
      
      if(isset($_SESSION['cart'])){
          $found = false;
          $product = array();
          foreach($_SESSION['cart'] as $cart_item){
              // Kiểm tra cùng sản phẩm và cùng size
              if($cart_item['id']==$id && $cart_item['size']==$selected_size){
                  $new_soluong = $cart_item['soluong'] + $soluong;
                  if($new_soluong > 10) $new_soluong = 10;
                  $product[] = array(
                      'id'=>$cart_item['id'],
                      'name'=>$cart_item['name'],
                      'image'=>$cart_item['image'],
                      'soluong'=>$new_soluong,
                      'size'=>$cart_item['size'],
                      'giasp'=>$cart_item['giasp']
                  );
                  $found = true;
              }else{
                  $product[] = array(
                      'id'=>$cart_item['id'],
                      'name'=>$cart_item['name'],
                      'image'=>$cart_item['image'],
                      'soluong'=>$cart_item['soluong'],
                      'size'=>$cart_item['size'],
                      'giasp'=>$cart_item['giasp']
                  );
              }
          }
          if($found==false){
              $_SESSION['cart'] = array_merge($product,$new_product);
          } else {
              $_SESSION['cart']=$product;
          }
      } else {
          $_SESSION['cart']=$new_product;
      }
      // Điều hướng sau khi xử lý
      if(isset($_POST['muangay'])){
          // Mua ngay: chuyển thẳng sang bước vận chuyển
          header("Location: ../../index.php?quanly=vanchuyen");
          exit();
      } else {
          // Thêm vào giỏ: ở lại giỏ hàng
          echo '<script>alert("Đã thêm sản phẩm vào giỏ hàng thành công!"); window.location.href="../../index.php?quanly=giohang";</script>';
          exit();
      }
  } else {
      echo '<script>alert("Không tìm thấy sản phẩm!"); window.location.href="../../index.php";</script>';
      exit();
  }
}
?>