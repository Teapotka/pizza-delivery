<?php
include_once("partials/header.php");
$order_object = new Order();
$order_display = $order_object->displayOrders();
$total_display = $order_object->displayTotal();
?>

<main class="container-fluid d-flex flex-column background justify-content-center align-items-center mt-3 gap-4">
    <?php
        echo($order_display);
        echo($total_display);
    ?>    
</main>

<?php
include_once("partials/footer.php");
?>