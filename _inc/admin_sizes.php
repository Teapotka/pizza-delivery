<?php
include('config.php');
$pizza = new Pizza();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $method = $_POST['_method'];
    $sizeId = $_POST['size_id'] ?? null;
    $size = $_POST['size'];
    $surcharge = $_POST['surcharge'];
    switch ($method) {
        case 'CREATE':
            $pizza->createSize($size, $surcharge);
            break;
        case 'UPDATE':
            if ($sizeId) {
                $pizza->updateSize($sizeId, $size, $surcharge);
            }
            break;
        case 'DELETE':
            if ($sizeId) {
                $pizza->deleteSize($sizeId);
            }
            break;
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>