<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['_method']) && $_POST['_method'] === 'DELETE'){
        $pizza_id = $_POST['order_id'];
        $order_object = new Order();
        $order_object->deleteOrder($pizza_id);

    }
    else if (isset($_POST['_method']) && $_POST['_method'] === 'PATCH'){
        $order_id = $_POST['order_id'];
        $delta = $_POST['delta'];
        $order_object = new Order();
        $order_object->updateOrderPieces($order_id, $delta);

    }
    else {
        $order_object = new Order();
        $pizza_id = $_POST['pizza_id'];
        $size_id = $_POST['size_id'];

        $order_object->createOrder($pizza_id, $size_id, session_status());
        $session_object = new Session();
    
    }
    
    // Redirect back to the page where the form was submitted from
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>