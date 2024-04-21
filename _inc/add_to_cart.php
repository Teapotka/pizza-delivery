<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['_method']) && $_POST['_method'] === 'DELETE'){
        $pizza_id = $_POST['order_id'];
        $order_object = new Order();
        $order_object->deleteOrder($pizza_id);
    }
    else {
        $pizza_id = $_POST['pizza_id'];
        $size_id = $_POST['size_id'];
        $order_object = new Order();
        $orders = $order_object->selectOrderIds();
        $count = 0;
        foreach($orders as $order){
            if(($order->pizza_id == $pizza_id) && ($order->size_id == $size_id)){
                $count = $order->pieces;
            }
        }
        if($count == 0){
            $order_object->createOrder($pizza_id, $size_id, $count+1);
        }
        else{
            $order_object->updateOrderPieces($pizza_id, $size_id, $count+1);
        }
        // $count = $count + 1;
        // $order_object->createOrder($pizza_id, $size_id, $count);
    }
    // Retrieve pizza ID from POST data

    // Execute SQL query to add pizza to cart
    // Example:
    // INSERT INTO cart (pizza_id) VALUES (:pizzaId)
    
    // Redirect back to the page where the form was submitted from
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>