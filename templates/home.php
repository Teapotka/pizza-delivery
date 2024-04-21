<?php
include_once("partials/header.php");
$pizza_object = new Pizza();
$tags_display = $pizza_object->displayTypeTags();
$pizza_display = $pizza_object->displayPizzas();
// if(empty($pizza_display)){
//     header("Location: home.php");
// }
?>
<main class="container-fluid background justify-content-center">
<div class="types d-flex flex-wrap gap-2 p-3 justify-content-center">
    <?php
        echo($tags_display);
    ?>
</div>
<div class="container-fluid">
    <div class="d-flex row gap-4 justify-content-center">
        <!-- <div class="card h-100 pizza-card rounded">
            <div class="d-flex justify-content-end align-items-center">
                <div class="text-tag fw-bold">Vegan</div>
            </div>
            <img src="../assets/img/pizza5.jpg" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Cheeseburger Pizza</h5>
            </div>
            <div class="d-flex gap-2">
                <div class="tag size-tag is-chosen px-1 py-1">26cm</div>
                <div class="tag size-tag px-1 py-1">30cm</div>
                <div class="tag size-tag px-1 py-1">40cm</div>
            </div>
            <div class="d-flex py-4 justify-content-between align-items-center">
                <h3 >12 €</h3>
                <div class="tag size-tag is-chosen px-3 py-1">+ Add</div>
            </div>
        </div> -->
        <?php
            // $pizza_object = new Pizza();
            // echo($pizza_object->displayPizzas());
            echo($pizza_display);
        ?>
    </div>
    </div>
</div>

</main>

<?php
include_once("partials/footer.php");
?>