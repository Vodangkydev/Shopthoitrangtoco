
<?php
session_start();
include "../../connect_db.php";
//xoá tất cả trong giỏ hàng
if(isset($_GET['xoatatca'])&& ($_GET['xoatatca']==1)){
    unset($_SESSION['cart']);
   header("Location: ../../index2.php?quanly=giohang");

}
//xoá 1 cái
if(isset($_SESSION['cart']) && (isset($_GET['xoa']))){
    $id=$_GET['xoa'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
           
            $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>$cart_item['size'],'giasp'=>$cart_item['giasp']);
            $_SESSION['cart']=$product;
        }       
        $_SESSION['cart']=$product;

        

        header("Location: ../../index2.php?quanly=giohang");
    }

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
    header("Location: ../../index2.php?quanly=giohang");

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
    header("Location: ../../index2.php?quanly=giohang");

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
    header("Location: ../../index2.php?quanly=giohang");

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
    header("Location: ../../index2.php?quanly=giohang");

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
    header("Location: ../../index2.php?quanly=giohang");

}


//thêm sản phẩm vào giỏ hàng
if(isset($_POST['themgiohang'])){
   //  session_destroy();
  $id =$_GET['idsanpham'];
    $soluong=1;
    $sql = "SELECT * FROM product where id='$id' limit 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);
    if($row){
        $new_product = array(array('id'=>$row['id'],'name'=>$row['name'],'image'=>$row['image'],'id'=>$id,'soluong'=>$soluong,'size'=>'Size M','giasp'=>$row['price']));
        if(isset($_SESSION['cart'])){
            $found = false;
            foreach($_SESSION['cart'] as $cart_item){
                if($cart_item['id']==$id ){
                    $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong']+1,'size'=>'Size M','giasp'=>$cart_item['giasp']);
                    $found =true;
                }else{
                    $product[] = array('id'=>$cart_item['id'],'name'=>$cart_item['name'],'image'=>$cart_item['image'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'size'=>'Size M','size'=>'Size M','giasp'=>$cart_item['giasp']);
                }
            }
            if($found==false){
                $_SESSION['cart'] = array_merge($product,$new_product);
            
            }
            else{
                $_SESSION['cart']=$product;
            }
        }
        else{
            $_SESSION['cart']=$new_product;
        }
    }
  header('Location: ../../index2.php?quanly=giohang');
}
?>