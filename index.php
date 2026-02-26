<?php
// Bắt đầu output buffering để có thể redirect sau khi đã có output
ob_start();
session_start();

include "connect_db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styletcczz.css">

    <link rel="icon" href="https://vuainnhanh.com/wp-content/uploads/2023/02/logo-van-lang-896x1024-1.png">
    <title>WEBSITE BÁN ĐỒ</title>
</head>
<body>
    <div class="wrapper">
        <?php
        
        include "pages/topbar.php";
        include "pages/header.php";
        include "pages/menu.php";
        include "pages/breadcrumb.php";
       
          
        

        include "pages/main.php";

       


        include "pages/footer.php";
        ?>
    <script src="js/main.js"></script>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="Tocomenswear"
  agent-id="64c671a6-dfe7-4bb3-a6f8-c81e0f9f9c78"
  language-code="en"
></df-messenger>
    </div>

</body>
</html>