<?php
include_once("partials/header.php");
$pizza_object = new Pizza();
$tags_display = $pizza_object->displayTypeTags();
$pizza_display = $pizza_object->displayPizzas();
?>
<main class="container-fluid background justify-content-center">
<div class="types d-flex flex-wrap gap-2 p-3 justify-content-center">
    <?php
        echo($tags_display);
    ?>
</div>
<div class="container-fluid">
    <div class="d-flex row gap-4 justify-content-center">
        <?php
            echo($pizza_display);
        ?>
    </div>
    </div>
</div>

</main>

<?php
include_once("partials/footer.php");
?>