<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "demo_db";
$con = new mysqli($host, $user, $password, $database);
if ($con->connect_error) {
    echo "Connection Fail: " . $con->connect_error;
    exit;
}

// Assuming you have a table named 'images' with a column 'image_path'
$query = "SELECT image_path FROM images";
$result = $con->query($query);

if (!$result) {
    echo "Query Error: " . $con->error;
    exit;
}

$imagePaths = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagePaths[] = $row['image_path'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simplest jQuery Slideshow</title>
    <!-- Your CSS styles -->
    <!-- ... -->

    <style>
        /* Your existing CSS styles */
        /* ... */
    </style>
</head>
<body>
    <div class="fadein">
        <?php foreach ($imagePaths as $imgPath) : ?>
            <img src="<?php echo $imgPath; ?>" alt="<?php echo basename($imgPath); ?>">
        <?php endforeach; ?>
    </div>
    <div class="slideshow-controls">
        <!-- Your slideshow controls -->
        <!-- ... -->
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        // Your existing jQuery code
        // ...
    </script>
</body>
</html>
