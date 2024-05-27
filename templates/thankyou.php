<?php
include_once("partials/header.php");
$title = 'question';
$output = "";
if(isset($_POST["order"]) && $_POST["order"] == "completed"){
    $title = 'order';
    $order_object = new Order();
    $orders = $order_object->selectOrders();
    $output .= "<ul class='text-white'>";
    foreach ($orders as $order) {
        $output .= "<li><h3>".$order['pizza_name']." - ". $order['size']."</h3></li>";
    }
    $output .= "</ul>";
    unset($_SESSION['order']);
}
?>
<main class="container-fluid d-flex flex-column justify-content-center align-items-center">
    <h1 class='text-white my-5'>Thank you for Your <?php echo($title); ?>!</h1>
    <?php echo $output;?>
</main>
<?php
include_once("partials/footer.php");
?>