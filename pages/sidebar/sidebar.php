
<div class="sidebar">

                <H1 style="text-align: center;">Sản Phẩm</H1>
                <ul class="list_sidebar"> 
                    
    <?php
     $sql="SELECT * FROM danhmuc order by thutu ASC";
     $query = mysqli_query($con,$sql);
     while($row=mysqli_fetch_array($query )){
        ?>
        <li>
            <a href="index.php?quanly=danhmucsanpham&id=<?php echo $row['thutu'] ?>"><?php echo $row['tendanhmuc']?>  </a>
        </li>
        <?php
    };
         ?>
    </ul>
</div>