<?php
include('config.php');
$orderObject = new Order();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST['_method'] ?? null;
    $orderId = $_POST['order_id'] ?? null;

    switch ($method) {
        case 'CREATE':
            $pizzaId = $_POST['pizza_id'];
            $sizeId = $_POST['size_id'];
            $orderObject->createOrder($pizzaId, $sizeId, session_status());
            break;
        case 'UPDATE':
            $delta = $_POST['delta'] ?? 0;
            if ($orderId !== null) {
                $orderObject->updateOrderPieces($orderId, $delta);
            }
            break;
        case 'DELETE':
            if ($orderId !== null) {
                $orderObject->deleteOrder($orderId);
            }
            break;
        default:
            // Handle other types of requests or errors
            http_response_code(400);
            echo 'Bad Request';
            exit;
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>