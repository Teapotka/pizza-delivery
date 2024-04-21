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
<!-- <div class="item bg-white d-flex w-100 rounded align-items-center justify-content-between p-3">
        <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center w-100 gap-4">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <img src="../assets/img/pizza1.jpg" class="rounded-circle" width="50" />
                <h4>Pizza cicca - 40cm</h4>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="d-flex">
                    <button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-dash-circle d-flex"></i></button>
                    <h3>3 pc.</h3>
                    <button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-plus-circle d-flex"></i></button>
                </div>
                <h3>100 $</h3>
            </div>
        </div>
        <button type="button" class="btn-close"></button>
    </div>
    <div class="item bg-white d-flex w-100 rounded align-items-center justify-content-between p-3">
        <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center w-100 gap-4">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <img src="../assets/img/pizza1.jpg" class="rounded-circle" width="50" />
                <h3>Pizza cicca</h3>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="d-flex">
                    <button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-dash-circle d-flex"></i></button>
                    <h3>3 pc.</h3>
                    <button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-plus-circle d-flex"></i></button>
                </div>
                <h3>100 $</h3>
            </div>
        </div>
        <button type="button" class="btn-close"></button>
    </div>
    <div class="item bg-white d-flex w-100 rounded align-items-center justify-content-between p-3">
        <div class="d-flex flex-sm-row flex-column align-items-center justify-content-center w-100 gap-4">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <img src="../assets/img/pizza1.jpg" class="rounded-circle" width="50" />
                <h3>Pizza cicca</h3>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="d-flex">
                    <button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-dash-circle d-flex"></i></button>
                    <h3>3 pc.</h3>
                    <button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-plus-circle d-flex"></i></button>
                </div>
                <h3>100 $</h3>
            </div>
        </div>
        <button type="button" class="btn-close"></button>
    </div>
    <div class="d-flex align-items-center justify-content-center gap-3">
    <h1 class="text-white">300 $</h1>
    <button class="btn bg-white rounded fw-bold">Order</button>
    </div> -->
    <!-- <div class="d-flex align-items-center justify-content-center gap-3">
    <h1 class="text-white">300 $</h1>
    <button class="btn bg-white rounded fw-bold">Order</button>
    </div> -->
</main>

<?php
include_once("partials/footer.php");
?>