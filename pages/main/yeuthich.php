
<?php

// Endpoint toggle wishlist (supports AJAX)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['wishlist']) || !is_array($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}

$productId = 0;
if(isset($_POST['id'])){
    $productId = (int)$_POST['id'];
} elseif(isset($_GET['id'])){
    $productId = (int)$_GET['id'];
}

$isAjax = (isset($_POST['ajax']) && $_POST['ajax'] == 1) || (isset($_GET['ajax']) && $_GET['ajax'] == 1);

$favorited = false;
if($productId > 0){
    if(in_array($productId, $_SESSION['wishlist'])){
        $_SESSION['wishlist'] = array_values(array_diff($_SESSION['wishlist'], [$productId]));
        $favorited = false;
    } else {
        $_SESSION['wishlist'][] = $productId;
        $favorited = true;
    }
}

if($isAjax){
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'favorited' => $favorited,
        'count' => count($_SESSION['wishlist']),
    ]);
    exit;
}

// Fallback redirect for non-AJAX access
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
if(!headers_sent()){
    header("Location: $redirect");
}


exit;

