<?php
include_once("partials/header.php");
?>
<main class="container-fluid background justify-content-center">
<div class="types d-flex flex-wrap gap-2 p-3 justify-content-center">
    <div class="tag is-chosen px-3 py-1">Vegan</div>
    <div class="tag px-3 py-1">Vegetarian</div>
    <div class="tag px-3 py-1">Pork</div>
    <div class="tag px-3 py-1">Chicken</div>
    <div class="tag px-3 py-1">Spicy</div>
</div>
<div class="container-fluid">
    <div class="d-flex row gap-4 justify-content-center">
        <div class="card h-100 pizza-card rounded">
            <img src="../assets/img/pizza1.jpg" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Cheeseburger Pizza</h5>
            </div>
            <div class="d-flex gap-2">
                <div class="tag size-tag is-chosen px-1 py-1">26cm</div>
                <div class="tag size-tag px-1 py-1">30cm</div>
                <div class="tag size-tag px-1 py-1">40cm</div>
            </div>
            <div class="d-flex py-4 justify-content-between align-items-center">
                <h2 >12 €</h2>
                <div class="tag size-tag is-chosen px-3 py-1">+ Add</div>
            </div>
        </div>
        <!-- Add more similar card divs here for other pizzas -->
    </div>
    </div>
</div>

</main>

<?php
include_once("partials/footer.php");
?>