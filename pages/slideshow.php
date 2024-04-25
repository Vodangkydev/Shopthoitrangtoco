<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplest jQuery Slideshow</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
           left: 50px;

        }

        .fadein {
            position: relative;
            height: 400px;
            width: 1400px;
            margin: 30px;
            background: #ebebeb;
            padding: 0px;
            left: 75px;
        }

        .fadein img {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .slideshow-controls {
            position: relative;
            margin-top: 2px;
            text-align: center;
        }

        .slideshow-controls span {
            cursor: pointer;
            display: inline-block;
            font-size: 24px;
            color: #000; /* Màu sắc của icon mũi tên */
        }

        .prev-slide,
        .next-slide {
            position: absolute;
            transform: translateY(-800%);

        }

        .prev-slide {
            left: 50px;
        }

        .next-slide {
            right: 50px;
        }

        .prev-slide::before,
        .next-slide::before {
            content: "\2039"; /* Mũi tên bên trái */
        }

        .next-slide::before {
            content: "\203A"; /* Mũi tên bên phải */
        }
        body {
            font-family: Arial, Helvetica, sans-serif;

        }
    </style>
</head>
<body>
    <div class="fadein">
        <?php 
        // display images from directory
        $dir = "./images/banner/";
        $scan_dir = scandir($dir);
        foreach($scan_dir as $img):
            if(in_array($img,array('.','..')))
                continue;
        ?>
            <img src="<?php echo $dir.$img ?>" alt="<?php echo $img ?>">
        <?php endforeach; ?>
    </div>
    <div class="slideshow-controls">
        <span class="prev-slide">&lt;</span>
        <span class="next-slide">&gt;</span>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(function(){
            $('.fadein img:gt(0)').hide();
            
            var interval = setInterval(function(){
                $('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');
            }, 3000);

            $('.prev-slide').click(function() {
                clearInterval(interval); // Clear previous interval to stop auto slideshow
                $('.fadein img:first-child').fadeOut().appendTo('.fadein');
                $('.fadein img:last-child').fadeIn();
            });

            $('.next-slide').click(function() {
                clearInterval(interval); // Clear previous interval to stop auto slideshow
                $('.fadein img:first-child').fadeOut();
                $('.fadein img:last-child').prependTo('.fadein').fadeIn();
            });
        });
    </script>
</body>
</html>
